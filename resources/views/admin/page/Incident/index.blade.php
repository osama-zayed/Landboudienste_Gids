@extends('layouts.master')
@section('css')
    <div style="display: none">@toastr_css</div>
@endsection

@section('title')
    البلاغات
@endsection
@section('page-header')
    البلاغات
@endsection
@section('sub-page-header')
    {{ $title }}
@endsection

@section('PageTitle')
    البلاغات
@endsection
<!-- breadcrumb -->
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a href="{{ route('Incident.create') }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">
                        <i class="ti-plus"></i>
                        اضافة
                        بلاغ
                    </a><br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>رقم البلاغ</th>
                                    <th>نوع الجريمة</th>
                                    <th>تاريخ البلاغ</th>
                                    <th>مركز الشرطة</th>
                                    <th>زمن وقوعها</th>
                                    <th>تاريخ وقوعها</th>
                                    <th>مكان وقوعها</th>
                                    <th>الاسباب والدوافع</th>
                                    <th>الادوات المستحدمة</th>
                                    <th>الحالة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $Incident)
                                    <tr>
                                        <td>{{ $Incident->id }}</td>
                                        <td>{{ $Incident->incident_number }}</td>
                                        <td>{{ $Incident->crimeType->name }}</td>
                                        <td>{{ $Incident->incident_date }}</td>
                                        <td>{{ $Incident->department->name }}</td>
                                        <td>{{ $Incident->incident_time }}</td>
                                        <td>{{ $Incident->date_occurred }}</td>
                                        <td>{{ $Incident->incident_location }}</td>
                                        <td>{{ $Incident->reasons_and_motives }}</td>
                                        <td>{{ $Incident->tools_used }}</td>
                                        <td>{{ $Incident->incident_status }}</td>
                                        <td>
                                            <button type="button" class="btn  btn-success btn-sm" data-toggle="modal"
                                                data-target="#show_more{{ $Incident['id'] }}" title="عرض التفاصيل">
                                                <i class="fa fa-eye"></i></i></button>
                                            @if ($edit)
                                                <a href="{{ route('Incident.edit', $Incident->id) }}"
                                                    class="btn btn-info btn-sm" role="button" aria-pressed="true"
                                                    title="تعديل"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete_Incident{{ $Incident->id }}" title="ارشفة"><i
                                                        class="fa fa-trash"></i></button>
                                            @endif

                                        </td>
                                    </tr>
                                    @include('page.Incident.destroy')
                                    @include('page.Incident.showMore')
                                @empty
                                    <tr>
                                        <td colspan="12">لا توجد بيانات</td>
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
