@extends('layout.app')

@section('content')
        <div class="main dispatch-form">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">推播時間設定 <span>Setting</span></h3>
                    @include('common.message')
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-cog"></i>設定推播時間
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                @if($timeset->isNotEmpty())
                                                <form class="setting" method="post" action="{{ route('ht.Timeset.store',['organization'=>$organization]) }}">
                                                    @csrf
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">線上預約完成推播時間
                                                            <label class="switch">
                                                                @if($timeset[0]['status'] == 'Y')
                                                                <input type="checkbox" name="online" checked>
                                                                @else
                                                                <input type="checkbox" name="online">
                                                                @endif
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </label>            
                                                        <div class="form-inline mr-l">
                                                            預約完成後，隔<input class="form-control mx-s dayy" type="number" name="onlineDay" value="{{ substr($timeset[0]['days'],-1) }}" min="0">日
                                                            <div class="input-group date time-select">
                                                                <input class="form-control mx-s" placeholder="" readonly="" type="text" name="onlineTime" value="{{ substr($timeset[0]['time'],0,-2) }}"> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                            </div>
                                                            推播
                                                        </div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">預約前一日通知推播時間
                                                            <label class="switch">
                                                                @if($timeset[1]['status'] == 'Y')
                                                                <input type="checkbox" name="reservation" checked>
                                                                @else
                                                                <input type="checkbox" name="reservation">
                                                                @endif
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </label>
                                                        <div class="form-inline mr-l">
                                                            <div class="input-group date time-select">
                                                                <input class="form-control" placeholder="" readonly="" type="text" name="reservationTime" value="{{ substr($timeset[1]['time'],0,-2) }}"> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">滿意度調查推播時間
                                                            <label class="switch">
                                                                @if($timeset[2]['status'] == 'Y')
                                                                <input type="checkbox" name="satisfaction" checked>
                                                                @else
                                                                <input type="checkbox" name="satisfaction">
                                                                @endif
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </label>
                                                        <div class="form-inline mr-l">
                                                            工單完成後，隔<input class="form-control mx-s dayy" type="number" name="satisfactionDay" value="{{ substr($timeset[2]['days'],-1) }}" min="0">日
                                                            <div class="input-group date time-select">
                                                                <input class="form-control mx-s" placeholder="" readonly="" type="text" name="satisfactionTime" value="{{ substr($timeset[2]['time'],0,-2) }}"> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                            </div>
                                                            推播
                                                        </div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">通知主管指派項目
                                                            <label class="switch">
                                                                @if($timeset[3]['status'] == 'Y')
                                                                <input type="checkbox" name="assign" checked>
                                                                @else
                                                                <input type="checkbox" name="assign">
                                                                @endif
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </label>
                                                        <div class="form-inline mr-l">
                                                            每天
                                                            <div class="input-group date time-select">
                                                                <input class="form-control mx-s" placeholder="" readonly="" type="text" name="assignTime" value="{{ substr($timeset[3]['time'],0,-2) }}"> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary">儲存</button>
                                                    </div>
                                                </form>
                                                @else
                                                <form class="setting" method="post" action="{{ route('ht.Timeset.store',['organization'=>$organization]) }}">
                                                    @csrf
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">線上預約完成推播時間
                                                            <label class="switch">
                                                                <input type="checkbox" name="online">
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </label>            
                                                        <div class="form-inline mr-l">
                                                            預約完成後，隔<input class="form-control mx-s dayy" type="number" name="onlineDay" required value="" min="0">日
                                                            <div class="input-group date time-select">
                                                                <input class="form-control mx-s" placeholder="" οnfοcus="this.blur()" type="text" name="onlineTime" value="" required> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                            </div>
                                                            推播
                                                        </div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">預約前一日通知推播時間
                                                            <label class="switch">
                                                                <input type="checkbox" name="reservation">
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </label>
                                                        <div class="form-inline mr-l">
                                                            <div class="input-group date time-select">
                                                                <input class="form-control" placeholder="" οnfοcus="this.blur()" type="text" name="reservationTime" required value=""> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">滿意度調查推播時間
                                                            <label class="switch">
                                                                <input type="checkbox" name="satisfaction">
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </label>
                                                        <div class="form-inline mr-l">
                                                            工單完成後，隔<input class="form-control mx-s dayy" type="number" name="satisfactionDay" value="" min="0" required>日
                                                            <div class="input-group date time-select">
                                                                <input class="form-control mx-s" placeholder="" type="text" required name="satisfactionTime" value=""> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                            </div>
                                                            推播
                                                        </div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">通知主管指派項目
                                                            <label class="switch">
                                                                <input type="checkbox" name="assign">
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </label>
                                                        <div class="form-inline mr-l">
                                                            每天
                                                            <div class="input-group date time-select">
                                                                <input class="form-control mx-s" placeholder="" type="text" required name="assignTime" value=""> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary">儲存</button>
                                                    </div>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')

@endsection