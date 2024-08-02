@extends('layouts.master')
@section('css')
    <div style="display: none">@toastr_css</div>
@endsection

@section('title')
    المطلوبين امنياً
@endsection
@section('page-header')
    المطلوبين امنياً
@endsection
@section('sub-page-header')
    {{ $title }}
@endsection

@section('PageTitle')
    المطلوبين امنياً
@endsection
<!-- breadcrumb -->
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a href="{{ route('Security_wanted.create') }}" class="btn btn-primary btn-sm" role="button"
                        aria-pressed="true">
                        <i class="ti-plus"></i>
                        اضافة
                        مطلوب امني
                    </a><br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>رقم القيد</th>
                                    <th>اليوم</th>
                                    <th>تاريخ القيد</th>
                                    <th>اسم المطلوب</th>
                                    <th>العمر</th>
                                    <th>بالغ/حدث</th>
                                    <th>الجنس</th>
                                    <th>الحاله الاجتماعية</th>
                                    <th>الجنسية</th>
                                    <th>المهنة</th>
                                    <th>محل الميلاد</th>
                                    <th>السكن</th>
                                    <th>السوابق</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $SecurityWanted)
                                    <tr>
                                        <td>{{ $SecurityWanted->id }}</td>
                                        <td>{{ $SecurityWanted->registration_number }}</td>
                                        <td>{{ $SecurityWanted->day }}</td>
                                        <td>{{ $SecurityWanted->registration_date }}</td>
                                        <td>{{ $SecurityWanted->wanted_name }}</td>
                                        <td>{{ $SecurityWanted->age }}</td>
                                        <td>{{ $SecurityWanted->event }}</td>
                                        <td>{{ $SecurityWanted->gender }}</td>
                                        <td>{{ $SecurityWanted->marital_status }}</td>
                                        <td>{{ $SecurityWanted->nationality }}</td>
                                        <td>{{ $SecurityWanted->occupation }}</td>
                                        <td>{{ $SecurityWanted->place_of_birth }}</td>
                                        <td>{{ $SecurityWanted->residence }}</td>
                                        <td>{{ $SecurityWanted->previous_convictions }}</td>
                                        <td>
                                            <a href="{{ route('Security_wanted.edit', $SecurityWanted->id) }}"
                                                class="btn btn-info btn-sm" role="button" aria-pressed="true"
                                                title="تعديل"><i class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete_SecurityWanted{{ $SecurityWanted->id }}"
                                                title="ارشفة"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>

                                    @include('page.SecurityWanted.destroy')
                                @empty
                                    <tr>
                                        <td colspan="15">لا توجد بيانات</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                    @if ($totalPages > 1)
                        <div class="col-xl-12  d-flex justify-content-center align-items-center flex-row">
                            <a @if ($page < $totalPages) href="{{ request()->fullUrlWithQuery(['page' => $page + 1]) }}" @endif
                                class="btn mr-30 btn-success btn-sm text-center" role="button">التالي</a>
                            <a @if ($page != 1) href="{{ request()->fullUrlWithQuery(['page' => $page - 1]) }}" @endif
                                class="btn ml-30 btn-danger btn-sm text-center" role="button">السابق</a>
                        </div>
                    @endif
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
