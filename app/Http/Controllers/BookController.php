<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(Gate::allows('manage-books')) return $next($request);
            abort(404);
        });
    }
    
    public function index()
    {
        if(request()->ajax())
        {
            $query = Book::query();

            return DataTables::of($query)
            ->addColumn('action', function($item){
                return '
                    <form action="'.route('books.destroy',$item->id).'" method="POST">
                    '.method_field('delete'). csrf_field().'
                        <a class="btn btn-sm btn-warning" href="'.route('books.edit',$item->id).'"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-sm btn-default" href="'.route('books.show',$item->id).'"><i class="fa fa-eye"></i></a>
                        <button type="submit" class="d-inline btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                ';
            })
            ->editColumn('cover', function($item){
                return $item->cover ? '<img src="'.asset('storage/'.$item->cover).'" style="max-height: 40px;"/>' : '';
            })
            ->rawColumns(['action','index'])
            ->make();
        }
        return view('pages.books.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookRequest $request)
    {
        $book = new Book;
        $book->title = $request->title;
        $book->slug = Str::slug($request->title);
        $book->description = $request->description;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->stock = $request->stock;
        $book->price = $request->price;
        $book->status = $request->save_action;
        $book->created_by = Auth::user()->id;
        if($request->file('cover')){
            $file = $request->file('cover')->store(
                'covers','public'
            );
            $book->cover = $file;
        }
        $book->save();
        $book->category()->attach($request->get('categories'));

        return redirect(route('books.index'))->with('status','Data berhasil Ditambhakna');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('pages.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('pages.books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->title = $request->title;
        $book->slug = Str::slug($request->title);
        $book->description = $request->description;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->stock = $request->stock;
        $book->price = $request->price;
        $book->status = $request->save_action;
        $book->updated_by = Auth::user()->id;

        if($request->hasFile('cover')){
            if($request->cover && file_exists(storage_path('app/public'.$book->cover))){
                Storage::delete('public'.$book->cover);
            }
            $file = $request->file('cover')->store('covers','public');
            $book->cover = $file;
        }
        $book->save();
        $book->category()->sync($request->get('categories'));
        return redirect(route('books.index'))->with('status','Buku berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect(route('books.index'))->with('status','Data berhasil Dihapus');
    }
}
