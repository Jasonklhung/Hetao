@extends('layout.app')

@section('content')
		<div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">客戶資料查詢</h3>
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-info-circle"></i>客戶資料總覽
                                        </div>
                                        <div class="panel-body tab-pane">
                                            <div class="tabbable">
                                                <h4 class="text-primary mx-s">客戶代碼：愛酷智能</h4>
                                                <div class="coupon">
                                                    <select class="form-control mr-s mb-s infoselect" name="" id="">
                                                        <option value="基本資料" selected>基本資料</option>
                                                        <option value="交易資料">交易資料</option>
                                                        <option value="應收帳款">應收帳款</option>
                                                        <option value="週期循環">週期循環</option>
                                                    </select>
                                                </div>
                                                <!-- tab標籤 -->
                                                <div class="info1">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active">
                                                            <a data-toggle="tab" href="#viewers-tab-01">客戶資訊</a>
                                                        </li>
                                                        <li>
                                                            <a data-toggle="tab" href="#viewers-tab-02">聯絡資訊</a>
                                                        </li>
                                                        <li>
                                                            <a data-toggle="tab" href="#viewers-tab-03">水瓶相關</a>
                                                        </li>
                                                        <li>
                                                            <a data-toggle="tab" href="#viewers-tab-04">其他</a>
                                                        </li>
                                                    </ul>
                                                    <!-- tab標籤內容 -->
                                                    <div class="tab-content">
                                                        <!-- 基本資料 -->
                                                        <div class="tab-pane active" id="viewers-tab-01">
                                                            <div class="field customer-info">
                                                                <ul>
                                                                    <li><label class="w-105px">建檔日期：</label><span>2020-3-27</span></li>
                                                                    <li><label class="w-105px">客戶卡號：</label><span>00100000</span></li>
                                                                    <li><label class="w-105px">客戶全銜：</label><span>愛酷智能科技股份有限公司</span></li>
                                                                    <li><label class="w-105px">客戶代碼：</label><span>愛酷智能</span></li>
                                                                    <li><label class="w-105px">承辦人員：</label><span>Cindy</span></li>
                                                                    <li><label class="w-105px">客戶類別：</label><span></span></li>
                                                                    <li><label class="w-105px">區域代碼：</label><span>0000012338</span></li>
                                                                    <li><label class="w-105px">統一編號：</label><span>1234567</span></li>
                                                                    <li><label class="w-105px">週期：</label><span></span></li>
                                                                    <li><label class="w-105px">備註：</label><span>備註備註備註備註備註備註備註備註備註備註備註備註備註備註備註備註</span></li>
                                                                    <li><label class="w-105px">預收款結餘：</label><span>$1000000</span></li>
                                                                </ul>
                                                            </div>
                                                            <a href="客戶資料查詢.html"><button class="btn btn-primary mt-s" type="button">返回</button> </a>
                                                        </div>
                                                        <div class="tab-pane" id="viewers-tab-02">
                                                            <div class="field customer-info">
                                                                <ul>
                                                                    <li><label class="w-105px">公司電話：</label><span><a href="tel:0212345678">02-12345678</a></span></li>
                                                                    <li><label class="w-105px">公司分機：</label><span>001</span></li>
                                                                    <li><label class="w-105px">家裡電話：</label><span><a href="tel:0212345678">02-12345678</a></span></li>
                                                                    <li><label class="w-105px">家裡分機：</label><span>123</span></li>
                                                                    <li><label class="w-105px">行動電話：</label><span><a href="tel:0912345678">0912345678</a></span></li>
                                                                    <li><label class="w-105px">機器地址：</label><span></span></li>
                                                                    <li><label class="w-105px">收款地址：</label><span>愛酷智能</span></li>
                                                                    <li><label class="w-105px">傳真機：</label><span>Cindy</span></li>
                                                                    <li><label class="w-105px">電子郵件：</label><span><a href="mailto:123@aaa.com">123@aaa.com</a></span></li>
                                                                    <li><label class="w-105px">網址：</label><span><a target="_blank" href="https://google.com">https://google.com</a></span></li>
                                                                </ul>
                                                            </div>
                                                            <a href="客戶資料查詢.html"><button class="btn btn-primary mt-s" type="button">返回</button> </a>
                                                        </div>
                                                        <div class="tab-pane" id="viewers-tab-03">
                                                            <div class="field customer-info">
                                                                <ul>
                                                                    <li><label class="w-105px">水卡號：</label><span></span></li>
                                                                    <li><label class="w-105px">水瓶押金：</label><span></span></li>
                                                                    <li><label class="w-105px">未退瓶：</label><span></span></li>
                                                                    <li><label class="w-105px">未送：</label><span></span></li>
                                                                    <li><label class="w-105px">前次送水：</label><span></span></li>
                                                                </ul>
                                                            </div>
                                                            <a href="客戶資料查詢.html"><button class="btn btn-primary mt-s" type="button">返回</button> </a>
                                                        </div>
                                                        <div class="tab-pane" id="viewers-tab-04">
                                                            <div class="field customer-info">
                                                                <ul>
                                                                    <li><label class="w-105px">收款日期：</label><span></span></li>
                                                                    <li><label class="w-105px">收款備註：</label><span></span></li>
                                                                    <li><label class="w-105px">最後往來：</label><span></span></li>
                                                                    <li><label class="w-105px">往來內容：</label><span></span></li>
                                                                </ul>
                                                            </div>
                                                            <a href="客戶資料查詢.html"><button class="btn btn-primary mt-s" type="button">返回</button> </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="info2">
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
                                                                <option value="">報帳人員</option>
                                                            </select>
                                                            <select name="" class="form-control mb-s mr-s">
                                                                <option value="">產品代碼</option>
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
                                                                <th class="desktop">日期</th>
                                                                <th class="desktop">銷單編號</th>
                                                                <th class="desktop">報帳人員</th>
                                                                <th class="desktop">客戶代碼</th>
                                                                <th class="desktop">發票號碼</th>
                                                                <th class="desktop">產品代碼</th>
                                                                <th class="desktop">產品數量</th>
                                                                <th class="desktop">未稅單價</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                    <a href="客戶資料查詢.html"><button class="btn btn-primary mt-s" type="button">返回</button> </a>
                                                </div>
                                                <div class="info3">
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
                                                                <option selected hidden disabled value="">負責員工</option>
                                                            </select>
                                                            <div class='btn-wrap'>
                                                                <button class='mr-s' type="button">查詢</button>
                                                                <button class='mr-s' type="button">重設</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <table class="table table-hover dt-responsive table-striped W-100" id="hetao-list-s-2">
                                                        <thead class="rwdhide">
                                                            <tr>
                                                                <th class="desktop">銷單日期</th>
                                                                <th class="desktop">銷單號碼</th>
                                                                <th class="desktop">應收帳款金額</th>
                                                                <th class="desktop">發票號碼</th>
                                                                <th class="desktop">預計收款日期</th>
                                                                <th class="desktop">負責員工</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-nowrap">2020-03-20</td>
                                                                <td>012345678</td>
                                                                <td>$100000</td>
                                                                <td>XX123456</td>
                                                                <td class="text-nowrap">2020-03-20</td>
                                                                <td>Cindy</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-nowrap">2020-03-20</td>
                                                                <td>012345678</td>
                                                                <td>$100000</td>
                                                                <td>XX123456</td>
                                                                <td class="text-nowrap">2020-03-20</td>
                                                                <td>Cindy</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <a href="客戶資料查詢.html"><button class="btn btn-primary mt-s" type="button">返回</button> </a>
                                                </div>
                                                <div class="info4">
                                                    <div class='coupon'>
                                                        <form class='form-inline'>
                                                            <input type="text" class="form-control mr-s searchInput searchInput_s3" placeholder="請輸入關鍵字">
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
                                                    <table class="table table-hover dt-responsive table-striped W-100" id="hetao-list-s-3">
                                                        <thead class="rwdhide">
                                                            <tr>
                                                                <th class="desktop">起始日期</th>
                                                                <th class="desktop">產品代碼</th>
                                                                <th class="desktop">數量</th>
                                                                <th class="desktop">單價</th>
                                                                <th class="desktop">天數</th>
                                                                <th class="desktop">上次日期</th>
                                                                <th class="desktop">下次日期</th>
                                                                <th class="desktop">備註</th>
                                                                <th class="desktop">是否停派</th>
                                                                <th class="desktop">停派日期</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-nowrap">2020-03-20</td>
                                                                <td>012345678</td>
                                                                <td>2</td>
                                                                <td>$28000</td>
                                                                <td></td>
                                                                <td class="text-nowrap">2020-03-20</td>
                                                                <td class="text-nowrap">2020-03-20</td>
                                                                <td>123456789789</td>
                                                                <td></td>
                                                                <td class="text-nowrap">2020-03-20</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-nowrap">2020-03-20</td>
                                                                <td>012345678</td>
                                                                <td>2</td>
                                                                <td>$28000</td>
                                                                <td></td>
                                                                <td class="text-nowrap">2020-03-20</td>
                                                                <td class="text-nowrap">2020-03-20</td>
                                                                <td>123456789789</td>
                                                                <td></td>
                                                                <td class="text-nowrap">2020-03-20</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <a href="客戶資料查詢.html"><button class="btn btn-primary mt-s" type="button">返回</button> </a>
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
    //下拉選單切換頁面
    $(document).ready(function() {
        $('.tabbable div[class^=info]').hide();
        $('.info1').show();
        $('.infoselect').on('change', function() {
            $('.tabbable div[class^=info]').hide();
            if ($(this).val() == "基本資料") {
                $('.info1').fadeIn(500);
            } else if ($(this).val() == "交易資料") {
                $('.info2').fadeIn(500);
            } else if ($(this).val() == "應收帳款") {
                $('.info3').fadeIn(500);
            } else if ($(this).val() == "週期循環") {
                $('.info4').fadeIn(500);
            }
        });
    });




    var data = [{
            day: "<span class='text-nowrap'>2020-03-20</span>",
            number: "12345678",
            staff: "Cindy",
            name: "愛酷智能",
            invoice: "XX12345678",
            productid: "",
            productquantity: "",
            price: "",
            ps1: "",
            ps2: "",
            tax: "",
            notax: "",
            includetax: "",
            cash: "",
            check: "",
            checknum: "",
            exchangeday: "",
            electric: "",
            discount: "",
            receivable: "",
            prepaid: "",
            prepaidprice: "",
            prepaidday: "",
            group: "",
            ifprepaid: "",
            allocate: "",
            note: "",
            other: "",
            return: "",
            damaged: "",
            mortgage: "",
            bottle: "",
            noreturn: "",
            notto: "",
        },
        {
            day: "<span class='text-nowrap'>2020-03-20</span>",
            number: "12345678",
            staff: "Cindy",
            name: "愛酷智能",
            invoice: "XX12345678",
            productid: "",
            productquantity: "",
            price: "",
            ps1: "",
            ps2: "",
            tax: "",
            notax: "",
            includetax: "",
            cash: "",
            check: "",
            checknum: "",
            exchangeday: "",
            electric: "",
            discount: "",
            receivable: "",
            prepaid: "",
            prepaidprice: "",
            prepaidday: "",
            group: "",
            ifprepaid: "",
            allocate: "",
            note: "",
            other: "",
            return: "",
            damaged: "",
            mortgage: "",
            bottle: "",
            noreturn: "",
            notto: "",
        },
    ];

    function format(d) {
        return (
            `<table class="tb-child">
                <tr>
                    <td>加註1：` + d.ps1 + `</td><td>現金：` + d.cash + `</td><td>折讓：` + d.discount + `</td><td>收款群組：` + d.group + `</td><td>退空瓶：` + d.return+`</td>
                </tr>
                <tr>
                    <td>加註2：` + d.ps2 + `</td><td>支票：` + d.check + `</td><td>應收帳款：` + d.receivable + `</td><td>是否預收貨款：` + d.ifprepaid + `</td><td>破損瓶：` + d.damaged + `</td>
                </tr>
                <tr>
                    <td>稅金：` + d.tax + `</td><td>支票號碼：` + d.checknum + `</td><td>銷貨預收：` + d.prepaid + `</td><td>調撥賣給單位：` + d.allocate + `</td><td>抵押金：` + d.mortgage + `</td>
                </tr>
                <tr>
                    <td>未稅總價：` + d.notax + `</td><td>兌換日期：` + d.exchangeday + `</td><td>預收貨款：` + d.prepaidprice + `</td><td>備註：` + d.note + `</td><td>空瓶價：` + d.bottle + `</td>
                </tr>
                <tr>
                    <td>含稅總價` + d.includetax + `</td><td>電匯：` + d.electric + `</td><td>預計收款日：` + d.prepaidday + `</td><td>其他備註：` + d.other + `</td><td>未還空瓶：` + d.noreturn + `</td>
                </tr>
                <tr>
                    <td></td><td></td><td></td><td></td><td>預付未送瓶：` + d.notto + `</td>
                </tr>
            </table>`
        );
    }
    $(document).ready(function() {
        var table_s1 = $("#hetao-list-norwd").DataTable({
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
            columns: [{
                    className: "details-control",
                    orderable: false,
                    data: null,
                    defaultContent: '<span class="lnr lnr-chevron-down"></span>'
                },
                { data: "day" },
                { data: "number" },
                { data: "staff" },
                { data: "name" },
                { data: "invoice" },
                { data: "productid" },
                { data: "productquantity" },
                { data: "price" },
            ],
        });

        $("#hetao-list-norwd tbody").on("click", "td.details-control", function() {
            var tr = $(this).closest("tr");
            var row = table_s1.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass("shown");
            } else {
                row.child(format(row.data()), "p-0").show();
                tr.addClass("shown");
            }
        });

        $(".searchInput_s2").on("blur", function() {
            table_s1.search(this.value).draw();
        });

        $(".searchInput_s2").on("keyup", function() {
            table_s1.search(this.value).draw();
        });
    });

    var table_s2 = $("#hetao-list-s-2").DataTable({
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
    $(".searchInput_s2").on("blur", function() {
        table_s2.search(this.value).draw();
    });

    $(".searchInput_s2").on("keyup", function() {
        table_s2.search(this.value).draw();
    });

    var table_s3 = $("#hetao-list-s-3").DataTable({
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
    $(".searchInput_s3").on("blur", function() {
        table_s3.search(this.value).draw();
    });

    $(".searchInput_s3").on("keyup", function() {
        table_s3.search(this.value).draw();
    });

</script>
@endsection