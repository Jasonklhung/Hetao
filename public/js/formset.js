/*-----------------------------------/
  表單模板
/*----------------------------------*/

//刪除
$('body').on('click', '.fa-trash-alt', function() {
    $(this).closest('.pd-l').remove();
});

//標題
var t = 0
$('.toolbar').on('click', '.t01', function() {
    t++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="tp-title pd-l"><button class="close" type="button"><i class="far fa-trash-alt"></i></button><input class="form-control" name="title'+t+'" type="text" placeholder="填寫標題"></div>');
});
//文章
var article = 0
$('.toolbar').on('click', '.t02', function() {
    article++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="form-group mgy-sm pd-l"><button class="close" type="button"><i class="far fa-trash-alt"></i></button><input type="text" name="article'+article+'" class="form-control" placeholder="輸入文字"></div>');
});
//分隔線
var line = 0
$('.toolbar').on('click', '.t03', function() {
    line++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l"><hr><input type="hidden" name="line'+line+'"><button class="close" type="button"><i class="far fa-trash-alt"></i></button></div>');
});
//單選
var radio = 0
$('.toolbar').on('click', '.t04', function() {
    radio++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" name="radio'+radio+'" type="text" placeholder="未命名的問題"></p><div class="select-con"><div class="mb-s"><button class="close" type="button">&times;</button><div class="out mr-s"></div><input type="text" name="radioOpt1" placeholder="填寫選項文字"><select class="form-control"><option class="thxpage">感謝頁</option></select></div></div><a href="javascript:void(0)" class="select-fun"><div class="out mr-s"></div>新增選項</a><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label><input class="followw" id="follow1'+radio+'" type="checkbox"><label class="followanswer" for="follow1'+radio+'">依答案至相關頁面</label></div></div>');
    // option()
});

/*單選新增選項*/
var opt = 1;
$('body').on('click', '.select-fun', function() {
    opt++
    $(this).parents('.item').children('.select-con').append('<div class="mb-s"> <button class="close" type ="button">&times;</button> <div class="out mr-s"> </div><input type="text" name="radioOpt'+opt+'" placeholder="填寫選項文字"><select class="form-control"><option class="thxpage">感謝頁</option></select> </div>');
});

/*單選選項刪除*/
$('body').on('click', '.select-con .close', function() {
    $(this).parent().remove();
});

//多選
var multi = 0
$('.toolbar').on('click', '.t05', function() {
    multi++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" name="multi'+multi+'" placeholder="未命名的問題"></p><div class="multi-con"><div class="mb-s"><button class="close" type="button">&times;</button><div class="shape mr-s"></div><input type="text" name="multiOpt1" placeholder="選項文字"><select class="form-control"><option class="thxpage">感謝頁</option></select></div></div><a href="javascript:void(0)" class="multi-fun"><div class="shape mr-s"></div>新增選項</a><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label><input class="followw" id="follow2'+multi+'" type="checkbox"><label class="followanswer" for="follow2'+multi+'">依答案至相關頁面</label></div></div>');
});

/*多選新增選項*/
var multiOpt = 1
$('body').on('click', '.multi-fun', function() {
    multiOpt++
    $(this).parents('.item').children('.multi-con').append('<div class="mb-s"> <button class="close" type ="button">&times;</button> <div class="shape mr-s"> </div><input type="text" name="multiOpt'+multiOpt+'" placeholder="填寫選項文字"><select class="form-control"><option class="thxpage">感謝頁</option></select>  </div>');
});

/*多選選項刪除*/
$('body').on('click', '.multi-con .close', function() {
    $(this).parent().remove();
});

//下拉
var sele = 0
$('.toolbar').on('click', '.t06', function() {
    sele++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" name="select'+sele+'" type="text" placeholder="未命名的問題"></p><ol class="drop-con"><li class="mb-s"><button class="close" type="button">&times;</button><input type="text" name="selectOpt1" placeholder="選項文字"><select class="form-control"><option class="thxpage">感謝頁</option></select></li><li class="mb-s drop-fun-dot"><a href="javascript:void(0)" class="drop-fun">新增選項</a></li></ol><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label><input class="followw" id="follow3'+sele+'" type="checkbox"><label class="followanswer" for="follow3'+sele+'">依答案至相關頁面</label></div></div>');
});

/*下拉新增選項*/
var selectOpt = 1
$('body').on('click', '.drop-fun', function() {
    selectOpt++
    $(this).parents('.drop-con').children('.drop-fun-dot').before('<li class="mb-s"><button class="close" type="button">&times;</button><input type="text" name="selectOpt'+selectOpt+'" placeholder="選項文字"><select class="form-control"><option class="thxpage">感謝頁</option></select> </li>');
});

/*下拉選項刪除*/
$('body').on('click', '.drop-con li .close', function() {
    $(this).parent().remove();
});

//簡答
var qa = 0
$('.toolbar').on('click', '.t07', function() {
    qa++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" name="qa'+qa+'" placeholder="未命名的問題"></p><input class="lock" type="text" value="簡答文字" disabled><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label></div></div>');
});
//段落
var part = 0
$('.toolbar').on('click', '.t08', function() {
    part++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" name="part'+part+'" placeholder="未命名的問題"></p><input class="lock" type="text" value="詳答文字" disabled><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label></div></div>');
});
//日期
var date = 0
$('.toolbar').on('click', '.t09', function() {
    date++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" name="date'+date+'" placeholder="未命名的問題"></p><input class="lock datime" type="text" value="年/月/日" disabled><span class="glyphicon glyphicon-calendar date-icon" aria-hidden="true"></span><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label></div></div>');
});
//時間
var time = 0
$('.toolbar').on('click', '.t10', function() {
    time ++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" name="time'+time+'" placeholder="未命名的問題"></p><input class="lock datime" type="text" value="時：分" disabled><span class="glyphicon glyphicon-time time-icon" aria-hidden="true"></span><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox"><span class="slider round"></span></label></div></div>');
});


//頁面切換tab效果
$('body').on('click', '.design-form .tab-pane .nav-tabs .section a', function(){
	$('.design-form .tab-pane .nav-tabs .section').removeClass('active');
	$(this).closest('.section').addClass('active');
});


//刪除頁面
$('body').on('click', '.design-form .viewers .nav-tabs .section .close', function(){
    var id=$(this).parents(".viewers").attr("id")
    var idd = $(this).siblings('label').children('a').attr('href');
    $(this).closest('.section').remove();
    $(idd).remove();
    $(this).parents().find('.section:last').click();
    
    if(id == 'viewers-tab-01') {
        option1();        
    }
    if(id == 'viewers-tab-02') {
        option2();        
    }
    if(id == 'viewers-tab-03') {
        option3();        
    }

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
var arr1=[]
var arr2=[]
var arr3=[]
$('body').on('click','.add-section', function(){
    option1()
});
$('body').on('click','.add-section2', function(){
    option2()
});
$('body').on('click','.add-section3', function(){
    option3()
});
$('body').on('click','.select-fun', function(){
    var id=$(this).parents(".viewers").attr("id")
    if(id=='viewers-tab-01') {
        option1();        
    }
    if(id=='viewers-tab-02') {
        option2();        
    }
    if(id=='viewers-tab-03') {
        option3();        
    }
});
$('body').on('click','.drop-fun-dot', function(){
    var id=$(this).parents(".viewers").attr("id")
    if(id=='viewers-tab-01') {
        option1();        
    }
    if(id=='viewers-tab-02') {
        option2();        
    }
    if(id=='viewers-tab-03') {
        option3();        
    }
});
$('body').on('click','.multi-fun', function(){
    var id=$(this).parents(".viewers").attr("id")
    if(id=='viewers-tab-01') {
        option1();        
    }
    if(id=='viewers-tab-02') {
        option2();        
    }
    if(id=='viewers-tab-03') {
        option3();        
    }
});
$('body').on('change','.section input', function(){
    var id=$(this).parents(".viewers").attr("id")
    if(id=='viewers-tab-01') {
        option1();        
    }
    if(id=='viewers-tab-02') {
        option2();        
    }
    if(id=='viewers-tab-03') {
        option3();        
    }
});
$('body').on('change','.followw', function(){
    var id=$(this).parents(".viewers").attr("id")
    if(id=='viewers-tab-01') {
        option1();        
    }
    if(id=='viewers-tab-02') {
        option2();        
    }
    if(id=='viewers-tab-03') {
        option3();        
    }
});
// $('body').on('click','.section button.close', function(){
//     var id=$(this).parents(".viewers").attr("id")
//     if(id=='viewers-tab-01') {
//         option1();        
//     }
//     if(id=='viewers-tab-02') {
//         option2();        
//     }
//     if(id=='viewers-tab-03') {
//         option3();        
//     }
// });

function option1() {
    var inputs = $("#viewers-tab-01 .nav-tabs input[type='text']")
    arr1 = []
    $('#viewers-tab-01 .item.link .form-control option:not(.thxpage)').remove();
    inputs.each(
        function() {
            var input = $(this);
            arr1.push(input.val())
        }
    )
    for (var i = 0; i < arr1.length; i++) {
        $('#viewers-tab-01 .item.link .form-control').append('<option>' + arr1[i] + '</option>');
    }
}
function option2() {
    var inputs = $("#viewers-tab-02 .nav-tabs input[type='text']")
    arr2 = []
    $('#viewers-tab-02 .item.link .form-control option:not(.thxpage)').remove();
    inputs.each(
        function() {
            var input = $(this);
            arr2.push(input.val())
        }
    )
    for (var i = 0; i < arr2.length; i++) {
        $('#viewers-tab-02 .item.link .form-control').append('<option>' + arr2[i] + '</option>');
    }
}
function option3() {
    var inputs = $("#viewers-tab-03 .nav-tabs input[type='text']")
    arr3 = []
    $('#viewers-tab-03 .item.link .form-control option:not(.thxpage)').remove();
    inputs.each(
        function() {
            var input = $(this);
            arr3.push(input.val())
        }
    )
    for (var i = 0; i < arr3.length; i++) {
        $('#viewers-tab-03 .item.link .form-control').append('<option>' + arr3[i] + '</option>');
    }
}
