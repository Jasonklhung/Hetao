@extends('layout.app')

@section('content')
        @php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }
            else{
                $id = '';
            }
        @endphp
		<div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">總覽 <span>Overview</span></h3>
                    @include('common.message')
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-calendar-alt"></i>通知設定
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <div class='coupon'>
                                                    <form class="form-inline" id="noticeSearch">
                                                        @csrf
                                                        <input type="text" class="form-control mr-s searchInput searchInput_a" placeholder="請輸入關鍵字">
                                                        <div class='form-group'>
                                                            <div class='datetime'>
                                                                <div class='input-group date day-select' id="datetimepicker1">
                                                                    <input class='form-control' placeholder='選擇起始日期' type='text' name="start" id="start"> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                            </div><span class='rwd-hide'>~</span>
                                                            <div class='datetime'>
                                                                <div class='input-group day date-select mr-s' id="datetimepicker2">
                                                                    <input class='form-control' placeholder='選擇結束日期' type='text' name="end" id="end"> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='btn-wrap'>
                                                            <button class='mr-s' type="submit">查詢</button>
                                                            <button class='mr-s' type="button" id="reset">重設</button>
                                                            <button class='btn-bright' type='button' data-toggle="modal" data-target="#person-n">新增通知</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div style="width: 100%; overflow-x: auto;">
                                                    <table class="table table-hover table-striped display" id="hetao-overview">
                                                        <thead class="rwdhide">
                                                            <tr>
                                                                <th class="desktop">內容</th>
                                                                <th class="desktop">時間</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($notice as $key => $data)
                                                            <tr class="watch">
                                                                <td>
                                                                    <strong><a href="#" onclick="noticeFunction(<?php echo $data->id ?>)"><span class="mr-s">[{{$data->type}}]</span>{{$data->title}}</a></strong>
                                                                    <p>{{$data->content}}</p>
                                                                </td>
                                                                <td class="text-nowrap">{{$data->startTime}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
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
        </div>
@endsection

@section('modal')
<!-- Modal 新增通知 -->
    <div id="person-n" class="modal fade Overview-set" role="dialog" style="z-index: 9999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <div class="modal-body">
                    <form action="{{ route('ht.Overview.notice.store',['organization'=>$organization]) }}" method="post">
                        @csrf
                        <ul>
                            <li class="mb-s">
                                <span class="mb-xs">標題</span>
                                <input class="form-control" type="text" placeholder="輸入標題" name="title">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">內容</span>
                                <textarea class="form-control" rows="1" placeholder="輸入內容" name="content"></textarea>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">通知時間</span>
                                <div class="d-block">
                                    <input class="choose" id="choose1" type="radio" name="category" num="1" value="單次" checked>
                                    <label for="choose1" class="chooseitem mr-s">單次</label>

                                    <input class="choose" id="choose2" type="radio" name="category" num="2" value="每日">
                                    <label for="choose2" class="chooseitem mr-s">每日</label>

                                    <input class="choose" id="choose3" type="radio" name="category" num="3" value="每週">
                                    <label for="choose3" class="chooseitem mr-s">每週</label>

                                    <input class="choose" id="choose4" type="radio" name="category" num="4" value="每月">
                                    <label for="choose4" class="chooseitem mr-s">每月</label>

                                    <input class="choose" id="choose5" type="radio" name="category" value="不通知" num="5">
                                    <label for="choose5" class="chooseitem mr-s">不通知</label>
                                </div>
                                <div class="">
                                    <!-- 單次 -->
                                    <div class="i1">
                                        <input type="text" class="date-set form-control" name="startTimeOnce">
                                    </div>
                                    <!-- 每日 -->
                                    <div class="i2 d-none">
                                        <p>開始日期</p>
                                        <input type="text" class="date-set form-control" name="startTimeEveryDay">
                                    </div>
                                    <!-- 每週 -->
                                    <div class="i3 d-none">
                                        <p>開始日期</p>
                                        <input type="text" class="day-set form-control mb-s" name="startTimeEveryWeek">
                                        <div class="form-inline mb-s">
                                            <span>每</span><input class="form-control mx-s dayy" type="number" value="1" min="1" name="week"><span>週</span>
                                            <button class="levelinfo" type="button">
                                                <i class="fas fa-info-circle text-bright"></i>
                                                <ul class="levelinfo-menu">
                                                    <li><span class="text-primary">每1週：</span>每週</li>
                                                    <li><span class="text-primary">每2週：</span>隔一週</li>
                                                </ul>
                                            </button>
                                            <button type="button" class="btn add-member week-b">+ 新增</button>
                                        </div>
                                        <div class="weekwrap">
                                            <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                                <select class="form-control" name="weekend[]">
                                                    <option value="星期一">星期一</option>
                                                    <option value="星期二">星期二</option>
                                                    <option value="星期三">星期三</option>
                                                    <option value="星期四">星期四</option>
                                                    <option value="星期五">星期五</option>
                                                    <option value="星期六">星期六</option>
                                                    <option value="星期日">星期日</option>
                                                </select>
                                                <input type="text" class="time-set form-control" name="weekendTime[]">
                                                <button class="close" type="button">×</button>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- 每月 -->
                                    <div class="i4 d-none">
                                        <p>開始日期</p>
                                        <input type="text" class="date-set form-control" name="startTimeEveryMonth">
                                    </div>
                                </div>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">通知對象</span>
                                <div class="d-flex">
                                    <select class='form-control mb-s company mr-s' name="company" id="company">
                                        <option selected disabled hidden value="">分公司</option>
                                        @foreach($org as $key => $data)
                                        <option value="{{ $data->name }}">{{ $data->name }}{{$data->company_name}}</option>
                                        @endforeach
                                    </select>
                                    <select class='form-control mb-s role mr-s' disabled="disabled" name="job" id="job">
                                        <option selected hidden value="">職稱</option>
                                        <option value="助理">助理</option>
                                        <option value="主管">主管</option>
                                        <option value="員工">員工</option>
                                    </select>
                                    <select class='form-control mb-s staffname' disabled="disabled" name="name" id="name">
                                        <option selected hidden value="">員工名稱</option>
                                    </select>
                                </div>
                                <button type="button" class="btn add-member meet" id="addUser">+ 新增</button>
                                <div class="memberwrap">
                                </div>
                                <input type="hidden" name="meetingName" id="meetingName">
                                <input type="hidden" name="meetingToken" id="meetingToken">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">類型</span>
                                <select class="form-control" name="type">
                                    <option value="一般">一般</option>
                                    <option value="覆訪">覆訪</option>
                                </select>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">備註</span>
                                <textarea class="form-control" rows="1" placeholder="輸入備註" name="other"></textarea>
                            </li>
                            <li class="text-center"><button type="button" class="btn btn-danger">重設</button><button type="submit" class="btn btn-primary">新增</button></li>
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
                    <form action="{{ route('ht.Overview.notice.edit',['organization'=>$organization]) }}" method="post">
                        @csrf
                        <ul>
                            <li class="mb-s">
                                <span class="mb-xs">標題</span>
                                <input class="form-control" type="hidden" placeholder="輸入標題" name="id" id="id">
                                <input class="form-control" type="text" placeholder="輸入標題" name="title" id="title">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">內容</span>
                                <textarea class="form-control" rows="1" placeholder="輸入內容" name="content" id="content"></textarea>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">通知時間</span>
                                <div class="d-block">
                                    <input class="choose" id="choose1-2" type="radio" name="category2" value="單次" num="1-2">
                                    <label for="choose1-2" class="chooseitem mr-s">單次</label>

                                    <input class="choose" id="choose2-2" type="radio" name="category2" value="每日" num="2-2">
                                    <label for="choose2-2" class="chooseitem mr-s">每日</label>

                                    <input class="choose" id="choose3-2" type="radio" name="category2" value="每週" num="3-2">
                                    <label for="choose3-2" class="chooseitem mr-s">每週</label>

                                    <input class="choose" id="choose4-2" type="radio" name="category2" value="每月" num="4-2">
                                    <label for="choose4-2" class="chooseitem mr-s">每月</label>

                                    <input class="choose" id="choose5-2" type="radio" name="category2" value="不通知" num="5-2">
                                    <label for="choose5-2" class="chooseitem mr-s">不通知</label>
                                </div>
                                <div class="">
                                    <!-- 單次 -->
                                    <div class="i1-2">
                                        <input type="text" class="date-set form-control" name="startTimeOnce" id="once">
                                    </div>
                                    <!-- 每日 -->
                                    <div class="i2-2 d-none">
                                        <p>開始日期</p>
                                        <input type="text" class="date-set form-control" name="startTimeEveryDay" id="everyDay">
                                    </div>
                                    <!-- 每週 -->
                                    <div class="i3-2 d-none">
                                        <p>開始日期</p>
                                        <input type="text" class="day-set form-control mb-s" name="startTimeEveryWeek" id="everyWeek">
                                        <div class="form-inline mb-s">
                                            每<input class="form-control mx-s dayy" type="number" value="1" min="1" name="week" id="week">週
                                            <button class="levelinfo" type="button">
                                                <i class="fas fa-info-circle text-bright"></i>
                                                <ul class="levelinfo-menu">
                                                    <li><span class="text-primary">每1週：</span>每週</li>
                                                    <li><span class="text-primary">每2週：</span>隔一週</li>
                                                </ul>
                                            </button>
                                            <button type="button" class="btn add-member week-b">+ 新增</button>
                                        </div>
                                        <div class="weekwrap">
                                            <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                                <select class="form-control my-xs" name="weekend[]">
                                                    <option value="">星期一</option>
                                                    <option value="">星期二</option>
                                                    <option value="">星期三</option>
                                                    <option value="">星期四</option>
                                                    <option value="">星期五</option>
                                                    <option value="">星期六</option>
                                                    <option value="">星期日</option>    
                                                </select>
                                                <input type="text" class="time-set form-control my-xs" name="weekendTime[]">
                                                <button class="close my-xs" type="button">×</button>
                                            </div>
                                        </div>    
                                    </div>
                                    <!-- 每月 -->
                                    <div class="i4-2 d-none">
                                        <p>開始日期</p>
                                        <input type="text" class="date-set form-control" name="startTimeEveryMonth" id="everyMonth">
                                    </div>
                                </div>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">通知對象</span>
                                <div class="d-flex">
                                    <select class='form-control mb-s company mr-s' name="company2" id="company2">
                                        <option selected disabled hidden value="">分公司</option>
                                        @foreach($org as $key => $data)
                                        <option value="{{ $data->name }}">{{ $data->name }}{{$data->company_name}}</option>
                                        @endforeach
                                    </select>
                                    <select class='form-control mb-s role mr-s' disabled="disabled" name="job2" id="job2">
                                        <option selected hidden value="">職稱</option>
                                        <option value="助理">助理</option>
                                        <option value="主管">主管</option>
                                        <option value="員工">員工</option>
                                    </select>
                                    <select class='form-control mb-s staffname' disabled="disabled" name="name2" id="name2">
                                        <option selected hidden value="">員工名稱</option>
                                    </select>
                                </div>
                                <button type="button" class="btn add-member meet2">+ 新增</button>
                                <div class="memberwrap2">
                                </div>
                                <input type="hidden" name="meetingName2" id="meetingName2">
                                <input type="hidden" name="meetingToken2" id="meetingToken2">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">類型</span>
                                <select class="form-control" name="type" id="type2">
                                    <option value="一般">一般</option>
                                    <option value="覆訪">覆訪</option>
                                </select>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">備註</span>
                                <textarea class="form-control" rows="1" placeholder="輸入備註" name="other" id="other"></textarea>
                            </li>
                            <li class="text-center"><button type="submit" class="btn btn-danger" name="submit[del]" value="del">刪除</button><button type="submit" class="btn btn-primary" name="submit[save]" value="save">儲存</button></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 單純通知 -->
    <div id="person-enotice" class="modal fade Overview-set" role="dialog" style="z-index: 9999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <div class="modal-body">
                    <form action="{{ route('ht.Overview.notice.edit',['organization'=>$organization]) }}" method="post">
                        @csrf
                        <ul>
                            <li class="mb-s">
                                <span class="mb-xs">標題</span>
                                <input class="form-control" type="hidden" placeholder="輸入標題" name="id" id="id2" readonly="">
                                <input class="form-control" type="text" placeholder="輸入標題" name="title" id="title2" readonly="">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">內容</span>
                                <textarea class="form-control" rows="1" placeholder="輸入內容" name="content" id="content2" readonly=""></textarea>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">通知時間</span>
                                <div class="d-block">
                                    <input class="choose" id="choose1-22" type="radio" name="category3" value="單次" num="1-2" readonly="" disabled="">
                                    <label for="choose1-2" class="chooseitem mr-s">單次</label>

                                    <input class="choose" id="choose2-22" type="radio" name="category3" value="每日" num="2-2" readonly="" disabled="">
                                    <label for="choose2-2" class="chooseitem mr-s">每日</label>

                                    <input class="choose" id="choose3-22" type="radio" name="category3" value="每週" num="3-2" readonly="" disabled="">
                                    <label for="choose3-2" class="chooseitem mr-s">每週</label>

                                    <input class="choose" id="choose4-22" type="radio" name="category3" value="每月" num="4-2" readonly="" disabled="">
                                    <label for="choose4-2" class="chooseitem mr-s">每月</label>

                                    <input class="choose" id="choose5-22" type="radio" name="category3" value="不通知" num="5-2" readonly="" disabled="">
                                    <label for="choose5-2" class="chooseitem mr-s">不通知</label>
                                </div>
                                <div class="">
                                    <!-- 單次 -->
                                    <div class="i1-2">
                                        <input type="text" class="form-control" name="startTimeOnce" id="once2" readonly="">
                                    </div>
                                    <!-- 每日 -->
                                    <div class="i2-2 d-none">
                                        <p>開始日期</p>
                                        <input type="text" class="form-control" name="startTimeEveryDay" id="everyDay2" readonly="" disabled="">
                                    </div>
                                    <!-- 每週 -->
                                    <div class="i3-2 d-none">
                                        <p>開始日期</p>
                                        <input type="text" class="form-control mb-s" name="startTimeEveryWeek" id="everyWeek2" readonly="">
                                        <div class="form-inline mb-s">
                                            每<input class="form-control mx-s dayy" type="number" value="1" min="1" name="week" id="week2" readonly="">週
                                            <button class="levelinfo" type="button">
                                                <i class="fas fa-info-circle text-bright"></i>
                                                <ul class="levelinfo-menu">
                                                    <li><span class="text-primary">每1週：</span>每週</li>
                                                    <li><span class="text-primary">每2週：</span>隔一週</li>
                                                </ul>
                                            </button>
                                            <!-- <button type="button" class="btn add-member week-b">+ 新增</button> -->
                                        </div>
                                        <div class="weekwrap">
                                            <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                                <select class="form-control my-xs" name="weekend[]" readonly="" disabled="">
                                                    <option value="">星期一</option>
                                                    <option value="">星期二</option>
                                                    <option value="">星期三</option>
                                                    <option value="">星期四</option>
                                                    <option value="">星期五</option>
                                                    <option value="">星期六</option>
                                                    <option value="">星期日</option>    
                                                </select>
                                                <input type="text" class="time-set form-control my-xs" name="weekendTime[]" readonly="">
                                                <!-- <button class="close my-xs" type="button">×</button> -->
                                            </div>
                                        </div>    
                                    </div>
                                    <!-- 每月 -->
                                    <div class="i4-2 d-none">
                                        <p>開始日期</p>
                                        <input type="text" class="form-control" name="startTimeEveryMonth" id="everyMonth2" readonly="">
                                    </div>
                                </div>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">通知對象</span>
                                <div class="d-flex">
                                    <select class='form-control mb-s company mr-s' name="company2" id="company3" readonly="" disabled="">
                                        <option selected disabled hidden value="">分公司</option>
                                        @foreach($org as $key => $data)
                                        <option value="{{ $data->name }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                    <select class='form-control mb-s role mr-s' disabled="disabled" name="job2" id="job3" readonly="">
                                        <option selected hidden value="">職稱</option>
                                        <option value="助理">助理</option>
                                        <option value="主管">主管</option>
                                        <option value="員工">員工</option>
                                    </select>
                                    <select class='form-control mb-s staffname' disabled="disabled" name="name2" id="name3" readonly="">
                                        <option selected hidden value="">員工名稱</option>
                                    </select>
                                </div>
                                <!-- <button type="button" class="btn add-member meet2">+ 新增</button> -->
                                <div class="memberwrap3">
                                </div>
                                <input type="hidden" name="meetingName2" id="meetingName3">
                                <input type="hidden" name="meetingToken2" id="meetingToken3">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">類型</span>
                                <select class="form-control" name="type" id="type3" readonly="" disabled="">
                                    <option value="一般">一般</option>
                                    <option value="覆訪">覆訪</option>
                                </select>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">備註</span>
                                <textarea class="form-control" rows="1" placeholder="輸入備註" name="other" id="other2" readonly=""></textarea>
                            </li>
                            <!-- <li class="text-center"><button type="button" class="btn btn-danger">刪除</button><button type="submit" class="btn btn-primary">儲存</button></li> -->
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    var table = $("#hetao-overview").DataTable({
        "bPaginate": true,
        "searching": true,
        "info": true,
        "bLengthChange": false,
        "bServerSide": false,
        "language": {
            "search": "",
            "searchPlaceholder": "請輸入關鍵字",
            "paginate": { "previous": "上一頁", "next": "下一頁" },
            "info": "顯示 _START_ 至 _END_ 筆，共有 _TOTAL_ 筆",
            "zeroRecords": "沒有符合的搜尋結果",
            "infoEmpty": "顯示 0 至 0 筆，共 0 筆",
            "lengthMenu": "呈現筆數 _MENU_",
            "emptyTable": "沒有數據",
            "infoFiltered": "(從 _MAX_ 筆中篩選)",
        },
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "buttons": [{
            "extend": 'colvis',
            "collectionLayout": 'fixed two-column'
        }],
        "order": [],
        "columnDefs": [{
            "targets": [],
            "orderable": false,
        }, {
            "width": "200",
            "targets": 1,
        }],
        "responsive": {
            "breakpoints": [
                { name: 'desktop', width: Infinity },
                { name: 'tablet', width: 1024 },
            ],
            "details": {
                "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                "type": 'none',
                "renderer": $.fn.dataTable.Responsive.renderer.tableAll(),
                "target": ''
            }
        },
    });

    $(".searchInput_a").on("blur", function() {
        table.search(this.value).draw();
    });

    $(".searchInput_a").on("keyup", function() {
        table.search(this.value).draw();
    });

    // 通知時間設定選項
    $('input[name=category]').change(function(){
        var num = $(this).attr('num')
        if($(this).prop('checked')==true) {
            $(this).parents('ul').find('.i1, .i2, .i3, .i4').addClass('d-none');
            $(this).parents('ul').find('.i'+num).removeClass('d-none');
        }
    });  
    $('input[name=category2]').change(function(){
        var num = $(this).attr('num')
        if($(this).prop('checked')==true) {
            $(this).parents('ul').find('.i1-2, .i2-2, .i3-2, .i4-2').addClass('d-none');
            $(this).parents('ul').find('.i'+num).removeClass('d-none');
        }
    });  

    // 通知對象新增
    var array = [];
    var staffNameArray = [];
    $('body').on('click', '.Overview-set .add-member.meet', function(){
        var company = $(this).parents('.Overview-set').find(".company").val()
        var role = $(this).parents('.Overview-set').find(".role").val()
        var staffname = $(this).parents('.Overview-set').find(".staffname").find("option:selected").text()
        var token = $(this).parents('.Overview-set').find(".staffname").find("option:selected").val()

        if(array.indexOf(token) == -1){
            array.push(token)
            staffNameArray.push(company+"/"+role+" "+staffname)

            var aaa = array.join(',')
            var bbb = staffNameArray.join(',')

            if((company && role && staffname) !== null){
                $(this).siblings('.memberwrap').append('<span class="tag"><div><small>'+ company +'/'+ role +'</small><br>'+ staffname +'</div><button class="close cl" type="button" value='+token+'>×</button></span>');
            }

            $("input[name='meetingToken']").val(aaa)
            $("input[name='meetingName']").val(bbb)
        }
        else{
            alert('此人員已新增')
        }
    });

    
    $('body').on('click', '.Overview-set .add-member.meet2', function(){
        var company = $(this).parents('.Overview-set').find(".company").val()
        var role = $(this).parents('.Overview-set').find(".role").val()

        var staffname = $(this).parents('.Overview-set').find(".staffname").find("option:selected").text()
        var token = $(this).parents('.Overview-set').find(".staffname").find("option:selected").val()

        var meetingName = $('#meetingName2').val()
        var meetingToken = $('#meetingToken2').val()

        var array2 = meetingToken.split(',');
        var staffNameArray2 = meetingName.split(',');

        if(array2.indexOf(token) == -1){
            array2.push(token)
            staffNameArray2.push(company+"/"+role+" "+staffname)
            if((company && role && staffname) !== null){
                $(this).siblings('.memberwrap2').append('<span class="tag"><div><small>'+ company +'/'+ role +'</small><br>'+ staffname +'</div><button class="close cl2" type="button" value='+token+'>×</button></span>');
            }

            var aaa = array2.join(',')
            var bbb = staffNameArray2.join(',')

            $("input[name='meetingToken2']").val(aaa)
            $("input[name='meetingName2']").val(bbb)
        }
        else{
            alert('此人員已新增')
        }
    });

    // 通知對象/新增星期刪除
    $('body').on('click', '.Overview-set .close.cl', function(){

        //新增
        var meetingToken = $('#meetingToken').val()
        var meetingName = $('#meetingName').val()

        if (meetingToken.indexOf(',') > -1) {
            var meetingTokenArray = meetingToken.split(',');
        }
        else{
            var meetingTokenArray = [meetingToken];
        }


        if (meetingName.indexOf(',') > -1) {
            var meetingNameArray = meetingName.split(',');
        }
        else{
            var meetingNameArray = [meetingName];
        }


        var meetingTokenArray = meetingToken.split(',');
        var meetingNameArray = meetingName.split(',');


        var removeToken = $(this).val()

        $.each(meetingTokenArray, function (i, item) {

            if(removeToken == item){
                var removeKey = i;

                meetingTokenArray.splice(removeKey, 1);
                meetingNameArray.splice(removeKey, 1);

                var aaa = meetingTokenArray.join(',')
                var bbb = meetingNameArray.join(',')

                $("input[name='meetingToken']").val(aaa)
                $("input[name='meetingName']").val(bbb)

            }

        })

        $(this).parent('.tag, .week').remove();

    });

    // 通知對象/新增星期刪除
    $('body').on('click', '.Overview-set .close.cl2', function(){

        //編輯
        var meetingToken2 = $('#meetingToken2').val()
        var meetingName2 = $('#meetingName2').val()

        if (meetingToken2.indexOf(',') > -1) {
            var meetingTokenArray2 = meetingToken2.split(',');
        }
        else{
            var meetingTokenArray2 = [meetingToken2];
        }


        if (meetingName2.indexOf(',') > -1) {
            var meetingNameArray2 = meetingName2.split(',');
        }
        else{
            var meetingNameArray2 = [meetingName2];
        }

        var removeToken = $(this).val()

        $.each(meetingTokenArray2, function (i, item) {

            if(removeToken == item){
                var removeKey = i;

                meetingTokenArray2.splice(removeKey, 1);
                meetingNameArray2.splice(removeKey, 1);

                var aaa = meetingTokenArray2.join(',')
                var bbb = meetingNameArray2.join(',')

                $("input[name='meetingToken2']").val(aaa)
                $("input[name='meetingName2']").val(bbb)

            }

        })

        $(this).parent('.tag, .week').remove();

    });

    // 通知對象/新增星期刪除
    $('body').on('click', '.Overview-set .close', function(){

        $(this).parent('.week').remove();

    });

    // 通知對象控制鎖select
    $('body').on('change', '.Overview-set .company', function(){
        if($(this).val() !== "") {
            $(this).siblings('.role').prop('disabled','');
        }
    });
    $('body').on('change', '.Overview-set .role', function(){
        if($(this).val() !== "") {
            $(this).siblings('.staffname').prop('disabled','');
            $(this).siblings('.staffname').val('');
        }
    });

    // 通知時間 新增星期
    $('body').on('click', '.Overview-set .add-member.week-b', function(){
        $(this).parents('.Overview-set').find('.weekwrap').append(`
            <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                <select class="form-control" name="weekend[]">
                    <option value="星期一">星期一</option>
                    <option value="星期二">星期二</option>
                    <option value="星期三">星期三</option>
                    <option value="星期四">星期四</option>
                    <option value="星期五">星期五</option>
                    <option value="星期六">星期六</option>
                    <option value="星期日">星期日</option>    
                </select>
                <input type="text" class="time-set form-control" name="weekendTime[]">
                <button class="close" type="button">×</button>
            </div>
        `);
        $(function () {
            $('.time-set').datetimepicker({
                format: 'HH:mm',
                ignoreReadonly: true,
                allowInputToggle: true,
                ignoreReadonly: true,
                toolbarPlacement: 'bottom',
                showClose: true,
                locale: 'ZH-TW',
            });
        });
    });

</script>
<script type="text/javascript">
    //尋找員工
    $("select[name='job']").on('change',function(){

        var company = $("select[id='company']").val();
        var job = $("select[id='job']").val();

        $.ajax({
            url:"{{ route('ht.Overview.notice.getUserName',['organization'=>$organization]) }}", 
            method:"post",
            dataType:'json',
            data:{
                '_token':'{{csrf_token()}}',
                'company':company,
                'job':job
            },              
            success:function(res){


                if(res == ""){
                    var selOpts = "<option selected disabled hidden>員工名稱</option><option disabled>沒有人員</option>";
                }
                else{
                 var selOpts = "<option selected disabled hidden>員工名稱</option>";
             }

             $.each(res, function (i, item) {

                selOpts += "<option value='"+item.token+"'>"+item.name+"</option>";

            })

             $("select[name='name']").empty();
             $("select[name='name']").append(selOpts);
         }
     })
    });

    //尋找員工2
    $("select[name='job2']").on('change',function(){

        var company = $("select[id='company2']").val();
        var job = $("select[id='job2']").val();

        $.ajax({
            url:"{{ route('ht.Overview.notice.getUserName',['organization'=>$organization]) }}", 
            method:"post",
            dataType:'json',
            data:{
                '_token':'{{csrf_token()}}',
                'company':company,
                'job':job
            },              
            success:function(res){


                if(res == ""){
                    var selOpts = "<option selected disabled hidden>員工名稱</option><option disabled>沒有人員</option>";
                }
                else{
                 var selOpts = "<option selected disabled hidden>員工名稱</option>";
             }

             $.each(res, function (i, item) {

                selOpts += "<option value='"+item.token+"'>"+item.name+"</option>";

            })

             $("select[name='name2']").empty();
             $("select[name='name2']").append(selOpts);
         }
     })
    });


    //查看明細
    function noticeFunction(id){

        $.ajax({
            url:"{{ route('ht.Overview.notice.getNotice',['organization'=>$organization]) }}", 
            method:"post",
            dataType:'json',
            data:{
                '_token':'{{csrf_token()}}',
                'id':id,
            },              
            success:function(res){

                $('#id').val(res.id)
                $('#title').val(res.title)
                $('#content').text(res.content)

                var category = $('input[name="category2"]')

                $('input[name="category2"]').prop("checked", false)

                for (var i = 0; i < category.length; i++) {

                    if(category[i].value == res.category){
                        $('input[name="category2"][value='+res.category+']').prop("checked", true)
                    }
                }

                if(res.category == '單次'){
                    $('#once').val(res.startTime)
                    $('.i2-2, .i3-2, .i4-2').addClass('d-none');
                    $('.i1-2').removeClass('d-none');

                     $('#week').val("1")
                }
                else if(res.category == '每日'){
                    $('#everyDay').val(res.startTime)
                    $('.i1-2, .i3-2, .i4-2').addClass('d-none');
                    $('.i2-2').removeClass('d-none');

                     $('#week').val("1")
                }
                else if(res.category == '每週'){
                    $('#everyWeek').val(res.startTime)
                    $('.i1-2, .i2-2, .i4-2').addClass('d-none');
                    $('.i3-2').removeClass('d-none');

                    $('#week').val(res.week)

                    $('.weekwrap').html("")

                    var weekArray = res.weekend.split(',');
                    var weekTimeArray = res.weekendTime.split(',');

                    $.each(weekArray, function (i, item) {

                        if(item == '星期一'){
                            $('.Overview-set').find('.weekwrap').append(`
                                <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                <select class="form-control" name="weekend[]">
                                <option value="星期一" selected>星期一</option>
                                <option value="星期二">星期二</option>
                                <option value="星期三">星期三</option>
                                <option value="星期四">星期四</option>
                                <option value="星期五">星期五</option>
                                <option value="星期六">星期六</option>
                                <option value="星期日">星期日</option>    
                                </select>
                                <input type="text" class="time-set form-control" name="weekendTime[]" value=`+weekTimeArray[i]+`>
                                <button class="close" type="button">×</button>
                                </div>
                            `);
                        }
                        else if(item == '星期二'){
                            $('.Overview-set').find('.weekwrap').append(`
                                <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                <select class="form-control" name="weekend[]">
                                <option value="星期一">星期一</option>
                                <option value="星期二" selected>星期二</option>
                                <option value="星期三">星期三</option>
                                <option value="星期四">星期四</option>
                                <option value="星期五">星期五</option>
                                <option value="星期六">星期六</option>
                                <option value="星期日">星期日</option>    
                                </select>
                                <input type="text" class="time-set form-control" name="weekendTime[]" value=`+weekTimeArray[i]+`>
                                <button class="close" type="button">×</button>
                                </div>
                            `);
                        }
                        else if(item == '星期三'){
                            $('.Overview-set').find('.weekwrap').append(`
                                <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                <select class="form-control" name="weekend[]">
                                <option value="星期一">星期一</option>
                                <option value="星期二">星期二</option>
                                <option value="星期三" selected>星期三</option>
                                <option value="星期四">星期四</option>
                                <option value="星期五">星期五</option>
                                <option value="星期六">星期六</option>
                                <option value="星期日">星期日</option>    
                                </select>
                                <input type="text" class="time-set form-control" name="weekendTime[]" value=`+weekTimeArray[i]+`>
                                <button class="close" type="button">×</button>
                                </div>
                            `);
                        }
                        else if(item == '星期四'){
                            $('.Overview-set').find('.weekwrap').append(`
                                <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                <select class="form-control" name="weekend[]">
                                <option value="星期一">星期一</option>
                                <option value="星期二">星期二</option>
                                <option value="星期三">星期三</option>
                                <option value="星期四" selected>星期四</option>
                                <option value="星期五">星期五</option>
                                <option value="星期六">星期六</option>
                                <option value="星期日">星期日</option>    
                                </select>
                                <input type="text" class="time-set form-control" name="weekendTime[]" value=`+weekTimeArray[i]+`>
                                <button class="close" type="button">×</button>
                                </div>
                            `);
                        }
                        else if(item == '星期五'){
                            $('.Overview-set').find('.weekwrap').append(`
                                <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                <select class="form-control" name="weekend[]">
                                <option value="星期一">星期一</option>
                                <option value="星期二">星期二</option>
                                <option value="星期三">星期三</option>
                                <option value="星期四">星期四</option>
                                <option value="星期五" selected>星期五</option>
                                <option value="星期六">星期六</option>
                                <option value="星期日">星期日</option>    
                                </select>
                                <input type="text" class="time-set form-control" name="weekendTime[]" value=`+weekTimeArray[i]+`>
                                <button class="close" type="button">×</button>
                                </div>
                            `);
                        }
                        else if(item == '星期六'){
                            $('.Overview-set').find('.weekwrap').append(`
                                <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                <select class="form-control" name="weekend[]">
                                <option value="星期一">星期一</option>
                                <option value="星期二">星期二</option>
                                <option value="星期三">星期三</option>
                                <option value="星期四">星期四</option>
                                <option value="星期五">星期五</option>
                                <option value="星期六" selected>星期六</option>
                                <option value="星期日">星期日</option>    
                                </select>
                                <input type="text" class="time-set form-control" name="weekendTime[]" value=`+weekTimeArray[i]+`>
                                <button class="close" type="button">×</button>
                                </div>
                            `);
                        }
                        else if(item == '星期日'){
                            $('.Overview-set').find('.weekwrap').append(`
                                <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                <select class="form-control" name="weekend[]">
                                <option value="星期一">星期一</option>
                                <option value="星期二">星期二</option>
                                <option value="星期三">星期三</option>
                                <option value="星期四">星期四</option>
                                <option value="星期五">星期五</option>
                                <option value="星期六">星期六</option>
                                <option value="星期日" selected>星期日</option>    
                                </select>
                                <input type="text" class="time-set form-control" name="weekendTime[]" value=`+weekTimeArray[i]+`>
                                <button class="close" type="button">×</button>
                                </div>
                            `);
                        }
                        

                    })
                }
                else if(res.category == '每月'){
                    $('#everyMonth').val(res.startTime)
                    $('.i1-2, .i2-2, .i3-2').addClass('d-none');
                    $('.i4-2').removeClass('d-none');

                    $('#week').val("1")
                }
                else if(res.category == '不通知'){
                    $('#everyMonth').val(res.startTime)
                    $('.i1-2, .i2-2, .i3-2, .i4-2').addClass('d-none');

                    $('#week').val("1")
                }

                var name = res.meeting.split(",")
                var token = res.token.split(",")

                $('.memberwrap2').html("")

                $.each(name, function (i, item) {

                    $('.memberwrap2').append('<span class="tag"><div><small>'+ item.split(" ")[0] +'</small><br>'+ item.split(" ")[1] +'</div><button class="close cl2" type="button" value='+token[i]+'>×</button></span>')
                })

                $('#meetingName2').val(res.meeting)
                $('#meetingToken2').val(res.token)

                var numbers = $("#type2").find("option");

                for (var j = 1; j < numbers.length; j++) {
                    if ($(numbers[j]).val() == res.type) {
                        $(numbers[j]).attr("selected", "selected");
                    }
                }

                $('#other').val(res.other)

                $('#person-e').modal('show')
                
            }
        })
    }

</script>
<script type="text/javascript">
    $(document).ready(function(){
        var id = '<?php echo $id ?>';

        if(id != ''){
            $.ajax({
            url:"{{ route('ht.Overview.notice.getNotice',['organization'=>$organization]) }}", 
            method:"post",
            dataType:'json',
            data:{
                '_token':'{{csrf_token()}}',
                'id':id,
            },              
            success:function(res){

                $('#id2').val(res.id)
                $('#title2').val(res.title)
                $('#content2').text(res.content)

                var category = $('input[name="category3"]')

                $('input[name="category3"]').prop("checked", false)

                for (var i = 0; i < category.length; i++) {

                    if(category[i].value == res.category){
                        $('input[name="category3"][value='+res.category+']').prop("checked", true)
                    }
                }

                if(res.category == '單次'){
                    $('#once2').val(res.startTime)

                     $('#week').val("1")
                }
                else if(res.category == '每日'){
                    $('#everyDay2').val(res.startTime)

                     $('#week').val("1")
                }
                else if(res.category == '每週'){
                    $('#everyWeek2').val(res.startTime)

                    $('#week').val(res.week)

                    $('.weekwrap').html("")

                    var weekArray = res.weekend.split(',');
                    var weekTimeArray = res.weekendTime.split(',');

                    $.each(weekArray, function (i, item) {

                        if(item == '星期一'){
                            $('.Overview-set').find('.weekwrap').append(`
                                <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                <select class="form-control" name="weekend[]">
                                <option value="星期一" selected>星期一</option>
                                <option value="星期二">星期二</option>
                                <option value="星期三">星期三</option>
                                <option value="星期四">星期四</option>
                                <option value="星期五">星期五</option>
                                <option value="星期六">星期六</option>
                                <option value="星期日">星期日</option>    
                                </select>
                                <input type="text" class="time-set form-control" name="weekendTime[]" value=`+weekTimeArray[i]+`>
                                <button class="close" type="button">×</button>
                                </div>
                            `);
                        }
                        else if(item == '星期二'){
                            $('.Overview-set').find('.weekwrap').append(`
                                <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                <select class="form-control" name="weekend[]">
                                <option value="星期一">星期一</option>
                                <option value="星期二" selected>星期二</option>
                                <option value="星期三">星期三</option>
                                <option value="星期四">星期四</option>
                                <option value="星期五">星期五</option>
                                <option value="星期六">星期六</option>
                                <option value="星期日">星期日</option>    
                                </select>
                                <input type="text" class="time-set form-control" name="weekendTime[]" value=`+weekTimeArray[i]+`>
                                <button class="close" type="button">×</button>
                                </div>
                            `);
                        }
                        else if(item == '星期三'){
                            $('.Overview-set').find('.weekwrap').append(`
                                <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                <select class="form-control" name="weekend[]">
                                <option value="星期一">星期一</option>
                                <option value="星期二">星期二</option>
                                <option value="星期三" selected>星期三</option>
                                <option value="星期四">星期四</option>
                                <option value="星期五">星期五</option>
                                <option value="星期六">星期六</option>
                                <option value="星期日">星期日</option>    
                                </select>
                                <input type="text" class="time-set form-control" name="weekendTime[]" value=`+weekTimeArray[i]+`>
                                <button class="close" type="button">×</button>
                                </div>
                            `);
                        }
                        else if(item == '星期四'){
                            $('.Overview-set').find('.weekwrap').append(`
                                <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                <select class="form-control" name="weekend[]">
                                <option value="星期一">星期一</option>
                                <option value="星期二">星期二</option>
                                <option value="星期三">星期三</option>
                                <option value="星期四" selected>星期四</option>
                                <option value="星期五">星期五</option>
                                <option value="星期六">星期六</option>
                                <option value="星期日">星期日</option>    
                                </select>
                                <input type="text" class="time-set form-control" name="weekendTime[]" value=`+weekTimeArray[i]+`>
                                <button class="close" type="button">×</button>
                                </div>
                            `);
                        }
                        else if(item == '星期五'){
                            $('.Overview-set').find('.weekwrap').append(`
                                <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                <select class="form-control" name="weekend[]">
                                <option value="星期一">星期一</option>
                                <option value="星期二">星期二</option>
                                <option value="星期三">星期三</option>
                                <option value="星期四">星期四</option>
                                <option value="星期五" selected>星期五</option>
                                <option value="星期六">星期六</option>
                                <option value="星期日">星期日</option>    
                                </select>
                                <input type="text" class="time-set form-control" name="weekendTime[]" value=`+weekTimeArray[i]+`>
                                <button class="close" type="button">×</button>
                                </div>
                            `);
                        }
                        else if(item == '星期六'){
                            $('.Overview-set').find('.weekwrap').append(`
                                <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                <select class="form-control" name="weekend[]">
                                <option value="星期一">星期一</option>
                                <option value="星期二">星期二</option>
                                <option value="星期三">星期三</option>
                                <option value="星期四">星期四</option>
                                <option value="星期五">星期五</option>
                                <option value="星期六" selected>星期六</option>
                                <option value="星期日">星期日</option>    
                                </select>
                                <input type="text" class="time-set form-control" name="weekendTime[]" value=`+weekTimeArray[i]+`>
                                <button class="close" type="button">×</button>
                                </div>
                            `);
                        }
                        else if(item == '星期日'){
                            $('.Overview-set').find('.weekwrap').append(`
                                <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                <select class="form-control" name="weekend[]">
                                <option value="星期一">星期一</option>
                                <option value="星期二">星期二</option>
                                <option value="星期三">星期三</option>
                                <option value="星期四">星期四</option>
                                <option value="星期五">星期五</option>
                                <option value="星期六">星期六</option>
                                <option value="星期日" selected>星期日</option>    
                                </select>
                                <input type="text" class="time-set form-control" name="weekendTime[]" value=`+weekTimeArray[i]+`>
                                <button class="close" type="button">×</button>
                                </div>
                            `);
                        }
                        

                    })
                }
                else if(res.category == '每月'){
                    $('#everyMonth2').val(res.startTime)

                    $('#week2').val("1")
                }
                else if(res.category == '不通知'){
                    $('#everyMonth2').val(res.startTime)

                    $('#week2').val("1")
                }

                var name = res.meeting.split(",")
                var token = res.token.split(",")

                $('.memberwrap3').html("")

                $.each(name, function (i, item) {

                    $('.memberwrap3').append('<span class="tag"><div><small>'+ item.split(" ")[0] +'</small><br>'+ item.split(" ")[1] +'</div><button class="close cl2" type="button" value='+token[i]+'></button></span>')
                })

                $('#meetingName3').val(res.meeting)
                $('#meetingToken3').val(res.token)

                var numbers = $("#type3").find("option");

                for (var j = 1; j < numbers.length; j++) {
                    if ($(numbers[j]).val() == res.type) {
                        $(numbers[j]).attr("selected", "selected");
                    }
                }

                $('#other2').val(res.other)

                $('#person-enotice').modal('show')
                
            }
        })
        }
    })
</script>
<script type="text/javascript">
     $('#noticeSearch').on('submit',function(e){

        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'post',
            url:"{{ route('ht.Overview.notice.noticeSearch',['organization'=>$organization]) }}",
            data:formData,
            success:function(res){

                var rows;

                $('#hetao-overview').DataTable().destroy();
                $('#hetao-overview tbody').empty();

                $.each(res, function (i, item) {


                    rows += "<tr class='watch'>"
                    + "<td>"
                    + "<strong><a href='#' onclick='noticeFunction("+ item.id +")'><span class='mr-s'>["+ item.type +"]</span>"+ item.title +"</a></strong>"
                    + "<p>"+ item.content +"</p>"
                    + "</td>"
                    + "<td class='text-nowrap'>"+ item.startTime +"</td>"
                    + "</tr>";
                })
                $('#hetao-overview tbody').append(rows);
                var table = $("#hetao-overview").DataTable({
                    "bPaginate": true,
                    "searching": true,
                    "info": true,
                    "bLengthChange": false,
                    "bServerSide": false,
                    "language": {
                        "search": "",
                        "searchPlaceholder": "請輸入關鍵字",
                        "paginate": { "previous": "上一頁", "next": "下一頁" },
                        "info": "顯示 _START_ 至 _END_ 筆，共有 _TOTAL_ 筆",
                        "zeroRecords": "沒有符合的搜尋結果",
                        "infoEmpty": "顯示 0 至 0 筆，共 0 筆",
                        "lengthMenu": "呈現筆數 _MENU_",
                        "emptyTable": "沒有數據",
                        "infoFiltered": "(從 _MAX_ 筆中篩選)",
                    },
                    "dom": '<"top"i>rt<"bottom"flp><"clear">',
                    "buttons": [{
                        "extend": 'colvis',
                        "collectionLayout": 'fixed two-column'
                    }],
                    "order": [],
                    "columnDefs": [{
                        "targets": [],
                        "orderable": false,
                    }, {
                        "width": "200",
                        "targets": 1,
                    }],
                    "responsive": {
                        "breakpoints": [
                        { name: 'desktop', width: Infinity },
                        { name: 'tablet', width: 1024 },
                        ],
                        "details": {
                            "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                            "type": 'none',
                            "renderer": $.fn.dataTable.Responsive.renderer.tableAll(),
                            "target": ''
                        }
                    },
                });

                $(".searchInput_a").on("blur", function() {
                    table.search(this.value).draw();
                });

                $(".searchInput_a").on("keyup", function() {
                    table.search(this.value).draw();
                });
            },
            cache: false,
            contentType: false,
            processData: false
        })
    })

     $('#reset').on('click',function(){
        $('#start').val("")
        $('#end').val("")
     })
</script>
<script type="text/javascript">
    $("#datetimepicker1").on("dp.change", function (e) {
        $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepicker2").on("dp.change", function (e) {
        $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
    });
</script>
@endsection