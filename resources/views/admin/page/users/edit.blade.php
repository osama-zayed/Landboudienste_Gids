@extends('admin.layouts.master')
@section('css')
    <div style="display: none">@toastr_css</div>
@endsection
@section('title')
    تعديل على المستخدم
@endsection
@section('page-header')
    المستخدمين
@endsection
@section('sub-page-header')
    تعديل على المستخدم
@endsection
@section('PageTitle')
    تعديل على المستخدم
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
                            <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">اسم المستخدم
                                            <span class="text-danger">*
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $user->name }}" required="الحقل مطلوب">
                                    </div>
                                    <div class="col">
                                        <label for="title">البريد الالكتروني
                                            <span class="text-danger">*
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $user->email }}" required="الحقل مطلوب">
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">كلمة السر
                                            <span class="text-danger">*
                                                @error('password')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                        <input type="password" name="password" class="form-control mr-sm-2">
                                    </div>

                                    <div class="col">
                                        <label for="title"> تاكيد كلمة السر
                                            <span class="text-danger">*
                                                @error('password_confirmation')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                        <input type="password" name="password_confirmation" class="form-control mr-sm-2"
                                            autocomplete="">
                                    </div>
                                </div>


                                <div class="form-row mt-5 ">
                                    @error('permission')
                                        {{ $message }}
                                    @enderror
                                    @foreach ($permissions as $permission)
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    name="permission[{{ $permission->id }}]"
                                                    id="permission_{{ $permission->id }}" value="{{ $permission->name }}"
                                                    multiple @if (in_array($permission->name, $userPermissions)) checked @endif>
                                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
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
