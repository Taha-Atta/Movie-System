<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        // $this->middleware('role:super-admin');
        $this->middleware('permission:update roles', ['only' => ['update', 'edit', 'PermissionToRole', ' givePermissionToRole']]);
        $this->middleware('permission:delete roles', ['only' => ['destroy']]);
        $this->middleware('permission:create roles', ['only' => ['create', 'store']]);
        $this->middleware('permission:show roles', ['only' => ['index']]);
    }

    public function index()
    {
        $roles = Role::paginate(6);
        return view('Admin.Template.Role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Template.Role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data =  $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $role = Role::create($data);
        return redirect(route('roles.index'))->with(['success' => 'Role Created successfuly']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::findOrFail($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
        ->where("role_has_permissions.role_id", $id)
        ->get();

        return view('Admin.Template.Role.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {

        return view('Admin.Template.Role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $data =  $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $role = Role::findOrFail($id);

        $role->update($data);
        return redirect()->route('roles.index')->with(['success' => 'role update successfuly']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($roleId)
    {
        $role = Role::findOrFail($roleId);
        $role->delete();
        return redirect()->route('roles.index')->with(['success' => 'role delete successfuly']);
    }

    public function PermissionToRole($roleId)
    {
        $permissions = Permission::all();
        $role = Role::findOrFail($roleId);
        $rolePermission = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id')
            ->all();

        return view('Admin.Template.Role.givePermissionToRole', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermission' => $rolePermission,
        ]);
    }
    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($roleId);

        $role->syncPermissions($request->permission);

        return redirect()->route('roles.index')->with(['success' => 'permission added successfuly']);
    }
}
