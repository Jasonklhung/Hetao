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
                                                @php
                                                    if(isset($_GET['tab'])){
                                                        $tab = $_GET['tab'];
                                                    }
                                                    else{
                                                        $tab = '';
                                                    }
                                                @endphp
                                                <ul class="nav nav-tabs">
                                                    @if($tab == 'case')
                                                    <li class="active">
                                                    @elseif($tab == '')
                                                    <li class="active">
                                                    @else
                                                    <li>
                                                    @endif
                                                        <a data-toggle="tab" name="case">待指派</a>
                                                    </li>
                                                    @if($tab == 'cased')
                                                    <li class="active">
                                                    @else
                                                    <li>
                                                    @endif
                                                        <a data-toggle="tab" name="cased">已指派</a>
                                                    </li>
                                                    @if($tab == 'report')
                                                    <li class="active">
                                                    @else
                                                    <li>
                                                    @endif
                                                        <a data-toggle="tab" name="report">行程回報</a>
                                                    </li>
                                                    @if($tab == 'finish')
                                                    <li class="active">
                                                    @else
                                                    <li>
                                                    @endif
                                                        <a data-toggle="tab" name="finish">已完成</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 待指派工單 -->
                                                    @if($tab == 'case')
                                                    <div class="tab-pane active" id="viewers-tab-01">
                                                    @elseif($tab == '')
                                                    <div class="tab-pane active" id="viewers-tab-01">
                                                    @else
                                                    <div class="tab-pane" id="viewers-tab-01">
                                                    @endif
                                                        <div class='coupon'>
                                                            <form class='form-inline'>
                                                                <input type="text" class="form-control mr-s searchInput searchInput_su" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'  id="SD1">
                                                                            <input class='form-control' placeholder='選擇起始日期' readonly="" id="startDate1" type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s' id="ED1">
                                                                            <input class='form-control' placeholder='選擇結束日期' readonly="" id="endDate1" type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' id="searchDate1" type="button">確認送出</button>
                                                                    <button class='mr-s'>重新設定時間</button>
                                                                    <div class='batchwrap'>
                                                                        <div class='form-group mr-s hide batch-select'><select class='form-control' name="sel1" id='sel1'>
                                                                                <option selected hidden disabled>請指派負責主管</option>
                                                                            </select></div>
                                                                        <button type='button' name="allFinish" id="allFinish" class='btn-bright hide batch-finish'>完成</button><label for='chkall' class='sall'>全選</label><input id='chkall' type='checkbox' value='' />
                                                                        <button type='button' class='btn-bright batch' type="button">批次指派</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <table class="table table-hover dt-responsive table-striped supervisor" id="hetao-list-su">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">負責員工</th>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">聯絡電話</th>
                                                                    <th class="desktop">聯絡地址</th>
                                                                    <th class="desktop">負責員工</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th hidden="" class="desktop">統編</th>
                                                                    <th hidden="" class="desktop">狀態</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- 已指派工單 -->
                                                    @if($tab == 'cased')
                                                    <div class="tab-pane active" id="viewers-tab-02">
                                                    @else
                                                    <div class="tab-pane" id="viewers-tab-02">
                                                    @endif
                                                        <div class='coupon'>
                                                            <form class='form-inline'>
                                                                <input type="text" id="text-search__container" class="form-control mr-s searchInput searchInput_su2" placeholder="請輸入關鍵字">
                                                                <div class="form-group mr-s">
                                                                    <select class="form-control" id="searchStatus">
                                                                        <option value="notselect">所有狀態</option>
                                                                        <option selected="" value="null">執行中</option>
                                                                        <option value="R">轉單</option>
                                                                        <option value="F">延後</option>
                                                                        <option value="T">已完成</option>
                                                                    </select>
                                                                </div>
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

                                                        <table class="table table-hover dt-responsive table-striped supervisor" id="hetao-list-su-2">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">負責員工</th>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">聯絡電話</th>
                                                                    <th class="desktop">聯絡地址</th>
                                                                    <th class="desktop">負責員工</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th hidden class="desktop">統編</th>
                                                                    <th class="desktop">工單狀態</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($supervisor as $data)
                                                                <tr>
                                                                    <td>
                                                                        <select class="form-control" name="assign2" style="margin-right:28px;">
                                                                        @if($data->status == 'T')
                                                                        <option selected disabled="" value="" >已完成</option>
                                                                        @else
                                                                            @foreach($assign as $res)
                                                                            @if($res->name == $data->owner)
                                                                            <option selected value="{{ $res->token }}" >{{ $res->name }}</option>
                                                                            @else
                                                                            <option value="{{ $res->token }}">{{ $res->name }}</option>
                                                                            @endif
                                                                            @endforeach
                                                                        @endif
                                                                        </select>
                                                                    </td>
                                                                    <td>{{ $data->case_id }}</td>
                                                                    <td>{{ $data->time }}</td>
                                                                    <td>{{ $data->cuskey }}</td>
                                                                    @if($data->name == 'null' || $data->name == '' || $data->name == null)
                                                                    <td> </td>
                                                                    @else
                                                                    <td>{{ $data->name }}</td>
                                                                    @endif
                                                                    <td><a href="tel:{{ $data->mobile }}">{{ $data->mobile }}</a></td>
                                                                    <td><a href="https://www.google.com.tw/maps/place/{{ $data->address }}" target="_blank">{{ $data->address }}</a></td>
                                                                    <td>{{ $data->owner }}</td>
                                                                    <td>{{ $data->reason }}</td>

                                                                    @if($data->work_type == '維修')
                                                                    <td><span class="color-btn" style="background-color: #e64242 ">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '洽機')
                                                                    <td><span class="color-btn" style="background-color: #f59d56 ">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '收款')
                                                                    <td><span class="color-btn" style="background-color: #ffe167 ">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '送水')
                                                                    <td><span class="color-btn" style="background-color: #91d35c ">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '裝機')
                                                                    <td><span class="color-btn" style="background-color: #1bab9f ">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '拆機')
                                                                    <td><span class="color-btn" style="background-color: #00c0ff ">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '回機')
                                                                    <td><span class="color-btn" style="background-color: #41438f ">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '保養')
                                                                    <td><span class="color-btn" style="background-color: #a080c3 ">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '合約')
                                                                    <td><span class="color-btn" style="background-color: #f73e99 ">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '其他')
                                                                    <td><span class="color-btn" style="background-color: #a1602c ">{{ $data->work_type }}</span></td>
                                                                    @elseif($data->work_type == '送貨')
                                                                    <td><span class="color-btn" style="background-color: #3f3f3f ">{{ $data->work_type }}</span></td>
                                                                    @endif

                                                                    <td hidden="">{{ $data->GUI_number }}</td>
                                                                @if($data->status == '' || $data->status == 'null' || $data->status == null)
                                                                    <td>執行中</td>
                                                                @elseif($data->status == 'R')
                                                                    <td style="color:#DAA520">轉單</td>
                                                                @elseif($data->status == 'F')
                                                                    <td style="color:red">延後</td>
                                                                @else
                                                                    <td style="color:green">已完成</td>
                                                                @endif
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- 行程回報 -->
                                                    @if($tab == 'report')
                                                    <div class="tab-pane active" id="viewers-tab-03">
                                                    @else
                                                    <div class="tab-pane" id="viewers-tab-03">
                                                    @endif
                                                        <div class='coupon'>
                                                            <form class="form-inline">
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select' id="SD3">
                                                                            <input class='form-control' readonly="" placeholder='選擇起始日期' id="startDate3" type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s' id="ED3">
                                                                            <input class='form-control' readonly="" placeholder='選擇結束日期' id="endDate3" type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' id="searchDate3" type="button">確認送出</button>
                                                                    <button class='mr-s'>重新設定時間</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <table class="table table-hover dt-responsive table-striped supervisor" id="hetao-list-s-2">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">工單狀態</th>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">聯絡電話</th>
                                                                    <th class="desktop">聯絡地址</th>
                                                                    <th class="desktop">負責員工</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th hidden="">統編</th>
                                                                    <th hidden="">status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end -->
                                                    <!-- 已完成工單 -->
                                                    @if($tab == 'finish')
                                                    <div class="tab-pane active" id="viewers-tab-04">
                                                    @else
                                                    <div class="tab-pane" id="viewers-tab-04">
                                                    @endif
                                                        <div class='coupon'>
                                                            <form class="form-inline">
                                                                <input type="text" class="form-control mr-s searchInput searchInput_ss2" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select' id="SD4">
                                                                            <input class='form-control' readonly="" placeholder='選擇起始日期' id="startDate4" type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s' id="ED4">
                                                                            <input class='form-control' readonly="" placeholder='選擇結束日期' id="endDate4" type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' id="searchDate4" type="button">確認送出</button>
                                                                    <button class='mr-s'>重新設定時間</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <table class="table table-hover dt-responsive table-striped supervisor" id="hetao-list-ss-2">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">聯絡電話</th>
                                                                    <th class="desktop">聯絡地址</th>
                                                                    <th class="desktop">負責員工</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th hidden="">統編</th>
                                                                    <th class="desktop">工單狀態</th>
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
    $.ajax({
        url:"{{ route('ht.StrokeManage.supervisor.getAssign',['organization'=>$organization]) }}", 
        method:"get",
        dataType:'json',                 
        success:function(res){
            var selOpts = "<option value='' selected disabled='true'>請指派負責人</option>";
            $.each(res, function (i, item) {
                selOpts += "<option value='"+item.token+"'>"+item.name+"</option>";
            })

            $("select[name='sel1']").empty();
            $("select[name='sel1']").append(selOpts);
        }
    })

    //已指派
    var table_su2 = $("#hetao-list-su-2").DataTable({
        "bPaginate": true,
        "searching": true,
        "info": false,
        "bLengthChange": false,
        "bServerSide": false,
        "language": {
            "search": "",
            "searchPlaceholder": "請輸入關鍵字",
            "paginate": { "previous": "上一頁", "next": "下一頁" },
            "emptyTable":     "目前無已指派工單",
            "zeroRecords":    "沒有符合的搜尋結果",
        },
        "dom": "Bfrtip",
        "buttons": [{
            "extend": "colvis",
            "collectionLayout": "fixed two-column"
        }],
        "order": [[2,'desc'],[1,'asc']],
        "columnDefs": [{
            "targets": [0],
            "orderable": false,
        }],
        "responsive": {
            "breakpoints": [
            { name: 'desktop', width: Infinity},
            { name: 'tablet',  width: 1024},
            ],
            "details": {
                "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                "type": 'none',
                renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
                "target": ''
            }
        },
    });
    // $("#text-search__container").on("keydown", function() {
    //     table_su2.search(this.value).draw();
    // });
    $("#text-search__container").on("keydown", function() {
        table_su2.search(this.value +"&nbsp;").draw();
    });


    //已指派中指派
    $('select[name="assign2"]').on('change', function () {

        var RWD = $(this).parents('table').parents('tr').find('.child').length;

        if(RWD == 0){
            var token = $(this).val()
            var id = $(this).parents('tr').children('td')[1].textContent 
            var time = $(this).parents('tr').children('td')[2].textContent 
            var CUSTKEY = $(this).parents('tr').children('td')[3].textContent 
            var address = $(this).parents('tr').children('td')[6].textContent 
            var name = $(this).parents('tr').children('td')[4].textContent 
            var mobile = $(this).parents('tr').children('td')[5].textContent 
            var reason = $(this).parents('tr').children('td')[8].textContent 
            var work_type = $(this).parents('tr').children('td')[9].textContent 
            var GUI_number = $(this).parents('tr').children('td')[10].textContent
            var status = $(this).parents('tr').children('td')[11].textContent
            if(GUI_number == null || GUI_number == ""){
                var GUI_number = ""
            }
        }
        else if(RWD == 1){
            var token = $(this).val()
            var id = $(this).closest('tbody').find("tr:eq(1)").children("td")[1].textContent;
            var time = $(this).closest('tbody').find("tr:eq(2)").children("td")[1].textContent;
            var CUSTKEY = $(this).closest('tbody').find("tr:eq(3)").children("td")[1].textContent;
            var address = $(this).closest('tbody').find("tr:eq(6)").children("td")[1].textContent;
            var name = $(this).closest('tbody').find("tr:eq(4)").children("td")[1].textContent;
            var mobile = $(this).closest('tbody').find("tr:eq(5)").children("td")[1].textContent;
            var reason = $(this).closest('tbody').find("tr:eq(8)").children("td")[1].textContent;
            var work_type = $(this).closest('tbody').find("tr:eq(9)").children("td")[1].textContent;
            var GUI_number = $(this).closest('tbody').find("tr:eq(10)").children("td")[1].textContent;
            var status = $(this).closest('tbody').find("tr:eq(11)").children("td")[1].textContent;
            if(GUI_number == 'null' || GUI_number == ""){
                var GUI_number = ""
            }
        }

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
                'case_name':name,
                'reason': reason,
                'work_type': work_type,
                'time': time,
                'owner_boss': token,
                'status': status,
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

        $(this).attr('disabled','disabled')

    })

    //已指派狀態搜尋
    $('#searchStatus').on('change',function(){

        var status = $('#searchStatus').val()

        $.ajax({
            method:'post',
            url:'{{ route('ht.StrokeManage.supervisor.searchStatus',['organization'=>$organization]) }}',
            data:{
                '_token':'{{csrf_token()}}',
                'status':status,
            },
            dataType:'json',
            success:function(res){

                if(res == ''){
                    alert('沒有符合的資料')
                }
                else{
                    var rows;

                    $('#hetao-list-su-2').DataTable().destroy();
                    $('#hetao-list-su-2 tbody').empty();


                    $.each(res[0], function (i, item) {

                        if(item.status == 'null' || item.status == ''){
                            rows += "<tr>"
                            + "<td><select class='form-control' name='assign2' style='margin-right:28px;'>";
                            for (var j = 0; j < res[1].length; j++) {
                                if(res[1][j].name == item.owner){ 
                                    rows += "<option value="+ res[1][j].token+" selected>"+res[1][j].name+"</option>"
                                }
                                else{
                                    rows += "<option value="+ res[1][j].token+">"+res[1][j].name+"</option>"
                                }
                            }
                            rows += "</select></td>"
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
                            + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' target='_blank'>"+item.address+"</a></td>"
                            + "<td>" + item.owner + "</td>"
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
                            rows += "<td hidden>" + item.GUI_number + "</td>"
                            + "<td>執行中</td>"
                            + "</tr>";            
                        }
                        else if(item.status == 'R'){
                            rows += "<tr>"
                            + "<td><select class='form-control' name='assign2' style='margin-right:28px;'>";
                            for (var j = 0; j < res[1].length; j++) {
                                if(res[1][j].name == item.owner){ 
                                    rows += "<option value="+ res[1][j].token+" selected>"+res[1][j].name+"</option>"
                                }
                                else{
                                    rows += "<option value="+ res[1][j].token+">"+res[1][j].name+"</option>"
                                }
                            }
                            rows += "</select></td>"
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
                            + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' target='_blank'>"+item.address+"</a></td>"
                            + "<td>" + item.owner + "</td>"
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
                            rows += "<td hidden>" + item.GUI_number + "</td>"
                            + "<td style='color:#DAA520'>轉單</td>"
                            + "</tr>";                     
                        }
                        else if(item.status == 'F'){
                            rows += "<tr>"
                            + "<td><select class='form-control' name='assign2' style='margin-right:28px;'>";
                            for (var j = 0; j < res[1].length; j++) {
                                if(res[1][j].name == item.owner){ 
                                    rows += "<option value="+ res[1][j].token+" selected>"+res[1][j].name+"</option>"
                                }
                                else{
                                    rows += "<option value="+ res[1][j].token+">"+res[1][j].name+"</option>"
                                }
                            }
                            rows += "</select></td>"
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
                            + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' target='_blank'>"+item.address+"</a></td>"
                            + "<td>" + item.owner + "</td>"
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
                            rows += "<td hidden>" + item.GUI_number + "</td>"
                            + "<td style='color:red'>延後</td>"
                            + "</tr>";                      
                        }
                        else{
                            rows += "<tr>"
                            + "<td><select class='form-control' name='assign2' style='margin-right:28px;'>";
                            + "<option value='' selected disabled>已完成</option>"
                            rows += "</select></td>"
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
                            + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' target='_blank'>"+item.address+"</a></td>"
                            + "<td>" + item.owner + "</td>"
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
                            rows += "<td hidden>" + item.GUI_number + "</td>"
                            + "<td style='color:green'>已完成</td>"
                            + "</tr>";                      
                        }
                    });
                    $('#hetao-list-su-2 tbody').append(rows);
                    var table_a = $("#hetao-list-su-2").DataTable({
                        "bPaginate": true,
                        "searching": true,
                        "info": false,
                        "bLengthChange": false,
                        "bServerSide": false,
                        "language": {
                            "search": "",
                            "searchPlaceholder": "請輸入關鍵字",
                            "paginate": { "previous": "上一頁", "next": "下一頁" },
                            "emptyTable":     "目前無已指派工單",
                            "zeroRecords":    "沒有符合的搜尋結果",
                        },
                        "dom": "Bfrtip",
                        "buttons": [{
                            "extend": 'colvis',
                            "collectionLayout": 'fixed two-column'
                        }],
                        "order": [[2,'desc'],[1,'asc']],
                        "columnDefs": [{
                            "targets": [0],
                            "orderable": false,
                        }],
                        "responsive": {
                            "breakpoints": [
                            { name: 'desktop', width: Infinity},
                            { name: 'tablet',  width: 1024},
                            ],
                            "details": {
                                "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                                "type": 'none',
                                renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
                                "target": ''
                            }
                        },
                    });
                    $(".searchInput_su2").on("keyup", function() {
                        table_a.search(this.value).draw();
                    });

                    $('select[name="assign2"]').on('change', function () {

                        var RWD = $(this).parents('table').parents('tr').find('.child').length;

                        if(RWD == 0){
                            var token = $(this).val()
                            var id = $(this).parents('tr').children('td')[1].textContent 
                            var time = $(this).parents('tr').children('td')[2].textContent 
                            var CUSTKEY = $(this).parents('tr').children('td')[3].textContent 
                            var address = $(this).parents('tr').children('td')[6].textContent 
                            var name = $(this).parents('tr').children('td')[4].textContent 
                            var mobile = $(this).parents('tr').children('td')[5].textContent 
                            var reason = $(this).parents('tr').children('td')[8].textContent 
                            var work_type = $(this).parents('tr').children('td')[9].textContent 
                            var GUI_number = $(this).parents('tr').children('td')[10].textContent
                            var status = $(this).parents('tr').children('td')[11].textContent
                            if(GUI_number == 'null' || GUI_number == ""){
                                var GUI_number = ""
                            }
                        }
                        else if(RWD == 1){
                            var token = $(this).val()
                            var id = $(this).closest('tbody').find("tr:eq(1)").children("td")[1].textContent;
                            var time = $(this).closest('tbody').find("tr:eq(2)").children("td")[1].textContent;
                            var CUSTKEY = $(this).closest('tbody').find("tr:eq(3)").children("td")[1].textContent;
                            var address = $(this).closest('tbody').find("tr:eq(6)").children("td")[1].textContent;
                            var name = $(this).closest('tbody').find("tr:eq(4)").children("td")[1].textContent;
                            var mobile = $(this).closest('tbody').find("tr:eq(5)").children("td")[1].textContent;
                            var reason = $(this).closest('tbody').find("tr:eq(8)").children("td")[1].textContent;
                            var work_type = $(this).closest('tbody').find("tr:eq(9)").children("td")[1].textContent;
                            var GUI_number = $(this).closest('tbody').find("tr:eq(10)").children("td")[1].textContent;
                            var status = $(this).closest('tbody').find("tr:eq(11)").children("td")[1].textContent;
                            if(GUI_number == 'null' || GUI_number == ""){
                                var GUI_number = ""
                            }
                        }

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
                                'case_name':name,
                                'reason': reason,
                                'work_type': work_type,
                                'time': time,
                                'owner_boss': token,
                                'status': status,
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

                        $(this).attr('disabled','disabled')

                    })
                }
            }
        })
    })
</script>
<script type="text/javascript">
    $(document).ready(function(){

        //待指派
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

                    if(item.owner == '' || item.owner == null || item.status == 'R'){
                        rows += "<tr>"
                              + "<td><select class='form-control' name='assign' style='margin-right:28px;'><option selected value=''>待指派</option></select></td>"
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
                            + "<td>" + item.owner + "</td>"
                            + "<td>" + item.remarks + "</td>"
                              if(item.work_type == '維修'){
                                rows += "<td><span class='color-btn' style='background-color: #e64242'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                            }
                            else if(item.work_type == '洽機'){
                                rows += "<td><span class='color-btn' style='background-color: #f59d56'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                            }
                            else if(item.work_type == '收款'){
                                rows += "<td><span class='color-btn' style='background-color: #ffe167'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                            }
                            else if(item.work_type == '送水'){
                                rows += "<td><span class='color-btn' style='background-color: #91d35c'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                            }
                            else if(item.work_type == '裝機'){
                                rows += "<td><span class='color-btn' style='background-color: #1bab9f'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                            }
                            else if(item.work_type == '拆機'){
                                rows += "<td><span class='color-btn' style='background-color: #00c0ff'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                            }
                            else if(item.work_type == '回機'){
                                rows += "<td><span class='color-btn' style='background-color: #41438f'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                            }
                            else if(item.work_type == '保養'){
                                rows += "<td><span class='color-btn' style='background-color: #a080c3'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                            }
                            else if(item.work_type == '合約'){
                                rows += "<td><span class='color-btn' style='background-color: #f73e99'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                            }
                            else if(item.work_type == '其他'){
                                rows += "<td><span class='color-btn' style='background-color: #a1602c'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                            }
                            else if(item.work_type == '送貨'){
                                rows += "<td><span class='color-btn' style='background-color: #3f3f3f'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                            }
                              rows += `<td hidden> ${itemtt}</td>`
                              + "<td hidden>" + item.status + "</td>"
                         + "</tr>";
                    }
                    
                });
                $('#hetao-list-su tbody').append(rows);
                var table_su = $("#hetao-list-su").DataTable({
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
                    "order": [[ 2, "desc" ]],
                    "columnDefs": [{
                        "targets": [9],
                        "orderable": false,
                    }],
                    "responsive": {
                        "breakpoints": [
                        { name: 'desktop', width: Infinity},
                        { name: 'tablet',  width: 1024},
                        ],
                        "details": {
                            "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                            "type": 'none',
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
                            "target": ''
                        }
                    },
                });
                $(".searchInput_su").on("keyup", function() {
                    table_su.search(this.value).draw();
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
                    }
                })


                $('select[name="assign"]').on('change', function () {

                    var RWD = $(this).parents('table').parents('tr').find('.child').length;

                    if(RWD == 0){
                        var token = $(this).val()
                        var id = $(this).parents('tr').children('td')[1].textContent 
                        var time = $(this).parents('tr').children('td')[2].textContent 
                        var CUSTKEY = $(this).parents('tr').children('td')[3].textContent 
                        var address = $(this).parents('tr').children('td')[6].textContent 
                        var name = $(this).parents('tr').children('td')[4].textContent 
                        var mobile = $(this).parents('tr').children('td')[5].textContent 
                        var reason = $(this).parents('tr').children('td')[8].textContent 
                        var work_type = $(this).parents('tr').children('td')[9].textContent 
                        var GUI_number = $(this).parents('tr').children('td')[10].textContent
                        var status = $(this).parents('tr').children('td')[11].textContent
                        if(GUI_number == null || GUI_number == ""){
                            var GUI_number = ""
                        }
                    }
                    else if(RWD == 1){
                        var token = $(this).val()
                        var id = $(this).closest('tbody').find("tr:eq(1)").children("td")[1].textContent;
                        var time = $(this).closest('tbody').find("tr:eq(2)").children("td")[1].textContent;
                        var CUSTKEY = $(this).closest('tbody').find("tr:eq(3)").children("td")[1].textContent;
                        var address = $(this).closest('tbody').find("tr:eq(6)").children("td")[1].textContent;
                        var name = $(this).closest('tbody').find("tr:eq(4)").children("td")[1].textContent;
                        var mobile = $(this).closest('tbody').find("tr:eq(5)").children("td")[1].textContent;
                        var reason = $(this).closest('tbody').find("tr:eq(8)").children("td")[1].textContent;
                        var work_type = $(this).closest('tbody').find("tr:eq(9)").children("td")[1].textContent;
                        var GUI_number = $(this).closest('tbody').find("tr:eq(10)").children("td")[1].textContent;
                        var status = $(this).closest('tbody').find("tr:eq(11)").children("td")[1].textContent;
                        if(GUI_number == 'null' || GUI_number == ""){
                            var GUI_number = ""
                        }
                    }

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
                            'case_name':name,
                            'reason': reason,
                            'work_type': work_type,
                            'time': time,
                            'owner_boss': token,
                            'status': status,
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

                    $(this).attr('disabled','disabled')

                })

                //延遲塞
                var timesRun = 0
                var interval = setInterval(function() {
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
                    timesRun += 1;
                    if(timesRun == 3){
                        clearInterval(interval);
                    }
                },1000);
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
                            + "<td>" + item.owner + "</td>"
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
                              rows += `<td hidden> ${itemtt}</td>`
                              + "<td hidden></td>"
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
                            + "<td>" + item.owner + "</td>"
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
                              rows += `<td hidden> ${itemtt}</td>`
                              + "<td hidden>" + item.status + "</td>"
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
                    "order": [[ 1, "desc" ], [ 10, "asc" ]],
                    "columnDefs": [{
                        "targets": [0],
                        "orderable": false,
                    }],
                    "responsive": {
                        "breakpoints": [
                        { name: 'desktop', width: Infinity},
                        { name: 'tablet',  width: 1024},
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

                    var RWD = $(this).parents('table').parents('tr').find('.child').length;

                     if(RWD == 0){
                        var id = $(this).parents('tr').children('td')[1].textContent 
                    }
                    else if(RWD == 1){
                        var id = $(this).closest('tbody').find("tr:eq(1)").children("td")[1].textContent;
                    }

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
                        method:'post',
                        url:'{{ route('ht.StrokeManage.supervisor.updateStatus',['organization'=>$organization]) }}',
                        data:{
                            '_token':'{{csrf_token()}}',
                            "token": '{{Auth::user()->token}}',//'{{Auth::user()->token}}'
                            "id":id,
                            "status":'R',
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
                              if(item.name == null || item.name == '' || item.name == 'null'){
                                rows += "<td></td>"
                            }
                            else{
                                rows += "<td>" + item.name + "</td>"
                            }
                            rows += "<td><a href='tel:"+ item.mobile +"'>"+ item.mobile +"</a></td>"
                            + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' onclick='window.open(this.href); return false;' >" + item.address + "</a></td>"
                            + "<td>" + item.owner + "</td>"
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
                              rows += `<td hidden> ${itemtt}</td>`
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
                    "order": [[ 1, "desc" ], [ 10, "desc" ]],
                    "columnDefs": [{
                        "targets": [0],
                        "orderable": false,
                    }],
                    "responsive": {
                        "breakpoints": [
                        { name: 'desktop', width: Infinity},
                        { name: 'tablet',  width: 1024},
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
<script type="text/javascript">

    //待指派
    $('#searchDate1').on('click',function(){
        var start = $('#startDate1').val()
        var end = $('#endDate1').val()

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
                var Newstart = Date.parse(new Date(start.replace(/-/g, '/')));
                var Newend = Date.parse(new Date(end.replace(/-/g, '/')));

                $('#hetao-list-su').DataTable().destroy();
                $('#hetao-list-su tbody').empty();

                $.each(response.data, function (i, item) {
                    var tt =  'GUI-number'
                    var itemtt = item['GUI-number']

                    if(item.owner == '' || item.owner == null || item.status == 'R'){
                        if(Newend >= Date.parse(new Date(item.time.replace(/-/g, '/'))) && Newstart <= Date.parse(new Date(item.time.replace(/-/g, '/')))){
                            rows += "<tr>"
                                  + "<td><select class='form-control' name='assign' style='margin-right:28px;'><option selected value=''>待指派</option></select></td>"
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
                                + "<td>" + item.owner + "</td>"
                                + "<td>" + item.remarks + "</td>"
                                  if(item.work_type == '維修'){
                                    rows += "<td><span class='color-btn' style='background-color: #e64242'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                                }
                                else if(item.work_type == '洽機'){
                                    rows += "<td><span class='color-btn' style='background-color: #f59d56'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                                }
                                else if(item.work_type == '收款'){
                                    rows += "<td><span class='color-btn' style='background-color: #ffe167'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                                }
                                else if(item.work_type == '送水'){
                                    rows += "<td><span class='color-btn' style='background-color: #91d35c'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                                }
                                else if(item.work_type == '裝機'){
                                    rows += "<td><span class='color-btn' style='background-color: #1bab9f'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                                }
                                else if(item.work_type == '拆機'){
                                    rows += "<td><span class='color-btn' style='background-color: #00c0ff'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                                }
                                else if(item.work_type == '回機'){
                                    rows += "<td><span class='color-btn' style='background-color: #41438f'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                                }
                                else if(item.work_type == '保養'){
                                    rows += "<td><span class='color-btn' style='background-color: #a080c3'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                                }
                                else if(item.work_type == '合約'){
                                    rows += "<td><span class='color-btn' style='background-color: #f73e99'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                                }
                                else if(item.work_type == '其他'){
                                    rows += "<td><span class='color-btn' style='background-color: #a1602c'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                                }
                                else if(item.work_type == '送貨'){
                                    rows += "<td><span class='color-btn' style='background-color: #3f3f3f'>" + item.work_type + "</span><input class='chkall hide' type='checkbox' value='' name='oneforall' /></td>"
                                }
                                  rows += `<td hidden> ${itemtt}</td>`
                                  + "<td hidden>" + item.status + "</td>"
                             + "</tr>";
                        }
                    }
                    
                });
                $('#hetao-list-su tbody').append(rows);
                var table_su = $("#hetao-list-su").DataTable({
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
                    "order": [[ 2, "desc" ]],
                    "columnDefs": [{
                        "targets": [0],
                        "orderable": false,
                    }],
                    "responsive": {
                        "breakpoints": [
                        { name: 'desktop', width: Infinity},
                        { name: 'tablet',  width: 1024},
                        ],
                        "details": {
                            "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                            "type": 'none',
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
                            "target": ''
                        }
                    },
                });
                $(".searchInput_su").on("keyup", function() {
                    table_su.search(this.value).draw();
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
                    }
                })


                $('select[name="assign"]').on('change', function () {

                    var RWD = $(this).parents('table').parents('tr').find('.child').length;

                    if(RWD == 0){
                        var token = $(this).val()
                        var id = $(this).parents('tr').children('td')[1].textContent 
                        var time = $(this).parents('tr').children('td')[2].textContent 
                        var CUSTKEY = $(this).parents('tr').children('td')[3].textContent 
                        var address = $(this).parents('tr').children('td')[6].textContent 
                        var name = $(this).parents('tr').children('td')[4].textContent 
                        var mobile = $(this).parents('tr').children('td')[5].textContent 
                        var reason = $(this).parents('tr').children('td')[8].textContent 
                        var work_type = $(this).parents('tr').children('td')[9].textContent 
                        var GUI_number = $(this).parents('tr').children('td')[10].textContent
                        var status = $(this).parents('tr').children('td')[11].textContent
                        if(GUI_number == null || GUI_number == ""){
                            var GUI_number = ""
                        }
                    }
                    else if(RWD == 1){
                        var token = $(this).val()
                        var id = $(this).closest('tbody').find("tr:eq(1)").children("td")[1].textContent;
                        var time = $(this).closest('tbody').find("tr:eq(2)").children("td")[1].textContent;
                        var CUSTKEY = $(this).closest('tbody').find("tr:eq(3)").children("td")[1].textContent;
                        var address = $(this).closest('tbody').find("tr:eq(6)").children("td")[1].textContent;
                        var name = $(this).closest('tbody').find("tr:eq(4)").children("td")[1].textContent;
                        var mobile = $(this).closest('tbody').find("tr:eq(5)").children("td")[1].textContent;
                        var reason = $(this).closest('tbody').find("tr:eq(8)").children("td")[1].textContent;
                        var work_type = $(this).closest('tbody').find("tr:eq(9)").children("td")[1].textContent;
                        var GUI_number = $(this).closest('tbody').find("tr:eq(10)").children("td")[1].textContent;
                        var status = $(this).closest('tbody').find("tr:eq(11)").children("td")[1].textContent;
                        if(GUI_number == 'null' || GUI_number == ""){
                            var GUI_number = ""
                        }
                    }

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
                            'case_name':name,
                            'reason': reason,
                            'work_type': work_type,
                            'time': time,
                            'owner_boss': token,
                            'status': status,
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

                    $(this).attr('disabled','disabled')

                })

                //延遲塞
                var timesRun = 0;
                var interval = setInterval(function() {
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
                    timesRun += 1;
                    if(timesRun == 3){
                        clearInterval(interval);
                    }
                },1000);
            }
        })
    })

    $('#searchDate2').on('click',function(){

        var start = $('#startDate2').val()
        var end = $('#endDate2').val()

        $.ajax({
            method:'post',
            url:'{{ route('ht.StrokeManage.supervisor.searchAssign',['organization'=>$organization]) }}',
            data:{
                '_token':'{{csrf_token()}}',
                'start':start,
                'end':end,
            },
            dataType:'json',
            success:function(res){

                $.ajax({
                    url:"{{ route('ht.StrokeManage.supervisor.getAssign',['organization'=>$organization]) }}", 
                    method:"get",
                    dataType:'json',                 
                    success:function(data){

                        if(res == ''){
                            alert('沒有符合的資料')
                        }
                        else{
                            var rows;

                            $('#hetao-list-su-2').DataTable().destroy();
                            $('#hetao-list-su-2 tbody').empty();

                            $.each(res, function (i, item) {

                                if(item.status == null || item.status == ''){
                                    rows += "<tr>"
                                    + "<td><select class='form-control' name='assign2' style='margin-right:28px;'>";
                                    for (var j = 0; j < data.length; j++) {
                                        if(data[j].name == item.owner){ 
                                            rows += "<option value="+ data[j].token+" selected>"+data[j].name+"</option>"
                                        }
                                        else{
                                            rows += "<option value="+ data[j].token+">"+data[j].name+"</option>"
                                        }
                                    }
                                    rows += "</select></td>"
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
                                    + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' target='_blank'>"+item.address+"</a></td>"
                                    + "<td>" + item.owner + "</td>"
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
                                    rows += "<td hidden>" + item.GUI_number + "</td>"
                                    + "<td>執行中</td>"
                                    + "</tr>";                       
                                }
                                else if(item.status == 'R'){
                                    rows += "<tr>"
                                    + "<td><select class='form-control' name='assign2' style='margin-right:28px;'>";
                                    for (var j = 0; j < data.length; j++) {
                                        if(data[j].name == item.owner){ 
                                            rows += "<option value="+ data[j].token+" selected>"+data[j].name+"</option>"
                                        }
                                        else{
                                            rows += "<option value="+ data[j].token+">"+data[j].name+"</option>"
                                        }
                                    }
                                    rows += "</select></td>"
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
                                    + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' target='_blank'>"+item.address+"</a></td>"
                                    + "<td>" + item.owner + "</td>"
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
                                    rows += "<td hidden>" + item.GUI_number + "</td>"
                                    + "<td style='color:#DAA520'>轉單</td>"
                                    + "</tr>";                           
                                }
                                else if(item.status == 'F'){
                                    rows += "<tr>"
                                    + "<td><select class='form-control' name='assign2' style='margin-right:28px;'>";
                                    for (var j = 0; j < data.length; j++) {
                                        if(data[j].name == item.owner){ 
                                            rows += "<option value="+ data[j].token+" selected>"+data[j].name+"</option>"
                                        }
                                        else{
                                            rows += "<option value="+ data[j].token+">"+data[j].name+"</option>"
                                        }
                                    }
                                    rows += "</select></td>"
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
                                    + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' target='_blank'>"+item.address+"</a></td>"
                                    + "<td>" + item.owner + "</td>"
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
                                    rows += "<td hidden>" + item.GUI_number + "</td>"
                                    + "<td style='color:red'>延後</td>"
                                    + "</tr>";                           
                                }
                                else{
                                    rows += "<tr>"
                                    + "<td><select class='form-control' name='assign2' style='margin-right:28px;'>";
                                    + "<option value='' selected disabled>已完成</option>"
                                    rows += "</select></td>"
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
                                    + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' target='_blank'>"+item.address+"</a></td>"
                                    + "<td>" + item.owner + "</td>"
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
                                    rows += "<td hidden>" + item.GUI_number + "</td>"
                                    + "<td style='color:green'>已完成</td>"
                                    + "</tr>";                         
                                }
                            });
                            $('#hetao-list-su-2 tbody').append(rows);
                            var table_a = $("#hetao-list-su-2").DataTable({
                                "bPaginate": true,
                                "searching": true,
                                "info": false,
                                "bLengthChange": false,
                                "bServerSide": false,
                                "language": {
                                    "search": "",
                                    "searchPlaceholder": "請輸入關鍵字",
                                    "paginate": { "previous": "上一頁", "next": "下一頁" },
                                    "emptyTable":     "目前無已指派工單",
                                    "zeroRecords":    "沒有符合的搜尋結果",
                                },
                                "dom": "Bfrtip",
                                "buttons": [{
                                    "extend": 'colvis',
                                    "collectionLayout": 'fixed two-column'
                                }],
                                "order": [[2,'desc'],[1,'asc']],
                                "columnDefs": [{
                                    "targets": [0],
                                    "orderable": false,
                                }],
                                "responsive": {
                                    "breakpoints": [
                                    { name: 'desktop', width: Infinity},
                                    { name: 'tablet',  width: 1024},
                                    ],
                                    "details": {
                                        "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                                        "type": 'none',
                                        renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
                                        "target": ''
                                    }
                                },
                            });
                            $(".searchInput_su2").on("keyup", function() {
                                table_a.search(this.value).draw();
                            });

                            $('select[name="assign2"]').on('change', function () {

                                var RWD = $(this).parents('table').parents('tr').find('.child').length;

                                if(RWD == 0){
                                    var token = $(this).val()
                                    var id = $(this).parents('tr').children('td')[1].textContent 
                                    var time = $(this).parents('tr').children('td')[2].textContent 
                                    var CUSTKEY = $(this).parents('tr').children('td')[3].textContent 
                                    var address = $(this).parents('tr').children('td')[6].textContent 
                                    var name = $(this).parents('tr').children('td')[4].textContent 
                                    var mobile = $(this).parents('tr').children('td')[5].textContent 
                                    var reason = $(this).parents('tr').children('td')[8].textContent 
                                    var work_type = $(this).parents('tr').children('td')[9].textContent 
                                    var GUI_number = $(this).parents('tr').children('td')[10].textContent
                                    var status = $(this).parents('tr').children('td')[11].textContent
                                    if(GUI_number == 'null' || GUI_number == ""){
                                        var GUI_number = ""
                                    }
                                }
                                else if(RWD == 1){
                                    var token = $(this).val()
                                    var id = $(this).closest('tbody').find("tr:eq(1)").children("td")[1].textContent;
                                    var time = $(this).closest('tbody').find("tr:eq(2)").children("td")[1].textContent;
                                    var CUSTKEY = $(this).closest('tbody').find("tr:eq(3)").children("td")[1].textContent;
                                    var address = $(this).closest('tbody').find("tr:eq(6)").children("td")[1].textContent;
                                    var name = $(this).closest('tbody').find("tr:eq(4)").children("td")[1].textContent;
                                    var mobile = $(this).closest('tbody').find("tr:eq(5)").children("td")[1].textContent;
                                    var reason = $(this).closest('tbody').find("tr:eq(8)").children("td")[1].textContent;
                                    var work_type = $(this).closest('tbody').find("tr:eq(9)").children("td")[1].textContent;
                                    var GUI_number = $(this).closest('tbody').find("tr:eq(10)").children("td")[1].textContent;
                                    var status = $(this).closest('tbody').find("tr:eq(11)").children("td")[1].textContent;
                                    if(GUI_number == 'null' || GUI_number == ""){
                                        var GUI_number = ""
                                    }
                                }

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
                                        'case_name':name,
                                        'reason': reason,
                                        'work_type': work_type,
                                        'time': time,
                                        'owner_boss': token,
                                        'status': status,
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

                                $(this).attr('disabled','disabled')

                            })
                        }
                    }
                })
            }
        })
    })

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
                                + "<td>" + item.owner + "</td>"
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
                                  rows += `<td hidden> ${itemtt}</td>`
                                  + "<td hidden></td>"
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
                                + "<td>" + item.owner + "</td>"
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
                                  rows += `<td hidden> ${itemtt}</td>`
                                  + "<td hidden>" + item.status + "</td>"
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
                    "order": [[ 1, "desc" ], [ 10, "asc" ]],
                    "columnDefs": [{
                        "targets": [0],
                        "orderable": false,
                    }],
                    "responsive": {
                        "breakpoints": [
                        { name: 'desktop', width: Infinity},
                        { name: 'tablet',  width: 1024},
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

                    var RWD = $(this).parents('table').parents('tr').find('.child').length;

                    if(RWD == 0){
                        var id = $(this).parents('tr').children('td')[1].textContent 
                    }
                    else if(RWD == 1){
                        var id = $(this).closest('tbody').find("tr:eq(1)").children("td")[1].textContent;
                    }

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
                        method:'post',
                        url:'{{ route('ht.StrokeManage.supervisor.updateStatus',['organization'=>$organization]) }}',
                        data:{
                            '_token':'{{csrf_token()}}',
                            "token": '{{Auth::user()->token}}',//'{{Auth::user()->token}}'
                            "id":id,
                            "status":'R',
                            "DEPT": '{{Auth::user()->department->name}}' //'{{Auth::user()->department_id}}'
                        },
                        dataType:'json',                 
                        success:function(res){
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

    $('#searchDate4').on('click',function(){

        var start = $('#startDate4').val()
        var end = $('#endDate4').val()

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
                                + "<td>" + item.owner + "</td>"
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
                                  rows += `<td hidden> ${itemtt}</td>`
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
                    "order": [[ 1, "desc" ], [ 10, "desc" ]],
                    "columnDefs": [{
                        "targets": [0],
                        "orderable": false,
                    }],
                    "responsive": {
                        "breakpoints": [
                        { name: 'desktop', width: Infinity},
                        { name: 'tablet',  width: 1024},
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
            }
        })
    })
</script>
<script type="text/javascript">
    $('#allFinish').on('click',function(){

        
        var page = $(this).parents("#viewers-tab-01").children("#hetao-list-su_wrapper").children("table").children("tbody").children('.child').find('input[name="oneforall"]:checked').length

        if(page == 0){
            if (confirm('是否全部指派？') == true) {

                var count = 0
                $('input[name="oneforall"]:checked').each(function(){

                    var token = $("select[name='sel1']").val()

                    var id = $(this).parents('tr').children('td')[1].textContent 
                    var time = $(this).parents('tr').children('td')[2].textContent 
                    var CUSTKEY = $(this).parents('tr').children('td')[3].textContent 
                    var address = $(this).parents('tr').children('td')[6].textContent 
                    var name = $(this).parents('tr').children('td')[4].textContent 
                    var mobile = $(this).parents('tr').children('td')[5].textContent 
                    var reason = $(this).parents('tr').children('td')[8].textContent 
                    var work_type = $(this).parents('tr').children('td')[9].textContent 
                    var GUI_number = $(this).parents('tr').children('td')[10].textContent
                    var status = $(this).parents('tr').children('td')[11].textContent
                    if(GUI_number == null || GUI_number == ""){
                        var GUI_number = ""
                    }

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
                            'case_name' : name,
                            'reason': reason,
                            'work_type': work_type,
                            'time': time,
                            'owner_boss': token,
                            'status':status,
                        },
                        dataType:'json',                 
                        success:function(res){
                            if(res.status == 200 && count == 0){
                                count += 1;
                                alert('工單更新成功,已指派');
                            }
                            else{
                            }
                        }
                    })
                });
            }
        }
        else{
            if (confirm('是否全部指派？') == true) {

                var count = 0
                $(this).parents("#viewers-tab-01").children("#hetao-list-su_wrapper").children("table").children("tbody").children('.child').find('input[name="oneforall"]:checked').each(function(){ 

                    var token = $("select[name='sel1']").val()

                    var id = $(this).closest('tbody').find("tr:eq(1)").children("td")[1].textContent;
                    var time = $(this).closest('tbody').find("tr:eq(2)").children("td")[1].textContent;
                    var CUSTKEY = $(this).closest('tbody').find("tr:eq(3)").children("td")[1].textContent;
                    var address = $(this).closest('tbody').find("tr:eq(6)").children("td")[1].textContent;
                    var name = $(this).closest('tbody').find("tr:eq(4)").children("td")[1].textContent;
                    var mobile = $(this).closest('tbody').find("tr:eq(5)").children("td")[1].textContent;
                    var reason = $(this).closest('tbody').find("tr:eq(8)").children("td")[1].textContent;
                    var work_type = $(this).closest('tbody').find("tr:eq(9)").children("td")[1].textContent;
                    var GUI_number = $(this).closest('tbody').find("tr:eq(10)").children("td")[1].textContent;
                    var status = $(this).closest('tbody').find("tr:eq(11)").children("td")[1].textContent;
                    if(GUI_number == 'null' || GUI_number == ""){
                        var GUI_number = ""
                    }

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
                            'case_name' :name,
                            'reason': reason,
                            'work_type': work_type,
                            'time': time,
                            'owner_boss': token,
                            'status':status,
                        },
                        dataType:'json',                 
                        success:function(res){
                            if(res.status == 200 && count == 0){
                                count += 1;
                                alert('工單更新成功,已指派');
                            }
                            else{
                            }
                        }
                    })
                });
            }
        }
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
        console.log(e)
        $('#ED2').data("DateTimePicker").minDate(e.date);
    });
    $("#ED2").on("dp.change", function (e) {
        $('#SD2').data("DateTimePicker").maxDate(e.date);
    });

    $("#SD3").on("dp.change", function (e) {
        console.log(e)
        $('#ED3').data("DateTimePicker").minDate(e.date);
    });
    $("#ED3").on("dp.change", function (e) {
        $('#SD3').data("DateTimePicker").maxDate(e.date);
    });

    $("#SD4").on("dp.change", function (e) {
        console.log(e)
        $('#ED4').data("DateTimePicker").minDate(e.date);
    });
    $("#ED4").on("dp.change", function (e) {
        $('#SD4').data("DateTimePicker").maxDate(e.date);
    });
</script>
<script type="text/javascript">
    $('a[data-toggle="tab"]').on('click',function(){
        var name = $(this).context.name;
        var path = $(this).context.pathname;
        //var page = location.href;
        window.location.href = path+"?tab="+name+""
    })
</script>
@endsection