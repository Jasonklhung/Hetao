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
                                                            <form class="form-inline" id="cycleReportSearch">
                                                                @csrf
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s1" placeholder="請輸入關鍵字">
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
                                                                    <div class="droptool mr-s">
                                                                        <button class="btn btn-gray" type="button"><i class="fas fa-cog"></i>
                                                                        </button>
                                                                        <ul class="droptool-menu lg">
                                                                            <li>
                                                                                <input class="d-none" id='chkall1' type='checkbox' value='' /><label for='chkall1' class='sall'></label>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <input class='day-set-c' placeholder='選擇日期' type='text' readonly id="editDate">
                                                                            </li>
                                                                            <li><a class="btn btn-bright m-0" data-toggle="modal" data-target="#op-alert1" href="#">指定本次日期</a></li>
                                                                            <li class="divider"></li>
                                                                            <li><a data-toggle="modal" data-target="#newalert" href="#">轉單</a></li>
                                                                            <li><a data-toggle="modal" data-target="#op-alert2" href="#">完成</a></li>
                                                                            <li><a data-toggle="modal" data-target="#op-alert3" href="#">通知</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-norwd-cycle">
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
                                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{$cycleF}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$cycleF}}%">
                                                                        {{round($cycleF)}}%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex w-100">
                                                                <span class="w-60px">執行中</span>
                                                                <div class="progress flex-grow">
                                                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{$cycleS}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$cycleS}}%">
                                                                        {{round($cycleS)}}%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex w-100">
                                                                <span class="w-60px">轉單</span>
                                                                <div class="progress flex-grow">
                                                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{{$cycleT}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$cycleT}}%">
                                                                        {{round($cycleT)}}%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>    
                                                        <div class='coupon'>
                                                            <form class='form-inline' id="cycleNowSearch">
                                                                @csrf
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
                                                                <select name="code" class="form-control mb-s mr-s" id="code">
                                                                    <option value="">產品代碼</option>
                                                                    @foreach($cycleCategory as $key => $data)
                                                                    <option value="{{$data}}">{{$data}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text' name="start" id="start2"> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide span-d'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' type='text' name="end" id="end2"> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="submit">查詢</button>
                                                                    <button class='mr-s' type="button" id="reset2">重設</button>
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
    <!-- 週期循環修改日期 -->
    <div class="modal fade" id="op-alert1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="changeDate">確認</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 週期循環完成 -->
    <div class="modal fade" id="op-alert2" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="cycleFinish">確認</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="op-alert3" role="dialog">
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

    var cycle = {!! json_encode($cycle) !!}; //php變數轉換
    var cycleArrayCount = {!! json_encode($cycleArrayCount) !!}; //php變數轉換

    var data1 = new Array();

    $.each(cycle, function (i, item) {

        data1[i] = {
            first: `
            <div class="td-icon">
            <input class="chkall" type="checkbox" name="assignId" value="`+item.id+`">
            </div>
            `,
            cycle: item.kind,
            name: item.custkey,
            staff: item.touch,
            tel: "<a href='tel:"+item.companyTel+"' class='text-nowrap'>"+item.companyTel+"</a>",
            prev: item.lastDate,
            this: "<input type='text' class='date-select form-control w-150px d-inline thisDate' name='thisDate"+item.id+"' value='"+item.thisDate+"'><input type='hidden' name='thisDateVal' value='"+item.id+"'>",
            day: item.cycle,
            section: item.area,
            principal: item.staff,
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

    function format1(d) {
        return (
            `<table class="tb-child">
                <tr class='rwd-show'><td><span class='w-105px'>公司電話：</span>` + d.tel + `</td></tr>
                <tr class='rwd-show'><td><span class='w-105px'>上次日期：</span>` + d.prev + `</td></tr>
                <tr class='rwd-show'><td><span class='w-105px'>本次日期：</span>` + d.this + `</td></tr>
                <tr class='rwd-show'><td><span class='w-105px'>週期天數：</span>` + d.day + `</td></tr>
                <tr class='rwd-show'><td><span class='w-105px'>區域：</span>` + d.section + `</td></tr>
                <tr class='rwd-show'><td><span class='w-105px'>負責員工：</span>` + d.principal + `</td></tr>
                <tr><td><span class='w-105px'>家裡電話：</span>` + d.housetel + `</td></tr>
                <tr><td><span class='w-105px'>行動電話：</span>` + d.mob + `</td></tr>
                <tr><td><span class='w-105px'>機器地址：</span>` + d.productprice + `</td></tr>
                <tr><td><span class='w-105px'>收款地址：</span>` + d.address + `</td></tr>
                <tr><td><span class='w-105px'>產品代碼：</span>` + d.productid + `</td></tr>
                <tr><td><span class='w-105px'>產品數量：</span>` + d.productquantity + `</td></tr>
                <tr><td><span class='w-105px'>產品單價：</span>` + d.productprice + `</td></tr>
                <tr><td><span class='w-105px'>其他備註：</span>` + d.other + `</td></tr>
                
            </table>`
        );
    }
    $(document).ready(function() {
        var table_s1 = $("#hetao-list-norwd-cycle").DataTable({
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
                "info": "<p>共有 "+cycleArrayCount+" 張卡片</p>顯示 _START_ 至 _END_ 筆，共有 _TOTAL_ 筆",
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
            autoWidth: false,
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

        $('#hetao-list-norwd-cycle tbody').on('blur', '.thisDate', function () {

            var id = $(this)[0].name;
            var value = $(this).val();

            $.ajax({
                type:'post',
                url:"{{ route('ht.Cycle.self.thisDateChange',['organization'=>$organization]) }}",
                data:{
                    '_token':'{{csrf_token()}}',
                    'id':id,
                    'value':value
                },
                success:function(res){
                    if(res.status == 200){
                        alert('本次日期已修改')
                    }
                }
            })
        })

        $("#hetao-list-norwd-cycle tbody").on("click", "td.details-control", function() {
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

        //rwd讓欄位消失
        window.onresize = function() {
              var w = this.innerWidth;
              table_s1.column(5).visible( w > 768);
              table_s1.column(6).visible( w > 768);
              table_s1.column(7).visible( w > 768);
              table_s1.column(8).visible( w > 768);
              table_s1.column(9).visible( w > 768);  
              table_s1.column(10).visible( w > 768);  
            }
        //trigger upon pageload
        $(window).trigger('resize');
    });

    $(function() {
        $('.date-select').datetimepicker({
            format: 'YYYY-MM-DD',
            ignoreReadonly: true,
            allowInputToggle: true,
            locale: 'ZH-TW',
            useCurrent: false,
            ignoreReadonly: true,
            widgetPositioning: { horizontal: 'left', vertical: 'bottom'},
        });
    });

    $('body').on('click', '.details-control span', function(){
        $('.date-select').datetimepicker({
            format: 'YYYY-MM-DD',
            ignoreReadonly: true,
            allowInputToggle: true,
            locale: 'ZH-TW',
            useCurrent: false,
            ignoreReadonly: true,
        });
    });


    var cycleNext = {!! json_encode($cycleNext) !!}; //php變數轉換

    var data2 = new Array();

    $.each(cycleNext, function (i, item) {

        data2[i] = {
            first: `
            <div class="td-icon">
            <input class="chkall" type="checkbox" value="">
            </div>
            `,
            finishday: item.finishDate,
            name: item.custkey,
            staff: item.touch,
            next: item.nextDate,
            productid: item.productCode,
            productquantity: item.productNum,
            productprice: item.productPrice,
            housetel: "<a href='tel:"+item.homeTel+"' class='text-nowrap'>"+item.homeTel+"</a>",
            tel: "<a href='tel:"+item.companyTel+"' class='text-nowrap'>"+item.companyTel+"</a>",
            principal: item.staff,
            mob: "<a href='tel:"+item.mobile+"' class='text-nowrap'>"+item.mobile+"</a>",
            cycle: item.kind,
            other: item.other,
            mechine: "<a href='https://www.google.com.tw/maps/place/"+item.machine+"' target='_blank'>"+item.machine+"</a>",
            day: item.cycle,
            address: "<a href='https://www.google.com.tw/maps/place/"+item.payAddress+"' target='_blank'>"+item.payAddress+"</a>",
            section: item.area,
        }
    })

    function format2(d) {
        return (
            `<table class="tb-child">
                <tr><td><span class='w-105px'>家裡電話：</span>` + d.housetel + `</td></tr>
                <tr><td><span class='w-105px'>行動電話：</span>` + d.mob + `</td></tr>
                <tr><td><span class='w-105px'>週期天數：</span>` + d.day + `</td></tr>
                <tr><td><span class='w-105px'>公司電話：</span>` + d.productid + `</td></tr>
                <tr><td><span class='w-105px'>週期類別：</span>` + d.cycle + `</td></tr>
                <tr><td><span class='w-105px'>收款地址：</span>` + d.address + `</td></tr>
                <tr><td><span class='w-105px'>負責員工：</span>` + d.staff + ` </td></tr>
                <tr><td><span class='w-105px'>機器地址：</span>` + d.mechine + `</td></tr>
                <tr><td><span class='w-105px'>區域：</span>` + d.section + `</td></tr>
                <tr><td colspan="3"><span class='w-105px'>其他備註：</span>` + d.other + `</td></tr>
            </table>`
        );}
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
    $('a[data-target="#op-alert1"]').on('click', function() {
        var text = $(this).text()
        var checked = $("input.chkall")
        if ($(this).parents('.tab-pane').find(checked).filter(":checked").length >= 1) {
            $('#op-alert1 .modal-body').html(`
                <p>確認` + text + `嗎？</p>
            `)
        } else {
            $('#op-alert .modal-body').html(`
                <p>您沒有選取案件唷！</p>
            `)
        }
    });

    // modal-alert
    $('a[data-target="#op-alert2"]').on('click', function() {
        var text = $(this).text()
        var checked = $("input.chkall")
        if ($(this).parents('.tab-pane').find(checked).filter(":checked").length >= 1) {
            $('#op-alert2 .modal-body').html(`
                <p>確認` + text + `嗎？</p>
            `)
        } else {
            $('#op-alert .modal-body').html(`
                <p>您沒有選取案件唷！</p>
            `)
        }
    });

    // modal-alert
    $('a[data-target="#op-alert3"]').on('click', function() {
        var text = $(this).text()
        var checked = $("input.chkall")
        if ($(this).parents('.tab-pane').find(checked).filter(":checked").length >= 1) {
            $('#op-alert3 .modal-body').html(`
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
                            <input class="choose" id="choose1" type="radio" name="t" value="newDate" checked>
                            <label for="choose1" class="chooseitem">
                                客戶另約日期<br><div class='form-inline'>下次日期<input type="text" class="form-control day-set ml-s" name="newDate"></div>
                            </label>
                        </div>
                        <div class="d-block mb-s"><input class="choose" id="choose2" type="radio" name="t" value="notChange"><label for="choose2" class="chooseitem">客戶不需更換</label></div>
                        <div class="d-block mb-s">
                            <div class='form-inline'>
                                <input class="choose" id="choose3" type="radio" name="t" value="other">
                                <label for="choose3" class="chooseitem">其他</label>
                                <input type="text" class="form-control ml-s" name="reason">
                            </div>     
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="cycleTurn">確認</button>
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

            // 通知確認提醒判斷
            // $('#op-alert button.check').on('click', function(){
            //     if ($('#op-alert .modal-body p').html() == "確認通知嗎？") {
            //         $('#messenge-s').modal();
            //     }
            // });

            //轉單
            $('#cycleTurn').on('click',function(){

                var count = 0

                $('input[name="assignId"]:checked').each(function(){

                    var id = $(this).val()
                    var radio = $('input[name="t"]:checked').val();

                    if(radio == 'newDate'){

                        var reason = $('input[name="newDate"]').val()
                    }
                    else if(radio == 'notChange'){

                        var reason = "客戶不需更換"
                    }
                    else if(radio == 'other'){

                        var reason = $('input[name="reason"]').val()
                    }

                    $.ajax({
                        type:'post',
                        url:"{{ route('ht.Cycle.self.cycleTurn',['organization'=>$organization]) }}",
                        data:{
                            '_token':'{{csrf_token()}}',
                            'id':id,
                            'radio':radio,
                            'reason':reason
                        },
                        success:function(res){
                            console.log(res)
                            console.log(res.status)
                            if(res.status == 200 && count == 0){
                                count += 1;
                                alert('轉單成功');
                                window.location = '{{ route('ht.Cycle.self.index',['organization'=>$organization]) }}'
                            }
                        }
                    })
                })
            })
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
    <script type="text/javascript">
        //更改日期
        $('#changeDate').on('click',function(){

            var count = 0

            $('input[name="assignId"]:checked').each(function(){

                 var id = $(this).val()
                 var date = $('#editDate').val()

                 $.ajax({
                    type:'post',
                    url:"{{ route('ht.Cycle.self.changeDate',['organization'=>$organization]) }}",
                    data:{
                        '_token':'{{csrf_token()}}',
                        'id':id,
                        'date':date
                    },
                    success:function(res){
                        if(res.status == 200 && count == 0){
                            count += 1;
                            alert('日期已修改');
                            window.location = '{{ route('ht.Cycle.self.index',['organization'=>$organization]) }}'
                        }
                    }
                 })
            })
        })

        //完成
        $('#cycleFinish').on('click',function(){

            var count = 0

            $('input[name="assignId"]:checked').each(function(){

                 var id = $(this).val()

                 $.ajax({
                    type:'post',
                    url:"{{ route('ht.Cycle.self.cycleFinish',['organization'=>$organization]) }}",
                    data:{
                        '_token':'{{csrf_token()}}',
                        'id':id,
                    },
                    success:function(res){
                        if(res.status == 200 && count == 0){
                            count += 1;
                            alert('週期已完成');
                            window.location = '{{ route('ht.Cycle.self.index',['organization'=>$organization]) }}'
                        }
                    }
                 })
            })
        })

        //直接改日期

    </script>
    <script type="text/javascript">
            //回報搜尋
            $('#cycleReportSearch').on('submit',function(e){

                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    type:'post',
                    url:"{{ route('ht.Cycle.self.cycleReportSearch',['organization'=>$organization]) }}",
                    data:formData,
                    success:function(res){
                        
                        $('#hetao-list-norwd-cycle').DataTable().destroy();
                        $('#hetao-list-norwd-cycle tbody').empty();

                        var data1 = new Array();

                        $.each(res[0], function (i, item) {

                            data1[i] = {
                                first: `
                                <div class="td-icon">
                                <input class="chkall" type="checkbox" name="assignId" value="`+item.id+`">
                                </div>
                                `,
                                cycle: item.kind,
                                name: item.custkey,
                                staff: item.touch,
                                tel: "<a href='tel:"+item.companyTel+"' class='text-nowrap'>"+item.companyTel+"</a>",
                                prev: item.lastDate,
                                this: "<input type='text' class='date-select form-control w-150px d-inline thisDate' name='thisDate"+item.id+"' value='"+item.thisDate+"'><input type='hidden' name='thisDateVal' value='"+item.id+"'>",
                                day: item.cycle,
                                section: item.area,
                                principal: item.staff,
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

                        function format1(d) {
                            return (
                                `<table class="tb-child">
                                <tr class='rwd-show'><td><span class='w-105px'>公司電話：</span>` + d.tel + `</td></tr>
                                <tr class='rwd-show'><td><span class='w-105px'>上次日期：</span>` + d.prev + `</td></tr>
                                <tr class='rwd-show'><td><span class='w-105px'>本次日期：</span>` + d.this + `</td></tr>
                                <tr class='rwd-show'><td><span class='w-105px'>週期天數：</span>` + d.day + `</td></tr>
                                <tr class='rwd-show'><td><span class='w-105px'>區域：</span>` + d.section + `</td></tr>
                                <tr class='rwd-show'><td><span class='w-105px'>負責員工：</span>` + d.principal + `</td></tr>
                                <tr><td><span class='w-105px'>家裡電話：</span>` + d.housetel + `</td></tr>
                                <tr><td><span class='w-105px'>行動電話：</span>` + d.mob + `</td></tr>
                                <tr><td><span class='w-105px'>機器地址：</span>` + d.productprice + `</td></tr>
                                <tr><td><span class='w-105px'>收款地址：</span>` + d.address + `</td></tr>
                                <tr><td><span class='w-105px'>產品代碼：</span>` + d.productid + `</td></tr>
                                <tr><td><span class='w-105px'>產品數量：</span>` + d.productquantity + `</td></tr>
                                <tr><td><span class='w-105px'>產品單價：</span>` + d.productprice + `</td></tr>
                                <tr><td><span class='w-105px'>其他備註：</span>` + d.other + `</td></tr>

                                </table>`
                                );
                        }
                        $(document).ready(function() {
                            var table_s1 = $("#hetao-list-norwd-cycle").DataTable({
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
                                    "info": "<p>共有 "+res[1]+" 張卡片</p>顯示 _START_ 至 _END_ 筆，共有 _TOTAL_ 筆",
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
                                autoWidth: false,
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

                            $('#hetao-list-norwd-cycle tbody').on('blur', '.thisDate', function () {

                                var id = $(this)[0].name;
                                var value = $(this).val();

                                $.ajax({
                                    type:'post',
                                    url:"{{ route('ht.Cycle.self.thisDateChange',['organization'=>$organization]) }}",
                                    data:{
                                        '_token':'{{csrf_token()}}',
                                        'id':id,
                                        'value':value
                                    },
                                    success:function(res){
                                        if(res.status == 200){
                                            alert('本次日期已修改')
                                        }
                                    }
                                })
                            })

                            $("#hetao-list-norwd-cycle tbody").off("click", "td.details-control");
                            $("#hetao-list-norwd-cycle tbody").on("click", "td.details-control", function() {
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

                            //rwd讓欄位消失
                            window.onresize = function() {
                              var w = this.innerWidth;
                              table_s1.column(5).visible( w > 768);
                              table_s1.column(6).visible( w > 768);
                              table_s1.column(7).visible( w > 768);
                              table_s1.column(8).visible( w > 768);
                              table_s1.column(9).visible( w > 768);  
                              table_s1.column(10).visible( w > 768);  
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

            //進度搜尋
            $('#cycleNowSearch').on('submit',function(e){

                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    type:'post',
                    url:"{{ route('ht.Cycle.self.cycleNowSearch',['organization'=>$organization]) }}",
                    data:formData,
                    success:function(res){

                        $('#hetao-list-norwd2').DataTable().destroy();
                        $('#hetao-list-norwd2 tbody').empty();

                        var data2 = new Array();

                        $.each(res, function (i, item) {

                            data2[i] = {
                                first: `
                                <div class="td-icon">
                                <input class="chkall" type="checkbox" value="">
                                </div>
                                `,
                                finishday: item.finishDate,
                                name: item.custkey,
                                staff: item.touch,
                                next: item.nextDate,
                                productid: item.productCode,
                                productquantity: item.productNum,
                                productprice: item.productPrice,
                                housetel: "<a href='tel:"+item.homeTel+"' class='text-nowrap'>"+item.homeTel+"</a>",
                                tel: "<a href='tel:"+item.companyTel+"' class='text-nowrap'>"+item.companyTel+"</a>",
                                principal: item.staff,
                                mob: "<a href='tel:"+item.mobile+"' class='text-nowrap'>"+item.mobile+"</a>",
                                cycle: item.kind,
                                other: item.other,
                                mechine: "<a href='https://www.google.com.tw/maps/place/"+item.machine+"' target='_blank'>"+item.machine+"</a>",
                                day: item.cycle,
                                address: "<a href='https://www.google.com.tw/maps/place/"+item.payAddress+"' target='_blank'>"+item.payAddress+"</a>",
                                section: item.area,
                            }
                        })

                        function format2(d) {
                            return (
                                `<table class="tb-child">
                                <tr><td><span class='w-105px'>家裡電話：</span>` + d.housetel + `</td></tr>
                                <tr><td><span class='w-105px'>行動電話：</span>` + d.mob + `</td></tr>
                                <tr><td><span class='w-105px'>週期天數：</span>` + d.day + `</td></tr>
                                <tr><td><span class='w-105px'>公司電話：</span>` + d.productid + `</td></tr>
                                <tr><td><span class='w-105px'>週期類別：</span>` + d.cycle + `</td></tr>
                                <tr><td><span class='w-105px'>收款地址：</span>` + d.address + `</td></tr>
                                <tr><td><span class='w-105px'>負責員工：</span>` + d.staff + ` </td></tr>
                                <tr><td><span class='w-105px'>機器地址：</span>` + d.mechine + `</td></tr>
                                <tr><td><span class='w-105px'>區域：</span>` + d.section + `</td></tr>
                                <tr><td colspan="3"><span class='w-105px'>其他備註：</span>` + d.other + `</td></tr>
                                </table>`
                                );}
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

                                $("#hetao-list-norwd2 tbody").off("click", "td.details-control");
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
                            })
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

        $('#reset2').on('click',function(){
            $('#code').val("")
            $('#start2').val("")
            $('#end2').val("")
        })
    </script>
@endsection