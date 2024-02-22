<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Admin;
use App\Mail\UserWelcome;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateAdminRequest;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('role:super-admin');
        $this->middleware('permission:update user', ['only' => ['update', 'edit',]]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
        $this->middleware('permission:create user', ['only' => ['create', 'store']]);
        $this->middleware('permission:show user', ['only' => ['index']]);
    }
    public function index()
    {
        $users = User::all();

        return view('Admin.Template.Admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('Admin.Template.Admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'age' => $request->age,
            'type' => $request->type,
        ]);

        if ($request->salary && $user->type == 1) {

            Admin::create([
                'salary' => $request->salary,
                'user_id' => $user->id,
            ]);
        }

        $user->syncRoles($request->roles);
        // Mail::to($user->email)->send(new UserWelcome($user));
        return redirect(route('users.index'))->with('success', "data insert successfuly");
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
    public function edit(User $user)
    {


        $userRoles = $user->roles->pluck('name', 'name')->all();

        $roles = Role::pluck('name', 'name')->all();
        return view('Admin.Template.Admin.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, string $id)
    {

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'type' => $request->type,
        ]);

        if ($request->has('password')) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }
        // $user->save();
        $salary = $request->salary;
        if ($salary && $user->type == 1) {

            $admin = Admin::where('user_id', $user->id)->first();

            $admin->updateOrCreate([
                'salary' => $salary,
                'user_id' => $user->id,
            ]);
        }

        $user->syncRoles($request->roles);
        return redirect()->route('users.index')->with('success', 'user update successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($userId)
    {
        $user = User::findOrFail($userId);

        $userRoles = $user->roles->pluck('name', 'name')->all();

        foreach ($userRoles as $userRole) {

            $user->removeRole($userRole);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'user deleted successfuly');
    }
}
