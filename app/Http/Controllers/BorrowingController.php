<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrowing;

class BorrowingController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        return response()->json(['data' => $user->borrowing]);
    }

    public function borrow(Request $request)
    {
        $data = $request->validate([
            'book_id' => 'required|exists:book,id',
            'borrowed_at' => 'required|date|after_or_equal:today',
            'returned_at' => 'required|date|after:borrowed_at',
        ]);

        $isTaken = Book::find($data['book_id'])->customers()
        ->wherePivot('is_returned', false)
        ->wherePivot('borrowed_at', '<=', $data['returned_at'])
        ->wherePivot('returned_at', '>=', $data['borrowed_at'] ) 
        ->exists();

        if ($isTaken) {
            return response()->json(['message' => 'Book is already borrowed'], 400);
        }

        $openCount = auth()->user()->books()
        ->wherePivot('is_returned', false)->count();

        if ($openCount >= 3) {
            return response()->json(['message' => 'You have reached the maximum number of borrowed books'], 400);
        }

        auth()->user()->borrowing()->attach($data['book_id'], [
            'borrowed_at' => $data['borrowed_at'],
            'returned_at' => $data['returned_at'],
            'is_returned' => false,
        ]);

        return response()->json(['message' => 'Book borrowed successfully']);
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $user->borrowing()->detach($id);

        return response()->json(['message' => 'Book returned successfully']);
    }
    public function markAsReturned(Request $request)
    {
       $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $customer = Customer::find($request->customer_id);

        $borrowing = $customer->books()
        ->wherePivot('book_id', $request->book_id)
        ->wherePivot('is_returned', false)
        ->first();

        if (!$borrowing) {
            return response()->json(['message' => 'Borrowing record not found or already returned'], 404);
        }

       $customer->books()->
       wherePivot('is returned', false)
         ->updateExistingPivot($request->book_id, ['is_returned' => true]);

        return response()->json(['message' => 'Book marked as returned successfully',
        'customer_id' => $customer->id,
        'book_id' => $request->book_id,
        'borrowed_at' => $borrowing->pivot->borrowed_at,
        'returned_at' => $borrowing->pivot->returned_at,
        ]);
    }
    public function overdue()
    {
        $late = Borrowing::with(['customer', 'book'])
            ->where('is_returned', false)
            ->where('returned_at', '<', now()->toDateString())
            ->get();
        
        return response()->json($late);

       
    }
}
