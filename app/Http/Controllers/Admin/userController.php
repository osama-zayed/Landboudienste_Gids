<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Exception;
use App\Models\User as users;
use App\Notifications\Notifications;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $users = User::all();
        return view("admin.page.users.index", [
            "users" => $users,
        ]);
    }

    public function create()
    {
        $permissions = Permission::all();
        return view("admin.page.users.create", [
            'permissions' =>$permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */

    public function show(User $user) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) {}
}
