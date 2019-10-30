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
                                                <!-- tab標籤 -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-01">待指派工單</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-02">已指派工單</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-03">行程回報</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 待指派工單 -->
                                                    <div class="tab-pane active" id="viewers-tab-01">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-su">
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
                                                                    <th class="desktop">負責人</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- 已指派工單 -->
                                                    <div class="tab-pane" id="viewers-tab-02">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-su-2">
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
                                                                    <th class="desktop">負責人</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($supervisor as $data)
                                                                <tr>
                                                                    <td>{{ $data->case_id }}</td>
                                                                    <td>{{ $data->time }}</td>
                                                                    <td>{{ $data->cuskey }}</td>
                                                                    <td>{{ $data->case_id }}</td>
                                                                    <td><a href="https://www.google.com.tw/maps/place/{{ $data->address }}" target="_blank">{{ $data->address }}</a></td>
                                                                    <td><a href="tel:{{ $data->mobile }}">{{ $data->mobile }}</a></td>
                                                                    <td>{{ $data->reason }}</td>
                                                                    <td>{{ $data->work_type }}</td>
                                                                    <td>{{ $data->owner }}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
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
                                                                    <th hidden="">統編</th>
                                                                    <th class="desktop">狀態</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

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
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $.ajax({
            method:'get',
            url:'{{ route('ht.StrokeManage.supervisor.getData',['organization'=>$organization]) }}',
            data:{
                "token": '{{Auth::user()->token}}',
                "DEPT": '{{Auth::user()->department->name}}'
            },
            dataType:'json',
            success:function(response){

                var rows;
                $('#hetao-list-su').DataTable().destroy();

                $.each(response.data, function (i, item) {
                    var tt =  'GUI-number'
                    var itemtt = item['GUI-number']

                    if(item.status == 'F' || item.status == 'T'){

                    }
                    else{
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
                              + "<td><select class='form-control' name='assign' style='margin-right:28px;'><option selected value=''>待指派</option></select><input class='chkall hide' type='checkbox' value='' /></td>"
                         + "</tr>";
                    }
                    
                });
                $('#hetao-list-su tbody').append(rows);
                $("#hetao-list-su").DataTable({
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
                        "extend": 'colvis',
                        "collectionLayout": 'fixed two-column'
                    }],
                    "order": [1],
                    "columnDefs": [{
                        "targets": [8],
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
                $('#hetao-list-su_filter').append(
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
                    "<div class='batchwrap'><div class='form-group mr-s hide batch-select'><select class='form-control' name='allassign' id='sel1'><option selected hidden disabled>請指派負責主管</option><option>Ricky</option><option>Eva</option><option>Apple</option><option>Banana</option></select></div>" +
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
                    url:"{{ route('ht.StrokeManage.supervisor.getAssign',['organization'=>$organization]) }}", 
                    method:"get",
                    dataType:'json',                 
                    success:function(res){
                        var selOpts = "<option value='' selected disabled='true'>待指派</option>";
                        $.each(res, function (i, item) {
                            selOpts += "<option value='"+item.token+"'>"+item.name+"</option>";
                        })

                        $("select[name='assign']").empty();
                        $("select[name='assign']").append(selOpts);

                        $("select[name='allassign']").empty();
                        $("select[name='allassign']").append(selOpts);
                    }
                })


                $('#hetao-list-su tbody').on('change', 'select[name="assign"]', function () {

                     var token = $("select[name='assign']").val()
                     var id = $(this).parents('tr').children('td')[0].textContent 
                     var time = $(this).parents('tr').children('td')[1].textContent 
                     var CUSTKEY = $(this).parents('tr').children('td')[2].textContent 
                     var address = $(this).parents('tr').children('td')[4].textContent 
                     var mobile = $(this).parents('tr').children('td')[5].textContent 
                     var reason = $(this).parents('tr').children('td')[6].textContent 
                     var work_type = $(this).parents('tr').children('td')[7].textContent 
                     var GUI_number = $(this).parents('tr').children('td')[8].textContent 

                     if (confirm('是否指派？') == true) {
                         $.ajax({
                            url:"{{ route('ht.StrokeManage.supervisor.assignCaseBoss',['organization'=>$organization]) }}", 
                            method:"post",
                            data:{
                                '_token':'{{csrf_token()}}',
                                'id':id,
                                'name': CUSTKEY,
                                'mobile': mobile,
                                'GUI_number': GUI_number,
                                'address': address,
                                'reason': reason,
                                'work_type': work_type,
                                'time': time,
                                'owner_boss': token,
                            },
                            dataType:'json',                 
                            success:function(res){
                                if(res.status == 200){
                                    alert('工單更新成功,已指派員工');
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

        $.ajax({
            method:'get',
            url:'{{ route('ht.StrokeManage.assistant.getData',['organization'=>$organization]) }}',
            data:{
                "token": '{{Auth::user()->token}}',
                "DEPT": '{{Auth::user()->department->name}}',
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
                    else if(item.status == 'T'){

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
                $('#hetao-list-s-2 tbody').append(rows);
                $("#hetao-list-s-2").DataTable({
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
                    "order": [[ 1, "desc" ], [ 9, "desc" ]],
                    "columnDefs": [{
                        "targets": [],
                        "orderable": true,
                    },{
                       "width":"80px",
                       "targets":9 
                    }],
                    "responsive": {
                        "breakpoints": [
                        { name: 'desktop', width: Infinity},
                        { name: 'tablet',  width: 1300},
                        ],
                        "details": {
                            "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                            "type": 'none',
                            "renderer": $.fn.dataTable.Responsive.renderer.tableAll(),
                            "target": ''
                        }
                    },
                });
                $('#hetao-list-s-2_filter').append(
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
                    "</div>" +
                    "</form>" +
                    "</div>"
                );

                $('#hetao-list-s-2').on('click',".finish",function(){
                    var id = $(this).parents('tr').children('td')[0].textContent

                    $.ajax({
                        method:'post',
                        url:'{{ route('ht.StrokeManage.supervisor.updateStatus',['organization'=>$organization]) }}',
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
                        url:'{{ route('ht.StrokeManage.supervisor.updateStatus',['organization'=>$organization]) }}',
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

                    var id = $(this).parents('tr').children('td')[0].textContent 
                    var time = $(this).parents('tr').children('td')[1].textContent 
                    var CUSTKEY = $(this).parents('tr').children('td')[2].textContent 
                    var address = $(this).parents('tr').children('td')[4].textContent 
                    var mobile = $(this).parents('tr').children('td')[5].textContent 
                    var work_type = $(this).parents('tr').children('td')[7].textContent 
                    var GUI_number = $(this).parents('tr').children('td')[8].textContent 

                    $.ajax({
                        url:"{{ route('ht.StrokeManage.supervisor.transfer',['organization'=>$organization]) }}", 
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
</script>
<script type="text/javascript">
    $('#hetao-list-su').on( 'page.dt', function () {
        $.ajax({
            url:"{{ route('ht.StrokeManage.supervisor.getAssign',['organization'=>$organization]) }}", 
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
@endsection