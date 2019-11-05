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
                                                        <a data-toggle="tab" href="#viewers-tab-05">已完成工單</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-04">與我聯繫</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 客戶線上預約 -->
                                                    <div class="tab-pane active" id="viewers-tab-01">
                                                        <div class='coupon'>
                                                            <form class="form-inline">
                                                                <input type="text" class="form-control mr-s searchInput searchInput_a" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' id="startDate1" type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' id="endDate1" type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' id="searchDate1" type="button">確認送出</button>
                                                                    <button class='mr-s'>重新設定時間</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-a">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">姓名</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">預約日期</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($reservation as $data)
                                                                <tr class="watch" onclick="javascript:location.href='{{ route('ht.StrokeManage.assistant.show',['organization'=>$organization,'id'=>base64_encode($data->id)]) }}'">
                                                                    <td>{{ $data->name }}</td>
                                                                    <td>{{ $data->cuskey }}</td>
                                                                    <td>{{ $data->created_at }}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end -->
                                                    <!-- 派工單 -->
                                                    <div class="tab-pane" id="viewers-tab-02">
                                                        <div class='coupon'>
                                                            <form class='form-inline'>
                                                                <input type="text" class="form-control mr-s searchInput searchInput_a2" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' id="startDate2" type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' id="endDate2" type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' id="searchDate2" type="button">確認送出</button>
                                                                    <button class='mr-s'>重新設定時間</button>
                                                                    <a href="{{ route('ht.StrokeManage.assistant.create',['organization'=>$organization]) }}"><button type='button' class='mr-s btn-bright' type='button'>新增派工單</button></a>
                                                                    <div class='batchwrap'>
                                                                        <div class='form-group mr-s hide batch-select'><select class='form-control' name="sel1" id='sel1'>
                                                                                <option selected hidden disabled>請指派負責主管</option>
                                                                            </select></div>
                                                                        <button type='button' id="allFinish" class='btn-bright hide batch-finish'>完成</button><label for='chkall' class='sall'>全選</label><input id='chkall' type='checkbox' value='' />
                                                                        <button type='button' class='btn-bright batch' href=''>批次指派</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

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
                                                        <div class='coupon'>
                                                            <form class="form-inline">
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' id="startDate3" type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' id="endDate3" type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' id="searchDate3" type="button">確認送出</button>
                                                                    <button class='mr-s'>重新設定時間</button>
                                                                </div>
                                                            </form>
                                                        </div>

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
                                                                    <th hidden="">統編</th>
                                                                    <th class="desktop">狀態</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end -->
                                                    <!-- 已完成工單 -->
                                                    <div class="tab-pane" id="viewers-tab-05">
                                                        <div class='coupon'>
                                                            <form class="form-inline">
                                                                <input type="text" class="form-control mr-s searchInput searchInput_ss2" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' id="startDate5" type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' id="endDate5" type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' id="searchDate5" type="button">確認送出</button>
                                                                    <button class='mr-s'>重新設定時間</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-ss-2">
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
                                                                    <th class="desktop">狀態</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end -->
                                                    <!-- 與我聯繫 -->
                                                    <div class="tab-pane" id="viewers-tab-04">
                                                        <div class='coupon'>
                                                            <form class="form-inline">
                                                                <input type="text" class="form-control mr-s searchInput searchInput_ab" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' id="startDate4" type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' id="endDate4" type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' id="searchDate4" type="button">確認送出</button>
                                                                    <button class='mr-s'>重新設定時間</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-ab">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">預約日期</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($contact as $data)
                                                                <tr class="watch" onclick="javascript:location.href='{{ route('ht.StrokeManage.assistant.showContact',['organization'=>$organization,'id'=>base64_encode($data->id)]) }}'">
                                                                    <td>{{ $data->created_at }}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end -->
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
    //線上預約
    var table_a = $("#hetao-list-a").DataTable({
        "bPaginate": true,
        "searching": true,
        "info": false,
        "bLengthChange": false,
        "bServerSide": false,
        "language": {
            "search": "",
            "searchPlaceholder": "請輸入關鍵字",
            "paginate": { "previous": "上一頁", "next": "下一頁" },
            "emptyTable":     "目前無線上預約單",
            "zeroRecords":    "沒有符合的搜尋結果",
        },
        "dom": "Bfrtip",
        "buttons": [{
            "extend": 'colvis',
            "collectionLayout": 'fixed two-column'
        }],
        "order": [[ 2, "desc" ]],
        "columnDefs": [{
            "targets": [2],
            "orderable": true,
        }],
        "responsive": {
            "breakpoints": [
            { name: 'desktop', width: Infinity},
            { name: 'tablet',  width: 1700},
            ],
            "details": {
                "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                "type": 'none',
                renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
                "target": ''
            }
        },
    });
    $(".searchInput_a").on("keyup", function() {
        table_a.search(this.value).draw();
    });
    //end

    //派工單
    $.ajax({
        url:"{{ route('ht.StrokeManage.assistant.getSupervisor',['organization'=>$organization]) }}", 
        method:"get",
        dataType:'json',                 
        success:function(res){
            var selOpts = "<option value='' selected disabled='true'>待指派</option>";
            $.each(res, function (i, item) {
                selOpts += "<option value='"+item.token+"'>"+item.name+"</option>";
            })

            $("select[name='sel1']").empty();
            $("select[name='sel1']").append(selOpts);
        }
    })

    //與我聯繫
    var table_ab = $("#hetao-list-ab").DataTable({
        "bPaginate": true,
        "searching": true,
        "info": false,
        "bLengthChange": false,
        "bServerSide": false,
        "language": {
            "search": "",
            "searchPlaceholder": "請輸入關鍵字",
            "paginate": { "previous": "上一頁", "next": "下一頁" },
            "emptyTable":     "目前無與我聯繫表單",
            "zeroRecords":    "沒有符合的搜尋結果",
        },
        "dom": "Bfrtip",
        "buttons": [{
            "extend": 'colvis',
            "collectionLayout": 'fixed two-column'
        }],
        "order": [[ 0, "desc" ]],
        "columnDefs": [{
            "targets": [0],
            "orderable": false,
        }],
        "responsive": {
            "breakpoints": [
            { name: 'desktop', width: Infinity},
            { name: 'tablet',  width: 1700},
            ],
            "details": {
                "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                "type": 'none',
                renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
                "target": ''
            }
        },
    });
    $(".searchInput_ab").on("keyup", function() {
        table_ab.search(this.value).draw();
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){

        //派工單
        $.ajax({
            method:'get',
            url:'{{ route('ht.StrokeManage.assistant.getData',['organization'=>$organization]) }}',
            data:{
                "token": '{{Auth::user()->token}}',
                "DEPT": '{{Auth::user()->department->name}}'
            },
            dataType:'json',
            success:function(response){

                var rows;
                $('#hetao-list-a-2').DataTable().destroy();

                $.each(response.data, function (i, item) {
                    var tt =  'GUI-number'
                    var itemtt = item['GUI-number']

                    if(item.owner == '' || item.owner == null || item.status == 'R'){
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
                              + "<td><a href='edit/"+window.btoa(item.id)+"'><button type='button' class='btn btn-primary' style='margin-right: 28px;''>處理</button></a><input id='chk' name='oneforall' class='chkall hide' type='checkbox' value='' /></td>"
                         + "</tr>";
                    }
                    
                });
                $('#hetao-list-a-2 tbody').append(rows);
                var table_a2 = $("#hetao-list-a-2").DataTable({
                    "bPaginate": true,
                    "searching": true,
                    "info": false,
                    "bLengthChange": false,
                    "bServerSide": false,
                    "language": {
                        "search": "",
                        "searchPlaceholder": "請輸入關鍵字",
                        "paginate": { "previous": "上一頁", "next": "下一頁" },
                        "emptyTable":     "目前無待指派工單",
                        "zeroRecords":    "沒有符合的搜尋結果",
                    },
                    "dom": "Bfrtip",
                    "buttons": [{
                        "extend": "colvis",
                        "collectionLayout": "fixed two-column"
                    }],
                    "order": [[ 1, "desc" ]],
                    "columnDefs": [{
                        "targets": [9],
                        "orderable": false,
                    }],
                    "responsive": {
                        "breakpoints": [
                        { name: 'desktop', width: Infinity},
                        { name: 'tablet',  width: 1370},
                        ],
                        "details": {
                            "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                            "type": 'none',
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
                            "target": ''
                        }
                    },
                });
                $(".searchInput_a2").on("keyup", function() {
                    table_a2.search(this.value).draw();
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

                        $("select[name='sel1']").empty();
                        $("select[name='sel1']").append(selOpts);
                    }
                })

                $('#hetao-list-a-2 tbody').on('change', 'select[name="assign"]', function () {

                     var token = $("select[name='assign']").val()
                     var id = $(this).parents('tr').children('td')[0].textContent 
                     var time = $(this).parents('tr').children('td')[1].textContent 
                     var CUSTKEY = $(this).parents('tr').children('td')[2].textContent 
                     var address = $(this).parents('tr').children('td')[4].textContent 
                     var mobile = $(this).parents('tr').children('td')[5].textContent 
                     var work_type = $(this).parents('tr').children('td')[7].textContent 
                     var GUI_number = $(this).parents('tr').children('td')[8].textContent 

                     if (confirm('是否指派？') == true) {
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
                                if(res.status == 200){
                                    alert(res.message)
                                }
                                else{
                                    alert('指派失敗')
                                }
                            }
                        })
                    }
                 })
            }
        })
        //end

        //行程回報
        $.ajax({
            method:'get',
            url:'{{ route('ht.StrokeManage.assistant.schedule',['organization'=>$organization]) }}',
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
                              + "<td>" + item.id + "</td>"
                              + "<td>" + item.time + "</td>"
                              + "<td>" + item.CUSTKEY + "</td>"
                              + "<td>" + item.owner + "</td>"
                              + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' onclick='window.open(this.href); return false;' >" + item.address + "</a></td>"
                              + "<td><a href='tel:"+item.mobile+"'>" + item.mobile + "</a></td>"
                              + "<td>" + item.remarks + "</td>"
                              + "<td>" + item.work_type + "</td>"
                              + `<td hidden> ${itemtt}</td>`
                              + "<td><button type='button' class='btn status transfer'>轉單</button><button type='button' class='btn status late'>延後</button><button type='button' class='btn status finish'>已完成</button></td>"
                         + "</tr>";
                    }
                    else if(item.status == 'F'){
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
                              + "<td><button type='button' class='btn status transfer'>轉單</button><button type='button' class='btn status btn-primary late'>延後</button><button type='button' class='btn status finish'>已完成</button></td>"
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
                    "order": [[ 1, "desc" ], [ 9, "desc" ]],
                    "columnDefs": [{
                        "targets": [9],
                        "orderable": false,
                    }],
                    "responsive": {
                        "breakpoints": [
                        { name: 'desktop', width: Infinity},
                        { name: 'tablet',  width: 1370},
                        ],
                        "details": {
                            "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                            "type": 'none',
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
                            "target": ''
                        }
                    },
                });
                $(".searchInput_s2").on("keyup", function() {
                    table_s2.search(this.value).draw();
                });

                $("#hetao-list-s-2").on("click", ".finish", function(){
                    var id = $(this).parents('tr').children('td')[0].textContent

                    $.ajax({
                        method:'post',
                        url:'{{ route('ht.StrokeManage.assistant.updateStatus',['organization'=>$organization]) }}',
                        data:{
                            '_token':'{{csrf_token()}}',
                            "token": '{{Auth::user()->token}}',//'{{Auth::user()->token}}'
                            "id":id,
                            "status":'T',
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

                $("#hetao-list-s-2").on("click", ".late", function(){
                    var id = $(this).parents('tr').children('td')[0].textContent

                    $.ajax({
                        method:'post',
                        url:'{{ route('ht.StrokeManage.assistant.updateStatus',['organization'=>$organization]) }}',
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

                    // var id = $(this).parents('tr').children('td')[0].textContent 
                    // var time = $(this).parents('tr').children('td')[1].textContent 
                    // var CUSTKEY = $(this).parents('tr').children('td')[2].textContent 
                    // var address = $(this).parents('tr').children('td')[4].textContent 
                    // var mobile = $(this).parents('tr').children('td')[5].textContent 
                    // var work_type = $(this).parents('tr').children('td')[7].textContent 
                    // var GUI_number = $(this).parents('tr').children('td')[8].textContent 

                    $.ajax({
                        method:'post',
                        url:'{{ route('ht.StrokeManage.assistant.updateStatus',['organization'=>$organization]) }}',
                        data:{
                            '_token':'{{csrf_token()}}',
                            "token": '{{Auth::user()->token}}',//'{{Auth::user()->token}}'
                            "id":id,
                            "status":'F',
                            "DEPT": '{{Auth::user()->department->name}}' //'{{Auth::user()->department_id}}'
                        },
                        dataType:'json',                 
                        success:function(res){
                            if(res.status == 200){
                                alert('轉單成功')
                            }
                            else{
                                alert('轉單失敗')
                            }
                        }
                    })
                })
            }
        })
        //end

        //已完成工單
        $.ajax({
            method:'get',
            url:'{{ route('ht.StrokeManage.assistant.schedule',['organization'=>$organization]) }}',
            data:{
                "token": '{{Auth::user()->token}}',
                "DEPT": '{{Auth::user()->department->name}}'
            },
            dataType:'json',
            success:function(response){

                var rows;
                $('#hetao-list-ss-2').DataTable().destroy();

                $.each(response.data, function (i, item) {
                    var tt =  'GUI-number'
                    var itemtt = item['GUI-number']

                    if(item.status == 'T'){
                        rows += "<tr class='past'>"
                              + "<td>" + item.id + "</td>"
                              + "<td>" + item.time + "</td>"
                              + "<td>" + item.CUSTKEY + "</td>"
                              + "<td>" + item.owner + "</td>"
                              + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' onclick='window.open(this.href); return false;' >" + item.address + "</a></td>"
                              + "<td><a href='tel:"+item.mobile+"'>" + item.mobile + "</a></td>"
                              + "<td>" + item.remarks + "</td>"
                              + "<td>" + item.work_type + "</td>"
                              + `<td hidden> ${itemtt}</td>`
                              + "<td>已完成</td>"
                         + "</tr>";
                    }
                    
                });
                $('#hetao-list-ss-2 tbody').append(rows);
                var table_s2 = $("#hetao-list-ss-2").DataTable({
                    "bPaginate": true,
                    "searching": true,
                    "info": false,
                    "bLengthChange": false,
                    "bServerSide": false,
                    "language": {
                        "search": "",
                        "searchPlaceholder": "請輸入關鍵字",
                        "paginate": { "previous": "上一頁", "next": "下一頁" },
                        "emptyTable":     "目前無已完成工單",
                        "zeroRecords":    "沒有符合的搜尋結果",
                    },
                    "dom": "Bfrtip",
                    "buttons": [{
                        "extend": "colvis",
                        "collectionLayout": "fixed two-column"
                    }],
                    "order": [[ 1, "desc" ], [ 9, "desc" ]],
                    "columnDefs": [{
                        "targets": [9],
                        "orderable": false,
                    }],
                    "responsive": {
                        "breakpoints": [
                        { name: 'desktop', width: Infinity},
                        { name: 'tablet',  width: 1370},
                        ],
                        "details": {
                            "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                            "type": 'none',
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
                            "target": ''
                        }
                    },
                });
                $(".searchInput_ss2").on("keyup", function() {
                    table_s2.search(this.value).draw();
                });
            }
        })
        //end
    })
</script>
<script type="text/javascript">
    $('#hetao-list-a-2').on( 'page.dt', function () {
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
    });
</script>
<script type="text/javascript">

    //線上預約
    $('#searchDate1').on('click',function(){

        var start = $('#startDate1').val()
        var end = $('#endDate1').val()

        $.ajax({
            method:'post',
            url:'{{ route('ht.StrokeManage.assistant.resSearch',['organization'=>$organization]) }}',
            data:{
                '_token':'{{csrf_token()}}',
                'start':start,
                'end':end,
            },
            dataType:'json',
            success:function(res){

                if(res == ''){
                    alert('沒有符合的資料')
                }
                else{
                    var rows;

                    $('#hetao-list-a').DataTable().destroy();
                    $('#hetao-list-a tbody').empty();

                    $.each(res, function (i, item) {

                        rows += "<tr class='watch' onclick='javascript:location.href='{{ route('ht.StrokeManage.assistant.show',['organization'=>$organization,'id'=>base64_encode("+item.id+")]) }}''>"
                        + "<td>" + item.name + "</td>"
                        + "<td>" + item.cuskey + "</td>"
                        + "<td>" + item.created_at + "</td>"
                        + "</tr>";                
                    });
                    $('#hetao-list-a tbody').append(rows);
                    var table_a = $("#hetao-list-a").DataTable({
                        "bPaginate": true,
                        "searching": true,
                        "info": false,
                        "bLengthChange": false,
                        "bServerSide": false,
                        "language": {
                            "search": "",
                            "searchPlaceholder": "請輸入關鍵字",
                            "paginate": { "previous": "上一頁", "next": "下一頁" },
                            "emptyTable":     "目前無線上預約單",
                            "zeroRecords":    "沒有符合的搜尋結果",
                        },
                        "dom": "Bfrtip",
                        "buttons": [{
                            "extend": 'colvis',
                            "collectionLayout": 'fixed two-column'
                        }],
                        "order": [[ 2, "desc" ]],
                        "columnDefs": [{
                            "targets": [2],
                            "orderable": true,
                        }],
                        "responsive": {
                            "breakpoints": [
                            { name: 'desktop', width: Infinity},
                            { name: 'tablet',  width: 1700},
                            ],
                            "details": {
                                "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                                "type": 'none',
                                renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
                                "target": ''
                            }
                        },
                    });
                    $(".searchInput_a").on("keyup", function() {
                        table_a.search(this.value).draw();
                    });
                }
            }
        })
    })

    //派工單
    $('#searchDate2').on('click',function(){

        var start = $('#startDate2').val()
        var end = $('#endDate2').val()

        $.ajax({
            method:'get',
            url:'{{ route('ht.StrokeManage.assistant.getData',['organization'=>$organization]) }}',
            data:{
                "token": '{{Auth::user()->token}}',
                "DEPT": '{{Auth::user()->department->name}}'
            },
            dataType:'json',
            success:function(res){

                var rows;

                var Newstart = Date.parse(new Date(start.replace(/-/g, '/')));
                var Newend = Date.parse(new Date(end.replace(/-/g, '/')));

                $('#hetao-list-a-2').DataTable().destroy();
                $('#hetao-list-a-2 tbody').empty();

                $.each(res.data, function (i, item) {

                    var tt =  'GUI-number'
                    var itemtt = item['GUI-number']

                    if(item.owner == '' || item.owner == null || item.status == 'R'){
                        if(Newend > Date.parse(new Date(item.time.replace(/-/g, '/'))) && Newstart < Date.parse(new Date(item.time.replace(/-/g, '/')))){
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
                                  + "<td><a href='edit/"+window.btoa(item.id)+"'><button type='button' class='btn btn-primary' style='margin-right: 28px;''>處理</button></a><input id='chk' name='oneforall' class='chkall hide' type='checkbox' value='' /></td>"
                             + "</tr>";
                         }
                    }   
                });
                $('#hetao-list-a-2 tbody').append(rows);
                var table_a2 = $("#hetao-list-a-2").DataTable({
                    "bPaginate": true,
                    "searching": true,
                    "info": false,
                    "bLengthChange": false,
                    "bServerSide": false,
                    "language": {
                        "search": "",
                        "searchPlaceholder": "請輸入關鍵字",
                        "paginate": { "previous": "上一頁", "next": "下一頁" },
                        "emptyTable":     "目前無待指派工單",
                        "zeroRecords":    "沒有符合的搜尋結果",
                    },
                    "dom": "Bfrtip",
                    "buttons": [{
                        "extend": 'colvis',
                        "collectionLayout": 'fixed two-column'
                    }],
                    "order": [[ 1, "desc" ]],
                    "columnDefs": [{
                        "targets": [1],
                        "orderable": true,
                    }],
                    "responsive": {
                        "breakpoints": [
                        { name: 'desktop', width: Infinity},
                        { name: 'tablet',  width: 1700},
                        ],
                        "details": {
                            "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                            "type": 'none',
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
                            "target": ''
                        }
                    },
                });
                $(".searchInput_a2").on("keyup", function() {
                    table_a2.search(this.value).draw();
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

                        $("select[name='sel1']").empty();
                        $("select[name='sel1']").append(selOpts);
                    }
                })

                $('#hetao-list-a-2 tbody').on('change', 'select[name="assign"]', function () {

                     var token = $("select[name='assign']").val()
                     var id = $(this).parents('tr').children('td')[0].textContent 
                     var time = $(this).parents('tr').children('td')[1].textContent 
                     var CUSTKEY = $(this).parents('tr').children('td')[2].textContent 
                     var address = $(this).parents('tr').children('td')[4].textContent 
                     var mobile = $(this).parents('tr').children('td')[5].textContent 
                     var work_type = $(this).parents('tr').children('td')[7].textContent 
                     var GUI_number = $(this).parents('tr').children('td')[8].textContent 

                     if (confirm('是否指派？') == true) {
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
                                if(res.status == 200){
                                    alert(res.message)
                                }
                                else{
                                    alert('指派失敗')
                                }
                            }
                        })
                    }
                 })
            }
        })
    })

    //行程回報
    $('#searchDate3').on('click',function(){

        var start = $('#startDate3').val()
        var end = $('#endDate3').val()

        $.ajax({
            method:'get',
            url:'{{ route('ht.StrokeManage.assistant.schedule',['organization'=>$organization]) }}',
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

                    if(Newend > Date.parse(new Date(item.time.replace(/-/g, '/'))) && Newstart < Date.parse(new Date(item.time.replace(/-/g, '/')))){
                        if(item.status == '' || item.status == null){

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
                                  + "<td><button type='button' class='btn status transfer'>轉單</button><button type='button' class='btn status late'>延後</button><button type='button' class='btn status finish'>已完成</button></td>"
                             + "</tr>";
                        }
                        else if(item.status == 'F'){
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
                                  + "<td><button type='button' class='btn status transfer'>轉單</button><button type='button' class='btn status btn-primary late'>延後</button><button type='button' class='btn status finish'>已完成</button></td>"
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
                    "order": [[ 1, "desc" ], [ 9, "desc" ]],
                    "columnDefs": [{
                        "targets": [9],
                        "orderable": false,
                    }],
                    "responsive": {
                        "breakpoints": [
                        { name: 'desktop', width: Infinity},
                        { name: 'tablet',  width: 1700},
                        ],
                        "details": {
                            "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                            "type": 'none',
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
                            "target": ''
                        }
                    },
                });
                $(".searchInput_s2").on("keyup", function() {
                    table_s2.search(this.value).draw();
                });

                $("#hetao-list-s-2").on("click", ".finish", function(){
                    var id = $(this).parents('tr').children('td')[0].textContent

                    $.ajax({
                        method:'post',
                        url:'{{ route('ht.StrokeManage.assistant.updateStatus',['organization'=>$organization]) }}',
                        data:{
                            '_token':'{{csrf_token()}}',
                            "token": '{{Auth::user()->token}}',//'{{Auth::user()->token}}'
                            "id":id,
                            "status":'T',
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

                $("#hetao-list-s-2").on("click", ".late", function(){
                    var id = $(this).parents('tr').children('td')[0].textContent

                    $.ajax({
                        method:'post',
                        url:'{{ route('ht.StrokeManage.assistant.updateStatus',['organization'=>$organization]) }}',
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

                    // var id = $(this).parents('tr').children('td')[0].textContent 
                    // var time = $(this).parents('tr').children('td')[1].textContent 
                    // var CUSTKEY = $(this).parents('tr').children('td')[2].textContent 
                    // var address = $(this).parents('tr').children('td')[4].textContent 
                    // var mobile = $(this).parents('tr').children('td')[5].textContent 
                    // var work_type = $(this).parents('tr').children('td')[7].textContent 
                    // var GUI_number = $(this).parents('tr').children('td')[8].textContent 

                    $.ajax({
                        method:'post',
                        url:'{{ route('ht.StrokeManage.assistant.updateStatus',['organization'=>$organization]) }}',
                        data:{
                            '_token':'{{csrf_token()}}',
                            "token": '{{Auth::user()->token}}',//'{{Auth::user()->token}}'
                            "id":id,
                            "status":'F',
                            "DEPT": '{{Auth::user()->department->name}}' //'{{Auth::user()->department_id}}'
                        },
                        dataType:'json',                 
                        success:function(res){
                            if(res.status == 200){
                                alert('轉單成功')
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

    //已完成工單
    $('#searchDate5').on('click',function(){

        var start = $('#startDate5').val()
        var end = $('#endDate5').val()

        $.ajax({
            method:'get',
            url:'{{ route('ht.StrokeManage.assistant.schedule',['organization'=>$organization]) }}',
            data:{
                "token": '{{Auth::user()->token}}',
                "DEPT": '{{Auth::user()->department->name}}'
            },
            dataType:'json',
            success:function(response){

                var rows;

                var Newstart = Date.parse(new Date(start.replace(/-/g, '/')));
                var Newend = Date.parse(new Date(end.replace(/-/g, '/')));

                $('#hetao-list-ss-2').DataTable().destroy();
                $('#hetao-list-ss-2 tbody').empty();

                $.each(response.data, function (i, item) {
                    var tt =  'GUI-number'
                    var itemtt = item['GUI-number']

                    if(Newend > Date.parse(new Date(item.time.replace(/-/g, '/'))) && Newstart < Date.parse(new Date(item.time.replace(/-/g, '/')))){
                        if(item.status == 'T'){
                            rows += "<tr class='past'>"
                                  + "<td>" + item.id + "</td>"
                                  + "<td>" + item.time + "</td>"
                                  + "<td>" + item.CUSTKEY + "</td>"
                                  + "<td>" + item.owner + "</td>"
                                  + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' onclick='window.open(this.href); return false;' >" + item.address + "</a></td>"
                                  + "<td><a href='tel:"+item.mobile+"'>" + item.mobile + "</a></td>"
                                  + "<td>" + item.remarks + "</td>"
                                  + "<td>" + item.work_type + "</td>"
                                  + `<td hidden> ${itemtt}</td>`
                                  + "<td>已完成</td>"
                             + "</tr>";
                        }
                    }
                });
                $('#hetao-list-ss-2 tbody').append(rows);
                var table_s2 = $("#hetao-list-ss-2").DataTable({
                    "bPaginate": true,
                    "searching": true,
                    "info": false,
                    "bLengthChange": false,
                    "bServerSide": false,
                    "language": {
                        "search": "",
                        "searchPlaceholder": "請輸入關鍵字",
                        "paginate": { "previous": "上一頁", "next": "下一頁" },
                        "emptyTable":     "目前無已完成工單",
                        "zeroRecords":    "沒有符合的搜尋結果",
                    },
                    "dom": "Bfrtip",
                    "buttons": [{
                        "extend": "colvis",
                        "collectionLayout": "fixed two-column"
                    }],
                    "order": [[ 1, "desc" ], [ 9, "desc" ]],
                    "columnDefs": [{
                        "targets": [9],
                        "orderable": false,
                    }],
                    "responsive": {
                        "breakpoints": [
                        { name: 'desktop', width: Infinity},
                        { name: 'tablet',  width: 1700},
                        ],
                        "details": {
                            "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                            "type": 'none',
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
                            "target": ''
                        }
                    },
                });
                $(".searchInput_ss2").on("keyup", function() {
                    table_s2.search(this.value).draw();
                });
            }
        })
    })

    //與我聯繫
    $('#searchDate4').on('click',function(){

        var start = $('#startDate4').val()
        var end = $('#endDate4').val()

        $.ajax({
            method:'post',
            url:'{{ route('ht.StrokeManage.assistant.contactSearch',['organization'=>$organization]) }}',
            data:{
                '_token':'{{csrf_token()}}',
                'start':start,
                'end':end,
            },
            dataType:'json',
            success:function(res){

                if(res == ''){
                    alert('沒有符合的資料')
                }
                else{
                    var rows;

                    $('#hetao-list-ab').DataTable().destroy();
                    $('#hetao-list-ab tbody').empty();

                    $.each(res, function (i, item) {

                        rows += "<tr class='watch' onclick='javascript:location.href='{{ route('ht.StrokeManage.assistant.show',['organization'=>$organization,'id'=>base64_encode("+item.id+")]) }}''>"
                        + "<td>" + item.created_at + "</td>"
                        + "</tr>";                
                    });
                    $('#hetao-list-ab tbody').append(rows);
                    var table_ab = $("#hetao-list-ab").DataTable({
                        "bPaginate": true,
                        "searching": true,
                        "info": false,
                        "bLengthChange": false,
                        "bServerSide": false,
                        "language": {
                            "search": "",
                            "searchPlaceholder": "請輸入關鍵字",
                            "paginate": { "previous": "上一頁", "next": "下一頁" },
                            "emptyTable":     "目前無與我聯繫表單",
                            "zeroRecords":    "沒有符合的搜尋結果",
                        },
                        "dom": "Bfrtip",
                        "buttons": [{
                            "extend": 'colvis',
                            "collectionLayout": 'fixed two-column'
                        }],
                        "order": [[ 2, "desc" ]],
                        "columnDefs": [{
                            "targets": [2],
                            "orderable": true,
                        }],
                        "responsive": {
                            "breakpoints": [
                            { name: 'desktop', width: Infinity},
                            { name: 'tablet',  width: 1700},
                            ],
                            "details": {
                                "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                                "type": 'none',
                                renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
                                "target": ''
                            }
                        },
                    });
                    $(".searchInput_ab").on("keyup", function() {
                        table_ab.search(this.value).draw();
                    });
                }
            }
        })
    })
</script>
<script type="text/javascript">
    $('#allFinish').on('click',function(){

        if (confirm('是否全部指派？') == true) {

            $('input[name="oneforall"]:checked').each(function(){  

                var token = $("select[name='sel1']").val()
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
                        if(res.status == 200){
                        }
                        else{
                        }
                    }
                })
            });
        }
    })
</script>
@endsection