<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\Notifications;

class HelperController extends Controller
{
    static public function checkPermission($Permission)
    {
        /*
        if (auth()->user()->user_type != $Permission) {
            toastr()->error("غير مصرح لك");
            return redirect()->back();
        }
        <option value="user" >مستخدم</option>
        <option value="admin">ادمن</option>
        <option value="incidentOfficer">مسوؤل بلاغات</option>
        <option value="statisticOfficer">موظف الإحصاء</option>
        */
    }
    // static function sanitizeInput($input)
    // {
    //     return htmlspecialchars(strip_tags($input), ENT_QUOTES);
    // }
    static function NotificationsAllUser($masseg)
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        if ($users->isNotEmpty()) {
            foreach ($users as $user) {
                $user->notify(new Notifications([
                    "body" => $masseg,
                ]));
            }
        }
    }
    static function NotificationsUserDepartment($masseg, $departmentId)
    {
        $loggedInUserId = auth()->user()->id;
        $users = User::where('user_type', '!=', 'user')
            ->where('id', '!=', $loggedInUserId)
            ->where(function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId)
                    ->orWhere('user_type', '!=', 'admin');
            })
            ->get();
        if ($users->isNotEmpty()) {
            foreach ($users as $user) {
                $user->notify(new Notifications([
                    "body" => $masseg
                ]));
            }
        }
    }
    static function NotificationsAdmin($masseg)
    {
        $loggedInUserId = auth()->user()->id;
        $users = User::where('user_type', 'admin')
            ->where('id', '!=', $loggedInUserId)
            ->get();
        if ($users->isNotEmpty()) {
            foreach ($users as $user) {
                $user->notify(new Notifications([
                    "body" => $masseg
                ]));
            }
        }
    }

    static public function checkPerformance($startTime, $data)
    {
        // $time =microtime(true);
        // dd(HelperController::checkPerformance($time,$data));

        // @php
        // $time = microtime(true);
        // @endphp
        // @php
        // $endTime = microtime(true);
        // $executionTime = $endTime - $time;
        // @endphp
        // @dd($executionTime)

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;

        $size = strlen($data);
        $sizeInKB = $size / 1024;

        return ["executionTime" => $executionTime, "sizeInKB" => $sizeInKB];
    }
}
