<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(Gate::allows('manage-categories')) return $next($request);
            abort(404);
        });
    }

    public function index(Request $request)
    {
        if(request()->ajax())
        {
            $query = Category::query();

            return DataTables::of($query)
            ->addColumn('action', function($item){
                return '  
                    <form action="'.route('categories.destroy',$item->id).'" method="POST">
                    '.method_field('delete'). csrf_field().'
                        <a class="btn btn-warning btn-sm" href="'.route('categories.edit',$item->id).'"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-default btn-sm" href="'.route('categories.show',$item->id).'"><i class="fa fa-eye"></i></a>
                        <button type="submit" class="d-inline btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                ';
            })
            ->editColumn('image', function($item) {
                return $item->image ? '<img src="'.asset('storage/'.$item->image).'" style="max-height: 40px;" />' : '';
            })
            ->rawColumns(['action','image'])
            ->make();
        }
        return view('pages.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = $request->all();
        $category['name'] = $request->name;
        $category['slug'] = Str::slug($request->name);
        $category['cretaed_by'] = Auth::user()->id;
        $category['image'] = $request->file('image')->store('images','public');
        Category::create($category);

        return redirect(route('categories.index'))->with('status','Category berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.categories.show',compact('category'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect(route('categories.index'))->with('status','Category berhasil Dihapus');
    }

    public function ajaxSearch(Request $request)
    {
        // tampung reqeust ke variable search
        $search = $request->search;
        // jika var search gak ada input
        if($search == ''){
            // maka tampilkna
            $categories = Category::orderBy('name','asc')->select('id','name')->get();
            // ada inputan 
        } else {
            $categories = Category::orderBy('name','asc')->select('id','name')->where('name','like',"%$search%")->get();
        };
        // var categories tadi di looping 
        foreach($categories as $category){
            // dan masukan ke variable response array
            $response[] = array(
                "id" => $category->id,
                "text" => $category->name
            );
        }
        echo json_encode($response);
        exit;
    }
}
