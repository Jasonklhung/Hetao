@extends('layout.app')

@section('content')
<div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">行程管理 <span>Management</span></h3>
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
                                            <div class="tabbable">
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-01">行程回報</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-02">已完成</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="viewers-tab-01">
                                                        <div class='coupon'>
                                                            <form class="form-inline">
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select' id="SD1">
                                                                            <input class='form-control' readonly="" placeholder='選擇起始日期' id="startDate1" type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s' id="ED1">
                                                                            <input class='form-control' readonly="" placeholder='選擇結束日期' id="endDate1" type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' id="searchDate1" type="button">確認送出</button>
                                                                    <button class='mr-s'>重新設定時間</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <table class="table table-hover dt-responsive table-striped staff" id="hetao-list-s-2">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">工單狀態</th>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">聯絡電話</th>
                                                                    <th class="desktop">聯絡地址</th>
                                                                    <th class="desktop">統一編號</th>
                                                                    <th class="desktop">負責員工</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th hidden="">status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="tab-pane" id="viewers-tab-02">
                                                        <div class='coupon'>
                                                            <form class="form-inline">
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s3" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select' id="SD2">
                                                                            <input class='form-control' readonly="" placeholder='選擇起始日期' id="startDate2" type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s' id="ED2">
                                                                            <input class='form-control' readonly="" placeholder='選擇結束日期' id="endDate2" type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' id="searchDate2" type="button">確認送出</button>
                                                                    <button class='mr-s'>重新設定時間</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <table class="table table-hover dt-responsive table-striped staff" id="hetao-list-s-3">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">聯絡電話</th>
                                                                    <th class="desktop">聯絡地址</th>
                                                                    <th class="desktop">統一編號</th>
                                                                    <th class="desktop">負責員工</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th hidden="">status</th>
                                                                    <th class="desktop">工單狀態</th>
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

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
    //行程回報
        $.ajax({
            method:'get',
            url:'{{ route('ht.StrokeManage.staff.getData',['organization'=>$organization]) }}',
            data:{
                "token": '{{Auth::user()->token}}',
                "DEPT": '{{Auth::user()->department->name}}'
            },
            dataType:'json',
            success:function(response){

                var rows;
                $('#hetao-list-s-2').DataTable().destroy();

                $.each(response.data, function (i, item) {
                    var tt =  'GUI-number'
                    var itemtt = item['GUI-number']

                    if(item.status == '' || item.status == null){

                        rows += "<tr>"
                              + "<td><button type='button' class='btn status transfer'>轉單</button><button type='button' class='btn status late'>延後</button><button type='button' class='btn status finish'>完成</button></td>"
                              + "<td>" + item.id + "</td>"
                              + "<td>" + item.time + "</td>"
                              + "<td>" + item.CUSTKEY + "</td>"
                              if(item.name == null || item.name == '' || item.name == 'null'){
                                rows += "<td></td>"
                            }
                            else{
                                rows += "<td>" + item.name + "</td>"
                            }
                            rows += "<td><a href='tel:"+ item.mobile +"'>"+ item.mobile +"</a></td>"
                            + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' onclick='window.open(this.href); return false;' >" + item.address + "</a></td>"
                            if(itemtt == null || itemtt == '' || itemtt == 'null'){
                                rows += "<td></td>"
                            }
                            else{
                                rows += `<td> ${itemtt}</td>`
                            }
                            rows += "<td>" + item.owner + "</td>"
                            + "<td>" + item.remarks + "</td>"
                              if(item.work_type == '維修'){
                                rows += "<td><span class='color-btn' style='background-color: #e64242'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '洽機'){
                                rows += "<td><span class='color-btn' style='background-color: #f59d56'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '收款'){
                                rows += "<td><span class='color-btn' style='background-color: #ffe167'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '送水'){
                                rows += "<td><span class='color-btn' style='background-color: #91d35c'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '裝機'){
                                rows += "<td><span class='color-btn' style='background-color: #1bab9f'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '拆機'){
                                rows += "<td><span class='color-btn' style='background-color: #00c0ff'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '回機'){
                                rows += "<td><span class='color-btn' style='background-color: #41438f'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '保養'){
                                rows += "<td><span class='color-btn' style='background-color: #a080c3'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '合約'){
                                rows += "<td><span class='color-btn' style='background-color: #f73e99'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '其他'){
                                rows += "<td><span class='color-btn' style='background-color: #a1602c'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '送貨'){
                                rows += "<td><span class='color-btn' style='background-color: #3f3f3f'>" + item.work_type + "</span></td>"
                            }
                              rows += "<td hidden></td>"
                         + "</tr>";
                    }
                    else if(item.status == 'F'){
                        rows += "<tr>"
                              + "<td><button type='button' class='btn status transfer'>轉單</button><button type='button' class='btn status btn-primary late'>延後</button><button type='button' class='btn status finish'>完成</button></td>"
                              + "<td>" + item.id + "</td>"
                              + "<td>" + item.time + "</td>"
                              + "<td>" + item.CUSTKEY + "</td>"
                              if(item.name == null || item.name == '' || item.name == 'null'){
                                rows += "<td></td>"
                            }
                            else{
                                rows += "<td>" + item.name + "</td>"
                            }
                            rows += "<td><a href='tel:"+ item.mobile +"'>"+ item.mobile +"</a></td>"
                            + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' onclick='window.open(this.href); return false;' >" + item.address + "</a></td>"
                            if(itemtt == null || itemtt == '' || itemtt == 'null'){
                                rows += "<td></td>"
                            }
                            else{
                                rows += `<td> ${itemtt}</td>`
                            }
                            rows += "<td>" + item.owner + "</td>"
                            + "<td>" + item.remarks + "</td>"
                              if(item.work_type == '維修'){
                                rows += "<td><span class='color-btn' style='background-color: #e64242'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '洽機'){
                                rows += "<td><span class='color-btn' style='background-color: #f59d56'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '收款'){
                                rows += "<td><span class='color-btn' style='background-color: #ffe167'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '送水'){
                                rows += "<td><span class='color-btn' style='background-color: #91d35c'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '裝機'){
                                rows += "<td><span class='color-btn' style='background-color: #1bab9f'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '拆機'){
                                rows += "<td><span class='color-btn' style='background-color: #00c0ff'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '回機'){
                                rows += "<td><span class='color-btn' style='background-color: #41438f'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '保養'){
                                rows += "<td><span class='color-btn' style='background-color: #a080c3'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '合約'){
                                rows += "<td><span class='color-btn' style='background-color: #f73e99'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '其他'){
                                rows += "<td><span class='color-btn' style='background-color: #a1602c'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '送貨'){
                                rows += "<td><span class='color-btn' style='background-color: #3f3f3f'>" + item.work_type + "</span></td>"
                            }
                              rows += "<td hidden>" + item.status + "</td>"
                         + "</tr>";
                    }
                    
                });
                $('#hetao-list-s-2 tbody').append(rows);
                var table_s2 = $("#hetao-list-s-2").DataTable({
                    "bPaginate": true,
                    "searching": true,
                    "info": false,
                    "bLengthChange": false,
                    "bServerSide": false,
                    "language": {
                        "search": "",
                        "searchPlaceholder": "請輸入關鍵字",
                        "paginate": { "previous": "上一頁", "next": "下一頁" },
                        "emptyTable":     "目前無工單",
                        "zeroRecords":    "沒有符合的搜尋結果",
                    },
                    "dom": "Bfrtip",
                    "buttons": [{
                        "extend": "colvis",
                        "collectionLayout": "fixed two-column"
                    }],
                    "order": [[ 2, "desc" ], [ 11, "asc" ]],
                    "columnDefs": [{
                        "targets": [],
                        "orderable": false,
                    },{ 
                        "width": "80px", 
                        "targets": 8 }
                        ],
                        "responsive": {
                            "breakpoints": [
                            { name: 'desktop', width: Infinity},
                            { name: 'tablet',  width: 1024},
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

                $('#hetao-list-s-2').on('click',".finish",function(){

                    var RWD = $(this).parents('table').parents('tr').find('.child').length;

                    if(RWD == 0){
                        var id = $(this).parents('tr').children('td')[1].textContent 
                    }
                    else if(RWD == 1){
                        var id = $(this).closest('tbody').find("tr:eq(1)").children("td")[1].textContent;
                    }

                    $.ajax({
                        method:'post',
                        url:'{{ route('ht.StrokeManage.staff.updateStatus',['organization'=>$organization]) }}',
                        data:{
                            '_token':'{{csrf_token()}}',
                            "token": '{{Auth::user()->token}}',//'{{Auth::user()->token}}'
                            "id":id,
                            "status":'T',
                            "DEPT": '{{Auth::user()->department->name}}' //'{{Auth::user()->department->name}}'
                        },
                        dataType:'json',
                        success:function(response){
                            if(response.status == 200){
                                alert(response.message);
                            }
                            else{
                                alert('狀態更新失敗')
                            }
                        }
                    })
                })

                $("#hetao-list-s-2").on("click", ".late", function(){

                    var RWD = $(this).parents('table').parents('tr').find('.child').length;

                    if(RWD == 0){
                        var id = $(this).parents('tr').children('td')[1].textContent 
                    }
                    else if(RWD == 1){
                        var id = $(this).closest('tbody').find("tr:eq(1)").children("td")[1].textContent;
                    }

                    $.ajax({
                        method:'post',
                        url:'{{ route('ht.StrokeManage.staff.updateStatus',['organization'=>$organization]) }}',
                        data:{
                            '_token':'{{csrf_token()}}',
                            "token": '{{Auth::user()->token}}',//'{{Auth::user()->token}}'
                            "id":id,
                            "status":'F',
                            "DEPT": '{{Auth::user()->department->name}}' //'{{Auth::user()->department_id}}'
                        },
                        dataType:'json',
                        success:function(response){
                            if(response.status == 200){
                                alert(response.message);
                            }
                            else{
                                alert('狀態更新失敗')
                            }
                        }
                    })
                })

                $("#hetao-list-s-2").on("click", ".transfer", function(){

                    var RWD = $(this).parents('table').parents('tr').find('.child').length;

                    if(RWD == 0){
                        var id = $(this).parents('tr').children('td')[1].textContent 
                    }
                    else if(RWD == 1){
                        var id = $(this).closest('tbody').find("tr:eq(1)").children("td")[1].textContent;
                    }
                    // var time = $(this).parents('tr').children('td')[1].textContent 
                    // var CUSTKEY = $(this).parents('tr').children('td')[2].textContent 
                    // var address = $(this).parents('tr').children('td')[4].textContent 
                    // var mobile = $(this).parents('tr').children('td')[5].textContent 
                    // var work_type = $(this).parents('tr').children('td')[7].textContent 
                    // var GUI_number = $(this).parents('tr').children('td')[8].textContent 

                    $.ajax({
                        url:"{{ route('ht.StrokeManage.staff.updateStatus',['organization'=>$organization]) }}", 
                        method:"post",
                        data:{
                            '_token':'{{csrf_token()}}',
                            "token": '{{Auth::user()->token}}',//'{{Auth::user()->token}}'
                            "id":id,
                            "status":'R',
                            "DEPT": '{{Auth::user()->department->name}}' //'{{Auth::user()->department_id}}'
                        },
                        dataType:'json',
                        success:function(response){
                            if(response.status == 200){
                                alert('轉單成功');
                            }
                            else{
                                alert('轉單失敗')
                            }
                        }
                    })
                })
            }
        })
    //已完成
        $.ajax({
            method:'get',
            url:'{{ route('ht.StrokeManage.staff.getData',['organization'=>$organization]) }}',
            data:{
                "token": '{{Auth::user()->token}}',
                "DEPT": '{{Auth::user()->department->name}}'
            },
            dataType:'json',
            success:function(response){

                var rows;
                $('#hetao-list-s-3').DataTable().destroy();

                $.each(response.data, function (i, item) {
                    var tt =  'GUI-number'
                    var itemtt = item['GUI-number']

                    if(item.status == 'T'){
                       rows += "<tr class='past'>"
                              + "<td>" + item.id + "</td>"
                              + "<td>" + item.time + "</td>"
                              + "<td>" + item.CUSTKEY + "</td>"
                              if(item.name == null || item.name == '' || item.name == 'null'){
                                rows += "<td></td>"
                            }
                            else{
                                rows += "<td>" + item.name + "</td>"
                            }
                            rows += "<td><a href='tel:"+ item.mobile +"'>"+ item.mobile +"</a></td>"
                            + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' onclick='window.open(this.href); return false;' >" + item.address + "</a></td>"
                            if(itemtt == null || itemtt == '' || itemtt == 'null'){
                                rows += "<td></td>"
                            }
                            else{
                                rows += `<td> ${itemtt}</td>`
                            }
                            rows += "<td>" + item.owner + "</td>"
                            + "<td>" + item.remarks + "</td>"
                              if(item.work_type == '維修'){
                                rows += "<td><span class='color-btn' style='background-color: #e64242'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '洽機'){
                                rows += "<td><span class='color-btn' style='background-color: #f59d56'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '收款'){
                                rows += "<td><span class='color-btn' style='background-color: #ffe167'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '送水'){
                                rows += "<td><span class='color-btn' style='background-color: #91d35c'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '裝機'){
                                rows += "<td><span class='color-btn' style='background-color: #1bab9f'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '拆機'){
                                rows += "<td><span class='color-btn' style='background-color: #00c0ff'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '回機'){
                                rows += "<td><span class='color-btn' style='background-color: #41438f'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '保養'){
                                rows += "<td><span class='color-btn' style='background-color: #a080c3'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '合約'){
                                rows += "<td><span class='color-btn' style='background-color: #f73e99'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '其他'){
                                rows += "<td><span class='color-btn' style='background-color: #a1602c'>" + item.work_type + "</span></td>"
                            }
                            else if(item.work_type == '送貨'){
                                rows += "<td><span class='color-btn' style='background-color: #3f3f3f'>" + item.work_type + "</span></td>"
                            }
                              rows += "<td hidden>" + item.status + "</td>"
                              + "<td>已完成</td>"
                         + "</tr>";
                    }
                    
                });
                $('#hetao-list-s-3 tbody').append(rows);
                var table_s3 = $("#hetao-list-s-3").DataTable({
                    "bPaginate": true,
                    "searching": true,
                    "info": false,
                    "bLengthChange": false,
                    "bServerSide": false,
                    "language": {
                        "search": "",
                        "searchPlaceholder": "請輸入關鍵字",
                        "paginate": { "previous": "上一頁", "next": "下一頁" },
                        "emptyTable":     "目前無工單",
                        "zeroRecords":    "沒有符合的搜尋結果",
                    },
                    "dom": "Bfrtip",
                    "buttons": [{
                        "extend": "colvis",
                        "collectionLayout": "fixed two-column"
                    }],
                    "order": [[ 1, "desc" ], [ 10, "asc" ]],
                    "columnDefs": [{
                        "targets": [],
                        "orderable": false,
                    },{ 
                        "width": "80px", 
                        "targets": 8 }
                        ],
                        "responsive": {
                            "breakpoints": [
                            { name: 'desktop', width: Infinity},
                            { name: 'tablet',  width: 1024},
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
            }
        })
    })
</script>
<script type="text/javascript">
    $('#searchDate1').on('click',function(){

        var start = $('#startDate1').val()
        var end = $('#endDate1').val()

        $.ajax({
            method:'get',
            url:'{{ route('ht.StrokeManage.staff.getData',['organization'=>$organization]) }}',
            data:{
                "token": '{{Auth::user()->token}}',
                "DEPT": '{{Auth::user()->department->name}}'
            },
            dataType:'json',
            success:function(response){

                var rows;

                var Newstart = Date.parse(new Date(start.replace(/-/g, '/')));
                var Newend = Date.parse(new Date(end.replace(/-/g, '/')));

                $('#hetao-list-s-2').DataTable().destroy();
                $('#hetao-list-s-2 tbody').empty();

                $.each(response.data, function (i, item) {
                    var tt =  'GUI-number'
                    var itemtt = item['GUI-number']

                    if(Newend >= Date.parse(new Date(item.time.replace(/-/g, '/'))) && Newstart <= Date.parse(new Date(item.time.replace(/-/g, '/')))){
                        if(item.status == '' || item.status == null){

                            rows += "<tr>"
                                  + "<td><button type='button' class='btn status transfer'>轉單</button><button type='button' class='btn status late'>延後</button><button type='button' class='btn status finish'>完成</button></td>"
                                  + "<td>" + item.id + "</td>"
                                  + "<td>" + item.time + "</td>"
                                  + "<td>" + item.CUSTKEY + "</td>"
                                  if(item.name == null || item.name == '' || item.name == 'null'){
                                    rows += "<td></td>"
                                }
                                else{
                                    rows += "<td>" + item.name + "</td>"
                                }
                                rows += "<td><a href='tel:"+ item.mobile +"'>"+ item.mobile +"</a></td>"
                                + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' onclick='window.open(this.href); return false;' >" + item.address + "</a></td>"
                                if(itemtt == null || itemtt == '' || itemtt == 'null'){
                                    rows += "<td></td>"
                                }
                                else{
                                    rows += `<td> ${itemtt}</td>`
                                }
                                rows += "<td>" + item.owner + "</td>"
                                + "<td>" + item.remarks + "</td>"
                                  if(item.work_type == '維修'){
                                    rows += "<td><span class='color-btn' style='background-color: #e64242'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '洽機'){
                                    rows += "<td><span class='color-btn' style='background-color: #f59d56'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '收款'){
                                    rows += "<td><span class='color-btn' style='background-color: #ffe167'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '送水'){
                                    rows += "<td><span class='color-btn' style='background-color: #91d35c'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '裝機'){
                                    rows += "<td><span class='color-btn' style='background-color: #1bab9f'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '拆機'){
                                    rows += "<td><span class='color-btn' style='background-color: #00c0ff'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '回機'){
                                    rows += "<td><span class='color-btn' style='background-color: #41438f'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '保養'){
                                    rows += "<td><span class='color-btn' style='background-color: #a080c3'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '合約'){
                                    rows += "<td><span class='color-btn' style='background-color: #f73e99'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '其他'){
                                    rows += "<td><span class='color-btn' style='background-color: #a1602c'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '送貨'){
                                    rows += "<td><span class='color-btn' style='background-color: #3f3f3f'>" + item.work_type + "</span></td>"
                                }
                                  rows += "<td hidden></td>"
                             + "</tr>";
                        }
                        else if(item.status == 'F'){
                            rows += "<tr>"
                                  + "<td><button type='button' class='btn status transfer'>轉單</button><button type='button' class='btn status btn-primary late'>延後</button><button type='button' class='btn status finish'>完成</button></td>"
                                  + "<td>" + item.id + "</td>"
                                  + "<td>" + item.time + "</td>"
                                  + "<td>" + item.CUSTKEY + "</td>"
                                  if(item.name == null || item.name == '' || item.name == 'null'){
                                    rows += "<td></td>"
                                }
                                else{
                                    rows += "<td>" + item.name + "</td>"
                                }
                                rows += "<td><a href='tel:"+ item.mobile +"'>"+ item.mobile +"</a></td>"
                                + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' onclick='window.open(this.href); return false;' >" + item.address + "</a></td>"
                                if(itemtt == null || itemtt == '' || itemtt == 'null'){
                                    rows += "<td></td>"
                                }
                                else{
                                    rows += `<td> ${itemtt}</td>`
                                }
                                rows += "<td>" + item.owner + "</td>"
                                + "<td>" + item.remarks + "</td>"
                                  if(item.work_type == '維修'){
                                    rows += "<td><span class='color-btn' style='background-color: #e64242'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '洽機'){
                                    rows += "<td><span class='color-btn' style='background-color: #f59d56'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '收款'){
                                    rows += "<td><span class='color-btn' style='background-color: #ffe167'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '送水'){
                                    rows += "<td><span class='color-btn' style='background-color: #91d35c'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '裝機'){
                                    rows += "<td><span class='color-btn' style='background-color: #1bab9f'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '拆機'){
                                    rows += "<td><span class='color-btn' style='background-color: #00c0ff'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '回機'){
                                    rows += "<td><span class='color-btn' style='background-color: #41438f'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '保養'){
                                    rows += "<td><span class='color-btn' style='background-color: #a080c3'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '合約'){
                                    rows += "<td><span class='color-btn' style='background-color: #f73e99'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '其他'){
                                    rows += "<td><span class='color-btn' style='background-color: #a1602c'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '送貨'){
                                    rows += "<td><span class='color-btn' style='background-color: #3f3f3f'>" + item.work_type + "</span></td>"
                                }
                                  rows += "<td hidden>" + item.status + "</td>"
                             + "</tr>";
                        }
                    }
                });
                $('#hetao-list-s-2 tbody').append(rows);
                var table_s2 = $("#hetao-list-s-2").DataTable({
                    "bPaginate": true,
                    "searching": true,
                    "info": false,
                    "bLengthChange": false,
                    "bServerSide": false,
                    "language": {
                        "search": "",
                        "searchPlaceholder": "請輸入關鍵字",
                        "paginate": { "previous": "上一頁", "next": "下一頁" },
                        "emptyTable":     "目前無工單",
                        "zeroRecords":    "沒有符合的搜尋結果",
                    },
                    "dom": "Bfrtip",
                    "buttons": [{
                        "extend": "colvis",
                        "collectionLayout": "fixed two-column"
                    }],
                    "order": [[ 2, "desc" ], [ 11, "asc" ]],
                    "columnDefs": [{
                        "targets": [],
                        "orderable": false,
                    },{ 
                        "width": "80px", 
                        "targets": 8 }
                        ],
                        "responsive": {
                            "breakpoints": [
                            { name: 'desktop', width: Infinity},
                            { name: 'tablet',  width: 1024},
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

                $('#hetao-list-s-2').on('click',".finish",function(){

                    var RWD = $(this).parents('table').parents('tr').find('.child').length;

                    if(RWD == 0){
                        var id = $(this).parents('tr').children('td')[1].textContent 
                    }
                    else if(RWD == 1){
                        var id = $(this).closest('tbody').find("tr:eq(1)").children("td")[1].textContent;
                    }

                    $.ajax({
                        method:'post',
                        url:'{{ route('ht.StrokeManage.staff.updateStatus',['organization'=>$organization]) }}',
                        data:{
                            '_token':'{{csrf_token()}}',
                            "token": '{{Auth::user()->token}}',//'{{Auth::user()->token}}'
                            "id":id,
                            "status":'T',
                            "DEPT": '{{Auth::user()->department->name}}' //'{{Auth::user()->department->name}}'
                        },
                        dataType:'json',
                        success:function(response){
                            if(response.status == 200){
                                alert(response.message);
                            }
                            else{
                                alert('狀態更新失敗')
                            }
                        }
                    })
                })

                $("#hetao-list-s-2").on("click", ".late", function(){
                    
                    var RWD = $(this).parents('table').parents('tr').find('.child').length;

                    if(RWD == 0){
                        var id = $(this).parents('tr').children('td')[1].textContent 
                    }
                    else if(RWD == 1){
                        var id = $(this).closest('tbody').find("tr:eq(1)").children("td")[1].textContent;
                    }

                    $.ajax({
                        method:'post',
                        url:'{{ route('ht.StrokeManage.staff.updateStatus',['organization'=>$organization]) }}',
                        data:{
                            '_token':'{{csrf_token()}}',
                            "token": '{{Auth::user()->token}}',//'{{Auth::user()->token}}'
                            "id":id,
                            "status":'F',
                            "DEPT": '{{Auth::user()->department->name}}' //'{{Auth::user()->department_id}}'
                        },
                        dataType:'json',
                        success:function(response){
                            if(response.status == 200){
                                alert(response.message);
                            }
                            else{
                                alert('狀態更新失敗')
                            }
                        }
                    })
                })

                $("#hetao-list-s-2").on("click", ".transfer", function(){

                    var RWD = $(this).parents('table').parents('tr').find('.child').length;

                    if(RWD == 0){
                        var id = $(this).parents('tr').children('td')[1].textContent 
                    }
                    else if(RWD == 1){
                        var id = $(this).closest('tbody').find("tr:eq(1)").children("td")[1].textContent;
                    }
                    // var time = $(this).parents('tr').children('td')[1].textContent 
                    // var CUSTKEY = $(this).parents('tr').children('td')[2].textContent 
                    // var address = $(this).parents('tr').children('td')[4].textContent 
                    // var mobile = $(this).parents('tr').children('td')[5].textContent 
                    // var work_type = $(this).parents('tr').children('td')[7].textContent 
                    // var GUI_number = $(this).parents('tr').children('td')[8].textContent 

                    $.ajax({
                        url:"{{ route('ht.StrokeManage.staff.updateStatus',['organization'=>$organization]) }}", 
                        method:"post",
                        data:{
                            '_token':'{{csrf_token()}}',
                            "token": '{{Auth::user()->token}}',//'{{Auth::user()->token}}'
                            "id":id,
                            "status":'R',
                            "DEPT": '{{Auth::user()->department->name}}' //'{{Auth::user()->department_id}}'
                        },
                        dataType:'json',
                        success:function(response){
                            if(response.status == 200){
                                alert('轉單成功');
                            }
                            else{
                                alert('轉單失敗')
                            }
                        }
                    })
                })
            }
        })
    })

    $('#searchDate2').on('click',function(){

        var start = $('#startDate2').val()
        var end = $('#endDate2').val()

        $.ajax({
            method:'get',
            url:'{{ route('ht.StrokeManage.staff.getData',['organization'=>$organization]) }}',
            data:{
                "token": '{{Auth::user()->token}}',
                "DEPT": '{{Auth::user()->department->name}}'
            },
            dataType:'json',
            success:function(response){

                var rows;

                var Newstart = Date.parse(new Date(start.replace(/-/g, '/')));
                var Newend = Date.parse(new Date(end.replace(/-/g, '/')));

                $('#hetao-list-s-3').DataTable().destroy();
                $('#hetao-list-s-3 tbody').empty();

                $.each(response.data, function (i, item) {
                    var tt =  'GUI-number'
                    var itemtt = item['GUI-number']

                    if(Newend >= Date.parse(new Date(item.time.replace(/-/g, '/'))) && Newstart <= Date.parse(new Date(item.time.replace(/-/g, '/')))){

                        if(item.status == 'T'){
                           rows += "<tr class='past'>"
                                  + "<td>" + item.id + "</td>"
                                  + "<td>" + item.time + "</td>"
                                  + "<td>" + item.CUSTKEY + "</td>"
                                  if(item.name == null || item.name == '' || item.name == 'null'){
                                    rows += "<td></td>"
                                }
                                else{
                                    rows += "<td>" + item.name + "</td>"
                                }
                                rows += "<td><a href='tel:"+ item.mobile +"'>"+ item.mobile +"</a></td>"
                                + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' onclick='window.open(this.href); return false;' >" + item.address + "</a></td>"
                                if(itemtt == null || itemtt == '' || itemtt == 'null'){
                                    rows += "<td></td>"
                                }
                                else{
                                    rows += `<td> ${itemtt}</td>`
                                }
                                rows += "<td>" + item.owner + "</td>"
                                + "<td>" + item.remarks + "</td>"
                                  if(item.work_type == '維修'){
                                    rows += "<td><span class='color-btn' style='background-color: #e64242'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '洽機'){
                                    rows += "<td><span class='color-btn' style='background-color: #f59d56'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '收款'){
                                    rows += "<td><span class='color-btn' style='background-color: #ffe167'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '送水'){
                                    rows += "<td><span class='color-btn' style='background-color: #91d35c'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '裝機'){
                                    rows += "<td><span class='color-btn' style='background-color: #1bab9f'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '拆機'){
                                    rows += "<td><span class='color-btn' style='background-color: #00c0ff'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '回機'){
                                    rows += "<td><span class='color-btn' style='background-color: #41438f'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '保養'){
                                    rows += "<td><span class='color-btn' style='background-color: #a080c3'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '合約'){
                                    rows += "<td><span class='color-btn' style='background-color: #f73e99'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '其他'){
                                    rows += "<td><span class='color-btn' style='background-color: #a1602c'>" + item.work_type + "</span></td>"
                                }
                                else if(item.work_type == '送貨'){
                                    rows += "<td><span class='color-btn' style='background-color: #3f3f3f'>" + item.work_type + "</span></td>"
                                }
                                  rows += "<td hidden>" + item.status + "</td>"
                                  + "<td>已完成</td>"
                             + "</tr>";
                        }
                    }
                });
                $('#hetao-list-s-3 tbody').append(rows);
                var table_s3 = $("#hetao-list-s-3").DataTable({
                    "bPaginate": true,
                    "searching": true,
                    "info": false,
                    "bLengthChange": false,
                    "bServerSide": false,
                    "language": {
                        "search": "",
                        "searchPlaceholder": "請輸入關鍵字",
                        "paginate": { "previous": "上一頁", "next": "下一頁" },
                        "emptyTable":     "目前無工單",
                        "zeroRecords":    "沒有符合的搜尋結果",
                    },
                    "dom": "Bfrtip",
                    "buttons": [{
                        "extend": "colvis",
                        "collectionLayout": "fixed two-column"
                    }],
                    "order": [[ 1, "desc" ], [ 10, "asc" ]],
                    "columnDefs": [{
                        "targets": [],
                        "orderable": false,
                    },{ 
                        "width": "80px", 
                        "targets": 8 }
                        ],
                        "responsive": {
                            "breakpoints": [
                            { name: 'desktop', width: Infinity},
                            { name: 'tablet',  width: 1024},
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
            }
        })
    })
</script>
<script type="text/javascript">
    $("#SD1").on("dp.change", function (e) {
        $('#ED1').data("DateTimePicker").minDate(e.date);
    });
    $("#ED1").on("dp.change", function (e) {
        $('#SD1').data("DateTimePicker").maxDate(e.date);
    });
    $("#SD2").on("dp.change", function (e) {
        $('#ED2').data("DateTimePicker").minDate(e.date);
    });
    $("#ED2").on("dp.change", function (e) {
        $('#SD2').data("DateTimePicker").maxDate(e.date);
    });
</script>
@endsection