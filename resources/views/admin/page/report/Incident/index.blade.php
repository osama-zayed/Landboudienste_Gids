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
    تقرير البلاغات
@endsection

@section('PageTitle')
    البلاغات
@endsection
<!-- breadcrumb -->
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form method="GET" action="{{ route('report_Incident_show') }}" autocomplete="off">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="operation">نوع البلاغ</label>
                                <select class="form-control h-65" name="incident_status" aria-placeholder="اختر نوع البلاغ "
                                    required>
                                    <option value="0" selected>الكل
                                    <option value="أولي" @if ('أولي' == old('incident_status')) selected @endif>بلاغ أولي
                                    </option>
                                    <option value="تكميلي" @if ('تكميلي' == old('incident_status')) selected @endif>بلاغ تكميلي
                                    </option>
                                    <option value="محول" @if ('محول' == old('incident_status')) selected @endif>بلاغ محول
                                    </option>
                                    <option value="مشيك" @if ('مشيك' == old('incident_status')) selected @endif>بلاغ مشيك
                                    </option>
                                    <option value="وهمي" @if ('وهمي' == old('incident_status')) selected @endif>بلاغ وهمي
                                    </option>
                                    <!-- الخيارات الأخرى -->
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="from">من تاريخ</label>
                                <input type="date" class="form-control h-80" name="from" 
                                    required="required"  value='{{ old('incident_date', date('Y-m-d')) }}' max="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="to">الى تاريخ</label>
                                <input type="date" class="form-control h-80" name="to" 
                                    required="required"  value='{{ old('incident_date', date('Y-m-d')) }}' max="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <br>
                        <br>
                        <button class="btn btn-primary btn-sm nextBtn btn-lg pull-right" type="submit">عرض</button>
                    </form>
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
