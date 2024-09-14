<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user')->only('index');
        $this->middleware('permission:create user')->only(['create', 'store']);
        $this->middleware('permission:update user')->only(['edit', 'update']);
        $this->middleware('permission:delete user')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'roles' => 'required'
        ]);
        try {
            $user=User::create([
               "name" => $request->input('name'),
               "email" => $request->input('email'),
               "password" => Hash::make($request->input('password')),
            ]);
            $user->syncRoles($request->input('roles'));
            if($user){
                return redirect()->back()->with('message', 'User created successfully...');
            }else{
                return redirect()->back()->with('error','Problem in user creation');
            }


        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => 'Problem in user creation'.$exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view('admin.users.edit', compact('user','roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'roles' => 'required'
        ]);
        try {
            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();
            $user->syncRoles($request->input('roles'));
            return redirect()->back()->with('message', 'User updated successfully...');

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => 'Problem in user update'.$exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('status', 'User deleted successfully...');
    }
}
