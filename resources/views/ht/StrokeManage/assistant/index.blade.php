@extends('layout.app')

@section('content')
<div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">行程管理 <span>Management</span></h3>
                    @include('common.message')
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-tasks"></i>行程管理
                                        </div>
                                        <div class="panel-body">
                                            @if($action == 'assignCase')
                                            <div class="tabbable">
                                                <!-- tab標籤 -->
                                                <ul class="nav nav-tabs">
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-01">客戶線上預約</a>
                                                    </li>
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-02">派工單</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-03">行程回報</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-04">與我聯繫</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 客戶線上預約 -->
                                                    <div class="tab-pane" id="viewers-tab-01">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-a">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">姓名</th>
                                                                    <th class="desktop">預約日期</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="watch" onclick="javascript:location.href='{{ route('ht.StrokeManage.assistant.show',['organization'=>$organization]) }}'">
                                                                    <td>愛酷</td>
                                                                    <td>2019-08-06 16:30</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end -->
                                                    <!-- 派工單 -->
                                                    <div class="tab-pane active" id="viewers-tab-02">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-a-2">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">地址</th>
                                                                    <th class="desktop">電話</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th hidden="">統編</th>
                                                                    <th class="desktop">負責主管</th>
                                                                    <th class="desktop"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end -->
                                                    <!-- 行程回報 -->
                                                    <div class="tab-pane" id="viewers-tab-03">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-s-2">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">地址</th>
                                                                    <th class="desktop">電話</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th class="desktop">狀態</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>楊梅國中</td>
                                                                    <td>邱小姐</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>維修</td>
                                                                    <td>
                                                                        <button type="button" class="btn status">轉單</button>
                                                                        <button type="button" class="btn status">延後</button>
                                                                        <button type="button" class="btn status">已完成</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end -->
                                                    <!-- 與我聯繫 -->
                                                    <div class="tab-pane" id="viewers-tab-04">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-ab">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">姓名</th>
                                                                    <th class="desktop">預約日期</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="watch" onclick="javascript:location.href='{{ route('ht.StrokeManage.assistant.show',['organization'=>$organization]) }}'">
                                                                    <td>愛酷</td>
                                                                    <td>2019-08-06 16:30</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end -->
                                                </div>
                                            </div>
                                            @elseif($action == 'report')
                                            <div class="tabbable">
                                                <!-- tab標籤 -->
                                                <ul class="nav nav-tabs">
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-01">客戶線上預約</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-02">派工單</a>
                                                    </li>
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-03">行程回報</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-04">與我聯繫</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 客戶線上預約 -->
                                                    <div class="tab-pane" id="viewers-tab-01">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-a">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">姓名</th>
                                                                    <th class="desktop">預約日期</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="watch" onclick="javascript:location.href='{{ route('ht.StrokeManage.assistant.show',['organization'=>$organization]) }}'">
                                                                    <td>愛酷</td>
                                                                    <td>2019-08-06 16:30</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end -->
                                                    <!-- 派工單 -->
                                                    <div class="tab-pane" id="viewers-tab-02">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-a-2">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">地址</th>
                                                                    <th class="desktop">電話</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th hidden="">統編</th>
                                                                    <th class="desktop">負責主管</th>
                                                                    <th class="desktop"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end -->
                                                    <!-- 行程回報 -->
                                                    <div class="tab-pane active" id="viewers-tab-03">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-s-2">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">地址</th>
                                                                    <th class="desktop">電話</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th class="desktop">狀態</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>楊梅國中</td>
                                                                    <td>邱小姐</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>維修</td>
                                                                    <td>
                                                                        <button type="button" class="btn status">轉單</button>
                                                                        <button type="button" class="btn status">延後</button>
                                                                        <button type="button" class="btn status">已完成</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end -->
                                                    <!-- 與我聯繫 -->
                                                    <div class="tab-pane" id="viewers-tab-04">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-ab">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">姓名</th>
                                                                    <th class="desktop">預約日期</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="watch" onclick="javascript:location.href='{{ route('ht.StrokeManage.assistant.show',['organization'=>$organization]) }}'">
                                                                    <td>愛酷</td>
                                                                    <td>2019-08-06 16:30</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end -->
                                                </div>
                                            </div>
                                            @else
                                            <div class="tabbable">
                                                <!-- tab標籤 -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-01">客戶線上預約</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-02">派工單</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-03">行程回報</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-04">與我聯繫</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 客戶線上預約 -->
                                                    <div class="tab-pane active" id="viewers-tab-01">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-a">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">姓名</th>
                                                                    <th class="desktop">預約日期</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="watch" onclick="javascript:location.href='{{ route('ht.StrokeManage.assistant.show',['organization'=>$organization]) }}'">
                                                                    <td>愛酷</td>
                                                                    <td>2019-08-06 16:30</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end -->
                                                    <!-- 派工單 -->
                                                    <div class="tab-pane" id="viewers-tab-02">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-a-2">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">地址</th>
                                                                    <th class="desktop">電話</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th hidden="">統編</th>
                                                                    <th class="desktop">負責主管</th>
                                                                    <th class="desktop"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end -->
                                                    <!-- 行程回報 -->
                                                    <div class="tab-pane" id="viewers-tab-03">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-s-2">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">地址</th>
                                                                    <th class="desktop">電話</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th class="desktop">狀態</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>楊梅國中</td>
                                                                    <td>邱小姐</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>維修</td>
                                                                    <td>
                                                                        <button type="button" class="btn status">轉單</button>
                                                                        <button type="button" class="btn status">延後</button>
                                                                        <button type="button" class="btn status">已完成</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end -->
                                                    <!-- 與我聯繫 -->
                                                    <div class="tab-pane" id="viewers-tab-04">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-ab">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">姓名</th>
                                                                    <th class="desktop">預約日期</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="watch" onclick="javascript:location.href='{{ route('ht.StrokeManage.assistant.show',['organization'=>$organization]) }}'">
                                                                    <td>愛酷</td>
                                                                    <td>2019-08-06 16:30</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end -->
                                                </div>
                                            </div>
                                            @endif
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

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $.ajax({
            method:'get',
            url:'{{ route('ht.StrokeManage.assistant.getData',['organization'=>$organization]) }}',
            data:{
                "token": "A20191002",
                "DEPT": "H026"
            },
            dataType:'json',
            success:function(response){

                var rows;
                $('#hetao-list-a-2').DataTable().destroy();

                $.each(response.data, function (i, item) {
                    var tt =  'GUI-number'
                    var itemtt = item['GUI-number']

                    rows += "<tr>"
                              + "<td>" + item.id + "</td>"
                              + "<td>" + item.time + "</td>"
                              + "<td>" + item.CUSTKEY + "</td>"
                              + "<td>" + item.owner + "</td>"
                              + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' onclick='window.open(this.href); return false;' >" + item.address + "</a></td>"
                              + "<td><a href='tel:"+item.mobile+"'>" + item.mobile + "</a></td>"
                              + "<td>" + item.remarks + "</td>"
                              + "<td>" + item.work_type + "</td>"
                              + `<td hidden> ${itemtt}</td>`
                              + "<td><select class='form-control' name='assign'><option selected value=''>待指派</option></select></td>"
                              + "<td><a target='_blank' href='{{ route('ht.StrokeManage.assistant.edit',['organization'=>$organization]) }}'><button type='button' class='btn btn-primary' style='margin-right: 28px;''>處理</button></a><input id='chk' class='chkall hide' type='checkbox' value='' /></td>"
                         + "</tr>";
                });
                $('#hetao-list-a-2 tbody').append(rows);
                $("#hetao-list-a-2").DataTable({
                    "bPaginate": true,
                    "searching": true,
                    "info": false,
                    "bLengthChange": false,
                    "bServerSide": false,
                    "language": {
                        "search": "",
                        "searchPlaceholder": "請輸入關鍵字",
                        "paginate": { "previous": "上一頁", "next": "下一頁" },
                    },
                    "dom": "Bfrtip",
                    "buttons": [{
                        "extend": "colvis",
                        "collectionLayout": "fixed two-column"
                    }],
                    "order": [],
                    "columnDefs": [{
                        "targets": [9],
                        "orderable": false,
                    }],
                    "responsive": {
                        "breakpoints": [
                        { name: 'desktop', width: Infinity},
                        { name: 'tablet',  width: 1300},
                        ],
                        "details": {
                            "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                            "type": 'none',
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
                            "target": ''
                        }
                    },
                });
                $('#hetao-list-a-2_filter').append(
                    "<div class='coupon'>" +
                    "<form class='form-inline'>" +
                    "<div class='form-group'>" +
                    "<div class='datetime'>" +
                    "<div class='input-group date date-select'>" +
                    "<input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div></div><span class='rwd-hide'>~</span><div class='datetime'>" +
                    "<div class='input-group date date-select mr-s'>" +
                    "<input class='form-control' placeholder='選擇結束日期' type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "<div class='btn-wrap'>" +
                    "<button class='mr-s' href=''>確認送出</button>" +
                    "<button class='mr-s' href=''>重新設定時間</button>" +
                    "<a href='{{ route('ht.StrokeManage.assistant.create',['organization'=>$organization]) }}'><button type='button' class='mr-s btn-bright' type='button'>新增派工單</button></a>" +
                    "<div class='batchwrap'><div class='form-group mr-s hide batch-select'><select class='form-control' id='sel1'><option selected hidden disabled>請指派負責主管</option><option>Ricky</option><option>Eva</option><option>Apple</option><option>Banana</option></select></div>" +
                    "<button type='button' class='btn-bright hide batch-finish'>完成</button><label for='chkall' class='sall'>全選</label><input id='chkall' type='checkbox' value='' />" +
                    "<button type='button' class='btn-bright batch' href=''>批次指派</button></div>" +
                    "</div>" +
                    "</form>" +
                    "</div>"
                    );
                $('.sall').addClass('hide');
                $('.batch').on('click', function() {
                    $('.batch-select').removeClass('hide');
                    $('.batch-finish').removeClass('hide');
                    $('.chkall').removeClass('hide');
                    $('.batch').addClass('hide');
                    $('.sall').removeClass('hide');
                });
                $('.batch-finish').on('click', function() {
                    $('.batch-select').addClass('hide');
                    $('.batch-finish').addClass('hide');
                    $('.chkall').addClass('hide');
                    $('.batch').removeClass('hide');
                    $('.sall').addClass('hide');
                });
                $('.nav-tabs li').on('click', function() {
                    $("#hetao-list").DataTable();
                    $("#hetao-list-2").DataTable();
                });

                $('input#chkall').change(function() {
                    if($(this).is(':checked')){
                        $('.sall').text('取消全選');
                        $('input.chkall').prop('checked',true);
                    } else {
                        $('input.chkall').prop('checked',false);
                        $('.sall').text('全選');
                    }
                });

                $.ajax({
                    url:"{{ route('ht.StrokeManage.assistant.getSupervisor',['organization'=>$organization]) }}", 
                    method:"get",
                    dataType:'json',                 
                    success:function(res){
                        var selOpts = "<option value='' selected disabled='true'>待指派</option>";
                        $.each(res, function (i, item) {
                            selOpts += "<option value='"+item.token+"'>"+item.name+"</option>";
                        })

                        $("select[name='assign']").empty();
                        $("select[name='assign']").append(selOpts);
                    }
                })

                $("select[name='assign']").on('change',function(){

                     var token = $("select[name='assign']").val()
                     var id = $(this).parents('tr').children('td')[0].textContent 
                     var time = $(this).parents('tr').children('td')[1].textContent 
                     var CUSTKEY = $(this).parents('tr').children('td')[2].textContent 
                     var address = $(this).parents('tr').children('td')[4].textContent 
                     var mobile = $(this).parents('tr').children('td')[5].textContent 
                     var work_type = $(this).parents('tr').children('td')[7].textContent 
                     var GUI_number = $(this).parents('tr').children('td')[8].textContent 

                     $.ajax({
                        url:"{{ route('ht.StrokeManage.assistant.assignCaseBoss',['organization'=>$organization]) }}", 
                        method:"post",
                        data:{
                            '_token':'{{csrf_token()}}',
                            'id':id,
                            'name': CUSTKEY,
                            'mobile': mobile,
                            'GUI_number': GUI_number,
                            'address': address,
                            'work_type': work_type,
                            'time': time,
                            'owner_boss': token,
                        },
                        dataType:'json',                 
                        success:function(res){

                        }
                    })

                 })
            }
        })
})
</script>
<script type="text/javascript">
    //表單Datable
    $('#hetao-list-a_filter').append(
        "<div class='coupon'>" +
        "<form class='form-inline'>" +
        "<div class='form-group'>" +
        "<div class='datetime'>" +
        "<div class='input-group date date-select'>" +
        "<input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div></div><span class='rwd-hide'>~</span><div class='datetime'>" +
        "<div class='input-group date date-select mr-s'>" +
        "<input class='form-control' placeholder='選擇結束日期' type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "<div class='btn-wrap'>" +
        "<button class='mr-s' href=''>確認送出</button>" +
        "<button class='mr-s' href=''>重新設定時間</button>" +
        "<a href='{{ route('ht.StrokeManage.assistant.create',['organization'=>$organization]) }}'><button class='btn-bright' type='button'>新增派工單</button></a>" +
        "</div>" +
        "</form>" +
        "</div>"
        );

    $('#hetao-list-ab_filter').append(
        "<div class='coupon'>" +
        "<form class='form-inline'>" +
        "<div class='form-group'>" +
        "<div class='datetime'>" +
        "<div class='input-group date date-select'>" +
        "<input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div></div><span class='rwd-hide'>~</span><div class='datetime'>" +
        "<div class='input-group date date-select mr-s'>" +
        "<input class='form-control' placeholder='選擇結束日期' type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "<div class='btn-wrap'>" +
        "<button class='mr-s' href=''>確認送出</button>" +
        "<button class='mr-s' href=''>重新設定時間</button>" +
        "<a href='{{ route('ht.StrokeManage.assistant.create',['organization'=>$organization]) }}'><button class='btn-bright' type='button'>新增派工單</button></a>" +
        "</div>" +
        "</form>" +
        "</div>"
        );
</script>

@endsection