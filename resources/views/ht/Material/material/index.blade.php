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
                                            <i class="fas fa-boxes"></i>領料申請
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <!-- tab標籤 -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-01">領料單填寫</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-02">待領料</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-03">已領料</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 領料單填寫 -->
                                                    <div class="tab-pane active" id="viewers-tab-01">
                                                        <form>
                                                            <div class="text-primary mx-s">
                                                                <h4 class="bd-bottom">領料單 <i class="fas fa-caret-right"></i></h4>
                                                            </div>
                                                            <div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-item">
                                                                        <label class="d-block">領料日期</label>
                                                                        <div class="datetime">
                                                                            <div class="input-group date day-set">
                                                                                <input class="form-control" placeholder="請選擇日期" type="text"> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-item">
                                                                        <label class="d-block">員工編號</label>
                                                                        <input type="text" class="form-control">
                                                                    </div>
                                                                    <div class="form-item">
                                                                        <label class="d-block">員工姓名</label>
                                                                        <input type="text" class="form-control">
                                                                    </div>
                                                                    <div class="form-item">
                                                                        <label class="d-block">備註</label>
                                                                        <textarea class="form-control" rows="3"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6 mt-s">
                                                                    <a class="add" href="javascript:void(0)"><i class="fas fa-plus-circle"></i> 新增</a>
                                                                    <div class="bg-gray p-s mt-s">
                                                                        <a style="display: none;" class="del" href="javascript:void(0)"><i class="fas fa-minus-circle text-danger float-right"></i></a>
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
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 mb-s mt-s">
                                                                <button type="submit" class="btn btn-primary m-0">送出</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- 待領料 -->
                                                    <div class="tab-pane" id="viewers-tab-02">
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
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="button">查詢</button>
                                                                    <button class='mr-s' type="button">重設</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div style="width: 100%; overflow-x: auto;">
                                                            <table class="table table-hover table-striped display" id="hetao-overview1">
                                                                <thead class="rwdhide">
                                                                    <tr>
                                                                        <th class="desktop">領料日期</th>
                                                                        <th class="desktop">產品料號</th>
                                                                        <th class="desktop">品名規格</th>
                                                                        <th class="desktop">機號</th>
                                                                        <th class="desktop">領料數量</th>
                                                                        <th class="desktop">備註</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- 已領料 -->
                                                    <div class="tab-pane" id="viewers-tab-03">
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
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="button">查詢</button>
                                                                    <button class='mr-s' type="button">重設</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div style="width: 100%; overflow-x: auto;">
                                                            <table class="table table-hover table-striped display" id="hetao-overview2">
                                                                <thead class="rwdhide">
                                                                    <tr>
                                                                        <th class="desktop">領料日期</th>
                                                                        <th class="desktop">產品料號</th>
                                                                        <th class="desktop">品名規格</th>
                                                                        <th class="desktop">機號</th>
                                                                        <th class="desktop">領料數量</th>
                                                                        <th class="desktop">備註</th>
                                                                        <th class="desktop">操作</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cancel">退料</button></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cancel">退料</button></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cancel">退料</button></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cancel">退料</button></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cancel">退料</button></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cancel">退料</button></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cancel">退料</button></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cancel">退料</button></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cancel">退料</button></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cancel">退料</button></td>
                                                                    </tr>
                                                                    <tr class="watch">
                                                                        <td>2020-03-26</td>
                                                                        <td>UF-593</td>
                                                                        <td>第一道PP濾心</td>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td></td>
                                                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cancel">退料</button></td>
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
<!-- Modal-退料 -->
    <div class="modal fade Overview-set" id="cancel" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body m-0">
                    <form action="">
                        <ul>
                            <li class="mb-s">
                                <span class="mb-xs">退料日期</span>
                                <input class="form-control day-set" type="text" placeholder="">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">產品料號</span>
                                <input class="form-control" type="text" disabled>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">品名規格</span>
                                <input class="form-control" type="text" disabled>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">機號</span>
                                <input class="form-control" type="text" disabled>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">領料數量</span>
                                <input class="form-control" type="number" min="1" disabled>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">退料數量</span>
                                <input class="form-control" type="number" min="1" placeholder="">
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
            "targets": [6],
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
        table.search(this.value).draw();
    });

    $(".searchInput_s2").on("keyup", function() {
        table.search(this.value).draw();
    });
</script>
@endsection