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
                                            <i class="far fa-list-alt"></i>工單進度
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <div class='coupon'>
                                                    <form class='form-inline' id="caseSearch">
                                                        @csrf
                                                        <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
                                                        <select class="form-control mb-s mr-s" name="status" id="status">
                                                            <option selected value="">所有狀態</option>
                                                            <option value="F">延後</option>
                                                            <option value="R">轉單</option>
                                                            <option value="T">完成</option>
                                                        </select>
                                                        <select class="form-control mb-s mr-s" name="type" id="type">
                                                            <option selected value="">派工類型</option>
                                                            <option value="維修">維修</option>
                                                            <option value="洽機">洽機</option>
                                                            <option value="收款">收款</option>
                                                            <option value="送水">送水</option>
                                                            <option value="裝機">裝機</option>
                                                            <option value="拆機">拆機</option>
                                                            <option value="回機">回機</option>
                                                            <option value="保養">保養</option>
                                                            <option value="合約">合約</option>
                                                            <option value="其他">其他</option>
                                                            <option value="送貨">送貨</option>
                                                        </select>
                                                        <select class="form-control mb-s mr-s" name="staff" id="staff">
                                                            <option selected value="">負責員工</option>
                                                            @foreach($deptUser as $key => $data)
                                                            <option value="{{ $data['name']}}">{{ $data['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class='form-group'>
                                                            <div class='datetime'>
                                                                <div class='input-group date date-select'>
                                                                    <input class='form-control' placeholder='選擇起始日期' type='text' name="start" id="start"> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                            </div><span class='rwd-hide'>~</span>
                                                            <div class='datetime'>
                                                                <div class='input-group date date-select mr-s'>
                                                                    <input class='form-control' placeholder='選擇結束日期' type='text' name="end" id="end"> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='btn-wrap'>
                                                            <button class='mr-s' type="submit">查詢</button>
                                                            <button class='mr-s' type="button" id="reset">重設</button>
                                                        </div>
                                                    </form>
                                                </div>                                       
                                                <table class="table table-hover dt-responsive table-striped" id="hetao-list-s-2">
                                                    <thead class="rwdhide">
                                                        <tr>
                                                            <th class="desktop">負責員工</th>
                                                            <th class="desktop">工單編號</th>
                                                            <th class="desktop">工單日期</th>
                                                            <th class="desktop">客戶代碼</th>
                                                            <th class="desktop">承辦人員</th>
                                                            <th class="desktop">聯絡電話</th>
                                                            <th class="desktop">聯絡地址</th>
                                                            <th class="desktop">統一編號</th>
                                                            <th class="desktop">派工原因</th>
                                                            <th class="desktop">派工類型</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($allCase as $key => $data)
                                                        <tr>
                                                            <td>{{ $data->owner }}</td>
                                                            <td>{{ $data->case_id }}</td>
                                                            <td>{{ $data->time }}</td>
                                                            <td>{{ $data->cuskey }}</td>
                                                            <td>{{ $data->name }}</td>
                                                            <td><a href="tel:{{ $data->mobile }}">{{ $data->mobile }}</a></td>
                                                            <td><a href="https://www.google.com.tw/maps/place/{{ $data->address }}" target="_blank">{{ $data->address }}</a></td>
                                                            <td>{{ $data->GUI_number }}</td>
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

</script>
<script type="text/javascript">
    $('#caseSearch').on('submit',function(e){

            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type:'post',
                url:"{{ route('ht.StrokeManage.assistant.caseSearch',['organization'=>$organization]) }}",
                data:formData,
                success:function(res){

                    var rows;

                    $('#hetao-list-s-2').DataTable().destroy();
                    $('#hetao-list-s-2 tbody').empty();

                    $.each(res, function (i, item) {     
                       
                        rows += "<tr>"
                        + "<td>" + item.owner + "</td>"
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
                        + "<td>" + item.GUI_number + "</td>"
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
                        rows += "</tr>"
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
        $('#status').val("")
        $('#staff').val("")
        $('#type').val("")
    })
</script>
@endsection