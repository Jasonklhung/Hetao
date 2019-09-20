@extends('layout.app')

@section('content')
        <div class="main dispatch-form">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">推播時間設定 <span>Setting</span></h3>
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
                                                <form class="setting">
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">線上預約完成推播時間
                                                            <label class="switch">
                                                                <input type="checkbox" checked>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </label>
                                                        <div class="form-inline mr-l">
                                                            預約完成後，隔<input class="form-control mx-s dayy" type="number" value="1" min="0">日
                                                            <div class="input-group date time-select">
                                                                <input class="form-control mx-s" placeholder="" type="text" value="10:00"> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                            </div>
                                                            推播
                                                        </div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">預約前一日通知推播時間
                                                            <label class="switch">
                                                                <input type="checkbox" checked>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </label>
                                                        <div class="form-inline mr-l">
                                                            <div class="input-group date time-select">
                                                                <input class="form-control" placeholder="" type="text" value="10:00"> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">滿意度調查推播時間
                                                            <label class="switch">
                                                                <input type="checkbox" checked>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </label>
                                                        <div class="form-inline mr-l">
                                                            工單完成後，隔<input class="form-control mx-s dayy" type="number" value="1" min="0">日
                                                            <div class="input-group date time-select">
                                                                <input class="form-control mx-s" placeholder="" type="text" value="10:00"> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                            </div>
                                                            推播
                                                        </div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">通知主管指派項目
                                                            <label class="switch">
                                                                <input type="checkbox" checked>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </label>
                                                        <div class="form-inline mr-l">
                                                            每天
                                                            <div class="input-group date time-select">
                                                                <input class="form-control mx-s" placeholder="" type="text" value="10:00"> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <button type="button" class="btn btn-primary">儲存</button>
                                                    </div>
                                                </form>
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