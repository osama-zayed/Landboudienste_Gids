<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar ">
                <ul class="nav navbar-nav side-menu " id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <div class="d-flex justify-content-center align-items-center mt-10">
                        <div class="rounded-circle mb-20" style="width: 100px; height: 100px; overflow: hidden;">
                            <img class="img-fluid" src="{{ asset('assets/admin/images/favicon.ico') }}" alt=""
                                style="object-fit: cover; width: 100%; height: 100%;">
                        </div>
                    </div>
                    <div style="text-align: center; " class="mb-20">
                        <p>osama</p>
                        <p style="color: #797878; font-size: smaller;">osama@gmail.com</p>
                    </div>
                    <li>
                        <a href="{{ route('home') }}">
                            <div class="pull-left"><i class=" ti-view-grid"></i><span class="right-nav-text">الرئيسية
                                </span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('departments.index') }}">
                            <div class="pull-left"><i class="fa fa-bar-chart-o highlight-icon"></i><span class="right-nav-text">الادارات
                                </span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    {{-- 
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">الادارات</li>
                    <!-- menu item Incidents-->
                    
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Incidents">
                            <div class="pull-left"><i class="fa fa-bar-chart-o highlight-icon"></i><span
                                    class="right-nav-text">البلاغات</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Incidents" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('Incident.index') }}">عرض البلاغات</a></li>
                            <li><a href="{{ route('Incident.create') }}">اضافة بلاغ</a></li>
                            <li><a href="{{ route('Incident.index', ['incident_status' => 'أولي']) }}">البلاغات
                                    الأولية</a></li>
                            <li><a href="{{ route('Incident.index', ['incident_status' => 'تكميلي']) }}">البلاغات
                                    التكميلية</a></li>
                            <li><a href="{{ route('Incident.index', ['incident_status' => 'محول']) }}">البلاغات
                                    المحولة</a></li>
                            <li><a href="{{ route('Incident.index', ['incident_status' => 'مشيك']) }}">البلاغات
                                    المشيكة</a></li>
                            <li><a href="{{ route('Incident.index', ['incident_status' => 'وهمي']) }}">البلاغات
                                    الوهمية</a></li>
                            <li><a href="{{ route('Incident_deleted') }}">ارشيف البلاغات</a></li>
                        </ul>
                    </li>
                    <!-- menu item Department-->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">التقارير</li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Department-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">التقارير</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Department-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('report_Incident') }}">تقرير البلاغات</a> </li>
                            <li> <a href="{{ route('report_Department') }}">تقرير الاقسام</a> </li>
                        </ul>
                    </li>
                    @if (auth()->user()->user_type == 'admin')
                        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">المستخدمين</li>
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#authentication">
                                <div class="pull-left"><i class="ti-id-badge"></i><span
                                        class="right-nav-text">المستخدمين</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="authentication" class="collapse" data-parent="#sidebarnav">
                                <li> <a href="{{ route('user.index') }}">قائمة المستخدمين</a> </li>
                                <li> <a href="{{ route('user.create') }}">اضافة مستخدم</a> </li>
                                <li> <a href="{{ route('Activity') }}">سجل الانشطة</a> </li>
                            </ul>
                        </li>
                    @endif
                    @if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'incidentOfficer')
                        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">المركز</li>
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Centre">
                                <div class="pull-left"><i class="ti-calendar"></i><span
                                        class="right-nav-text">المركز</span>
                                </div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="Centre" class="collapse" data-parent="#sidebarnav">
                                @if (auth()->user()->user_type == 'admin')
                                    <li> <a href="{{ route('Department.index') }}">اقسام الشرطة</a> </li>
                                @endif
                                <li> <a href="{{ route('Crime.index') }}">الجرائم</a> </li>
                            </ul>
                        </li>
                    @endif

                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">مطلوب امنياُ</li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Security-wanted">
                            <div class="pull-left"><i class="ti-calendar"></i><span class="right-nav-text">مطلوب
                                    امنياً</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Security-wanted" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('Security_wanted.index') }}">قائمة البلاغات مطلوب امنياً</a> </li>
                            <li> <a href="{{ route('Security_wanted.create') }}">اضافة مطلوب امنياً</a> </li>
                            <li> <a href="{{ route('Security_wanted_deleted') }}">بيانات المطلوبين امنياً المؤرشفة</a>
                            </li>
                        </ul>
                    </li> --}}
                </ul>
            </div>
        </div>
