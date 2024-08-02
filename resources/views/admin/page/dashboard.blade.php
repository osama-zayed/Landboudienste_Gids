@extends('admin.layouts.app')
@section('content')
    <!-- main-content -->
    <div class="content-wrapper">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-10">مرحبا بك</h3>
                    <h5 class="mb-20" style="color: #80828f; ">نظام ادارة مراكز اقسام الشرطة</ح>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    </ol>
                </div>
            </div>
        </div>
        <!-- widgets -->
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100" style="background: #0788e4 ;border-radius: 5px;overflow: hidden ">
                    <div class="card-body p-0 ">
                        <div class="clearfix ">
                            <div class="p-20 pb-0">
                                <h5 class="card-text text-light mb-10">عدد البلاغات</h5>
                                <h4 class="text-light">{{ $data['incident_count'] }}</h4>
                            </div>
                            <img src="{{ asset('assets/admin/images/card style.svg') }}" alt="triangle with all three sides equal"
                                style="transform: scale(2, 1); float: right; ">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100" style="background: #f75f78 ;border-radius: 5px;overflow: hidden ">
                    <div class="card-body p-0 ">
                        <div class="clearfix ">
                            <div class="p-20 pb-0">
                                <h5 class="card-text text-light mb-10">البلاغات الاولية</h5>
                                <h4 class="text-light">{{ $data['initial_incident_count'] }}</h4>
                            </div>
                            <img src="{{ asset('assets/admin/images/card style.svg') }}" alt="triangle with all three sides equal"
                                style="transform: scale(1.5, 1); float: right; ">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100" style="background: #14a878 ;border-radius: 5px;overflow: hidden ">
                    <div class="card-body p-0 ">
                        <div class="clearfix ">
                            <div class="p-20 pb-0">
                                <h5 class="card-text text-light mb-10">البلاغات التكميلية</h5>
                                <h4 class="text-light">{{ $data['supplementary_incident_count'] }}</h4>
                            </div>
                            <img src="{{ asset('assets/admin/images/card style.svg') }}" alt="triangle with all three sides equal"
                                style="transform: scale(2.5, 1); float: right; ">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100" style="background: #f68244 ;border-radius: 5px;overflow: hidden ">
                    <div class="card-body p-0 ">
                        <div class="clearfix ">
                            <div class="p-20 pb-0">
                                <h5 class="card-text text-light mb-10">البلاغات التي تم تحويلها لجهات اخرى</h5>
                                <h4 class="text-light">{{ $data['transferred_incident_count'] }}</h4>
                            </div>
                            <img src="{{ asset('assets/admin/images/card style.svg') }}" alt="triangle with all three sides equal"
                                style="transform: scale(1.7, 1); float: right; ">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100" style="background: #727f9f ;border-radius: 5px;overflow: hidden ">
                    <div class="card-body p-0 ">
                        <div class="clearfix ">
                            <div class="p-20 pb-30">
                                <h5 class="card-text text-light mb-10">البلاغات المشيكة</h5>
                                <h4 class="text-light">{{ $data['checked_incident_count'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100" style="background: #01b9ff ;border-radius: 5px;overflow: hidden ">
                    <div class="card-body p-0 ">
                        <div class="clearfix ">
                            <div class="p-20 pb-30">
                                <h5 class="card-text text-light mb-10">البلاغات الوهمية</h5>
                                <h4 class="text-light">{{ $data['fake_incident_count'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100" style="background: #354262 ;border-radius: 5px;overflow: hidden ">
                    <div class="card-body p-0 ">
                        <div class="clearfix ">
                            <div class="p-20 pb-30">
                                <h5 class="card-text text-light mb-10">عدد البلاغات مطلوب امنياً</h5>
                                <h4 class="text-light">{{ $data['security_wanted_count'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100" style="background: #0361e7 ;border-radius: 5px;overflow: hidden ">
                    <div class="card-body p-0 ">
                        <div class="clearfix ">
                            <div class="p-20 pb-30">
                                <h5 class="card-text text-light mb-10">البلاغات مطلوب امنياً تم حلها</h5>
                                <h4 class="text-light">{{ $data['deleted_security_wanted_count'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="row">

            <div class="col-xl-7 mb-30">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">نسبة احصائيات البلاغات</h5>
                        <div class="chart-wrapper" style="width: 100%; margin: 0 auto;">
                            <div id="canvas-holder">
                                <canvas id="canvas7" width="550"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 mb-30">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">نسبة احصائيات البلاغات</h5>
                        <div class="chart-wrapper" style="width: 100%; margin: 0 auto;">
                            <div id="canvas-holder">
                                <canvas id="canvas6" width="550"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
