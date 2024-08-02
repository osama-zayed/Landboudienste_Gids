<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Exception;
use App\Models\User as users;
use App\Notifications\Notifications;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\Activitylog\Models\Activity;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => ['show','edit']]); 
    }
    public function index()
    {
        try {
            $pageSize = 100;
            $page = request()->input('page', 1);
            if ($page < 1) $page = 1;
            $skip = ($page - 1) * $pageSize;
            $totalData = users::count();
            $totalPages = ceil($totalData / $pageSize);
            $users = users::with("department")->select(
                'id',
                'name',
                'email',
                'password',
                'department_id',
                'user_type',
                'user_status',
            )->skip($skip)->take($pageSize)->get();

            if ($users->isEmpty()) {
                toastr()->error('لا يوجد مستخدمين ');
            }

            return view("page.user.index", [
                "data" => $users,
                "page" => $page,
                "totalPages" => $totalPages,
            ]);
        } catch (Exception $e) {
            toastr()->error('حدث خطأ غير متوقع');
            return view("page.user.index");
        }
    }

    public function Activity()
    {
        try {
            $pageSize = 500;
            $page = request()->input('page', 1);
            if ($page < 1) $page = 1;
            $skip = ($page - 1) * $pageSize;
            $totalData = Activity::count();
            $totalPages = ceil($totalData / $pageSize);

            $data = Activity::all()->reverse()->skip($skip)->take($pageSize);

            if ($data->isEmpty()) {
                toastr()->error('لا يوجد بيانات');
            }
            return view('page.user.activity', [
                'data' => $data,
                "page" => $page,
                "totalPages" => $totalPages,
            ]);
        } catch (Exception $e) {
            toastr()->error('خطأ عند جلب البيانات');
            return view('page.user.activity', [
                "page" => $page,
                "totalPages" => $totalPages,
            ]);
        }
    }

    public function create()
    {
        return view("page.user.create");
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try {
            //التحقق من الحقول
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'user_status' => 'required',
                'department_id' => 'required|integer',
                'user_type' => 'required|string',
            ], [
                "name.required" => "الاسم مطلوب",
                "email.required" => "حقل البريد الإلكتروني مطلوب.",
                "email.email" => "حقل البريد الإلكتروني يجب أن يكون عنوان بريد إلكتروني صحيح.",
                "email.unique" => "حقل البريد الإلكتروني مستخدم مسبقًا.",
                "password.required" => "حقل كلمة المرور مطلوب.",
                "password.string" => "حقل كلمة المرور يجب أن يكون نصًا.",
                "password.min" => "حقل كلمة المرور يجب أن يحتوي على الأقل 8 أحرف.",
                "password.confirmed" => "حقل كلمة المرور غير متطابق مع حقل تأكيد كلمة المرور.",
                "user_status.required" => "حقل حالة المستخدم مطلوب.",
                "department_id.required" => "حقل معرف القسم مطلوب.",
                "department_id.integer" => "حقل معرف القسم يجب أن يكون رقمًا صحيحًا.",
                "user_type.required" => "حقل نوع المستخدم مطلوب.",
            ]);

            if ($validator->fails()) {
                toastr()->error($validator->errors()->first());
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            // إنشاء مستخدم جديد
            $userCreated = new User();

            $name = htmlspecialchars(strip_tags($request->input('name')));
            $email = htmlspecialchars(strip_tags($request->input('email')));
            $password = bcrypt($request->input('password'));
            $user_status = htmlspecialchars(strip_tags($request->input('user_status')));
            $department_id = htmlspecialchars(strip_tags($request->input('department_id')));
            $user_type = htmlspecialchars(strip_tags($request->input('user_type')));

            $userCreated->name = $name;
            $userCreated->email = $email;
            $userCreated->password = $password;
            $userCreated->user_status = $user_status;
            $userCreated->department_id = $department_id;
            $userCreated->user_type = $user_type;

            // حفظ المستخدم والتحقق من نجاح العملية
            if ($userCreated->save()) {

                //اضافة الاشعار والاضافة الى سجل العمليات
                $user = users::find(auth()->user()->id); 
                $date = date('H:i Y-m-d');
                HelperController::NotificationsAdmin(" لقد تم اضافة مستخدم جديد باسم  " .  $userCreated->name
                . " بواسطه الادمن " . $user->name
                . " الوقت والتاريخ " . $date);
                activity()->performedOn($userCreated)->event("اضافة مستخدم")->causedBy($user)
                    ->log(
                        " تم اضافة مستخدم جديد باسم " . $userCreated->name .
                            " بواسطة الادمن " . $user->name .
                            " الوقت والتاريخ " . $date,
                    );
                //نهاية كود عملية الاشعار والاضافة الى سجل العمليات
                toastr()->success("تم الاضافة بنجاح");
                return redirect()->route("user.index");
            } else {
                toastr()->error('العملية فشلت');
                return redirect()->back();
            }
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back()->with(["error" => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    
    public function show(string $id)
    {
        $user = auth()->user();
        if ($user->id !=  $id) {
            if ($user->user_type != 'admin') {
                toastr()->error("غير مصرح لك");
                return redirect()->back();
            }
        }
        try {
            $pageSize = 500;
            $page = request()->input('page', 1);
            if ($page < 1) $page = 1;
            $skip = ($page - 1) * $pageSize;
            $totalData = Activity::where('causer_id', $id)->count();
            $totalPages = ceil($totalData / $pageSize);

            $data = Activity::where('causer_id', $id)->get()->reverse()->skip($skip)->take($pageSize);
            if ($data->isEmpty()) {
                toastr()->error('لا يوجد بيانات');
            }
            return view('page.user.activity', [
                'data' => $data,
                "page" => $page,
                "totalPages" => $totalPages,
            ]);
        } catch (Exception $e) {
            toastr()->error('خطأ عند جلب البيانات');
            return view('page.user.activity', [
                'data' => $data,
                "page" => $page,
                "totalPages" => $totalPages,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth()->user();
        if ($user->id !=  $id) {
            if ($user->user_type != 'admin') {
                toastr()->error("غير مصرح لك");
                return redirect()->back();
            }
        }
        try {
            $User = User::find(htmlspecialchars(strip_tags($id)));
            return view("page.user.edit")->with("User", $User);
        } catch (Exception $e) {
            toastr()->error('خطأ عند جلب البيانات');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "id" => "required|integer",
                'name' => 'nullable|string',
                'email' => 'nullable|email',
                'password' => 'nullable|string',
                'department_id' => 'integer',
                'user_type' => 'string',
            ], [
                "id.required" => "الرقم التعريفي للمستخدم مطلوب",
                "email.email" => "حقل البريد الإلكتروني يجب أن يكون عنوان بريد إلكتروني صحيح.",
                "email.unique" => "حقل البريد الإلكتروني مستخدم مسبقًا.",
                "password.string" => "حقل كلمة المرور يجب أن يكون نصًا.",
                "department_id.integer" => "حقل معرف القسم يجب أن يكون رقمًا صحيحًا.",
            ]);
            if ($validator->fails()) {
                toastr()->error($validator->errors()->first());
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            // البحث عن المستخدم المراد تعديله
            $userToUpdate = User::findOrFail(htmlspecialchars(strip_tags($request["id"])));
            if (isset($request["email"]) && !empty($request["email"])) {
                if ($userToUpdate->email != $request["email"]) {
                    request()->validate(['email' => 'unique:users'], [
                        "email.unique" => "البريد موجود مسبقا، اختر اسماً آخر",
                    ]);
                }
                $userToUpdate->email = htmlspecialchars(strip_tags($request["email"]));
            }
            if (request()->has('name'))
                $userToUpdate->name = htmlspecialchars(strip_tags($request["name"]));

            if (request()->has('department_id'))
                $userToUpdate->department_id = htmlspecialchars(strip_tags($request["department_id"]));

            if (request()->has('user_status')) {
                $userToUpdate->user_status = htmlspecialchars(strip_tags($request["user_status"]));
            }
            if (request()->has('user_type')) {
                $userToUpdate->user_type = htmlspecialchars(strip_tags($request["user_type"]));
            }
            if (!empty(request()->password)) {
                $request->validate([
                    'password' => 'string|min:8|confirmed',
                ], [
                    "password.required" => "ادخل الرمز",
                    "password.min" => " اقل عدد للرمز 8 خانات",
                    "password.confirmed" => "الرمز غير متطابق",
                    "password.max" => "الحد الاقصى للرمز 255",
                ]);
                $userToUpdate->password = bcrypt(htmlspecialchars(strip_tags($request['password'])));
            }
            if ($userToUpdate->update()) {
                //اضافة الاشعار والاضافة الى سجل العمليات
                $user = users::find(auth()->user()->id);
                $date = date('H:i Y-m-d');

                HelperController::NotificationsAdmin(" لقد تم تعديل بيانات المستخدم  " .  $userToUpdate->name 
                . " الوقت والتاريخ " . $date);

                activity()->performedOn($userToUpdate)->event("تعديل مستخدم")->causedBy($user)
                    ->log(
                        " تم تعديل مستخدم باسم " . $userToUpdate->name .
                            " بواسطة الادمن " . $user->name .
                            " الوقت والتاريخ " . $date,
                    );
                //نهاية كود عملية الاشعار والاضافة الى سجل العمليات
                toastr()->success("تم التعديل بنجاح");
                return  redirect()->route("user.index");
            } else {
                toastr()->error("خطأ عند التعديل");
                return redirect()->back();
            }
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back()->with(["error" => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $name)
    {
        try {
            //التحقق من الحقول
            $data = request()->validate(
                [
                    "id" => "required|integer|min:1",
                ],
                [
                    "id.required" => "الرقم التعريفي للمستخدم مطلوب",
                    'id.integer' => "معرف المستخدم مطلوب",
                    'id.max' => "اكبر حد لمعرف المستخدم 255 حرف",
                    'id.min' => "اقل حد لمعرف المستخدم 1",
                ]
            );
            $rowsAffected = User::destroy(htmlspecialchars(strip_tags($data["id"])));
            if ($rowsAffected) {

                //اضافة الاشعار والاضافة الى سجل العمليات
                $user = users::find(auth()->user()->id);
                $date = date('H:i Y-m-d');
    
                HelperController::NotificationsAdmin(" لقد تم حذف المستخدم برقم  " .  $data["id"]
                . " بواسطه الادمن " . $user->name
                . " الوقت والتاريخ " . $date);
                activity()->event("حذف مستخدم")->causedBy($user)
                    ->log(
                        " تم حذف المستخدم " . $name .
                            " معرف المستخدم " . $data["id"] .
                            " بواسطة الادمن " . $user->name .
                            " الوقت والتاريخ " . $date,
                    );
                //نهاية كود عملية الاشعار والاضافة الى سجل العمليات

                toastr()->success("تم الحذف بنجاح");
                return redirect()->back();
            } else {
                toastr()->error("خطأ عند التعديل");
                return redirect()->back();
            }
        } catch (ValidationException $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error("لايمكنك حذفه لان هناك عمليات مرتبطة بهذه المستخدم");
            return redirect()->back();
        }
    }
}
