<?php

namespace App\Http\Controllers;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;

class BookController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book=Book::all();
        return BookResource::collection($book);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request , Book $book)
    {
        $book->fill($request->validated());
        return new BookResource($book);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        $book->update($request->validated());
        return BookResource::make($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully'], 204);
    }
}
