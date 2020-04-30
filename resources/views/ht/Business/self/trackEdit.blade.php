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
                                            <i class="fas fa-briefcase"></i>個人業務 - 案件紀錄
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
                                                                        <input class="form-control" placeholder="請選擇日期" type="text" name="date" value="{{$track[0]['date']}}"> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">客戶名稱</label>
                                                                <input type="text" class="form-control" name="name" value="{{$track[0]['name']}}">
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">客戶等級</label>
                                                                <select class="form-control mr-s" name="level">
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
                                                                <select class="form-control mr-s" name="schedule">
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
                                                                <select class="form-control mr-s" name="category">
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
                                                                <input type="text" class="form-control" name="touch" value="{{ $case_track->touch }}">
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">電話</label>
                                                                <input type="text" class="form-control" placeholder="" name="phone" value="{{ $track[0]['phone'] }}">
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">地址</label>
                                                                <div class="d-flex mb-s">
                                                                    <select class="form-control mr-s area1" name="city">
                                                                        <option selected value="{{ $track[0]['city'] }}">{{ $track[0]['city'] }}</option>
                                                                    </select>
                                                                    <select class="form-control ml-s area2" name="area">
                                                                        <option selected value="{{ $track[0]['area'] }}">{{ $track[0]['area'] }}</option>
                                                                    </select>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="地址" name="address" value="{{ $track[0]['address'] }}">
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">統編</label>
                                                                <input type="number" class="form-control" placeholder="" name="uniform_numbers" value="{{ $case_track->uniform_numbers }}">
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">信箱</label>
                                                                <input type="email" class="form-control" placeholder="" name="email" value="{{ $case_track->email }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-item">
                                                                <label class="d-block">覆訪日期 <a class="float-right" href="#" data-toggle="modal" data-target="#person-e"><i class="fas fa-bell"></i> 通知</a></label>
                                                                <div class="datetime">
                                                                    <div class="input-group date day-set">
                                                                        <input class="form-control" placeholder="請選擇日期" type="text" name="date_again" value="{{ $case_track->date_again }}"> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">結果</label>
                                                                <select class="form-control mr-s result" name="result">
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
                                                            <div class="form-item reason" style="display: none;">
                                                                <label class="d-block">原因</label>
                                                                <input type="text" class="form-control" placeholder="" name="reason" value="{{ $case_track->reason }}">
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">備註</label>
                                                                <textarea rows="5" class="form-control" placeholder="" name="other">{{ $case_track->other }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-primary mx-s clear">
                                                        <h4 class="bd-bottom">訂單明細 <i class="fas fa-caret-right"></i><a class="opadd" href="#" data-toggle="modal" data-target="#addlist"><i class="fas fa-plus-circle float-right"></i></a></h4>
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
                                                                    <th class="text-center p-s text-nowrap"></th>
                                                                </tr>
                                                            </tbody>
                                                            @foreach($detail as $key => $data)
                                                            <tr>
                                                                <td>{{$key+1}}</td>
                                                                <td>{{$data->numbers}}</td>
                                                                <td>$ {{$data->money}}</td>
                                                                <td>{{$data->quantity}}</td>
                                                                <td>$ {{$data->total}}</td>
                                                                <td>{{$data->description}}</td>
                                                                <td><a href="javascript:void(0)" class="del" onclick="remove_item(<?php echo $key ?>)"><i class="fas fa-minus-circle text-danger"></i><a></td>
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
                                                        總價款：
                                                    </div>
                                                    <div class="col-sm-12 mb-s">
                                                        <a href="{{ route('ht.Business.self.index',['organization'=>$organization]) }}"><button type="button" class="btn btn-default">返回</button></a>
                                                        <button type="submit" class="btn btn-primary">更新</button>
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
<!-- modal addlist -->
    <div id="addlist" class="modal fade Overview-set" role="dialog" style="z-index: 9999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <div class="modal-body">
                    <form action="">
                        <ul>
                            <li class="mb-s">
                                <span class="mb-xs">產品型號</span>
                                <input class="form-control type" type="text" placeholder="">
                            </li>
                            <li class="mb-s dollar">
                                <span class="mb-xs">單價</span>
                                <input class="form-control price" type="number" placeholder="">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">數量</span>
                                <input class="form-control quantity" type="number" placeholder="">
                            </li>
                            <li class="mb-s dollar">
                                <span class="mb-xs">合計</span>
                                <input class="form-control total" type="number" placeholder="">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">說明</span>
                                <input class="form-control intro" type="text" placeholder="">
                            </li>
                            <li class="text-center"><button type="button" class="btn btn-danger">取消</button><button type="button" class="btn btn-primary ok" data-dismiss="modal">新增</button></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 編輯通知 -->
    <div id="person-e" class="modal fade Overview-set" role="dialog" style="z-index: 9999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <div class="modal-body">
                    <form action="">
                        <ul>
                            <li class="mb-s">
                                <span class="mb-xs">標題</span>
                                <input class="form-control" type="text" placeholder="輸入標題" value="A公司拜訪">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">內容</span>
                                <textarea class="form-control" rows="1" placeholder="輸入內容">A公司拜訪</textarea>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">通知時間</span>
                                <div class="d-block">
                                    <input class="choose" id="choose1-2" type="radio" name="at-2" value="單次" num="1-2" checked>
                                    <label for="choose1-2" class="chooseitem mr-s">單次</label>
                                    <input class="choose" id="choose2-2" type="radio" name="at-2" value="每日" num="2-2">
                                    <label for="choose2-2" class="chooseitem ml-s mr-s">每日</label>
                                    <input class="choose" id="choose3-2" type="radio" name="at-2" value="每週" num="3-2">
                                    <label for="choose3-2" class="chooseitem ml-s mr-s">每週</label>
                                    <input class="choose" id="choose4-2" type="radio" name="at-2" value="每月" num="4-2">
                                    <label for="choose4-2" class="chooseitem ml-s">每月</label>
                                    <input class="choose" id="choose5-2" type="radio" name="at-2" value="不通知" num="5-2">
                                    <label for="choose5-2" class="chooseitem ml-s">不通知</label>
                                </div>
                                <div class="">
                                    <!-- 單次 -->
                                    <div class="i1-2">
                                        <input type="text" class="date-set form-control">
                                    </div>
                                    <!-- 每日 -->
                                    <div class="i2-2 d-none">
                                        <p>開始日期</p>
                                        <input type="text" class="date-set form-control">
                                    </div>
                                    <!-- 每週 -->
                                    <div class="i3-2 d-none">
                                        <p>開始日期</p>
                                        <input type="text" class="day-set form-control mb-s">
                                        <div class="form-inline mb-s">
                                            每隔<input class="form-control mx-s dayy" type="number" value="1" min="1">週
                                            <button type="button" class="btn add-member week-b">+ 新增</button>
                                        </div>
                                        <div class="weekwrap">
                                            <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                                <select name="" id="" class="form-control my-xs">
                                                    <option value="">星期一</option>
                                                    <option value="">星期二</option>
                                                    <option value="">星期三</option>
                                                    <option value="">星期四</option>
                                                    <option value="">星期五</option>
                                                    <option value="">星期六</option>
                                                    <option value="">星期日</option>
                                                </select>
                                                <input type="text" class="time-set form-control my-xs">
                                                <button class="close my-xs" type="button">×</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 每月 -->
                                    <div class="i4-2 d-none">
                                        <p>開始日期</p>
                                        <input type="text" class="date-set form-control">
                                    </div>
                                </div>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">通知對象</span>
                                <div class="d-flex">
                                    <select class='form-control mb-s company mr-s'>
                                        <option selected disabled hidden value="">分公司</option>
                                        <option>台北</option>
                                        <option>新北</option>
                                        <option>桃園</option>
                                        <option>台中</option>
                                        <option>台南</option>
                                        <option>高雄</option>
                                    </select>
                                    <select class='form-control mb-s role mr-s' disabled="disabled">
                                        <option selected hidden value="">職稱</option>
                                        <option value="助理">助理</option>
                                        <option value="主管">主管</option>
                                        <option value="員工">員工</option>
                                    </select>
                                    <select class='form-control mb-s staffname' disabled="disabled">
                                        <option selected hidden value="">員工名稱</option>
                                        <option value="小美">小美</option>
                                        <option value="小王">小王</option>
                                        <option value="小名">小名</option>
                                        <option value="小強">小強</option>
                                        <option value="小花">小花</option>
                                        <option value="小白">小白</option>
                                    </select>
                                </div>
                                <button type="button" class="btn add-member meet">+ 新增</button>
                                <div class="memberwrap">
                                </div>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">類型</span>
                                <select class="form-control">
                                    <option value="">一般</option>
                                    <option value="">覆訪</option>
                                </select>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">備註</span>
                                <textarea class="form-control" rows="1" placeholder="輸入備註"></textarea>
                            </li>
                            <li class="text-center"><button type="button" class="btn btn-danger">取消</button><button type="button" class="btn btn-primary" data-dismiss="modal">確認</button></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    ///////訂單明細新增刪除欄位

    //加總
    function alltotal() {
        var sum = 0;
        if ($('.item').length!==0) {
            for (var i = 0; i < arr.length; i++) {
                sum += parseInt(arr[i].total);
                var alltotal = sum
                $('.alltotal').html('總價款：' + alltotal);
            }

        } else {
            $('.alltotal').html('總價款：' + '');
        }
    }

    //合計自動代入
    $('body').on('keyup', '#addlist .quantity, #addlist .price', function() {
        var price = $('#addlist .price').val()
        var quantity = $('#addlist .quantity').val()
        var total = $('#addlist .total').val(price * quantity)
        total

    });
    //清單物件
    var arr = []
    var imp = []
    var _id
    var _num
    var _type
    var _price
    var _quantity
    var _total
    var _intro
    var _del
    //清單模板
    var item = `
            <tr class="item" id=val_`+_id+`>
                <td class="text-nowrap">`+_num+`</td>
                <td class="text-nowrap">`+_type+`</td>
                <td class="text-nowrap">`+_price+`</td>
                <td class="text-nowrap">`+_quantity+`</td>
                <td class="total-s text-nowrap">`+_total+`</td>
                <td class="text-nowrap">`+_intro+`</td>
                <td><a href="javascript:void(0)" class="del" del=`+_del+`><i class="fas fa-minus-circle text-danger"></i><a></td>
            </tr>`
    //每次新增清空表單        
    $('.opadd').click(function() {
        $('#addlist .price').val('');
        $('#addlist .quantity').val('');
        $('#addlist .total').val('');
        $('#addlist .type').val('');
        $('#addlist .intro').val('');
    });
    //確認新增判斷有填直才push內容
    $('#addlist .ok').on('click', function() {
        var price = $('#addlist .price').val()
        var quantity = $('#addlist .quantity').val()
        var total = $('#addlist .total').val()
        var type = $('#addlist .type').val()
        var intro = $('#addlist .intro').val()

        if ((price || quantity || total || type || intro) !== "") {
            arr.push({ price, quantity, total, type, intro })
            showlist();
        }

        alltotal()

    });

       //顯示清單
    function showlist() {
        var price = $('#addlist .price').val()
        var quantity = $('#addlist .quantity').val()
        var total = $('#addlist .total').val()
        var type = $('#addlist .type').val()
        var intro = $('#addlist .intro').val()

        $('#showlist').html(`<tr>
                                <th class="text-center p-s text-nowrap">項目</th>
                                <th class="text-center p-s text-nowrap">產品型號</th>
                                <th class="text-center p-s text-nowrap">單價(含稅)</th>
                                <th class="text-center p-s text-nowrap">數量</th>
                                <th class="text-center p-s text-nowrap">合計</th>
                                <th class="text-center p-s text-nowrap">說明</th>
                                <th class="text-center p-s text-nowrap"></th>
                            </tr>`)
        for (var i = 0; i < arr.length; i++) {

            var c_item = item.replace(_id, i)
                .replace(_num, i + 1)
                .replace(_type, arr[i].type)
                .replace(_price, arr[i].price)
                .replace(_quantity, arr[i].quantity)
                .replace(_total, arr[i].total)
                .replace(_intro, arr[i].intro)
                .replace(_del, i);

            $('#showlist tbody').append(c_item);


            $(".del[del=" + i + "]").click(
                function() {
                    remove_item(parseInt($(this).attr('del')));
                }


            );

        }
    }

    function remove_item(del) {
        arr.splice(del, 1);
        showlist();
        alltotal()

    }


    ////////流單要填寫原因
    $('select.result').on('change', function() {
        if ($(this).val() == "流單" || $(this).val() == "其他") {
            $('.reason').show();
        } else {
            $('.reason').hide();
        }
    });


    ////////通知時間設定選項
    $('input[name=at-1]').change(function() {
        var num = $(this).attr('num')
        if ($(this).prop('checked') == true) {
            $('.i1, .i2, .i3, .i4').addClass('d-none');
            $('.i' + num).removeClass('d-none');
        }
    });
    $('input[name=at-2]').change(function() {
        var num = $(this).attr('num')
        if ($(this).prop('checked') == true) {
            $('.i1-2, .i2-2, .i3-2, .i4-2').addClass('d-none');
            $('.i' + num).removeClass('d-none');
        }
    });

    ////////通知對象新增
    $('body').on('click', '.Overview-set .add-member.meet', function() {
        var company = $(this).parents('.Overview-set').find(".company").val()
        var role = $(this).parents('.Overview-set').find(".role").val()
        var staffname = $(this).parents('.Overview-set').find(".staffname").val()
        if ((company && role && staffname) !== null) {
            $(this).siblings('.memberwrap').append('<span class="tag"><div><small>' + company + '/' + role + '</small><br>' + staffname + '</div><button class="close" type="button">×</button></span>');
        }
    });

    ////////通知對象/新增星期刪除
    $('body').on('click', '.Overview-set .close', function() {
        $(this).parent('.tag, .week').remove();
    });

    ////////通知對象控制鎖select
    $('body').on('change', '.Overview-set .company', function() {
        if ($(this).val() !== "") {
            $(this).siblings('.role').prop('disabled', '');
        }
    });
    $('body').on('change', '.Overview-set .role', function() {
        if ($(this).val() !== "") {
            $(this).siblings('.staffname').prop('disabled', '');
            $(this).siblings('.staffname').val('');
        }
    });

    ////////通知時間 新增星期
    $('body').on('click', '.Overview-set .add-member.week-b', function() {
        $(this).parents('.Overview-set').find('.weekwrap').append(`
            <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                <select  class="form-control">
                    <option value="">星期一</option>
                    <option value="">星期二</option>
                    <option value="">星期三</option>
                    <option value="">星期四</option>
                    <option value="">星期五</option>
                    <option value="">星期六</option>
                    <option value="">星期日</option>    
                </select>
                <input type="text" class="time-set form-control">
                <button class="close" type="button">×</button>
            </div>
        `);
    });
    </script>
    <script>
            var area_data = {
            '臺北市': [
                '中正區', '大同區', '中山區', '萬華區', '信義區', '松山區', '大安區', '南港區', '北投區', '內湖區', '士林區', '文山區'
            ],
            '新北市': [
                '板橋區', '新莊區', '泰山區', '林口區', '淡水區', '金山區', '八里區', '萬里區', '石門區', '三芝區', '瑞芳區', '汐止區', '平溪區', '貢寮區', '雙溪區', '深坑區', '石碇區', '新店區', '坪林區', '烏來區', '中和區', '永和區', '土城區', '三峽區', '樹林區', '鶯歌區', '三重區', '蘆洲區', '五股區'
            ],
            '基隆市': [
                '仁愛區', '中正區', '信義區', '中山區', '安樂區', '暖暖區', '七堵區'
            ],
            '桃園市': [
                '桃園區', '中壢區', '平鎮區', '八德區', '楊梅區', '蘆竹區', '龜山區', '龍潭區', '大溪區', '大園區', '觀音區', '新屋區', '復興區'
            ],
            '新竹縣': [
                '竹北市', '竹東鎮', '新埔鎮', '關西鎮', '峨眉鄉', '寶山鄉', '北埔鄉', '橫山鄉', '芎林鄉', '湖口鄉', '新豐鄉', '尖石鄉', '五峰鄉'
            ],
            '新竹市': [
                '東區', '北區', '香山區'
            ],
            '苗栗縣': [
                '苗栗市', '通霄鎮', '苑裡鎮', '竹南鎮', '頭份鎮', '後龍鎮', '卓蘭鎮', '西湖鄉', '頭屋鄉', '公館鄉', '銅鑼鄉', '三義鄉', '造橋鄉', '三灣鄉', '南庄鄉', '大湖鄉', '獅潭鄉', '泰安鄉'
            ],
            '臺中市': [
                '中區', '東區', '南區', '西區', '北區', '北屯區', '西屯區', '南屯區', '太平區', '大里區', '霧峰區', '烏日區', '豐原區', '后里區', '東勢區', '石岡區', '新社區', '和平區', '神岡區', '潭子區', '大雅區', '大肚區', '龍井區', '沙鹿區', '梧棲區', '清水區', '大甲區', '外埔區', '大安區'
            ],
            '南投縣': [
                '南投市', '埔里鎮', '草屯鎮', '竹山鎮', '集集鎮', '名間鄉', '鹿谷鄉', '中寮鄉', '魚池鄉', '國姓鄉', '水里鄉', '信義鄉', '仁愛鄉'
            ],
            '彰化縣': [
                '彰化市', '員林鎮', '和美鎮', '鹿港鎮', '溪湖鎮', '二林鎮', '田中鎮', '北斗鎮', '花壇鄉', '芬園鄉', '大村鄉', '永靖鄉', '伸港鄉', '線西鄉', '福興鄉', '秀水鄉', '埔心鄉', '埔鹽鄉', '大城鄉', '芳苑鄉', '竹塘鄉', '社頭鄉', '二水鄉', '田尾鄉', '埤頭鄉', '溪州鄉'
            ],
            '雲林縣': [
                '斗六市', '斗南鎮', '虎尾鎮', '西螺鎮', '土庫鎮', '北港鎮', '莿桐鄉', '林內鄉', '古坑鄉', '大埤鄉', '崙背鄉', '二崙鄉', '麥寮鄉', '臺西鄉', '東勢鄉', '褒忠鄉', '四湖鄉', '口湖鄉', '水林鄉', '元長鄉'
            ],
            '嘉義縣': [
                '太保市', '朴子市', '布袋鎮', '大林鎮', '民雄鄉', '溪口鄉', '新港鄉', '六腳鄉', '東石鄉', '義竹鄉', '鹿草鄉', '水上鄉', '中埔鄉', '竹崎鄉', '梅山鄉', '番路鄉', '大埔鄉', '阿里山鄉'
            ],
            '嘉義市': [
                '東區', '西區'
            ],
            '臺南市': [
                '中西區', '東區', '南區', '北區', '安平區', '安南區', '永康區', '歸仁區', '新化區', '左鎮區', '玉井區', '楠西區', '南化區', '仁德區', '關廟區', '龍崎區', '官田區', '麻豆區', '佳里區', '西港區', '七股區', '將軍區', '學甲區', '北門區', '新營區', '後壁區', '白河區', '東山區', '六甲區', '下營區', '柳營區', '鹽水區', '善化區', '大內區', '山上區', '新市區', '安定區'
            ],
            '高雄市': [
                '楠梓區', '左營區', '鼓山區', '三民區', '鹽埕區', '前金區', '新興區', '苓雅區', '前鎮區', '小港區', '旗津區', '鳳山區', '大寮區', '鳥松區', '林園區', '仁武區', '大樹區', '大社區', '岡山區', '路竹區', '橋頭區', '梓官區', '彌陀區', '永安區', '燕巢區', '田寮區', '阿蓮區', '茄萣區', '湖內區', '旗山區', '美濃區', '內門區', '杉林區', '甲仙區', '六龜區', '茂林區', '桃源區', '那瑪夏區'
            ],
            '屏東縣': [
                '屏東市', '潮州鎮', '東港鎮', '恆春鎮', '萬丹鄉', '長治鄉', '麟洛鄉', '九如鄉', '里港鄉', '鹽埔鄉', '高樹鄉', '萬巒鄉', '內埔鄉', '竹田鄉', '新埤鄉', '枋寮鄉', '新園鄉', '崁頂鄉', '林邊鄉', '南州鄉', '佳冬鄉', '琉球鄉', '車城鄉', '滿州鄉', '枋山鄉', '霧台鄉', '瑪家鄉', '泰武鄉', '來義鄉', '春日鄉', '獅子鄉', '牡丹鄉', '三地門鄉'
            ],
            '宜蘭縣': [
                '宜蘭市', '羅東鎮', '蘇澳鎮', '頭城鎮', '礁溪鄉', '壯圍鄉', '員山鄉', '冬山鄉', '五結鄉', '三星鄉', '大同鄉', '南澳鄉'
            ],
            '花蓮縣': [
                '花蓮市', '鳳林鎮', '玉里鎮', '新城鄉', '吉安鄉', '壽豐鄉', '秀林鄉', '光復鄉', '豐濱鄉', '瑞穗鄉', '萬榮鄉', '富里鄉', '卓溪鄉'
            ],
            '臺東縣': [
                '臺東市', '成功鎮', '關山鎮', '長濱鄉', '海端鄉', '池上鄉', '東河鄉', '鹿野鄉', '延平鄉', '卑南鄉', '金峰鄉', '大武鄉', '達仁鄉', '綠島鄉', '蘭嶼鄉', '太麻里鄉'
            ],
            '澎湖縣': [
                '馬公市', '湖西鄉', '白沙鄉', '西嶼鄉', '望安鄉', '七美鄉'
            ],
            '金門縣': [
                '金城鎮', '金湖鎮', '金沙鎮', '金寧鄉', '烈嶼鄉', '烏坵鄉'
            ],
            '連江縣': [
                '南竿鄉', '北竿鄉', '莒光鄉', '東引鄉'
            ]
        };
        
        // 台灣縣市載入
        $(document).ready(function(){
            for(var i=0;i<Object.keys(area_data).length;i++){
            $(".area1").append("<option value='"+Object.keys(area_data)[i]+"'>"+Object.keys(area_data)[i]+"</option>")
            }
        });

        // 台灣縣市變動時地區載入
        $(".area1").change(function(){
            var val=$(this).val();
            $(".area2").html('');
            $(".area2").append('<option class="append-start" selected value="">鄉鎮市</option>');
            for(i=0;i<area_data[val].length;i++){
                $(".area2").append("<option value='"+area_data[val][i]+"'>"+area_data[val][i]+"</option>")
            }
        });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#trackFrom').on('submit',function(e){
            e.preventDefault();
            var formData = new FormData(this);

            var calendar = $('#showlist');
            var rows = calendar.find('tbody')[0].rows;

            var detailLength = rows.length
            formData.append('detailLength', detailLength);

            for(var i=1;i<rows.length;i++){
                var td1 = rows[i].cells[1].innerText
                var td2 = rows[i].cells[2].innerText
                var td3 = rows[i].cells[3].innerText
                var td4 = rows[i].cells[4].innerText
                var td5 = rows[i].cells[5].innerText

                var detail = [];

                detail.push(td1,td2,td3,td4,td5)

                formData.append('detail'+[i], detail);
            }

            formData.append( "_token", '{{csrf_token()}}' )

            $.ajax({
                method:'post',
                url:'{{ route('ht.Business.self.trackUpdate',['organization'=>$organization,'id'=>$id]) }}',
                data:formData,
                success:function(res){
                    if(res.status == '200'){
                        location.href = '{{ route('ht.Business.self.index',['organization'=>$organization]) }}';
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            })
        })
    })
</script>
@endsection