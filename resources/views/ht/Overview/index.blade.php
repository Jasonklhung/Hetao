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
                                                                <input class='day-select form-control' name="start" placeholder='開始時間' type='text' required=""><input class='hide text-right time-select form-control' name="startTime" placeholder='14:00' type='text' readonly="true"><input class='day-select form-control' name="end" placeholder='結束時間' type='text' required=""><input class='hide text-right time-select form-control' name="endTime" placeholder='15:00' type='text' readonly="true">
                                                            </li>
                                                            <li class="mb-s"><i class="fas fa-map-marker-alt"></i><input class="form-control location" type="text" name="position" placeholder="新增位置"></li>
                                                            <li class="mb-s"><i class="fas fa-bell"></i><div class="opmodal o1" data-toggle="modal" data-target="#newalert"><input type="text" name="notice" value="新增通知"></div></li>
                                                            <li class="mb-s"><i class="fas fa-users"></i><div class="opmodal o2" data-toggle="modal" data-target="#person"><input type="text" name="meeting" value="會議對象"></div></li>
                                                            <li class="mb-s"><i class="fas fa-align-left"></i><input class="form-control ps" type="text" name="description" placeholder="新增說明"></li>
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
<!-- Modal 新增通知 -->
<div id="newalert" class="modal fade" role="dialog">
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
<div id="person" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-sm">
            <div class="modal-body">
                <div>
                    <select class='form-control mb-s company'>
                        <option selected disabled hidden>分公司</option>
                        <option>台北</option>
                        <option>新北</option>
                        <option>桃園</option>
                        <option>台中</option>
                        <option>台南</option>
                        <option>高雄</option>
                    </select>
                    <select class='form-control mb-s role' disabled="disabled">
                        <option selected disabled hidden>職稱</option>
                        <option value="助理">助理</option>
                        <option value="主管">主管</option>
                        <option value="員工">員工</option>
                    </select>
                    <select class='form-control mb-s staffname' disabled="disabled">
                        <option selected disabled hidden>員工名稱</option>
                        <option value="小美">小美</option>
                        <option value="小王">小王</option>
                        <option value="小名">小名</option>
                        <option value="小強">小強</option>
                        <option value="小花">小花</option>
                        <option value="小白">小白</option>
                    </select>
                    <div class="memberwrap">
                    </div>    
                </div>
                <div class="text-center"><button type="button" class="btn btn-primary add-member">新增</button><button type="button" class="btn btn-primary finish" data-dismiss="modal">完成</button></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal 會議內容-->
<div id="meet" class="modal fade" role="dialog">
  <div class="modal-dialog meeting">
    <!-- Modal content-->
    <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="modal-body">
        <ul class="add-ul">
            <li class="mb-s" id="title"><span class="title-deco active">會議</span>
            </li>
            <li class="mb-s">
                <i class="fas fa-clock fa-fw"></i><span>全天</span>
            </li>
            <li class="mb-s" id="position"><i class="fas fa-map-marker-alt fa-fw"></i><span>XXXXX會議室</span></li>
            <li class="mb-s" id="people"><i class="fas fa-users fa-fw"></i><span>Vicky, Andy, Luna</span></li>
            <li class="mb-s" id="description"><i class="fas fa-align-left fa-fw"></i><span>記得要下班</span></li>
            <li class="mb-s mt-m text-center"><div class="coupon"><button type="button" class="btn" data-dismiss="modal">關閉</button></div></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Modal 工單內容(多個)-->
<div id="job" class="modal fade" role="dialog">
  <div class="modal-dialog meeting">
    <!-- Modal content-->
    <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="modal-body">
        <ul class="add-ul">
            <li class="mb-s">
                <ul>
                    <li><span>派工類型 </span>維修</li>
                    <li><span>客戶代碼 </span>楊梅國中</li>
                    <li><span>地址 </span><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></li>
                    <li><span>電話 </span><a href="tel:5551234567">03-3322101</a></li>
                    <li><span>派工原因 </span>載清缸 宿舍1.3樓+教學1樓右邊</li>
                    <li><span>承辦人員 </span>邱小姐</li>
                    <li><span>工單編號 </span>00000000</li>
                    <li><span>工單日期 </span>2019-08-06 10:30</li>
                    <li><span>狀態 </span>執行中</li>
                </ul>
                <ul>
                    <li><span>派工類型 </span>維修</li>
                    <li><span>客戶代碼 </span>楊梅國中</li>
                    <li><span>地址 </span><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></li>
                    <li><span>電話 </span><a href="tel:5551234567">03-3322101</a></li>
                    <li><span>派工原因 </span>載清缸 宿舍1.3樓+教學1樓右邊</li>
                    <li><span>承辦人員 </span>邱小姐</li>
                    <li><span>工單編號 </span>00000000</li>
                    <li><span>工單日期 </span>2019-08-06 10:30</li>
                    <li><span>狀態 </span>執行中</li>
                </ul>
            </li>
            <li class="mb-s mt-m text-center"><div class="coupon"><button type="button" class="btn" data-dismiss="modal">關閉</button></div></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Modal 工單內容(單個)-->
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
                    <li id="address"><span>地址 </span><a href="https://www.google.com.tw/maps/place/桃園市楊梅區秀才路919號" target="_blank">楊梅區秀才路919號</a></li>
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

        var chart_json = new Array(); 

        $.ajax({
            method:'get',
            url:'{{ route('ht.Overview.getData',['organization'=>$organization]) }}',
            data:{
                "token": "Z8564d5737a4ba80b8e7921e882e506ea",
                "DEPT": "H026"
            },
            dataType:'json',
            success:function(data){
                $.each(data['data'], function (i, item) {

                    chart_json.push({'title':"工單:"+item.id+" "+item.owner+"",'start':item.time,'url':'#job1','className':'fc-event-success','allDay':true,'id':item.id,'owner':item.owner,'type':item.work_type,'time':item.time});
                });

                $.ajax({
                    method:'get',
                    url:'{{ route('ht.Overview.show',['organization'=>$organization]) }}',
                    dataType:'json',
                    success:function(response){
                        $.each(response, function (i, item) {

                           if(item.start.split(" ")[1] == '00:00:00'){

                                chart_json.push({'title':item.title,'start':item.start,'end':item.end,'url':'#meet','allDay':true,'position':item.position,'meeting':item.meeting,'description':item.description});
                           }
                           else{
                                chart_json.push({'title':""+item.start.split(" ")[1]+" "+item.title,'start':item.start,'end':item.end,'url':'#meet','allDay':true,'position':item.position,'meeting':item.meeting,'description':item.description});
                           }
                        });

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

                                    $("li[id='type']").html("<span>派工類型 </span>"+info.type+"");
                                    //$("li[id='custkey']").html("<span>客戶代碼 </span>"+info.custkey+"");
                                    //$("li[id='address']").html("<span>地址 </span><a href='https://www.google.com.tw/maps/place/"+info.address+"' target='_blank'>"+info.address+"</a>");
                                    //$("li[id='mobile']").html("<span>電話 </span><a href='tel:"+info.mobile+"'>"+info.mobile+"</a>");
                                    //$("li[id='reason']").html("<span>派工原因 </span>"+info.reason+"");
                                    $("li[id='owner']").html("<span>承辦人員 </span>"+info.owner+"");
                                    $("li[id='id']").html("<span>工單編號 </span>"+info.id+"");
                                    $("li[id='date']").html("<span>工單日期 </span>"+info.time+"");
                                    //$("li[id='status']").html("<span>狀態 </span>"+info.status+"");
                                }
                                else{
                                    $("li[id='title']").html("<span class='title-deco active'>"+info.title+"</span>");
                                    $("li[id='position']").html("<i class='fas fa-map-marker-alt fa-fw'></i><span>"+info.position+"</span>");
                                    $("li[id='people']").html("<i class='fas fa-users fa-fw'></i><span>"+info.meeting+"</span>");
                                    $("li[id='description']").html("<i class='fas fa-align-left fa-fw'></i><span>"+info.description+"</span>");
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
    });
    </script>
@endsection