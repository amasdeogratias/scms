<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission: view role', ['only' => ['index']]);
        $this->middleware('permission: create role', ['only' => ['create', 'store']]);
        $this->middleware('permission: update role', ['only' => ['update', 'edit']]);
        $this->middleware('permission: delete role', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission = Permission::all();
        return view('admin.roles.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'permission' => 'required',
        ]);
        try {
            $role = Role::create([
                "name" => $request->title
            ]);
            $role->syncPermissions($request->input('permission'));
            return redirect()->back()->with('message','Role created successfully');

        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
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
        $role = Role::findById($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
                           ->pluck("role_has_permissions.permission_id","role_has_permissions.permission_id")
                           ->all();
        return view('admin.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'role_id' => 'required',
            'title' => 'required',
            'permission' => 'required|array',
        ]);
        try {
            $role = Role::findOrFail($id);
            $role->name = $request->input('title');
            $role->save();

            $role->syncPermissions($request->input('permission'));
            return redirect()->back()->with('success','Role updated successfully');

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => 'Problem in updating role: ' . $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->back()->with('status', 'Role Deleted Successfully');
    }
}
