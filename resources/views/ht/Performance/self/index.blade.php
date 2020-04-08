@extends('layout.app')

@section('content')
		<div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">業績查詢</h3>
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="far fa-chart-bar"></i>個人業績
                                        </div>
                                        <div class="panel-body tab-pane">
                                            <div class="tabbable">
                                                <div class='coupon'>
                                                    <form class='form-inline'>
                                                        <!-- <input type="text" class="form-control mr-s searchInput searchInput_s2" placeholder="請輸入關鍵字"> -->
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
                                                <div class="chartwrap bd overflow-x">
                                                    <table class="field">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>類別</th>
                                                                <th>RO</th>
                                                                <th>零件</th>
                                                                <th>機器</th>
                                                                <th>總和</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>數量</td>
                                                                <td>8</td>
                                                                <td>14</td>
                                                                <td>17</td>
                                                                <td>39</td>
                                                            </tr>
                                                            <tr>
                                                                <td>小計</td>
                                                                <td>16736</td>
                                                                <td>19980</td>
                                                                <td>32765</td>
                                                                <td>68134</td>
                                                            </tr>
                                                        </tbody>    
                                                    </table>
                                                </div>
                                                <select name="" id="" class="mt-m mb-s form-control d-inline w-auto">
                                                    <option value="" selected>類別</option>
                                                    <option value="">RO</option>
                                                    <option value="">零件</option>
                                                    <option value="">機器</option>
                                                    <option value="">總和</option>
                                                </select>
                                                <table class="table table-hover dt-responsive table-striped" id="hetao-list-norwd">
                                                    <thead>
                                                        <tr>
                                                            <th class="desktop"></th>
                                                            <th class="desktop">交易日期</th>
                                                            <th class="desktop">交易單號</th>
                                                            <th class="desktop">客戶代碼</th>
                                                            <th class="desktop">卡號</th>
                                                            <th class="desktop">產品代碼</th>
                                                            <th class="desktop">產品規格</th>
                                                            <th class="desktop">類別</th>
                                                            <th class="desktop">數量</th>
                                                            <th class="desktop">單價</th>
                                                            <th class="desktop">小計</th>
                                                        </tr>
                                                    </thead>
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
    var data = [{
            day: "<span class='text-nowrap'>2020-03-20</span>",
            number: "",
            name: "愛酷智能",
            card: "15156",
            productid: "UB-012HG-2",
            productintro: "10加侖全自動開水",
            kind: "機器",
            quantity: "1",
            price: "16190",
            total: "16190",
            invoice: "XX123456",
            company: "愛酷智能科技",
            staff: "Cindy",
            phone: "<a href='tel:0912345678'>0912345678</a>"
        },
        {
            day: "<span class='text-nowrap'>2020-03-20</span>",
            number: "",
            name: "愛酷智能",
            card: "15156",
            productid: "UB-012HG-2",
            productintro: "10加侖全自動開水",
            kind: "機器",
            quantity: "1",
            price: "16190",
            total: "16190",
            invoice: "XX123456",
            company: "愛酷智能科技",
            staff: "Cindy",
            phone: "<a href='tel:0912345678'>0912345678</a>"
        },
    ];

    function format(d) {
        return (
            `<table class="tb-child">
                <tr>
                    <td>發票號碼：` + d.invoice + `</td>
                    <td>客戶全銜：` + d.company + `</td>
                    <td>聯絡人：` + d.staff + `</td>
                    <td class="text-nowrap">聯絡電話：` + d.phone + `</td>
                </tr>
                <tr>
                    
                </tr>
            </table>`
        );
    }
    $(document).ready(function() {
        var table_s2 = $("#hetao-list-norwd").DataTable({
            "data": data,
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
                "targets": [0],
                "orderable": false,
            }, ],
            "responsive": false,
            columns: [
                {
                    className: "details-control",
                    orderable: false,
                    data: null,
                    defaultContent: '<span class="lnr lnr-chevron-down"></span>'
                },
                { data: "day" },
                { data: "number" },
                { data: "name" },
                { data: "card" },
                { data: "productid" },
                { data: "productintro" },
                { data: "kind" },
                { data: "quantity" },
                { data: "price" },
                { data: "total" }

            ],
        });

        $("#hetao-list-norwd tbody").on("click", "td.details-control", function() {
            var tr = $(this).closest("tr");
            var row = table_s2.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass("shown");
            } else {
                row.child(format(row.data()), "p-0").show();
                tr.addClass("shown");
            }
        });

        $(".searchInput_s2").on("blur", function() {
            table_s2.search(this.value).draw();
        });

        $(".searchInput_s2").on("keyup", function() {
            table_s2.search(this.value).draw();
        });
    });
</script>
@endsection