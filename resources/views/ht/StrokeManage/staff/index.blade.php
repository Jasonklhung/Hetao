@extends('layout.app')

@section('content')
<div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">派工單</h3>
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="far fa-list-alt"></i>個人工單
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <!-- tab標籤 -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-01">工單回報</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-02">工單進度</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 工單回報 -->
                                                    <div class="tab-pane active" id="viewers-tab-01">
                                                        <div class='coupon'>
                                                            <form class="form-inline" id="reportAssignSearch">
                                                                @csrf
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select' id="datetimepicker1">
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text' name="start" id="start"> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s' id="datetimepicker2">
                                                                            <input class='form-control' placeholder='選擇結束日期' type='text' name="end" id="end"> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="submit">查詢</button>
                                                                    <button class='mr-s' type="button" id="reset">重設</button>
                                                                    <!--  <a href='dispatch.html'><button class='btn-bright' type='button'>新增派工單</button></a> -->
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
                                                                    <th class="desktop">狀態</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($case as $key => $data)
                                                                <tr>
                                                                    <td class="text-nowrap">
                                                                        @if($data->status == 'F')
                                                                        <button type="button" class="btn status turn" id="turn" value="{{ $data->id }}">轉單</button>
                                                                        <button type="button" class="btn status btn-primary" id="delay" value="{{ $data->id }}">延後</button>
                                                                        <button type="button" class="btn status finish" id="finish" value="{{ $data->id }}">完成</button>
                                                                        @else
                                                                        <button type="button" class="btn status turn" id="turn" value="{{ $data->id }}">轉單</button>
                                                                        <button type="button" class="btn status delay" id="delay" value="{{ $data->id }}">延後</button>
                                                                        <button type="button" class="btn status finish" id="finish" value="{{ $data->id }}">完成</button>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $data->case_id }}</td>
                                                                    <td>{{ $data->time }}</td>
                                                                    <td>{{ $data->cuskey }}</td>
                                                                    <td>{{ $data->name }}</td>
                                                                    <td><a href="tel:{{ $data->mobile }}">{{ $data->mobile }}</a></td>
                                                                    <td><a href="https://www.google.com.tw/maps/place/{{ $data->address }}">{{ $data->address }}</a></td>
                                                                    <td>{{ $data->GUI_number }}</td>
                                                                    <td>{{ $data->owner }}</td>
                                                                    <td>{{ $data->reason }}</td>
                                                                    @if($data->work_type == '維修')
                                                                    <td><span class="color-btn" style="background-color: #e64242">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '洽機')
                                                                    <td><span class="color-btn" style="background-color: #f59d56">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '收款')
                                                                    <td><span class="color-btn" style="background-color: #ffe167">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '送水')
                                                                    <td><span class="color-btn" style="background-color: #91d35c">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '裝機')
                                                                    <td><span class="color-btn" style="background-color: #1bab9f">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '拆機')
                                                                    <td><span class="color-btn" style="background-color: #00c0ff">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '回機')
                                                                    <td><span class="color-btn" style="background-color: #41438f">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '保養')
                                                                    <td><span class="color-btn" style="background-color: #a080c3">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '合約')
                                                                    <td><span class="color-btn" style="background-color: #f73e99">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '其他')
                                                                    <td><span class="color-btn" style="background-color: #a1602c">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '送貨')
                                                                    <td><span class="color-btn" style="background-color: #3f3f3f">{{ $data->work_type }}</span></td>
                                                                    @endif
                                                                    @if($data->status == 'F')
                                                                    <td>延後</td>
                                                                    @else
                                                                    <td></td>
                                                                    @endif
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- 工單進度 -->
                                                    <div class="tab-pane" id="viewers-tab-02">
                                                        <div class='coupon'>
                                                            <form class='form-inline' id="assignCaseSearch">
                                                                @csrf
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s3" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select' id="datetimepicker3">
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text' name="start" id="start2"> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s' id="datetimepicker4">
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
                                                                    <th class="desktop">工單狀態</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($caseFinish as $key => $data)
                                                                <tr>
                                                                    <td>{{ $data->case_id }}</td>
                                                                    <td class="text-nowrap">{{ $data->time }}</td>
                                                                    <td>{{ $data->cuskey }}</td>
                                                                    <td>{{ $data->name }}</td>
                                                                    <td><a href="tel:{{ $data->mobile }}">{{ $data->mobile }}</a></td>
                                                                    <td><a href="https://www.google.com.tw/maps/place/{{ $data->address }}" target="_blank">{{ $data->address }}</a></td>
                                                                    <td>{{ $data->GUI_number }}</td>
                                                                    <td>{{ $data->owner }}</td>
                                                                    <td>{{ $data->reason }}</td>
                                                                    @if($data->work_type == '維修')
                                                                    <td><span class="color-btn" style="background-color: #e64242">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '洽機')
                                                                    <td><span class="color-btn" style="background-color: #f59d56">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '收款')
                                                                    <td><span class="color-btn" style="background-color: #ffe167">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '送水')
                                                                    <td><span class="color-btn" style="background-color: #91d35c">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '裝機')
                                                                    <td><span class="color-btn" style="background-color: #1bab9f">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '拆機')
                                                                    <td><span class="color-btn" style="background-color: #00c0ff">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '回機')
                                                                    <td><span class="color-btn" style="background-color: #41438f">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '保養')
                                                                    <td><span class="color-btn" style="background-color: #a080c3">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '合約')
                                                                    <td><span class="color-btn" style="background-color: #f73e99">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '其他')
                                                                    <td><span class="color-btn" style="background-color: #a1602c">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '送貨')
                                                                    <td><span class="color-btn" style="background-color: #3f3f3f">{{ $data->work_type }}</span></td>
                                                                    @endif
                                                                    @if($data->status == 'T')
                                                                    <td>完成</td>
                                                                    @endif
                                                                </tr>
                                                                @endforeach
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
<script>
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
            "targets": [],
            "orderable": false,
        }, {
            "width": "80px",
            "targets": 8
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
            "targets": [],
            "orderable": false,
        }, {
            "width": "80px",
            "targets": 8
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
        $('.turn').on('click',function(){

            var RWD = $(this).parents('table').parents('tr').find('.child').length;
            
            if(RWD == 0){

                var case_id = $(this).parents('tr').children('td')[1].textContent 
            }
            else{

                var case_id = $(this).closest('tbody').find("tr:eq(1)").find("td:eq(1)").html();
            }

            var id = $(this).val()

            $.ajax({
                type:'post',
                url:"{{ route('ht.StrokeManage.staff.updateCaseStatus',['organization'=>$organization]) }}",
                data:{
                    '_token':'{{csrf_token()}}',
                    'case_id':case_id,
                    'id':id,
                    'status':'R'
                },
                success:function(res){
                    if(res.status == 200){
                        alert('已成功轉單');
                        //window.location = '{{ route('ht.StrokeManage.staff.index',['organization'=>$organization]) }}'
                    }
                    else if(res.status == 400){
                        alert('轉單失敗');
                    }
                }
            })
        })

        $('.delay').on('click',function(){

            var RWD = $(this).parents('table').parents('tr').find('.child').length;

            if(RWD == 0){

                var case_id = $(this).parents('tr').children('td')[1].textContent 
            }
            else{

                var case_id = $(this).closest('tbody').find("tr:eq(1)").find("td:eq(1)").html();
            }
            var id = $(this).val()

            $.ajax({
                type:'post',
                url:"{{ route('ht.StrokeManage.staff.updateCaseStatus',['organization'=>$organization]) }}",
                data:{
                    '_token':'{{csrf_token()}}',
                    'case_id':case_id,
                    'id':id,
                    'status':'F'
                },
                success:function(res){
                    if(res.status == 200){
                        alert('工單已延後');
                        //window.location = '{{ route('ht.StrokeManage.staff.index',['organization'=>$organization]) }}'
                    }
                    else if(res.status == 400){
                        alert('延後失敗');
                    }
                }
            })
        })

        $('.finish').on('click',function(){

            var RWD = $(this).parents('table').parents('tr').find('.child').length;

            if(RWD == 0){

                var case_id = $(this).parents('tr').children('td')[1].textContent 
            }
            else{

                var case_id = $(this).closest('tbody').find("tr:eq(1)").find("td:eq(1)").html();
            }
            var id = $(this).val()

            $.ajax({
                type:'post',
                url:"{{ route('ht.StrokeManage.staff.updateCaseStatus',['organization'=>$organization]) }}",
                data:{
                    '_token':'{{csrf_token()}}',
                    'case_id':case_id,
                    'id':id,
                    'status':'T'
                },
                success:function(res){
                    if(res.status == 200){
                        alert('工單已完成');
                        //window.location = '{{ route('ht.StrokeManage.staff.index',['organization'=>$organization]) }}'
                    }
                    else if(res.status == 400){
                        alert('完成失敗');
                    }
                }
            })
        })
    </script>
    <script type="text/javascript">
        $('#reportAssignSearch').on('submit',function(e){

            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type:'post',
                url:"{{ route('ht.StrokeManage.staff.reportAssignSearch',['organization'=>$organization]) }}",
                data:formData,
                success:function(res){

                    var rows;

                    $('#hetao-list-s-2').DataTable().destroy();
                    $('#hetao-list-s-2 tbody').empty();

                    $.each(res, function (i, item) {

                       var tt =  'GUI-number'
                       var itemtt = item['GUI-number']
                        
                       rows += "<tr>"

                        if(item.status == 'F'){
                            rows += "<td class='text-nowrap'>"
                            + "<button type='button' class='btn status turn' id='turn' value="+ item.id +">轉單</button><button type='button' class='btn status btn-primary delay' id='delay' value="+ item.id +">延後</button><button type='button' class='btn status finish' id='finish' value=" + item.id +">完成</button></td>"
                        }
                        else{
                            rows += "<td class='text-nowrap'>"
                            + "<button type='button' class='btn status turn' id='turn' value="+ item.id +">轉單</button><button type='button' class='btn status delay' id='delay' value="+ item.id +">延後</button><button type='button' class='btn status finish' id='finish' value=" + item.id +">完成</button></td>"
                        }

                        rows += "<td>" + item.case_id + "</td>"
                        + "<td>" + item.time + "</td>"
                        + "<td>" + item.cuskey + "</td>"
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
                        + "<td>" + item.reason + "</td>"
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
                        rows += "<td>" + item.status + "</td>"
                        + "</tr>";
                    })
                    $('#hetao-list-s-2 tbody').append(rows);
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
                            "targets": [],
                            "orderable": false,
                        }, {
                            "width": "80px",
                            "targets": 8
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

                    $('.turn').on('click',function(){

                        var case_id = $(this).parents('tr').children('td')[1].textContent 
                        var id = $(this).val()

                        $.ajax({
                            type:'post',
                            url:"{{ route('ht.StrokeManage.staff.updateCaseStatus',['organization'=>$organization]) }}",
                            data:{
                                '_token':'{{csrf_token()}}',
                                'case_id':case_id,
                                'id':id,
                                'status':'R'
                            },
                            success:function(res){
                                if(res.status == 200){
                                    alert('已成功轉單');
                                    //window.location = '{{ route('ht.StrokeManage.staff.index',['organization'=>$organization]) }}'
                                }
                                else if(res.status == 400){
                                    alert('轉單失敗');
                                }
                            }
                        })
                    })

                    $('#delay').on('click',function(){

                        var case_id = $(this).parents('tr').children('td')[1].textContent 
                        var id = $(this).val()

                        $.ajax({
                            type:'post',
                            url:"{{ route('ht.StrokeManage.staff.updateCaseStatus',['organization'=>$organization]) }}",
                            data:{
                                '_token':'{{csrf_token()}}',
                                'case_id':case_id,
                                'id':id,
                                'status':'F'
                            },
                            success:function(res){
                                if(res.status == 200){
                                    alert('工單已延後');
                                    //window.location = '{{ route('ht.StrokeManage.staff.index',['organization'=>$organization]) }}'
                                }
                                else if(res.status == 400){
                                    alert('延後失敗');
                                }
                            }
                        })
                    })

                    $('#finish').on('click',function(){

                        var case_id = $(this).parents('tr').children('td')[1].textContent 
                        var id = $(this).val()

                        $.ajax({
                            type:'post',
                            url:"{{ route('ht.StrokeManage.staff.updateCaseStatus',['organization'=>$organization]) }}",
                            data:{
                                '_token':'{{csrf_token()}}',
                                'case_id':case_id,
                                'id':id,
                                'status':'T'
                            },
                            success:function(res){
                                if(res.status == 200){
                                    alert('工單已完成');
                                    //window.location = '{{ route('ht.StrokeManage.staff.index',['organization'=>$organization]) }}'
                                }
                                else if(res.status == 400){
                                    alert('完成失敗');
                                }
                            }
                        })
                    })
                },
                cache: false,
                contentType: false,
                processData: false
            })
        })

        $('#assignCaseSearch').on('submit',function(e){

            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type:'post',
                url:"{{ route('ht.StrokeManage.staff.assignCaseSearch',['organization'=>$organization]) }}",
                data:formData,
                success:function(res){

                    var rows;

                    $('#hetao-list-s-3').DataTable().destroy();
                    $('#hetao-list-s-3 tbody').empty();

                    $.each(res, function (i, item) {

                       var tt =  'GUI-number'
                       var itemtt = item['GUI-number']
                        
                       rows += "<tr>"

                        + "<td>" + item.case_id + "</td>"
                        + "<td>" + item.time + "</td>"
                        + "<td>" + item.cuskey + "</td>"
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
                        + "<td>" + item.reason + "</td>"
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
                        if(item.status == 'T'){
                            rows += "<td>完成</td>"
                        }
                        rows += "</tr>";
                    })
                    $('#hetao-list-s-3 tbody').append(rows);
                    var table_s3 = $("#hetao-list-s-3").DataTable({
                        "bPaginate": true,
                        "searching": true,
                        "info": true,
                        "bLengthChange": false,
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
                            "targets": [],
                            "orderable": false,
                        }, {
                            "width": "80px",
                            "targets": 8
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
            $('#start2').val("")
            $('#end2').val("")
        })
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
    </script>
@endsection