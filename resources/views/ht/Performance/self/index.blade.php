@extends('layout.app')

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
                                            <i class="far fa-chart-bar"></i>個人業績
                                        </div>
                                        <div class="panel-body tab-pane">
                                            <div class="tabbable">
                                                <div class='coupon'>
                                                    <form class='form-inline' id="performanceSearch">
                                                        @csrf
                                                        <!-- <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字"> -->
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
                                                        <div class='btn-wrap'>
                                                            <button class='mr-s' type="submit">查詢</button>
                                                            <button class='mr-s' type="button" id="reset">重設</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <p id="totalMoney">$： {{$totalMoney}}</p>
                                                <div class="chartwrap bd overflow-x mb-m">
                                                    <table class="table-striped" id="hetao-sale">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>類別</th>
                                                                <th>數量</th>
                                                                <th>$</th>
                                                                <th>類別</th>
                                                                <th>數量</th>
                                                                <th>$</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $count = 0;
                                                            @endphp
                                                            @foreach($total as $key => $data)
                                                            @php
                                                                $count++;
                                                            @endphp
                                                            @if($count%2 == 1)
                                                            <tr>
                                                                <td class="text-primary">{{$key}}</td>
                                                                <td>{{$data['mount']}}</td>
                                                                <td>{{$data['money']}}</td>
                                                            @elseif($count%2 == 0)
                                                                <td class="text-primary">{{$key}}</td>
                                                                <td>{{$data['mount']}}</td>
                                                                <td>{{$data['money']}}</td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>    
                                                    </table>
                                                </div>
                                                <div class='coupon mt-m'>
                                                    <form action="" class="form-inline mt-m mb-s" id="categorySearch">
                                                        @csrf
                                                        <input type="text" class="form-control mb-s mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
                                                        <select name="category" id="category" class="form-control d-inline w-auto mb-s">
                                                            <option value="" selected>類別</option>
                                                            @foreach($type as $key => $data)
                                                            <option value="{{$data}}">{{$data}}</option>
                                                            @endforeach
                                                        </select>
                                                    </form>    
                                                </div>    
                                                <table class="table table-hover dt-responsive table-striped" id="hetao-list-norwd">
                                                    <thead>
                                                        <tr>
                                                            <th class="desktop"></th>
                                                            <th class="desktop">交易日期</th>
                                                            <th class="desktop">交易單號</th>
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

    var performance = {!! json_encode($performanceArray) !!}; //php變數轉換

    var data = new Array();

    $.each(performance, function (i, item) {

        data[i] = {
            day: "<span class='text-nowrap'>"+item.DATE+"</span>",
            number: item.SALENUM,
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
    
    $('#performanceSearch').on('submit',function(e){

        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'post',
            url:"{{ route('ht.Performance.self.performanceSearch',['organization'=>$organization]) }}",
            data:formData,
            success:function(res){

                $('#totalMoney').html('$：'+res[1]);

                var rows;
                $('#hetao-sale tbody').empty();

                var count = 0;

                $.each(res[0], function (i, item) {

                    count++;
                    
                    if(count%2 == 1){
                        rows += "<tr>"
                        + "<td class='text-primary'>"+ i +"</td>"
                        + "<td>"+ item.mount +"</td>"
                        + "<td>"+ item.money +"</td>"
                    }
                    else if(count%2 == 0){
                        rows +=  "<td class='text-primary'>"+ i +"</td>"
                        + "<td>"+ item.mount +"</td>"
                        + "<td>"+ item.money +"</td>"
                        + "</tr>"
                    }
           
                })
                $('#hetao-sale tbody').append(rows);

                $('#hetao-list-norwd').DataTable().destroy();
                $('#hetao-list-norwd tbody').empty();

                var data = new Array();

                $.each(res[2], function (i, item) {

                    data[i] = {
                        day: "<span class='text-nowrap'>"+item.DATE+"</span>",
                        number: item.SALENUM,
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

                var selOpts = "<option value='' selected='selected' disabled='true'>請選擇類別</option>";
                    selOpts += "<option value='ALL'>全部</option>";
                $.each(res[3], function (i, item) {
                    selOpts += "<option value='"+item+"'>"+item+"</option>";
                })
                $("#category").empty();
                $('#category').append(selOpts);
            },
            cache: false,
            contentType: false,
            processData: false
        })
    })

    $('#categorySearch').on('change',function(e){

        e.preventDefault();
        var formData = new FormData(this);

        var start = $('#start').val()
        var end = $('#end').val()

        formData.append('start', start);
        formData.append('end', end);

        $.ajax({
            type:'post',
            url:"{{ route('ht.Performance.self.categorySearch',['organization'=>$organization]) }}",
            data:formData,
            success:function(res){

                $('#hetao-list-norwd').DataTable().destroy();
                $('#hetao-list-norwd tbody').empty();

                var data = new Array();

                $.each(res, function (i, item) {

                    data[i] = {
                        day: "<span class='text-nowrap'>"+item.DATE+"</span>",
                        number: item.SALENUM,
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
<script type="text/javascript">
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