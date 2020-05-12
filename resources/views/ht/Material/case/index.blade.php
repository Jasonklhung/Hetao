@extends('layout.app')

@section('content')
		<div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">領退料管理</h3>
                    @include('common.message')
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-boxes"></i>領退料單管理
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <!-- tab標籤 -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-01">領料待處理</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-02">領料已完成</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-03">退料待處理</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-04">退料已完成</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 領料待處理 -->
                                                    <div class="tab-pane active" id="viewers-tab-01">
                                                        <div class='coupon'>
                                                            <form class='form-inline' id="materialingSearch">
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
                                                                <select class='form-control mr-s mb-s' name="staff" id="staff">
                                                                    <option value="" selected>員工</option>
                                                                    @foreach($deptUser as $key => $data)
                                                                    <option value="{{$data['id']}}">{{$data['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <select class='form-control mr-s mb-s' name="status" id="status">
                                                                    <option value="" selected>狀態</option>
                                                                    <option value="N">未編輯</option>
                                                                    <option value="Y">已編輯</option>
                                                                </select>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="submit">查詢</button>
                                                                    <button class='mr-s' type="button" id="reset">重設</button>
                                                                    <div class="droptool mr-s">
                                                                        <button class="btn btn-gray" type="button"><i class="fas fa-cog"></i>
                                                                        </button>
                                                                        <ul class="droptool-menu">
                                                                            <li>
                                                                                <input class="d-none" id='chkall1' type='checkbox' value='' /><label for='chkall1' class='sall'></label>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li><a data-toggle="modal" data-target="#op-alert" href="#">批次完成</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <table class="table table-hover dt-responsive table-striped W-100" id="hetao-overview1">
                                                                <thead class="rwdhide">
                                                                    <tr>
                                                                        <th class="desktop"></th>
                                                                        <th class="desktop">領料日期</th>
                                                                        <th class="desktop">員工編號</th>
                                                                        <th class="desktop">員工姓名</th>
                                                                        <th class="desktop">產品料號</th>
                                                                        <th class="desktop">品名規格</th>
                                                                        <th class="desktop">機號</th>
                                                                        <th class="desktop">領料數量</th>
                                                                        <th class="desktop">備註</th>
                                                                        <th class="desktop">狀態</th>
                                                                        <th class="desktop">操作</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($materialing as $key => $data)
                                                                    <tr class="watch">
                                                                        <td>
                                                                            <div class="td-icon">
                                                                                <input class="chkall" name="material_case" type="checkbox" value="{{ $data->id }}">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-nowrap">{{ $data->date }}</td>
                                                                        <td>{{ $data->emp_id }}</td>
                                                                        <td>{{ $data->emp_name }}</td>
                                                                        <td>{{ $data->materials_number }}</td>
                                                                        <td>{{ $data->materials_spec }}</td>
                                                                        <td>{{ $data->machine_number }}</td>
                                                                        <td>{{ $data->quantity }}</td>
                                                                        <td>{{ $data->other }}</td>
                                                                        @if($data->statusEdit == 'Y')
                                                                        <td>已編輯</td>
                                                                        @else
                                                                        <td>未編輯</td>
                                                                        @endif
                                                                        <td><button type="button" class="btn btn-primary materialing" value="{{ $data->id }}">編輯</button></td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- 領料已完成 -->
                                                    <div class="tab-pane" id="viewers-tab-02">
                                                        <div class='coupon'>
                                                            <form class='form-inline' id="materialFinishSearch">
                                                                @csrf
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
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
                                                                <select class='form-control mr-s mb-s' name="staff" id="staff2">
                                                                    <option value="" selected>員工</option>
                                                                    @foreach($deptUser as $key => $data)
                                                                    <option value="{{$data['id']}}">{{$data['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <select class='form-control mr-s mb-s' name="statusDL" id="statusDL">
                                                                    <option value="" selected>狀態</option>
                                                                    <option value="N">未下載</option>
                                                                    <option value="Y">已下載</option>
                                                                </select>
                                                                <select class='form-control mr-s mb-s' name="statusERP" id="statusERP">
                                                                    <option value="" selected>ERP狀態</option>
                                                                    <option value="N">未轉入</option>
                                                                    <option value="Y">已轉入</option>
                                                                </select>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="submit">查詢</button>
                                                                    <button class='mr-s' type="button" id="reset2">重設</button>
                                                                    <div class="droptool mr-s">
                                                                        <button class="btn btn-gray" type="button"><i class="fas fa-cog"></i>
                                                                        </button>
                                                                        <ul class="droptool-menu">
                                                                            <li>
                                                                                <input class="d-none" id='chkall2' type='checkbox' value='' /><label for='chkall2' class='sall'></label>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li><a data-toggle="modal" data-target="#op2-alert" href="#">批次下載</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <table class="table table-hover dt-responsive table-striped W-100" id="hetao-overview2">
                                                                <thead class="rwdhide">
                                                                    <tr>
                                                                        <th class="desktop"></th>
                                                                        <th class="desktop">領料日期</th>
                                                                        <th class="desktop">員工編號</th>
                                                                        <th class="desktop">員工姓名</th>
                                                                        <th class="desktop">產品料號</th>
                                                                        <th class="desktop">品名規格</th>
                                                                        <th class="desktop">機號</th>
                                                                        <th class="desktop">領料數量</th>
                                                                        <th class="desktop">備註</th>
                                                                        <th class="desktop">狀態</th>
                                                                        <th class="desktop">ERP</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($materialFinish as $key => $data)
                                                                    <tr class="watch">
                                                                        <td>
                                                                            <div class="td-icon">
                                                                                <input class="chkall" name="material_download" type="checkbox" value="{{ $data->id }}">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-nowrap">{{ $data->date }}</td>
                                                                        <td>{{ $data->emp_id }}</td>
                                                                        <td>{{ $data->emp_name }}</td>
                                                                        <td>{{ $data->materials_number }}</td>
                                                                        <td>{{ $data->materials_spec }}</td>
                                                                        <td>{{ $data->machine_number }}</td>
                                                                        <td>{{ $data->quantity }}</td>
                                                                        <td>{{ $data->other }}</td>
                                                                        @if($data->statusDL == 'Y')
                                                                        <td><span class="text-success">已下載</span></td>
                                                                        @else
                                                                        <td><span class="text-danger">未下載</span></td>
                                                                        @endif

                                                                        @if($data->statusERP == 'Y')
                                                                        <td><span class="text-success">已轉入</span></td>
                                                                        @else
                                                                        <td><span class="text-danger">未轉入</span></td>
                                                                        @endif
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- 退料待處理 -->
                                                    <div class="tab-pane" id="viewers-tab-03">
                                                        <div class='coupon'>
                                                            <form class='form-inline' id="materialBackSearch">
                                                                @csrf
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s3" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text' name="start" id="start3"> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide span-d'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' type='text' name="end" id="end3"> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <select class='form-control mr-s mb-s' name="staff" id="staff3">
                                                                    <option value="" selected>員工</option>
                                                                    @foreach($deptUser as $key => $data)
                                                                    <option value="{{$data['id']}}">{{$data['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="submit">查詢</button>
                                                                    <button class='mr-s' type="button" id="reset3">重設</button>
                                                                    <div class="droptool mr-s">
                                                                        <button class="btn btn-gray" type="button"><i class="fas fa-cog"></i>
                                                                        </button>
                                                                        <ul class="droptool-menu">
                                                                            <li>
                                                                                <input class="d-none" id='chkall3' type='checkbox' value='' /><label for='chkall3' class='sall'></label>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li><a data-toggle="modal" data-target="#op3-alert" href="#">批次完成</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <table class="table table-hover dt-responsive table-striped W-100" id="hetao-overview3">
                                                                <thead class="rwdhide">
                                                                    <tr>
                                                                        <th class="desktop"></th>
                                                                        <th class="desktop">退料日期</th>
                                                                        <th class="desktop">員工編號</th>
                                                                        <th class="desktop">員工姓名</th>
                                                                        <th class="desktop">產品料號</th>
                                                                        <th class="desktop">品名規格</th>
                                                                        <th class="desktop">機號</th>
                                                                        <th class="desktop">領料數量</th>
                                                                        <th class="desktop">退料數量</th>
                                                                        <th class="desktop">備註</th>
                                                                        <th class="desktop">狀態</th>
                                                                        <th class="desktop">操作</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($materialBack as $key => $data)
                                                                    <tr class="watch">
                                                                        <td>
                                                                            <div class="td-icon">
                                                                                <input class="chkall" type="checkbox" name="material_back" value="{{ $data->id }}">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-nowrap">{{ $data->date }}</td>
                                                                        <td>{{ $data->emp_id }}</td>
                                                                        <td>{{ $data->emp_name }}</td>
                                                                        <td>{{ $data->materials_number }}</td>
                                                                        <td>{{ $data->materials_spec }}</td>
                                                                        <td>{{ $data->machine_number }}</td>
                                                                        <td>{{ $data->quantity }}</td>
                                                                        <td>{{ $data->back_quantity }}</td>
                                                                        <td>{{ $data->other }}</td>
                                                                        @if($data->statusEdit == 'Y')
                                                                        <td>已編輯</td>
                                                                        @else
                                                                        <td>未編輯</td>
                                                                        @endif
                                                                        <td><button type="button" class="btn btn-primary editBack" value="{{ $data->id }}">編輯</button></td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- 退料已完成 -->
                                                    <div class="tab-pane" id="viewers-tab-04">
                                                        <div class='coupon'>
                                                            <form class='form-inline' id="materialBackFinishSearch">
                                                                @csrf
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s4" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text' name="start" id="start4"> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide span-d'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' type='text' name="end" id="end4"> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <select class='form-control mr-s mb-s' name="staff" id="staff4">
                                                                    <option value="" selected>員工</option>
                                                                    @foreach($deptUser as $key => $data)
                                                                    <option value="{{$data['id']}}">{{$data['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <select class='form-control mr-s mb-s' name="statusDL" id="statusDL2">
                                                                    <option value="" selected>狀態</option>
                                                                    <option value="N">未下載</option>
                                                                    <option value="Y">已下載</option>
                                                                </select>
                                                                <select class='form-control mr-s mb-s' name="statusERP" id="statusERP2">
                                                                    <option value="" selected>ERP狀態</option>
                                                                    <option value="N">未轉入</option>
                                                                    <option value="Y">已轉入</option>
                                                                </select>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="submit">查詢</button>
                                                                    <button class='mr-s' type="button" id="reset4">重設</button>
                                                                    <div class="droptool mr-s">
                                                                        <button class="btn btn-gray" type="button"><i class="fas fa-cog"></i>
                                                                        </button>
                                                                        <ul class="droptool-menu">
                                                                            <li>
                                                                                <input class="d-none" id='chkall4' type='checkbox' value='' /><label for='chkall4' class='sall'></label>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li><a data-toggle="modal" data-target="#op4-alert" href="#">批次下載</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <table class="table table-hover dt-responsive table-striped W-100" id="hetao-overview4">
                                                                <thead class="rwdhide">
                                                                    <tr>
                                                                        <th class="desktop"></th>
                                                                        <th class="desktop">領料日期</th>
                                                                        <th class="desktop">員工編號</th>
                                                                        <th class="desktop">員工姓名</th>
                                                                        <th class="desktop">產品料號</th>
                                                                        <th class="desktop">品名規格</th>
                                                                        <th class="desktop">機號</th>
                                                                        <th class="desktop">領料數量</th>
                                                                        <th class="desktop">退料數量</th>
                                                                        <th class="desktop">備註</th>
                                                                        <th class="desktop">狀態</th>
                                                                        <th class="desktop">ERP</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($materialBackFinish as $key => $data)
                                                                    <tr class="watch">
                                                                        <td>
                                                                            <div class="td-icon">
                                                                                <input class="chkall" name="material_back_download" type="checkbox" value="{{ $data->id }}">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-nowrap">{{ $data->date }}</td>
                                                                        <td>{{ $data->emp_id }}</td>
                                                                        <td>{{ $data->emp_name }}</td>
                                                                        <td>{{ $data->materials_number }}</td>
                                                                        <td>{{ $data->material_spec }}</td>
                                                                        <td>{{ $data->machine_number }}</td>
                                                                        <td>{{ $data->quantity }}</td>
                                                                        <td>{{ $data->back_quantity }}</td>
                                                                        <td>{{ $data->other }}</td>
                                                                        @if($data->statusDL == 'Y')
                                                                        <td><span class="text-success">已下載</span></td>
                                                                        @else
                                                                        <td><span class="text-danger">未下載</span></td>
                                                                        @endif

                                                                        @if($data->statusERP == 'Y')
                                                                        <td><span class="text-success">已轉入</span></td>
                                                                        @else
                                                                        <td><span class="text-danger">未轉入</span></td>
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
        </div>
@endsection

@section('modal')
    <!-- 領料編輯 -->
    <div class="modal fade Overview-set" id="edit" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body m-0">
                    <form method="post" action="{{ route('ht.Material.case.material_edit',['organization'=>$organization]) }}">
                        @csrf
                        <ul>
                            <li class="mb-s">
                                <span class="mb-xs">領料日期</span>
                                <input type="hidden" name="id" id="id">
                                <input class="form-control day-set" type="text" id="date" disabled>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">員工編號</span>
                                <input class="form-control" type="text" id="emp_id" disabled>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">員工姓名</span>
                                <input class="form-control" type="text" id="emp_name" disabled>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">產品料號</span>
                                <input class="form-control" type="text" name="materials_number" id="materials_number">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">品名規格</span>
                                <input class="form-control" type="text" name="materials_spec" id="materials_spec">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">機號</span>
                                <input class="form-control" type="text" name="machine_number" id="machine_number">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">領料數量</span>
                                <input class="form-control" type="number" name="quantity" min="1" id="quantity">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">備註</span>
                                <input class="form-control" type="number" min="1" id="other" disabled>
                            </li>
                        </ul>
                        <div class="text-center">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-primary">確認</button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- 退料編輯 -->
    <div class="modal fade Overview-set" id="editBack" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body m-0">
                    <form method="post" action="{{ route('ht.Material.case.materialBackEdit',['organization'=>$organization]) }}">
                        @csrf
                        <ul>
                            <li class="mb-s">
                                <span class="mb-xs">領料日期</span>
                                <input type="hidden" name="back_id" id="back_id">
                                <input class="form-control day-set" type="text" id="back_date" disabled>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">員工編號</span>
                                <input class="form-control" type="text" id="back_emp_id" disabled>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">員工姓名</span>
                                <input class="form-control" type="text" id="back_emp_name" disabled>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">產品料號</span>
                                <input class="form-control" type="text" name="back_materials_number" id="back_materials_number">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">品名規格</span>
                                <input class="form-control" type="text" name="back_materials_spec" id="back_materials_spec">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">機號</span>
                                <input class="form-control" type="text" name="back_machine_number" id="back_machine_number">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">領料數量</span>
                                <input class="form-control" type="number" name="quantity" min="1" id="backs_quantity">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">退料數量</span>
                                <input class="form-control" type="number" name="back_quantity" min="1" id="back_quantity">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">備註</span>
                                <input class="form-control" type="number" min="1" id="back_other" disabled>
                            </li>
                        </ul>
                        <div class="text-center">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-primary">確認</button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- 領料待處理 -->
    <div class="modal fade" id="op-alert" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="caseSubmit" data-dismiss="modal">確認</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 領料已完成 -->
    <div class="modal fade" id="op2-alert" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="caseDownload" data-dismiss="modal">確認</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 退料待處理 -->
    <div class="modal fade" id="op3-alert" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="backSubmit" data-dismiss="modal">確認</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 退料已完成 -->
    <div class="modal fade" id="op4-alert" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="backDownload" data-dismiss="modal">確認</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    //新增
    $('.add').on('click', function() {
        var quantity = $('.bg-gray').length
        $(this).after(`
                <div class="bg-gray p-s mt-s">
                    <a class="del" href="javascript:void(0)"><i class="fas fa-minus-circle text-danger float-right"></i></a>
                    <div class="form-item">
                        <label class="d-block"><span class="text-danger">* </span>產品料號</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="form-item">
                        <label class="d-block"><span class="text-danger">* </span>品名規格</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="form-item">
                        <label class="d-block">機號</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-item">
                        <label class="d-block"><span class="text-danger">* </span>領料數量</label>
                        <input type="number" class="form-control" min="1" required>
                    </div>
                </div>
                `)
        if (quantity >= 1) {
            $('.del').show();
        } else {
            $('.del').hide();
        }
    });
    //刪除
    $('body').on('click', '.del', function() {
        var quantity = $('.bg-gray').length
        $(this).parents('.bg-gray').remove();
        if (quantity <= 2) {
            $('.del').fadeOut();
        } else {
            $('.del').fadeIn();
        }
    });



    var table = $("#hetao-overview1").DataTable({
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
            "emptyTable": "沒有數據",
            "infoFiltered": "(從 _MAX_ 筆中篩選)",
        },
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "buttons": [{
            "extend": 'colvis',
            "collectionLayout": 'fixed two-column'
        }],
        "order": [],
        "columnDefs": [{
            "targets": [0],
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
        table.search(this.value).draw();
    });

    $(".searchInput_s1").on("keyup", function() {
        table.search(this.value).draw();
    });

    var table2 = $("#hetao-overview2").DataTable({
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
            "emptyTable": "沒有數據",
            "infoFiltered": "(從 _MAX_ 筆中篩選)",
        },
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "buttons": [{
            "extend": 'colvis',
            "collectionLayout": 'fixed two-column'
        }],
        "order": [],
        "columnDefs": [{
            "targets": [0],
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

    $(".searchInput_s2").on("blur", function() {
        table2.search(this.value).draw();
    });

    $(".searchInput_s2").on("keyup", function() {
        table2.search(this.value).draw();
    });

    var table3 = $("#hetao-overview3").DataTable({
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
            "emptyTable": "沒有數據",
            "infoFiltered": "(從 _MAX_ 筆中篩選)",
        },
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "buttons": [{
            "extend": 'colvis',
            "collectionLayout": 'fixed two-column'
        }],
        "order": [],
        "columnDefs": [{
            "targets": [0, 11],
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

    $(".searchInput_s3").on("blur", function() {
        table3.search(this.value).draw();
    });

    $(".searchInput_s3").on("keyup", function() {
        table3.search(this.value).draw();
    });

    var table4 = $("#hetao-overview4").DataTable({
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
            "emptyTable": "沒有數據",
            "infoFiltered": "(從 _MAX_ 筆中篩選)",
        },
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "buttons": [{
            "extend": 'colvis',
            "collectionLayout": 'fixed two-column'
        }],
        "order": [],
        "columnDefs": [{
            "targets": [0,11],
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

    $(".searchInput_s4").on("blur", function() {
        table4.search(this.value).draw();
    });

    $(".searchInput_s4").on("keyup", function() {
        table4.search(this.value).draw();
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

    $('a[data-target="#op2-alert"]').on('click', function() {
        var text = $(this).text()
        var checked = $("input.chkall")
        if ($(this).parents('.tab-pane').find(checked).filter(":checked").length >= 1) {
            $('#op2-alert .modal-body').html(`
                <p>確定要` + text + `所選案件嗎？</p>
            `)
        } else {
            $('#op2-alert .modal-body').html(`
                <p>您沒有選取案件唷！</p>
            `)
        }
    });

    $('a[data-target="#op3-alert"]').on('click', function() {
        var text = $(this).text()
        var checked = $("input.chkall")
        if ($(this).parents('.tab-pane').find(checked).filter(":checked").length >= 1) {
            $('#op3-alert .modal-body').html(`
                <p>確定要` + text + `所選案件嗎？</p>
            `)
        } else {
            $('#op3-alert .modal-body').html(`
                <p>您沒有選取案件唷！</p>
            `)
        }
    });

    $('a[data-target="#op4-alert"]').on('click', function() {
        var text = $(this).text()
        var checked = $("input.chkall")
        if ($(this).parents('.tab-pane').find(checked).filter(":checked").length >= 1) {
            $('#op4-alert .modal-body').html(`
                <p>確定要` + text + `所選案件嗎？</p>
            `)
        } else {
            $('#op4-alert .modal-body').html(`
                <p>您沒有選取案件唷！</p>
            `)
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){

        //領料單編輯
        $('.materialing').on('click',function(){

            var date = $(this).parents('tr').find("td:eq(1)").text();
            var emp_id = $(this).parents('tr').find("td:eq(2)").text();
            var emp_name = $(this).parents('tr').find("td:eq(3)").text();
            var materials_number = $(this).parents('tr').find("td:eq(4)").text();
            var materials_spec = $(this).parents('tr').find("td:eq(5)").text();
            var machine_number = $(this).parents('tr').find("td:eq(6)").text();
            var quantity = $(this).parents('tr').find("td:eq(7)").text();
            var other = $(this).parents('tr').find("td:eq(8)").text();
            var id = $(this).parents('tr').find("td:eq(10)").children('button').val();

            $("#date").val(date);
            $("#emp_id").val(emp_id);
            $("#emp_name").val(emp_name);
            $("#materials_number").val(materials_number);
            $("#materials_spec").val(materials_spec);
            $("#machine_number").val(machine_number);
            $("#quantity").val(quantity);
            $("#other").val(other);
            $("#id").val(id);

            $('#edit').modal('show');
        })

        //領料單送出
        $('#caseSubmit').on('click',function(){

            var count = 0

            $('input[name="material_case"]:checked').each(function(){

                 var id = $(this).val()

                 $.ajax({
                    type:'post',
                    url:"{{ route('ht.Material.case.material_confirm',['organization'=>$organization]) }}",
                    data:{
                        '_token':'{{csrf_token()}}',
                        'id':id
                    },
                    success:function(res){
                        if(res.status == 200 && count == 0){
                            count += 1;
                            alert('領料單已完成');
                            window.location = '{{ route('ht.Material.case.index',['organization'=>$organization]) }}'
                        }
                    }
                 })
            })
        })

        //領料單下載
        $('#caseDownload').on('click',function(){

            var download = new Array()

            $('input[name="material_download"]:checked').each(function(){

                 var id = $(this).val()

                 download.push(id)
            })

            $.ajax({
                xhrFields: {
                    responseType: 'blob',
                },
                type:'post',
                url:"{{ route('ht.Material.case.material_download',['organization'=>$organization]) }}",
                data:{
                    '_token':'{{csrf_token()}}',
                    'id':download
                },
                success: function(result, status, xhr) {

                    var disposition = xhr.getResponseHeader('content-disposition');
                    var matches = /"([^"]*)"/.exec(disposition);
                    var filename = (matches != null && matches[1] ? matches[1] : '報備明細表.xlsx');

                    var blob = new Blob([result], {
                        type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = filename;

                    document.body.appendChild(link);

                    link.click();
                    document.body.removeChild(link);

                    window.location = '{{ route('ht.Material.case.index',['organization'=>$organization]) }}'
                }
            })
        })

        //退料單編輯
        $('.editBack').on('click',function(){

            var date = $(this).parents('tr').find("td:eq(1)").text();
            var emp_id = $(this).parents('tr').find("td:eq(2)").text();
            var emp_name = $(this).parents('tr').find("td:eq(3)").text();
            var materials_number = $(this).parents('tr').find("td:eq(4)").text();
            var materials_spec = $(this).parents('tr').find("td:eq(5)").text();
            var machine_number = $(this).parents('tr').find("td:eq(6)").text();
            var quantity = $(this).parents('tr').find("td:eq(7)").text();
            var back_quantity = $(this).parents('tr').find("td:eq(8)").text();
            var other = $(this).parents('tr').find("td:eq(9)").text();
            var id = $(this).parents('tr').find("td:eq(11)").children('button').val();

            $("#back_date").val(date);
            $("#back_emp_id").val(emp_id);
            $("#back_emp_name").val(emp_name);
            $("#back_materials_number").val(materials_number);
            $("#back_materials_spec").val(materials_spec);
            $("#back_machine_number").val(machine_number);
            $("#backs_quantity").val(quantity);
            $("#back_quantity").val(back_quantity);
            $("#back_other").val(other);
            $("#back_id").val(id);

            $('#editBack').modal('show');
        })

        //退料單送出
        $('#backSubmit').on('click',function(){

            var count = 0

            $('input[name="material_back"]:checked').each(function(){

                 var id = $(this).val()

                 $.ajax({
                    type:'post',
                    url:"{{ route('ht.Material.case.materialBackConfirm',['organization'=>$organization]) }}",
                    data:{
                        '_token':'{{csrf_token()}}',
                        'id':id
                    },
                    success:function(res){
                        if(res.status == 200 && count == 0){
                            count += 1;
                            alert('退料單已完成');
                            window.location = '{{ route('ht.Material.case.index',['organization'=>$organization]) }}'
                        }
                    }
                 })
            })
        })

        //退料單下載
        $('#backDownload').on('click',function(){

            var download = new Array()

            $('input[name="material_back_download"]:checked').each(function(){

                 var id = $(this).val()

                 download.push(id)
            })

            $.ajax({
                xhrFields: {
                    responseType: 'blob',
                },
                type:'post',
                url:"{{ route('ht.Material.case.materialBackDownload',['organization'=>$organization]) }}",
                data:{
                    '_token':'{{csrf_token()}}',
                    'id':download
                },
                success: function(result, status, xhr) {

                    var disposition = xhr.getResponseHeader('content-disposition');
                    var matches = /"([^"]*)"/.exec(disposition);
                    var filename = (matches != null && matches[1] ? matches[1] : '報備明細表.xlsx');

                    var blob = new Blob([result], {
                        type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = filename;

                    document.body.appendChild(link);

                    link.click();
                    document.body.removeChild(link);

                    window.location = '{{ route('ht.Material.case.index',['organization'=>$organization]) }}'
                }
            })
        })
    })
</script>
<script type="text/javascript">
    //領料待處理
    $('#materialingSearch').on('submit',function(e){

        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'post',
            url:"{{ route('ht.Material.case.materialingSearch',['organization'=>$organization]) }}",
            data:formData,
            success:function(res){

                var rows;

                $('#hetao-overview1').DataTable().destroy();
                $('#hetao-overview1 tbody').empty();

                $.each(res, function (i, item) {

                    if(item.statusEdit == 'Y'){
                        var status = '已編輯'
                    }
                    else{
                        var status = '未編輯'
                    }

                    rows += "<tr class='watch'>"
                        + "<td>"
                        + "<div class='td-icon'>"
                        + "<input class='chkall' name='material_case' type='checkbox' value="+ item.id +">"
                        + "</div>"
                        + "</td>"
                        + "<td class='text-nowrap'>"+ item.date +"</td>"
                        + "<td>"+ item.emp_id +"</td>"
                        + "<td>"+ item.emp_name +"</td>"
                        + "<td>"+ item.materials_number +"</td>"
                        + "<td>"+ item.materials_spec +"</td>"
                        + "<td>"+ item.machine_number +"</td>"
                        + "<td>"+ item.quantity +"</td>"
                        + "<td>"+ item.other +"</td>"
                        + "<td>"+ status +"</td>"
                        + "<td><button type='button' class='btn btn-primary materialing' value="+item.id+">編輯</button></td>"
                        + "</tr>";
                })
                $('#hetao-overview1 tbody').append(rows);
                var table = $("#hetao-overview1").DataTable({
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
                        "emptyTable": "沒有數據",
                        "infoFiltered": "(從 _MAX_ 筆中篩選)",
                    },
                    "dom": '<"top"i>rt<"bottom"flp><"clear">',
                    "buttons": [{
                        "extend": 'colvis',
                        "collectionLayout": 'fixed two-column'
                    }],
                    "order": [],
                    "columnDefs": [{
                        "targets": [0],
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
                    table.search(this.value).draw();
                });

                $(".searchInput_s1").on("keyup", function() {
                    table.search(this.value).draw();
                });

                $('.materialing').on('click',function(){

                    var date = $(this).parents('tr').find("td:eq(1)").text();
                    var emp_id = $(this).parents('tr').find("td:eq(2)").text();
                    var emp_name = $(this).parents('tr').find("td:eq(3)").text();
                    var materials_number = $(this).parents('tr').find("td:eq(4)").text();
                    var materials_spec = $(this).parents('tr').find("td:eq(5)").text();
                    var machine_number = $(this).parents('tr').find("td:eq(6)").text();
                    var quantity = $(this).parents('tr').find("td:eq(7)").text();
                    var other = $(this).parents('tr').find("td:eq(8)").text();
                    var id = $(this).parents('tr').find("td:eq(10)").children('button').val();

                    $("#date").val(date);
                    $("#emp_id").val(emp_id);
                    $("#emp_name").val(emp_name);
                    $("#materials_number").val(materials_number);
                    $("#materials_spec").val(materials_spec);
                    $("#machine_number").val(machine_number);
                    $("#quantity").val(quantity);
                    $("#other").val(other);
                    $("#id").val(id);

                    $('#edit').modal('show');
                })
            },
            cache: false,
            contentType: false,
            processData: false
        })
    })

    //領料已完成
    $('#materialFinishSearch').on('submit',function(e){

        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'post',
            url:"{{ route('ht.Material.case.materialFinishSearch',['organization'=>$organization]) }}",
            data:formData,
            success:function(res){

                var rows;

                $('#hetao-overview2').DataTable().destroy();
                $('#hetao-overview2 tbody').empty();

                $.each(res, function (i, item) {

                    if(item.statusDL == 'Y'){
                        var statusDL = '<span class="text-success">已下載</span>'
                    }
                    else{
                        var statusDL = '<span class="text-danger">未下載</span>'
                    }

                    if(item.statusERP == 'Y'){
                        var statusERP = '<span class="text-success">已轉入</span>'
                    }
                    else{
                        var statusERP = '<span class="text-danger">未轉入</span>'
                    }

                    rows += "<tr class='watch'>"
                        + "<td>"
                        + "<div class='td-icon'>"
                        + "<input class='chkall' name='material_download' type='checkbox' value="+ item.id +">"
                        + "</div>"
                        + "</td>"
                        + "<td class='text-nowrap'>"+ item.date +"</td>"
                        + "<td>"+ item.emp_id +"</td>"
                        + "<td>"+ item.emp_name +"</td>"
                        + "<td>"+ item.materials_number +"</td>"
                        + "<td>"+ item.materials_spec +"</td>"
                        + "<td>"+ item.machine_number +"</td>"
                        + "<td>"+ item.quantity +"</td>"
                        + "<td>"+ item.other +"</td>"
                        + "<td>"+ statusDL +"</td>"
                        + "<td>"+ statusERP +"</td>"
                        + "</tr>";
                })
                $('#hetao-overview2 tbody').append(rows);
                var table2 = $("#hetao-overview2").DataTable({
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
                        "emptyTable": "沒有數據",
                        "infoFiltered": "(從 _MAX_ 筆中篩選)",
                    },
                    "dom": '<"top"i>rt<"bottom"flp><"clear">',
                    "buttons": [{
                        "extend": 'colvis',
                        "collectionLayout": 'fixed two-column'
                    }],
                    "order": [],
                    "columnDefs": [{
                        "targets": [0],
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

                $(".searchInput_s2").on("blur", function() {
                    table2.search(this.value).draw();
                });

                $(".searchInput_s2").on("keyup", function() {
                    table2.search(this.value).draw();
                });

            },
            cache: false,
            contentType: false,
            processData: false
        })
    })


    //退料待處理
    $('#materialBackSearch').on('submit',function(e){

        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'post',
            url:"{{ route('ht.Material.case.materialBackSearch',['organization'=>$organization]) }}",
            data:formData,
            success:function(res){

                var rows;

                $('#hetao-overview3').DataTable().destroy();
                $('#hetao-overview3 tbody').empty();

                $.each(res, function (i, item) {

                    if(item.statusEdit == 'Y'){
                        var status = '已編輯'
                    }
                    else{
                        var status = '未編輯'
                    }

                    rows += "<tr class='watch'>"
                        + "<td>"
                        + "<div class='td-icon'>"
                        + "<input class='chkall' name='material_back' type='checkbox' value="+ item.id +">"
                        + "</div>"
                        + "</td>"
                        + "<td class='text-nowrap'>"+ item.date +"</td>"
                        + "<td>"+ item.emp_id +"</td>"
                        + "<td>"+ item.emp_name +"</td>"
                        + "<td>"+ item.materials_number +"</td>"
                        + "<td>"+ item.materials_spec +"</td>"
                        + "<td>"+ item.machine_number +"</td>"
                        + "<td>"+ item.quantity +"</td>"
                        + "<td>"+ item.back_quantity +"</td>"
                        + "<td>"+ item.other +"</td>"
                        + "<td>"+ status +"</td>"
                        + "<td><button type='button' class='btn btn-primary editBack' value="+item.id+">編輯</button></td>"
                        + "</tr>";
                })
                $('#hetao-overview3 tbody').append(rows);
                var table3 = $("#hetao-overview3").DataTable({
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
                        "emptyTable": "沒有數據",
                        "infoFiltered": "(從 _MAX_ 筆中篩選)",
                    },
                    "dom": '<"top"i>rt<"bottom"flp><"clear">',
                    "buttons": [{
                        "extend": 'colvis',
                        "collectionLayout": 'fixed two-column'
                    }],
                    "order": [],
                    "columnDefs": [{
                        "targets": [0, 11],
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

                $(".searchInput_s3").on("blur", function() {
                    table3.search(this.value).draw();
                });

                $(".searchInput_s3").on("keyup", function() {
                    table3.search(this.value).draw();
                });
               
                $('.editBack').on('click',function(){

                    var date = $(this).parents('tr').find("td:eq(1)").text();
                    var emp_id = $(this).parents('tr').find("td:eq(2)").text();
                    var emp_name = $(this).parents('tr').find("td:eq(3)").text();
                    var materials_number = $(this).parents('tr').find("td:eq(4)").text();
                    var materials_spec = $(this).parents('tr').find("td:eq(5)").text();
                    var machine_number = $(this).parents('tr').find("td:eq(6)").text();
                    var quantity = $(this).parents('tr').find("td:eq(7)").text();
                    var back_quantity = $(this).parents('tr').find("td:eq(8)").text();
                    var other = $(this).parents('tr').find("td:eq(9)").text();
                    var id = $(this).parents('tr').find("td:eq(11)").children('button').val();

                    $("#back_date").val(date);
                    $("#back_emp_id").val(emp_id);
                    $("#back_emp_name").val(emp_name);
                    $("#back_materials_number").val(materials_number);
                    $("#back_materials_spec").val(materials_spec);
                    $("#back_machine_number").val(machine_number);
                    $("#backs_quantity").val(quantity);
                    $("#back_quantity").val(back_quantity);
                    $("#back_other").val(other);
                    $("#back_id").val(id);

                    $('#editBack').modal('show');
                })
            },
            cache: false,
            contentType: false,
            processData: false
        })
    })


    //退料已完成
    $('#materialBackFinishSearch').on('submit',function(e){

        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'post',
            url:"{{ route('ht.Material.case.materialBackFinishSearch',['organization'=>$organization]) }}",
            data:formData,
            success:function(res){

                var rows;

                $('#hetao-overview4').DataTable().destroy();
                $('#hetao-overview4 tbody').empty();

                $.each(res, function (i, item) {
                    
                    if(item.statusDL == 'Y'){
                        var statusDL = '<span class="text-success">已下載</span>'
                    }
                    else{
                        var statusDL = '<span class="text-danger">未下載</span>'
                    }

                    if(item.statusERP == 'Y'){
                        var statusERP = '<span class="text-success">已轉入</span>'
                    }
                    else{
                        var statusERP = '<span class="text-danger">未轉入</span>'
                    }

                    rows += "<tr class='watch'>"
                        + "<td>"
                        + "<div class='td-icon'>"
                        + "<input class='chkall' name='material_back_download' type='checkbox' value="+ item.id +">"
                        + "</div>"
                        + "</td>"
                        + "<td class='text-nowrap'>"+ item.date +"</td>"
                        + "<td>"+ item.emp_id +"</td>"
                        + "<td>"+ item.emp_name +"</td>"
                        + "<td>"+ item.materials_number +"</td>"
                        + "<td>"+ item.materials_spec +"</td>"
                        + "<td>"+ item.machine_number +"</td>"
                        + "<td>"+ item.quantity +"</td>"
                        + "<td>"+ item.back_quantity +"</td>"
                        + "<td>"+ item.other +"</td>"
                        + "<td>"+ statusDL +"</td>"
                        + "<td>"+ statusERP +"</td>"
                        + "</tr>";
                })
                $('#hetao-overview4 tbody').append(rows);
               
            },
            cache: false,
            contentType: false,
            processData: false
        })
    })
</script>
<script type="text/javascript">
    $('#reset').on('click',function(){
        $('#start').val("");
        $('#end').val("");
        $('#staff').val("");
        $('#status').val("");
    })

    $('#reset2').on('click',function(){
        $('#start2').val("");
        $('#end2').val("");
        $('#staff2').val("");
        $('#statusDL').val("");
        $('#statusERP').val("");
    })

    $('#reset3').on('click',function(){
        $('#start3').val("");
        $('#end3').val("");
        $('#staff3').val("");
    })

    $('#reset4').on('click',function(){
        $('#start4').val("");
        $('#end4').val("");
        $('#staff4').val("");
        $('#statusDL2').val("");
        $('#statusERP2').val("");
    })
</script>
@endsection