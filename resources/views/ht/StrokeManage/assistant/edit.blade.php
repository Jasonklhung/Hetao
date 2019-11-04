@extends('layout.app')

@section('content')
        <div class="main dispatch-form">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">行程管理 <span>Management</span></h3>
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-tasks"></i>編輯派工清單
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">

                                                <small>工單編號：{{$res->id}}</small>
                                                <form method="post" action="{{ route('ht.StrokeManage.assistant.update',['organization'=>$organization]) }}">
                                                    @csrf
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">派工類型</label>
                                                        <input type="text" name="work_type" class="form-control" placeholder="派工類型" value="{{$res->work_type}}">
                                                        <input type="hidden" name="id" class="form-control" placeholder="工單編號" value="{{$res->id}}">
                                                        <input type="hidden" name="name" class="form-control" placeholder="聯絡人" value="{{$res->name}}">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">客戶代碼</label>
                                                        <input type="text" name="CUSTKEY" class="form-control" placeholder="客戶代碼" value="{{$res->CUSTKEY}}">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">聯絡地址</label>
                                                        <input type="text" name="address" class="form-control" placeholder="客戶聯絡地址" value="{{$res->address}}">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">聯絡電話</label>
                                                        <input type="text" name="mobile" class="form-control" placeholder="客戶聯絡電話" value="{{$res->mobile}}">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">派工原因</label>
                                                        <input type="text" name="remarks" class="form-control" placeholder="派工原因" value="{{$res->remarks}}">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">工單日期</label>
                                                        <div class="datetime">
                                                            <div class="input-group date date-select">
                                                                <input class="form-control" name="time" placeholder="請選擇日期" type="text" value="{{$res->time}}"> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('ht.StrokeManage.assistant.index',['organization'=>$organization]) }}"><button type="button" class="btn btn-default">返回</button></a>
                                                        <button type="submit" class="btn btn-primary">儲存</button>
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