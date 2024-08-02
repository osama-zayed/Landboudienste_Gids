@extends('admin.layouts.master')
@section('css')
    <div style="display: none">@toastr_css</div>
@endsection

@section('title')
الادأرات
@endsection
@section('page-header')
الادأرات
@endsection
@section('sub-page-header')
عرض الادأرات
@endsection
@section('PageTitle')
الادأرات
@endsection
<!-- breadcrumb -->
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a type="button"class="btn btn-primary btn-sm text-light" role="button" data-toggle="modal"
                        data-target="#create" aria-pressed="true" title="اضافة ادارة جديد">
                        <i class="ti-plus"></i>
                        اضافة
                        ادأرة</a>
                    <br><br>
                    @include('admin.page.departments.create')

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الادارة</th>
                                    <th>وصف الادارة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($departments as $department)
                                    <tr>
                                        <td>{{ $department['id'] }}</td>
                                        <td>{{ $department['name'] }}</td>
                                        <td>{{ $department['description'] }}</td>
                                        <td>
                                            <a href="{{ route('departments.edit', $department['id']) }}"
                                                class="btn btn-info btn-sm" role="button" aria-pressed="true"
                                                title="تعديل"><i class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete_departments{{ $department['id'] }}" title="حذف"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @include('admin.page.departments.destroy')
                                @empty
                                    <tr>
                                        <td colspan="4">لا توجد بيانات</td>
                                    </tr>
                                @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
