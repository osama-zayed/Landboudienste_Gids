@extends('layouts.master')
@section('css')
    <div style="display: none">@toastr_css</div>
@endsection
@section('page-header')
    البلاغات
@endsection
@section('sub-page-header')
    اضافة بلاغ
@endsection
@section('title')
    اضافة بلاغ جديد
@endsection
@section('page-header')
    <!-- breadcrumb -->
@endsection
@section('PageTitle')
    اضافة بلاغ جديد
@endsection
<!-- breadcrumb -->
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xs-12">
                        <form action="{{ route('Incident.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-lg-3 col-md-6 mb-10">
                                    <label for="incident_number">رقم البلاغ
                                        <span class="text-danger">*
                                            @error('incident_number')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="number" name="incident_number" class="form-control"
                                        value="{{ old('incident_number') }}" required>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-10">
                                    <label for="crime_type_id">نوع الجريمة
                                        <span class="text-danger">*
                                            @error('crime_type_id')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <select class="form-control h-65" name="crime_type_id" aria-placeholder="اختر جريمة"
                                        required>
                                        <option value="" disabled selected>اختر جريمة من القائمة</option>
                                        @forelse (\App\Models\Crime::get() as $data)
                                            <option value="{{ $data['id'] }}"
                                                @if ($data->id == old('crime_type_id')) selected @endif>
                                                {{ $data['name'] }}</option>
                                        @empty
                                            <option value="">لا يوجد جرائم</option>
                                        @endforelse
                                        <!-- الخيارات الأخرى -->
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-10">
                                    <label for="incident_date">تاريخ البلاغ
                                        <span class="text-danger">*
                                            @error('incident_date')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="date" name="incident_date" class="form-control"
                                        value='{{ old('incident_date', date('Y-m-d')) }}' max="{{ date('Y-m-d') }}"
                                        required>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-10">
                                    <label for="department_id">قسم الشرطة
                                        <span class="text-danger">*
                                            @error('department_id')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <select class="form-control h-65" name="department_id"
                                        aria-placeholder="اختر قسم الشرطة" required>
                                        <option value="" disabled selected>اختر قسم الشرطة من القائمة</option>
                                        @if (auth()->user()->user_type == 'user')
                                            {
                                            <option value="{{ auth()->user()->department_id }}"
                                                @if (auth()->user()->department_id == old('department_id')) selected @endif>
                                                {{ auth()->user()->department->name }}</option>
                                            }
                                        @else
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
                                <div class="col-lg-3 col-md-6 mb-10">
                                    <label for="incident_time">زمن وقوع الجريمة
                                        <span class="text-danger">*
                                            @error('incident_time')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="time" name="incident_time" class="form-control"
                                        value="{{ old('incident_time', date('H:i')) }}" required>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-10">
                                    <label for="date_occurred">تاريخ وقوع الجريمة
                                        <span class="text-danger">*
                                            @error('date_occurred')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="date" name="date_occurred" class="form-control"
                                        value="{{ old('date_occurred', date('Y-m-d')) }}" required
                                        max='{{ date('Y-m-d') }}'>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-10">
                                    <label for="incident_location">مكان وقوع الجريمة
                                        <span class="text-danger">*
                                            @error('incident_location')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="text" name="incident_location" class="form-control"
                                        value="{{ old('incident_location') }}" required>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-10">
                                    <label for="reasons_and_motives">الأسباب والدوافع
                                        <span class="text-danger">*
                                            @error('reasons_and_motives')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="text" name="reasons_and_motives" class="form-control"
                                        value="{{ old('reasons_and_motives') }}" required>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-10">
                                    <label for="tools_used">الأدوات المستخدمة
                                        <span class="text-danger">*
                                            @error('tools_used')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="text" name="tools_used" class="form-control"
                                        value="{{ old('tools_used') }}" required>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-10">
                                    <label for="number_of_victims">عدد الجناة
                                        <span class="text-danger">*
                                            @error('number_of_victims')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="number" name="number_of_victims" class="form-control"
                                        value="{{ old('number_of_victims') }}" min="1" required>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-10">
                                    <label for="number_of_perpetrators">عدد الضحايا
                                        <span class="text-danger">*
                                            @error('number_of_perpetrators')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="number" name="number_of_perpetrators" class="form-control"
                                        value="{{ old('number_of_perpetrators') }}" min="1" required>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-10">
                                    <label for="incident_status">الحالة
                                        <span class="text-danger">*
                                            @error('incident_status')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <select class="form-control h-65" name="incident_status"
                                        aria-placeholder="اختر حالة البلاغ " required>
                                        <option value="" disabled selected>اختر حالة البلاغ </option>
                                        <option value="أولي"@if ('أولي' == old('incident_status')) selected @endif>بلاغ أولي
                                        </option>
                                        {{-- <option value="تكميلي"@if ('تكميلي' == old('incident_status')) selected @endif>بلاغ تكميلي
                                        </option>
                                        <option value="محول"@if ('محول' == old('incident_status')) selected @endif>بلاغ محول
                                        </option>
                                        <option value="مشيك"@if ('مشيك' == old('incident_status')) selected @endif>بلاغ مشيك
                                        </option>
                                        <option value="وهمي"@if ('وهمي' == old('incident_status')) selected @endif>بلاغ وهمي
                                        </option> --}}
                                        <!-- الخيارات الأخرى -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="incident_description">شرح البلاغ</label>
                                <textarea class="form-control" name="incident_description" id="incident_description" rows="3" required>{{ old('incident_description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="notes">ملاحظات</label>
                                <textarea class="form-control" name="notes" id="notes" rows="4">{{ old('notes') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="incident_image">الصورة النهائية للبلاغ :</label>
                                <input type="file" name="incident_image" accept="image/*">
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
