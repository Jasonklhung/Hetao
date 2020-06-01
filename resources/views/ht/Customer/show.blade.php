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
                                                <h4 class="text-primary mx-s">客戶代碼：{{$custkey}}</h4>
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
                                                                    @foreach($info as $key =>$data)
                                                                    <li><label class="w-105px">建檔日期：</label><span>{{ $data->DATE }}</span></li>
                                                                    <li><label class="w-105px">客戶卡號：</label><span>{{ $data->CARDNO }}</span></li>
                                                                    <li><label class="w-105px">客戶全銜：</label><span>{{ $data->FULLNAME }}</span></li>
                                                                    <li><label class="w-105px">客戶代碼：</label><span>{{ $data->CUSTKEY }}</span></li>
                                                                    <li><label class="w-105px">承辦人員：</label><span>{{ $data->TOUCH }}</span></li>
                                                                    <li><label class="w-105px">客戶類別：</label><span>{{ $data->CUSTCLASS }}</span></li>
                                                                    <li><label class="w-105px">區域代碼：</label><span>{{ $data->AREA }}</span></li>
                                                                    <li><label class="w-105px">統一編號：</label><span>{{ $data->TAXNO }}</span></li>
                                                                    <li><label class="w-105px">週期：</label><span>{{ $data->WAT_CYCLE }}</span></li>
                                                                    <li><label class="w-105px">備註：</label><span>{{ $data->MEMO }}</span></li>
                                                                    <li><label class="w-105px">預收款結餘：</label><span>{{ $data->MONEY }}</span></li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            <a href="{{ route('ht.Customer.index',['organization'=>$organization]) }}"><button class="btn btn-primary mt-s" type="button">返回</button> </a>
                                                        </div>
                                                        <div class="tab-pane" id="viewers-tab-02">
                                                            <div class="field customer-info">
                                                                <ul>
                                                                    @foreach($info as $key =>$data)
                                                                    <li><label class="w-105px">公司電話：</label><span><a href="tel:{{ $data->COMTEL }}">{{ $data->COMTEL }}</a></span></li>
                                                                    <li><label class="w-105px">公司分機：</label><span>{{ $data->COMEXT }}</span></li>
                                                                    <li><label class="w-105px">家裡電話：</label><span><a href="tel:{{ $data->HOMETEL }}">{{ $data->HOMETEL }}</a></span></li>
                                                                    <li><label class="w-105px">家裡分機：</label><span>{{ $data->HOMEEXT }}</span></li>
                                                                    <li><label class="w-105px">行動電話：</label><span><a href="tel:{{ $data->MPHONE }}">{{ $data->MPHONE }}</a></span></li>
                                                                    <li><label class="w-105px">機器地址：</label><span>{{ $data->MACHINE }}</span></li>
                                                                    <li><label class="w-105px">收款地址：</label><span>{{ $data->PAYMENT }}</span></li>
                                                                    <li><label class="w-105px">傳真機：</label><span>{{ $data->FAX }}</span></li>
                                                                    <li><label class="w-105px">電子郵件：</label><span><a href="mailto:{{ $data->EMAIL }}">{{ $data->EMAIL }}</a></span></li>
                                                                    <li><label class="w-105px">網址：</label><span><a target="_blank" href="{{ $data->HTTP }}">{{ $data->HTTP }}</a></span></li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            <a href="{{ route('ht.Customer.index',['organization'=>$organization]) }}"><button class="btn btn-primary mt-s" type="button">返回</button> </a>
                                                        </div>
                                                        <div class="tab-pane" id="viewers-tab-03">
                                                            <div class="field customer-info">
                                                                <ul>
                                                                    @foreach($info as $key =>$data)
                                                                    <li><label class="w-105px">水卡號：</label><span>{{ $data->WAT_NO }}</span></li>
                                                                    <li><label class="w-105px">水瓶押金：</label><span>{{ $data->BOTTLE1 }}</span></li>
                                                                    <li><label class="w-105px">未退瓶：</label><span>{{ $data->BOTTLE2 }}</span></li>
                                                                    <li><label class="w-105px">未送：</label><span>{{ $data->WAT_DEBT }}</span></li>
                                                                    <li><label class="w-105px">前次送水：</label><span>{{ $data->LBW_DAT }}</span></li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            <a href="{{ route('ht.Customer.index',['organization'=>$organization]) }}"><button class="btn btn-primary mt-s" type="button">返回</button> </a>
                                                        </div>
                                                        <div class="tab-pane" id="viewers-tab-04">
                                                            <div class="field customer-info">
                                                                <ul>
                                                                    @foreach($info as $key =>$data)
                                                                    <li><label class="w-105px">收款日期：</label><span>{{ $data->ACCDATE }}</span></li>
                                                                    <li><label class="w-105px">收款備註：</label><span>{{ $data->ACCMEMO }}</span></li>
                                                                    <li><label class="w-105px">最後往來：</label><span>{{ $data->LDATE }}</span></li>
                                                                    <li><label class="w-105px">往來內容：</label><span>{{ $data->SUBT }}</span></li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            <a href="{{ route('ht.Customer.index',['organization'=>$organization]) }}"><button class="btn btn-primary mt-s" type="button">返回</button> </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="info2">
                                                    <div class='coupon'>
                                                        <form class='form-inline'>
                                                            <input type="text" class="form-control mr-s searchInput searchInput_s1" placeholder="請輸入關鍵字">
                                                            <div class='form-group'>
                                                                <div class='datetime'>
                                                                    <div class='input-group date date-select' id="datetimepicker1">
                                                                        <input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                </div><span class='rwd-hide span-d'>~</span>
                                                                <div class='datetime'>
                                                                    <div class='input-group date date-select mr-s' id="datetimepicker2">
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
                                                    <a href="{{ route('ht.Customer.index',['organization'=>$organization]) }}"><button class="btn btn-primary mt-s" type="button">返回</button> </a>
                                                </div>
                                                <div class="info3">
                                                    <div class='coupon'>
                                                        <form class='form-inline'>
                                                            <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
                                                            <div class='form-group'>
                                                                <div class='datetime'>
                                                                    <div class='input-group date date-select' id="datetimepicker3">
                                                                        <input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                </div><span class='rwd-hide span-d'>~</span>
                                                                <div class='datetime'>
                                                                    <div class='input-group date date-select mr-s' id="datetimepicker4">
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
                                                            @foreach($arap as $key => $data)
                                                            <tr>
                                                                <td class="text-nowrap">{{ $data->DATE }}</td>
                                                                <td>{{ $data->SALENUM }}</td>
                                                                <td>${{ $data->RECEIVES }}</td>
                                                                <td>{{ $data->INVOICE }}</td>
                                                                <td class="text-nowrap">{{ $data->ACCPDAY }}</td>
                                                                <td>{{ $data->FAMILY }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <a href="{{ route('ht.Customer.index',['organization'=>$organization]) }}"><button class="btn btn-primary mt-s" type="button">返回</button> </a>
                                                </div>
                                                <div class="info4">
                                                    <div class='coupon'>
                                                        <form class='form-inline'>
                                                            <input type="text" class="form-control mr-s searchInput searchInput_s3" placeholder="請輸入關鍵字">
                                                            <div class='form-group'>
                                                                <div class='datetime'>
                                                                    <div class='input-group date date-select' id="datetimepicker5">
                                                                        <input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                </div><span class='rwd-hide span-d'>~</span>
                                                                <div class='datetime'>
                                                                    <div class='input-group date date-select mr-s' id="datetimepicker6">
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
                                                            @foreach($cycle as $key => $data)
                                                            <tr>
                                                                <td class="text-nowrap">{{ $data->BGNDATE }}</td>
                                                                <td>{{ $data->CODE }}</td>
                                                                <td>{{ $data->NUM }}</td>
                                                                <td>${{ $data->PRICE }}</td>
                                                                <td>{{ $data->CYCLE }}</td>
                                                                <td class="text-nowrap">{{ $data->LSTDATE }}</td>
                                                                <td class="text-nowrap">{{ $data->NXTDATE }}</td>
                                                                <td>{{ $data->MEMO }}</td>
                                                                @if($data->CEASE == '1')
                                                                <td>是</td>
                                                                @elseif($data->CEASE == null || $data->CEASE == '0')
                                                                <td>否</td>
                                                                @endif
                                                                <td class="text-nowrap">{{ $data->STOPDATE }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <a href="{{ route('ht.Customer.index',['organization'=>$organization]) }}"><button class="btn btn-primary mt-s" type="button">返回</button> </a>
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


    var trade = {!! json_encode($trade) !!}; //php變數轉換

    var data = new Array();

    $.each(trade, function (i, item) {

        if(item.STATUS == 'S'){
            var status = '送貨單'
        }
        else if(item.STATUS == 'P'){
            var status = '預收貨款'
        }
        else if(item.STATUS == 'G'){
            var status = '轉帳傳票'
        }

        if(item.TRANS == 'T'){
            var trans = '是'
        }
        else{
            var trans = '否'
        }

        data[i] = {
            day: item.DATE,
            number: item.SALENUM,
            staff: item.FAMILY,
            name: item.CUSTKEY,
            invoice: item.INVOICE,
            productid: item.CODE,
            productquantity: item.MATE,
            price: item.PRICE,
            ps1: item.SPC1,
            ps2: item.SPC2,
            tax: item.TAX,
            notax: item.AMOUNT,
            includetax: item.TAXAMOUNT,
            cash: item.CASH,
            check: item.CHEQUE,
            checknum: item.CHECKNO,
            exchangeday: item.CASHDAY,
            electric: item.TTT,
            discount: item.DISCOUNT,
            receivable: item.RECEIVES,
            prepaid: item.PREMONEY,
            prepaidprice: item.PREPLUS,
            prepaidday: item.ACCPDAY,
            group: item.TYPE,
            ifprepaid: status,
            allocate: trans,
            note: item.MEMO1,
            other: item.MEMO2,
            return: item.RETNBOTT,
            damaged: item.BRKGBOTT,
            mortgage: item.DEPOSITE,
            bottle: item.BOTINCOME,
            noreturn: item.BOTTLE,
            notto: item.WAT_DEBT,
        }
    })

    function format(d) {
        return (
            `<table class="tb-child">
                <tr><td><span class="w-105px">加註1</span>：` + d.ps1 + `</td></tr>
                <tr><td><span class="w-105px">加註2</span>：` + d.ps2 + `</td></tr>
                <tr><td><span class="w-105px">稅金</span>：` + d.tax + `</td></tr>
                <tr><td><span class="w-105px">未稅總價</span>：` + d.notax + `</td></tr>
                <tr><td><span class="w-105px">含稅總價</span>：` + d.includetax + `</td></tr>
                <tr><td><span class="w-105px">現金</span>：` + d.cash + `</td></tr>
                <tr><td><span class="w-105px">支票</span>：` + d.check + `</td></tr>
                <tr><td><span class="w-105px">支票號碼</span>：` + d.checknum + `</td></tr>
                <tr><td><span class="w-105px">兌換日期</span>：` + d.exchangeday + `</td></tr>
                <tr><td><span class="w-105px">電匯</span>：` + d.electric + `</td></tr>
                <tr><td><span class="w-105px">折讓</span>：` + d.discount + `</td></tr>
                <tr><td><span class="w-105px">應收帳款</span>：` + d.receivable + `</td></tr>
                <tr><td><span class="w-105px">銷貨預收</span>：` + d.prepaid + `</td></tr>
                <tr><td><span class="w-105px">預收貨款</span>：` + d.prepaidprice + `</td></tr>
                <tr><td><span class="w-105px">預計收款日</span>：` + d.prepaidday + `</td></tr>
                <tr><td><span class="w-105px">收款群組</span>：` + d.group + `</td></tr>
                <tr><td><span class="w-105px">是否預收貨款</span>：` + d.ifprepaid + `</td></tr>
                <tr><td><span class="w-105px">調撥賣給單位</span>：` + d.allocate + `</td></tr>
                <tr><td><span class="w-105px">備註</span>：` + d.note + `</td></tr>
                <tr><td><span class="w-105px">其他備註</span>：` + d.other + `</td></tr>
                <tr><td><span class="w-105px">退空瓶</span>：` + d.return+`</td></tr>
                <tr><td><span class="w-105px">破損瓶</span>：` + d.damaged + `</td></tr>
                <tr><td><span class="w-105px">抵押金</span>：` + d.mortgage + `</td></tr>
                <tr><td><span class="w-105px">空瓶價</span>：` + d.bottle + `</td></tr>
                <tr><td><span class="w-105px">未還空瓶</span>：` + d.noreturn + `</td></tr>
                <tr><td><span class="w-105px">預付未送瓶</span>：` + d.notto + `</td></tr>
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
                "emptyTable": "目前無資料",
                "infoFiltered": "(從 _MAX_ 筆中篩選)",
            },
            "dom": '<"top"i>rt<"bottom"flp><"clear">',
            "buttons": [{
                "extend": "colvis",
                "collectionLayout": "fixed two-column"
            }],
            "order": [1,'desc'],
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
            "emptyTable": "目前無應收帳款",
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
            "emptyTable": "目前無週期循環",
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

    $("#datetimepicker5").on("dp.change", function (e) {
        $('#datetimepicker6').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepicker6").on("dp.change", function (e) {
        $('#datetimepicker5').data("DateTimePicker").maxDate(e.date);
    });
</script>
@endsection