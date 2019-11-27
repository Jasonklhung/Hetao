@extends('layout.app')

@section('content')
<div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">與我聯繫 <span>Management</span></h3>
                    @include('common.message')
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-tasks"></i>與我聯繫
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <!-- tab標籤 -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-04">與我聯繫</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 與我聯繫 -->
                                                    <div class="tab-pane active" id="viewers-tab-04">
                                                        <div class='coupon'>
                                                            <form class="form-inline">
                                                                <input type="text" class="form-control mr-s searchInput searchInput_ab" placeholder="請輸入關鍵字">
                                                                <div class='form-group'>
                                                                    
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select' id="SD4">
                                                                            <input class='form-control' placeholder='選擇起始日期' readonly="" id="startDate4" type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div>
                                                                    </div><span class='rwd-hide'>~</span>
                                                                    <div class='datetime'>
                                                                        <div class='input-group date date-select mr-s' id="ED4">
                                                                            <input class='form-control' placeholder='選擇結束日期' readonly="" id="endDate4" type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='btn-wrap'>
                                                                    <button class='mr-s' id="searchDate4" type="button">確認送出</button>
                                                                    <button class='mr-s'>重新設定時間</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-ab">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">預約日期</th>
                                                                    <th class="desktop">查看</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($contact as $data)
                                                                @if($data->views == 'Y')
                                                                <tr class="past">
                                                                @else
                                                                <tr class="watch">
                                                                @endif
                                                                    <td>{{ $data->created_at }}</td>
                                                                    <td><button type='button' class='btn status' onclick="javascript:location.href='{{ route('ht.FormDetails.ContactUs.show',['organization'=>$organization,'id'=>base64_encode($data->id)]) }}'">查看</button></td>
                                                                </tr>
                                                                @endforeach
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
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    //與我聯繫
    var table_ab = $("#hetao-list-ab").DataTable({
        "bPaginate": true,
        "searching": true,
        "info": false,
        "bLengthChange": false,
        "bServerSide": false,
        "language": {
            "search": "",
            "searchPlaceholder": "請輸入關鍵字",
            "paginate": { "previous": "上一頁", "next": "下一頁" },
            "emptyTable":     "目前無與我聯繫表單",
            "zeroRecords":    "沒有符合的搜尋結果",
        },
        "dom": "Bfrtip",
        "buttons": [{
            "extend": 'colvis',
            "collectionLayout": 'fixed two-column'
        }],
        "order": [[ 0, "desc" ]],
        "columnDefs": [{
            "targets": [0],
            "orderable": false,
        }],
        "responsive": {
            "breakpoints": [
            { name: 'desktop', width: Infinity},
            { name: 'tablet',  width: 1700},
            ],
            "details": {
                "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                "type": 'none',
                renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
                "target": ''
            }
        },
    });
    $(".searchInput_ab").on("keyup", function() {
        table_ab.search(this.value).draw();
    });
</script>
<script type="text/javascript">

    //與我聯繫
    $('#searchDate4').on('click',function(){

        var start = $('#startDate4').val()
        var end = $('#endDate4').val()

        var date = new Date(end);
        var end = date.setTime(date.getTime()+24*60*60*1000);
        var resEnd = date.getFullYear()+"-" + ('0' + (date.getMonth()+1)).slice(-2) + "-" + ('0' + date.getDate()).slice(-2)

        $.ajax({
            method:'post',
            url:'{{ route('ht.FormDetails.ContactUs.contactSearch',['organization'=>$organization]) }}',
            data:{
                '_token':'{{csrf_token()}}',
                'start':start,
                'end':resEnd,
            },
            dataType:'json',
            success:function(res){

                if(res == ''){
                    alert('沒有符合的資料')
                }
                else{
                    var rows;

                    $('#hetao-list-ab').DataTable().destroy();
                    $('#hetao-list-ab tbody').empty();

                    $.each(res, function (i, item) {

                        rows += "<tr class='watch'>"
                        + "<td>" + item.created_at + "</td>"
                        + "<td><button type='button' class='btn status' onclick='javascript:location.href='{{ route('ht.FormDetails.ContactUs.show',['organization'=>$organization,'id'=>base64_encode("+item.id+")]) }}''>查看</button></td>"
                        + "</tr>";                
                    });
                    $('#hetao-list-ab tbody').append(rows);
                    var table_ab = $("#hetao-list-ab").DataTable({
                        "bPaginate": true,
                        "searching": true,
                        "info": false,
                        "bLengthChange": false,
                        "bServerSide": false,
                        "language": {
                            "search": "",
                            "searchPlaceholder": "請輸入關鍵字",
                            "paginate": { "previous": "上一頁", "next": "下一頁" },
                            "emptyTable":     "目前無與我聯繫表單",
                            "zeroRecords":    "沒有符合的搜尋結果",
                        },
                        "dom": "Bfrtip",
                        "buttons": [{
                            "extend": 'colvis',
                            "collectionLayout": 'fixed two-column'
                        }],
                        "order": [[ 0, "desc" ]],
                        "columnDefs": [{
                            "targets": [0],
                            "orderable": false,
                        }],
                        "responsive": {
                            "breakpoints": [
                            { name: 'desktop', width: Infinity},
                            { name: 'tablet',  width: 1700},
                            ],
                            "details": {
                                "display": $.fn.dataTable.Responsive.display.childRowImmediate,
                                "type": 'none',
                                renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
                                "target": ''
                            }
                        },
                    });
                    $(".searchInput_ab").on("keyup", function() {
                        table_ab.search(this.value).draw();
                    });
                }
            }
        })
    })
</script>
<script type="text/javascript">
    $("#SD4").on("dp.change", function (e) {
        $('#ED4').data("DateTimePicker").minDate(e.date);
    });
    $("#ED4").on("dp.change", function (e) {
        $('#SD4').data("DateTimePicker").maxDate(e.date);
    });
</script>
@endsection