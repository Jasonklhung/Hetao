/*-----------------------------------/
  表單模板
/*----------------------------------*/

//刪除
$('body').on('click', '.fa-trash-alt', function() {
    $(this).closest('.pd-l').remove();
});

//標題
$('.toolbar').on('click', '.t01', function() {
    $(this).parents().find('.tab-pane.active.in .form-content-0').append('<div class="tp-title pd-l"><button class="close" type="button"><i class="far fa-trash-alt"></i></button><input class="form-control" type="text" placeholder="填寫標題"></div>');
});
//文章
$('.toolbar').on('click', '.t02', function() {
    $(this).parents().find('.tab-pane.active.in .form-content-0').append('<div class="form-group mgy-sm pd-l"><button class="close" type="button"><i class="far fa-trash-alt"></i></button><input type="text" class="form-control" placeholder="輸入文字"></div>');
});
//分隔線
$('.toolbar').on('click', '.t03', function() {
    $(this).parents().find('.tab-pane.active.in .form-content-0').append('<div class="pd-l"><hr><button class="close" type="button"><i class="far fa-trash-alt"></i></button></div>');
});
//單選
$('.toolbar').on('click', '.t04', function() {
    $(this).parents().find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" placeholder="未命名的問題"></p><div class="select-con"><div class="mb-s"><button class="close" type="button">&times;</button><div class="out mr-s"></div><input type="text" placeholder="填寫選項文字"></div></div><a href="javascript:void(0)" class="select-fun"><div class="out mr-s"></div>新增選項</a><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label></div></div>');
});

/*單選新增選項*/
$('body').on('click', '.select-fun', function() {
    $(this).parents('.item').children('.select-con').append('<div class="mb-s"> <button class="close" type ="button">&times;</button> <div class="out mr-s"> </div><input type="text" placeholder="填寫選項文字"> </div>');
});

/*單選選項刪除*/
$('body').on('click', '.select-con .close', function() {
    $(this).parent().remove();
});

//多選
$('.toolbar').on('click', '.t05', function() {
    $(this).parents().find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" placeholder="未命名的問題"></p><div class="multi-con"><div class="mb-s"><button class="close" type="button">&times;</button><div class="shape mr-s"></div><input type="text" placeholder="選項文字"></div></div><a href="javascript:void(0)" class="multi-fun"><div class="shape mr-s"></div>新增選項</a><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label></div></div>');
});
/*多選新增選項*/
$('body').on('click', '.multi-fun', function() {
    $(this).parents('.item').children('.multi-con').append('<div class="mb-s"> <button class="close" type ="button">&times;</button> <div class="shape mr-s"> </div><input type="text" placeholder="填寫選項文字"> </div>');
});

/*多選選項刪除*/
$('body').on('click', '.multi-con .close', function() {
    $(this).parent().remove();
});

//下拉
$('.toolbar').on('click', '.t06', function() {
    $(this).parents().find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" placeholder="未命名的問題"></p><ol class="drop-con"><li class="mb-s"><button class="close" type="button">&times;</button><input type="text" placeholder="選項文字"></li><li class="mb-s drop-fun-dot"><a href="javascript:void(0)" class="drop-fun">新增選項</a></li></ol><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label></div></div>');
});

/*下拉新增選項*/
$('body').on('click', '.drop-fun', function() {
    $(this).parents('.drop-con').children('.drop-fun-dot').before('<li class="mb-s"><button class="close" type="button">&times;</button><input type="text" placeholder="選項文字"></li>');
});

/*下拉選項刪除*/
$('body').on('click', '.drop-con li .close', function() {
    $(this).parent().remove();
});

//簡答
$('.toolbar').on('click', '.t07', function() {
    $(this).parents().find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" placeholder="未命名的問題"></p><input class="lock" type="text" value="簡答文字" disabled><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label></div></div>');
});
//段落
$('.toolbar').on('click', '.t08', function() {
    $(this).parents().find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" placeholder="未命名的問題"></p><input class="lock" type="text" value="詳答文字" disabled><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label></div></div>');
});
//日期
$('.toolbar').on('click', '.t09', function() {
    $(this).parents().find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" placeholder="未命名的問題"></p><input class="lock datime" type="text" value="年/月/日" disabled><span class="glyphicon glyphicon-calendar date-icon" aria-hidden="true"></span><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label></div></div>');
});
//時間
$('.toolbar').on('click', '.t10', function() {
    $(this).parents().find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" placeholder="未命名的問題"></p><input class="lock datime" type="text" value="時：分" disabled><span class="glyphicon glyphicon-time time-icon" aria-hidden="true"></span><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label></div></div>');
});


//頁面切換tab效果
$('body').on('click', '.design-form .tab-pane .nav-tabs a', function(){
	$('.design-form .tab-pane .nav-tabs .section').removeClass('active');
	$(this).children(".section").addClass('active');
});

//新增頁面
var i = 1
$('body').on('click', '.add-section', function(){
	i++
	$(this).parent().children('.thx').before('<a data-toggle="tab" href="#p'+ i +'"><div class="sec'+ i +' section mr-s"><label for="sec'+ i +'"><i class="fas fa-check-circle fa-fw"></i><input class="form-control" type="text" placeholder="未命名"><input type="checkbox" id="sec'+ i +'" class="form-sec-btn"></label><button class="close"type="button">&times;</button></div></a>');
	$(this).parent().parent().append('<div class="tab-pane fade" id="p'+ i +'"><div class="panel panel-default panel-type page"><div class="panel-heading text-center font-l font-r">線上預約表單</div><div class="panel-body font-sm pdx-0"><div class="last-page tab-content"><form class="form-content-0" action=""></form></div></div></div></div>');
	$(".add-section").parent().find('.thx').siblings("a:last").click();
});

$('body').on('click', '.design-form .tab-content .nav-tabs a .close', function(){
	var id = $(this).closest('a').attr('href');
	$(this).closest('a').remove();
	$(id).remove();
	$(this).parents().find('a:last').click();

});


// var pagetab = '<a data-toggle="tab" href="#p{{num}}"><div class="sec{{num1}} section mr-s"><label for="sec{{num2}}"><i class="fas fa-check-circle fa-fw"></i><input class="form-control" type="text" placeholder="未命名" id="input{{num3}}" value="{{inputval}}"><input type="checkbox" id="sec{{num4}}" class="form-sec-btn"></label><button delid="{{delid}}" class="close" type="button" id="delbtn_{{num5}}">&times;</button></div></a>'
// var pagecontent = '<div class="tab-pane fade" id="p{{sort}}"><div class="panel panel-default panel-type page"><div class="panel-heading text-center font-l font-r">線上預約表單</div><div class="panel-body font-sm pdx-0"><div class="last-page tab-content"><form class="form-content-0" action=""></form></div></div></div></div>'
// var formfiled = []


// $('body').on('click', '.add-section', function(){
// 	formfiled.push({form: []});
// 	tabval();
// 	showlist();

// });

// function showlist() {
// 	$(".add-section").parent().children('.thx').siblings("a").remove()
// 	$("#thankyou").siblings(".tab-pane").remove()
// 	console.log("安安")
// 	$(".add-section").parent().children('.thx').before('');
// 	$(".add-section").parent().parent().append('');
// 	for(var i=0; i<formfiled.length;i++) {
// 		var ptab = pagetab.replace("{{num}}", i)
// 						  .replace("{{num1}}", i)
// 						  .replace("{{num2}}", i)
// 						  .replace("{{num3}}", i)
// 						  .replace("{{num4}}", i)
// 						  .replace("{{num5}}", i)
// 						  .replace("{{active}}",formfiled[i].active)
// 						  .replace("{{inputval}}", formfiled[i].value)
// 						  .replace("{{delid}}", i);
// 		var pcon = pagecontent.replace("{{sort}}", i);
// 		$(".add-section").parent().children('.thx').before(ptab)
// 		$(".add-section").parent().parent().append(pcon);
// 		 $("#delbtn_"+i).click(
// 	      function(){
// 	        remove_item($(this).attr("delid"));

// 	      }
// 	    ); 
// 	}
// 	$(".add-section").parent().find('.thx').siblings("a:last").click();
// }
// function tabval(){
// 	for(var i=0;i<formfiled.length;i++){
// 	    if($("#input"+i).val()){
// 	      formfiled[i].value=$("#input"+i).val()
// 	    }else{
// 	      formfiled[i].value=" "
// 	    }
// 	}	
// }

// function remove_item(delid){
//   tabval()
//   formfiled.splice(delid,1);
//   showlist();
// }




// $(".add-section").parent().children('.thx').siblings("a").children(".section").removeClass("active")
// 		$(".add-section").parent().children('.thx').siblings("a").children(".section:last").addClass("active")