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
                                    <div class="panel warehouse" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-boxes"></i>庫存管理
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <div class='coupon'>
                                                    <form class='form-inline'>
                                                        <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字">
                                                        <div class='form-group'>
                                                            <div class='datetime'>
                                                                <div class='input-group date date-select' id="datetimepicker1">
                                                                    <input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                            </div><span class='rwd-hide span-d'>~</span>
                                                            <div class='datetime'>
                                                                <div class='input-group date date-select mr-s' id="datetimepicker2">
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
                                                <table class="table table-hover dt-responsive table-striped" id="hetao-list-s-2">
                                                    <thead class="rwdhide">
                                                        <tr>
                                                            <th class="desktop">產品料號</th>
                                                            <th class="desktop">品名規格</th>
                                                            <th class="desktop">機號</th>
                                                            <th class="desktop">數量</th>
                                                            <th class="desktop">備註</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($stock as $key => $data)
                                                        <tr>
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
            "emptyTable": "目前無資料",
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
    $(".searchInput_s2").on("blur", function() {
        table_s2.search(this.value).draw();
    });

    $(".searchInput_s2").on("keyup", function() {
        table_s2.search(this.value).draw();
    });

</script>
<script type="text/javascript">
    $("#datetimepicker1").on("dp.change", function (e) {
        $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepicker2").on("dp.change", function (e) {
        $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
    });
</script>
@endsection