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
                                                        <form method="post" action="{{ route('ht.Material.material.store',['organization'=>$organization]) }}">
                                                            @csrf
                                                            <div class="text-primary mx-s">
                                                                <h4 class="bd-bottom">領料單 <i class="fas fa-caret-right"></i></h4>
                                                            </div>
                                                            <div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-item">
                                                                        <label class="d-block">領料日期</label>
                                                                        <div class="datetime">
                                                                            <div class="input-group date day-set">
                                                                                <input class="form-control" placeholder="請選擇日期" name="date" type="text"> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-item">
                                                                        <label class="d-block">員工編號</label>
                                                                        <input type="text" class="form-control" name="emp_id" value="{{Auth::user()->emp_id}}">
                                                                    </div>
                                                                    <div class="form-item">
                                                                        <label class="d-block">員工姓名</label>
                                                                        <input type="text" class="form-control" name="emp_name" value="{{Auth::user()->name}}">
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
                                                                            <input type="text" class="form-control" name="materials_number[]" id="materials_number" required>
                                                                        </div>
                                                                        <div class="form-item">
                                                                            <label class="d-block"><span class="text-danger">* </span>品名規格</label>
                                                                            <input type="text" class="form-control" name="materials_spec[]" id="materials_spec" required>
                                                                        </div>
                                                                        <div class="form-item">
                                                                            <label class="d-block">機號</label>
                                                                            <select class="form-control" name="machine_number[]" id="machine_number">
                                                                                <option value="" selected="">請選擇機號</option>
                                                                                <option value="null" >無</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-item">
                                                                            <label class="d-block"><span class="text-danger">* </span>領料數量</label>
                                                                            <input type="number" class="form-control" min="1" name="quantity[]" required>
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
                                                            <form class='form-inline' id="notGetMaterialSearch">
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
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="submit">查詢</button>
                                                                    <button class='mr-s' type="button" id="reset">重設</button>
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
                                                                    @foreach($materialN as $materialN => $data)
                                                                    <tr>
                                                                        <td>{{ $data->date }}</td>
                                                                        <td>{{ $data->materials_number }}</td>
                                                                        <td>{{ $data->materials_spec }}</td>
                                                                        <td>{{ $data->machine_number }}</td>
                                                                        <td>{{ $data->quantity }}</td>
                                                                        <td>{{ $data->other }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- 已領料 -->
                                                    <div class="tab-pane" id="viewers-tab-03">
                                                        <div class='coupon'>
                                                            <form class='form-inline' id="getMaterialSearch">
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
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' type="submit">查詢</button>
                                                                    <button class='mr-s' type="button" id="reset2">重設</button>
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
                                                                    @foreach($materialY as $materialY => $data)
                                                                    <tr>
                                                                        <td>{{ $data->date }}</td>
                                                                        <td>{{ $data->materials_number }}</td>
                                                                        <td>{{ $data->materials_spec }}</td>
                                                                        <td>{{ $data->machine_number }}</td>
                                                                        <td>{{ $data->quantity }}</td>
                                                                        <td>{{ $data->other }}</td>
                                                                        <td><button type="button" class="btn btn-primary backs" value="{{ $data->id }}">退料</button></td>
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
<!-- Modal-退料 -->
    <div class="modal fade Overview-set" id="cancel" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-none">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body m-0">
                    <form method="post" action="{{ route('ht.Material.material.storeBack',['organization'=>$organization]) }}">
                        @csrf
                        <ul>
                            <li class="mb-s">
                                <span class="mb-xs">退料日期</span>
                                <input type="hidden" name="id" id="id" placeholder="">
                                <input class="form-control day-set" type="text" name="back_date" id="back_date" placeholder="">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">產品料號</span>
                                <input class="form-control" type="text" id="back_materials_number" disabled>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">品名規格</span>
                                <input class="form-control" type="text" id="back_materials_spec" disabled>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">機號</span>
                                <input class="form-control" type="text" id="back_machine_number" disabled>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">領料數量</span>
                                <input class="form-control" type="number" id="back_quantity" min="1" disabled>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">退料數量</span>
                                <input class="form-control" type="number" name="back_quantity" min="1" placeholder="">
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
                        <input type="text" class="form-control materials_number" name="materials_number[]" required>
                    </div>
                    <div class="form-item">
                        <label class="d-block"><span class="text-danger">* </span>品名規格</label>
                        <input type="text" class="form-control materials_spec" name="materials_spec[]" required>
                    </div>
                    <div class="form-item">
                        <label class="d-block">機號</label>
                        <select class="form-control machine_number" name="machine_number[]">
                            <option value="" selected="">請選擇機號</option>
                            <option value="null" >無</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label class="d-block"><span class="text-danger">* </span>領料數量</label>
                        <input type="number" class="form-control" min="1" name="quantity[]" required>
                    </div>
                </div>
                `)
        if (quantity >= 1) {
            $('.del').show();
        } else {
            $('.del').hide();
        }

        //即時搜尋
        $('.materials_number').on('keyup',function(){
            
            var result = $('.materials_number').val();

            $.ajax({
                type:'get',
                url:'{{ route('ht.Material.material.materialsNumberSearch',['organization'=>$organization]) }}',
                data:{
                    'value':result
                },
                success:function(res){
                    var availableTags = res[0];
                    $( ".materials_number" ).autocomplete({
                      source: availableTags,
                          select: function (event, ui) {

                            var result = ui.item.label;
                            
                            $.ajax({
                                type:'get',
                                url:'{{ route('ht.Material.material.materialsNumberSearch',['organization'=>$organization]) }}',
                                data:{
                                    'value':result
                                },
                                success:function(ress){

                                    if(ress[1][0] != null){
                                        $('.materials_spec').val(ress[1][0].materials_spec)

                                        if(ress[1][0].machine_number != null){
                                            var number = ress[1][0].machine_number.split(",")
                                            number.pop();
                                            var selOpts = "<option value='' selected='selected' disabled='true'>請選擇機號</option>";
                                            selOpts += "<option value='null'>無</option>";
                                            $.each(number, function (i, item) {

                                                selOpts += "<option value='"+item+"'>"+item+"</option>";    
                                            })
                                            $(".machine_number").empty();
                                            $('.machine_number').append(selOpts);
                                        }
                                    }              
                                }
                            })
                        },
                    });

                    if(res[1][0] != null){
                        $('.materials_spec').val(ress[1][0].materials_spec)

                        if(res[1][0].machine_number != null){
                            var number = res[1][0].machine_number.split(",")
                            number.pop();
                            var selOpts = "<option value='none' selected='selected' disabled='true'>請選擇機號</option>";
                            selOpts += "<option value='null'>無</option>";
                            $.each(number, function (i, item) {

                                selOpts += "<option value='"+item+"'>"+item+"</option>";    
                            })
                            $(".machine_number").empty();
                            $('.machine_number').append(selOpts);
                        }
                    }

                }
            })
        })
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
<script type="text/javascript">
    $(document).ready(function(){

        //即時搜尋
        $('#materials_number').on('keyup',function(){

            var result = $('#materials_number').val();

            $.ajax({
                type:'get',
                url:'{{ route('ht.Material.material.materialsNumberSearch',['organization'=>$organization]) }}',
                data:{
                    'value':result
                },
                success:function(res){
                    var availableTags = res[0];
                    $( "#materials_number" ).autocomplete({
                      source: availableTags,
                          select: function (event, ui) {

                            var result = ui.item.label;
                            
                            $.ajax({
                                type:'get',
                                url:'{{ route('ht.Material.material.materialsNumberSearch',['organization'=>$organization]) }}',
                                data:{
                                    'value':result
                                },
                                success:function(ress){

                                    if(ress[1][0] != null){
                                        $('#materials_spec').val(ress[1][0].materials_spec)

                                        if(ress[1][0].machine_number != null){
                                            var number = ress[1][0].machine_number.split(",")
                                            number.pop();
                                            var selOpts = "<option value='none' selected='selected' disabled='true'>請選擇機號</option>";
                                            selOpts += "<option value='null'>無</option>";
                                            $.each(number, function (i, item) {

                                                selOpts += "<option value='"+item+"'>"+item+"</option>";    
                                            })
                                            $("#machine_number").empty();
                                            $('#machine_number').append(selOpts);
                                        }
                                    }              
                                }
                            })
                        },
                    });

                    if(res[1][0] != null){
                        $('#materials_spec').val(ress[1][0].materials_spec)

                        if(res[1][0].machine_number != null){
                            var number = res[1][0].machine_number.split(",")
                            number.pop();
                            var selOpts = "<option value='none' selected='selected' disabled='true'>請選擇機號</option>";
                            selOpts += "<option value='null'>無</option>";
                            $.each(number, function (i, item) {

                                selOpts += "<option value='"+item+"'>"+item+"</option>";    
                            })
                            $("#machine_number").empty();
                            $('#machine_number').append(selOpts);
                        }
                    }

                }
            })
        })
    })
</script>
<script type="text/javascript">

//退料

$('.backs').on('click', function(){

    var date = $(this).parents('tr').find("td:eq(0)").text();
    var materials_number = $(this).parents('tr').find("td:eq(1)").text();
    var materials_spec = $(this).parents('tr').find("td:eq(2)").text();
    var machine_number = $(this).parents('tr').find("td:eq(3)").text();
    var quantity = $(this).parents('tr').find("td:eq(4)").text();
    var id = $(this).parents('tr').find("td:eq(6)").children('button').val();

    $("#back_date").val(date);
    $("#back_materials_number").val(materials_number);
    $("#back_materials_spec").val(materials_spec);
    $("#back_machine_number").val(machine_number);
    $("#back_quantity").val(quantity);
    $("#id").val(id);

    $('#cancel').modal('show');

});
</script>
<script type="text/javascript">
    //待領料
    $('#notGetMaterialSearch').on('submit',function(e){

        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'post',
            url:"{{ route('ht.Material.material.notGetMaterialSearch',['organization'=>$organization]) }}",
            data:formData,
            success:function(res){

                var rows;

                $('#hetao-overview1').DataTable().destroy();
                $('#hetao-overview1 tbody').empty();

                $.each(res, function (i, item) {
                    rows += "<tr>"
                        + "<td>" + item.date + "</td>"
                        + "<td>" + item.materials_number + "</a></td>"
                        + "<td>" + item.materials_spec + "</td>"
                        + "<td>" + item.machine_number + "</td>"
                        + "<td>" + item.quantity + "</td>"
                        + "<td>" + item.other + "</td>"
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
            },
            cache: false,
            contentType: false,
            processData: false
        })
    })

    //已領料
    $('#getMaterialSearch').on('submit',function(e){

        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'post',
            url:"{{ route('ht.Material.material.getMaterialSearch',['organization'=>$organization]) }}",
            data:formData,
            success:function(res){

                var rows;

                $('#hetao-overview2').DataTable().destroy();
                $('#hetao-overview2 tbody').empty();

                $.each(res, function (i, item) {
                    rows += "<tr>"
                        + "<td>" + item.date + "</td>"
                        + "<td>" + item.materials_number + "</a></td>"
                        + "<td>" + item.materials_spec + "</td>"
                        + "<td>" + item.machine_number + "</td>"
                        + "<td>" + item.quantity + "</td>"
                        + "<td>" + item.other + "</td>"
                        + "<td><button type='button' class='btn btn-primary backs' value="+ item.id + ">退料</button></td>"
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

                $('.backs').on('click', function(){

                    var date = $(this).parents('tr').find("td:eq(0)").text();
                    var materials_number = $(this).parents('tr').find("td:eq(1)").text();
                    var materials_spec = $(this).parents('tr').find("td:eq(2)").text();
                    var machine_number = $(this).parents('tr').find("td:eq(3)").text();
                    var quantity = $(this).parents('tr').find("td:eq(4)").text();
                    var id = $(this).parents('tr').find("td:eq(6)").children('button').val();

                    $("#back_date").val(date);
                    $("#back_materials_number").val(materials_number);
                    $("#back_materials_spec").val(materials_spec);
                    $("#back_machine_number").val(machine_number);
                    $("#back_quantity").val(quantity);
                    $("#id").val(id);

                    $('#cancel').modal('show');

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
    })

    $('#reset2').on('click',function(){
        $('#start2').val("")
        $('#end2').val("")
    })
</script>
@endsection