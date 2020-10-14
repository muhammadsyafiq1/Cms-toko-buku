<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\Categories as CategoryResourceCollection;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends Controller
{

    public function index()
    {
        $criteria = Category::paginate(6);
        return new CategoryResourceCollection($criteria);
    }

    // detail kategori
    public function slug($slug)
    {
        $criteria = Category::where('slug', $slug)->first();
        return new CategoryResource($criteria);
    }

    public function random($count)
    {
        $criteria = Category::select('*') // query builder
            ->inRandomOrder()
            ->limit($count)
            ->get();
        return new CategoryResourceCollection ($criteria);
    }
}
