@extends('layouts.master')
@section('css')
    <div style="display: none">@toastr_css</div>
@endsection
@php
    $name =
        auth()->user()->id != $User->id ? 'تعديل المستخدم : ' . htmlspecialchars($User->name) : 'تعديل بياناتي الشخصية';
@endphp
@section('title')
    {{ $name }}
@endsection

@section('PageTitle')
    {{ $name }}
@endsection
@section('page-header')
    المستخدمين
@endsection
@section('sub-page-header')
    {{ $name }}
@endsection

<!-- breadcrumb -->
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{ route('user.update', 'test') }}" method="post"
                                enctype="multipart/form-Directorates">
                                @method('PUT')
                                @csrf
                                <input type="number" name="id" class="form-control" value="{{ $User->id }}"
                                    hidden>
                                <div class="form-row">
                                    @if (auth()->user()->user_type == 'admin')
                                        <div class="col">
                                            <label for="title">اسم المستخدم
                                                <span class="text-danger">*
                                                    @error('name')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name') ?? $User->name }}" required="الحقل مطلوب">
                                        </div>
                                    @endif
                                    <div class="col">
                                        <label for="title">البريد الالكتروني
                                            <span class="text-danger">*
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email') ?? $User->email }}" required="الحقل مطلوب">
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">كلمة السر
                                            <span class="text-danger">
                                                @error('password')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                        <input type="password" name="password" class="form-control mr-sm-2"
                                            value="{{ old('password') }}">
                                    </div>
                                    <div class="col">
                                        <label for="title"> تاكيد كلمة السر
                                            <span class="text-danger">
                                                @error('password_confirmation')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                        <input type="password" name="password_confirmation" class="form-control mr-sm-2"
                                            value="{{ old('password_confirmation') }}">
                                    </div>
                                </div><br>
                                @if (auth()->user()->id != $User->id)
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="Grade_id">حالة المستخدم : <span class="text-danger">*
                                                        @error('user_status')
                                                            {{ $message }}
                                                        @enderror
                                                    </span></label>
                                                <select id="department_select" class="custom-select mr-sm-2"
                                                    name="user_status">
                                                    <option value="1"
                                                        @if ($User->user_type) selected @endif>
                                                        مفعل</option>
                                                    <option value="0"
                                                        @if (!$User->user_type) selected @endif>
                                                        مجمد</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="Grade_id">القسم : <span class="text-danger">*
                                                        @error('department_id')
                                                            {{ $message }}
                                                        @enderror
                                                    </span></label>
                                                <select id="department_select" class="custom-select mr-sm-2"
                                                    name="department_id">
                                                    <option value="" disabled selected>اختر قسم</option>
                                                    @foreach (\App\Models\department::get() as $department)
                                                        <option value="{{ $department->id }}"
                                                            @if ($department->id == $User->department_id) selected @endif>
                                                            {{ $department->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="Classroom_id">الصلاحية : <span class="text-danger">*</span></label>
                                            <select id="user_type" class="custom-select mr-sm-2" name="user_type" multiple
                                                required>
                                                <option value="user" @if ('user' == $User->user_type) selected @endif>
                                                    مستخدم
                                                </option>
                                                <option value="admin" @if ('admin' == $User->user_type) selected @endif>
                                                    ادمن
                                                </option>
                                                <option value="incidentOfficer"
                                                    @if ('incidentOfficer' == $User->user_type) selected @endif>مسوؤل بلاغات</option>
                                                <option value="statisticOfficer"
                                                    @if ('statisticOfficer' == $User->user_type) selected @endif>موظف الإحصاء</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif

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
