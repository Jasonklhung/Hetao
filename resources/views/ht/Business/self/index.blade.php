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
                                                                            <li class="divid"></li>
                                                                            <li><a data-toggle="modal" data-target="#op-alert" href="#">發布</a></li>
                                                                            <li class=""><a data-toggle="modal" data-target="#op-alert" href="#">追蹤</a></li>
                                                                            <li class=""><a data-toggle="modal" data-target="#op-alert" href="#">刪除</a></li>
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
                                                                    <div class="droptool no-fixed mr-s">
                                                                        <button class="btn btn-gray" type="button"><i class="fas fa-file-download"></i>
                                                                        </button>
                                                                        <ul class="droptool-menu no-fixed">
                                                                            <li><a href="javascript:void(0)">案件追蹤表</a></li>
                                                                            <li class=""><a href="javascript:void(0)">報價單</a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="droptool mr-s">
                                                                        <button class="btn btn-gray" type="button"><i class="fas fa-cog"></i>
                                                                        </button>
                                                                        <ul class="droptool-menu">
                                                                            <li>
                                                                                <input class="d-none" id='chkall2' type='checkbox' value='' /><label for='chkall2' class='sall'>
                                                                            </li>
                                                                            <li class="divid"></li>
                                                                            <li><a data-toggle="modal" data-target="#op-alert" href="#">發布</a></li>
                                                                            <li class=""><a data-toggle="modal" data-target="#op-alert" href="#">轉單</a></li>
                                                                            <li class=""><a data-toggle="modal" data-target="#op-alert" href="#">刪除</a></li>
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
                                                        <div class="chartwrap chartwrap1">
                                                            <div id="chart1" style="width: 100%; height: 500px;"></div>
                                                            <div id="chart2" style="width: 100%; height: 500px; background-color: #FFFFFF;"></div>
                                                        </div>
                                                        <div class="chartwrap2">
                                                            <div class="chartwrap">    
                                                                <div class="w-50 chart-border"> 
                                                                    <h4 class="text-center">追蹤筆數：40筆</h4>   
                                                                        <div id="chart3"></div>
                                                                </div>    
                                                                <div class="w-50 chart-border">
                                                                    <h4 class="text-center">各案件結單情況</h4> 
                                                                    <div>
                                                                        <div id="chart4" style="width: 100%; height: 300px;"></div>
                                                                        <ul>
                                                                            <li>結單總筆數：25筆</li>
                                                                            <li>參考成交總金額：$350,000元</li>
                                                                            <li>新增客戶數：5家</li>
                                                                        </ul>
                                                                    </div>    
                                                                </div>     
                                                            </div>
                                                            <div class="chartwrap">
                                                                <div class="w-50 chart-border">
                                                                    <h4 class="text-center">各機型銷售狀況</h4> 
                                                                    <div class="">
                                                                        <table id="hetao-sale">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="w-50">型號</th>
                                                                                    <th class="w-50 text-right">數量</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>  
                                                                                <tr>
                                                                                    <td>UW-1302</td>
                                                                                    <td class="text-right">6</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>UW-998</td>
                                                                                    <td class="text-right">7</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>UW-999</td>
                                                                                    <td class="text-right">10</td>
                                                                                </tr>
                                                                            </tbody>   
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <td colspan="2"><div class="divid"></div></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><p>產品總數：</p></td>
                                                                                    <td class="text-right"><p>23件</p></td>
                                                                                </tr>
                                                                            </tfoot> 
                                                                        </table>
                                                                    </div>    
                                                                </div>   
                                                                <div class="w-50">
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
<!-- Modal-轉mail -->
    <div class="modal fade" id="tomail" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">轉Mail</h4>
                </div>
                <div class="modal-body">
                    <iframe src="轉mailiframe.html"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">發送</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal-alert -->
    <div class="modal fade" id="op-alert" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">確認</button>
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

    var data = [{
            first: `
            <div class="td-icon">
                <input class="chkall" type="checkbox" value="">
            </div>
            `,
            day: "<spann class='text-nowrap'>2020-03-20</span>",
            level: "<span class='text-danger'>A</span>",
            progress: "已報價",
            kind: "商用",
            name: "愛酷智能",
            staff: "Cindy",
            phone: "<a href='tel:0212345678'>02-12345678</a>",
            reday: "<spann class='text-nowrap'>2020-03-25</span>",
            result: "",
            public: "<span class='text-success'>已發布</span>",
            watch: "<a href='案件紀錄-編輯.html' target='_blank'><button class='btn btn-primary' type='button'>查看</button>",
            uniform: "11111111",
            mail: "xxx@gmail.com",
            address: "台北市松山區敦化南路一段2號5樓",
            type: "UW-999 UW-998"
        },
        {
            first: `
            <div class="td-icon">
                <input class="chkall" type="checkbox" value="">
            </div>
            `,
            day: "<spann class='text-nowrap'>2020-03-20</span>",
            level: "<span class='text-danger'>A</span>",
            progress: "已報價",
            date: "<spann class='text-nowrap'>2019-10-01</span>",
            kind: "商用",
            name: "愛酷智能",
            staff: "Cindy",
            phone: "<a href='tel:0212345678'>02-12345678</a>",
            reday: "2020-03-25",
            result: "成交",
            public: "<span class='text-danger'>未發布</span>",
            watch: "<a href='案件紀錄-編輯.html' target='_blank'><button class='btn btn-primary' type='button'>查看</button>",
            uniform: "11111111",
            mail: "xxx@gmail.com",
            address: "台北市松山區敦化南路一段2號5樓",
            type: "UW-999 UW-998"
        },
    ];

    function format(d) {
        return (
            `<table class="tb-child">
                <tr>
                    <td>統編：` + d.uniform + `</td>
                    <td>信箱：` + d.mail + `</td>
                    <td>地址：` + d.address + `</td>
                </tr>
                <tr>
                    <td colspan="3">產品型號：` + d.type + `</td>
                </tr>
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
    });

    $(".droptool button").on('click', function() {
        $(this).parents('.droptool').siblings('.droptool .droptool-menu').hide();
        $(this).siblings('.droptool-menu').toggle('hide', false);
        if (!$(this).parent().hasClass('no-fixed')) {
            $(this).parents('.tab-pane').find('.td-icon .chkall').toggle('show');
        }
    });

    // modal-alert
    $('a[data-target="#op-alert"]').on('click', function() {
        var text = $(this).text()
        var checked = $("input.chkall")
        if ($(this).parents('.tab-pane').find(checked).filter(":checked").length >= 1) {
            $('#op-alert .modal-body').html(`
                <p>確定要` + text + `所選案件嗎？</p>
            `)
        } else {
            $('#op-alert .modal-body').html(`
                <p>您沒有選取案件唷！</p>
            `)
        }
    });

    // 圖表
    AmCharts.makeChart("chart1", {
        "hideCredits": "true",
        "fontSize": 16,
        "type": "pie",
        "innerRadius": "60%",
        "labelRadius": 10,
        "minRadius": 50,
        "labelText": "[[title]]: [[value]]筆",
        "startAngle": 0,
        "colors": [
            "#4194d4",
            "#fece78",
        ],
        "marginBottom": 0,
        "marginTop": 0,
        "titleField": "category",
        "valueField": "column-1",
        "allLabels": [],
        "titles": [],
        "dataProvider": [{
                "category": "業務工作",
                "column-1": "19"
            },
            {
                "category": "非業務工作",
                "column-1": "10"
            }
        ],
        "graphs": [{
            "balloonText": "[[category]]:[[value]]",
        }],
    });

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
        "allLabels": [],
        "balloon": {},
        "titles": [{
            "id": "Title-1",
            "size": 15,
            "text": ""
        }],
        "dataProvider": [{
                "category": "其他",
                "column-1": "1"
            },
            {
                "category": "協助安裝",
                "column-1": "2"
            },
            {
                "category": "送文件",
                "column-1": "0"
            },
            {
                "category": "收款",
                "column-1": "5"
            },
            {
                "category": "送機器",
                "column-1": "4"
            },
            {
                "category": "看現場",
                "column-1": "10"
            },
            {
                "category": "洽機",
                "column-1": "5"
            },
            {
                "category": "陌訪",
                "column-1": "2"
            },
            {
                "category": "拜訪",
                "column-1": "2"
            }
        ]
    });

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
            "#4194d4",
            "#fece78",
        ],
        "marginBottom": 0,
        "marginTop": 0,
        "titleField": "category",
        "valueField": "column-1",
        "allLabels": [],
        "titles": [],
        "dataProvider": [{
                "category": "業務工作",
                "column-1": "19"
            },
            {
                "category": "非業務工作",
                "column-1": "10"
            }
        ]
    });

    AmCharts.makeChart("chart4", {
        "hideCredits": "true",
        "fontSize": 16,
        "type": "pie",
        "innerRadius": "60%",
        "labelRadius": 10,
        "minRadius": 50,
        "labelText": "[[title]]: [[value]]人",
        "startAngle": 0,
        "colors": [
            "#4194d4",
            "#fece78",
            "#c3c3c3",
        ],
        "marginBottom": 0,
        "marginTop": 0,
        "titleField": "category",
        "valueField": "column-1",
        "allLabels": [],
        "titles": [],
        "dataProvider": [{
                "category": "成交",
                "column-1": "19"
            },
            {
                "category": "流單",
                "column-1": "5"
            },
            {
                "category": "其他",
                "column-1": "2"
            }
        ],
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
@endsection