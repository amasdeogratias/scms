<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin|admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|min:3'
        ]);
        try {
            Permission::create([
                'name' => $request->title
            ]);
            return redirect()->back()->with('message', 'Permission Created successfully');
        }catch (\Exception $exception){
            return redirect()->back()->with('error', 'Problem in creating permission'.$exception->getMessage());
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
        $permission = Permission::findById($id);
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required|string'
        ]);
        try {
            $permission = Permission::findOrFail($id);
            $permission->name = $request->input('title');
            $permission->save();
            return redirect()->back()->with('message', 'Permission updated successfully...');

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => 'Problem in permission update'.$exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->back()->with('status', 'Permission deleted successfully...');
    }
}
