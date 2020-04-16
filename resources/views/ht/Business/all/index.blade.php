@extends('layout.app')

@section('content')
		<div class="main">
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
                                            <i class="fas fa-briefcase"></i>全站業務
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <!-- tab標籤 -->
                                                <ul class="nav nav-tabs">
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-01">拜訪紀錄檢視</a>
                                                    </li>
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-02">案件追蹤檢視</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-03">相關數據檢視</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 拜訪紀錄 -->
                                                    <div class="tab-pane" id="viewers-tab-01">
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
                                                                    <option selected hidden disabled value="">時間</option>
                                                                    <option value="">早上(AM)</option>
                                                                    <option value="">下午(PM)</option>
                                                                </select>
                                                                <select name="" class="form-control mb-s mr-s">
                                                                    <option selected hidden disabled value="">業務</option>
                                                                </select>
                                                                <select name="" class="form-control mb-s mr-s">
                                                                    <option selected hidden disabled value="">類型</option>
                                                                </select>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="button">查詢</button>
                                                                    <button class='mr-s' type="button">重設</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <table class="table table-hover dt-responsive table-striped W-100" id="hetao-list-s-1">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">拜訪日期</th>
                                                                    <th class="desktop">拜訪時間</th>
                                                                    <th class="desktop">業主名稱</th>
                                                                    <th class="desktop">業務人員</th>
                                                                    <th class="desktop">拜訪類型</th>
                                                                    <th class="desktop">拜訪內容</th>
                                                                    <th class="desktop">地址</th>
                                                                    <th class="desktop">電話</th>
                                                                    <th class="desktop">備註</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-nowrap">2020-03-20</td>
                                                                    <td>早上(AM)</td>
                                                                    <td>賀桃企業</td>
                                                                    <td></td>
                                                                    <td>陌訪</td>
                                                                    <td>介紹機器</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a class="text-nowrap" href="tel:0222346789">02-22346789</a></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-nowrap">2020-03-20</td>
                                                                    <td>早上(AM)</td>
                                                                    <td>賀桃企業</td>
                                                                    <td></td>
                                                                    <td>陌訪</td>
                                                                    <td>介紹機器</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a class="text-nowrap" href="tel:0222346789">02-22346789</a></td>
                                                                    <td></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- 案件追蹤 -->
                                                    <div class="tab-pane active" id="viewers-tab-02">
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
                                                                    <option value="">業務</option>
                                                                </select>
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
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-norwd">
                                                            <thead>
                                                                <tr>
                                                                    <th class="desktop"></th>
                                                                    <th class="desktop"></th>
                                                                    <th class="desktop">日期</th>
                                                                    <th class="desktop">業務人員</th>
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
                                                                            <input class='form-control' placeholder='選擇月份' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div>
                                                                    <select class='form-control ml-s float-right sales-select'>
                                                                        <option selected value="">王小明</option>
                                                                        <option value="">曾曾</option>
                                                                        <option value="">Cindy</option>
                                                                    </select>
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
                                                                <div class="w-100 charts-border"> 
                                                                    <div class="col-sm-12 mt-s">
                                                                        <select class='form-control ml-s sales-select mt-s'>
                                                                            <option selected value="">王小明</option>
                                                                            <option value="">曾曾</option>
                                                                        </select>
                                                                    </div>    
                                                                    <div class="col-sm-6">
                                                                        <h4 class="mt-m text-center">追蹤筆數：40筆</h4>   
                                                                        <div class="bd-right" id="chart3" style="width: 100%; height: 300px;"></div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <h4 class="mt-m text-center">各案件結單情況</h4> 
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
                                                            </div>
                                                            <div class="chartwrap">
                                                                <div class="w-100 charts-border">
                                                                    <h4 class="text-center">各機型銷售狀況</h4>
                                                                    <div class="d-flex p-s">
                                                                        <div class="w-50">
                                                                            <div id="chart5" style="width: 100%; height: 300px;"></div>
                                                                        </div>    
                                                                        <div class="w-50 mt-s">
                                                                            <select class='form-control products-select mb-s'>
                                                                                <option selected value="">UW-999</option>
                                                                                <option value="">UW-1303</option>
                                                                                <option value="">UW-1302</option>
                                                                                <option value="">UW-997</option>
                                                                                <option value="">UW-998</option>
                                                                            </select>
                                                                            <table id="hetao-sale">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="w-50">業務</th>
                                                                                        <th class="w-50">數量</th>
                                                                                    </tr>
                                                                                </thead>   
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>王小明</td>
                                                                                        <td class="text-right">6</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>曾曾</td>
                                                                                        <td class="text-right">7</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Cindy</td>
                                                                                        <td class="text-right">10</td>
                                                                                    </tr>
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
            "targets": [],
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
            sales: "王小明",
            level: "<span class='text-danger'>A</span>",
            progress: "已報價",
            kind: "商用",
            name: "愛酷智能",
            staff: "Cindy",
            phone: "<a href='tel:0212345678'>02-12345678</a>",
            reday: "<spann class='text-nowrap'>2020-03-25</span>",
            result: "",
            watch: "<a href='案件紀錄-檢視.html' target='_blank'><button class='btn btn-primary' type='button'>查看</button>",
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
            sales: "王小明",
            level: "<span class='text-danger'>A</span>",
            progress: "已報價",
            date: "<spann class='text-nowrap'>2019-10-01</span>",
            kind: "商用",
            name: "愛酷智能",
            staff: "Cindy",
            phone: "<a href='tel:0212345678'>02-12345678</a>",
            reday: "2020-03-25",
            result: "成交",
            watch: "<a href='案件紀錄-檢視.html' target='_blank'><button class='btn btn-primary' type='button'>查看</button>",
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
                { data: "sales" },
                { data: "level" },
                { data: "progress" },
                { data: "kind" },
                { data: "name" },
                { data: "staff" },
                { data: "phone" },
                { data: "reday" },
                { data: "result" },
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
                "category": "非業務工作支援",
                "column-1": "10"
            }
        ]
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
                "category": "結單",
                "column-1": "19"
            },
            {
                "category": "未結單",
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
        "labelText": "[[title]]: [[value]]筆",
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

AmCharts.makeChart("chart5", {
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
                "category": "UW-999",
                "column-1": "1"
            },
            {
                "category": "UW-1303",
                "column-1": "2"
            },
            {
                "category": "UW-1302",
                "column-1": "0"
            },
            {
                "category": "UW-997",
                "column-1": "5"
            },
            {
                "category": "UW-998",
                "column-1": "4"
            },
        ]
    });

    // 數據切換圖表
    $(document).ready(function(){
        $('.chartwrap2').hide();
        $('.chart-select').on('change', function(){
            if($(this).val()=="拜訪紀錄") {
                $('.chartwrap1').fadeIn(500);
                $('.chartwrap2').fadeOut(50);
                $('.sales-select').fadeIn(50);
            } else if ($(this).val()=="案件追蹤") {
                $('.chartwrap1').fadeOut(50);
                $('.chartwrap2').fadeIn(500);
                $('.coupon .sales-select').fadeOut(50);
            }
        });
    });

    // 圖表連結
    $('body').on('click', '#chart1 text, #chart3 text, #chart4 text', function(){
        window.location.href='全站業務(圖表連結用).html';
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
            "targets": [0],
            "orderable": false,
        }],
    });

</script>
@endsection