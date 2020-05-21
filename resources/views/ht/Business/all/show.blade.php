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
                                                <form id="trackFrom">
                                                    <div class="text-primary mx-s">
                                                        <h4 class="bd-bottom">基本資料 <i class="fas fa-caret-right"></i></h4>
                                                    </div>
                                                    <div>
                                                        <div class="col-sm-4">
                                                            <div class="form-item">
                                                                <label class="d-block">拜訪日期</label>
                                                                <div class="datetime">
                                                                    <div class="input-group date day-set">
                                                                        <input class="form-control" placeholder="請選擇日期" type="text" name="date" value="{{$track[0]['date']}}" disabled=""> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">客戶名稱</label>
                                                                <input type="text" class="form-control" name="name" value="{{$track[0]['name']}}" disabled="">
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">客戶等級</label>
                                                                <select class="form-control mr-s" name="level" disabled="">
                                                                    <option selected hidden disabled value="">請選擇</option>
                                                                    @if($case_track->level == 'A')
                                                                    <option value="A" selected="">A</option>
                                                                    <option value="B">B</option>
                                                                    <option value="C">C</option>
                                                                    <option value="D">D</option>
                                                                    @elseif($case_track == 'B')
                                                                    <option value="A">A</option>
                                                                    <option value="B" selected="">B</option>
                                                                    <option value="C">C</option>
                                                                    <option value="D">D</option>
                                                                    @elseif($case_track == 'C')
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                    <option value="C" selected="">C</option>
                                                                    <option value="D">D</option>
                                                                    @elseif($case_track == 'D')
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                    <option value="C">C</option>
                                                                    <option value="D" selected="">D</option>
                                                                    @else
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                    <option value="C">C</option>
                                                                    <option value="D">D</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">案件進度</label>
                                                                <select class="form-control mr-s" name="schedule" disabled="">
                                                                    <option selected hidden disabled value="">請選擇</option>
                                                                    @if($case_track->schedule == '尚未找到窗口')
                                                                    <option value="尚未找到窗口" selected="">尚未找到窗口</option>
                                                                    <option value="已拜訪介紹">已拜訪介紹</option>
                                                                    <option value="已報價">已報價</option>
                                                                    <option value="已成待裝機">已成待裝機</option>
                                                                    <option value="已裝機完成">已裝機完成</option>
                                                                    <option value="已收款">已收款</option>
                                                                    @elseif($case_track == '已拜訪介紹')
                                                                    <option value="尚未找到窗口">尚未找到窗口</option>
                                                                    <option value="已拜訪介紹" selected="">已拜訪介紹</option>
                                                                    <option value="已報價">已報價</option>
                                                                    <option value="已成待裝機">已成待裝機</option>
                                                                    <option value="已裝機完成">已裝機完成</option>
                                                                    <option value="已收款">已收款</option>
                                                                    @elseif($case_track == '已報價')
                                                                    <option value="尚未找到窗口">尚未找到窗口</option>
                                                                    <option value="已拜訪介紹">已拜訪介紹</option>
                                                                    <option value="已報價" selected="">已報價</option>
                                                                    <option value="已成待裝機">已成待裝機</option>
                                                                    <option value="已裝機完成">已裝機完成</option>
                                                                    <option value="已收款">已收款</option>
                                                                    @elseif($case_track == '已成待裝機')
                                                                    <option value="尚未找到窗口">尚未找到窗口</option>
                                                                    <option value="已拜訪介紹">已拜訪介紹</option>
                                                                    <option value="已報價">已報價</option>
                                                                    <option value="已成待裝機" selected="">已成待裝機</option>
                                                                    <option value="已裝機完成">已裝機完成</option>
                                                                    <option value="已收款">已收款</option>
                                                                    @elseif($case_track == '已裝機完成')
                                                                    <option value="尚未找到窗口">尚未找到窗口</option>
                                                                    <option value="已拜訪介紹">已拜訪介紹</option>
                                                                    <option value="已報價">已報價</option>
                                                                    <option value="已成待裝機">已成待裝機</option>
                                                                    <option value="已裝機完成" selected="">已裝機完成</option>
                                                                    <option value="已收款">已收款</option>
                                                                    @elseif($case_track == '已收款')
                                                                    <option value="尚未找到窗口">尚未找到窗口</option>
                                                                    <option value="已拜訪介紹">已拜訪介紹</option>
                                                                    <option value="已報價">已報價</option>
                                                                    <option value="已成待裝機">已成待裝機</option>
                                                                    <option value="已裝機完成">已裝機完成</option>
                                                                    <option value="已收款" selected="">已收款</option>
                                                                    @else
                                                                    <option value="尚未找到窗口">尚未找到窗口</option>
                                                                    <option value="已拜訪介紹">已拜訪介紹</option>
                                                                    <option value="已報價">已報價</option>
                                                                    <option value="已成待裝機">已成待裝機</option>
                                                                    <option value="已裝機完成">已裝機完成</option>
                                                                    <option value="已收款">已收款</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">客戶類別</label>
                                                                <select class="form-control mr-s" name="category" disabled="">
                                                                    <option selected hidden disabled value="">請選擇</option>
                                                                    @if($case_track->category == '公家機關')
                                                                    <option value="公家機關" selected="">公家機關</option>
                                                                    <option value="商用">商用</option>
                                                                    <option value="家用">家用</option>
                                                                    <option value="醫療">醫療</option>
                                                                    <option value="中信局">中信局</option>
                                                                    @elseif($case_track->category == '商用')
                                                                    <option value="公家機關">公家機關</option>
                                                                    <option value="商用" selected="">商用</option>
                                                                    <option value="家用">家用</option>
                                                                    <option value="醫療">醫療</option>
                                                                    <option value="中信局">中信局</option>
                                                                    @elseif($case_track->category == '家用')
                                                                    <option value="公家機關">公家機關</option>
                                                                    <option value="商用">商用</option>
                                                                    <option value="家用" selected="">家用</option>
                                                                    <option value="醫療">醫療</option>
                                                                    <option value="中信局">中信局</option>
                                                                    @elseif($case_track->category == '醫療')
                                                                    <option value="公家機關">公家機關</option>
                                                                    <option value="商用">商用</option>
                                                                    <option value="家用">家用</option>
                                                                    <option value="醫療" selected="">醫療</option>
                                                                    <option value="中信局">中信局</option>
                                                                    @elseif($case_track->category == '中信局')
                                                                    <option value="公家機關">公家機關</option>
                                                                    <option value="商用">商用</option>
                                                                    <option value="家用">家用</option>
                                                                    <option value="醫療">醫療</option>
                                                                    <option value="中信局" selected="">中信局</option>
                                                                    @else
                                                                    <option value="公家機關">公家機關</option>
                                                                    <option value="商用">商用</option>
                                                                    <option value="家用">家用</option>
                                                                    <option value="醫療">醫療</option>
                                                                    <option value="中信局">中信局</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-item">
                                                                <label class="d-block">承辦人</label>
                                                                <input type="text" class="form-control" name="touch" value="{{ $case_track->touch }}" disabled="">
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">電話</label>
                                                                <input type="text" class="form-control" placeholder="" name="phone" value="{{ $track[0]['phone'] }}" disabled="">
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">地址</label>
                                                                <div class="d-flex mb-s">
                                                                    <select class="form-control mr-s area1" name="city" disabled="">
                                                                        <option selected value="{{ $track[0]['city'] }}">{{ $track[0]['city'] }}</option>
                                                                    </select>
                                                                    <select class="form-control ml-s area2" name="area" disabled="">
                                                                        <option selected value="{{ $track[0]['area'] }}">{{ $track[0]['area'] }}</option>
                                                                    </select>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="地址" name="address" value="{{ $track[0]['address'] }}" disabled="">
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">統編</label>
                                                                <input type="number" class="form-control" placeholder="" name="uniform_numbers" value="{{ $case_track->uniform_numbers }}" disabled="">
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">信箱</label>
                                                                <input type="email" class="form-control" placeholder="" name="email" value="{{ $case_track->email }}" disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-item">
                                                                <label class="d-block">覆訪日期 <a class="float-right" href="#" data-toggle="modal" data-target="#person-e"><i class="fas fa-bell"></i> 通知</a></label>
                                                                <div class="datetime">
                                                                    <div class="input-group date day-set">
                                                                        <input class="form-control" placeholder="請選擇日期" type="text" name="date_again" value="{{ $case_track->date_again }}" disabled=""> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">結果</label>
                                                                <select class="form-control mr-s result" name="result" disabled="">
                                                                    <option selected hidden disabled value="">請選擇</option>
                                                                    @if($case_track->result == '成交')
                                                                    <option value="成交" selected="">成交</option>
                                                                    <option value="流單">流單</option>
                                                                    <option value="其他">其他</option>
                                                                    @elseif($case_track->result == '流單')
                                                                    <option value="成交">成交</option>
                                                                    <option value="流單" selected="">流單</option>
                                                                    <option value="其他">其他</option>
                                                                    @elseif($case_track->result == '其他')
                                                                    <option value="成交">成交</option>
                                                                    <option value="流單">流單</option>
                                                                    <option value="其他" selected="">其他</option>
                                                                    @else
                                                                    <option value="成交">成交</option>
                                                                    <option value="流單">流單</option>
                                                                    <option value="其他">其他</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            @if($case_track->result == '流單')
                                                            <div class="form-item reason">
                                                                <label class="d-block">原因</label>
                                                                <input type="text" class="form-control" placeholder="" name="reason" value="{{ $case_track->reason }}" disabled="">
                                                            </div>
                                                            @else
                                                            <div class="form-item reason" style="display: none;">
                                                                <label class="d-block">原因</label>
                                                                <input type="text" class="form-control" placeholder="" name="reason" value="{{ $case_track->reason }}">
                                                            @endif
                                                            <div class="form-item">
                                                                <label class="d-block">備註</label>
                                                                <textarea rows="5" class="form-control" placeholder="" disabled="" name="other">{{ $case_track->other }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-primary mx-s clear">
                                                        <h4 class="bd-bottom">訂單明細 <i class="fas fa-caret-right"></i></h4>
                                                    </div>
                                                    <div class="bd-bottom p-s mx-s overflow-x">
                                                        <table class="w-100 my-s text-center table-hover" id="showlist">
                                                            <tbody>
                                                                <tr>
                                                                    <th class="text-center p-s text-nowrap">項目</th>
                                                                    <th class="text-center p-s text-nowrap">產品型號</th>
                                                                    <th class="text-center p-s text-nowrap">單價(含稅)</th>
                                                                    <th class="text-center p-s text-nowrap">數量</th>
                                                                    <th class="text-center p-s text-nowrap">合計</th>
                                                                    <th class="text-center p-s text-nowrap">說明</th>
                                                                </tr>
                                                            </tbody>
                                                                @php
                                                                    $alltotal = 0;
                                                                @endphp
                                                            @foreach($detail as $key => $data)
                                                                @php
                                                                    $alltotal += $data->total;
                                                                @endphp
                                                            <tr>
                                                                <td>{{$key+1}}</td>
                                                                <td>{{$data->numbers}}</td>
                                                                <td>$ {{$data->money}}</td>
                                                                <td>{{$data->quantity}}</td>
                                                                <td>$ {{$data->total}}</td>
                                                                <td>{{$data->description}}</td>
                                                            </tr>
                                                            @endforeach
                                                            <!-- <tr>
                                                                <td>1</td>
                                                                <td>UW-999</td>
                                                                <td>$ 28000</td>
                                                                <td>1</td>
                                                                <td>$ 28000</td>
                                                                <td>純水系統</td>
                                                                <td><a href="#"><i class="fas fa-minus-circle text-danger"></i></a></td>
                                                            </tr> -->
                                                        </table>
                                                    </div>
                                                    <div class="p-s text-center alltotal">
                                                        總價款：{{$alltotal}}
                                                    </div>
                                                    <div class="col-sm-12 mb-s">
                                                        <a href="{{ route('ht.Business.all.index',['organization'=>$organization]) }}"><button type="button" class="btn btn-default">返回</button></a>
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