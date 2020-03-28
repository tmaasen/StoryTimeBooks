<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{
    /**
     * Returns ALL books. THIS WILL BE AN ADMIN FUNCTION
     */
    public function allBooks()
    {
        $books = DB::table('products')->get();
        return response()->json(
            [
                'status' => 'success',
                'books' => $books
            ], 200);
    }

    /**
     * Returns ALL books. THIS WILL BE AN ADMIN FUNCTION
     */
    public function allPublishers()
    {
        $publishers = DB::table('publishers')->get();
        return response()->json(
            [
                'status' => 'success',
                'publishers' => $publishers
            ], 200);
    }
}