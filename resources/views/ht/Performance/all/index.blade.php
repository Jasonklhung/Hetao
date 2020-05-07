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
                                                    <form class='form-inline'>
                                                        <!-- <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字"> -->
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
                                                                <!-- <td>{{ $data[0]['mount'] }}</td>
                                                                <td>{{ $data[1]['mount'] }}</td>
                                                                <td>{{ $data[2]['mount'] }}</td>
                                                                <td>{{ $data[3]['mount'] }}</td>
                                                                <td>{{ $data[4]['mount'] }}</td>
                                                                <td>{{ $data[5]['mount'] }}</td>
                                                                <td>{{ $data[6]['mount'] }}</td>
                                                                <td>{{ $data[7]['mount'] }}</td>
                                                                <td>{{ $data[8]['mount'] }}</td>
                                                                <td>{{ $data[9]['mount'] }}</td>
                                                                <td>{{ $data[10]['mount'] }}</td>
                                                                <td>{{ $data[11]['mount'] }}</td>
                                                                <td>{{ $data[12]['mount'] }}</td>
                                                                <td>{{ $data[13]['mount'] }}</td>
                                                                <td>{{ $data[14]['mount'] }}</td>
                                                                <td>{{ $data[15]['mount'] }}</td>
                                                                <td>{{ $data[16]['mount'] }}</td>
                                                                <td>{{ $data[17]['mount'] }}</td> -->
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
                                                                <!-- <td>{{ $data[0]['money'] }}</td>
                                                                <td>{{ $data[1]['money'] }}</td>
                                                                <td>{{ $data[2]['money'] }}</td>
                                                                <td>{{ $data[3]['money'] }}</td>
                                                                <td>{{ $data[4]['money'] }}</td>
                                                                <td>{{ $data[5]['money'] }}</td>
                                                                <td>{{ $data[6]['money'] }}</td>
                                                                <td>{{ $data[7]['money'] }}</td>
                                                                <td>{{ $data[8]['money'] }}</td>
                                                                <td>{{ $data[9]['money'] }}</td>
                                                                <td>{{ $data[10]['money'] }}</td>
                                                                <td>{{ $data[11]['money'] }}</td>
                                                                <td>{{ $data[12]['money'] }}</td>
                                                                <td>{{ $data[13]['money'] }}</td>
                                                                <td>{{ $data[14]['money'] }}</td>
                                                                <td>{{ $data[15]['money'] }}</td>
                                                                <td>{{ $data[16]['money'] }}</td>
                                                                <td>{{ $data[17]['money'] }}</td> -->
                                                                <td>{{$money}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>    
                                                    </table>
                                                </div>
                                                <div class='coupon mt-m'>
                                                    <form action="" class="form-inline mt-m mb-s">
                                                        <input type="text" class="form-control mb-s mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
                                                        <select  class="form-control d-inline w-auto mb-s mr-s">
                                                            <option value="" selected>業務</option>
                                                            <option value="">Cind</option>
                                                            <option value="">曾曾</option>
                                                        </select>
                                                        <select  class="form-control d-inline w-auto mb-s">
                                                            <option value="" selected>類別</option>
                                                            <option value="">BOXWATER</option>
                                                            <option value="">KEYWATER</option>
                                                            <option value="">RO</option>
                                                            <option value="">WATER</option>
                                                            <option value="">TANK</option>
                                                            <option value="">水處理</option>
                                                            <option value="">材料</option>
                                                            <option value="">其他</option>
                                                            <option value="">保養</option>
                                                            <option value="">限流閥</option>
                                                            <option value="">淨水器</option>
                                                            <option value="">瓶裝型</option>
                                                            <option value="">費用</option>
                                                            <option value="">開飲機</option>
                                                            <option value="">過濾器</option>
                                                            <option value="">零件</option>
                                                            <option value="">電解水機</option>
                                                            <option value="">中古機</option>
                                                            <option value="">維修</option>
                                                            <option value="">膜管</option>
                                                            <option value="">機器</option>
                                                            <option value="">濾心</option>
                                                            <option value="">濾材</option>
                                                            <option value="">清缸</option>
                                                        </select>
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
            "emptyTable": "目前無工單",
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

    var performance = {!! json_encode($performance) !!}; //php變數轉換

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
@endsection