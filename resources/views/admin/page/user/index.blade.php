@extends('layouts.master')
@section('css')
    <div style="display: none">@toastr_css</div>
@endsection

@section('title')
    المستخدمين
@endsection
@section('page-header')
    المستخدمين
@endsection
@section('sub-page-header')
    قائمة المستخدمين
@endsection
@section('PageTitle')
    المستخدمين
@endsection
<!-- breadcrumb -->
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">
                        <i class="ti-plus"></i>
                        اضافة
                        مستخدم
                        جديد</a><br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>الايميل</th>
                                    <th>القسم</th>
                                    <th>نوع الصلاحية</th>
                                    <th>حالة الحساب</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $user)
                                    @if (auth()->user()->id != $user->id)
                                        <tr>
                                            <td>{{ $user['id'] }}</td>
                                            <td>{{ $user['name'] }}</td>
                                            <td>{{ $user['email'] }}</td>

                                            <td>{{ $user->department['name'] }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm">
                                                    @if ($user['user_type'] == 'user')
                                                        مستخدم
                                                    @elseif ($user['user_type'] == 'admin')
                                                        ادمن
                                                    @elseif ($user['user_type'] == 'incidentOfficer')
                                                        مسوؤل بلاغات
                                                    @elseif ($user['user_type'] == 'statisticOfficer')
                                                        مسوؤل احصاء
                                                    @endif
                                                </button>
                                            </td>
                                            <td>
                                                @if ($user['user_status'])
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-toggle="modal" data-target="#DisableUser{{ $user['id'] }}"
                                                        title="تجميد المستخدم">
                                                        يعمل </button>
                                                @else
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#EnableUser{{ $user['id'] }}"
                                                        title="تشغيل المستخدم">لا
                                                        يعمل</button>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('user.show', $user['id']) }}"
                                                    class="btn btn-success btn-sm" role="button" aria-pressed="true"
                                                    title="سجل الانشطة"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('user.edit', $user['id']) }}" class="btn btn-info btn-sm"
                                                    role="button" aria-pressed="true" title="تعديل"><i
                                                        class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete_user{{ $user['id'] }}" title="حذف"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @include('page.user.destroy')
                                        @include('page.user.EnableUser')
                                        @include('page.user.DisableUser')
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="7">لا يوجد بيانات</td>
                                    </tr>
                                @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if ($totalPages > 1)
            <div class="col-xl-12  d-flex justify-content-center align-items-center flex-row">
                <a @if ($page < $totalPages) href="{{ route('user.index', ['page' => $page + 1]) }}" @endif
                    class="btn mr-30 btn-success btn-sm text-center" role="button">التالي</a>
                <a @if ($page != 1) href="{{ route('user.index', ['page' => $page - 1]) }}" @endif
                    class="btn ml-30 btn-danger btn-sm text-center" role="button">السابق</a>
            </div>
        @endif
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
