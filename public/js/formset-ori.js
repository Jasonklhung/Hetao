/*-----------------------------------/
  表單模板
/*----------------------------------*/

//刪除
$('body').on('click', '.fa-trash-alt', function() {
    $(this).closest('.pd-l').remove();
});

//標題
$('.toolbar').on('click', '.t01', function() {
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="tp-title pd-l"><button class="close" type="button"><i class="far fa-trash-alt"></i></button><input class="form-control" type="text" placeholder="填寫標題"></div>');
});
//文章
$('.toolbar').on('click', '.t02', function() {
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="form-group mgy-sm pd-l"><button class="close" type="button"><i class="far fa-trash-alt"></i></button><input type="text" class="form-control" placeholder="輸入文字"></div>');
});
//分隔線
$('.toolbar').on('click', '.t03', function() {
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l"><hr><button class="close" type="button"><i class="far fa-trash-alt"></i></button></div>');
});
//單選
var radio = 0
$('.toolbar').on('click', '.t04', function() {
    radio++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" placeholder="未命名的問題"></p><div class="select-con"><div class="mb-s"><button class="close" type="button">&times;</button><div class="out mr-s"></div><input type="text" placeholder="填寫選項文字"><select class="form-control"><option class="thxpage">感謝頁</option></select></div></div><a href="javascript:void(0)" class="select-fun"><div class="out mr-s"></div>新增選項</a><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label><input class="followw" id="follow1'+radio+'" type="checkbox"><label class="followanswer" for="follow1'+radio+'">依答案至相關頁面</label></div></div>');
    option()
});

/*單選新增選項*/
$('body').on('click', '.select-fun', function() {
    $(this).parents('.item').children('.select-con').append('<div class="mb-s"> <button class="close" type ="button">&times;</button> <div class="out mr-s"> </div><input type="text" placeholder="填寫選項文字"><select class="form-control"><option class="thxpage">感謝頁</option></select> </div>');
});

/*單選選項刪除*/
$('body').on('click', '.select-con .close', function() {
    $(this).parent().remove();
});

//多選
var multi = 0
$('.toolbar').on('click', '.t05', function() {
    multi++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" placeholder="未命名的問題"></p><div class="multi-con"><div class="mb-s"><button class="close" type="button">&times;</button><div class="shape mr-s"></div><input type="text" placeholder="選項文字"><select class="form-control"><option class="thxpage">感謝頁</option></select></div></div><a href="javascript:void(0)" class="multi-fun"><div class="shape mr-s"></div>新增選項</a><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label><input class="followw" id="follow2'+multi+'" type="checkbox"><label class="followanswer" for="follow2'+multi+'">依答案至相關頁面</label></div></div>');
});
/*多選新增選項*/
$('body').on('click', '.multi-fun', function() {
    $(this).parents('.item').children('.multi-con').append('<div class="mb-s"> <button class="close" type ="button">&times;</button> <div class="shape mr-s"> </div><input type="text" placeholder="填寫選項文字"><select class="form-control"><option class="thxpage">感謝頁</option></select>  </div>');
});

/*多選選項刪除*/
$('body').on('click', '.multi-con .close', function() {
    $(this).parent().remove();
});

//下拉
var sele = 0
$('.toolbar').on('click', '.t06', function() {
    sele++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" placeholder="未命名的問題"></p><ol class="drop-con"><li class="mb-s"><button class="close" type="button">&times;</button><input type="text" placeholder="選項文字"><select class="form-control"><option class="thxpage">感謝頁</option></select></li><li class="mb-s drop-fun-dot"><a href="javascript:void(0)" class="drop-fun">新增選項</a></li></ol><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label><input class="followw" id="follow3'+sele+'" type="checkbox"><label class="followanswer" for="follow3'+sele+'">依答案至相關頁面</label></div></div>');
});

/*下拉新增選項*/
$('body').on('click', '.drop-fun', function() {
    $(this).parents('.drop-con').children('.drop-fun-dot').before('<li class="mb-s"><button class="close" type="button">&times;</button><input type="text" placeholder="選項文字"><select class="form-control"><option class="thxpage">感謝頁</option></select> </li>');
});

/*下拉選項刪除*/
$('body').on('click', '.drop-con li .close', function() {
    $(this).parent().remove();
});

//簡答
$('.toolbar').on('click', '.t07', function() {
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" placeholder="未命名的問題"></p><input class="lock" type="text" value="簡答文字" disabled><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label></div></div>');
});
//段落
$('.toolbar').on('click', '.t08', function() {
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" placeholder="未命名的問題"></p><input class="lock" type="text" value="詳答文字" disabled><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label></div></div>');
});
//日期
$('.toolbar').on('click', '.t09', function() {
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" placeholder="未命名的問題"></p><input class="lock datime" type="text" value="年/月/日" disabled><span class="glyphicon glyphicon-calendar date-icon" aria-hidden="true"></span><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label></div></div>');
});
//時間
$('.toolbar').on('click', '.t10', function() {
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" placeholder="未命名的問題"></p><input class="lock datime" type="text" value="時：分" disabled><span class="glyphicon glyphicon-time time-icon" aria-hidden="true"></span><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label></div></div>');
});


//頁面切換tab效果
$('body').on('click', '.design-form .tab-pane .nav-tabs .section a', function(){
	$('.design-form .tab-pane .nav-tabs .section').removeClass('active');
	$(this).closest('.section').addClass('active');
});

//新增頁面
var i = 1
$('body').on('click', '.add-section', function(){
	i++
	$(this).parent().children('.sec01').before('<div class="sec-1-'+ i +' section mr-s"><label for="sec-1-'+ i +'"><i class="fas fa-check-circle fa-fw"></i><a data-toggle="tab" href="#p-1-'+ i +'"><input class="form-control" type="text" placeholder="未命名"></a><input type="checkbox" id="sec-1-'+ i +'" class="form-sec-btn"></label><button class="close"type="button">&times;</button></div>');
	$(this).parent().parent().append('<div class="tab-pane fade" id="p-1-'+ i +'"><div class="panel panel-default panel-type page"><div class="panel-heading text-center font-l font-r">線上預約表單</div><div class="panel-body font-sm pdx-0"><div class="last-page tab-content"><form class="form-content-0" action=""></form></div></div></div></div>');
	$(".add-section").parent().find('.thx').siblings(".section:last").click();
});
var j = 1
$('body').on('click', '.add-section2', function(){
    j++
    $(this).parent().children('.sec02').before('<div class="sec-2-'+ j +' section mr-s"><label for="sec-2-'+ j +'"><i class="fas fa-check-circle fa-fw"></i><a data-toggle="tab" href="#p-2-'+ j +'"><input class="form-control" type="text" placeholder="未命名"></a><input type="checkbox" id="sec-2-'+ j +'" class="form-sec-btn"></label><button class="close"type="button">&times;</button></div>');
    $(this).parent().parent().append('<div class="tab-pane fade" id="p-2-'+ j +'"><div class="panel panel-default panel-type page"><div class="panel-heading text-center font-l font-r">線上預約表單</div><div class="panel-body font-sm pdx-0"><div class="last-page tab-content"><form class="form-content-0" action=""></form></div></div></div></div>');
    $(".add-section").parent().find('.thx').siblings(".section:last").click();
});
var k = 1
$('body').on('click', '.add-section3', function(){
    k++
    $(this).parent().children('.sec03').before('<div class="sec-3-'+ k +' section mr-s"><label for="sec-3-'+ k +'"><i class="fas fa-check-circle fa-fw"></i><a data-toggle="tab" href="#p-3-'+ k +'"><input class="form-control" type="text" placeholder="未命名"></a><input type="checkbox" id="sec-3-'+ k +'" class="form-sec-btn"></label><button class="close"type="button">&times;</button></div>');
    $(this).parent().parent().append('<div class="tab-pane fade" id="p-3-'+ k +'"><div class="panel panel-default panel-type page"><div class="panel-heading text-center font-l font-r">線上預約表單</div><div class="panel-body font-sm pdx-0"><div class="last-page tab-content"><form class="form-content-0" action=""></form></div></div></div></div>');
    $(".add-section").parent().find('.thx').siblings(".section:last").click();
});

//刪除頁面
$('body').on('click', '.design-form .tab-content .nav-tabs .section .close', function(){
    var id = $(this).siblings('label').children('a').attr('href');
    $(this).closest('.section').remove();
    $(id).remove();
    $(this).parents().find('.section:last').click();

});

//rwd工具列顯示
$('.toolbar .rwdmenu').click(function(){
    if ($(window).width() <= 1020) {
        $(this).siblings('li').toggle();
    }
})
$(window).resize(function(){
    if ($(window).width() > 1020) {
        $('.toolbar .rwdmenu').siblings('li').css('display', ' inline-block');
    }
});


//控制"依答案至相關頁面"
$('body').on('change', '.followw', function() {
    if ($(this).prop("checked")==true) {
        $(this).closest('.item').addClass('link');
    } else {
        $(this).closest('.item').removeClass('link');
    }
});

//將tab名稱帶入相關頁面option
var arr=[]
$('body').on('click','.add-section', function(){
    option()
});
$('body').on('click','.add-section2', function(){
    option()
});
$('body').on('click','.add-section3', function(){
    option()
});
$('body').on('click','.select-fun', function(){
    option()
});
$('body').on('click','.drop-fun-dot', function(){
    option()
});
$('body').on('click','.multi-fun', function(){
    option()
});
$('body').on('change','.section input', function(){
    option()
});
$('body').on('change','.followw', function(){
    option()
});

function option(){
    var inputs = $(".nav-tabs input[type='text']")
    arr=[]
    $('.item.link .form-control option:not(.thxpage)').remove();
    inputs.each(
        function(){
            var input =$(this);
            arr.push(input.val())
  
        }
        )
    for(var i=0;i<arr.length;i++){
                $('.item.link .form-control').append('<option>'+ arr[i] +'</option>');
            }
}
