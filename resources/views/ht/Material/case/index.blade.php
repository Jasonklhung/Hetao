@extends('layout.app')

@section('content')
		<div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">領退料管理</h3>
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
                                                            <form class='form-inline'>
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s1" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide span-d'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <select class='form-control mr-s mb-s'>
                                                                    <option selected>員工</option>
                                                                </select>
                                                                <select class='form-control mr-s mb-s'>
                                                                    <option selected>狀態</option>
                                                                </select>
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
                                                                    <tr class="watch">
                                                                        <td>
                                                                            <div class="td-icon">
                                                                                <input class="chkall" type="checkbox" value="">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-nowrap">2020-03-26</td>
                                                                        <td>00575</td>
                                                                        <td>曾曾</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td>已編輯</td>
                                                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit">編輯</button></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>
                                                                            <div class="td-icon">
                                                                                <input class="chkall" type="checkbox" value="">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-nowrap">2020-03-26</td>
                                                                        <td>00575</td>
                                                                        <td>曾曾</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td>已編輯</td>
                                                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit">編輯</button></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- 領料已完成 -->
                                                    <div class="tab-pane" id="viewers-tab-02">
                                                        <div class='coupon'>
                                                            <form class='form-inline'>
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide span-d'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <select class='form-control mr-s mb-s'>
                                                                    <option selected>員工</option>
                                                                </select>
                                                                <select class='form-control mr-s mb-s'>
                                                                    <option selected>狀態</option>
                                                                </select>
                                                                <select class='form-control mr-s mb-s'>
                                                                    <option selected>ERP</option>
                                                                </select>
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
                                                                            <li><a data-toggle="modal" data-target="#op-alert" href="#">批次下載</a></li>
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
                                                                    <tr class="watch">
                                                                        <td>
                                                                            <div class="td-icon">
                                                                                <input class="chkall" type="checkbox" value="">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-nowrap">2020-03-26</td>
                                                                        <td>00575</td>
                                                                        <td>曾曾</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td><span class="text-success">已下載</span></td>
                                                                        <td><span class="text-success">已轉入</span></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>
                                                                            <div class="td-icon">
                                                                                <input class="chkall" type="checkbox" value="">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-nowrap">2020-03-26</td>
                                                                        <td>00575</td>
                                                                        <td>曾曾</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td><span class="text-danger">未下載</span></td>
                                                                        <td><span class="text-danger">未轉入</span></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- 退料待處理 -->
                                                    <div class="tab-pane" id="viewers-tab-03">
                                                        <div class='coupon'>
                                                            <form class='form-inline'>
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s3" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide span-d'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <select class='form-control mr-s mb-s'>
                                                                    <option selected>員工</option>
                                                                </select>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="button">查詢</button>
                                                                    <button class='mr-s' type="button">重設</button>
                                                                    <div class="droptool mr-s">
                                                                        <button class="btn btn-gray" type="button"><i class="fas fa-cog"></i>
                                                                        </button>
                                                                        <ul class="droptool-menu">
                                                                            <li>
                                                                                <input class="d-none" id='chkall3' type='checkbox' value='' /><label for='chkall3' class='sall'></label>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li><a data-toggle="modal" data-target="#op-alert" href="#">批次完成</a></li>
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
                                                                    <tr class="watch">
                                                                        <td>
                                                                            <div class="td-icon">
                                                                                <input class="chkall" type="checkbox" value="">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-nowrap">2020-03-26</td>
                                                                        <td>00575</td>
                                                                        <td>曾曾</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td>已編輯</td>
                                                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit">編輯</button></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>
                                                                            <div class="td-icon">
                                                                                <input class="chkall" type="checkbox" value="">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-nowrap">2020-03-26</td>
                                                                        <td>00575</td>
                                                                        <td>曾曾</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit">編輯</button></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- 退料已完成 -->
                                                    <div class="tab-pane" id="viewers-tab-04">
                                                        <div class='coupon'>
                                                            <form class='form-inline'>
                                                                <input type="text" class="form-control mr-s searchInput searchInput_s4" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select'>
                                                                            <input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide span-d'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s'>
                                                                            <input class='form-control' placeholder='選擇結束日期' type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <select class='form-control mr-s mb-s'>
                                                                    <option selected>員工</option>
                                                                </select>
                                                                <select class='form-control mr-s mb-s'>
                                                                    <option selected>狀態</option>
                                                                </select>
                                                                <select class='form-control mr-s mb-s'>
                                                                    <option selected>ERP</option>
                                                                </select>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="button">查詢</button>
                                                                    <button class='mr-s' type="button">重設</button>
                                                                    <div class="droptool mr-s">
                                                                        <button class="btn btn-gray" type="button"><i class="fas fa-cog"></i>
                                                                        </button>
                                                                        <ul class="droptool-menu">
                                                                            <li>
                                                                                <input class="d-none" id='chkall4' type='checkbox' value='' /><label for='chkall4' class='sall'></label>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li><a data-toggle="modal" data-target="#op-alert" href="#">批次下載</a></li>
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
                                                                    <tr class="watch">
                                                                        <td>
                                                                            <div class="td-icon">
                                                                                <input class="chkall" type="checkbox" value="">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-nowrap">2020-03-26</td>
                                                                        <td>00575</td>
                                                                        <td>曾曾</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td><span class="text-success">已下載</span></td>
                                                                        <td><span class="text-success">已轉入</span></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>
                                                                            <div class="td-icon">
                                                                                <input class="chkall" type="checkbox" value="">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-nowrap">2020-03-26</td>
                                                                        <td>00575</td>
                                                                        <td>曾曾</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td><span class="text-danger">未下載</span></td>
                                                                        <td><span class="text-danger">未轉入</span></td>
                                                                    </tr>
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
<div class="modal fade Overview-set" id="edit" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body m-0">
                    <form action="">
                        <ul>
                            <li class="mb-s">
                                <span class="mb-xs">領料日期</span>
                                <input class="form-control day-set" type="text" disabled>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">員工編號</span>
                                <input class="form-control" type="text" disabled>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">員工姓名</span>
                                <input class="form-control" type="text" disabled>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">產品料號</span>
                                <input class="form-control" type="text">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">品名規格</span>
                                <input class="form-control" type="text">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">機號</span>
                                <input class="form-control" type="text">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">領料數量</span>
                                <input class="form-control" type="number" min="1">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">備註</span>
                                <input class="form-control" type="number" min="1" disabled>
                            </li>
                        </ul>
                    </form>
                    <div class="text-center">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">確認</button>  
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal">確認</button>
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
</script>
@endsection