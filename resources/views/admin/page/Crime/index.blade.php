@extends('layouts.master')
@section('css')
    <div style="display: none">@toastr_css</div>
@endsection
@section('title')
    الجرائم
@endsection
@section('page-header')
    المراكز
@endsection
@section('sub-page-header')
    الجرائم
@endsection
@section('PageTitle')
    الجرائم
@endsection
<!-- breadcrumb -->
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a type="button"class="btn btn-primary btn-sm text-light" role="button" data-toggle="modal"
                        data-target="#create" aria-pressed="true" title="اضافة قسم جديد">
                        <i class="ti-plus"></i>
                        اضافة
                        جريمة</a>
                    <br><br>
                    @include('page.Crime.create')
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الجريمة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($data as $Crime)
                                    <tr>
                                        <td>{{ $Crime['id'] }}</td>
                                        <td>{{ $Crime['name'] }}</td>
                                        <td>
                                            <a href="{{ route('Crime.edit', $Crime['id']) }}" class="btn btn-info btn-sm"
                                                role="button" aria-pressed="true" title="تعديل"><i
                                                    class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete_Crime{{ $Crime['id'] }}" title="حذف"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @include('page.Crime.destroy')
                                @empty
                                    <tr>
                                        <td colspan="3">لا توجد بيانات</td>
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
