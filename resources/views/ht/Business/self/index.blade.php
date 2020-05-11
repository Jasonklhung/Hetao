@extends('layout.app')

@section('content')
		<div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">業務管理</h3>
                    @include('common.message')
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-briefcase"></i>個人業務
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <!-- tab標籤 -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-01">拜訪紀錄</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-02">案件追蹤</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-03">相關數據</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 拜訪紀錄 -->
                                                    <div class="tab-pane active" id="viewers-tab-01">
                                                        <div class='coupon'>
                                                            <form class='form-inline'>
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s1" placeholder="請輸入關鍵字">
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
                                                                <select name="" class="form-control mb-s mr-s">
                                                                    <option selected hidden disabled value="">類型</option>
                                                                </select>
                                                                <select name="" class="form-control mb-s mr-s">
                                                                    <option selected hidden disabled value="">發布</option>
                                                                </select>
                                                                <select name="" class="form-control mb-s mr-s">
                                                                    <option selected hidden disabled value="">狀態</option>
                                                                </select>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="button">查詢</button>
                                                                    <button class='mr-s' type="button">重設</button>
                                                                    <a href="{{ route('ht.Business.self.create',['organization'=>$organization]) }}">   
                                                                        <button class='btn-bright mr-s' type="button">新增</button>
                                                                    </a>     
                                                                    <div class="droptool mr-s">
                                                                        <button class="btn btn-gray" type="button"><i class="fas fa-cog"></i>
                                                                        </button>
                                                                        <ul class="droptool-menu">
                                                                            <li>
                                                                                <input class="d-none" id='chkall1' type='checkbox' value='' /><label for='chkall1' class='sall'></label>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li><a data-toggle="modal" data-target="#op-alert1" href="#">發布</a></li>
                                                                            <li class=""><a data-toggle="modal" data-target="#op-alert2" href="#">追蹤</a></li>
                                                                            <li class=""><a data-toggle="modal" data-target="#op-alert3" href="#">刪除</a></li>
                                                                            <li><a href="#" data-toggle="modal" data-target="#tomail">轉Mail</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <table class="table table-hover dt-responsive table-striped W-100" id="hetao-list-s-1">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop"></th>
                                                                    <th class="desktop">拜訪日期</th>
                                                                    <th class="desktop">拜訪時間</th>
                                                                    <th class="desktop">業主名稱</th>
                                                                    <th class="desktop">拜訪類型</th>
                                                                    <th class="desktop">拜訪內容</th>
                                                                    <th class="desktop">地址</th>
                                                                    <th class="desktop">電話</th>
                                                                    <th class="desktop">發布</th>
                                                                    <th class="desktop">狀態</th>
                                                                    <th class="desktop">操作</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($visit as $key => $data)
                                                                <tr>
                                                                    <td>
                                                                        <div class="td-icon">
                                                                            <input class="chkall" type="checkbox" name="businessVisit" value="{{ $data->id }}">
                                                                            @if($data->file)
                                                                            <a href="{{ asset($data->file) }}"><i class="fas fa-paperclip"></i></a>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-nowrap">{{ $data->date }}</td>
                                                                    <td>{{ $data->time }}</td>
                                                                    <td>{{ $data->name }}</td>
                                                                    <td>{{ $data->type }}</td>
                                                                    <td>{{ $data->content }}</td>
                                                                    <td><a href="https://www.google.com.tw/maps/place/{{ $data->city }}{{ $data->area }}{{ $data->address }}" target="_blank">{{ $data->city }}{{ $data->area }}{{ $data->address }}</a></td>
                                                                    <td><a class="text-nowrap" href="tel:{{ $data->phone }}">{{ $data->phone }}</a></td>
                                                                    @if($data->statusOpen == 'Y')
                                                                    <td><span class="text-success text-nowrap">已發布</span></td>
                                                                    @else
                                                                    <td><span class="text-danger text-nowrap">未發布</span></td>
                                                                    @endif

                                                                    @if($data->statusTrack == 'Y')
                                                                    <td><span class="text-success text-nowrap">已追蹤</span></td>
                                                                    @else
                                                                    <td><span class="text-danger text-nowrap">未追蹤</span></td>
                                                                    @endif
                                                                    <td><a href="{{ route('ht.Business.self.visitEdit',['organization'=>$organization,'id'=>$data->id]) }}"><button class="btn btn-primary" type="button">查看</button></td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- 案件追蹤 -->
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
                                                                <select name="" class="form-control mb-s mr-s">
                                                                    <option value="">等級</option>
                                                                </select>
                                                                <select name="" class="form-control mb-s mr-s">
                                                                    <option value="">進度</option>
                                                                </select>
                                                                <select name="" class="form-control mb-s mr-s">
                                                                    <option value="">類別</option>
                                                                </select>
                                                                <select name="" class="form-control mb-s mr-s">
                                                                    <option value="">型號</option>
                                                                </select>
                                                                <select name="" class="form-control mb-s mr-s">
                                                                    <option value="">結果</option>
                                                                </select>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="button">查詢</button>
                                                                    <button class='mr-s' type="button">重設</button>
                                                                    <!-- <div class="droptool no-fixed mr-s">
                                                                        <button class="btn btn-gray" type="button"><i class="fas fa-file-download"></i>
                                                                        </button>
                                                                        <ul class="droptool-menu no-fixed">
                                                                            <li><a href="javascript:void(0)">案件追蹤表</a></li>
                                                                            <li><a data-toggle="modal" data-target="#op-alert7" href="#">案件追蹤表</a></li>
                                                                            <li><a data-toggle="modal" data-target="#op-alert8" href="#">報價單</a></li>
                                                                            <li class=""><a href="javascript:void(0)">報價單</a></li>
                                                                        </ul>
                                                                    </div> -->
                                                                    <div class="droptool mr-s">
                                                                        <button class="btn btn-gray" type="button"><i class="fas fa-cog"></i>
                                                                        </button>
                                                                        <ul class="droptool-menu">
                                                                            <li>
                                                                                <input class="d-none" id='chkall2' type='checkbox' value='' /><label for='chkall2' class='sall'>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li><a data-toggle="modal" data-target="#op-alert4" href="#">發布</a></li>
                                                                            <li class=""><a data-toggle="modal" data-target="#op-alert5" href="#">轉單</a></li>
                                                                            <li class=""><a data-toggle="modal" data-target="#op-alert6" href="#">刪除</a></li>
                                                                            <li><a data-toggle="modal" data-target="#op-alert7" href="#">案件追蹤表下載</a></li>
                                                                            <li><a data-toggle="modal" data-target="#op-alert8" href="#">報價單下載</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-norwd">
                                                            <thead>
                                                                <tr>
                                                                    <th class="desktop"></th>
                                                                    <th class="desktop"></th>
                                                                    <th class="desktop">日期</th>
                                                                    <th class="desktop">
                                                                        <div class="d-flex">
                                                                            客戶等級
                                                                            <button class="levelinfo" type="button">
                                                                                <i class="fas fa-info-circle text-bright"></i>
                                                                                <ul class="levelinfo-menu">
                                                                                    <li><span class="text-danger">A級</span>：重點客戶 (有立即需求)</li>
                                                                                    <li><span class="text-primary">B級</span>：中級客戶 (有需求但需要等超過一個月)</li>
                                                                                    <li><span class="text-success">C級</span>：有需求但需要等超過兩個月</li>
                                                                                    <li><span class="text-warning">D級</span>：有詢價但無立即需求</li>
                                                                                </ul>
                                                                            </button>
                                                                        </div>
                                                                    </th>
                                                                    <th class="desktop">案件進度</th>
                                                                    <th class="desktop">類別</th>
                                                                    <th class="desktop">客戶名稱</th>
                                                                    <th class="desktop">承辦人</th>
                                                                    <th class="desktop">電話</th>
                                                                    <th class="desktop">覆訪日期</th>
                                                                    <th class="desktop">結果</th>
                                                                    <th class="desktop">發布</th>
                                                                    <th class="desktop">操作</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                    <!-- 相關數據 -->
                                                    <div class="tab-pane" id="viewers-tab-03">
                                                        <div class='coupon w-100'>
                                                            <form class='form-inline'>
                                                                <div class='form-group mr-s'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date month-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div>
                                                                </div>
                                                                <button class='mr-s mb-s' type="button">查詢</button>
                                                                <select class='form-control mb-s float-right chart-select'>
                                                                    <option selected value="拜訪紀錄">拜訪紀錄</option>
                                                                    <option value="案件追蹤">案件追蹤</option>
                                                                </select>
                                                            </form>
                                                        </div>
                                                        <div class="chartwrap chartwrap1 mt-s">
                                                            <!-- <div id="chart1" style="width: 100%; height: 500px;"></div> -->
                                                            <div id="chart2" style="width: 100%; height: 500px; background-color: #FFFFFF;"></div>
                                                        </div>
                                                        <div class="chartwrap2">
                                                            <div class="chartwrap">    
                                                                <!-- <div class="w-50 chart-border"> 
                                                                    <h4 class="text-center">追蹤筆數：{{$trackChartCount}}筆</h4> 
                                                                        <div id="chart3"></div>
                                                                </div>   -->  
                                                                <div class="w-50 chart-border">
                                                                    <h4 class="text-center">各案件結單情況</h4> 
                                                                    <div>
                                                                        <div id="chart4" style="width: 100%; height: 300px;"></div>
                                                                        <ul>
                                                                            <li>結單總筆數：{{$finishChartCount}}筆</li>
                                                                            <li>參考成交總金額：${{$money}}元</li>
                                                                            <li>新增客戶數：{{$newCustomChartCount}}家</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="w-50 chart-border">
                                                                    <h4 class="text-center">各機型銷售狀況</h4> 
                                                                    <div class="">
                                                                        <table id="hetao-sale" class="mt-0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="w-50">型號</th>
                                                                                    <th class="w-50 text-right">數量</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($numberChart as $key => $data)
                                                                                <tr>
                                                                                    <td>{{$key}}</td>
                                                                                    <td class="text-right">{{$data}}</td>
                                                                                </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <td colspan="2"><div class="divid"></div></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><p>產品總數：</p></td>
                                                                                    <td class="text-right"><p>{{$numberTotalChart}}件</p></td>
                                                                                </tr>
                                                                            </tfoot> 
                                                                        </table>
                                                                    </div>    
                                                                </div>      
                                                            </div>
                                                            <!-- <div class="chartwrap">
                                                                <div class="w-50 chart-border">
                                                                    <h4 class="text-center">各機型銷售狀況</h4> 
                                                                    <div class="">
                                                                        <table id="hetao-sale" class="mt-0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="w-50">型號</th>
                                                                                    <th class="w-50 text-right">數量</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($numberChart as $key => $data)
                                                                                <tr>
                                                                                    <td>{{$key}}</td>
                                                                                    <td class="text-right">{{$data}}</td>
                                                                                </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <td colspan="2"><div class="divid"></div></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><p>產品總數：</p></td>
                                                                                    <td class="text-right"><p>{{$numberTotalChart}}件</p></td>
                                                                                </tr>
                                                                            </tfoot> 
                                                                        </table>
                                                                    </div>    
                                                                </div>   
                                                                <div class="w-50">
                                                                </div> 
                                                            </div> -->
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
<!-- Modal-轉mail -->
    <div class="modal fade" id="tomail" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">轉Mail</h4>
                </div>
                <!-- <div class="modal-body">
                    <iframe src="轉mailiframe.html"></iframe>
                </div> -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="sendMail" data-dismiss="modal">預覽</button>
                </div>
            </div>
        </div>
    </div>
    <!--拜訪紀錄-發布 -->
    <div class="modal fade" id="op-alert1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="visitOpen" data-dismiss="modal">確認</button>
                </div>
            </div>
        </div>
    </div>
    <!--拜訪紀錄-追蹤 -->
    <div class="modal fade" id="op-alert2" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="visitTrack" data-dismiss="modal">確認</button>
                </div>
            </div>
        </div>
    </div>
    <!--拜訪紀錄-刪除 -->
    <div class="modal fade" id="op-alert3" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="visitDel" data-dismiss="modal">確認</button>
                </div>
            </div>
        </div>
    </div>
    <!--案件追蹤-發布 -->
    <div class="modal fade" id="op-alert4" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="trackOpen" data-dismiss="modal">確認</button>
                </div>
            </div>
        </div>
    </div>
    <!--案件追蹤-轉單 -->
    <div class="modal fade" id="op-alert5" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="trackTurn" data-dismiss="modal">確認</button>
                </div>
            </div>
        </div>
    </div>
    <!--案件追蹤-刪除 -->
    <div class="modal fade" id="op-alert6" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="trackDel" data-dismiss="modal">確認</button>
                </div>
            </div>
        </div>
    </div>
    <!--案件追蹤表下載 -->
    <div class="modal fade" id="op-alert7" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="track_excel" data-dismiss="modal">確認</button>
                </div>
            </div>
        </div>
    </div>
    <!--報價單下載 -->
    <div class="modal fade" id="op-alert8" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="word_download" data-dismiss="modal">確認</button>
                </div>
            </div>
        </div>
    </div>
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
    var table_s1 = $("#hetao-list-s-1").DataTable({
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
            "targets": [0, 10],
            "orderable": false,
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
    $(".searchInput_s1").on("blur", function() {
        table_s1.search(this.value).draw();
    });

    $(".searchInput_s1").on("keyup", function() {
        table_s1.search(this.value).draw();
    });

    var track = {!! json_encode($track) !!}; //php變數轉換

    var data = new Array();

    $.each(track, function (i, item) {

        if(item.statusOpen == 'Y'){
            var statusOpen = "<span class='text-success'>已發布</span>"
        }
        else{
            var statusOpen = "<span class='text-danger'>未發布</span>"
        }

        if(item.date_again == null){
            var date_again = ''
        }
        else{
            var date_again = item.date_again
        }

        if(item.uniform_numbers == null){
            var uniform_numbers = ''
        }
        else{
            var uniform_numbers = item.uniform_numbers
        }

        if(item.email == null){
            var email = ''
        }
        else{
            var email = item.email
        }

        if(item.level == null){
            var level = ''
        }
        else if(item.level == 'A'){
            var level = "<span class='text-danger'>A</span>"
        }
        else if(item.level == 'B'){
            var level = "<span class='text-primary'>B</span>"
        }
        else if(item.level == 'C'){
            var level = "<span class='text-success'>C</span>"
        }
        else if(item.level == 'D'){
            var level = "<span class='text-warning'>D</span>"
        }

        var url = '{{ route('ht.Business.self.trackEdit',['organization'=>$organization,'id'=>':id']) }}'
        url = url.replace(':id',item.id);

        data[i] = {
            first: `
            <div class="td-icon">
                <input class="chkall" type="checkbox" name="businessTrack" value="`+item.id+`">
            </div>
            `,
            day: "<spann class='text-nowrap'>"+item.date+"</span>",
            level: level,
            progress: item.schedule,
            kind: item.category,
            name: item.name,
            staff: item.business_name,
            phone: "<a href='tel:"+item.phone+"'>"+item.phone+"</a>",
            reday: "<spann class='text-nowrap'>"+date_again+"</span>",
            result: item.result,
            public: statusOpen,
            watch: "<a href='"+url+"'><button class='btn btn-primary' type='button'>查看</button>",
            uniform: uniform_numbers,
            mail: email,
            address: item.address,
            type: "test"
        }
    })

    function format(d) {
        return (
            `<table class="tb-child">
                <tr class='rwd-show'><td><span class='w-105px'>發布：</span>` + d.public + `</td></tr>            
                <tr class='rwd-show'><td><span class='w-105px'>進度：</span>` + d.progress + `</td></tr>
                <tr class='rwd-show'><td><span class='w-105px'>類別：</span>` + d.kind + `</td></tr>
                <tr class='rwd-show'><td><span class='w-105px'>承辦人：</span>` + d.staff + `</td></tr>
                <tr><td><span class='w-105px'>統編：</span>` + d.uniform + `</td></tr>
                <tr><td><span class='w-105px'>信箱：</span>` + d.mail + `</td></tr>
                <tr><td><span class='w-105px'>地址：</span>` + d.address + `</td></tr>
                <tr><td colspan="3"><span class='w-105px'>產品型號：</span>` + d.type + `</td></tr>                
                <tr class='rwd-show'><td><span class='w-105px'>覆訪日期：</span>` + d.reday + `</td></tr>
                <tr class='rwd-show'><td><span class='w-105px'>結果：</span>` + d.result + `</td></tr>
                <tr class='rwd-show'><td><span class='w-105px'>操作：</span>` + d.watch + `</td></tr>
            </table>`
        );
    }
    $(document).ready(function() {
        var table_s2 = $("#hetao-list-norwd").DataTable({
            "data": data,
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
                "targets": [0, 12],
                "orderable": false,
            }, ],
            "responsive": false,
            autoWidth: false,
            columns: [
                { data: "first" },
                {
                    className: "details-control",
                    orderable: false,
                    data: null,
                    defaultContent: '<span class="lnr lnr-chevron-down"></span>'
                },
                { data: "day" },
                { data: "level" },
                { data: "progress" },
                { data: "kind" },
                { data: "name" },
                { data: "staff" },
                { data: "phone" },
                { data: "reday" },
                { data: "result" },
                { data: "public" },
                { data: "watch" }

            ],
        });

        $("#hetao-list-norwd tbody").on("click", "td.details-control", function() {
            var tr = $(this).closest("tr");
            var row = table_s2.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass("shown");
            } else {
                row.child(format(row.data()), "p-0").show();
                tr.addClass("shown");
            }
        });

        $(".searchInput_s2").on("blur", function() {
            table_s2.search(this.value).draw();
        });

        $(".searchInput_s2").on("keyup", function() {
            table_s2.search(this.value).draw();
        });

        //rwd讓欄位消失
        window.onresize = function() {
              var w = this.innerWidth;
              table_s2.column(4).visible( w > 768);
              table_s2.column(5).visible( w > 768);
              table_s2.column(7).visible( w > 768);
              table_s2.column(9).visible( w > 768);
              table_s2.column(10).visible( w > 768);
              table_s2.column(11).visible( w > 768);  
              table_s2.column(12).visible( w > 768);  
            }
        //trigger upon pageload
        $(window).trigger('resize');
    });

    $(".droptool button").on('click', function() {
        $(this).parents('.droptool').siblings('.droptool .droptool-menu').hide();
        $(this).siblings('.droptool-menu').toggle('hide', false);
        if (!$(this).parent().hasClass('no-fixed')) {
            $(this).parents('.tab-pane').find('.td-icon .chkall').toggle('show');
        }
    });

    // modal-alert
    $('a[data-target="#op-alert1"]').on('click', function() {
        var text = $(this).text()
        var checked = $("input.chkall")
        if ($(this).parents('.tab-pane').find(checked).filter(":checked").length >= 1) {
            $('#op-alert1 .modal-body').html(`
                <p>確定要` + text + `所選案件嗎？</p>
            `)
        } else {
            $('#op-alert1 .modal-body').html(`
                <p>您沒有選取案件唷！</p>
            `)
        }
    });
    $('a[data-target="#op-alert2"]').on('click', function() {
        var text = $(this).text()
        var checked = $("input.chkall")
        if ($(this).parents('.tab-pane').find(checked).filter(":checked").length >= 1) {
            $('#op-alert2 .modal-body').html(`
                <p>確定要` + text + `所選案件嗎？</p>
            `)
        } else {
            $('#op-alert2 .modal-body').html(`
                <p>您沒有選取案件唷！</p>
            `)
        }
    });
    $('a[data-target="#op-alert3"]').on('click', function() {
        var text = $(this).text()
        var checked = $("input.chkall")
        if ($(this).parents('.tab-pane').find(checked).filter(":checked").length >= 1) {
            $('#op-alert3 .modal-body').html(`
                <p>確定要` + text + `所選案件嗎？</p>
            `)
        } else {
            $('#op-alert3 .modal-body').html(`
                <p>您沒有選取案件唷！</p>
            `)
        }
    });
    $('a[data-target="#op-alert4"]').on('click', function() {
        var text = $(this).text()
        var checked = $("input.chkall")
        if ($(this).parents('.tab-pane').find(checked).filter(":checked").length >= 1) {
            $('#op-alert4 .modal-body').html(`
                <p>確定要` + text + `所選案件嗎？</p>
            `)
        } else {
            $('#op-alert4 .modal-body').html(`
                <p>您沒有選取案件唷！</p>
            `)
        }
    });
    $('a[data-target="#op-alert5"]').on('click', function() {
        var text = $(this).text()
        var checked = $("input.chkall")
        if ($(this).parents('.tab-pane').find(checked).filter(":checked").length >= 1) {
            $('#op-alert5 .modal-body').html(`
                <p>確定要` + text + `所選案件嗎？</p>
            `)
        } else {
            $('#op-alert5 .modal-body').html(`
                <p>您沒有選取案件唷！</p>
            `)
        }
    });
    $('a[data-target="#op-alert6"]').on('click', function() {
        var text = $(this).text()
        var checked = $("input.chkall")
        if ($(this).parents('.tab-pane').find(checked).filter(":checked").length >= 1) {
            $('#op-alert6 .modal-body').html(`
                <p>確定要` + text + `所選案件嗎？</p>
            `)
        } else {
            $('#op-alert6 .modal-body').html(`
                <p>您沒有選取案件唷！</p>
            `)
        }
    });
    $('a[data-target="#op-alert7"]').on('click', function() {
        var text = $(this).text()
        var checked = $("input.chkall")
        if ($(this).parents('.tab-pane').find(checked).filter(":checked").length >= 1) {
            $('#op-alert7 .modal-body').html(`
                <p>確定要` + text + `所選案件嗎？</p>
            `)
        } else {
            $('#op-alert7 .modal-body').html(`
                <p>您沒有選取案件唷！</p>
            `)
        }
    });
    $('a[data-target="#op-alert8"]').on('click', function() {
        var text = $(this).text()
        var checked = $("input.chkall")
        if ($(this).parents('.tab-pane').find(checked).filter(":checked").length >= 1) {
            $('#op-alert8 .modal-body').html(`
                <p>確定要` + text + `所選案件嗎？</p>
            `)
        } else {
            $('#op-alert8 .modal-body').html(`
                <p>您沒有選取案件唷！</p>
            `)
        }
    });


    // var businessChartCount = {!! json_encode($businessChartCount) !!};

    // // 圖表
    // AmCharts.makeChart("chart1", {
    //     "hideCredits": "true",
    //     "fontSize": 16,
    //     "type": "pie",
    //     "innerRadius": "60%",
    //     "labelRadius": 10,
    //     "minRadius": 50,
    //     "labelText": "[[title]]: [[value]]筆",
    //     "startAngle": 0,
    //     "colors": [
    //         "#4194d4",
    //         "#fece78",
    //     ],
    //     "marginBottom": 0,
    //     "marginTop": 0,
    //     "titleField": "category",
    //     "valueField": "column-1",
    //     "allLabels": [],
    //     "titles": [],
    //     "dataProvider": businessChartCount,
    //     "graphs": [{
    //         "balloonText": "[[category]]:[[value]]",
    //     }],
    // });

    var businessChart = {!! json_encode($businessChart) !!};
    var allBusinessMonth = {!! json_encode($allBusinessMonth) !!};

    AmCharts.makeChart("chart2", {
        "hideCredits": "true",
        "type": "serial",
        "fontSize": 16,
        "categoryField": "category",
        "rotate": true,
        "colors": [
            "#4194d4"
        ],
        "startDuration": 1,
        "categoryAxis": {
            "gridPosition": "start"
        },
        "trendLines": [],
        "graphs": [{
            "balloonText": "[[category]]:[[value]]",
            "columnWidth": 0.4,
            "fillAlphas": 1,
            "id": "AmGraph-1",
            "title": "graph 1",
            "type": "column",
            "valueField": "column-1"
        }],
        "guides": [],
        "valueAxes": [{
            "id": "ValueAxis-1",
            "title": ""
        }],
        "allLabels": [{
            "id": "Label-1",
            "text": "當月紀錄總筆數："+allBusinessMonth
        }],
        "balloon": {},
        "titles": [{
            "id": "Title-1",
            "size": 15,
            "text": ""
        }],
        "dataProvider": businessChart
    });

    var TrackBusinessChartCount = {!! json_encode($TrackBusinessChartCount) !!};

    AmCharts.makeChart("chart3", {
        "hideCredits": "true",
        "fontSize": 16,
        "type": "pie",
        "innerRadius": "60%",
        "labelRadius": 10,
        "minRadius": 50,
        "labelText": "[[title]]: [[value]]人",
        "startAngle": 0,
        "colors": [
            "#50b57e",
            // "#df7571",
            "#fece78",
            "#c3c3c3",
        ],
        "marginBottom": 0,
        "marginTop": 0,
        "titleField": "category",
        "valueField": "column-1",
        "allLabels": [],
        "titles": [],
        "dataProvider": TrackBusinessChartCount
    });

    var resultChart = {!! json_encode($resultChart) !!};

    AmCharts.makeChart("chart4", {
        "hideCredits": "true",
        "fontSize": 16,
        "type": "pie",
        "innerRadius": "60%",
        "labelRadius": 10,
        "minRadius": 50,
        "labelText": "[[title]]: [[value]]筆",
        "startAngle": 0,
        "colors": [
            "#50b57e",
            "#df7571",
            "#fece78",
            "#c3c3c3",
        ],
        "marginBottom": 0,
        "marginTop": 0,
        "titleField": "category",
        "valueField": "column-1",
        "allLabels": [],
        "titles": [],
        "dataProvider": resultChart,
        "legend": {
            "enabled":true,
            "align": "center",
            "markerType": "circle"
        },
    });

    // 數據切換圖表
    $(document).ready(function(){
        $('.chartwrap2').hide();
        $('.chart-select').on('change', function(){
            if($(this).val()=="拜訪紀錄") {
                $('.chartwrap1').fadeIn(500);
                $('.chartwrap2').fadeOut(50);
            } else if ($(this).val()=="案件追蹤") {
                $('.chartwrap1').fadeOut(50);
                $('.chartwrap2').fadeIn(500);
            }
        });
    });

    // 圖表連結
    $('body').on('click', '#chart1 text, #chart3 text, #chart4 text', function(){
        window.location.href='個人業務(圖表連結用).html';
    })

    //機型銷售狀況
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
            "targets": [],
            "orderable": false,
        }],
    });
        
</script>
<script type="text/javascript">

    //拜訪紀錄-發布
    $('#visitOpen').on('click',function(){

        var count = 0

        $('input[name="businessVisit"]:checked').each(function(){

           var id = $(this).val()

           $.ajax({
            type:'post',
            url:"{{ route('ht.Business.self.businessVisitChangeStatus',['organization'=>$organization]) }}",
            data:{
                '_token':'{{csrf_token()}}',
                'type':'open',
                'id':id
            },
            success:function(res){
                if(res.status == 200 && count == 0){
                    count += 1;
                    alert('已完成發布');
                    window.location = '{{ route('ht.Business.self.index',['organization'=>$organization]) }}'
                }
            }
        })
       })
    })

    //拜訪紀錄-追蹤
    $('#visitTrack').on('click',function(){

        var count = 0

        $('input[name="businessVisit"]:checked').each(function(){

           var id = $(this).val()

           $.ajax({
            type:'post',
            url:"{{ route('ht.Business.self.businessVisitChangeStatus',['organization'=>$organization]) }}",
            data:{
                '_token':'{{csrf_token()}}',
                'type':'track',
                'id':id
            },
            success:function(res){
                if(res.status == 200 && count == 0){
                    count += 1;
                    alert('已完成追蹤');
                    window.location = '{{ route('ht.Business.self.index',['organization'=>$organization]) }}'
                }
            }
        })
       })
    })

    //拜訪紀錄-刪除
    $('#visitDel').on('click',function(){

        var count = 0

        $('input[name="businessVisit"]:checked').each(function(){

           var id = $(this).val()

           $.ajax({
            type:'post',
            url:"{{ route('ht.Business.self.businessVisitChangeStatus',['organization'=>$organization]) }}",
            data:{
                '_token':'{{csrf_token()}}',
                'type':'delete',
                'id':id
            },
            success:function(res){
                if(res.status == 200 && count == 0){
                    count += 1;
                    alert('已完成刪除');
                    window.location = '{{ route('ht.Business.self.index',['organization'=>$organization]) }}'
                }
            }
        })
       })
    })

    //案件追蹤-發布
    $('#trackOpen').on('click',function(){

        var count = 0

        $('input[name="businessTrack"]:checked').each(function(){

           var id = $(this).val()

           $.ajax({
            type:'post',
            url:"{{ route('ht.Business.self.businessTrackChangeStatus',['organization'=>$organization]) }}",
            data:{
                '_token':'{{csrf_token()}}',
                'type':'open',
                'id':id
            },
            success:function(res){
                if(res.status == 200 && count == 0){
                    count += 1;
                    alert('已完成發布');
                    window.location = '{{ route('ht.Business.self.index',['organization'=>$organization]) }}'
                }
            }
        })
       })
    })



    //案件追蹤-刪除
    $('#trackDel').on('click',function(){

        var count = 0

        $('input[name="businessTrack"]:checked').each(function(){

           var id = $(this).val()

           $.ajax({
            type:'post',
            url:"{{ route('ht.Business.self.businessTrackChangeStatus',['organization'=>$organization]) }}",
            data:{
                '_token':'{{csrf_token()}}',
                'type':'delete',
                'id':id
            },
            success:function(res){
                if(res.status == 200 && count == 0){
                    count += 1;
                    alert('已完成刪除');
                    window.location = '{{ route('ht.Business.self.index',['organization'=>$organization]) }}'
                }
            }
        })
       })
    })


    //案件追蹤-轉mail
    $('#sendMail').on('click',function(){

        var mailIdArray = new Array();

        $('input[name="businessVisit"]:checked').each(function(){

           var id = $(this).val()

           mailIdArray.push(id)
       })

        $.ajax({
            type:'post',
            url:"{{ route('ht.Business.self.sendMail',['organization'=>$organization]) }}",
            data:{
                '_token':'{{csrf_token()}}',
                'id':mailIdArray
            },
            success:function(res){

                var row = "";

                if(res.status == 200){

                    $.each(res.data, function (i, item) {

                        row += i+1+".%20%20"+item.name+"%0D%0D%20%20%20%20%20"+item.type+"%20%20,%20"+item.content+"。%20%20"+item.time+"%0D%0D%20%20%20%20%20備註："+item.other+"%0D%0D"
                    })

                    window.open("mailto:?subject="+res.subject+"&body=業務拜訪紀錄%0D%0D"+res.body+"%0D%0D攻擊:%0D%0D"+row)
                }
            }
        })
    })

    //案件追蹤-案件追蹤表
    $('#track_excel').on('click',function(){

        var trackArray = new Array();

        $('input[name="businessTrack"]:checked').each(function(){

           var id = $(this).val()

           trackArray.push(id)
       })

        $.ajax({
            xhrFields: {
                responseType: 'blob',
            },
            type:'post',
            url:"{{ route('ht.Business.self.trackExcel',['organization'=>$organization]) }}",
            data:{
                '_token':'{{csrf_token()}}',
                'id':trackArray
            },
            success: function(result, status, xhr) {

                var disposition = xhr.getResponseHeader('content-disposition');
                var matches = /"([^"]*)"/.exec(disposition);
                var filename = (matches != null && matches[1] ? matches[1] : '案件追蹤表.xlsx');

                var blob = new Blob([result], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = filename;

                document.body.appendChild(link);

                link.click();
                document.body.removeChild(link);

                window.location = '{{ route('ht.Business.self.index',['organization'=>$organization]) }}'
            }
        })
    })

        //案件追蹤-報價單下載
        $('#word_download').on('click',function(){

            var trackArray = new Array();

            $('input[name="businessTrack"]:checked').each(function(){

               var id = $(this).val()

               trackArray.push(id)
           })

            $.ajax({
                xhrFields: {
                    responseType: 'blob',
                },
                type:'post',
                url:"{{ route('ht.Business.self.trackWord',['organization'=>$organization]) }}",
                data:{
                    '_token':'{{csrf_token()}}',
                    'id':trackArray
                },
                success: function(result, status, xhr) {

                    var disposition = xhr.getResponseHeader('content-disposition');
                    var matches = /"([^"]*)"/.exec(disposition);
                    var filename = (matches != null && matches[1] ? matches[1] : '報價單.docx');

                    var blob = new Blob([result], {
                        type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = filename;

                    document.body.appendChild(link);

                    link.click();
                    document.body.removeChild(link);

                    window.location = '{{ route('ht.Business.self.index',['organization'=>$organization]) }}'
                }
            })
        })
</script>
@endsection