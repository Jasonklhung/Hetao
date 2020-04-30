@extends('layout.app')

@section('content')
		<div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">週期循環</h3>
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-sync-alt"></i>全站進度
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <!-- tab標籤 -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-01">進度總覽</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-02">員工進度查看</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-03">週期儀表板</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 進度總覽 -->
                                                    <div class="tab-pane active overflow-x" id="viewers-tab-01">
                                                        <p><span class="bg-orange square"></span>已完成<span class="bg-red square ml-m"></span>執行中</p>
                                                        <table class="table table-bordered table-hover table-striped calendar-table">
                                                            <thead>
                                                                <tr>
                                                                    <td class="v-align-bottom" rowspan="2">員工姓名</td>
                                                                    <td class="text-center" colspan="31">{{date('Y')}}年 {{date('m')}}月</td>
                                                                </tr>
                                                                <tr class="text-center">
                                                                    @foreach($monthDay as $key => $data)
                                                                    <th>{{$data['week']}}<br>{{$data['date']}}</th>
                                                                    @endforeach
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($allStaffArray as $key => $data)
                                                                    
                                                                <tr>
                                                                    <td class="text-nowrap nametitle">{{$key}} <span class="text-primary">{{$data[date('Y-m-d')]['count']}}</span></td>
                                                                    @foreach($data as $keys => $datas)
                                                                    @if($datas['still'] != 0 && $datas['finish'] != 0)
                                                                    <td><span class="d-block bg-orange h-50 linehiight2">{{$datas['still']}}</span><span class="d-block bg-red h-50 linehiight2">{{$datas['finish']}}</span></td>
                                                                    @elseif($datas['still'] != 0 && $datas['finish'] == 0)
                                                                    <td class="bg-red">{{$datas['still']}}</td>
                                                                    @elseif($datas['still'] == 0 && $datas['finish'] != 0)
                                                                    <td class="bg-orange">{{$datas['finish']}}</td>
                                                                    @else
                                                                    <td></td>
                                                                    @endif
                                                                    @endforeach
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- 員工進度查看 -->
                                                    <div class="tab-pane" id="viewers-tab-02">   
                                                        <div class='coupon'>
                                                            <form class='form-inline'>
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide span-d'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="button">查詢</button>
                                                                    <button class='mr-s' type="button">重設</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <table class="table table-hover dt-responsive table-striped staff w-100" id="hetao-list-norwd2">
                                                            <thead class="">
                                                                <tr>
                                                                    <th class="desktop"></th>
                                                                    <th class="desktop">營站</th>
                                                                    <th class="desktop">姓名</th>
                                                                    <th class="desktop">已完成</th>
                                                                    <th class="desktop">執行中</th>
                                                                    <th class="desktop">轉單</th>
                                                                    <th class="desktop">總卡片數</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- 週期儀表板 -->
                                                    <div class="tab-pane" id="viewers-tab-03">   
                                                        <div class='coupon'>
                                                            <form class='form-inline'>
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide span-d'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="button">查詢</button>
                                                                    <button class='mr-s' type="button">重設</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="chartwrap">
                                                            <div class="w-100 charts-border"> 
                                                                <div class="col-sm-12 mt-s">
                                                                    <select class='form-control ml-s chart-select mt-s'>
                                                                        <option value="已完成" selected>已完成</option>
                                                                        <option value="轉單">轉單</option>
                                                                    </select>
                                                                </div>  
                                                                <div class="chartwrap1"> 
                                                                    <div class="col-sm-6">
                                                                        <h4 class="mt-m text-center">共有{{count($allFinishNotStillArray)}}張卡片</h4>   
                                                                        <table id="hetao-sale">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="w-50">姓名</th>
                                                                                    <th class="w-50 text-right">比例</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($bbb as $key => $data)
                                                                                <tr>
                                                                                    <td>{{$key}}</td>
                                                                                    <td class="text-right">{{$data['result']}}%</td>
                                                                                </tr>
                                                                                @endforeach
                                                                            </tbody>   
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <h4 class="mt-m text-center">全站卡片狀態數據</h4> 
                                                                        <div id="chart1" style="width: 100%; height: 400px;"></div>
                                                                    </div> 
                                                                </div> 
                                                                <div class="chartwrap2">
                                                                    <div class="col-sm-6">
                                                                        <h4 class="mt-m text-center">共有{{count($allTurnCaseArray)}}張卡片</h4>  
                                                                        <table id="hetao-sale2">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="w-50">姓名</th>
                                                                                    <th class="w-50 text-right">比例</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($ccc as $key => $data)
                                                                                <tr>
                                                                                    <td>{{$key}}</td>
                                                                                    <td class="text-right">{{$data['result']}}%</td>
                                                                                </tr>
                                                                                @endforeach
                                                                            </tbody>   
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <h4 class="mt-m text-center">全站卡片轉單數據</h4> 
                                                                        <div id="chart2" style="width: 100%; height: 400px;"></div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('modal')

@endsection

@section('scripts')
<script src="{{ asset('js/amcharts/amcharts.js') }}"></script>
<script src="{{ asset('js/amcharts/serial.js') }}"></script>
<script src="{{ asset('js/amcharts/pie.js') }}"></script>
<script src="{{ asset('js/amcharts/core.js') }}"></script>
<script src="{{ asset('js/amcharts/charts.js') }}"></script>
<script src="{{ asset('js/amcharts/animated.js') }}"></script>
<script src="{{ asset('js/amcharts/responsive.min.js') }}"></script>
<script>

    var allStaffArray2 = {!! json_encode($allStaffArray2) !!}; //php變數轉換
    var companyName = {!! json_encode($companyName) !!}; //php變數轉換

    var data2 = new Array();
    var k = 0

    $.each(allStaffArray2, function (i, item) {

        data2[k] = {
            station: companyName,
            name: i,
            finish: item.finish,
            execution: item.still,
            change: item.turn,
            total: item.count,
            p_f: `
                <div class="d-flex w-100">
                    <span class="w-60px">完成</span>
                    <div class="progress flex-grow">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="`+Math.round((parseInt(item.finish)/item.count)*100)+`" aria-valuemin="0" aria-valuemax="100" style="width:`+Math.round((parseInt(item.finish)/item.count)*100)+`%">
                            `+Math.round((parseInt(item.finish)/item.count)*100)+`%
                        </div>
                    </div>
                </div>
                `,
            p_e: `
                <div class="d-flex w-100">
                    <span class="w-60px">執行中</span>
                    <div class="progress flex-grow">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="`+Math.round((parseInt(item.still)/item.count)*100)+`" aria-valuemin="0" aria-valuemax="100" style="width:`+Math.round((parseInt(item.still)/item.count)*100)+`%">
                            `+Math.round((parseInt(item.still)/item.count)*100)+`%
                        </div>
                    </div>
                </div>
                `,
            p_c: `
                <div class="d-flex w-100">
                    <span class="w-60px">轉單</span>
                    <div class="progress flex-grow">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="`+Math.round((parseInt(item.turn)/item.count)*100)+`" aria-valuemin="0" aria-valuemax="100" style="width:`+Math.round((parseInt(item.turn)/item.count)*100)+`%">
                            `+Math.round((parseInt(item.turn)/item.count)*100)+`%
                        </div>
                    </div>
                </div>

                `,
        }

        k++;

    })

    function format2(d) {
        return (
            `<div class="mt-s">` + d.p_f + d.p_e + d.p_c + `</div>`
        );
    }
    $(document).ready(function() {
        var table_s2 = $("#hetao-list-norwd2").DataTable({
            "data": data2,
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
                "emptyTable": "目前無工單",
                "infoFiltered": "(從 _MAX_ 筆中篩選)",
            },
            "dom": '<"top"i>rt<"bottom"flp><"clear">',
            "buttons": [{
                "extend": "colvis",
                "collectionLayout": "fixed two-column"
            }],
            "order": [],
            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
            "responsive": false,
            columns: [
                {
                    className: "details-control",
                    orderable: false,
                    data: null,
                    defaultContent: '<span class="lnr lnr-chevron-down"></span>'
                },
                { data: "station" },
                { data: "name" },
                { data: "finish" },
                { data: "execution" },
                { data: "change" },
                { data: "total" },
            ],
        });

        $("#hetao-list-norwd2 tbody").on("click", "td.details-control", function() {
            var tr = $(this).closest("tr");
            var row = table_s2.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass("shown");
            } else {
                row.child(format2(row.data()), "p-0").show();
                tr.addClass("shown");
            }
        });

        $(".searchInput_s2").on("blur", function() {
            table_s2.search(this.value).draw();
        });

        $(".searchInput_s2").on("keyup", function() {
            table_s2.search(this.value).draw();
        });
    });

    var allCardStatusArray = {!! json_encode($allCardStatusArray) !!}; //php變數轉換

    AmCharts.makeChart("chart1", {
        "hideCredits": "true",
        "fontSize": 16,
        "type": "pie",
        "innerRadius": "60%",
        "labelRadius": 10,
        "minRadius": 50,
        "labelText": "[[title]][[percents]]%<br>共[[value]]張卡片",
        "startAngle": 0,
        "colors": [
            "rgba(240, 173, 78, 0.8)",
            "rgba(216, 84, 79, 0.8)",
        ],
        "marginBottom": 0,
        "marginTop": 0,
        "titleField": "category",
        "valueField": "column-1",
        "allLabels": [],
        "titles": [],
        "dataProvider": allCardStatusArray
    });

    var allCardTurnArray = {!! json_encode($allCardTurnArray) !!}; //php變數轉換

    AmCharts.makeChart("chart2", {
        "hideCredits": "true",
        "fontSize": 16,
        "type": "pie",
        "innerRadius": "60%",
        "labelRadius": 10,
        "minRadius": 50,
        "labelText": "[[title]][[percents]]%<br>共[[value]]張卡片",
        "startAngle": 0,
        "colors": [
            "rgba(240, 173, 78, 0.8)",
            "rgba(216, 84, 79, 0.8)",
        ],
        "marginBottom": 0,
        "marginTop": 0,
        "titleField": "category",
        "valueField": "column-1",
        "allLabels": [],
        "titles": [],
        "dataProvider": allCardTurnArray
    });

    // 數據切換圖表
    $(document).ready(function(){
        $('.chartwrap2').hide();
        $('.chart-select').on('change', function(){
            if($(this).val()=="已完成") {
                $('.chartwrap1').fadeIn(500);
                $('.chartwrap2').fadeOut(50);
            } else if ($(this).val()=="轉單") {
                $('.chartwrap1').fadeOut(50);
                $('.chartwrap2').fadeIn(500);
            }
        });
    });

    //週期儀錶板
    $("#hetao-sale").DataTable({
        "bPaginate": false,
        "searching": true,
        "info": false,
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
            "emptyTable": "目前無工單",
            "infoFiltered": "(從 _MAX_ 筆中篩選)",
        },
        "order": [],
        "columnDefs": [{
            "targets": [0],
            "orderable": false,
        }],
    });   
    $("#hetao-sale2").DataTable({
        "bPaginate": false,
        "searching": true,
        "info": false,
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
            "emptyTable": "目前無工單",
            "infoFiltered": "(從 _MAX_ 筆中篩選)",
        },
        "order": [],
        "columnDefs": [{
            "targets": [0],
            "orderable": false,
        }],
    });  
    </script>
@endsection