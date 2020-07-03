/*-----------------------------------/
  表單模板
/*----------------------------------*/

//刪除
$('body').on('click', '.fa-trash-alt', function() {
    $(this).closest('.pd-l').remove();
});

//標題
var titleArray = new Array;
var tl = $('.title').length
for (var i = 0; i < tl; i++) {

    if($('.title')[i].name != undefined){
        titleArray.push($('.title')[i].name.split("title")[1]);
    }
}

if(titleArray == ''){
    var t = 0;
}
else{
    var t = Math.max(...titleArray);
}


$('.toolbar').on('click', '.t01', function() {
    t++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="tp-title pd-l"><button class="close" type="button"><i class="far fa-trash-alt"></i></button><input class="form-control" name="title'+t+'" type="text" placeholder="填寫標題"></div>');
});

//文章
var articleArray = new Array;
var articlel = $('.article').length

for (var i = 0; i < articlel; i++) {

    articleArray.push($('.article')[i].name.split("article")[1]);
}

if(articleArray == ''){
    var article = 0;
}
else{
    var article = Math.max(...articleArray);
}

$('.toolbar').on('click', '.t02', function() {
    article++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="form-group mgy-sm pd-l"><button class="close" type="button"><i class="far fa-trash-alt"></i></button><input type="text" name="article'+article+'" class="form-control" placeholder="輸入文字"></div>');
});
//分隔線
var line = 1000
$('.toolbar').on('click', '.t03', function() {
    line++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l"><hr><input type="hidden" name="line'+line+'"><button class="close" type="button"><i class="far fa-trash-alt"></i></button></div>');
});

var radioArray = new Array;
var radiol = $('.radio').length

for (var i = 0; i < radiol; i++) {

    radioArray.push($('.radio')[i].name.split("radio")[1]);
}

if(radioArray == ''){
    var radio = 0;
}
else{
    var radio = Math.max(...radioArray);
}

//單選
$('.toolbar').on('click', '.t04', function() {
    radio++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" name="radio'+radio+'" type="text" placeholder="未命名的問題"></p><div class="select-con"><div class="mb-s"><button class="close" type="button">&times;</button><div class="out mr-s"></div><input type="text" name="radio'+radio+'Opt" placeholder="填寫選項文字"><select class="form-control" name="radio'+radio+'Href"></select></div></div><a href="javascript:void(0)" class="select-fun"><div class="out mr-s"></div>新增選項</a><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox" name="radio'+radio+'Req"><span class="slider round"></span></label><input class="followw" name="radio'+radio+'follow1'+radio+'" id="follow1'+radio+'" type="checkbox"><label class="followanswer" for="follow1'+radio+'">依答案至相關頁面</label></div></div>');
    // option()
});

/*單選新增選項*/
var opt = radio;
$('body').on('click', '.select-fun', function() {
    opt++
    var name = $(this).parents('.item').children('.title-deco').children('.form-control').attr('name')
    $(this).parents('.item').children('.select-con').append('<div class="mb-s"> <button class="close" type ="button">&times;</button> <div class="out mr-s"> </div><input type="text" name="'+name+'Opt" placeholder="填寫選項文字"><select class="form-control" name="'+name+'Href"></select> </div>');
});

/*單選選項刪除*/
$('body').on('click', '.select-con .close', function() {
    $(this).parent().remove();
});

var multiArray = new Array;
var multil = $('.multi').length

for (var i = 0; i < multil; i++) {

    multiArray.push($('.multi')[i].name.split("multi")[1]);
}

if(multiArray == ''){
    var multi = 0;
}
else{
    var multi = Math.max(...multiArray);
}

//多選
$('.toolbar').on('click', '.t05', function() {
    multi++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" name="multi'+multi+'" placeholder="未命名的問題"></p><div class="multi-con"><div class="mb-s"><button class="close" type="button">&times;</button><div class="shape mr-s"></div><input type="text" name="multi'+multi+'Opt" placeholder="選項文字"><select class="form-control"></select></div></div><a href="javascript:void(0)" class="multi-fun"><div class="shape mr-s"></div>新增選項</a><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox" name="multi'+multi+'Req"><span class="slider round"></span></label></div></div>');
});

/*多選新增選項*/
var multiOpt = multi
$('body').on('click', '.multi-fun', function() {
    var multiname = $(this).parents('.item').children('.title-deco').children('.form-control').attr('name')
    $(this).parents('.item').children('.multi-con').append('<div class="mb-s"> <button class="close" type ="button">&times;</button> <div class="shape mr-s"> </div><input type="text" name="'+multiname+'Opt" placeholder="填寫選項文字"><select class="form-control"></select>  </div>');
});

/*多選選項刪除*/
$('body').on('click', '.multi-con .close', function() {
    $(this).parent().remove();
});


var seleArray = new Array;
var selel = $('.select').length

for (var i = 0; i < selel; i++) {

    seleArray.push($('.select')[i].name.split("select")[1]);
}

if(seleArray == ''){
    var sele = 0;
}
else{
    var sele = Math.max(...seleArray);
}

//下拉
$('.toolbar').on('click', '.t06', function() {
    sele++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" name="select'+sele+'" type="text" placeholder="未命名的問題"></p><ol class="drop-con"><li class="mb-s"><button class="close" type="button">&times;</button><input type="text"  name="select'+sele+'Opt" placeholder="選項文字"><select class="form-control" name="select'+sele+'Href"></select></li><li class="mb-s drop-fun-dot"><a href="javascript:void(0)" class="drop-fun">新增選項</a></li></ol><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox" name="select'+sele+'Req"><span class="slider round"></span></label><input class="followw" name="select'+sele+'follow3'+sele+'" id="follow3'+sele+'" type="checkbox"><label class="followanswer" for="follow3'+sele+'">依答案至相關頁面</label></div></div>');
});

/*下拉新增選項*/
var selectOpt = sele
$('body').on('click', '.drop-fun', function() {
    var selectname = $(this).parents('.item').children('.title-deco').children('.form-control').attr('name')
    $(this).parents('.drop-con').children('.drop-fun-dot').before('<li class="mb-s"><button class="close" type="button">&times;</button><input type="text" name="'+selectname+'Opt" placeholder="選項文字"><select class="form-control" name="'+selectname+'Href"></select> </li>');
});

/*下拉選項刪除*/
$('body').on('click', '.drop-con li .close', function() {
    $(this).parent().remove();
});


var qaArray = new Array;
var qal = $('.qa').length

for (var i = 0; i < qal; i++) {

    qaArray.push($('.qa')[i].name.split("qa")[1]);
}

if(qaArray == ''){
    var qa = 0;
}
else{
    var qa = Math.max(...qaArray);
}

//簡答
$('.toolbar').on('click', '.t07', function() {
    qa++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" name="qa'+qa+'" placeholder="未命名的問題"></p><input class="lock" type="text" value="簡答文字" disabled><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox" name="qa'+qa+'Req"><span class="slider round"></span></label></div></div>');
});

var partArray = new Array;
var partl = $('.part').length

for (var i = 0; i < partl; i++) {

    partArray.push($('.part')[i].name.split("part")[1]);
}

if(partArray == ''){
    var part = 0;
}
else{
    var part = Math.max(...partArray);
}

//段落
$('.toolbar').on('click', '.t08', function() {
    part++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" name="part'+part+'" placeholder="未命名的問題"></p><input class="lock" type="text" value="詳答文字" disabled><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox" name="part'+part+'Req"><span class="slider round"></span></label></div></div>');
});

var dateArray = new Array;
var datel = $('.date').length

for (var i = 0; i <datel; i++) {

    dateArray.push($('.date')[i].name.split("date")[1]);
}

if(dateArray == ''){
    var date = 0;
}
else{
    var date = Math.max(...dateArray);
}

//日期
$('.toolbar').on('click', '.t09', function() {
    date++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" name="date'+date+'" placeholder="未命名的問題"></p><input class="lock datime" type="text" value="年/月/日" disabled><span class="glyphicon glyphicon-calendar date-icon" aria-hidden="true"></span><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox" name="date'+date+'Req"><span class="slider round"></span></label></div></div>');
});

var timeArray = new Array;
var timel = $('.time').length

for (var i = 0; i <timel; i++) {

    timeArray.push($('.time')[i].name.split("time")[1]);
}

if(timeArray == ''){
    var time = 0;
}
else{
    var time = Math.max(...timeArray);
}

//時間
$('.toolbar').on('click', '.t10', function() {
    time ++
    $(this).parents('.tab-pane').find('.tab-pane.active.in .form-content-0').append('<div class="pd-l item"><p class="title-deco"><input class="form-control" type="text" name="time'+time+'" placeholder="未命名的問題"></p><input class="lock datime" type="text" value="時：分" disabled><span class="glyphicon glyphicon-time time-icon" aria-hidden="true"></span><div class="itemfoot"><button class="ml-s close" type="button"><i class="far fa-trash-alt"></i></button><label class="switch"><input type="checkbox" name="time'+time+'Req"><span class="slider round"></span></label></div></div>');
});


//頁面切換tab效果
$('body').on('click', '.design-form .tab-pane .nav-tabs .section label', function(){
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
        $(this).parent().parent('.item').find('select option').remove();
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
    var arr4 = []
    var change = $(".item select")
    change.each(function(){
            var change_value=$(this).val()
            arr4.push(change_value)
            console.log(arr4)
        })
    var inputs = $("#viewers-tab-01 .nav-tabs input[type='text']")
    arr1 = []
    $('#viewers-tab-01 .item.link .form-control option:not(.thxpage)').remove();
    inputs.each(
        function() {
            var input = $(this);
            arr1.push(input.val());
        }
    )
    $('#viewers-tab-01 .item.link .form-control').append('<option value="">請選擇</option>');
    for (var i = 0; i < arr1.length; i++) {
        $('#viewers-tab-01 .item.link .form-control').append('<option value="'+arr1[i]+'">' + arr1[i] + '</option>');
    }
    for(var i=0;i<arr4.length;i++){
            $(".item select").eq(i).val(arr4[i])
        }
}
function option2() {
    var arr4 = []
    var change = $(".item select")
    change.each(function(){
            var change_value=$(this).val()
            arr4.push(change_value)
            console.log(arr4)
        })
    var inputs = $("#viewers-tab-02 .nav-tabs input[type='text']")
    arr2 = []
    $('#viewers-tab-02 .item.link .form-control option:not(.thxpage)').remove();
    inputs.each(
        function() {
            var input = $(this);
            arr2.push(input.val())
        }
    )
    $('#viewers-tab-02 .item.link .form-control').append('<option value="">請選擇</option>');
    for (var i = 0; i < arr2.length; i++) {
        $('#viewers-tab-02 .item.link .form-control').append('<option value="'+arr2[i]+'">' + arr2[i] + '</option>');
    }
    for(var i=0;i<arr4.length;i++){
            $(".item select").eq(i).val(arr4[i])
        }
}
function option3() {
    var arr4 = []
    var change = $(".item select")
    change.each(function(){
            var change_value=$(this).val()
            arr4.push(change_value)
            console.log(arr4)
        })
    var inputs = $("#viewers-tab-03 .nav-tabs input[type='text']")
    arr3 = []
    $('#viewers-tab-03 .item.link .form-control option:not(.thxpage)').remove();
    inputs.each(
        function() {
            var input = $(this);
            arr3.push(input.val())
        }
    )
    $('#viewers-tab-03 .item.link .form-control').append('<option value="">請選擇</option>');    
    for (var i = 0; i < arr3.length; i++) {
        $('#viewers-tab-03 .item.link .form-control').append('<option value="'+arr3[i]+'">' + arr3[i] + '</option>');
    }
    for(var i=0;i<arr4.length;i++){
            $(".item select").eq(i).val(arr4[i])
        }    
}
