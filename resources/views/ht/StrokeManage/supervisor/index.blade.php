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
                                                            <form class='form-inline' id="onlineSearch">
                                                                @csrf
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s1" placeholder="請輸入關鍵字">
                                                                <select class="form-control mb-s mr-s" name="status" id="status">
                                                                    <option value="">所有狀態</option>
                                                                    <option value="Y">已查看</option>
                                                                    <option value="N">未查看</option>
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
                                                            <form class='form-inline' id="notAssignSearch">
                                                                @csrf
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
                                                                <div class='form-group mr-s'><select class='form-control' name="type" id="type">
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
                                                                    </select></div>
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text' name="start" id="start2"> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' type='text' name="end" id="end2"> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="submit">查詢</button>
                                                                    <button class='mr-s' type="button" id="reset2">重設</button>
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
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-s-2">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop"></th>
                                                                    <th class="desktop">指派員工</th>
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
                                                                    <td>
                                                                        <select name="assign" class="form-control" style="margin-right:28px;">
                                                                            <option value="">選擇員工</option>
                                                                        @foreach($deptUser as $res)
                                                                            <option value="{{ $res['id'] }}">{{ $res['name'] }}</option>
                                                                        @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td>{{ $data->id }}</td>
                                                                    <td class="text-nowrap">{{ $data->time }}</td>
                                                                    <td>{{ $data->CUSTKEY }}</td>
                                                                    <td>{{ $data->name }}</td>
                                                                    <td><a href="https://www.google.com.tw/maps/place/{{ $data->address }}" target="_blank">{{ $data->address }}</a></td>
                                                                    <td class="text-nowrap"><a href="tel:{{ $data->mobile }}">{{ $data->mobile }}</a></td>
                                                                    <td>{{ $data->remarks }}</td>
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
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- 已指派工單 -->
                                                    <div class="tab-pane" id="viewers-tab-03">
                                                        <div class='coupon'>
                                                            <form class='form-inline' id="assignCaseSearch">
                                                                @csrf
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s3" placeholder="請輸入關鍵字">
                                                                <div class='form-group mr-s'>
                                                                    <select class='form-control' name="status" id="status2">
                                                                        <option selected value="">所有狀態</option>
                                                                        <option value="F">延後</option>
                                                                        <option value="R">轉單</option>
                                                                        <option value="T">完成</option>
                                                                    </select>
                                                                </div>
                                                                <div class='form-group mr-s'>
                                                                    <select class='form-control' name="type" id="type2">
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
                                                                </div>
                                                                <div class='form-group mr-s'>
                                                                    <select class='form-control' name="staff" id="staff">
                                                                        <option selected value="">負責員工</option>
                                                                        @foreach($deptUser as $key => $data)
                                                                        <option value="{{ $data['name']}}">{{ $data['name'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text' name="start" id="start3"> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' type='text' name="end" id="end3"> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="submit">查詢</button>
                                                                    <button class='mr-s' type="button" id="reset3">重設</button>
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
                                                                            <li><a class="btn btn-bright m-0" data-toggle="modal" data-target="#op-alert2" href="#">批次指派</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-s-3">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop"></th>
                                                                    <th class="desktop">指派員工</th>
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
                                                                            <input class="chkall" name="AssignId" type="checkbox" value="{{ $data->case_id }}">
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <select name="assign2" class="form-control" style="margin-right:28px;">
                                                                         @foreach($deptUser as $res)
                                                                            @if($res['name'] == $data->owner)
                                                                            <option selected value="{{ $res['id'] }}" >{{ $res['name'] }}</option>
                                                                            @else
                                                                            <option value="{{ $res['id'] }}">{{ $res['name'] }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                        </select>
                                                                    </td>
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
                                                                    @elseif($data->status == 'F')
                                                                    <td>延遲</td>
                                                                    @elseif($data->status == 'R')
                                                                    <td>轉單</td>
                                                                    @else
                                                                    <td></td>
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

        <div class="modal fade" id="op-alert2" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-none">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body text-center"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="Assign">確認</button>
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

    $('a[data-target="#op-alert2"]').on('click', function() {
        var text = $(this).text()
        var checked = $("input.chkall")
        if ($(this).parents('.tab-pane').find(checked).filter(":checked").length >= 1) {
            $('#op-alert2 .modal-body').html(`
                <p>確定要` + text + `所選案件嗎？</p>
            `)
        } else {
            $('#op-alert2 .modal-body').html(`
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
                            alert('工單指派失敗');
                        }
                    }
                 })
            })
        })

        $('#Assign').on('click',function(){

            var count = 0

            $('input[name="AssignId"]:checked').each(function(){

                 var id = $(this).val()
                 var owner = $('#sel2').val();

                 $.ajax({
                    type:'post',
                    url:"{{ route('ht.StrokeManage.supervisor.assignOwnerAgain',['organization'=>$organization]) }}",
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
                            alert('工單指派失敗');
                        }
                    }
                 })
            })
        })

        $('select[name="assign"]').on('change',function(){

            var owner = $(this).val()
            var id = $(this).parents('tr').children('td')[2].textContent 
            
            $.ajax({
                type:'post',
                url:"{{ route('ht.StrokeManage.supervisor.assignOwner',['organization'=>$organization]) }}",
                data:{
                    '_token':'{{csrf_token()}}',
                    'id':id,
                    'owner':owner
                },
                success:function(res){
                    if(res.status == 200){
                        alert('工單已指派');
                        window.location = '{{ route('ht.StrokeManage.supervisor.index',['organization'=>$organization]) }}'
                    }
                    else if(res.status == 400){
                        alert('工單指派失敗');
                    }
                }
            })
        })

        $('select[name="assign2"]').on('change',function(){

            var owner = $(this).val()
            var id = $(this).parents('tr').children('td')[2].textContent 
            
            $.ajax({
                type:'post',
                url:"{{ route('ht.StrokeManage.supervisor.assignOwnerAgain',['organization'=>$organization]) }}",
                data:{
                    '_token':'{{csrf_token()}}',
                    'id':id,
                    'owner':owner
                },
                success:function(res){
                    if(res.status == 200){
                        alert('工單已指派');
                        window.location = '{{ route('ht.StrokeManage.supervisor.index',['organization'=>$organization]) }}'
                    }
                    else if(res.status == 400){
                        alert('工單指派失敗');
                    }
                }
            })
        })
    </script>
    <script type="text/javascript">
        $('#onlineSearch').on('submit',function(e){

            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type:'post',
                url:"{{ route('ht.StrokeManage.supervisor.onlineSearch',['organization'=>$organization]) }}",
                data:formData,
                success:function(res){

                    var rows;

                    $('#hetao-list-s-1').DataTable().destroy();
                    $('#hetao-list-s-1 tbody').empty();

                    $.each(res, function (i, item) {

                        var url = '{{ route('ht.StrokeManage.supervisor.show',['organization'=>$organization,'id'=>'id']) }}'
                        url = url.replace('id',btoa(item.id));


                        rows += "<tr>"
                             + "<td>" + item.cuskey + "</td>"
                             + "<td>" + item.created_at + "</td>"
                        if(item.views == 'Y'){
                            rows += "<td><span class='text-success text-nowrap'>已查看</span></td> "
                        }
                        else{
                            rows += "<td><span class='text-danger text-nowrap'>未查看</span></td> "
                        }
                        rows += "<td><a href="+url+"><button type='button' class='btn status'>查看</button></a></td>"
                        + "</tr>"
                       
                    })
                    $('#hetao-list-s-1 tbody').append(rows);
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
                },
                cache: false,
                contentType: false,
                processData: false
            })
        })

        $('#notAssignSearch').on('submit',function(e){

            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type:'post',
                url:"{{ route('ht.StrokeManage.supervisor.notAssignSearch',['organization'=>$organization]) }}",
                data:formData,
                success:function(res){

                    var rows;

                    $('#hetao-list-s-2').DataTable().destroy();
                    $('#hetao-list-s-2 tbody').empty();

                    $.each(res[0], function (i, item) {

                        rows += "<tr>"
                            + "<td>"
                            + "<div class='td-icon'>"
                            + "<input class='chkall' name='NotAssignId' type='checkbox' value="+item.id+">"
                            + "</div>"
                            + "</td>"
                            + "<td>"
                            + "<select name='assign' class='form-control' style='margin-right:28px;'>"
                            + " <option value=''>選擇員工</option>"
                            for (var j = 0; j < res[1].length; j++) {
                                rows += "<option value="+ res[1][j].id+">"+res[1][j].name+"</option>"
                            }
                            rows += "</select></td>"
                            + "<td>" + item.id + "</td>"
                            + "<td class='text-nowrap'>" + item.time + "</td>"
                            + "<td>" + item.CUSTKEY + "</td>"
                            if(item.name == null || item.name == '' || item.name == 'null'){
                                rows += "<td></td>"
                            }
                            else{
                                rows += "<td>" + item.name + "</td>"
                            }
                            rows += "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' target='_blank'>"+item.address+"</a></td>"
                                 + "<td class='text-nowrap'><a href='tel:"+ item.mobile +"'>"+ item.mobile +"</a></td>"
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
                            if(item.status == 'R'){
                                rows += "<td>轉單</td>"
                            }
                            else if(item.status == 'T'){
                                rows += "<td>完成</td>"
                            }
                            else if(item.status == 'F'){
                                rows += "<td>延遲</td>"
                            }
                            else{
                                rows += "<td></td>"
                            }
                            rows += "<td>" + item.owner + "</td>"
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

                    $('select[name="assign"]').on('change',function(){

                        var owner = $(this).val()
                        var id = $(this).parents('tr').children('td')[2].textContent 

                        $.ajax({
                            type:'post',
                            url:"{{ route('ht.StrokeManage.supervisor.assignOwner',['organization'=>$organization]) }}",
                            data:{
                                '_token':'{{csrf_token()}}',
                                'id':id,
                                'owner':owner
                            },
                            success:function(res){
                                if(res.status == 200){
                                    alert('工單已指派');
                                    window.location = '{{ route('ht.StrokeManage.supervisor.index',['organization'=>$organization]) }}'
                                }
                                else if(res.status == 400){
                                    alert('工單指派失敗');
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
                url:"{{ route('ht.StrokeManage.supervisor.assignCaseSearch',['organization'=>$organization]) }}",
                data:formData,
                success:function(res){

                    var rows;

                    $('#hetao-list-s-3').DataTable().destroy();
                    $('#hetao-list-s-3 tbody').empty();

                    $.each(res[0], function (i, item) {

                        rows += "<tr>"
                            + "<td>"
                            + "<div class='td-icon'>"
                            + "<input class='chkall' name='AssignId' type='checkbox' value="+item.id+">"
                            + "</div>"
                            + "</td>"
                            + "<td>"
                            + "<select name='assign2' class='form-control' style='margin-right:28px;'>"
                            for (var j = 0; j < res[1].length; j++) {
                                if(res[1][j].name == item.owner){ 
                                    rows += "<option value="+ res[1][j].id+" selected>"+res[1][j].name+"</option>"
                                }
                                else{
                                    rows += "<option value="+ res[1][j].id+">"+res[1][j].name+"</option>"
                                }
                            }
                            rows += "</select></td>"
                            + "<td>" + item.case_id + "</td>"
                            + "<td class='text-nowrap'>" + item.time + "</td>"
                            + "<td>" + item.cuskey + "</td>"
                            if(item.name == null || item.name == '' || item.name == 'null'){
                                rows += "<td></td>"
                            }
                            else{
                                rows += "<td>" + item.name + "</td>"
                            }
                            rows += "<td class='text-nowrap'><a href='tel:"+ item.mobile +"'>"+ item.mobile +"</a></td>"
                                 + "<td><a href='https://www.google.com.tw/maps/place/"+item.address+"' target='_blank'>"+item.address+"</a></td>"
                                 + "<td>"+ item.GUI_number +"</td>"
                                 + "<td>"+ item.owner +"</td>"
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
                            if(item.status == 'R'){
                                rows += "<td>轉單</td>"
                            }
                            else if(item.status == 'T'){
                                rows += "<td>完成</td>"
                            }
                            else if(item.status == 'F'){
                                rows += "<td>延遲</td>"
                            }
                            else{
                                rows += "<td></td>"
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

                    $('select[name="assign2"]').on('change',function(){

                        var owner = $(this).val()
                        var id = $(this).parents('tr').children('td')[2].textContent 

                        $.ajax({
                            type:'post',
                            url:"{{ route('ht.StrokeManage.supervisor.assignOwnerAgain',['organization'=>$organization]) }}",
                            data:{
                                '_token':'{{csrf_token()}}',
                                'id':id,
                                'owner':owner
                            },
                            success:function(res){
                                if(res.status == 200){
                                    alert('工單已指派');
                                    window.location = '{{ route('ht.StrokeManage.supervisor.index',['organization'=>$organization]) }}'
                                }
                                else if(res.status == 400){
                                    alert('工單指派失敗');
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
    </script>
    <script type="text/javascript">
        $('#reset').on('click',function(){
            $('#start').val("")
            $('#end').val("")
            $('#status').val("")
        })

        $('#reset2').on('click',function(){
            $('#start2').val("")
            $('#end2').val("")
            $('#type').val("")
        })

        $('#reset3').on('click',function(){
            $('#start3').val("")
            $('#end3').val("")
            $('#status2').val("")
            $('#type2').val("")
            $('#staff').val("")
        })
    </script>
@endsection