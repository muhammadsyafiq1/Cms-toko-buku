<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(Gate::allows('manage-orders')) return $next($request);
            abort(404);
        });
    }

    public function index()
    {
        if(request()->ajax())
        {
            $query = Order::with(['user']);

            return DataTables::of($query)
            ->addColumn('action', function($item){
                return '  
                    <form action="'.route('orders.destroy',$item->id).'" method="POST">
                    '.method_field('delete'). csrf_field().'
                        <a class="btn btn-success btn-sm" href="'.route('orders.show',$item->id).'">Details</a>
                        <button type="submit" class="d-inline btn btn-danger btn-sm">
                            Delete
                        </button>
                    </form>
                ';
            })
            ->rawColumns(['action','image'])
            ->make();
        }
        return view('pages.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('pages.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect(route('orders.index'))->with('status','Data order berhasil Dihapus');
    }

    public function status(Request $request,$id)
    {
        $status = Order::findOrFail($id);
        $status->status = $request->status;
        $status->save();
        return redirect(route('orders.index'))->with('status','Status order Berhasil Diubah');
    }
}
