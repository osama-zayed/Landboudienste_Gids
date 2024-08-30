@extends('admin.layouts.master')
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
                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">
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
                                    <th>حالة الحساب</th>

                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user['id'] }}</td>
                                            <td>{{ $user['name'] }}</td>
                                            <td>{{ $user['email'] }}</td>
                                            <td>
                                                @if ($user['user_status'])
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#DisableUser{{ $user['id'] }}"
                                                        title="تجميد المستخدم"> يعمل </button>
                                                @else
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#EnableUser{{ $user['id'] }}"
                                                        title="تشغيل المستخدم">لا يعمل</button>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('users.show', $user['id']) }}"
                                                    class="btn btn-success btn-sm" role="button" aria-pressed="true"
                                                    title="سجل الانشطة"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('users.edit', $user['id']) }}" class="btn btn-info btn-sm"
                                                    role="button" aria-pressed="true" title="تعديل"><i
                                                        class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete_user{{ $user['id'] }}" title="حذف"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @include('admin.page.users.destroy')
                                        @include('admin.page.users.EnableUser')
                                        @include('admin.page.users.DisableUser')
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
        {{-- @if ($totalPages > 1)
            <div class="col-xl-12  d-flex justify-content-center align-items-center flex-row">
                <a @if ($page < $totalPages) href="{{ route('user.index', ['page' => $page + 1]) }}" @endif
                    class="btn mr-30 btn-success btn-sm text-center" role="button">التالي</a>
                <a @if ($page != 1) href="{{ route('user.index', ['page' => $page - 1]) }}" @endif
                    class="btn ml-30 btn-danger btn-sm text-center" role="button">السابق</a>
            </div>
        @endif --}}
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
