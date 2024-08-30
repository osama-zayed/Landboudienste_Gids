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
use Illuminate\Validation\Rule;

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

    public function show(string $id)
    {
        try {
            $pageSize = 500;
            $page = request()->input('page', 1);
            if ($page < 1) $page = 1;
            $skip = ($page - 1) * $pageSize;
            $totalData = Activity::where('causer_id', $id)->count();
            $totalPages = ceil($totalData / $pageSize);

            $data = Activity::where('causer_id', $id)->get()->reverse()->skip($skip)->take($pageSize);
            //  if ($data->isEmpty()) {
            //      toastr()->error('لا يوجد بيانات');
            //  }
            return view('admin.page.users.activity', [
                'data' => $data,
                "page" => $page,
                "totalPages" => $totalPages,
            ]);
        } catch (Exception $e) {
            //  toastr()->error('خطأ عند جلب البيانات');
            return view('admin.page.users.activity', [
                'data' => [],
                "page" => $page,
                "totalPages" => $totalPages,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // dd($user->);
        $userPermissions = $user->getDirectPermissions()->pluck('name')->toArray();
        $permissions = Permission::all();
        return view("admin.page.users.edit", [
            'permissions' => $permissions,
            'user' => $user,
            'userPermissions' => $userPermissions
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
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'permission' => 'array', // التأكد من أن الصلاحيات هي مصفوفة
            'permissions.*' => 'string|exists:permissions,name', // التأكد من أن كل عنصر في المصفوفة موجود
        ]);

        // استخدام معاملة لضمان التكامل
        DB::transaction(function () use ($validatedData, $user) {
            // إنشاء المستخدم الجديد

            $user->name =  $validatedData['name'];
            $user->email =  $validatedData['email'];
            if (isset($validatedData['password']) && !empty($validatedData['password'])) {
                $user->password =  bcrypt($validatedData['password']);
            }
            $user->save();
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
