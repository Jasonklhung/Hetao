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
                                            <i class="far fa-list-alt"></i>全站工單
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <!-- tab標籤 -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-01">線上預約</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-02">待指派工單</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-03">已指派工單</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 線上預約 -->
                                                    <div class="tab-pane active" id="viewers-tab-01">
                                                        <div class='coupon'>
                                                            <form class='form-inline'>
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s1" placeholder="請輸入關鍵字">
                                                                <select name="" class="form-control mb-s mr-s">
                                                                    <option value="">所有狀態</option>
                                                                </select>
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="button">查詢</button>
                                                                    <button class='mr-s' type="button">重設</button>
                                                                    <!-- <div class='batchwrap'>
                                                                        <div class='form-group mr-s hide batch-select'><select class='form-control' id='sel1'>
                                                                                <option selected hidden disabled>請指派負責主管</option>
                                                                                <option>Ricky</option>
                                                                                <option>Eva</option>
                                                                                <option>Apple</option>
                                                                                <option>Banana</option>
                                                                            </select></div>
                                                                        <button type='button' class='btn-bright hide batch-finish'>完成</button><label for='chkall' class='sall'>全選</label><input id='chkall' type='checkbox' value='' />
                                                                        <button type='button' class='btn-bright batch' type="button">批次指派</button>
                                                                    </div> -->
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <table class="table table-hover dt-responsive table-striped W-100" id="hetao-list-s-1">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">預約日期</th>
                                                                    <th class="desktop">狀態</th>
                                                                    <th class="desktop">查看</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($reservation as $key => $data)
                                                                <tr>
                                                                    <td>{{ $data->cuskey }}</td>
                                                                    <td>{{ $data->created_at }}</td>
                                                                    @if($data->views == 'Y')
                                                                    <td><span class="text-success text-nowrap">已查看</span></td> 
                                                                    @else
                                                                    <td><span class="text-danger text-nowrap">未查看</span></td> 
                                                                    @endif
                                                                    <td><button type='button' class='btn status' onclick="javascript:location.href='{{ route('ht.StrokeManage.supervisor.show',['organization'=>$organization,'id'=>base64_encode($data->id)]) }}'">查看</button></td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- 待指派工單 -->
                                                    <div class="tab-pane" id="viewers-tab-02">
                                                        <div class='coupon'>
                                                            <form class='form-inline'>
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
                                                                <div class='form-group mr-s'><select class='form-control'>
                                                                        <option selected>派工類型</option>
                                                                        <option>--</option>
                                                                    </select></div>
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="button">查詢</button>
                                                                    <button class='mr-s' type="button">重設</button>
                                                                    <div class="droptool mr-s">
                                                                        <button class="btn btn-gray" type="button"><i class="fas fa-cog"></i>
                                                                        </button>
                                                                        <ul class="droptool-menu">
                                                                            <li>
                                                                                <input class="d-none" id='chkall1' type='checkbox' value='' /><label for='chkall1' class='sall'></label>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <select class='form-control' id='sel1'>
                                                                                    <option value="" selected disabled>請指派負責人</option>
                                                                                    @foreach($deptUser as $key =>$data)
                                                                                    <option value="{{ $data['id'] }}">{{ $data['name'] }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </li>
                                                                            <li><a class="btn btn-bright m-0" data-toggle="modal" data-target="#op-alert" href="#">批次指派</a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <!-- <div class='batchwrap'>
                                                                        <div class='form-group mr-s hide batch-select'><select class='form-control' id='sel1'>
                                                                                <option selected hidden disabled>請指派負責主管</option>
                                                                                <option>Ricky</option>
                                                                                <option>Eva</option>
                                                                                <option>Apple</option>
                                                                                <option>Banana</option>
                                                                            </select></div>
                                                                        <button type='button' class='btn-bright hide batch-finish'>完成</button><label for='chkall' class='sall'>全選</label><input id='chkall' type='checkbox' value='' />
                                                                        <button type='button' class='btn-bright batch' type="button">批次指派</button>
                                                                    </div> -->
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-s-2">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop"></th>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">地址</th>
                                                                    <th class="desktop">電話</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th class="desktop">狀態</th>
                                                                    <th class="desktop">負責人</th>
                                                                    <th class="desktop"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($NotAssignArray as $key => $data)
                                                                <tr>
                                                                    <td>
                                                                        <div class="td-icon">
                                                                            <input class="chkall" name="NotAssignId" type="checkbox" value="{{ $data->id }}">
                                                                        </div>
                                                                    </td>
                                                                    <td>{{ $data->id }}</td>
                                                                    <td>{{ $data->time }}</td>
                                                                    <td>{{ $data->CUSTKEY }}</td>
                                                                    <td>{{ $data->name }}</td>
                                                                    <td>{{ $data->address }}</td>
                                                                    <td>{{ $data->mobile }}</td>
                                                                    <td>{{ $data->remarks }}</td>
                                                                    <td>{{ $data->work_type }}</td>
                                                                    @if($data->status == 'T')
                                                                    <td>已完成</td>
                                                                    @elseif($data->status == 'F')
                                                                    <td>延遲</td>
                                                                    @elseif($data->status == 'R')
                                                                    <td>轉單</td>
                                                                    @elseif($data->status == null)
                                                                    <td></td>
                                                                    @else
                                                                    <td></td>
                                                                    @endif
                                                                    <td>{{ $data->owner }}</td>
                                                                    <td></td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- 已指派工單 -->
                                                    <div class="tab-pane" id="viewers-tab-03">
                                                        <div class='coupon'>
                                                            <form class='form-inline'>
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s3" placeholder="請輸入關鍵字">
                                                                <div class='form-group mr-s'>
                                                                    <select class='form-control'>
                                                                        <option selected>所有狀態</option>
                                                                        <option>執行中</option>
                                                                        <option>延後</option>
                                                                        <option>已完成</option>
                                                                    </select>
                                                                </div>
                                                                <div class='form-group mr-s'>
                                                                    <select class='form-control'>
                                                                        <option selected>派工類型</option>
                                                                        <option>--</option>
                                                                    </select>
                                                                </div>
                                                                <div class='form-group mr-s'>
                                                                    <select class='form-control'>
                                                                        <option selected>負責員工</option>
                                                                        <option>--</option>
                                                                    </select>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="button">查詢</button>
                                                                    <button class='mr-s' type="button">重設</button>
                                                                    <div class="droptool mr-s">
                                                                        <button class="btn btn-gray" type="button"><i class="fas fa-cog"></i>
                                                                        </button>
                                                                        <ul class="droptool-menu">
                                                                            <li>
                                                                                <input class="d-none" id='chkall2' type='checkbox' value='' /><label for='chkall2' class='sall'></label>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <select class='form-control' id='sel2'>
                                                                                    <option value="" selected disabled>請指派負責人</option>
                                                                                    @foreach($deptUser as $key =>$data)
                                                                                    <option value="{{ $data['id'] }}">{{ $data['name'] }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </li>
                                                                            <li><a class="btn btn-bright m-0" data-toggle="modal" data-target="#op-alert" href="#">批次指派</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-s-3">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop"></th>
                                                                    <th class="desktop">負責員工</th>
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
                                                                @foreach($assignCaseArray as $key=> $data)
                                                                <tr>
                                                                    <td><div class="td-icon">
                                                                            <input class="chkall" type="checkbox" value="{{ $data->id }}">
                                                                        </div>
                                                                    </td>
                                                                    <td></td>
                                                                    <td>1233456</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
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

        <!-- Modal-alert -->
        <div class="modal fade" id="op-alert" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-none">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body text-center"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="NotAssign">確認</button>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
<script>
    var table_s1 = $("#hetao-list-s-1").DataTable({
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
    $(".searchInput_s1").on("blur", function() {
        table_s1.search(this.value).draw();
    });

    $(".searchInput_s1").on("keyup", function() {
        table_s1.search(this.value).draw();
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
            "targets": [0, 11],
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
    $(".searchInput_s3").on("blur", function() {
        table_s3.search(this.value).draw();
    });

    $(".searchInput_s3").on("keyup", function() {
        table_s3.search(this.value).draw();
    });


    $(".droptool button").on('click', function() {
        $(this).parents('.droptool').siblings('.droptool .droptool-menu').hide();
        $(this).siblings('.droptool-menu').toggle('hide', false);
        if (!$(this).parent().hasClass('no-fixed')) {
            $(this).parents('.tab-pane').find('.td-icon .chkall').toggle('show');
        }
    });

    // modal-alert
    $('a[data-target="#op-alert"]').on('click', function() {
        var text = $(this).text()
        var checked = $("input.chkall")
        if ($(this).parents('.tab-pane').find(checked).filter(":checked").length >= 1) {
            $('#op-alert .modal-body').html(`
                <p>確定要` + text + `所選案件嗎？</p>
            `)
        } else {
            $('#op-alert .modal-body').html(`
                <p>您沒有選取案件唷！</p>
            `)
        }
    });
    </script>
    <script type="text/javascript">
        $('#NotAssign').on('click',function(){

            var count = 0

            $('input[name="NotAssignId"]:checked').each(function(){

                 var id = $(this).val()
                 var owner = $('#sel1').val();

                 $.ajax({
                    type:'post',
                    url:"{{ route('ht.StrokeManage.supervisor.assignOwner',['organization'=>$organization]) }}",
                    data:{
                        '_token':'{{csrf_token()}}',
                        'id':id,
                        'owner':owner
                    },
                    success:function(res){
                        if(res.status == 200 && count == 0){
                            count += 1;
                            alert('工單已指派');
                            window.location = '{{ route('ht.StrokeManage.supervisor.index',['organization'=>$organization]) }}'
                        }
                        else if(res.status == 400 && count == 0){
                            count += 1;
                            alert('工單更新失敗');
                        }
                    }
                 })
            })
        })
    </script>
@endsection