@extends('layouts.master')
@section('css')
    <div style="display: none">@toastr_css</div>
@endsection
@section('title')
    سجل الانشطة
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    سجل الانشطة
@endsection
@section('page-header')
    المستخدمين
@endsection
@section('sub-page-header')
    سجل الانشطة
@endsection
<!-- breadcrumb -->
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr class="alert-primary">
                                    <th>#</th>
                                    <th>نوع الحدث</th>
                                    <th>المستخدم المسوؤل</th>
                                    <th>تاريخ العملية</th>
                                    <th>الوصف</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $datashow)
                                    <tr>
                                        <td>{{ $datashow['id'] }}</td>
                                        <td>{{ $datashow['event'] }}</td>
                                        <td>{{ $datashow['causer']['name'] }}</td>
                                        <td>{{ $datashow['created_at'] }}</td>
                                        <td>{{ $datashow['description'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">لا يوجد بيانات</td>
                                    </tr>
                                @endforelse
                        </table>
                    </div>
                </div>
            </div>
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
    <!-- row closed -->
@endsection
@section('js')

@endsection
