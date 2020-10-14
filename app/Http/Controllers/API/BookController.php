<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use App\Http\Resources\Books as BookResourceCollection;
use App\Http\Resources\Book as BookResource;

class BookController extends Controller
{

    public function index()
    {
        $criteria = Book::paginate(6);
        return new BookResourceCollection($criteria);
    }

    public function slug($slug)
    {
        $criteria = Book::where('slug', $slug)->first();
        return new BookResource($criteria);
    }

    public function top($count)
    {
        $criteria = Book::select('*')
            ->orderBy('view','DESC')
            ->limit($count)
            ->get();
        return new BookResourceCollection($criteria);
    }

    public function search($keyword)
    {
        $criteria = Book::select('*')->where('title', 'LIKE', "%".$keyword."%")
                        ->orderBy('view','DESC')
                        ->get();
        return new BookResourceCollection($criteria);
    }
}
