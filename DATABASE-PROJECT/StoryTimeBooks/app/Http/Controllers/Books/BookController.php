<?php

namespace App\Http\Controllers\Books;
use App\Product;
use App\Publisher;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;



class BookController extends Controller
{
    /**
     * Returns ALL books. THIS IS AN ADMIN FUNCTION.
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

    /**
     * Returns ALL states. THIS WILL BE AN ADMIN FUNCTION
     */
    public function allStates()
    {
        $states = DB::table('states')->get();
        return response()->json(
            [
                'status' => 'success',
                'states' => $states
            ], 200);
    }

    /**
     * Creates a new book entry. THIS IS AN ADMIN FUNCTION.
     */
    public function createBook(Request $request) {
        $v = Validator::make($request->all(), [
            'product_name' => 'required',
            'author' => 'required',
            'publisher_id' => 'required',
            'isbn_13'  => 'required|max:13',
            'copyright_date' => 'required|date',
            'retail_price' => 'required|numeric',
            'company_cost' => 'required|numeric',
            'quantity_on_hand' => 'required|integer',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }

        $book = new Product();
        $book->product_name = $request->product_name;
        $book->author = $request->author;
        $book->publisher_id = $request->publisher_id;
        $book->isbn_13 = $request->isbn_13;
        $book->copyright_date = $request->copyright_date;
        $book->retail_price = $request->retail_price;
        $book->company_cost = $request->company_cost;
        $book->quantity_on_hand = $request->quantity_on_hand;
        $book->save();

        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Creates a new publisher entry. THIS IS AN ADMIN FUNCTION.
     */
    public function createPublisher(Request $request) {
        $v = Validator::make($request->all(), [
            'publisher_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state_id'  => 'required|integer',
            'zipcode' => 'required',
            'phone' => 'required',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }

        $publisher = new Publisher();
        $publisher->publisher_name = $request->publisher_name;
        $publisher->address = $request->address;
        $publisher->city = $request->city;
        $publisher->state_id = $request->state_id;
        $publisher->zipcode = $request->zipcode;
        $publisher->phone = $request->phone;
        $publisher->save();

        return response()->json(['status' => 'success'], 200);
    }
}