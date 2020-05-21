@extends('layout.app_performance')

@section('content')
		<div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">業績查詢</h3>
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="far fa-chart-bar"></i>全站業績
                                        </div>
                                        <div class="panel-body tab-pane">
                                            <div class="tabbable">
                                                <div class='coupon'>
                                                    <form class='form-inline' id="performanceAllSearch">
                                                        @csrf
                                                        <!-- <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字"> -->
                                                        <div class='form-group'>
                                                            <div class='datetime'>
                                                                <div class='input-group date date-select'>
                                                                    <input class='form-control' placeholder='選擇起始日期' type='text' name="start" id="start"> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                            </div><span class='rwd-hide span-d'>~</span>
                                                            <div class='datetime'>
                                                                <div class='input-group date date-select mr-s'>
                                                                    <input class='form-control' placeholder='選擇結束日期' type='text' name="end" id="end"> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='btn-wrap'>
                                                            <button class='mr-s' type="submit">查詢</button>
                                                            <button class='mr-s' type="button" id="reset">重設</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="chartwrap bd overflow-x mb-m">
                                                    <table class="table table-hover table-striped table-bordered fixedleft" id="hetao-sale">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>業務交易統計</th>
                                                                <th><span class="v-hide">單位</span></th>
                                                                @foreach($test as $key => $data)
                                                                    
                                                                <th>{{ $key }}</th>

                                                                @endforeach
                                                                <th>總計</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($total as $key => $data)
                                                            <tr class="text-center">
                                                                <td class="text-primary" rowspan="2">{{$key}}</td>
                                                                <td class="text-muted">數量</td>
                                                                    @php
                                                                        $mount = 0;
                                                                    @endphp
                                                                @foreach($data as $k => $v)
                                                                <td>{{ $v['mount'] }}</td>

                                                                    @php
                                                                        $mount += $v['mount'];
                                                                    @endphp
                                                                @endforeach
                                                                <td>{{$mount}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="display: none"></td>
                                                                <td class="text-muted">小計</td>
                                                                    @php
                                                                        $money = 0;
                                                                    @endphp
                                                                @foreach($data as $k => $v)
                                                                <td>{{ $v['money'] }}</td>

                                                                    @php
                                                                        $money += $v['money'];
                                                                    @endphp
                                                                @endforeach
                                                                <td>{{$money}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>    
                                                    </table>
                                                </div>
                                                <div class='coupon mt-m'>
                                                    <form action="" class="form-inline mt-m mb-s" id="businessSearch">
                                                        @csrf
                                                        <input type="text" class="form-control mb-s mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
                                                        <select  class="form-control d-inline w-auto mb-s mr-s" name="business" id="business">
                                                            <option value="" selected>業務</option>
                                                            @foreach($name as $key => $data)
                                                            <option value="{{$data}}">{{$data}}</option>
                                                            @endforeach
                                                        </select>
                                                        <select  class="form-control d-inline w-auto mb-s" name="type" id="type">
                                                            <option value="" selected>類別</option>
                                                            @foreach($type as $key => $data)
                                                            <option value="{{$data}}">{{$data}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class='btn-wrap'>
                                                            <button class='mr-s' type="submit">查詢</button>
                                                            <button class='mr-s' type="button" id="resets">重設</button>
                                                        </div>
                                                    </form>    
                                                </div> 
                                                <table class="table table-hover dt-responsive table-striped" id="hetao-list-norwd">
                                                    <thead>
                                                        <tr>
                                                            <th class="desktop"></th>
                                                            <th class="desktop">交易日期</th>
                                                            <th class="desktop">交易單號</th>
                                                            <th class="desktop">業務人員</th>
                                                            <th class="desktop">客戶代碼</th>
                                                            <th class="desktop">卡號</th>
                                                            <th class="desktop">產品代碼</th>
                                                            <th class="desktop">產品規格</th>
                                                            <th class="desktop">類別</th>
                                                            <th class="desktop">數量</th>
                                                            <th class="desktop">單價</th>
                                                            <th class="desktop">小計</th>
                                                        </tr>
                                                    </thead>
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
@endsection

@section('modal')

@endsection

@section('scripts')
<script>

    var totalMoney = {!! json_encode($totalMoney) !!}; //php變數轉換

    var table_s1 = $("#hetao-sale").DataTable({
        "bPaginate": true,
        "searching": true,
        "info": true,
        "bLengthChange": false,
        "bServerSide": false,
        "language": {
            "search": "",
            "searchPlaceholder": "請輸入關鍵字",
            "paginate": { "previous": "上一頁", "next": "下一頁" },
            "info": "<p class='m-0'>總和： "+totalMoney+"</p>",
            "zeroRecords": "沒有符合的搜尋結果",
            "infoEmpty": "顯示 0 至 0 筆，共 0 筆",
            "lengthMenu": "呈現筆數 _MENU_",
            "emptyTable": "目前無資料",
            "infoFiltered": "(從 _MAX_ 筆中篩選)",
        },
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "buttons": [{
            "extend": "colvis",
        }],
        "ordering": false,
        "columnDefs": [{
            "targets": 'nosort',
            "orderable": false,
        }],
        scrollX: true,
        fixedColumns:   {
            leftColumns: 2
        },
        scrollCollapse: true,
    });
    $(".searchInput_s1").on("blur", function() {
        table_s1.search(this.value).draw();
    });

    $(".searchInput_s1").on("keyup", function() {
        table_s1.search(this.value).draw();
    });

    var performance = {!! json_encode($performanceArray) !!}; //php變數轉換

    var data = new Array();

    $.each(performance, function (i, item) {

        data[i] = {
            day: "<span class='text-nowrap'>"+item.DATE+"</span>",
            number: item.SALENUM,
            sales: item.NAME,
            name: item.CUSTKEY,
            card: item.CARDNO,
            productid: item.CODE,
            productintro: item.DESCRIBE,
            kind: item.TYPE,
            quantity: item.MATE,
            price: item.PRICE,
            total: item.AMOUNT,
            invoice: item.INVOICE,
            company: item.FULLNAME,
            staff: item.TOUCH,
            phone: "<a href='tel:"+item.COMTEL+"'>"+item.COMTEL+"</a>"
        }
    })

    function format(d) {
        return (
            `<table class="tb-child">
                <tr><td><span class='w-105px'>發票號碼：</span>` + d.invoice + `</td></tr>
                <tr><td><span class='w-105px'>客戶全銜：</span>` + d.company + `</td></tr>
                <tr><td><span class='w-105px'>聯絡人：</span>` + d.staff + `</td></tr>
                <tr><td class="text-nowrap"><span class='w-105px'>聯絡電話：</span>` + d.phone + `</td></tr>
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
                { data: "day" },
                { data: "number" },
                { data: "sales" },
                { data: "name" },
                { data: "card" },
                { data: "productid" },
                { data: "productintro" },
                { data: "kind" },
                { data: "quantity" },
                { data: "price" },
                { data: "total" }

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
</script>
<script type="text/javascript">
    $('#performanceAllSearch').on('submit',function(e){

        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'post',
            url:"{{ route('ht.Performance.all.performanceAllSearch',['organization'=>$organization]) }}",
            data:formData,
            success:function(res){

                var row;
                var rows;

                $('#hetao-sale').DataTable().destroy();
                $('#hetao-sale thead').empty();
                $('#hetao-sale tbody').empty();

                var count = 0;
                var mount = 0;
                var money = 0;
             
                    
                row += "<tr class'text-center'>"
                + "<th>業務交易統計</th>"
                + "<th><span class='v-hide'>單位</span></th>"
                $.each(res[2], function (i, item) {
                    row += "<th>"+ i +"</th>"
                })
                row += "<th>總計</th>"
                + "</tr>"

                $.each(res[0], function (i, item) {
                    
                    rows += "<tr class='text-center'>"
                        + "<td class='text-primary' rowspan='2'>"+ i +"</td>"
                        + "<td class='text-muted'>數量</td>"
                        $.each(item, function (ii, items) {

                            mount += items.mount;

                            rows += "<td>"+ items.mount +"</td>"
                        })
                        rows += "<td>"+ mount + "</td>"
                        + "</tr>"
                        + "<tr>"
                        + "<td style='display: none'></td>"
                        + "<td class='text-muted'>小計</td>"
                        $.each(item, function (iii, itemss) {

                            money += itemss.money;

                            rows += "<td>"+ itemss.money +"</td>"
                        })
                        rows += "<td>"+ money + "</td>"
                        + "</tr>"
                })
                $('#hetao-sale thead').append(row);
                $('#hetao-sale tbody').append(rows);
                var table_s1 = $("#hetao-sale").DataTable({
                    "bPaginate": true,
                    "searching": true,
                    "info": true,
                    "bLengthChange": false,
                    "bServerSide": false,
                    "language": {
                        "search": "",
                        "searchPlaceholder": "請輸入關鍵字",
                        "paginate": { "previous": "上一頁", "next": "下一頁" },
                        "info": "<p class='m-0'>總和： "+res[1]+"</p>",
                        "zeroRecords": "沒有符合的搜尋結果",
                        "infoEmpty": "顯示 0 至 0 筆，共 0 筆",
                        "lengthMenu": "呈現筆數 _MENU_",
                        "emptyTable": "目前無資料",
                        "infoFiltered": "(從 _MAX_ 筆中篩選)",
                    },
                    "dom": '<"top"i>rt<"bottom"flp><"clear">',
                    "buttons": [{
                        "extend": "colvis",
                    }],
                    "ordering": false,
                    "columnDefs": [{
                        "targets": 'nosort',
                        "orderable": false,
                    }],
                    scrollX: true,
                    fixedColumns:   {
                        leftColumns: 2
                    },
                    scrollCollapse: true,
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

    $('#businessSearch').on('submit',function(e){

        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'post',
            url:"{{ route('ht.Performance.all.businessSearch',['organization'=>$organization]) }}",
            data:formData,
            success:function(res){

                $('#hetao-list-norwd').DataTable().destroy();
                $('#hetao-list-norwd tbody').empty();

                var data = new Array();

                $.each(res, function (i, item) {

                    data[i] = {
                        day: "<span class='text-nowrap'>"+item.DATE+"</span>",
                        number: item.SALENUM,
                        sales: item.NAME,
                        name: item.CUSTKEY,
                        card: item.CARDNO,
                        productid: item.CODE,
                        productintro: item.DESCRIBE,
                        kind: item.TYPE,
                        quantity: item.MATE,
                        price: item.PRICE,
                        total: item.AMOUNT,
                        invoice: item.INVOICE,
                        company: item.FULLNAME,
                        staff: item.TOUCH,
                        phone: "<a href='tel:"+item.COMTEL+"'>"+item.COMTEL+"</a>"
                    }
                })

                function format(d) {
                    return (
                        `<table class="tb-child">
                        <tr><td><span class='w-105px'>發票號碼：</span>` + d.invoice + `</td></tr>
                        <tr><td><span class='w-105px'>客戶全銜：</span>` + d.company + `</td></tr>
                        <tr><td><span class='w-105px'>聯絡人：</span>` + d.staff + `</td></tr>
                        <tr><td class="text-nowrap"><span class='w-105px'>聯絡電話：</span>` + d.phone + `</td></tr>
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
                        { data: "day" },
                        { data: "number" },
                        { data: "sales" },
                        { data: "name" },
                        { data: "card" },
                        { data: "productid" },
                        { data: "productintro" },
                        { data: "kind" },
                        { data: "quantity" },
                        { data: "price" },
                        { data: "total" }

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
                });
            },
            cache: false,
            contentType: false,
            processData: false
        })
    })
</script>
@endsection