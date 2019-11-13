@extends('layout.app')

@section('content')
        <div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">總覽 <span>Overview</span></h3>
                     @include('common.message')
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-calendar-alt"></i>行程總覽
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <div id="calendar" class="col-lg-9 col-md-12 px-0 cccalendar"></div>
                                                <div class="col-lg-3 col-md-12 pt-l pr-0 addcalendar" id="addd-form">
                                                    <form class="form-inline" method="post" action="{{ route('ht.Overview.store',['organization'=>$organization]) }}">
                                                        @csrf
                                                        <ul class="add-ul">
                                                            <li class="mb-s"><span class="title-deco activity">新增活動</span>
                                                                <div class="coupon float-right"></div>
                                                            </li>
                                                            <li class="mb-s"><input class="form-control title" type="text" name="title" placeholder="輸入標題" required=""></li>
                                                            <li class="mb-s">
                                                                <i class="fas fa-clock"></i>
                                                                <div class="allday">
                                                                    <span>全天</span>
                                                                    <label class="switch">
                                                                        <input type="checkbox" checked>
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </div>
                                                                <input class='day-select form-control' id="SD1" name="start" placeholder='開始時間' type='text' required=""><input class='hide text-right time-select form-control' name="startTime"  type='text' placeholder="選擇時間" readonly="true"><input class='day-select form-control' id="ED1" name="end" placeholder='結束時間' type='text' required=""><input class='hide text-right time-select form-control' name="endTime" type='text' placeholder="選擇時間" readonly="true">
                                                            </li>
                                                            <li class="mb-s"><i class="fas fa-map-marker-alt"></i><input class="form-control location" type="text" name="position" placeholder="新增位置" required=""></li>
                                                            <li class="mb-s"><i class="fas fa-bell"></i><div class="opmodal o1" data-toggle="modal" data-target="#newalert"><input type="text" id="notice" name="tN" placeholder="新增通知" required=""></div></li>
                                                            <input type="hidden" name="notice">
                                                            <input type="hidden" name="noticeTime">
                                                            <li class="mb-s"><i class="fas fa-users"></i><div class="opmodal o2" data-toggle="modal" data-target="#person"><input type="text" name="meeting" placeholder="會議對象" required=""></div></li>
                                                            <li class="mb-s"><i class="fas fa-align-left"></i><input class="form-control ps" type="text" name="description" placeholder="新增說明" required=""></li>
                                                            <li class="text-center"><div class="coupon"><button type="submit">儲存</button></div></li>
                                                        </ul>
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
        </div>
@endsection

@section('modal')
<!-- Modal 會議內容-->
<!-- <div id="meet" class="modal fade" role="dialog">
    <div class="modal-dialog meeting">
        
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body">
                <div class="addcalendar">
                    <form class="form-inline" action="{{ route('ht.Overview.updateDel',['organization'=>$organization]) }}" method="post">
                        @csrf
                        <ul class="add-ul">
                            <li class="mb-s"><span class="title-deco activity">編輯/刪除活動</span>
                                <div class="coupon float-right"></div>
                            </li>
                            <input type="hidden" name="id2">
                            <li class="mb-s"><input class="form-control title" name="title2" type="text" placeholder="輸入標題" required=""></li>
                            <li class="mb-s">
                                <i class="fas fa-clock"></i>
                                <div class="allday">
                                    <span>全天</span>
                                    <label class="switch">
                                        <input type="checkbox" name="check" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <input class='day-select form-control' name="start2" placeholder='開始時間' type='text' readonly="true" required=""><input class='hide text-right time-select form-control' name="startTime2" placeholder='選擇時間' type='text' readonly="true"><input class='day-select form-control' placeholder='結束時間' name="end2" type='text' readonly="true" required=""><input class='hide text-right time-select form-control' name="endTime2" placeholder='選擇時間' type='text' readonly="true">
                            </li>
                            <li class="mb-s"><i class="fas fa-map-marker-alt"></i><input class="form-control location" name="position2" required="" type="text" placeholder="新增位置"></li>
                            <li class="mb-s"><i class="fas fa-bell"></i>
                                <div class="edit">
                                    <div class="mb-s">
                                        <input class="form-control messenger" type="number" min="1" value="10" name="notice2" required="">
                                        <select class="form-control messenger" name="noticeTime2" id="" required="">
                                            <option value="分鐘前">分鐘前</option>
                                            <option value="小時前">小時前</option>
                                            <option value="天前">天前</option>
                                            <option value="週前">週前</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-s"><i class="fas fa-users"></i>
                                <div class="opmodal o2">會議對象</div>
                                <div>
                                    <select class='form-control mb-s company' name="company2">
                                        <option selected disabled hidden>分公司</option>
                                        <option>台北</option>
                                        <option>新北</option>
                                        <option>桃園</option>
                                        <option>台中</option>
                                        <option>台南</option>
                                        <option>高雄</option>
                                    </select>
                                    <select class='form-control mb-s role' disabled="disabled" name="job2">
                                        <option selected disabled hidden>職稱</option>
                                        <option value="助理">助理</option>
                                        <option value="主管">主管</option>
                                        <option value="員工">員工</option>
                                    </select>
                                    <select class='form-control mb-s staffname' disabled="disabled" name="name2">
                                        <option selected disabled hidden>員工名稱</option>
                                        <option value="小美">小美</option>
                                        <option value="小王">小王</option>
                                        <option value="小名">小名</option>
                                        <option value="小強">小強</option>
                                        <option value="小花">小花</option>
                                        <option value="小白">小白</option>
                                    </select>
                                    <button type="button" class="btn btn-primary add-member">+</button>
                                </div>
                                <div class="memberwrap">
                                </div>
                            </li>
                            <li class="mb-s"><i class="fas fa-align-left"></i><input class="form-control ps" name="description2" type="text" placeholder="新增說明"></li>
                            <li class="mb-s"><i class="fas fa-user"></i><input class="form-control ps" name="owner" type="text" readonly=""></li>
                            <li class="text-center">
                                <div class="coupon"><button type="submit" name="submit[update]">儲存</button>&nbsp;&nbsp;<button type="submit" name="submit[delete]">刪除</button>&nbsp;&nbsp;<button type="button" data-dismiss="modal">關閉</button></div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- Modal 新增通知 -->
<div id="newalert" class="modal fade" role="dialog" style="z-index: 9999;">
    <div class="modal-dialog">
        <div class="modal-content modal-sm">
            <div class="modal-body">
                <div class="mb-s">
                    <input class="form-control" type="number" min="1" value="10">
                </div>
                <div>
                    <div class="d-block"><input class="choose" id="choose1" type="radio" name="t" value="分鐘前" checked><label for="choose1" class="ml-s">分鐘前</label></div>
                    <div class="d-block"><input class="choose" id="choose2" type="radio" name="t" value="小時前"><label for="choose2" class="ml-s">小時前</label></div>
                    <div class="d-block"><input class="choose" id="choose3" type="radio" name="t" value="天前"><label for="choose3" class="ml-s">天前</label></div>
                    <div class="d-block"><input class="choose" id="choose4" type="radio" name="t" value="週前"><label for="choose4" class="ml-s">週前</label></div>
                </div>
                <div class="text-center"><button type="button" class="btn btn-primary" data-dismiss="modal">完成</button></div>
            </div>
        </div>
    </div>
</div>
<!-- Modal 會議對象 -->
<div id="person" class="modal fade" role="dialog" style="z-index: 9999;">
    <div class="modal-dialog">
        <div class="modal-content modal-sm">
            <div class="modal-body">
                <div>
                    <select class='form-control mb-s company' name="company">
                        <option selected disabled hidden>分公司</option>
                    </select>
                    <select class='form-control mb-s role' disabled="disabled" name="job">
                        <option selected disabled hidden>職稱</option>
                        <option value="助理">助理</option>
                        <option value="主管">主管</option>
                        <option value="員工">員工</option>
                        <option value="其他">其他</option>
                    </select>
                    <select class='form-control mb-s staffname' disabled="disabled" name="name">
                        <option selected disabled hidden>員工名稱</option>
                    </select>
                    <div class="memberwrap">
                    </div>    
                </div>
                <div class="text-center"><button type="button" class="btn btn-primary add-member">新增</button><button type="button" class="btn btn-primary finish" data-dismiss="modal">完成</button></div>
            </div>
        </div>
    </div>
</div>

<div id="job1" class="modal fade" role="dialog">
  <div class="modal-dialog meeting">
    <!-- Modal content-->
    <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="modal-body">
        <ul class="add-ul">
            <li class="mb-s">
                <ul>
                    <li id="type"><span>派工類型 </span>維修</li>
                    <li id="custkey"><span>客戶代碼 </span>楊梅國中</li>
                    <li id="address"><span>地址 </span><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></li>
                    <li id="mobile"><span>電話 </span><a href="tel:5551234567">03-3322101</a></li>
                    <li id="reason"><span>派工原因 </span>載清缸 宿舍1.3樓+教學1樓右邊</li>
                    <li id="owner"><span>承辦人員 </span>邱小姐</li>
                    <li id="id"><span>工單編號 </span>00000000</li>
                    <li id="date"><span>工單日期 </span>2019-08-06 10:30</li>
                    <li id="status"><span>狀態 </span>執行中</li>
                </ul>
            </li>
            <li class="mb-s mt-m text-center"><div class="coupon"><button type="button" class="btn" data-dismiss="modal">關閉</button></div></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div id="job2" class="modal fade" role="dialog">
        <div class="modal-dialog meeting">
            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="modal-body">
                    <!-- tab標籤 -->
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#preview-meeting">會議</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#preview-job">工單</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- 會議內容 -->
                        <div class="tab-pane active" id="preview-meeting">
                            <!-- 看 -->
                            <ul id="noMeet">
                                <li class="mb-s"><span class="title-deco active">今日無會議</span>
                                </li>
                            </ul>
                            <ul class="mb-s" id="foreachMeet">
                                <ul class="add-ul readmode" id="meetInfo" style="display: none">
                                    <li class="mb-s" id="allday">
                                        <i class="fas fa-clock fa-fw"></i><span>全天</span>
                                    </li>
                                    <li class="mb-s" id="pos"><i class="fas fa-map-marker-alt fa-fw"></i><span>XXXXX會議室</span></li>
                                    <li class="mb-s" id="people"><i class="fas fa-users fa-fw"></i><span>Vicky, Andy, Luna</span></li>
                                    <li class="mb-s" id="descri"><i class="fas fa-align-left fa-fw"></i><span>記得要下班</span></li>
                                    <li class="mb-s mt-m text-center">
                                        <div class="coupon">
                                            <button type="button" class="btn edit-preview-meeting">編輯</button>
                                            <button type="button" class="btn" data-dismiss="modal">關閉</button>
                                        </div>
                                    </li>
                                </ul>
                            </ul>
                            <!-- 編輯 -->
                            <div class="addcalendar editmode" style="display: none;">
                                <form class="form-inline" action="{{ route('ht.Overview.updateDel',['organization'=>$organization]) }}" method="post">
                                    @csrf
                                    <ul class="add-ul">
                                        <li class="mb-s"><span class="title-deco activity">編輯/刪除活動</span>
                                            <div class="coupon float-right"></div>
                                        </li>
                                        <input type="hidden" name="id2">
                                        <li class="mb-s"><input class="form-control title" name="title2" type="text" placeholder="輸入標題" required=""></li>
                                        <li class="mb-s">
                                            <i class="fas fa-clock"></i>
                                            <div class="allday">
                                                <span>全天</span>
                                                <label class="switch">
                                                    <input type="checkbox" name="check" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                            <input class='day-select form-control' name="start2" placeholder='開始時間' type='text' readonly="true" required=""><input class='hide text-right time-select form-control' name="startTime2" placeholder='選擇時間' type='text' readonly="true"><input class='day-select form-control' placeholder='結束時間' name="end2" type='text' readonly="true" required=""><input class='hide text-right time-select form-control' name="endTime2" placeholder='選擇時間' type='text' readonly="true">
                                        </li>
                                        <li class="mb-s"><i class="fas fa-map-marker-alt"></i><input class="form-control location" name="position2" required="" type="text" placeholder="新增位置"></li>
                                        <li class="mb-s"><i class="fas fa-bell"></i>
                                            <div class="edit">
                                                <div class="mb-s">
                                                    <input class="form-control messenger" type="number" min="1" value="10" name="notice2" required="">
                                                    <select class="form-control messenger" id="noticeTime2" name="noticeTime2" id="" required="">
                                                        <option value="分鐘前">分鐘前</option>
                                                        <option value="小時前">小時前</option>
                                                        <option value="天前">天前</option>
                                                        <option value="週前">週前</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="mb-s"><i class="fas fa-users"></i>
                                            <div class="opmodal o2">會議對象</div>
                                            <div>
                                                <select class='form-control mb-s company' id="company2" name="company2">
                                                    <option selected disabled hidden>分公司</option>
                                                    <option>台北</option>
                                                    <option>新北</option>
                                                    <option>桃園</option>
                                                    <option>台中</option>
                                                    <option>台南</option>
                                                    <option>高雄</option>
                                                </select>
                                                <select class='form-control mb-s role' disabled="disabled" id="job2" name="job2">
                                                    <option selected disabled hidden>職稱</option>
                                                    <option value="助理">助理</option>
                                                    <option value="主管">主管</option>
                                                    <option value="員工">員工</option>
                                                </select>
                                                <select class='form-control mb-s staffname' disabled="disabled" id="name2" name="name2">
                                                    <option selected disabled hidden>員工名稱</option>
                                                    <option value="小美">小美</option>
                                                    <option value="小王">小王</option>
                                                    <option value="小名">小名</option>
                                                    <option value="小強">小強</option>
                                                    <option value="小花">小花</option>
                                                    <option value="小白">小白</option>
                                                </select>
                                                <button type="button" class="btn btn-primary add-member">+</button>
                                            </div>
                                            <div class="memberwrap">
                                            </div>
                                        </li>
                                        <li class="mb-s"><i class="fas fa-align-left"></i><input class="form-control ps" name="description2" type="text" placeholder="新增說明"></li>
                                        <li class="mb-s"><i class="fas fa-user"></i><input class="form-control ps" name="owner" type="text" readonly=""></li>
                                        <li class="text-center">
                                            <div class="coupon"><button type="submit" name="submit[update]">儲存</button>&nbsp;&nbsp;<button type="submit" name="submit[delete]">刪除</button>&nbsp;&nbsp;<button type="button" data-dismiss="modal">關閉</button></div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!-- 工單內容 -->
                        <div class="tab-pane" id="preview-job">
                            <ul class="add-ul">
                                <ul id="noCase">
                                    <li><span>今日無工單</span></li>
                                </ul>
                                <li class="mb-s" id="foreachJob">
                                    <!-- <ul id="jobInfo" style="display: none">
                                        <li id="type"><span>派工類型 </span>維修</li>
                                        <li id="custkey"><span>客戶代碼 </span>楊梅國中</li>
                                        <li id="address"><span>地址 </span><a href="" target="_blank">楊梅區秀才路919號</a></li>
                                        <li id="mobile"><span>電話 </span><a href="tel:5551234567">03-3322101</a></li>
                                        <li id="reason"><span>派工原因 </span>載清缸 宿舍1.3樓+教學1樓右邊</li>
                                        <li id="owner"><span>承辦人員 </span>邱小姐</li>
                                        <li id="id"><span>工單編號 </span>00000000</li>
                                        <li id="date"><span>工單日期 </span>2019-08-06 10:30</li>
                                        <li id="status"><span>狀態 </span>執行中</li>
                                    </ul> -->
                                </li>
                                <li class="mb-s mt-m text-center">
                                    <div class="coupon"><button type="button" class="btn" data-dismiss="modal">關閉</button></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<!-- ▼本頁引用▼ -->
<script src="{{ asset('js/fullcalendar.js') }}"></script>
<script src="{{ asset('js/examples.calendar.js') }}"></script>
<script type="text/javascript">
    
(function($) {

    'use strict';

    var initCalendarDragNDrop = function() {
        $('#external-events div.external-event').each(function() {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });
    };

    var initCalendar = function() {
        var $calendar = $('#calendar');
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        var count = new Array();
        var chart_json = new Array(); 
        var test = new Array();

        $.ajax({
            method:'get',
            url:'{{ route('ht.Overview.getData',['organization'=>$organization]) }}',
            data:{
                "token": 'U2f6ef40c08eb97d124a67970ec337822',
                "DEPT": 'H026'
            },
            dataType:'json',
            success:function(data){

                // for (var i = 0; i < data[2].length; i++) {
                //     var arr1 = data[1][data[2][i]][0];
                //     var arr2 = data[1][data[2][i]][1];
                //     var arr3 = arr1.concat(arr2);

                //     test.push(arr3);
                // }

                // console.log(test);

                // $.each(data[0], function (i, item) {

                //     if(item[10] == undefined){
                //         chart_json.push({'title':""+item[7].date+" "+item[6].number.split("|||").length+"張工單",'start':item[7].date,'url':'#job2','className':'fc-event-success','allDay':true,'id':item[6].number,'owner':item[5].owner,'type':item[0].type,'time':item[7].date,'custkey':item[1].custkey,'address':item[2].address,'mobile':item[3].mobile,'reason':item[4].remarks,'status':item[8].status,'category':'job'});
                //     }
                // });

                // console.log(chart_json)

                $.ajax({
                    method:'get',
                    url:'{{ route('ht.Overview.show',['organization'=>$organization]) }}',
                    data:{
                        "token": 'U2f6ef40c08eb97d124a67970ec337822',
                        "DEPT": 'H026'
                    },
                    dataType:'json',
                    success:function(response){

                        // $.each(response, function (i, item) {

                        //    if(item[2].start.split(" ")[1] == '00:00:00' && item[2].start == item[3].end){

                        //         chart_json.push({'id':item[0].id,'title':item[0].id.split("|||").length+"場活動",'start':item[2].start.split(" ")[0],'end':item[3].end.split(" ")[0],'url':'#job2','allDay':true,'position':item[4].position,'meeting':item[5].meeting,'notice':item[6].notice,'noticeTime':item[7].noticeTime,'description':item[8].description,'owner':item[9].user_id,'category':'meet'});
                        //    }
                        //    else if(item[2].start.split(" ")[1] == '00:00:00'){

                        //         var date = new Date(item[3].end);
                        //         var end = date.setTime(date.getTime()+24*60*60*1000);
                        //         var resEnd = date.getFullYear()+"-" + ('0' + (date.getMonth()+1)).slice(-2) + "-" + ('0' + date.getDate()).slice(-2)

                        //         chart_json.push({'id':item[0].id,'title':item[0].id.split("|||").length+"場活動",'start':item[2].start.split(" ")[0],'end':resEnd,'url':'#job2','allDay':true,'position':item[4].position,'meeting':item[5].meeting,'notice':item[6].notice,'noticeTime':item[7].noticeTime,'description':item[8].description,'owner':item[9].user_id,'category':'meet'});
                        //    }
                        //    else{
                        //         chart_json.push({'id':item[0].id,'title':item[0].id.split("|||").length+"場活動",'start':item[2].start,'end':item[3].end,'url':'#job2','allDay':true,'position':item[4].position,'meeting':item[5].meeting,'notice':item[6].notice,'noticeTime':item[7].noticeTime,'description':item[8].description,'owner':item[9].user_id,'category':'meet'});
                        //    }
                        // });

                        $calendar.fullCalendar({
                            eventLimit: true,  
                            views: {  
                                agenda: {  
                                    eventLimit: 2
                                }  
                            },  
                            header: {
                                left: 'title',
                                right: 'prev,today,next,basicDay,basicWeek,month,search'
                            },
                            timeFormat: 'h:mm',
                            themeButtonIcons: {
                                prev: 'fas fa-caret-left',
                                next: 'fas fa-caret-right',
                            },
                            editable: false,
                            droppable: false,
                            drop: function(date, allDay) {
                                var $externalEvent = $(this);

                                var originalEventObject = $externalEvent.data('eventObject');

                                var copiedEventObject = $.extend({}, originalEventObject);

                                copiedEventObject.start = date;
                                copiedEventObject.allDay = allDay;
                                copiedEventObject.className = $externalEvent.attr('data-event-class');

                                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                                if ($('#RemoveAfterDrop').is(':checked')) {
                                    $(this).remove();
                                }
                            },
                            events: chart_json,
                            eventClick: function(info) {

                                $("ul[id='noCase']").html("<li><span>今日無工單</span></li>");
                                $("ul[id='noMeet']").html("<li><span>今日無會議</span></li>");

                                if(info.category == 'job'){

                                    var number = info.type.split("|||").length;

                                    $("ul[id='noCase']").html("");
                                    $("li[id='foreachJob']").html("");
                                    $("ul[id='jobInfo']").attr("style","display:block");

                                    for (var i = 0; i < number; i++) {
                                        // $("li[id='type']").append("<span>派工類型 </span>"+info.type.split("|||")[i]+"");
                                        // $("li[id='custkey']").append("<span>客戶代碼 </span>"+info.custkey.split("|||")[i]+"");
                                        // $("li[id='address']").append("<span>地址 </span><a href='https://www.google.com.tw/maps/place/"+info.address.split("|||")[i]+"' target='_blank'>"+info.address.split("|||")[i]+"</a>");
                                        // $("li[id='mobile']").append("<span>電話 </span><a href='tel:"+info.mobile.split("|||")[i]+"'>"+info.mobile.split("|||")[i]+"</a>");
                                        // $("li[id='reason']").append("<span>派工原因 </span>"+info.reason+"");
                                        // $("li[id='owner']").append("<span>承辦人員 </span>"+info.owner.split("|||")[i]+"");
                                        // $("li[id='id']").append("<span>工單編號 </span>"+info.id.split("|||")[i]+"");
                                        // $("li[id='date']").append("<span>工單日期 </span>"+info.time+"");
                                        // $("li[id='status']").append("<span>狀態 </span>"+info.status.split("|||")[i]+"");

                                        $("li[id='foreachJob']").append("<ul><li><span>派工類型 </span>"+info.type.split("|||")[i]+"</li><li><span>客戶代碼 </span>"+info.custkey.split("|||")[i]+"</li><li><span>地址 </span><a href='https://www.google.com.tw/maps/place/"+info.address.split("|||")[i]+"' target='_blank'>"+info.address.split("|||")[i]+"</a></li><li><span>電話 </span><a href='tel:"+info.mobile.split("|||")[i]+"'>"+info.mobile.split("|||")[i]+"</a></li><li><span>派工原因 </span>載清缸 宿舍1.3樓+教學1樓右邊</li><li><span>承辦人員 </span>"+info.owner.split("|||")[i]+"</li><li><span>工單編號 </span>"+info.id.split("|||")[i]+"</li><li><span>工單日期 </span>"+info.time+"</li><li><span>狀態 </span>"+info.status.split("|||")[i]+"</li></ul>")
                                    }
                                    
                                }
                                else{
                                    console.log(info)

                                    // $("div[class='memberwrap']").html("");
                                    // $("ul[id='noMeet']").html("");
                                    // $("ul[id='meetInfo']").attr("style","display:block");

                                    //  var selOpts = "<option value='分鐘前'>分鐘前</option><option value='小時前'>小時前</option><option value='天前'>天前</option><option value='週前'>週前</option>";

                                    // $("select[name='noticeTime2']").empty();
                                    // $("select[name='noticeTime2']").append(selOpts);

                                    // //是否全天
                                    // if(info.start._i.split(" ")[1] == undefined && info.end == null){
                                    //     $("li[id='allday']").html("<i class='fas fa-clock fa-fw'></i><span>全天</span>");
                                    // }
                                    // else if(info.start._i.split(" ")[1] == undefined){
                                    //     $("li[id='allday']").html("<i class='fas fa-clock fa-fw'></i><span>全天</span>");
                                    // }
                                    // else{
                                    //     $("li[id='allday']").html("<i class='fas fa-clock fa-fw'></i><span>"+info.start._i.split(" ")[1]+"~"+info.end._i.split(" ")[1]+"</span>");
                                    // }

                                    // $("li[id='pos']").html("<i class='fas fa-map-marker-alt fa-fw'></i><span>"+info.position+"</span>");
                                    // //會議對象
                                    // for (var i = 0; i < info.meeting.split(",").length; i++) {
                                    //     if(i == 0){
                                    //         $("li[id='people']").html("<i class='fas fa-users fa-fw'></i><span>"+info.meeting.split(",")[i]+"</span>");
                                    //     }
                                    //     else{
                                    //         $("li[id='people']").append("<li><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+info.meeting.split(",")[i]+"</span></li>");
                                    //     }
                                        
                                    // }
                                    // $("li[id='descri']").html("<i class='fas fa-align-left fa-fw'></i><span>"+info.description+"</span>");

                                    // $("input[name='id2']").val(info.id);
                                    // $("input[name='title2']").val(info.title);
                                    // $("input[name='position2']").val(info.position);
                                    // $("input[name='notice2']").val(info.notice);
                                    // $("input[name='owner']").val(info.owner);
                                    

                                    // //以下為編輯頁面
                                    // var numbers = $("select[name='noticeTime2']").find("option");

                                    // for (var j = 0; j < numbers.length; j++) {
                                    //     if ($(numbers[j]).val() == info.noticeTime) {
                                    //         $(numbers[j]).attr("selected", "selected");
                                    //     }
                                    // }

                                    // for (var i = 0; i < info.meeting.split(",").length; i++) {
                                    //     $("div[class='memberwrap']").append("<span class='tag'><div><small>"+info.meeting.split(",")[i]+"</small></div><button class='close' type='button'>×</button><input type='hidden' name='meeting2[]' value="+info.meeting.split(",")[i]+"></span>")
                                    // }
                                    // $("input[name='description2']").val(info.description);

                                    // //以下為時間判斷
                                    // if(info.start._i.split(" ")[1] == undefined && info.end == null){

                                    //     $('.addcalendar .time-select').addClass('hide');
                                    //     $('.addcalendar .day-select').css('width', '100%');
                                    //     $('.addcalendar .day-select').css('display', 'inline-block');
                                    //     $('.addcalendar .time-select').css('display', 'inline-block');

                                    //     $("input[name='startTime2']").val("")
                                    //     $("input[name='endTime2']").val("")

                                    //     $("div[class='allday']").html("<span>全天</span><label class='switch'><input type='checkbox' name='check' checked><span class='slider round'></span></label>");
                                    //     $("input[name='start2']").val(info.start._i);
                                    //     $("input[name='end2']").val(info.start._i);
                                    // }
                                    // else if(info.start._i.split(" ")[1] == undefined){

                                    //     $('.addcalendar .time-select').addClass('hide');
                                    //     $('.addcalendar .day-select').css('width', '100%');
                                    //     $('.addcalendar .day-select').css('display', 'inline-block');
                                    //     $('.addcalendar .time-select').css('display', 'inline-block');

                                    //     $("input[name='startTime2']").val("")
                                    //     $("input[name='endTime2']").val("")

                                    //     $("div[class='allday']").html("<span>全天</span><label class='switch'><input type='checkbox' name='check' checked><span class='slider round'></span></label>");
                                    //     $("input[name='start2']").val(info.start._i);
                                    //     $("input[name='end2']").val(info.end._i);
                                    // }
                                    // else{

                                    //     $('.addcalendar .time-select').removeClass('hide');
                                    //     $('.addcalendar .day-select').css('width', '50%');
                                    //     $('.addcalendar .day-select').css('display', 'inline-block');
                                    //     $('.addcalendar .time-select').css('display', 'inline-block');

                                    //     $("div[class='allday']").html("<span>全天</span><label class='switch'><input type='checkbox' name='check'><span class='slider round'></span></label>")
                                    //     $("input[name='start2']").val(info.start._i.split(" ")[0])
                                    //     $("input[name='end2']").val(info.end._i.split(" ")[0])

                                    //     $("input[name='startTime2']").attr("style","display: inline-block");
                                    //     $("input[name='startTime2']").attr("class","text-right time-select form-control");
                                    //     $("input[name='endTime2']").attr("style","display: inline-block");
                                    //     $("input[name='endTime2']").attr("class","text-right time-select form-control");

                                    //     $("input[name='startTime2']").val(info.start._i.split(" ")[1])
                                    //     $("input[name='endTime2']").val(info.end._i.split(" ")[1])
                                    //}
                                }

                                $(info.url).modal('show')
                            }
                        });
                    }
                })
            }
        })


        // FIX INPUTS TO BOOTSTRAP VERSIONS
        var $calendarButtons = $calendar.find('.fc-header-right > span');
        $calendarButtons
            .filter('.fc-button-prev, .fc-button-today, .fc-button-next')
                .wrapAll('<div class="btn-group mt-sm mr-md mb-sm ml-sm"></div>')
                .parent()
                .after('<br class="hidden"/>');

        $calendarButtons
            .not('.fc-button-prev, .fc-button-today, .fc-button-next')
                .wrapAll('<div class="btn-group mb-sm mt-sm"></div>');

        $calendarButtons
            .attr({ 'class': 'btn btn-sm btn-default' });
    };

    $(function() {
        initCalendar();
        initCalendarDragNDrop();
    });

}).apply(this, [jQuery]);
</script>
<script>
    $(document).ready(function() {
        $(".fc-right").append(
            "<div class='coupon'>" +
            "<form class='form-inline'>" +
            "<div class='form-group'><div class='input-group search mr-s'>" +
            "<input type='text' class='form-control' placeholder='請輸入關鍵字'><div class='input-group-btn text-right'><button class='btn btn-default' type='button'><i class='fas fa-search'></i></button>" +
            "</div>" +
            "</div>" +
            "<div class='datetime'>" +
            "<div class='input-group date day-select'>" +
            "<input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div></div><span class='rwd-hide'>~</span><div class='datetime'>" +
            "<div class='input-group date day-select mr-s'>" +
            "<input class='form-control' placeholder='選擇結束日期' type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "<div class='btn-wrap'>" +
            "<button class='mr-s' href=''>確認送出</button>" +
            "<button class='mr-s' href=''>重新設定時間</button>" +
            "<a href='#addd-form'><button class='btn-bright addd' type='button'><i class='fas fa-plus mr-s'></i>新增</button></a>"+
            "</div>" +
            "</form>" +
            "</div>");


        $.ajax({
            url:"{{ route('ht.Overview.getCompany',['organization'=>$organization]) }}", 
            method:"get",
            dataType:'json',                 
            success:function(res){
                var selOpts = "<option selected disabled hidden>分公司</option>";
                $.each(res, function (i, item) {
                    selOpts += "<option value='"+item.name+"'>"+item.name+"</option>";
                })

                $("select[name='company']").empty();
                $("select[name='company']").append(selOpts);

                $("select[name='company2']").empty();
                $("select[name='company2']").append(selOpts);
            }
        })

        $("select[name='job']").on('change',function(){

            var company = $("select[name='company']").val();
            var job = $("select[name='job']").val();

            $.ajax({
                url:"{{ route('ht.Overview.getName',['organization'=>$organization]) }}", 
                method:"post",
                dataType:'json',
                data:{
                    '_token':'{{csrf_token()}}',
                    'company':company,
                    'job':job
                },              
                success:function(res){
                    
                    
                    if(res == ""){
                        var selOpts = "<option selected disabled hidden>員工名稱</option><option disabled>沒有人員</option>";
                    }
                    else{
                       var selOpts = "<option selected disabled hidden>員工名稱</option>";
                    }

                    $.each(res, function (i, item) {
                        selOpts += "<option value='"+item.name+"'>"+item.name+"</option>";
                    })

                    $("select[name='name']").empty();
                    $("select[name='name']").append(selOpts);
                }
            })
        });

        $("select[name='job2']").on('change',function(){

            var company = $("select[id='company2']").val();
            var job = $("select[id='job2']").val();

            $.ajax({
                url:"{{ route('ht.Overview.getName',['organization'=>$organization]) }}", 
                method:"post",
                dataType:'json',
                data:{
                    '_token':'{{csrf_token()}}',
                    'company':company,
                    'job':job
                },              
                success:function(res){

                    if(res == ""){
                        var selOpts = "<option selected disabled hidden>員工名稱</option><option disabled>沒有人員</option>";
                    }
                    else{
                       var selOpts = "<option selected disabled hidden>員工名稱</option>";
                    }
                    
                    $.each(res, function (i, item) {
                        selOpts += "<option value='"+item.name+"'>"+item.name+"</option>";
                    })

                    $("select[name='name2']").empty();
                    $("select[name='name2']").append(selOpts);
                }
            })
        });

    });
    </script>
    <script type="text/javascript">
        $("#SD1").on("dp.change", function (e) {
            $('#ED1').data("DateTimePicker").minDate(e.date);
        });
        $("#ED1").on("dp.change", function (e) {
            $('#SD1').data("DateTimePicker").maxDate(e.date);
        });
    </script>
    <script type="text/javascript">
        $('#job2').on('hidden.bs.modal', function () {
            $("div[class='memberwrap']").html("");
            $("ul[id='jobInfo']").attr("style","display:none");
            $("ul[id='meetInfo']").attr("style","display:none");
            $("li[id='foreachJob']").html("");
        })
    </script>
@endsection