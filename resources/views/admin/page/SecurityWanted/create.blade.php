@extends('layouts.master')
@section('css')
    <div style="display: none">@toastr_css</div>
@endsection
@section('page-header')
    المطلوبين امنياُ
@endsection
@section('sub-page-header')
    اضافة مطلوب امنياً
@endsection
@section('title')
    اضافة مطلوب امنياً
@endsection
@section('PageTitle')
    اضافة مطلوب امنياً
@endsection
<!-- breadcrumb -->
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xs-12">
                        <br>
                        <form action="{{ route('Security_wanted.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-lg-4 col-md-6 mb-10">
                                    <label for="registration_number">رقم القيد
                                        <span class="text-danger">*
                                            @error('registration_number')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="number" name="registration_number" class="form-control"
                                        value="{{ old('registration_number') }}" required>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-10">
                                    <label for="day">اليوم
                                        <span class="text-danger">*
                                            @error('day')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="text" name="day" class="form-control" value="{{ old('day') }}"
                                        required>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-10">
                                    <label for="registration_date">تاريخ القيد
                                        <span class="text-danger">*
                                            @error('registration_date')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="date" name="registration_date" class="form-control"
                                        value="{{ old('registration_date', date('Y-m-d')) }}"   max='{{ date('Y-m-d') }}' required>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-10">
                                    <label for="wanted_name">اسم المطلوب
                                        <span class="text-danger">*
                                            @error('wanted_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="text" name="wanted_name" class="form-control"
                                        value="{{ old('wanted_name') }}" required>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-10">
                                    <label for="age">العمر
                                        <span class="text-danger">*
                                            @error('age')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="number" name="age" class="form-control" value="{{ old('age') }}"
                                        required>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-10">
                                    <label for="event">بالغ/حدث
                                        <span class="text-danger">*
                                            @error('event')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <select class="form-control h-65" name="event" 
                                        required>
                                        <option value="بالغ" @if (old('event') == 'بالغ') selected @endif>بالغ </option>
                                        <option value="حدث" @if (old('event') == 'حدث') selected @endif>حدث </option>
                                    </select>

                                </div>
                                <div class="col-lg-4 col-md-6 mb-10">
                                    <label for="gender">الجنس
                                        <span class="text-danger">*
                                            @error('gender')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <select class="form-control h-65" name="gender" aria-placeholder="الجنس مطلوب"
                                        required>
                                        <option value="" disabled selected>اختر الجنس</option>
                                        <option value="ذكر" @if (old('gender') == 'ذكر') selected @endif>ذكر
                                        </option>
                                        <option value="انثى" @if (old('gender') == 'انثى') selected @endif>انثى
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-10">
                                    <label for="marital_status">الحالة الاجتماعية
                                        <span class="text-danger">*
                                            @error('marital_status')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <select class="form-control h-65" name="marital_status"
                                        aria-placeholder="اختر الحاله الاجتماعيه" required>
                                        <option value="" disabled selected>اختر الحاله الاجتماعيه</option>
                                        <option value="اعزب"  @if (old('marital_status') == 'اعزب') selected @endif>اعزب </option>
                                        <option value="خاطب"  @if (old('marital_status') == 'خاطب') selected @endif>خاطب </option>
                                        <option value="متزوج"  @if (old('marital_status') == 'متزوج') selected @endif>متزوج </option>
                                        <option value="مطلق"  @if (old('marital_status') == 'مطلق') selected @endif>مطلق </option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-10">
                                    <label for="nationality">الجنسية
                                        <span class="text-danger">*
                                            @error('nationality')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="text" name="nationality" class="form-control"
                                        value="{{ old('nationality') }}" required>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-10">
                                    <label for="occupation">المهنة
                                        <span class="text-danger">*
                                            @error('occupation')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="text" name="occupation" class="form-control"
                                        value="{{ old('occupation') }}" required>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-10">
                                    <label for="place_of_birth">محل الميلاد
                                        <span class="text-danger">*
                                            @error('place_of_birth')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="text" name="place_of_birth" class="form-control"
                                        value="{{ old('place_of_birth') }}" required>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-10">
                                    <label for="residence">السكن
                                        <span class="text-danger">*
                                            @error('residence')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="text" name="residence" class="form-control"
                                        value="{{ old('residence') }}" required>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-10">
                                    <label for="previous_convictions">السوابق
                                        <span class="text-danger">*
                                            @error('previous_convictions')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="text" name="previous_convictions" class="form-control"
                                        value="{{ old('previous_convictions') }}" required>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-primary btn-sm nextBtn btn-lg pull-right" type="submit">حفظ
                                البيانات</button>
                        </form>


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
