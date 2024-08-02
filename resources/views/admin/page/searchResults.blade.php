@extends('layouts.master')
@section('css')
    <div style="display: none">@toastr_css</div>
@endsection

@section('title')
    البحث
@endsection
@section('page-header')
    البحث
@endsection
@section('sub-page-header')
    نتائج البحث
@endsection

@section('PageTitle')
    البحث
@endsection
<!-- breadcrumb -->
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <h5 class="m-10">البحث</h5>
                    @if (isset($Incident))
                        <div class="table-responsive">
                            <p>البلاغات</p>
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>رقم الجريمة</th>
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
                                            <a href="{{ route('Incident.edit', $Incident->id) }}"
                                                class="btn btn-info btn-sm" role="button" aria-pressed="true"
                                                title="تعديل"><i class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete_Incident{{ $Incident->id }}" title="ارشفة"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @include('page.Incident.destroy')
                                    @include('page.Incident.showMore')
                                </tbody>
                            </table>
                        </div><br>
                    @endif
                    @if (isset($SecurityWanted))
                        <div class="table-responsive">
                            <p>المطلوبين امنياً</p>
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                data-page-length="50" style="text-align: center">
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
                                </tbody>

                            </table>
                        </div><br>
                    @endif

                    @if (!isset($Incident) && !isset($SecurityWanted))
                        <h6 class="text-center">لا يوجد بيانات</h6>
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
