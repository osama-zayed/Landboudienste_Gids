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
        $this->middleware('auth');
    }
    public function index()
    {
        $users = User::all();
        return view("admin.page.users.index", [
            "users" => $users,
        ]);
    }

    public function Activity()
    {
        // try {
        //     $pageSize = 500;
        //     $page = request()->input('page', 1);
        //     if ($page < 1) $page = 1;
        //     $skip = ($page - 1) * $pageSize;
        //     $totalData = Activity::count();
        //     $totalPages = ceil($totalData / $pageSize);

        //     $data = Activity::all()->reverse()->skip($skip)->take($pageSize);

        //     if ($data->isEmpty()) {
        //         toastr()->error('لا يوجد بيانات');
        //     }
        //     return view('admin.page.user.activity', [
        //         'data' => $data,
        //         "page" => $page,
        //         "totalPages" => $totalPages,
        //     ]);
        // } catch (Exception $e) {
        //     toastr()->error('خطأ عند جلب البيانات');
        //     return view('page.user.activity', [
        //         "page" => $page,
        //         "totalPages" => $totalPages,
        //     ]);
        // }
    }

    public function create()
    {
        return view("admin.page.users.create");
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $name)
    {
       
    }
}
