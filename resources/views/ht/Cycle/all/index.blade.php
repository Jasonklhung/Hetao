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
                                            <i class="fas fa-sync-alt"></i>全站週期
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <!-- tab標籤 -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-01">待指派卡片 <span class="badge bg-danger">N</span></a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-02">已指派卡片</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-03">週期異動</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 待指派卡片 -->
                                                    <div class="tab-pane active" id="viewers-tab-01">
                                                        <div class='coupon'>
                                                            <form class="form-inline">
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
                                                                    <option value="">月份</option>
                                                                    <option value="">1月</option>
                                                                    <option value="">2月</option>
                                                                    <option value="">3月</option>
                                                                    <option value="">4月</option>
                                                                    <option value="">5月</option>
                                                                    <option value="">6月</option>
                                                                    <option value="">7月</option>
                                                                    <option value="">8月</option>
                                                                    <option value="">9月</option>
                                                                    <option value="">10月</option>
                                                                    <option value="">11月</option>
                                                                    <option value="">12月</option>
                                                                </select>
                                                                <select name="" class="form-control mb-s mr-s">
                                                                    <option value="">區域</option>
                                                                </select>
                                                                <select name="" class="form-control mb-s mr-s">
                                                                    <option value="">負責員工</option>
                                                                </select>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="button">查詢</button>
                                                                    <button class='mr-s' type="button">重設</button>
                                                                    <div class="droptool mr-s">
                                                                        <button class="btn btn-gray" type="button"><i class="fas fa-cog"></i>
                                                                        </button>
                                                                        <ul class="droptool-menu lg">
                                                                            <li>
                                                                                <input class="d-none" id='chkall1' type='checkbox' value='' /><label for='chkall1' class='sall'></label>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <select class='' id='cycleStaffSelect'>
                                                                                    <option selected disabled>請指派負責員工</option>
                                                                                    @foreach($deptUser as $key => $data)
                                                                                    <option value="{{$data['id']}}">{{$data['name']}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </li>
                                                                            <li><a class="btn btn-bright m-0" data-toggle="modal" data-target="#op-alert" href="#">批次指派</a></li>
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
                                                                    <th class="desktop">週期類別</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">公司電話</th>
                                                                    <th class="desktop">上次日期</th>
                                                                    <th class="desktop">本次日期</th>
                                                                    <th class="desktop">週期天數</th>
                                                                    <th class="desktop">區域</th>
                                                                    <th class="desktop">負責員工</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                    <!-- 已指派卡片 -->
                                                    <div class="tab-pane" id="viewers-tab-02">   
                                                        <div class='coupon'>
                                                            <form class='form-inline'>
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
                                                                <select name="" class="form-control mb-s mr-s">
                                                                    <option value="">所有狀態</option>
                                                                </select>
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
                                                                    <div class="droptool mr-s">
                                                                        <button class="btn btn-gray" type="button"><i class="fas fa-cog"></i>
                                                                        </button>
                                                                        <ul class="droptool-menu lg">
                                                                            <li>
                                                                                <input class="d-none" id='chkall2' type='checkbox' value='' /><label for='chkall2' class='sal2'></label>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <select class='' id='sel2'>
                                                                                    <option selected disabled>請指派負責員工</option>
                                                                                    @foreach($deptUser as $key => $data)
                                                                                    <option value="{{$data['id']}}">{{$data['name']}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </li>
                                                                            <li><a class="btn btn-bright m-0" data-toggle="modal" data-target="#op-alert" href="#">批次指派</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <table class="table table-hover dt-responsive table-striped staff" id="hetao-list-norwd2">
                                                            <thead class="">
                                                                <tr>
                                                                    <th class="desktop"></th>
                                                                    <th class="desktop"></th>
                                                                    <th class="desktop">週期類別</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">公司電話</th>
                                                                    <th class="desktop">上次日期</th>
                                                                    <th class="desktop">本次日期</th>
                                                                    <th class="desktop">週期天數</th>
                                                                    <th class="desktop">負責員工</th>
                                                                    <th class="desktop">狀態</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- 週期異動 -->
                                                    <div class="tab-pane" id="viewers-tab-03">   
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
                                                                    <option value="">月份</option>
                                                                    <option value="">1月</option>
                                                                    <option value="">2月</option>
                                                                    <option value="">3月</option>
                                                                    <option value="">4月</option>
                                                                    <option value="">5月</option>
                                                                    <option value="">6月</option>
                                                                    <option value="">7月</option>
                                                                    <option value="">8月</option>
                                                                    <option value="">9月</option>
                                                                    <option value="">10月</option>
                                                                    <option value="">11月</option>
                                                                    <option value="">12月</option>
                                                                </select>
                                                                <select name="" class="form-control mb-s mr-s">
                                                                    <option value="">區域</option>
                                                                </select>
                                                                <select name="" class="form-control mb-s mr-s">
                                                                    <option value="">負責員工</option>
                                                                </select>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="button">查詢</button>
                                                                    <button class='mr-s' type="button">重設</button>
                                                                    <div class="droptool mr-s">
                                                                        <button class="btn btn-gray" type="button"><i class="fas fa-cog"></i>
                                                                        </button>
                                                                        <ul class="droptool-menu lg">
                                                                            <li>
                                                                                <input class="d-none" id='chkall3' type='checkbox' value='' /><label for='chkall3' class='sal3'></label>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <select class='' id='sel3'>
                                                                                    <option selected disabled>請指派負責員工</option>
                                                                                    <option>Ricky</option>
                                                                                    <option>Eva</option>
                                                                                    <option>Apple</option>
                                                                                    <option>Banana</option>
                                                                                </select>
                                                                            </li>
                                                                            <li><a class="btn btn-bright m-0" data-toggle="modal" data-target="#op-alert" href="#">批次指派</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <table class="table table-hover dt-responsive table-striped staff" id="hetao-list-norwd3">
                                                            <thead class="">
                                                                <tr>
                                                                    <th class="desktop"></th>
                                                                    <th class="desktop"></th>
                                                                    <th class="desktop">週期類別</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">公司電話</th>
                                                                    <th class="desktop">上次日期</th>
                                                                    <th class="desktop">本次日期</th>
                                                                    <th class="desktop">週期天數</th>
                                                                    <th class="desktop">區域</th>
                                                                    <th class="desktop">負責員工</th>
                                                                    <th class="desktop">原因</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
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
@endsection

@section('modal')
<!-- Modal-alert -->
    <div class="modal fade" id="op-alert" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="cycleAssign">確認</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>

    var cycle = {!! json_encode($cycle) !!}; //php變數轉換
    var allAssign = {!! json_encode($allAssign) !!}; //php變數轉換

    var data1 = new Array();
    var k = -1

    $.each(cycle, function (i, item) {

        var a = allAssign.indexOf(item.KIND)

        if(a == -1){
            k++

            data1[k] = {
                first: `
                <div class="td-icon">
                <input class="chkall" type="checkbox" name="cycleKind" value="`+item.KIND+`">
                </div>
                `,
                cycle: item.KIND,
                name: item.CUSTKEY,
                staff: item.TOUCH,
                tel: "<a href='tel:"+item.COMTEL+"' class='text-nowrap'>"+item.COMTEL+"</a>",
                prev: item.LSTDATE,
                this: item.NXTDATE,
                day: item.CYCLE,
                section: item.AREA,
                principal: "",
                housetel: "<a href='tel:"+item.HOMETEL+"' class='text-nowrap'>"+item.HOMETEL+"</a>",
                mob: "<a href='tel:"+item.MPHONE+"' class='text-nowrap'>"+item.MPHONE+"</a>",
                mechine: "<a href='https://www.google.com.tw/maps/place/"+item.MACHINE+"' target='_blank'>"+item.MACHINE+"</a>",
                address: "<a href='https://www.google.com.tw/maps/place/"+item.PAYMENT+"' target='_blank'>"+item.PAYMENT+"</a>",
                productid: item.CDOE,
                productquantity: item.NUM,
                productprice: item.PRICE,
                other: item.MEMO
            }
        }

    })

    function format1(d) {
        return (
            `<table class="tb-child">
                <tr>
                    <td>家裡電話：` + d.housetel + `</td>
                    <td>產品代碼：` + d.productid + `</td>
                </tr>
                <tr>
                    <td>行動電話：` + d.mob + `</td>
                    <td>產品數量：` + d.productquantity + `</td>
                </tr>
                <tr>
                    <td>機器地址：` + d.productprice + `</td>
                    <td>產品單價：` + d.productprice + `</td>
                </tr>
                <tr>
                    <td>收款地址：` + d.address + `</td>
                    <td>其他備註：` + d.other + `</td>
                </tr>
            </table>`
        );
    }
    $(document).ready(function() {
        var table_s1 = $("#hetao-list-norwd").DataTable({
            "data": data1,
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
                "targets": [0, 1],
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
                { data: "cycle" },
                { data: "name" },
                { data: "staff" },
                { data: "tel" },
                { data: "prev" },
                { data: "this" },
                { data: "day" },
                { data: "section" },
                { data: "principal" },

            ],
        });

        $("#hetao-list-norwd tbody").on("click", "td.details-control", function() {
            var tr = $(this).closest("tr");
            var row = table_s1.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass("shown");
            } else {
                row.child(format1(row.data()), "p-0").show();
                tr.addClass("shown");
            }
        });

        $(".searchInput_s1").on("blur", function() {
            table_s1.search(this.value).draw();
        });

        $(".searchInput_s1").on("keyup", function() {
            table_s1.search(this.value).draw();
        });
    });

    var assign = {!! json_encode($assign) !!}; //php變數轉換

    var data2 = new Array();

    $.each(assign, function (i, item) {

        data2[i] = {
            first: `
            <div class="td-icon">
            <input class="chkall" type="checkbox" name="assignKind" value="`+item.kind+`">
            </div>
            `,
            cycle: item.kind,
            name: item.custkey,
            staff: item.touch,
            tel: "<a href='tel:"+item.companyTel+"' class='text-nowrap'>"+item.companyTel+"</a>",
            prev: item.lastDate,
            this: item.thisDate,
            day: item.cycle,
            section: item.area,
            principal: item.staff,
            status:item.status,
            housetel: "<a href='tel:"+item.homeTel+"' class='text-nowrap'>"+item.homeTel+"</a>",
            mob: "<a href='tel:"+item.mobile+"' class='text-nowrap'>"+item.mobile+"</a>",
            mechine: "<a href='https://www.google.com.tw/maps/place/"+item.machine+"' target='_blank'>"+item.machine+"</a>",
            address: "<a href='https://www.google.com.tw/maps/place/"+item.payAddress+"' target='_blank'>"+item.payAddress+"</a>",
            productid: item.productCode,
            productquantity: item.productNum,
            productprice: item.productPrice,
            other: item.other
        }

    })

    function format2(d) {
        return (
            `<table class="tb-child">
                <tr>
                    <td>家裡電話：` + d.housetel + `</td>
                    <td>產品代碼：` + d.productid + `</td>
                </tr>
                <tr>
                    <td>行動電話：` + d.mob + `</td>
                    <td>產品數量：` + d.productquantity + `</td>
                </tr>
                <tr>
                    <td>機器地址：` + d.productprice + `</td>
                    <td>產品單價：` + d.productprice + `</td>
                </tr>
                <tr>
                    <td>收款地址：` + d.address + `</td>
                    <td>其他備註：` + d.other + `</td>
                </tr>
            </table>`
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
                "targets": [0, 1],
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
                { data: "cycle" },
                { data: "name" },
                { data: "staff" },
                { data: "tel" },
                { data: "prev" },
                { data: "this" },
                { data: "day" },
                { data: "principal" },
                { data: "status" },
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


    var data3 = [{
            first: `
            <div class="td-icon">
                <input class="chkall" type="checkbox" value="">
            </div>
            `,
            cycle: "",
            name: "愛酷智能科技",
            staff: "Cindy",
            tel: "<a href='tel:0212345678' class='text-nowrap'>02-12345678</a>",
            prev: "2020-03-15",
            this: "2020-03-28",
            day: "10",
            section: "",
            principal: "Cindy",
            reason: "",
            housetel: "<a href='tel:0200000000' class='text-nowrap'>02-00000000</a>",
            mob: "<a href='tel:0912345678' class='text-nowrap'>0912345678</a>",
            mechine: "<a href='https://www.google.com.tw/maps?hl=zh-TW&tab=rl1' target='_blank'>台北市敦化南路</a>",
            address: "<a href='https://www.google.com.tw/maps?hl=zh-TW&tab=rl1' target='_blank'>台北市敦化南路</a>",
            productid: "00000",
            productquantity: "3",
            productprice: "28000",
            other: "無"
        },
        {
            first: `
            <div class="td-icon">
                <input class="chkall" type="checkbox" value="">
            </div>
            `,
            cycle: "",
            name: "愛酷智能科技",
            staff: "Cindy",
            tel: "<a href='tel:0212345678' class='text-nowrap'>02-12345678</a>",
            prev: "2020-03-15",
            this: "2020-03-28",
            day: "10",
            section: "",
            principal: "Cindy",
            reason: "",
            housetel: "<a href='tel:0200000000' class='text-nowrap'>02-00000000</a>",
            mob: "<a href='tel:0912345678' class='text-nowrap'>0912345678</a>",
            mechine: "<a href='https://www.google.com.tw/maps?hl=zh-TW&tab=rl1' target='_blank'>台北市敦化南路</a>",
            address: "<a href='https://www.google.com.tw/maps?hl=zh-TW&tab=rl1' target='_blank'>台北市敦化南路</a>",
            productid: "00000",
            productquantity: "3",
            productprice: "28000",
            other: "無"
        },
    ];

    function format3(d) {
        return (
            `<table class="tb-child">
                <tr>
                    <td>家裡電話：` + d.housetel + `</td>
                    <td>產品代碼：` + d.productid + `</td>
                </tr>
                <tr>
                    <td>行動電話：` + d.mob + `</td>
                    <td>產品數量：` + d.productquantity + `</td>
                </tr>
                <tr>
                    <td>機器地址：` + d.productprice + `</td>
                    <td>產品單價：` + d.productprice + `</td>
                </tr>
                <tr>
                    <td>收款地址：` + d.address + `</td>
                    <td>其他備註：` + d.other + `</td>
                </tr>
            </table>`
        );
    }
    $(document).ready(function() {
        var table_s3 = $("#hetao-list-norwd3").DataTable({
            "data": data3,
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
                "targets": [0, 1],
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
                { data: "cycle" },
                { data: "name" },
                { data: "staff" },
                { data: "tel" },
                { data: "prev" },
                { data: "this" },
                { data: "day" },
                { data: "section" },
                { data: "principal" },
                { data: "reason" },
            ],
        });

        $("#hetao-list-norwd3 tbody").on("click", "td.details-control", function() {
            var tr = $(this).closest("tr");
            var row = table_s3.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass("shown");
            } else {
                row.child(format3(row.data()), "p-0").show();
                tr.addClass("shown");
            }
        });

        $(".searchInput_s3").on("blur", function() {
            table_s3.search(this.value).draw();
        });

        $(".searchInput_s3").on("keyup", function() {
            table_s3.search(this.value).draw();
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
                <p>確認` + text + `嗎？</p>
            `)
        } else {
            $('#op-alert .modal-body').html(`
                <p>您沒有選取案件唷！</p>
            `)
        }
    });
    </script>
    <script type="text/javascript">
        $('#cycleAssign').on('click',function(){

            var count = 0

            $('input[name="cycleKind"]:checked').each(function(){

                 var id = $(this).val()
                 var staff = $('#cycleStaffSelect').val()

                 $.ajax({
                    type:'post',
                    url:"{{ route('ht.Cycle.all.cycleAssign',['organization'=>$organization]) }}",
                    data:{
                        '_token':'{{csrf_token()}}',
                        'id':id,
                        'staff':staff
                    },
                    success:function(res){
                        if(res.status == 200 && count == 0){
                            count += 1;
                            alert('卡片已指派');
                            window.location = '{{ route('ht.Cycle.all.index',['organization'=>$organization]) }}'
                        }
                    }
                 })
            })
        })
    </script>
@endsection