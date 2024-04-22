<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\RoleResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;

class RoleController extends BaseController
{
    private function __contruct()
    {
        $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:role-delete'], ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $roles = Role::orderBy('created_at', 'DESC')->paginate(50);
        return $this->sendResponse(RoleResource::collection($roles), 'list role berhasil didapat.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validator error. ', $validator->errors());
        }
        $role = Role::create(['name' => $input['name']]);
        $permission = Permission::create(['name' => $input['permission']]);
        $permission = $role->syncPermissions($permission);
        return $this->sendResponse(new RoleResource($role), 'Role berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        if (is_null($role)) {
            return $this->sendError('Role tidak ditemukan.');
        }
        return $this->sendResponse(new RoleResource($role), 'show role didapat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        if (is_null($role)) {
            return $this->sendError('Role tidak ditemukan.');
        }
        return $this->sendResponse(new RoleResource($role), 'show role didapat.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role, Permission $permission)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $permission->name = $input['permission'];
        $permission->save();
        $role->name = $input['name'];
        $role->syncPermissions($permission->id);
        $role->save();

        return $this->sendResponse(new RoleResource($role), 'role berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->delete();
            return $this->sendResponse('Role berhasil di hapus.', 201);
        }
        return $this->sendError('role tidak ditemukan');
    }
}
