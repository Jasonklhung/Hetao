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
                                                                    <td class="text-center" colspan="31">2020年 3月</td>
                                                                </tr>
                                                                <tr class="text-center">
                                                                    <th>日<br>1</th>
                                                                    <th>一<br>2</th>
                                                                    <th>二<br>3</th>
                                                                    <th>三<br>4</th>
                                                                    <th>四<br>5</th>
                                                                    <th>五<br>6</th>
                                                                    <th>六<br>7</th>
                                                                    <th>日<br>8</th>
                                                                    <th>一<br>9</th>
                                                                    <th>二<br>10</th>
                                                                    <th>三<br>11</th>
                                                                    <th>四<br>12</th>
                                                                    <th>五<br>13</th>
                                                                    <th>六<br>14</th>
                                                                    <th>日<br>15</th>
                                                                    <th>一<br>16</th>
                                                                    <th>二<br>17</th>
                                                                    <th>三<br>18</th>
                                                                    <th>四<br>19</th>
                                                                    <th>五<br>20</th>
                                                                    <th>六<br>21</th>
                                                                    <th>日<br>22</th>
                                                                    <th>一<br>23</th>
                                                                    <th>二<br>24</th>
                                                                    <th>三<br>25</th>
                                                                    <th>四<br>26</th>
                                                                    <th>五<br>27</th>
                                                                    <th>六<br>28</th>
                                                                    <th>日<br>29</th>
                                                                    <th>一<br>30</th>
                                                                    <th>二<br>31</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-nowrap nametitle">Cindy <span class="text-primary">55張卡片</span></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><span class="d-block bg-orange h-50 linehiight2">3</span><span class="d-block bg-red h-50 linehiight2">2</span></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td class="bg-red">2</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-nowrap nametitle">曾曾 <span class="text-primary">66張卡片</span></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td class="bg-orange">7</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td class="bg-red">2</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
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
                                                        <table class="table table-hover dt-responsive table-striped staff" id="hetao-list-norwd2">
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
                                                                        <h4 class="mt-m text-center">共有100張卡片</h4>   
                                                                        <table id="hetao-sale">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="w-50">姓名</th>
                                                                                    <th class="w-50 text-right">比例</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>  
                                                                                <tr>
                                                                                    <td>王小明</td>
                                                                                    <td class="text-right">50%</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>曾曾</td>
                                                                                    <td class="text-right">25%</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Cindy</td>
                                                                                    <td class="text-right">25%</td>
                                                                                </tr>
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
                                                                        <h4 class="mt-m text-center">共有100張卡片</h4>  
                                                                        <table id="hetao-sale2">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="w-50">姓名</th>
                                                                                    <th class="w-50 text-right">比例</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>  
                                                                                <tr>
                                                                                    <td>王小明</td>
                                                                                    <td class="text-right">50%</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>曾曾</td>
                                                                                    <td class="text-right">25%</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Cindy</td>
                                                                                    <td class="text-right">25%</td>
                                                                                </tr>
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
<script>
    var data2 = [{
            station: "H027",
            name: "Cindy",
            finish: "5",
            execution: "5",
            change: "1",
            total: "11",
            p_f: `
                <div class="d-flex w-100">
                    <span class="w-60px">完成</span>
                    <div class="progress flex-grow">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                            70%
                        </div>
                    </div>
                </div>
                `,
            p_e: `
                <div class="d-flex w-100">
                    <span class="w-60px">執行中</span>
                    <div class="progress flex-grow">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">
                            20%
                        </div>
                    </div>
                </div>
                `,
            p_c: `
                <div class="d-flex w-100">
                    <span class="w-60px">轉單</span>
                    <div class="progress flex-grow">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width:33%">
                            33%
                        </div>
                    </div>
                </div>

                `,
        },{
            station: "H027",
            name: "Cindy",
            finish: "5",
            execution: "5",
            change: "1",
            total: "11",
            p_f: `
                <div class="d-flex w-100">
                    <span class="w-60px">完成</span>
                    <div class="progress flex-grow">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                            70%
                        </div>
                    </div>
                </div>
                `,
            p_e: `
                <div class="d-flex w-100">
                    <span class="w-60px">執行中</span>
                    <div class="progress flex-grow">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">
                            20%
                        </div>
                    </div>
                </div>
                `,
            p_c: `
                <div class="d-flex w-100">
                    <span class="w-60px">轉單</span>
                    <div class="progress flex-grow">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width:33%">
                            33%
                        </div>
                    </div>
                </div>

                `,
        },
    ];

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
        "dataProvider": [{
                "category": "已完成",
                "column-1": "19"
            },
            {
                "category": "執行中",
                "column-1": "10"
            }
        ]
    });

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
        "dataProvider": [{
                "category": "轉單",
                "column-1": "19"
            },
            {
                "category": "正常接單",
                "column-1": "10"
            }
        ]
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