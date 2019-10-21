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
                                            <i class="fas fa-tasks"></i>新增派工清單
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <small>工單編號：190806001</small>
                                                <form id="addCase" method="post" action="{{ route('ht.StrokeManage.assistant.store',['organization'=>$organization]) }}">
                                                    @csrf
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">填表人姓名</label>
                                                        <input type="text" class="form-control" name="name" value="{{auth::user()->name}}" readonly="">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">部門</label>
                                                        <input type="text" class="form-control" name="dept" value="{{auth::user()->department->name}}" readonly="">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">是否為線上預約</label>
                                                        <div class="d-inline mr-m"><input type="radio" name="online" value="W" class="mr-s" checked="">是</div>
                                                        <div class="d-inline mr-m"><input type="radio" name="online" value="N" class="mr-s">否</div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">是否為急件</label>
                                                        <div class="d-inline mr-m"><input type="radio" name="urgent" value="Ture" class="mr-s">是</div>
                                                        <div class="d-inline mr-m"><input type="radio" name="urgent" value="False" class="mr-s" checked="">否</div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">派工類型</label>
                                                        <div class="d-inline mr-m"><input type="checkbox" name="type[]" value="採購飲用水設備" class="mr-s">採購飲用水設備</div>
                                                        <div class="d-inline mr-m"><input type="checkbox" name="type[]" value="採購桶裝水" class="mr-s">採購桶裝水</div>
                                                        <div class="d-inline mr-m"><input type="checkbox" name="type[]" value="更換濾材配件" class="mr-s">更換濾材配件</div>
                                                        <div class="d-inline mr-m"><input type="checkbox" name="type[]" value="維修飲水設備" class="mr-s">維修飲水設備</div>
                                                        <div class="d-inline mr-m"><input type="checkbox" name="type[]" value="保養飲用水設備" class="mr-s">保養飲用水設備</div>
                                                        <div class="d-inline mr-m"><input type="checkbox" name="type[]" value="其它" class="mr-s">其它</div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">客戶代碼</label>
                                                        <input type="text" class="form-control" name="cusKey" placeholder="客戶代碼" required="">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">聯絡地址</label>
                                                        <input type="text" class="form-control" name="address" placeholder="客戶聯絡地址" required="">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">聯絡電話</label>
                                                        <input type="text" class="form-control" name="mobile" placeholder="客戶聯絡電話" required="">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">派工原因</label>
                                                        <input type="text" class="form-control" name="reason" placeholder="派工原因">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">工單日期</label>
                                                        <div class="datetime">
                                                            <div class="input-group date date-select">
                                                                <input class="form-control" placeholder="請選擇日期" name="datetime" type="text" required=""> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">備註</label>
                                                        <input type="text" class="form-control" name="remarks" placeholder="備註">
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