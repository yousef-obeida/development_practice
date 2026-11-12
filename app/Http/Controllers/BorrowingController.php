<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BorrowingController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=auth()->user();
        return response()->json(["data"=>$user->books]);
    }
    public function borrow(Request $request){
        $user=auth()->user();
        $data=$request->validate([
            'book_id'=>'required|exists:books,id',
            'borrowed_at'=>'required|date',
            'returned_at'=>'required|date|after:borrowed_at',
        ]);
        $output=auth()->user()->books()->attach($data['book_id'],[
            'borrowed_at'=>$data['borrowed_at'],
            'returned_at'=>$data['returned_at'],
            'is_returned'=>false,
        ]);
        return response()->json(["message"=>"Book borrowed successfully"]);
    }
    public function destroy($id){
        $user=auth()->user();
        $user->books()->detach($id);
        return response()->json(["message"=>"Book returned successfully"]);
    }
}