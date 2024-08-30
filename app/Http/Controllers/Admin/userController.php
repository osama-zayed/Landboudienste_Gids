<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\User;
use Exception;
use App\Models\User;
use App\Notifications\Notifications;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */




    public function store(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'permission' => 'array', // التأكد من أن الصلاحيات هي مصفوفة
            'permissions.*' => 'string|exists:permissions,name', // التأكد من أن كل عنصر في المصفوفة موجود
        ], []);

        // استخدام معاملة لضمان التكامل
        DB::transaction(function () use ($validatedData) {
            // إنشاء المستخدم الجديد
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
            ]);

            // ربط المستخدم بالصلاحيات إذا كانت موجودة
            if (isset($validatedData['permission'])) {
                foreach ($validatedData['permission'] as $permissionName) {
                    $user->givePermissionTo($permissionName);
                }
            }
        });

        // رسالة نجاح أو إعادة توجيه إلى مكان آخر
        return redirect()->route('users.index')->with('success', 'تم إضافة المستخدم وربطه بالصلاحيات بنجاح');
    }



    /**
     * Display the specified resource.
     */

    public function show(User $user) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // dd($user->);
        $permissions = Permission::all();
        return view("admin.page.users.edit", [
            'permissions' => $permissions,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        // التحقق من صحة البيانات المدخلة
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'nullable|string|min:8|confirmed',
            'permission' => 'array', // التأكد من أن الصلاحيات هي مصفوفة
            'permissions.*' => 'string|exists:permissions,name', // التأكد من أن كل عنصر في المصفوفة موجود
        ], []);

        // استخدام معاملة لضمان التكامل
        DB::transaction(function () use ($validatedData, $user) {
            // إنشاء المستخدم الجديد
            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']) ?? $user->password,
            ]);

            // ربط المستخدم بالصلاحيات إذا كانت موجودة
            if (isset($validatedData['permission'])) {
                foreach ($validatedData['permission'] as $permissionName) {
                    $user->givePermissionTo($permissionName);
                }
            }
        });

        // رسالة نجاح أو إعادة توجيه إلى مكان آخر
        return redirect()->route('users.index')->with('success', 'تم إضافة المستخدم وربطه بالصلاحيات بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) {}
}
