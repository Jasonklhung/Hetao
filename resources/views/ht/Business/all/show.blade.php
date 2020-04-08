@extends('layout.app')

@section('content')
		<div class="main case">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">業務管理</h3>
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-briefcase"></i>全站業務 - 案件紀錄
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <form>
                                                    <p class="mx-s my-s">業務人員：王小明</p>
                                                    <div class="text-primary mx-s"><h4 class="bd-bottom">基本資料 <i class="fas fa-caret-right"></i></h4></div>
                                                    <div>
                                                        <div class="col-sm-4">
                                                            <div class="form-item">
                                                                <label class="d-block">拜訪日期</label>
                                                                <div class="datetime">
                                                                    <div class="input-group date day-set">
                                                                        <input class="form-control" placeholder="請選擇日期" type="text" disabled> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">客戶名稱</label>
                                                                <input type="text" class="form-control" value="曾曾" disabled>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">客戶等級</label>
                                                                <select class="form-control mr-s" disabled>
                                                                    <option selected hidden disabled value="">請選擇</option>
                                                                    <option value="">A</option>
                                                                    <option value="">B</option>
                                                                    <option value="">C</option>
                                                                    <option value="">D</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">案件進度</label>
                                                                <select class="form-control mr-s" disabled>
                                                                    <option selected hidden disabled value="">請選擇</option>
                                                                    <option value=""></option>
                                                                    <option value=""></option>
                                                                    <option value=""></option>
                                                                    <option value=""></option>
                                                                </select>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">客戶類別</label>
                                                                <select class="form-control mr-s" disabled>
                                                                    <option selected hidden disabled value="">請選擇</option>
                                                                    <option value=""></option>
                                                                    <option value=""></option>
                                                                    <option value=""></option>
                                                                    <option value=""></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-item">
                                                                <label class="d-block">承辦人</label>
                                                                <input type="text" class="form-control" value="曾曾" disabled>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">電話</label>
                                                                <input type="text" class="form-control" placeholder="" disabled>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">地址</label>
                                                                <div class="d-flex mb-s">
                                                                    <select class="form-control mr-s" disabled>
                                                                        <option selected hidden disabled value="">縣市</option>
                                                                    </select>

                                                                    <select class="form-control ml-s" disabled>
                                                                        <option selected hidden disabled value="">鄉鎮市</option>
                                                                    </select>
                                                                </div>    
                                                                <input type="text" class="form-control" placeholder="地址" disabled>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">統編</label>
                                                                <input type="number" class="form-control" placeholder="" disabled>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">信箱</label>
                                                                <input type="email" class="form-control" placeholder="" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-item">
                                                                <label class="d-block">覆訪日期</label>
                                                                <div class="datetime">
                                                                    <div class="input-group date day-set">
                                                                        <input class="form-control" placeholder="請選擇日期" type="text" disabled> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">結果</label>
                                                                <select class="form-control mr-s result" disabled>
                                                                    <option selected hidden disabled value="">請選擇</option>
                                                                    <option value="流單">流單</option>
                                                                    <option value=""></option>
                                                                    <option value=""></option>
                                                                    <option value=""></option>
                                                                </select>
                                                            </div>
                                                            <div class="form-item reason" style="display: none;">
                                                                <label class="d-block">原因</label>
                                                                <input type="text" class="form-control" placeholder="" disabled>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">備註</label>
                                                                <textarea rows="5" class="form-control" placeholder="" disabled></textarea>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="text-primary mx-s clear"><h4 class="bd-bottom">訂單明細 <i class="fas fa-caret-right"></i></h4></div>
                                                    <div class="bd-bottom p-s mx-s overflow-x">
                                                        <table class="w-100 my-s text-center table-hover" id="showlist">
                                                            <tr>
                                                                <th class="text-center pb-s">項目</th>
                                                                <th class="text-center pb-s">產品型號</th>
                                                                <th class="text-center pb-s">單價(含稅)</th>
                                                                <th class="text-center pb-s">數量</th>
                                                                <th class="text-center pb-s">合計</th>
                                                                <th class="text-center pb-s">說明</th>
                                                            </tr>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>UW-999</td>
                                                                <td>$ 28000</td>
                                                                <td>1</td>
                                                                <td>$ 28000</td>
                                                                <td>純水系統</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="p-s text-center">
                                                        總價款：28000元
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

@section('modal')

@endsection

@section('scripts')

@endsection