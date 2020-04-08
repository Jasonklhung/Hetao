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
                                            <i class="fas fa-sync-alt"></i>個人週期
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <!-- tab標籤 -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-01">週期回報</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-02">週期進度</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 工單回報 -->
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
                                                                                <select class='' id='sel1'>
                                                                                    <option selected disabled>請指派負責主管</option>
                                                                                    <option>Ricky</option>
                                                                                    <option>Eva</option>
                                                                                    <option>Apple</option>
                                                                                    <option>Banana</option>
                                                                                </select>
                                                                            </li>
                                                                            <li><a class="btn btn-bright m-0" data-toggle="modal" data-target="#op-alert" href="#">批次指派</a></li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <input class='day-set-c' placeholder='選擇日期' type='text' readonly>
                                                                            </li>
                                                                            <li><a class="btn btn-bright m-0" data-toggle="modal" data-target="#op-alert" href="#">選擇日期</a></li>
                                                                            <li class="divider"></li>
                                                                            <li><a data-toggle="modal" data-target="#newalert" href="#">轉單</a></li>
                                                                            <li><a data-toggle="modal" data-target="#op-alert" href="#">完成</a></li>
                                                                            <li><a data-toggle="modal" data-target="#op-alert" href="#">通知</a></li>
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
                                                    <!-- 工單進度 -->
                                                    <div class="tab-pane" id="viewers-tab-02">
                                                        <div class="bd-bottom mb-m">
                                                            <div class="d-flex w-100">
                                                                <span class="w-60px">完成</span>
                                                                <div class="progress flex-grow">
                                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                                                        70%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex w-100">
                                                                <span class="w-60px">執行中</span>
                                                                <div class="progress flex-grow">
                                                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">
                                                                        20%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex w-100">
                                                                <span class="w-60px">轉單</span>
                                                                <div class="progress flex-grow">
                                                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width:33%">
                                                                        33%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>    
                                                        <div class='coupon'>
                                                            <form class='form-inline'>
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
                                                                <select name="" class="form-control mb-s mr-s">
                                                                    <option value="">產品代碼</option>
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
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <table class="table table-hover dt-responsive table-striped staff" id="hetao-list-norwd2">
                                                            <thead class="">
                                                                <tr>
                                                                    <th class="desktop"></th>
                                                                    <th class="desktop"></th>
                                                                    <th class="desktop">完成日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">下次日期</th>
                                                                    <th class="desktop">產品代碼</th>
                                                                    <th class="desktop">產品數量</th>
                                                                    <th class="desktop">產品單價</th>
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal">確認</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal-轉單 -->
    <div class="modal fade" id="newalert" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    var data1 = [{
            first: `
            <div class="td-icon">
                <input class="chkall" type="checkbox" value="">
            </div>
            `,
            cycle: "類別",
            name: "愛酷智能科技",
            staff: "Cindy",
            tel: "<a href='tel:0212345678' class='text-nowrap'>02-12345678</a>",
            prev: "2020-03-15",
            this: "2020-03-28",
            day: "10",
            section: "",
            principal: "Cindy",
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
            housetel: "<a href='tel:0200000000' class='text-nowrap'>02-00000000</a>",
            mob: "<a href='tel:0912345678' class='text-nowrap'>0912345678</a>",
            mechine: "<a href='https://www.google.com.tw/maps?hl=zh-TW&tab=rl1' target='_blank'>台北市敦化南路</a>",
            address: "<a href='https://www.google.com.tw/maps?hl=zh-TW&tab=rl1' target='_blank'>台北市敦化南路</a>",
            productid: "00000",
            productquantity: "3",
            productprice: "28000",
            other: "無"
        },{
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
            housetel: "<a href='tel:0200000000' class='text-nowrap'>02-00000000</a>",
            mob: "<a href='tel:0912345678' class='text-nowrap'>0912345678</a>",
            mechine: "<a href='https://www.google.com.tw/maps?hl=zh-TW&tab=rl1' target='_blank'>台北市敦化南路</a>",
            address: "<a href='https://www.google.com.tw/maps?hl=zh-TW&tab=rl1' target='_blank'>台北市敦化南路</a>",
            productid: "00000",
            productquantity: "3",
            productprice: "28000",
            other: "無"
        },{
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
            housetel: "<a href='tel:0200000000' class='text-nowrap'>02-00000000</a>",
            mob: "<a href='tel:0912345678' class='text-nowrap'>0912345678</a>",
            mechine: "<a href='https://www.google.com.tw/maps?hl=zh-TW&tab=rl1' target='_blank'>台北市敦化南路</a>",
            address: "<a href='https://www.google.com.tw/maps?hl=zh-TW&tab=rl1' target='_blank'>台北市敦化南路</a>",
            productid: "00000",
            productquantity: "3",
            productprice: "28000",
            other: "無"
        },{
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
            housetel: "<a href='tel:0200000000' class='text-nowrap'>02-00000000</a>",
            mob: "<a href='tel:0912345678' class='text-nowrap'>0912345678</a>",
            mechine: "<a href='https://www.google.com.tw/maps?hl=zh-TW&tab=rl1' target='_blank'>台北市敦化南路</a>",
            address: "<a href='https://www.google.com.tw/maps?hl=zh-TW&tab=rl1' target='_blank'>台北市敦化南路</a>",
            productid: "00000",
            productquantity: "3",
            productprice: "28000",
            other: "無"
        },{
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
            housetel: "<a href='tel:0200000000' class='text-nowrap'>02-00000000</a>",
            mob: "<a href='tel:0912345678' class='text-nowrap'>0912345678</a>",
            mechine: "<a href='https://www.google.com.tw/maps?hl=zh-TW&tab=rl1' target='_blank'>台北市敦化南路</a>",
            address: "<a href='https://www.google.com.tw/maps?hl=zh-TW&tab=rl1' target='_blank'>台北市敦化南路</a>",
            productid: "00000",
            productquantity: "3",
            productprice: "28000",
            other: "無"
        },{
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


    var data2 = [{
            first: `
            <div class="td-icon">
                <input class="chkall" type="checkbox" value="">
            </div>
            `,
            finishday: "2020-03-10",
            name: "愛酷智能科技",
            staff: "Cindy",
            next: "2020-03-15",
            productid: "00000",
            productquantity: "3",
            productprice: "28000",
            housetel: "<a href='tel:0200000000' class='text-nowrap'>02-00000000</a>",
            tel: "<a href='tel:0212345678' class='text-nowrap'>02-12345678</a>",
            principal: "Cindy",
            mob: "<a href='tel:0912345678' class='text-nowrap'>0912345678</a>",
            cycle: "",
            other: "無",
            mechine: "<a href='https://www.google.com.tw/maps?hl=zh-TW&tab=rl1' target='_blank'>台北市敦化南路</a>",
            day: "10",
            address: "<a href='https://www.google.com.tw/maps?hl=zh-TW&tab=rl1' target='_blank'>台北市敦化南路</a>",
            section: "",
        },
        {
            first: `
            <div class="td-icon">
                <input class="chkall" type="checkbox" value="">
            </div>
            `,
            finishday: "2020-03-10",
            name: "愛酷智能科技",
            staff: "Cindy",
            next: "2020-03-15",
            productid: "00000",
            productquantity: "3",
            productprice: "28000",
            housetel: "<a href='tel:0200000000' class='text-nowrap'>02-00000000</a>",
            tel: "<a href='tel:0212345678' class='text-nowrap'>02-12345678</a>",
            principal: "Cindy",
            mob: "<a href='tel:0912345678' class='text-nowrap'>0912345678</a>",
            cycle: "",
            other: "無",
            mechine: "<a href='https://www.google.com.tw/maps?hl=zh-TW&tab=rl1' target='_blank'>台北市敦化南路</a>",
            day: "10",
            address: "<a href='https://www.google.com.tw/maps?hl=zh-TW&tab=rl1' target='_blank'>台北市敦化南路</a>",
            section: "",
        },
    ];

    function format2(d) {
        return (
            `<table class="tb-child">
                <tr>
                    <td>家裡電話：` + d.housetel + `</td>
                    <td>公司電話：` + d.productid + `</td>
                    <td>負責員工：` + d.staff + ` </td>
                </tr>
                <tr>
                    <td>行動電話：` + d.mob + `</td>
                    <td>週期類別：` + d.cycle + `</td>
                    <td>機器地址：` + d.mechine + `</td>
                </tr>
                <tr>
                    <td>週期天數：` + d.day + `</td>
                    <td>收款地址：` + d.address + `</td>
                    <td>區域：` + d.section + `</td>
                </tr>
                <tr>
                    <td colspan="3">其他備註：` + d.other + `</td>
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
                { data: "finishday" },
                { data: "name" },
                { data: "staff" },
                { data: "next" },
                { data: "productid" },
                { data: "productquantity" },
                { data: "productprice" },

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

    $('a[data-target="#newalert"]').on('click', function() {
        var text = $(this).text()
        var checked = $("input.chkall")
        if ($(this).parents('.tab-pane').find(checked).filter(":checked").length >= 1) {
            $('#newalert .modal-content').html(`
                <div class="modal-header border-none">
                    轉單原因
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body m-0">
                    <form>
                        <div class="d-block mb-s">
                            <input class="choose" id="choose1" type="radio" name="t" value="">
                            <label for="choose1" class="chooseitem">
                                客戶另約日期<br><div class='form-inline'>下次日期<input type="text" class="form-control day-set ml-s"></div>
                            </label>
                        </div>
                        <div class="d-block mb-s"><input class="choose" id="choose2" type="radio" name="t" value=""><label for="choose2" class="chooseitem">客戶不需更換</label></div>
                        <div class="d-block mb-s">
                            <div class='form-inline'>
                                <input class="choose" id="choose3" type="radio" name="t" value="">
                                <label for="choose3" class="chooseitem">其他</label>
                                <input type="text" class="form-control ml-s">
                            </div>     
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">確認</button>
                </div>
            `)
            $(function() {
                $('.day-set').datetimepicker({
                    format: 'YYYY-MM-DD',
                    ignoreReadonly: true,
                    allowInputToggle: true,
                    locale: 'ZH-TW',
                    useCurrent: false,
                    ignoreReadonly: true,
                    defaultDate: new Date(),
                    locale: 'ZH-TW',
                });
            });
        } else {
            $('#newalert .modal-content').html(`
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <p>您沒有選取案件唷！</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">確認</button>
                </div>
            `)
        }
    });
    </script>
@endsection