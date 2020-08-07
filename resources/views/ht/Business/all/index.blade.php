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
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-01">拜訪紀錄檢視</a>
                                                    </li>
                                                    <li >
                                                        <a data-toggle="tab" href="#viewers-tab-02">案件追蹤檢視</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-03">相關數據檢視</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 拜訪紀錄 -->
                                                    <div class="tab-pane active" id="viewers-tab-01">
                                                        <div class='coupon'>
                                                            <form class='form-inline' id="visitSearch">
                                                                @csrf
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s1" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select' id="datetimepicker1">
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text' name="start" id="start"> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide span-d'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s' id="datetimepicker2">
                                                                            <input class='form-control' placeholder='選擇結束日期' type='text' name="end" id="end"> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <select class="form-control mb-s mr-s" name="time" id="time" id="time">
                                                                    <option selected value="">時間</option>
                                                                    <option value="上午(AM)">上午(AM)</option>
                                                                    <option value="下午(PM)">下午(PM)</option>
                                                                </select>
                                                                <select class="form-control mb-s mr-s" name="business" id="business">
                                                                    <option selected value="">業務</option>
                                                                    @foreach($deptUser as $key => $data)
                                                                    <option value="{{$data['id']}}">{{$data['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <select class="form-control mb-s mr-s" name="type" id="type">
                                                                    <option selected value="">類型</option>
                                                                    <option value="拜訪">拜訪</option>
                                                                    <option value="陌訪">陌訪</option>
                                                                    <option value="洽機">洽機</option>
                                                                    <option value="看現場">看現場</option>
                                                                    <option value="送機器">送機器</option>
                                                                    <option value="收款">收款</option>
                                                                    <option value="送文件">送文件</option>
                                                                    <option value="協助安裝">協助安裝</option>
                                                                    <option value="其他">其他</option>
                                                                    <option value="支援">支援</option>
                                                                    <option value="客訴">客訴</option>
                                                                    <option value="客服">客服</option> 
                                                                </select>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="submit">查詢</button>
                                                                    <button class='mr-s' type="button" id="reset">重設</button>
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
                                                                @foreach($visitTable as $key => $data)
                                                                <tr>
                                                                    <td class="text-nowrap">{{ $data->date }}</td>
                                                                    <td>{{ $data->time }}</td>
                                                                    <td>{{ $data->name }}</td>
                                                                    <td>{{ $data->business_name }}</td>
                                                                    <td>{{ $data->type }}</td>
                                                                    <td>{{ $data->content }}</td>
                                                                    <td><a href="https://www.google.com.tw/maps/place/{{ $data->city }}{{ $data->area }}{{ $data->address }}" target="_blank">{{ $data->city }}{{ $data->area }}{{ $data->address }}</a></td>
                                                                    <td><a class="text-nowrap" href="tel:{{ $data->phone }}">{{ $data->phone }}</a></td>
                                                                    <td>{{ $data->other }}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- 案件追蹤 -->
                                                    <div class="tab-pane" id="viewers-tab-02">
                                                        <div class='coupon'>
                                                            <form class='form-inline' id="trackSearch">
                                                                @csrf
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select' id="datetimepicker3">
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text' name="start" id="start2"> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide span-d'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s' id="datetimepicker4">
                                                                            <input class='form-control' placeholder='選擇結束日期' type='text' name="end" id="end2"> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <select class="form-control mb-s mr-s" name="business" id="business2">
                                                                    <option value="">業務</option>
                                                                    @foreach($deptUser as $key => $data)
                                                                    <option value="{{$data['id']}}">{{$data['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <select class="form-control mb-s mr-s" name="level" id="level">
                                                                    <option value="">等級</option>
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                    <option value="C">C</option>
                                                                    <option value="D">D</option>
                                                                </select>
                                                                <select class="form-control mb-s mr-s" name="schedule" id="schedule">
                                                                    <option value="">進度</option>
                                                                    <option value="尚未找到窗口">尚未找到窗口</option>
                                                                    <option value="已拜訪介紹">已拜訪介紹</option>
                                                                    <option value="已報價">已報價</option>
                                                                    <option value="已成待裝機">已成待裝機</option>
                                                                    <option value="已裝機完成">已裝機完成</option>
                                                                    <option value="已收款">已收款</option>
                                                                </select>
                                                                <select class="form-control mb-s mr-s" name="category" id="category">
                                                                    <option value="">類別</option>
                                                                    <option value="公家機關">公家機關</option>
                                                                    <option value="商用">商用</option>
                                                                    <option value="家用">家用</option>
                                                                    <option value="醫療">醫療</option>
                                                                    <option value="中信局">中信局</option>
                                                                </select>
                                                                <select class="form-control mb-s mr-s" name="numbers" id="numbers">
                                                                    <option value="">型號</option>
                                                                    @foreach($trackNumberArray as $key => $data)
                                                                    <option value="{{$data}}">{{$data}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <select class="form-control mb-s mr-s" name="result" id="result">
                                                                    <option value="">結果</option>
                                                                    <option value="成交">成交</option>
                                                                    <option value="流單">流單</option>
                                                                    <option value="其他">其他</option>
                                                                </select>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="submit">查詢</button>
                                                                    <button class='mr-s' type="button" id="reset2">重設</button>
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
                                                            <form class='form-inline' id="monthSearch">
                                                                @csrf
                                                                <div class='form-group mr-s'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date month-select'>
                                                                            <input class='form-control' placeholder='選擇月份' type='text' name="month" id="month"> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div>
                                                                    <select class='form-control ml-s float-right sales-select' name="business" id="business3">
                                                                        <option selected value="">全部</option>
                                                                        @foreach($deptUser as $key => $data)
                                                                        <option value="{{ $data['id'] }}">{{ $data['name'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <button class='mr-s mb-s' type="submit">查詢</button>
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
                                                                <div class="w-100 charts-border"> 
                                                                    <div class="col-sm-12 mt-s">
                                                                        <!-- <select class='form-control ml-s sales-select mt-s'>
                                                                            <option selected value="All">全部</option>
                                                                            @foreach($deptUser as $key => $data)
                                                                            <option value="{{ $data['id'] }}">{{ $data['name'] }}</option>
                                                                            @endforeach
                                                                        </select> -->
                                                                    </div>    
                                                                    <!-- <div class="col-sm-6">
                                                                        <h4 class="mt-m text-center">追蹤筆數：{{$trackChartCount}}筆</h4>   
                                                                        <div class="bd-right" id="chart3" style="width: 100%; height: 300px;"></div>
                                                                    </div> -->
                                                                    <div class="col-sm-12">
                                                                        <h4 class="mt-m text-center">各案件結單情況</h4> 
                                                                        <div>
                                                                            <div id="chart4" style="width: 100%; height: 300px;"></div>
                                                                            <ul>
                                                                                <li id="finishChartCount">結單總筆數：{{$finishChartCount}}筆</li>
                                                                                <li id="money">參考成交總金額：${{$money}}元</li>
                                                                                <li id="newCustomChartCount">新增客戶數：{{$newCustomChartCount}}家</li>
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
                                                                            <select class='form-control products-select mb-s' id="numberSelect">
                                                                                <option selected value="">全部</option>
                                                                                @foreach($numberSelect as $key => $data)
                                                                                <option value="{{$data}}">{{$data}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <table id="hetao-sale" class="mt-0">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="w-50">業務</th>
                                                                                        <th class="w-50">數量</th>
                                                                                    </tr>
                                                                                </thead>   
                                                                                <tbody>
                                                                                    @foreach($userTableArray as $key => $data)
                                                                                    <tr>
                                                                                        <td>{{$key}}</td>
                                                                                        <td class="text-right">{{$data}}</td>
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
            "emptyTable": "目前無資料",
            "infoFiltered": "(從 _MAX_ 筆中篩選)",
        },
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "buttons": [{
            "extend": "colvis",
            "collectionLayout": "fixed two-column"
        }],
        "order": [0,'desc'],
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

    var trackSameArray = {!! json_encode($trackSameArray) !!}; //php變數轉換

    var data = new Array();

    $.each(trackSameArray, function (i, item) {

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

        var url = '{{ route('ht.Business.all.show',['organization'=>$organization,'id'=>':id']) }}'
        url = url.replace(':id',item.id);

        data[i] = {
            first: `
            <div class="td-icon">
                <input class="chkall" type="checkbox" name="businessTrack" value="`+item.id+`">
            </div>
            `,
            day: "<spann class='text-nowrap'>"+item.date+"</span>",
            sales: item.business_name,
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
            address: item.city+item.area+item.address,
            type: item.numbers
        }
    })

    function format(d) {
        return (
            `<table class="tb-child">
                <tr class='rwd-show'><td><span class='w-105px'>業務人員：</span>` + d.sales + `</td></tr>            
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
                "emptyTable": "目前無資料",
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

        //rwd讓欄位消失
        window.onresize = function() {
              var w = this.innerWidth;
              table_s2.column(3).visible( w > 768);
              table_s2.column(5).visible( w > 768);
              table_s2.column(6).visible( w > 768);
              table_s2.column(8).visible( w > 768);
              table_s2.column(10).visible( w > 768);  
              table_s2.column(11).visible( w > 768);  
              table_s2.column(12).visible( w > 768);
            }
        //trigger upon pageload
        $(window).trigger('resize');
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
    //     "dataProvider": businessChartCount
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
            "title": "",
            "integersOnly":true
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

    var numberFinalChart = {!! json_encode($numberFinalChart) !!};

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
        "dataProvider": numberFinalChart
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
                //$('.coupon .sales-select').fadeOut(50);
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
            "emptyTable": "目前無資料",
            "infoFiltered": "(從 _MAX_ 筆中篩選)",
        },
        "order": [],
        "columnDefs": [{
            "targets": [0],
            "orderable": false,
        }],
    });

</script>
<script type="text/javascript">
    $('#visitSearch').on('submit',function(e){

        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'post',
            url:"{{ route('ht.Business.all.visitSearch',['organization'=>$organization]) }}",
            data:formData,
            success:function(res){

                var rows;
                $('#hetao-list-s-1').DataTable().destroy();
                $('#hetao-list-s-1 tbody').empty();

                $.each(res, function (i, item) {

                    rows += "<tr>"
                    + "<td class='text-nowrap'>"+ item.date +"</td>"
                    + "<td>"+ item.time +"</td>"
                    + "<td>"+ item.name +"</td>"
                    + "<td>"+ item.business_name +"</td>"
                    + "<td>"+ item.type +"</td>"
                    + "<td>"+ item.content +"</td>"
                    + "<td><a href='https://www.google.com.tw/maps/place/"+ item.city + item.area + item.address +"' target='_blank'>"+ item.city + item.area + item.address +"</a></td>"
                    + "<td><a class='text-nowrap' href='tel:"+ item.phone +"'>" + item.phone + "</a></td>"
                    + "<td>"+ item.other +"</td>"
                    + "</tr>"
                })
                $('#hetao-list-s-1 tbody').append(rows);
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
                        "emptyTable": "目前無資料",
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
            },
            cache: false,
            contentType: false,
            processData: false
        })
    })

    $('#trackSearch').on('submit',function(e){

        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'post',
            url:"{{ route('ht.Business.all.trackSearch',['organization'=>$organization]) }}",
            data:formData,
            success:function(res){

                $('#hetao-list-norwd').DataTable().destroy();
                $('#hetao-list-norwd tbody').empty();

                var data = new Array();

                $.each(res, function (i, item) {

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

                    var url = '{{ route('ht.Business.all.show',['organization'=>$organization,'id'=>':id']) }}'
                    url = url.replace(':id',item.id);

                    data[i] = {
                        first: `
                        <div class="td-icon">
                        <input class="chkall" type="checkbox" name="businessTrack" value="`+item.id+`">
                        </div>
                        `,
                        day: "<spann class='text-nowrap'>"+item.date+"</span>",
                        sales: item.business_name,
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
                        type: item.numbers
                    }
                })

                function format(d) {
                    return (
                        `<table class="tb-child">
                        <tr class='rwd-show'><td><span class='w-105px'>業務人員：</span>` + d.sales + `</td></tr>            
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
                            "emptyTable": "目前無資料",
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

                    $("#hetao-list-norwd tbody").off("click", "td.details-control");
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
                      table_s2.column(3).visible( w > 768);
                      table_s2.column(5).visible( w > 768);
                      table_s2.column(6).visible( w > 768);
                      table_s2.column(8).visible( w > 768);
                      table_s2.column(10).visible( w > 768);  
                      table_s2.column(11).visible( w > 768);  
                      table_s2.column(12).visible( w > 768);
                  }
                    //trigger upon pageload
                    $(window).trigger('resize');
                });
            },
            cache: false,
            contentType: false,
            processData: false
        })
    })

    $('#monthSearch').on('submit',function(e){

        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'post',
            url:"{{ route('ht.Business.all.monthSearch',['organization'=>$organization]) }}",
            data:formData,
            success:function(res){

                //chart2
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
                        "title": "",
                        "integersOnly":true
                    }],
                    "allLabels": [{
                        "id": "Label-1",
                        "text": "當月紀錄總筆數："+res[1]
                    }],
                    "balloon": {},
                    "titles": [{
                        "id": "Title-1",
                        "size": 15,
                        "text": ""
                    }],
                    "dataProvider": res[0]
                });

                //chart4
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
                    "dataProvider": res[2],
                    "legend": {
                        "enabled":true,
                        "align": "center",
                        "markerType": "circle"
                    },
                });

                $('#finishChartCount').html("結單總筆數：" + res[3] + "筆")
                $('#money').html(" 參考成交總金額：" + res[4] + "元")
                $('#newCustomChartCount').html("新增客戶數：" + res[5] + "家")

                //chart5
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
                    "dataProvider": res[6]
                });


                var rows;

                $('#hetao-sale').DataTable().destroy();
                $('#hetao-sale tbody').empty();

                $.each(res[7], function (i, item) {

                    rows +=  "<tr>"
                    + "<td>" + i + "</td>"
                    + "<td class='text-right'>" + item + "</td>"
                    + "</tr>"
          
                })
                $('#hetao-sale tbody').append(rows);
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
                        "emptyTable": "目前無資料",
                        "infoFiltered": "(從 _MAX_ 筆中篩選)",
                    },
                    "order": [],
                    "columnDefs": [{
                        "targets": [0],
                        "orderable": false,
                    }],
                });

                $('#numberSelect').find('option').remove()
                $('#numberSelect').append("<option value=''>全部</option>")

                $.each(res[8], function (i, item) {
                    $('#numberSelect').append(`<option value="`+item+`">"`+item+`"</option>`)
                });

            },
            cache: false,
            contentType: false,
            processData: false
        })
    })

    $('#numberSelect').on('change',function(){

        var number = $('#numberSelect').val()
        var month = $('#month').val();
        var business = $('#business3').val()

         $.ajax({
            type:'post',
            url:"{{ route('ht.Business.all.numberSearch',['organization'=>$organization]) }}",
            data:{
                '_token':'{{csrf_token()}}',
                'number':number,
                'month':month,
                'business':business
            },
            success:function(res){

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
                    "dataProvider": res[0]
                });

                 var rows;

                 $('#hetao-sale').DataTable().destroy();
                 $('#hetao-sale tbody').empty();

                 $.each(res[1], function (i, item) {

                    rows +=  "<tr>"
                    + "<td>" + i + "</td>"
                    + "<td class='text-right'>" + item + "</td>"
                    + "</tr>"

                })
                 $('#hetao-sale tbody').append(rows);
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
                        "emptyTable": "目前無資料",
                        "infoFiltered": "(從 _MAX_ 筆中篩選)",
                    },
                    "order": [],
                    "columnDefs": [{
                        "targets": [0],
                        "orderable": false,
                    }],
                });
            }
        })
    })
</script>
<script type="text/javascript">
    $('#reset').on('click',function(){
        $('#start').val("")
        $('#end').val("")
        $('#type').val("")
        $('#time').val("")
        $('#business').val("")
    })

    $('#reset2').on('click',function(){
        $('#start2').val("")
        $('#end2').val("")
        $('#business2').val("")
        $('#level').val("")
        $('#schedule').val("")
        $('#category').val("")
        $('#numbers').val("")
        $('#result').val("")
    })
</script>
<script type="text/javascript">
    $("#datetimepicker1").on("dp.change", function (e) {
        $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepicker2").on("dp.change", function (e) {
        $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
    });

    $("#datetimepicker3").on("dp.change", function (e) {
        $('#datetimepicker4').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepicker4").on("dp.change", function (e) {
        $('#datetimepicker3').data("DateTimePicker").maxDate(e.date);
    });
</script>
@endsection