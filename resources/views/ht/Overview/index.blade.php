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
                                                                <input class='day-select form-control' id="SD1" name="start" placeholder='開始時間' readonly=""><input class='hide text-right time-select form-control' readonly="" name="startTime"  type='text' placeholder="選擇時間" readonly="true"><input class='day-select form-control'  id="ED1" name="end" placeholder='結束時間' readonly=""><input class='hide text-right time-select form-control' readonly="" name="endTime" type='text' placeholder="選擇時間" readonly="true">
                                                            </li>
                                                            <li class="mb-s"><i class="fas fa-map-marker-alt"></i><input class="form-control location" type="text" name="position" placeholder="新增位置" required=""></li>
                                                            <li class="mb-s"><i class="fas fa-bell"></i><input id="notice" id="notice" name="tN" placeholder="新增通知" required="" class="opmodal o1 form-control" data-toggle="modal" data-target="#newalert"></li>
                                                            <input type="hidden" name="notice">
                                                            <input type="hidden" name="noticeTime">
                                                            <li class="mb-s"><i class="fas fa-users"></i>
                                                                <textarea name="meeting" id="meeting" placeholder="會議對象" required="" class="opmodal o2 form-control" data-toggle="modal" data-target="#person" spellcheck="false"></textarea>
                                                                <!-- <input name="meeting" id="meeting" placeholder="會議對象" required="" class="opmodal o2 form-control" data-toggle="modal" data-target="#person"> --></li>
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
<div id="meet" class="modal fade" role="dialog">
        <div class="modal-dialog meeting">
            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="modal-body">
                    <div class="tab-content">
                        <!-- 會議內容 -->
                        <div class="tab-pane active" id="preview-meeting">
                            <ul id="foreachMeet">
                                <!-- <ul class="mb-s">
                                    <ul class="add-ul readmode" id="meetInfo">
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
                                </ul> -->
                            </ul>
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
                                            <input class='day-select form-control' readonly="" id="start2" name="start2"  placeholder='開始時間'><input class='hide text-right time-select form-control' readonly="" name="startTime2" placeholder='選擇時間' type='text' readonly="true"><input class='day-select form-control' readonly="" placeholder='結束時間' id="end2" name="end2"><input class='hide text-right time-select form-control' readonly="" name="endTime2" placeholder='選擇時間' type='text' readonly="true">
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
                                                    @foreach($company as $data)
                                                    @if($data->id == Auth::user()->organization_id)
                                                    <option selected value="{{$data->name}}">{{$data->name}}</option>
                                                    @else
                                                    <option value="{{$data->name}}">{{$data->name}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                <select class='form-control mb-s role' id="job2" name="job2">
                                                    <option value="" selected="" disabled="">請選擇職稱</option>
                                                    <option value="助理">助理</option>
                                                    <option value="主管">主管</option>
                                                    <option value="員工">員工</option>
                                                    <option value="其他">其他</option>
                                                </select>
                                                <select class='form-control mb-s staffname' id="name2" name="name2" disabled="">
                                                    <option value="" selected="" disabled="">員工名稱</option>
                                                </select>
                                                <button type="button" class="btn btn-primary add-member">+</button>
                                            </div>
                                            <div class="memberwrap">
                                            </div>
                                        </li>
                                        <li class="mb-s"><i class="fas fa-align-left"></i><input class="form-control ps" name="description2" type="text" placeholder="新增說明"></li>
                                        <li class="mb-s"><i class="fas fa-user"></i><input class="form-control ps" name="owner" type="text" readonly=""></li>
                                        <input type="hidden" name="meetingToken">
                                        <li class="text-center">
                                            <div class="coupon"><button type="submit" name="submit[update]">儲存</button>&nbsp;&nbsp;<button type="submit" name="submit[delete]">刪除</button>&nbsp;&nbsp;<button type="button" data-dismiss="modal">關閉</button></div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal 新增通知 -->
<div id="newalert" class="modal fade" role="dialog" style="z-index: 9999;">
    <div class="modal-dialog">
        <div class="modal-content">
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
        <div class="modal-content">
            <div class="modal-body">
                <div>
                    <select class='form-control mb-s company' name="company">
                        @foreach($company as $data)
                            @if($data->id == Auth::user()->organization_id)
                        <option selected value="{{$data->name}}">{{$data->name}}</option>
                            @else
                        <option value="{{$data->name}}">{{$data->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <select class='form-control mb-s role' name="job">
                        <option value="助理">助理</option>
                        <option selected value="主管">主管</option>
                        <option value="員工">員工</option>
                        <option value="其他">其他</option>
                    </select>
                    <select class='form-control mb-s staffname' name="name">
                        @if($user->isEmpty())
                        <option selected disabled>沒有人員</option>
                        @else
                        <option selected disabled hidden>員工名稱</option>
                        @foreach($user as $data)
                        <option value="{{$data->token}}">{{$data->name}}</option>
                        @endforeach
                        @endif
                    </select>
                    <div class="memberwrap">
                    </div>    
                </div>
                <div class="text-center"><button type="button" class="btn btn-primary add-member" id="addName">新增</button><button type="button" class="btn btn-primary finish" data-dismiss="modal">完成</button></div>
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
                <li class="mb-s" id="foreachJob">
                    <!-- <ul>
                        <li id="type"><span>派工類型 </span>維修</li>
                        <li id="custkey"><span>客戶代碼 </span>楊梅國中</li>
                        <li id="address"><span>地址 </span><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></li>
                        <li id="mobile"><span>電話 </span><a href="tel:5551234567">03-3322101</a></li>
                        <li id="reason"><span>派工原因 </span>載清缸 宿舍1.3樓+教學1樓右邊</li>
                        <li id="owner"><span>承辦人員 </span>邱小姐</li>
                        <li id="id"><span>工單編號 </span>00000000</li>
                        <li id="date"><span>工單日期 </span>2019-08-06 10:30</li>
                        <li id="status"><span>狀態 </span>執行中</li>
                    </ul> -->
                </li>
            </li>
            <li class="mb-s mt-m text-center"><div class="coupon"><button type="button" class="btn" data-dismiss="modal">關閉</button></div></li>
        </ul>
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
        var sameDateArray = new Array();

        $.ajax({
            method:'get',
            url:'{{ route('ht.Overview.getData',['organization'=>$organization]) }}',
            data:{
                "token": '{{Auth::user()->token}}',
                "DEPT": '{{Auth::user()->department->name}}'
            },
            dataType:'json',
            success:function(data){

                $.each(data, function (i, item) {

                    chart_json.push({'title':""+item[6].number.split("|||").length+"張工單",'start':item[7].date,'url':'#job1','className':'fc-event-success','allDay':true,'id':item[6].number,'owner':item[5].owner,'type':item[0].type,'time':item[7].date,'custkey':item[1].custkey,'address':item[2].address,'mobile':item[3].mobile,'remarks':item[4].reason,'status':item[8].status,'category':'job'});
                });

                $.ajax({
                    method:'get',
                    url:'{{ route('ht.Overview.show',['organization'=>$organization]) }}',
                    dataType:'json',
                    success:function(response){

                        var dateArray = new Array()
                        var samedate = new Array();
                        var tArray = new Array();

                        function getDays(day1, day2) {

                            var st = day1.getDate();
                            var et = day2.getDate();

                            var retArr = [];


                            var yyyy = st.getFullYear(),
                            mm = st.getMonth(),
                            dd = st.getDate();


                            while (st.getTime() != et.getTime()) {
                                retArr.push(st.getYMD());


                                if (st.getTime() > et.getTime()) return; st = new Date(yyyy, mm, ++dd);
                            }


                            retArr.push(et.getYMD());

                            return retArr; 
                        }


                        Date.prototype.getYMD = function(){


                            return [this.getFullYear(), fz(this.getMonth() + 1), fz(this.getDate())].join("-");
                        }

                        String.prototype.getDate = function(){
                            var strArr = this.split('-');
                            return new Date(strArr[0], strArr[1] - 1, strArr[2]);
                        }

                        function fz(num) {
                            if (num < 10) {
                                num = "0" + num;
                            }
                            return num
                        }


                        var collectionRepeat = function(box, key){
                            var counter = {};

                            box.forEach(function(x) { 
                                counter[x] = (counter[x] || 0) + 1; 
                            });

                            var val = counter[key];

                            if (key === undefined) {
                                return counter;
                            }

                            return (val) === undefined ? 0 : val;
                        }

                       $.each(response, function (i, item) {

                            var start = item.start.split(" ")[0]
                            var end = item.end.split(" ")[0]
                            var all = getDays(start,end)

                            for (var i = 0; i < all.length; i++) {
                                dateArray.push(all[i]);
                            }
                        })

                       var resArray = collectionRepeat(dateArray);

                       var  key = Object.keys(resArray);
                       var  value = Object.values(resArray);

                       for (var i = 0; i < Object.keys(resArray).length; i++) {
                            tArray.push([key[i],value[i]])
                       }

                       $.each(tArray, function (i, item) {
                            chart_json.push({'title':item[1]+"場活動",'start':item[0],'url':'#meet','allDay':true});
                       })

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

                                if(info.url == '#job1'){

                                    var number = info.type.split("|||").length;

                                    $("ul[id='noCase']").html("");
                                    $("li[id='foreachJob']").html("");
                                    $("ul[id='jobInfo']").attr("style","display:block");

                                    for (var i = 0; i < number; i++) {

                                        if(info.status.split("|||")[i] == '' || info.status.split("|||")[i] == 'null'){
                                            $("li[id='foreachJob']").append("<ul><li><span class='m-j-list'>工單編號 </span><span class='m-j-list'>"+info.id.split("|||")[i]+"</span></li><li><span class='m-j-list'>工單日期 </span><span class='m-j-list'>"+info.time+"</span></li><li><span class='m-j-list'>派工類型 </span><span class='m-j-list'>"+info.type.split("|||")[i]+"</span></li><li><span class='m-j-list'>客戶代碼 </span>"+info.custkey.split("|||")[i]+"<span></li><li><span class='m-j-list'>聯絡地址 </span><span class='m-j-list'><a href='https://www.google.com.tw/maps/place/"+info.address.split("|||")[i]+"' target='_blank'>"+info.address.split("|||")[i]+"</a><span></li><li><span class='m-j-list'>聯絡電話 </span><span class='m-j-list'><a href='tel:"+info.mobile.split("|||")[i]+"'>"+info.mobile.split("|||")[i]+"</a></span></li><li><span class='m-j-list'>派工原因 </span><span class='m-j-list'>"+info.remarks.split("|||")[i]+"</span></li><li><span class='m-j-list'>承辦人員 </span><span class='m-j-list'>"+info.owner.split("|||")[i]+"</span></li><li><span class='m-j-list'>工單狀態 </span><span class='m-j-list'>執行中</span></li></ul>")
                                        }
                                        else if(info.status.split("|||")[i] == 'F'){
                                            $("li[id='foreachJob']").append("<ul><li><span class='m-j-list'>工單編號 </span><span class='m-j-list'>"+info.id.split("|||")[i]+"</span></li><li><span class='m-j-list'>工單日期 </span><span class='m-j-list'>"+info.time+"</span></li><li><span class='m-j-list'>派工類型 </span><span class='m-j-list'>"+info.type.split("|||")[i]+"</span></li><li><span class='m-j-list'>客戶代碼 </span>"+info.custkey.split("|||")[i]+"<span></li><li><span class='m-j-list'>聯絡地址 </span><span class='m-j-list'><a href='https://www.google.com.tw/maps/place/"+info.address.split("|||")[i]+"' target='_blank'>"+info.address.split("|||")[i]+"</a><span></li><li><span class='m-j-list'>聯絡電話 </span><span class='m-j-list'><a href='tel:"+info.mobile.split("|||")[i]+"'>"+info.mobile.split("|||")[i]+"</a></span></li><li><span class='m-j-list'>派工原因 </span><span class='m-j-list'>"+info.remarks.split("|||")[i]+"</span></li><li><span class='m-j-list'>承辦人員 </span><span class='m-j-list'>"+info.owner.split("|||")[i]+"</span></li><li><span class='m-j-list'>工單狀態 </span><span class='m-j-list'>延後</span></li></ul>")
                                        }
                                        else if(info.status.split("|||")[i] == 'R'){
                                            $("li[id='foreachJob']").append("<ul><li><span class='m-j-list'>工單編號 </span><span class='m-j-list'>"+info.id.split("|||")[i]+"</span></li><li><span class='m-j-list'>工單日期 </span><span class='m-j-list'>"+info.time+"</span></li><li><span class='m-j-list'>派工類型 </span><span class='m-j-list'>"+info.type.split("|||")[i]+"</span></li><li><span class='m-j-list'>客戶代碼 </span>"+info.custkey.split("|||")[i]+"<span></li><li><span class='m-j-list'>聯絡地址 </span><span class='m-j-list'><a href='https://www.google.com.tw/maps/place/"+info.address.split("|||")[i]+"' target='_blank'>"+info.address.split("|||")[i]+"</a><span></li><li><span class='m-j-list'>聯絡電話 </span><span class='m-j-list'><a href='tel:"+info.mobile.split("|||")[i]+"'>"+info.mobile.split("|||")[i]+"</a></span></li><li><span class='m-j-list'>派工原因 </span><span class='m-j-list'>"+info.remarks.split("|||")[i]+"</span></li><li><span class='m-j-list'>承辦人員 </span><span class='m-j-list'>"+info.owner.split("|||")[i]+"</span></li><li><span class='m-j-list'>工單狀態 </span><span class='m-j-list'>轉單</span></li></ul>")
                                        }
                                        else{
                                            $("li[id='foreachJob']").append("<ul><li><span class='m-j-list'>工單編號 </span><span class='m-j-list'>"+info.id.split("|||")[i]+"</span></li><li><span class='m-j-list'>工單日期 </span><span class='m-j-list'>"+info.time+"</span></li><li><span class='m-j-list'>派工類型 </span><span class='m-j-list'>"+info.type.split("|||")[i]+"</span></li><li><span class='m-j-list'>客戶代碼 </span>"+info.custkey.split("|||")[i]+"<span></li><li><span class='m-j-list'>聯絡地址 </span><span class='m-j-list'><a href='https://www.google.com.tw/maps/place/"+info.address.split("|||")[i]+"' target='_blank'>"+info.address.split("|||")[i]+"</a><span></li><li><span class='m-j-list'>聯絡電話 </span><span class='m-j-list'><a href='tel:"+info.mobile.split("|||")[i]+"'>"+info.mobile.split("|||")[i]+"</a></span></li><li><span class='m-j-list'>派工原因 </span><span class='m-j-list'>"+info.remarks.split("|||")[i]+"</span></li><li><span class='m-j-list'>承辦人員 </span><span class='m-j-list'>"+info.owner.split("|||")[i]+"</span></li><li><span class='m-j-list'>工單狀態 </span><span class='m-j-list'>已完成</span></li></ul>")
                                        }
                                    }
                                    
                                }
                                else{
                                    $.ajax({
                                        method:'post',
                                        url:'{{ route('ht.Overview.search',['organization'=>$organization]) }}',
                                        dataType:'json',
                                        data:{
                                            '_token':'{{csrf_token()}}',
                                            'date':info.start._i
                                        },
                                        success:function(response){

                                            $("ul[id='foreachMeet']").html("");
                                            $('.editmode').css('display', 'none');

                                            $.each(response, function (i, item) {

                                                for (var i = 0; i < item.length; i++) {
                                                    if(item[i].start.split(" ")[1] == '00:00:00' && item[i].start == item[i].end){

                                                        var selOpts = "<ul class='mb-s readmode'><ul class='add-ul' id='meetInfo'><li class='mb-s' hidden id='id'><i class='fas fa-clock fa-fw'></i><span>"+item[i].id+"</span></li><li class='mb-s' id='title'><span class='title-deco active'>"+item[i].title+"</span></li><li class='mb-s' id='allday'><i class='fas fa-clock fa-fw'></i><span>全天</span></li><li class='mb-s' id='pos'><i class='fas fa-map-marker-alt fa-fw'></i><span><a href='https://www.google.com.tw/maps/place/"+item[i].position+"' target='_blank'>"+item[i].position+"</a></span></li>"

                                                        for (var j = 0; j < item[i].meeting.split(",").length; j++) {
                                                            if(j == 0){
                                                                var selOpts2 = "<i class='fas fa-users fa-fw'></i><span>"+item[i].meeting.split(",")[j]+"</span>";
                                                            }
                                                            else{
                                                                selOpts2 +=  "<li><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+item[i].meeting.split(",")[j]+"</span></li>";
                                                            }
                                                        }

                                                        var selOpts4 = "<li class='mb-s' id='descri'><i class='fas fa-align-left fa-fw'></i><span>"+item[i].description+"</span></li><li class='mb-s mt-m text-center'><div class='coupon'><button type='button' class='btn edit-preview-meeting'>編輯</button><button type='button' class='btn' data-dismiss='modal'>關閉</button></div></li></ul></ul>"

                                                        var res = selOpts+selOpts2+selOpts4

                                                        $("ul[id='foreachMeet']").append(res);

                                                        //button
                                                        $('.edit-preview-meeting').on('click', function(event) {

                                                            $('.readmode').css('display', 'none');

                                                            var id = $(this).closest("ul").children("li:eq(0)").text()

                                                             $.ajax({
                                                                method:'post',
                                                                url:'{{ route('ht.Overview.searchAct',['organization'=>$organization]) }}',
                                                                dataType:'json',
                                                                data:{
                                                                    '_token':'{{csrf_token()}}',
                                                                    'id':id
                                                                },
                                                                success:function(response){
                                                                    //以下為編輯頁面

                                                                    var selOpts = "<option value='分鐘前'>分鐘前</option><option value='小時前'>小時前</option><option value='天前'>天前</option><option value='週前'>週前</option>";

                                                                    $("select[name='noticeTime2']").empty();
                                                                    $("select[name='noticeTime2']").append(selOpts);

                                                                    $("div[class='memberwrap']").html("");

                                                                    $("input[name='id2']").val(response.id);
                                                                    $("input[name='title2']").val(response.title);
                                                                    $("input[name='position2']").val(response.position);
                                                                    $("input[name='notice2']").val(response.notice);
                                                                    var numbers = $("select[name='noticeTime2']").find("option");

                                                                    for (var j = 0; j < numbers.length; j++) {
                                                                        if ($(numbers[j]).val() == response.noticeTime) {
                                                                            $(numbers[j]).attr("selected", "selected");
                                                                        }
                                                                    }

                                                                    for (var i = 0; i < response.meeting.split(",").length; i++) {
                                                                        $("div[class='memberwrap']").append("<span class='tag'><div><small>"+response.meeting.split(",")[i]+"</small></div><button class='close' type='button'>×</button><input type='hidden' name='meeting2[]' value="+response.meeting.split(",")[i]+"></span>")
                                                                    }
                                                                    $("input[name='meetingToken']").val(response.meetingToken);
                                                                    $("input[name='description2']").val(response.description);
                                                                    $("input[name='owner']").val(response.user_id);

                                                                    //以下為時間判斷
                                                                    if(response.start.split(" ")[1] == '00:00:00' && response.start == response.end){

                                                                        $('.addcalendar .time-select').addClass('hide');
                                                                        $('.addcalendar .day-select').css('width', '100%');
                                                                        $('.addcalendar .day-select').css('display', 'inline-block');
                                                                        $('.addcalendar .time-select').css('display', 'inline-block');

                                                                        $("input[name='startTime2']").val("")
                                                                        $("input[name='endTime2']").val("")

                                                                        $("div[class='allday']").html("<span>全天</span><label class='switch'><input type='checkbox' name='check' checked><span class='slider round'></span></label>");
                                                                        $("input[name='start2']").val(response.start.split(" ")[0]);
                                                                        $("input[name='end2']").val(response.start.split(" ")[0]);
                                                                    }
                                                                    else if(response.start.split(" ")[1] == '00:00:00' && response.end.split(" ")[1] == '00:00:00'){

                                                                        $('.addcalendar .time-select').addClass('hide');
                                                                        $('.addcalendar .day-select').css('width', '100%');
                                                                        $('.addcalendar .day-select').css('display', 'inline-block');
                                                                        $('.addcalendar .time-select').css('display', 'inline-block');

                                                                        $("input[name='startTime2']").val("")
                                                                        $("input[name='endTime2']").val("")

                                                                        $("div[class='allday']").html("<span>全天</span><label class='switch'><input type='checkbox' name='check' checked><span class='slider round'></span></label>");
                                                                        $("input[name='start2']").val(response.start.split(" ")[0]);
                                                                        $("input[name='end2']").val(response.end.split(" ")[0]);
                                                                    }
                                                                    else{

                                                                        $('.addcalendar .time-select').removeClass('hide');
                                                                        $('.addcalendar .day-select').css('width', '50%');
                                                                        $('.addcalendar .day-select').css('display', 'inline-block');
                                                                        $('.addcalendar .time-select').css('display', 'inline-block');

                                                                        $("div[class='allday']").html("<span>全天</span><label class='switch'><input type='checkbox' name='check'><span class='slider round'></span></label>")
                                                                        $("input[name='start2']").val(response.start.split(" ")[0])
                                                                        $("input[name='end2']").val(response.end.split(" ")[0])

                                                                        $("input[name='startTime2']").attr("style","display: inline-block");
                                                                        $("input[name='startTime2']").attr("class","text-right time-select form-control");
                                                                        $("input[name='endTime2']").attr("style","display: inline-block");
                                                                        $("input[name='endTime2']").attr("class","text-right time-select form-control");

                                                                        $("input[name='startTime2']").val(response.start.split(" ")[1])
                                                                        $("input[name='endTime2']").val(response.end.split(" ")[1])
                                                                    }
                                                                }
                                                            })

                                                            $('.editmode').css('display', 'block');

                                                        });

                                                    }
                                                    else if(item[i].start.split(" ")[1] == '00:00:00' && item[i].end.split(" ")[1] == '00:00:00'){

                                                        var selOpts = "<ul class='mb-s readmode'><ul class='add-ul' id='meetInfo'><li class='mb-s' hidden id='id'><i class='fas fa-clock fa-fw'></i><span>"+item[i].id+"</span></li><li class='mb-s' id='title'><span class='title-deco active'>"+item[i].title+"</span></li><li class='mb-s' id='allday'><i class='fas fa-clock fa-fw'></i><span>全天</span></li><li class='mb-s' id='pos'><i class='fas fa-map-marker-alt fa-fw'></i><span><a href='https://www.google.com.tw/maps/place/"+item[i].position+"' target='_blank'>"+item[i].position+"</a></span></li>"

                                                        for (var j = 0; j < item[i].meeting.split(",").length; j++) {
                                                            if(j == 0){
                                                                var selOpts2 = "<i class='fas fa-users fa-fw'></i><span>"+item[i].meeting.split(",")[j]+"</span>";
                                                            }
                                                            else{
                                                                selOpts2 +=  "<li><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+item[i].meeting.split(",")[j]+"</span></li>";
                                                            }
                                                        }

                                                        var selOpts4 = "<li class='mb-s' id='descri'><i class='fas fa-align-left fa-fw'></i><span>"+item[i].description+"</span></li><li class='mb-s mt-m text-center'><div class='coupon'><button type='button' class='btn edit-preview-meeting'>編輯</button><button type='button' class='btn' data-dismiss='modal'>關閉</button></div></li></ul></ul>"

                                                        var res = (selOpts+selOpts2+selOpts4)

                                                        $("ul[id='foreachMeet']").append(res);

                                                        //button
                                                        $('.edit-preview-meeting').on('click', function(event) {

                                                            $('.readmode').css('display', 'none');

                                                            var id = $(this).closest("ul").children("li:eq(0)").text()

                                                             $.ajax({
                                                                method:'post',
                                                                url:'{{ route('ht.Overview.searchAct',['organization'=>$organization]) }}',
                                                                dataType:'json',
                                                                data:{
                                                                    '_token':'{{csrf_token()}}',
                                                                    'id':id
                                                                },
                                                                success:function(response){

                                                                    var selOpts = "<option value='分鐘前'>分鐘前</option><option value='小時前'>小時前</option><option value='天前'>天前</option><option value='週前'>週前</option>";

                                                                    $("select[name='noticeTime2']").empty();
                                                                    $("select[name='noticeTime2']").append(selOpts);

                                                                    $("div[class='memberwrap']").html("");

                                                                    //以下為編輯頁面
                                                                    $("input[name='id2']").val(response.id);
                                                                    $("input[name='title2']").val(response.title);
                                                                    $("input[name='position2']").val(response.position);
                                                                    $("input[name='notice2']").val(response.notice);
                                                                    var numbers = $("select[name='noticeTime2']").find("option");

                                                                    for (var j = 0; j < numbers.length; j++) {
                                                                        if ($(numbers[j]).val() == response.noticeTime) {
                                                                            $(numbers[j]).attr("selected", "selected");
                                                                        }
                                                                    }

                                                                    for (var i = 0; i < response.meeting.split(",").length; i++) {
                                                                        $("div[class='memberwrap']").append("<span class='tag'><div><small>"+response.meeting.split(",")[i]+"</small></div><button class='close' type='button'>×</button><input type='hidden' name='meeting2[]' value="+response.meeting.split(",")[i]+"></span>")
                                                                    }
                                                                    $("input[name='meetingToken']").val(response.meetingToken);
                                                                    $("input[name='description2']").val(response.description);
                                                                    $("input[name='owner']").val(response.user_id);

                                                                    //以下為時間判斷
                                                                    if(response.start.split(" ")[1] == '00:00:00' && response.start == response.end){

                                                                        $('.addcalendar .time-select').addClass('hide');
                                                                        $('.addcalendar .day-select').css('width', '100%');
                                                                        $('.addcalendar .day-select').css('display', 'inline-block');
                                                                        $('.addcalendar .time-select').css('display', 'inline-block');

                                                                        $("input[name='startTime2']").val("")
                                                                        $("input[name='endTime2']").val("")

                                                                        $("div[class='allday']").html("<span>全天</span><label class='switch'><input type='checkbox' name='check' checked><span class='slider round'></span></label>");
                                                                        $("input[name='start2']").val(response.start.split(" ")[0]);
                                                                        $("input[name='end2']").val(response.start.split(" ")[0]);
                                                                    }
                                                                    else if(response.start.split(" ")[1] == '00:00:00' && response.end.split(" ")[1] == '00:00:00'){

                                                                        $('.addcalendar .time-select').addClass('hide');
                                                                        $('.addcalendar .day-select').css('width', '100%');
                                                                        $('.addcalendar .day-select').css('display', 'inline-block');
                                                                        $('.addcalendar .time-select').css('display', 'inline-block');

                                                                        $("input[name='startTime2']").val("")
                                                                        $("input[name='endTime2']").val("")

                                                                        $("div[class='allday']").html("<span>全天</span><label class='switch'><input type='checkbox' name='check' checked><span class='slider round'></span></label>");
                                                                        $("input[name='start2']").val(response.start.split(" ")[0]);
                                                                        $("input[name='end2']").val(response.end.split(" ")[0]);
                                                                    }
                                                                    else{

                                                                        $('.addcalendar .time-select').removeClass('hide');
                                                                        $('.addcalendar .day-select').css('width', '50%');
                                                                        $('.addcalendar .day-select').css('display', 'inline-block');
                                                                        $('.addcalendar .time-select').css('display', 'inline-block');

                                                                        $("div[class='allday']").html("<span>全天</span><label class='switch'><input type='checkbox' name='check'><span class='slider round'></span></label>")
                                                                        $("input[name='start2']").val(response.start.split(" ")[0])
                                                                        $("input[name='end2']").val(response.end.split(" ")[0])

                                                                        $("input[name='startTime2']").attr("style","display: inline-block");
                                                                        $("input[name='startTime2']").attr("class","text-right time-select form-control");
                                                                        $("input[name='endTime2']").attr("style","display: inline-block");
                                                                        $("input[name='endTime2']").attr("class","text-right time-select form-control");

                                                                        $("input[name='startTime2']").val(response.start.split(" ")[1])
                                                                        $("input[name='endTime2']").val(response.end.split(" ")[1])
                                                                    }
                                                                }
                                                            })

                                                            $('.editmode').css('display', 'block');

                                                        });

                                                    }
                                                    else{

                                                        var selOpts = "<ul class='mb-s readmode'><ul class='add-ul' id='meetInfo'><li class='mb-s' hidden id='id'><i class='fas fa-clock fa-fw'></i><span>"+item[i].id+"</span></li><li class='mb-s' id='title'><span class='title-deco active'>"+item[i].title+"</span></li><li class='mb-s' id='allday'><i class='fas fa-clock fa-fw'></i><span>"+item[i].start.split(" ")[1]+"~"+item[i].end.split(" ")[1]+"</span></li><li class='mb-s' id='pos'><i class='fas fa-map-marker-alt fa-fw'></i><span><a href='https://www.google.com.tw/maps/place/"+item[i].position+"' target='_blank'>"+item[i].position+"</a></span></li>"

                                                        for (var j = 0; j < item[i].meeting.split(",").length; j++) {
                                                            if(j == 0){
                                                                var selOpts2 = "<i class='fas fa-users fa-fw'></i><span>"+item[i].meeting.split(",")[j]+"</span>";
                                                            }
                                                            else{
                                                                selOpts2 +=  "<li><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+item[i].meeting.split(",")[j]+"</span></li>";
                                                            }
                                                        }

                                                        var selOpts4 = "<li class='mb-s' id='descri'><i class='fas fa-align-left fa-fw'></i><span>"+item[i].description+"</span></li><li class='mb-s mt-m text-center'><div class='coupon'><button type='button' class='btn edit-preview-meeting'>編輯</button><button type='button' class='btn' data-dismiss='modal'>關閉</button></div></li></ul></ul>"

                                                            var res = (selOpts+selOpts2+selOpts4)

                                                        $("ul[id='foreachMeet']").append(res);

                                                        //button
                                                        $('.edit-preview-meeting').on('click', function(event) {

                                                            $('.readmode').css('display', 'none');

                                                            var id = $(this).closest("ul").children("li:eq(0)").text()

                                                             $.ajax({
                                                                method:'post',
                                                                url:'{{ route('ht.Overview.searchAct',['organization'=>$organization]) }}',
                                                                dataType:'json',
                                                                data:{
                                                                    '_token':'{{csrf_token()}}',
                                                                    'id':id
                                                                },
                                                                success:function(response){

                                                                    var selOpts = "<option value='分鐘前'>分鐘前</option><option value='小時前'>小時前</option><option value='天前'>天前</option><option value='週前'>週前</option>";

                                                                    $("select[name='noticeTime2']").empty();
                                                                    $("select[name='noticeTime2']").append(selOpts);

                                                                    $("div[class='memberwrap']").html("");

                                                                    //以下為編輯頁面
                                                                    $("input[name='id2']").val(response.id);
                                                                    $("input[name='title2']").val(response.title);
                                                                    $("input[name='position2']").val(response.position);
                                                                    $("input[name='notice2']").val(response.notice);
                                                                    var numbers = $("select[name='noticeTime2']").find("option");

                                                                    for (var j = 0; j < numbers.length; j++) {
                                                                        if ($(numbers[j]).val() == response.noticeTime) {
                                                                            $(numbers[j]).attr("selected", "selected");
                                                                        }
                                                                    }

                                                                    for (var i = 0; i < response.meeting.split(",").length; i++) {
                                                                        $("div[class='memberwrap']").append("<span class='tag'><div><small>"+response.meeting.split(",")[i]+"</small></div><button class='close' type='button'>×</button><input type='hidden' name='meeting2[]' value="+response.meeting.split(",")[i]+"></span>")
                                                                    }
                                                                    $("input[name='meetingToken']").val(response.meetingToken);
                                                                    $("input[name='description2']").val(response.description);
                                                                    $("input[name='owner']").val(response.user_id);

                                                                    //以下為時間判斷
                                                                    if(response.start.split(" ")[1] == '00:00:00' && response.start == response.end){

                                                                        $('.addcalendar .time-select').addClass('hide');
                                                                        $('.addcalendar .day-select').css('width', '100%');
                                                                        $('.addcalendar .day-select').css('display', 'inline-block');
                                                                        $('.addcalendar .time-select').css('display', 'inline-block');

                                                                        $("input[name='startTime2']").val("")
                                                                        $("input[name='endTime2']").val("")

                                                                        $("div[class='allday']").html("<span>全天</span><label class='switch'><input type='checkbox' name='check' checked><span class='slider round'></span></label>");
                                                                        $("input[name='start2']").val(response.start.split(" ")[0]);
                                                                        $("input[name='end2']").val(response.start.split(" ")[0]);
                                                                    }
                                                                    else if(response.start.split(" ")[1] == '00:00:00' && response.end.split(" ")[1] == '00:00:00'){

                                                                        $('.addcalendar .time-select').addClass('hide');
                                                                        $('.addcalendar .day-select').css('width', '100%');
                                                                        $('.addcalendar .day-select').css('display', 'inline-block');
                                                                        $('.addcalendar .time-select').css('display', 'inline-block');

                                                                        $("input[name='startTime2']").val("")
                                                                        $("input[name='endTime2']").val("")

                                                                        $("div[class='allday']").html("<span>全天</span><label class='switch'><input type='checkbox' name='check' checked><span class='slider round'></span></label>");
                                                                        $("input[name='start2']").val(response.start.split(" ")[0]);
                                                                        $("input[name='end2']").val(response.end.split(" ")[0]);
                                                                    }
                                                                    else{

                                                                        $('.addcalendar .time-select').removeClass('hide');
                                                                        $('.addcalendar .day-select').css('width', '50%');
                                                                        $('.addcalendar .day-select').css('display', 'inline-block');
                                                                        $('.addcalendar .time-select').css('display', 'inline-block');

                                                                        $("div[class='allday']").html("<span>全天</span><label class='switch'><input type='checkbox' name='check'><span class='slider round'></span></label>")
                                                                        $("input[name='start2']").val(response.start.split(" ")[0])
                                                                        $("input[name='end2']").val(response.end.split(" ")[0])

                                                                        $("input[name='startTime2']").attr("style","display: inline-block");
                                                                        $("input[name='startTime2']").attr("class","text-right time-select form-control");
                                                                        $("input[name='endTime2']").attr("style","display: inline-block");
                                                                        $("input[name='endTime2']").attr("class","text-right time-select form-control");

                                                                        $("input[name='startTime2']").val(response.start.split(" ")[1])
                                                                        $("input[name='endTime2']").val(response.end.split(" ")[1])
                                                                    }
                                                                }
                                                            })

                                                            $('.editmode').css('display', 'block');

                                                        });
                                                    }
                                                }
                                            })
                                        }
                                    })
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
                        if(array.indexOf(item.token) == -1){
                            selOpts += "<option value='"+item.token+"'>"+item.name+"</option>";
                        }
                        else{
                            selOpts += "<option hidden value='"+item.token+"'>"+item.name+"</option>";
                        }
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

                    var aaa = $('input[name="meetingToken"]').val()
                    var bbb = aaa.split(',')
                    

                    if(res == ""){
                        var selOpts = "<option selected disabled hidden>員工名稱</option><option disabled>沒有人員</option>";
                    }
                    else{
                       var selOpts = "<option selected disabled hidden>員工名稱</option>";
                    }
                    
                    $.each(res, function (i, item) {

                        if(bbb.indexOf(item.token) == -1){
                            selOpts += "<option value='"+item.token+"'>"+item.name+"</option>";
                        }
                        else{
                            selOpts += "<option hidden value='"+item.token+"'>"+item.name+"</option>";
                        }
                    })

                    $("select[name='name2']").empty();
                    $("select[name='name2']").append(selOpts);
                }
            })
        });
    });
    </script>
    <script type="text/javascript">
        $(function() {
            $('#SD1').datetimepicker({
                minDate: new Date(),
                format: 'YYYY-MM-DD',
                ignoreReadonly: true,
                allowInputToggle: true,
                locale: 'ZH-TW',
                useCurrent: false,
                ignoreReadonly: true,
            });
        });


        $(function() {
            $('#ED1').datetimepicker({
                minDate: new Date(),
                format: 'YYYY-MM-DD',
                ignoreReadonly: true,
                allowInputToggle: true,
                locale: 'ZH-TW',
                useCurrent: false,
                ignoreReadonly: true,
            });
        });
        $("#SD1").on("dp.change", function (e) {
            $('#ED1').data("DateTimePicker").minDate(e.date);
        });
        $("#ED1").on("dp.change", function (e) {
            $('#SD1').data("DateTimePicker").maxDate(e.date);
        });

        $("#start2").on("dp.change", function (e) {
            $('#end2').data("DateTimePicker").minDate(e.date);
        });
        $("#end2").on("dp.change", function (e) {
            $('#start2').data("DateTimePicker").maxDate(e.date);
        });
    </script>
    <script type="text/javascript">
        $('#job1').on('hidden.bs.modal', function () {
            $("div[class='memberwrap']").html("");
            $("ul[id='jobInfo']").attr("style","display:none");
            $("ul[id='meetInfo']").attr("style","display:none");
            $("li[id='foreachJob']").html("");
            $("ul[id='foreachMeet']").html("");
            $("div[id='foreachMeetInfo']").html("");
            $('.readmode').css('display', 'block');
            $('.editmode').css('display', 'none');
            $("div[class='memberwrap']").html("");
        })
        $('#meet').on('hidden.bs.modal', function () {
            $("div[class='memberwrap']").html("");
            $("ul[id='jobInfo']").attr("style","display:none");
            $("ul[id='meetInfo']").attr("style","display:none");
            $("li[id='foreachJob']").html("");
            $("ul[id='foreachMeet']").html("");
            $("div[id='foreachMeetInfo']").html("");
            $('.readmode').css('display', 'block');
            $('.editmode').css('display', 'none');
            $("div[class='memberwrap']").html("");
        })
    </script>
    <script type="text/javascript">
        $('.opmodal').on('click', function(){
            window.scrollTo(0, 0);
        });

        $("#meeting,#notice").focus(function(){
            document.activeElement.blur();
        })
    </script>
    <script type="text/javascript">
        $('#addName').on('click',function(){
            var val  = $("select[name='name']").val();
            var numbers = $("select[name='name']").find("option");
            for (var j = 0; j < numbers.length; j++) {
                if ($(numbers[j]).val() == val) {
                    $(numbers[j]).attr("hidden", "hidden");
                }
            }
        })
    </script>
@endsection