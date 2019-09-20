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
                                                <small>工單編號：190806001</small>
                                                <form>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">派工類型</label>
                                                        <div class="d-inline mr-m"><input type="checkbox" name="type" class="mr-s" checked>採購飲用水設備</div>
                                                        <div class="d-inline mr-m"><input type="checkbox" name="type" class="mr-s">採購桶裝水</div>
                                                        <div class="d-inline mr-m"><input type="checkbox" name="type" class="mr-s">更換濾材配件</div>
                                                        <div class="d-inline mr-m"><input type="checkbox" name="type" class="mr-s">維修飲水設備</div>
                                                        <div class="d-inline mr-m"><input type="checkbox" name="type" class="mr-s">保養飲用水設備</div>
                                                        <div class="d-inline mr-m"><input type="checkbox" name="type" class="mr-s">其它</div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">客戶代碼</label>
                                                        <input type="text" class="form-control" placeholder="客戶代碼" value="楊梅國中">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">聯絡地址</label>
                                                        <input type="text" class="form-control" placeholder="客戶聯絡地址" value="楊梅區秀才路919號">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">聯絡電話</label>
                                                        <input type="text" class="form-control" placeholder="客戶聯絡電話" value="03-3322101">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">派工原因</label>
                                                        <input type="text" class="form-control" placeholder="派工原因" value="  載清缸 宿舍1.3樓+教學1樓右邊">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">工單日期</label>
                                                        <div class="datetime">
                                                            <div class="input-group date date-select">
                                                                <input class="form-control" placeholder="請選擇日期" type="text" value="2019-10-11 10:05"> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <a href="assistant.html"><button type="button" class="btn btn-default">返回</button></a>
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