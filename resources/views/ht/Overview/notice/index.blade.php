@extends('layout.app')

@section('content')
		<div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">總覽 <span>Overview</span></h3>
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-calendar-alt"></i>通知設定
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <div class='coupon'>
                                                    <form class="form-inline">
                                                        <input type="text" class="form-control mr-s searchInput searchInput_a" placeholder="請輸入關鍵字">
                                                        <div class='form-group'>
                                                            <div class='datetime'>
                                                                <div class='input-group date day-select'>
                                                                    <input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                            </div><span class='rwd-hide'>~</span>
                                                            <div class='datetime'>
                                                                <div class='input-group day date-select mr-s'>
                                                                    <input class='form-control' placeholder='選擇結束日期' type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='btn-wrap'>
                                                            <button class='mr-s' type="button">查詢</button>
                                                            <button class='mr-s' type="button">重設</button>
                                                            <button class='btn-bright' type='button' data-toggle="modal" data-target="#person-n">新增通知</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div style="width: 100%; overflow-x: auto;">
                                                    <table class="table table-hover table-striped display" id="hetao-overview">
                                                        <thead class="rwdhide">
                                                            <tr>
                                                                <th class="desktop">內容</th>
                                                                <th class="desktop">時間</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="watch">
                                                                <td>
                                                                    <strong><a href="#" data-toggle="modal" data-target="#person-e"><span class="mr-s">[一般]</span>開A公司發票</a></strong>
                                                                    <p>A公司每個月中要開發票</p>
                                                                </td>
                                                                <td class="text-nowrap">2020-03-10 16:00</td>
                                                            </tr>
                                                            <tr class="watch">
                                                                <td>
                                                                    <strong><a href="#" data-toggle="modal" data-target="#person-e"><span class="mr-s">[一般]</span>開B公司報價單</a></strong>
                                                                    <p>提供報價單</p>
                                                                </td>
                                                                <td class="text-nowrap">2020-03-10 09:50</td>
                                                            </tr>
                                                            <tr class="watch">
                                                                <td>
                                                                    <strong><a href="#" data-toggle="modal" data-target="#person-e"><span class="mr-s">[覆訪]</span>C公司拜訪</a></strong>
                                                                    <p>3/18 早上十點檢查機器</p>
                                                                </td>
                                                                <td class="text-nowrap">2020-03-02 11:00</td>
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
@endsection

@section('modal')
<!-- Modal 新增通知 -->
    <div id="person-n" class="modal fade Overview-set" role="dialog" style="z-index: 9999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <div class="modal-body">
                    <form action="">
                        <ul>
                            <li class="mb-s">
                                <span class="mb-xs">標題</span>
                                <input class="form-control" type="text" placeholder="輸入標題">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">內容</span>
                                <textarea class="form-control" rows="1" placeholder="輸入內容"></textarea>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">通知時間</span>
                                <div class="d-block">
                                    <input class="choose" id="choose1" type="radio" name="at-1" num="1" value="單次" checked>
                                    <label for="choose1" class="chooseitem mr-s">單次</label>

                                    <input class="choose" id="choose2" type="radio" name="at-1" num="2" value="每日">
                                    <label for="choose2" class="chooseitem mr-s">每日</label>

                                    <input class="choose" id="choose3" type="radio" name="at-1" num="3" value="每週">
                                    <label for="choose3" class="chooseitem mr-s">每週</label>

                                    <input class="choose" id="choose4" type="radio" name="at-1" num="4" value="每月">
                                    <label for="choose4" class="chooseitem mr-s">每月</label>

                                    <input class="choose" id="choose5" type="radio" name="at-1" value="不通知" num="5">
                                    <label for="choose5" class="chooseitem mr-s">不通知</label>
                                </div>
                                <div class="">
                                    <!-- 單次 -->
                                    <div class="i1">
                                        <input type="text" class="date-set form-control">
                                    </div>
                                    <!-- 每日 -->
                                    <div class="i2 d-none">
                                        <p>開始日期</p>
                                        <input type="text" class="date-set form-control">
                                    </div>
                                    <!-- 每週 -->
                                    <div class="i3 d-none">
                                        <p>開始日期</p>
                                        <input type="text" class="day-set form-control mb-s">
                                        <div class="form-inline mb-s">
                                            <span>每</span><input class="form-control mx-s dayy" type="number" value="1" min="1"><span>週</span>
                                            <button class="levelinfo" type="button">
                                                <i class="fas fa-info-circle text-bright"></i>
                                                <ul class="levelinfo-menu">
                                                    <li><span class="text-primary">每1週：</span>每週</li>
                                                    <li><span class="text-primary">每2週：</span>隔一週</li>
                                                </ul>
                                            </button>
                                            <button type="button" class="btn add-member week-b">+ 新增</button>
                                        </div>
                                        <div class="weekwrap">
                                            <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                                <select name="" id="" class="form-control">
                                                    <option value="">星期一</option>
                                                    <option value="">星期二</option>
                                                    <option value="">星期三</option>
                                                    <option value="">星期四</option>
                                                    <option value="">星期五</option>
                                                    <option value="">星期六</option>
                                                    <option value="">星期日</option>    
                                                </select>
                                                <input type="text" class="time-set form-control">
                                                <button class="close" type="button">×</button>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- 每月 -->
                                    <div class="i4 d-none">
                                        <p>開始日期</p>
                                        <input type="text" class="date-set form-control">
                                    </div>
                                </div>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">通知對象</span>
                                <div class="d-flex">
                                    <select class='form-control mb-s company mr-s'>
                                        <option selected disabled hidden value="">分公司</option>
                                        <option>台北</option>
                                        <option>新北</option>
                                        <option>桃園</option>
                                        <option>台中</option>
                                        <option>台南</option>
                                        <option>高雄</option>
                                    </select>
                                    <select class='form-control mb-s role mr-s' disabled="disabled">
                                        <option selected hidden value="">職稱</option>
                                        <option value="助理">助理</option>
                                        <option value="主管">主管</option>
                                        <option value="員工">員工</option>
                                    </select>
                                    <select class='form-control mb-s staffname' disabled="disabled">
                                        <option selected hidden value="">員工名稱</option>
                                        <option value="小美">小美</option>
                                        <option value="小王">小王</option>
                                        <option value="小名">小名</option>
                                        <option value="小強">小強</option>
                                        <option value="小花">小花</option>
                                        <option value="小白">小白</option>
                                    </select>
                                </div>
                                <button type="button" class="btn add-member meet">+ 新增</button>
                                <div class="memberwrap">
                                </div>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">類型</span>
                                <select class="form-control" name="" id="">
                                    <option value="">一般</option>
                                    <option value="">--</option>
                                </select>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">備註</span>
                                <textarea class="form-control" rows="1" placeholder="輸入備註"></textarea>
                            </li>
                            <li class="text-center"><button type="button" class="btn btn-danger">重設</button><button type="button" class="btn btn-primary" data-dismiss="modal">新增</button></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 編輯通知 -->
    <div id="person-e" class="modal fade Overview-set" role="dialog" style="z-index: 9999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <div class="modal-body">
                    <form action="">
                        <ul>
                            <li class="mb-s">
                                <span class="mb-xs">標題</span>
                                <input class="form-control" type="text" placeholder="輸入標題">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">內容</span>
                                <textarea class="form-control" rows="1" placeholder="輸入內容"></textarea>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">通知時間</span>
                                <div class="d-block">
                                    <input class="choose" id="choose1-2" type="radio" name="at-2" value="單次" num="1-2" checked>
                                    <label for="choose1-2" class="chooseitem mr-s">單次</label>

                                    <input class="choose" id="choose2-2" type="radio" name="at-2" value="每日" num="2-2">
                                    <label for="choose2-2" class="chooseitem mr-s">每日</label>

                                    <input class="choose" id="choose3-2" type="radio" name="at-2" value="每週" num="3-2">
                                    <label for="choose3-2" class="chooseitem mr-s">每週</label>

                                    <input class="choose" id="choose4-2" type="radio" name="at-2" value="每月" num="4-2">
                                    <label for="choose4-2" class="chooseitem mr-s">每月</label>

                                    <input class="choose" id="choose5-2" type="radio" name="at-2" value="不通知" num="5-2">
                                    <label for="choose5-2" class="chooseitem mr-s">不通知</label>
                                </div>
                                <div class="">
                                    <!-- 單次 -->
                                    <div class="i1-2">
                                        <input type="text" class="date-set form-control">
                                    </div>
                                    <!-- 每日 -->
                                    <div class="i2-2 d-none">
                                        <p>開始日期</p>
                                        <input type="text" class="date-set form-control">
                                    </div>
                                    <!-- 每週 -->
                                    <div class="i3-2 d-none">
                                        <p>開始日期</p>
                                        <input type="text" class="day-set form-control mb-s">
                                        <div class="form-inline mb-s">
                                            每<input class="form-control mx-s dayy" type="number" value="1" min="1">週
                                            <button class="levelinfo" type="button">
                                                <i class="fas fa-info-circle text-bright"></i>
                                                <ul class="levelinfo-menu">
                                                    <li><span class="text-primary">每1週：</span>每週</li>
                                                    <li><span class="text-primary">每2週：</span>隔一週</li>
                                                </ul>
                                            </button>
                                            <button type="button" class="btn add-member week-b">+ 新增</button>
                                        </div>
                                        <div class="weekwrap">
                                            <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                                                <select name="" id="" class="form-control my-xs">
                                                    <option value="">星期一</option>
                                                    <option value="">星期二</option>
                                                    <option value="">星期三</option>
                                                    <option value="">星期四</option>
                                                    <option value="">星期五</option>
                                                    <option value="">星期六</option>
                                                    <option value="">星期日</option>    
                                                </select>
                                                <input type="text" class="time-set form-control my-xs">
                                                <button class="close my-xs" type="button">×</button>
                                            </div>
                                        </div>    
                                    </div>
                                    <!-- 每月 -->
                                    <div class="i4-2 d-none">
                                        <p>開始日期</p>
                                        <input type="text" class="date-set form-control">
                                    </div>
                                </div>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">通知對象</span>
                                <div class="d-flex">
                                    <select class='form-control mb-s company mr-s'>
                                        <option selected disabled hidden value="">分公司</option>
                                        <option>台北</option>
                                        <option>新北</option>
                                        <option>桃園</option>
                                        <option>台中</option>
                                        <option>台南</option>
                                        <option>高雄</option>
                                    </select>
                                    <select class='form-control mb-s role mr-s' disabled="disabled">
                                        <option selected hidden value="">職稱</option>
                                        <option value="助理">助理</option>
                                        <option value="主管">主管</option>
                                        <option value="員工">員工</option>
                                    </select>
                                    <select class='form-control mb-s staffname' disabled="disabled">
                                        <option selected hidden value="">員工名稱</option>
                                        <option value="小美">小美</option>
                                        <option value="小王">小王</option>
                                        <option value="小名">小名</option>
                                        <option value="小強">小強</option>
                                        <option value="小花">小花</option>
                                        <option value="小白">小白</option>
                                    </select>
                                </div>
                                <button type="button" class="btn add-member meet">+ 新增</button>
                                <div class="memberwrap">
                                </div>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">類型</span>
                                <select class="form-control" name="" id="">
                                    <option value="">一般</option>
                                    <option value="">--</option>
                                </select>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">備註</span>
                                <textarea class="form-control" rows="1" placeholder="輸入備註"></textarea>
                            </li>
                            <li class="text-center"><button type="button" class="btn btn-danger">刪除</button><button type="button" class="btn btn-primary" data-dismiss="modal">儲存</button></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    var table = $("#hetao-overview").DataTable({
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
        }, {
            "width": "200",
            "targets": 1,
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

    $(".searchInput_a").on("blur", function() {
        table.search(this.value).draw();
    });

    $(".searchInput_a").on("keyup", function() {
        table.search(this.value).draw();
    });

    // 通知時間設定選項
    $('input[name=at-1]').change(function(){
        var num = $(this).attr('num')
        if($(this).prop('checked')==true) {
            $('.i1, .i2, .i3, .i4').addClass('d-none');
            $('.i'+num).removeClass('d-none');
        }
    });  
    $('input[name=at-2]').change(function(){
        var num = $(this).attr('num')
        if($(this).prop('checked')==true) {
            $('.i1-2, .i2-2, .i3-2, .i4-2').addClass('d-none');
            $('.i'+num).removeClass('d-none');
        }
    }); 

    // 通知對象新增
    $('body').on('click', '.Overview-set .add-member.meet', function(){
        var company = $(this).parents('.Overview-set').find(".company").val()
        var role = $(this).parents('.Overview-set').find(".role").val()
        var staffname = $(this).parents('.Overview-set').find(".staffname").val()
        if((company && role && staffname) !== null){
            $(this).siblings('.memberwrap').append('<span class="tag"><div><small>'+ company +'/'+ role +'</small><br>'+ staffname +'</div><button class="close" type="button">×</button></span>');
        }
    });

    // 通知對象/新增星期刪除
    $('body').on('click', '.Overview-set .close', function(){
        $(this).parent('.tag, .week').remove();
    });

    // 通知對象控制鎖select
    $('body').on('change', '.Overview-set .company', function(){
        if($(this).val() !== "") {
            $(this).siblings('.role').prop('disabled','');
        }
    });
    $('body').on('change', '.Overview-set .role', function(){
        if($(this).val() !== "") {
            $(this).siblings('.staffname').prop('disabled','');
            $(this).siblings('.staffname').val('');
        }
    });

    // 通知時間 新增星期
    $('body').on('click', '.Overview-set .add-member.week-b', function(){
        $(this).parents('.Overview-set').find('.weekwrap').append(`
            <div class="form-inline mb-s bg-gray d-flex week justify-content-between">
                <select name="" id="" class="form-control">
                    <option value="">星期一</option>
                    <option value="">星期二</option>
                    <option value="">星期三</option>
                    <option value="">星期四</option>
                    <option value="">星期五</option>
                    <option value="">星期六</option>
                    <option value="">星期日</option>    
                </select>
                <input type="text" class="time-set form-control">
                <button class="close" type="button">×</button>
            </div>
        `);
        $(function () {
            $('.time-set').datetimepicker({
                format: 'HH:mm',
                ignoreReadonly: true,
                allowInputToggle: true,
                ignoreReadonly: true,
                toolbarPlacement: 'bottom',
                showClose: true,
                locale: 'ZH-TW',
            });
        });
    });

</script>
@endsection