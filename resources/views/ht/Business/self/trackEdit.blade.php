@extends('layout.app')

@section('content')
		<div class="main case">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">業務管理</h3>
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-briefcase"></i>個人業務 - 案件紀錄
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <form>
                                                    <div class="text-primary mx-s">
                                                        <h4 class="bd-bottom">基本資料 <i class="fas fa-caret-right"></i></h4>
                                                    </div>
                                                    <div>
                                                        <div class="col-sm-4">
                                                            <div class="form-item">
                                                                <label class="d-block">拜訪日期</label>
                                                                <div class="datetime">
                                                                    <div class="input-group date day-set">
                                                                        <input class="form-control" placeholder="請選擇日期" type="text"> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">客戶名稱</label>
                                                                <input type="text" class="form-control" value="曾曾">
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">客戶等級</label>
                                                                <select class="form-control mr-s">
                                                                    <option selected hidden disabled value="">請選擇</option>
                                                                    <option value="">A</option>
                                                                    <option value="">B</option>
                                                                    <option value="">C</option>
                                                                    <option value="">D</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">案件進度</label>
                                                                <select class="form-control mr-s">
                                                                    <option selected hidden disabled value="">請選擇</option>
                                                                    <option value=""></option>
                                                                    <option value=""></option>
                                                                    <option value=""></option>
                                                                    <option value=""></option>
                                                                </select>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">客戶類別</label>
                                                                <select class="form-control mr-s">
                                                                    <option selected hidden disabled value="">請選擇</option>
                                                                    <option value=""></option>
                                                                    <option value=""></option>
                                                                    <option value=""></option>
                                                                    <option value=""></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-item">
                                                                <label class="d-block">承辦人</label>
                                                                <input type="text" class="form-control" value="曾曾">
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">電話</label>
                                                                <input type="text" class="form-control" placeholder="">
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">地址</label>
                                                                <div class="d-flex mb-s">
                                                                    <select class="form-control mr-s">
                                                                        <option selected hidden disabled value="">縣市</option>
                                                                    </select>
                                                                    <select class="form-control ml-s">
                                                                        <option selected hidden disabled value="">鄉鎮市</option>
                                                                    </select>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="地址">
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">統編</label>
                                                                <input type="number" class="form-control" placeholder="">
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">信箱</label>
                                                                <input type="email" class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-item">
                                                                <label class="d-block">覆訪日期 <a class="float-right" href="#" data-toggle="modal" data-target="#person-e"><i class="fas fa-bell"></i> 通知</a></label>
                                                                <div class="datetime">
                                                                    <div class="input-group date day-set">
                                                                        <input class="form-control" placeholder="請選擇日期" type="text"> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">結果</label>
                                                                <select class="form-control mr-s result">
                                                                    <option selected hidden disabled value="">請選擇</option>
                                                                    <option value="流單">流單</option>
                                                                    <option value=""></option>
                                                                    <option value=""></option>
                                                                    <option value=""></option>
                                                                </select>
                                                            </div>
                                                            <div class="form-item reason" style="display: none;">
                                                                <label class="d-block">原因</label>
                                                                <input type="text" class="form-control" placeholder="">
                                                            </div>
                                                            <div class="form-item">
                                                                <label class="d-block">備註</label>
                                                                <textarea rows="5" class="form-control" placeholder=""></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-primary mx-s clear">
                                                        <h4 class="bd-bottom">訂單明細 <i class="fas fa-caret-right"></i><a class="opadd" href="#" data-toggle="modal" data-target="#addlist"><i class="fas fa-plus-circle float-right"></i></a></h4>
                                                    </div>
                                                    <div class="bd-bottom p-s mx-s overflow-x">
                                                        <table class="w-100 my-s text-center table-hover" id="showlist">
                                                            <tbody>
                                                                <tr>
                                                                    <th class="text-center p-s text-nowrap">項目</th>
                                                                    <th class="text-center p-s text-nowrap">產品型號</th>
                                                                    <th class="text-center p-s text-nowrap">單價(含稅)</th>
                                                                    <th class="text-center p-s text-nowrap">數量</th>
                                                                    <th class="text-center p-s text-nowrap">合計</th>
                                                                    <th class="text-center p-s text-nowrap">說明</th>
                                                                    <th class="text-center p-s text-nowrap"></th>
                                                                </tr>
                                                            </tbody>    
                                                            <!-- <tr>
                                                                <td>1</td>
                                                                <td>UW-999</td>
                                                                <td>$ 28000</td>
                                                                <td>1</td>
                                                                <td>$ 28000</td>
                                                                <td>純水系統</td>
                                                                <td><a href="#"><i class="fas fa-minus-circle text-danger"></i></a></td>
                                                            </tr> -->
                                                        </table>
                                                    </div>
                                                    <div class="p-s text-center alltotal">
                                                        總價款：
                                                    </div>
                                                    <div class="col-sm-12 mb-s">
                                                        <a href="個人業務.html"><button type="button" class="btn btn-default">返回</button></a>
                                                        <button type="button" class="btn btn-primary">更新</button>
                                                    </div>
                                                </form>
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
<!-- modal addlist -->
    <div id="addlist" class="modal fade Overview-set" role="dialog" style="z-index: 9999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <div class="modal-body">
                    <form action="">
                        <ul>
                            <li class="mb-s">
                                <span class="mb-xs">產品型號</span>
                                <input class="form-control type" type="text" placeholder="">
                            </li>
                            <li class="mb-s dollar">
                                <span class="mb-xs">單價</span>
                                <input class="form-control price" type="number" placeholder="">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">數量</span>
                                <input class="form-control quantity" type="number" placeholder="">
                            </li>
                            <li class="mb-s dollar">
                                <span class="mb-xs">合計</span>
                                <input class="form-control total" type="number" placeholder="">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">說明</span>
                                <input class="form-control intro" type="text" placeholder="">
                            </li>
                            <li class="text-center"><button type="button" class="btn btn-danger">取消</button><button type="button" class="btn btn-primary ok" data-dismiss="modal">新增</button></li>
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
                                <input class="form-control" type="text" placeholder="輸入標題" value="A公司拜訪">
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">內容</span>
                                <textarea class="form-control" rows="1" placeholder="輸入內容">A公司拜訪</textarea>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">通知時間</span>
                                <div class="d-block">
                                    <input class="choose" id="choose1-2" type="radio" name="at-2" value="單次" num="1-2" checked>
                                    <label for="choose1-2" class="chooseitem mr-s">單次</label>
                                    <input class="choose" id="choose2-2" type="radio" name="at-2" value="每日" num="2-2">
                                    <label for="choose2-2" class="chooseitem ml-s mr-s">每日</label>
                                    <input class="choose" id="choose3-2" type="radio" name="at-2" value="每週" num="3-2">
                                    <label for="choose3-2" class="chooseitem ml-s mr-s">每週</label>
                                    <input class="choose" id="choose4-2" type="radio" name="at-2" value="每月" num="4-2">
                                    <label for="choose4-2" class="chooseitem ml-s">每月</label>
                                    <input class="choose" id="choose5-2" type="radio" name="at-2" value="不通知" num="5-2">
                                    <label for="choose5-2" class="chooseitem ml-s">不通知</label>
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
                                            每隔<input class="form-control mx-s dayy" type="number" value="1" min="1">週
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
                                    <option value="">覆訪</option>
                                </select>
                            </li>
                            <li class="mb-s">
                                <span class="mb-xs">備註</span>
                                <textarea class="form-control" rows="1" placeholder="輸入備註"></textarea>
                            </li>
                            <li class="text-center"><button type="button" class="btn btn-danger">取消</button><button type="button" class="btn btn-primary" data-dismiss="modal">確認</button></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    ///////訂單明細新增刪除欄位

    //加總
    function alltotal() {
        var sum = 0;
        if ($('.item').length!==0) {
            for (var i = 0; i < arr.length; i++) {
                sum += parseInt(arr[i].total);
                var alltotal = sum
                $('.alltotal').html('總價款：' + alltotal);
            }

        } else {
            $('.alltotal').html('總價款：' + '');
        }
    }

    //合計自動代入
    $('body').on('keyup', '#addlist .quantity, #addlist .price', function() {
        var price = $('#addlist .price').val()
        var quantity = $('#addlist .quantity').val()
        var total = $('#addlist .total').val(price * quantity)
        total

    });
    //清單物件
    var arr = []
    //清單模板
    var item = `
            <tr class="item" id=val_{{id}}>
                <td>{{num}}</td>
                <td>{{type}}</td>
                <td>{{price}}</td>
                <td>{{quantity}}</td>
                <td class="total-s">{{total}}</td>
                <td>{{intro}}</td>
                <td><a href="javascript:void(0)" class="del" del={{del}}><i class="fas fa-minus-circle text-danger"></i><a></td>
            </tr>`
    //每次新增清空表單        
    $('.opadd').click(function() {
        $('#addlist .price').val('');
        $('#addlist .quantity').val('');
        $('#addlist .total').val('');
        $('#addlist .type').val('');
        $('#addlist .intro').val('');
    });
    //確認新增判斷有填直才push內容
    $('#addlist .ok').on('click', function() {
        var price = $('#addlist .price').val()
        var quantity = $('#addlist .quantity').val()
        var total = $('#addlist .total').val()
        var type = $('#addlist .type').val()
        var intro = $('#addlist .intro').val()
        if ((price || quantity || total || type || intro) !== "") {
            arr.push({ price, quantity, total, type, intro })
            showlist();
        }

        alltotal()

    });

    //顯示清單
    function showlist() {
        var price = $('#addlist .price').val()
        var quantity = $('#addlist .quantity').val()
        var total = $('#addlist .total').val()
        var type = $('#addlist .type').val()
        var intro = $('#addlist .intro').val()

        $('#showlist').html(`<tr>
                                <th class="text-center p-s text-nowrap">項目</th>
                                <th class="text-center p-s text-nowrap">產品型號</th>
                                <th class="text-center p-s text-nowrap">單價(含稅)</th>
                                <th class="text-center p-s text-nowrap">數量</th>
                                <th class="text-center p-s text-nowrap">合計</th>
                                <th class="text-center p-s text-nowrap">說明</th>
                                <th class="text-center p-s text-nowrap"></th>
                            </tr>`)
        for (var i = 0; i < arr.length; i++) {

            var c_item = item.replace("{{id}}", i)
                .replace("{{num}}", i + 1)
                .replace("{{type}}", arr[i].type)
                .replace("{{price}}", arr[i].price)
                .replace("{{quantity}}", arr[i].quantity)
                .replace("{{total}}", arr[i].total)
                .replace("{{intro}}", arr[i].intro)
                .replace("{{del}}", i);

            $('#showlist tbody').append(c_item);


            $(".del[del=" + i + "]").click(
                function() {
                    remove_item(parseInt($(this).attr('del')));
                }


            );

        }
    }

    function remove_item(del) {
        arr.splice(del, 1);
        showlist();
        alltotal()

    }


    ////////流單要填寫原因
    $('select.result').on('change', function() {
        if ($(this).val() == "流單") {
            $('.reason').show();
        } else {
            $('.reason').hide();
        }
    });


    ////////通知時間設定選項
    $('input[name=at-1]').change(function() {
        var num = $(this).attr('num')
        if ($(this).prop('checked') == true) {
            $('.i1, .i2, .i3, .i4').addClass('d-none');
            $('.i' + num).removeClass('d-none');
        }
    });
    $('input[name=at-2]').change(function() {
        var num = $(this).attr('num')
        if ($(this).prop('checked') == true) {
            $('.i1-2, .i2-2, .i3-2, .i4-2').addClass('d-none');
            $('.i' + num).removeClass('d-none');
        }
    });

    ////////通知對象新增
    $('body').on('click', '.Overview-set .add-member.meet', function() {
        var company = $(this).parents('.Overview-set').find(".company").val()
        var role = $(this).parents('.Overview-set').find(".role").val()
        var staffname = $(this).parents('.Overview-set').find(".staffname").val()
        if ((company && role && staffname) !== null) {
            $(this).siblings('.memberwrap').append('<span class="tag"><div><small>' + company + '/' + role + '</small><br>' + staffname + '</div><button class="close" type="button">×</button></span>');
        }
    });

    ////////通知對象/新增星期刪除
    $('body').on('click', '.Overview-set .close', function() {
        $(this).parent('.tag, .week').remove();
    });

    ////////通知對象控制鎖select
    $('body').on('change', '.Overview-set .company', function() {
        if ($(this).val() !== "") {
            $(this).siblings('.role').prop('disabled', '');
        }
    });
    $('body').on('change', '.Overview-set .role', function() {
        if ($(this).val() !== "") {
            $(this).siblings('.staffname').prop('disabled', '');
            $(this).siblings('.staffname').val('');
        }
    });

    ////////通知時間 新增星期
    $('body').on('click', '.Overview-set .add-member.week-b', function() {
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
    });
</script>
@endsection