@extends('layout.app')

@section('content')
		<div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">客戶資料查詢</h3>
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-info-circle"></i>客戶資料總覽
                                        </div>
                                        <div class="panel-body tab-pane">
                                            <div class="tabbable">
                                                <div class='coupon'>
                                                    <form class='form-inline' method="post" id="customerSearch">
                                                        @csrf
                                                        <select class="form-control mr-s mb-s" name="type" required="" id="type">
                                                            <option value="" selected="" disabled="">請選擇條件</option>
                                                            <option value="CARDNO">客戶卡號</option>
                                                            <option value="FULLNAME">客戶全銜</option>
                                                            <option value="CUSTKEY">客戶代碼</option>
                                                            <option value="MACHINE">機器地址</option>
                                                            <option value="COMTEL">客戶電話</option>
                                                            <option value="HOMETEL">家裡電話</option>
                                                            <option value="MPHONE">行動電話</option>
                                                            <option value="TAXNO">統一編號</option>
                                                        </select>
                                                        <input type="text" class="form-control mr-s searchInput searchInput_s1" name="key" placeholder="請輸入關鍵字">
                                                        <div class='btn-wrap'>
                                                            <button class='mr-s' type="submit">查詢</button>
                                                            <button class='mr-s' type="button" id="reset">重設</button>
                                                        </div>
                                                    </form>
                                                </div>                                    
                                                <table class="table table-hover dt-responsive table-striped W-100" id="hetao-list-s-1">
                                                    <thead class="rwdhide">
                                                        <tr>
                                                            <th class="desktop">客戶卡號</th>
                                                            <th class="desktop">客戶全銜</th>
                                                            <th class="desktop">客戶代碼</th>
                                                            <th class="desktop">機器地址</th>
                                                            <th class="desktop">客戶電話</th>
                                                            <th class="desktop">行動電話</th>
                                                            <th class="desktop">統一編號</th>
                                                            <th class="desktop">操作</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- <tr>
                                                            <td>1102</td>
                                                            <td>愛酷智能科技有限公司</td>
                                                            <td>愛酷智能</td>
                                                            <td><a href="https://www.google.com.tw/maps?hl=zh-TW&tab=rl1" target="_blank">地址地址地址地址地址地址地址地址</a></td>
                                                            <td class="text-nowrap"><a href="tel:0212345678">02-12345678</a></td>
                                                            <td><a href="tel:0912345678">0912345678</a></td>
                                                            <td>12345678</td>
                                                            <td><a href="客戶資料-基本資料.html"><button type="button" class="btn btn-primary">進階查看</button></a></td>
                                                        </tr> -->
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
            "targets": [7],
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
    // $(".searchInput_s1").on("blur", function() {
    //     table_s1.search(this.value).draw();
    // });

    // $(".searchInput_s1").on("keyup", function() {
    //     table_s1.search(this.value).draw();
    // });

</script>
<script type="text/javascript">
    $(document).ready(function(){
       $('#customerSearch').on('submit',function(e){

            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                method:'post',
                url:'{{ route('ht.Customer.search',['organization'=>$organization]) }}',
                data:formData,
                dataType:'json',
                success:function(res){

                    var rows;
                    $('#hetao-list-s-1').DataTable().destroy();
                    $('#hetao-list-s-1 tbody').empty();

                    $.each(res, function (i, item) {

                        id = item.CUSTKEY
                        url = '{{ route('ht.Customer.show',['organization'=>$organization,'id'=>':id']) }}'
                        url = url.replace(':id',id);

                        rows += "<tr>"
                        + "<td>" + item.CARDNO + "</td>"
                        + "<td>" + item.FULLNAME + "</td>"
                        + "<td>" + item.CUSTKEY + "</td>"
                        + "<td><a href='https://www.google.com.tw/maps/place/"+item.MACHINE+"' target='_blank'>"+item.MACHINE+"</a></td>"
                        + "<td class='text-nowrap'><a href='tel:"+item.COMTEL+"'>"+item.COMTEL+"</a></td>"
                        + "<td class='text-nowrap'><a href='tel:"+item.MPHONE+"'>"+item.MPHONE+"</a></td>"
                        + "<td>" + item.TAXNO + "</td>"
                        + "<td><a href="+url+"><button type='button' class='btn btn-primary'>進階查看</button></a></td>"
                        + "</tr>";
                    });
                    $('#hetao-list-s-1 tbody').append(rows);
                    $("#hetao-list-s-1").DataTable({
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
                            "emptyTable": "查無資料",
                            "infoFiltered": "(從 _MAX_ 筆中篩選)",
                        },
                        "dom": '<"top"i>rt<"bottom"flp><"clear">',
                        "buttons": [{
                            "extend": "colvis",
                            "collectionLayout": "fixed two-column"
                        }],
                        "order": [],
                        "columnDefs": [{
                            "targets": [7],
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
                },
                cache: false,
                contentType: false,
                processData: false
            })
       })
    })
</script>
<script type="text/javascript">
    $('#reset').on('click',function(){
        $('#type').val("")
    })
</script>
@endsection