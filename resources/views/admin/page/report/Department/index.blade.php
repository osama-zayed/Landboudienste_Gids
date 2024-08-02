@extends('layouts.master')
@section('css')
    <div style="display: none">@toastr_css</div>
@endsection

@section('title')
    الاقسام
@endsection
@section('page-header')
    الاقسام
@endsection
@section('sub-page-header')
    تقرير الاقسام
@endsection

@section('PageTitle')
    الاقسام
@endsection
<!-- breadcrumb -->
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form method="GET" action="{{ route('report_Department_show') }}" autocomplete="off">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="operation">القسم</label>
                                <select class="form-control h-65" name="department_id" aria-placeholder="اختر قسم الشرطة"
                                    required>
                                    @if (auth()->user()->user_type == 'user')
                                        {
                                        <option value="{{ auth()->user()->department_id }}"
                                            @if (auth()->user()->department_id == old('department_id')) selected @endif>
                                            {{ auth()->user()->department->name }}</option>
                                        }
                                    @else
                                        <option value="0" selected>الكل</option>
                                        @forelse (\App\Models\department::get() as $data)
                                            <option value="{{ $data['id'] }}"
                                                @if ($data->id == old('department_id')) selected @endif>
                                                {{ $data['name'] }}</option>
                                        @empty
                                            <option value="" disabled>لا يوجد اقسام شرطة</option>
                                        @endforelse
                                    @endif

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
