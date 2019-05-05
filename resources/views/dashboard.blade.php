@extends('admin_layouts.inc')

@section('title','لوحة التحكم')
@section('header','لوحة التحكم')
@section('head_description','الأحصائيات, الأشكال البيانيه والتقرير')
@section('breadcrumb','لوحة التحكم')
@section('content')
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                              <a href="javascript:;">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                        <span data-counter="counterup" data-value="{{ $ordersUnderPreparing }}"></span>
                                        </h3>
                                        <small>الطلبات قيد التجهيز</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-truck"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: {{ $ordersUnderPreparing }}%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">{{ $ordersUnderPreparing }}%</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-number"> {{ $ordersUnderPreparing }}% </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                             <a href="javascript:;">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze">
                                        <span data-counter="counterup" data-value="{{ $ordersCancelled }}"></span>
                                        </h3>
                                        <small>الطلبات المنتهيه</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-truck"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: {{ $ordersCancelled }}%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">{{ $ordersCancelled }}%</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-number"> {{ $ordersCancelled }}% </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                             <a href="javascript:;">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
                                          <span data-counter="counterup" data-value="{{ $users }}"></span>
                                        </h3>
                                        <small>المستخدمين</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-truck"></i>
                                    </div>
                                </div>
                                 <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: {{ $users }}%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">{{ $users }}%</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-number"> {{ $users }}% </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                             <a href="javascript:;">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-purple-soft">
                                            <span data-counter="counterup" data-value="{{ $promocodes }}"></span>
                                        </h3>
                                        <small>كوبونات الخصم</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-male"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: {{ $promocodes }}%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">{{ $promocodes }}%</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-number"> {{ $promocodes }}% </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>

                    <!-- END PAGE BASE CONTENT -->
@endsection