<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Model\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(Gate::allows('manage-users')) return $next($request);
            abort(404);
        }) ;
    }

    public function index(Request $request)
    {
        if(request()->ajax())
        {
            $query = User::query();

            return Datatables::of($query)
            ->addColumn('action', function($item){
                return '
                        <form action="'. route('user.destroy',$item->id) .'" method="POST">
                            '. method_field('delete') . csrf_field() .'
                            <a class="btn btn-warning btn-sm" href="'. route('user.edit',$item->id) .'"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-default btn-sm" href="'. route('user.show',$item->id) .'"><i class="fa fa-eye"></i></a>
                            <button type="submit" class="d-inline btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    ';
            }) 
            ->editColumn('avatar', function($item){
                return $item->avatar ? '<img src="'.Storage::url($item->avatar).'" style="max-height: 40px;"/>' : '';
            })
            ->rawColumns(['action','index'])
            ->make();
        }
        return view('pages.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->roles = json_encode($request->roles);
        $user->password = Hash::make($request->password);
        if($request->file('avatar')){
            $file = $request->file('avatar')->store(
                'avatars','public'
            );
            $user->avatar = $file;
        }
        $user->save();
        return redirect(route('user.index'))->with('status','User berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.users.edit',compact('user'));
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
        $request->validate([
            'name' => 'max:100',
            'username' => 'max:100|unique:users,username',
            'avatar' => 'image',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->roles = json_encode($request->roles);
        $user->status = $request->status;
        if($request->hasFile('avatar')){
            if($user->avatar && file_exists(storage_path('app/public/'.$user->avatar))){
                Storage::delete('public/'.$user->avatar);
            }
            $file = $request->file('avatar')->store(
                'avatars','public'
            );
            $user->avatar = $file;
        }
        $user->save();
        return redirect(route('user.index'))->with('status','Data berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect(route('user.index'))->with('status','Data berhasil Dihapus');
    }
}
