<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Models\Book;


class HomeController extends Controller
{
    public function index()
    {
         $books = Book::all();
        return view('pages.index', compact('books'));
       // return view('pages.index');

    }



    public function read($id)
{
    $book = Book::findOrFail($id);
    return view('pages.readBook', compact('book'));
}

}
