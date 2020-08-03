$(document).ready(function() {
    var $window = $(window),
        win_height = $window.height() * 1.1,
        istouch = "ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch;
    if (istouch) {
        $(".revealOnScroll").addClass("mobile");
    }
    $window.on("scroll", revealOnScroll);

    function revealOnScroll() {
        var scrolled = $window.scrollTop(),
            win_height = $window.height() * 1.1;
        $(".revealOnScroll:not(animated)").each(function() {
            var $this = $(this),
                offsetTop = $this.offset().top;
            if (win_height + scrolled > offsetTop) {
                if ($this.attr("data-timeout")) {
                    window.setTimeout(function() {
                        $this.addClass("animated " + $this.attr("data-animation"));
                    }, parseInt($this.attr("data-timeout")))
                } else {
                    $this.addClass("animated " + $this.attr("data-animation"));
                }
            }
        })
    }
    revealOnScroll();


});
    /*-----------------------------------/
      nav
    /*----------------------------------*/
    $('.sidebar .nav li span').click(function() {
        $('.collapse').collapse('hide');
    });

    /*-----------------------------------/
      count
    /*----------------------------------*/
    function count($this) {
        var current = parseInt($this.html(), 10);
        current = current + 1;

        $this.html(++current);
        if (current > $this.data('count')) {
            $this.html($this.data('count'));
        } else {
            setTimeout(function() { count($this) }, 40);
        }
    }
    jQuery(".stat-count").each(function() {
        jQuery(this).data('count', parseInt(jQuery(this).html(), 10));
        jQuery(this).html('0');
        count(jQuery(this));
    });

    /*-----------------------------------/
      datetime
    /*----------------------------------*/
    $(function() {
        $('.day-select').datetimepicker({
            format: 'YYYY-MM-DD',
            ignoreReadonly: true,
            allowInputToggle: true,
            locale: 'ZH-TW',
            useCurrent: false,
            ignoreReadonly: true,
        });
    });


    $(function() {
        $('.date-select').datetimepicker({
            format: 'YYYY-MM-DD',
            ignoreReadonly: true,
            allowInputToggle: true,
            locale: 'ZH-TW',
            useCurrent: false,
            ignoreReadonly: true,
        });
    });

    $(function() {
        $('.date-set').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            ignoreReadonly: true,
            allowInputToggle: true,
            locale: 'ZH-TW',
            useCurrent: false,
            ignoreReadonly: true,
            defaultDate: new Date(),
            toolbarPlacement: 'bottom',
            showClose: true,
        });
    });

    $(function () {
        $('.time-set').datetimepicker({
            format: 'HH:mm',
            ignoreReadonly: true,
            allowInputToggle: true,
            ignoreReadonly: true,
            toolbarPlacement: 'bottom',
            showClose: true,
            locale: 'ZH-TW',
        });
    });

    $(function() {
        $('.day-set').datetimepicker({
            format: 'YYYY-MM-DD',
            ignoreReadonly: true,
            allowInputToggle: true,
            locale: 'ZH-TW',
            useCurrent: false,
            ignoreReadonly: true,
            defaultDate: new Date(),
            // toolbarPlacement: 'bottom',
            // showClose: true,
            locale: 'ZH-TW',         
        });
    });

     $(function() {
        $('.day-set-c').datetimepicker({
            format: 'YYYY-MM-DD',
            ignoreReadonly: true,
            allowInputToggle: true,
            locale: 'ZH-TW',
            useCurrent: false,
            ignoreReadonly: true,
            defaultDate: new Date(),
            // toolbarPlacement: 'bottom',
            // showClose: true,
            locale: 'ZH-TW',          
        });
    });

    $(function() {
        $('.time-select').datetimepicker({
            format: 'HH:mm',
            ignoreReadonly: true,
            allowInputToggle: true,
            ignoreReadonly: true,
            locale: 'ZH-TW',
        });
    });

    $(function() {
        $('.month-select').datetimepicker({
            format: 'YYYY-MM',
            ignoreReadonly: true,
            allowInputToggle: true,
            ignoreReadonly: true,
            defaultDate: new Date(),
            locale: 'ZH-TW',
            debug: true,
            viewMode: 'months',
        });
    });

    $('.month-select').on('dp.hide', function(event){
        setTimeout(function(){
            $('.month-select').data('DateTimePicker').viewMode('months');
        },1);
    });

/*-----------------------------------/
  datatables設定
/*----------------------------------*/

$.fn.dataTable.Responsive.defaults

//員工-已接受的工單
// var table_s2 = $("#hetao-list-s-2").DataTable({
//     "bPaginate": true,
//     "searching": true,
//     "info": false,
//     "bLengthChange": false,
//     "bServerSide": false,
//     "language": {
//         "search": "",
//         "searchPlaceholder": "請輸入關鍵字",
//         "paginate": { "previous": "上一頁", "next": "下一頁" },
//     },
//     "dom": "Bfrtip",
//     "buttons": [{
//         "extend": "colvis",
//         "collectionLayout": "fixed two-column"
//     }],
//     "order": [],
//     "columnDefs": [{
//         "targets": [],
//         "orderable": false,
//     },{ 
//         "width": "80px", 
//         "targets": 8 }
//     ],
//     "responsive": {
//         "breakpoints": [
//         { name: 'desktop', width: Infinity},
//         { name: 'tablet',  width: 1024},
//         ],
//         "details": {
//             "display": $.fn.dataTable.Responsive.display.childRowImmediate,
//             "type": 'none',
//             "renderer": $.fn.dataTable.Responsive.renderer.tableAll(),
//             "target": ''
//         }
//     },
// });
// $(".searchInput_s2").on("blur", function() {
//     table_s2.search(this.value).draw();
// });

// $(".searchInput_s2").on("keyup", function() {
//     table_s2.search(this.value).draw();
// });


//權限管理
var table_authority = $("#hetao-list-authority").DataTable({
    "bPaginate": true,
    "searching": true,
    "info": false,
    "bLengthChange": false,
    "bServerSide": false,
    "language": {
        "search": "",
        "searchPlaceholder": "請輸入關鍵字",
        "paginate": { "previous": "上一頁", "next": "下一頁" },
    },
    "dom": "Bfrtip",
    "buttons": [{
        "extend": 'colvis',
        "collectionLayout": 'fixed two-column'
    }],
    "order": [],
    "columnDefs": [{
        "targets": [5],
        "orderable": false,
    }],
    "responsive": {
        "breakpoints": [
        { name: 'desktop', width: Infinity},
        { name: 'tablet',  width: 1024},
        ],
        "details": {
            "display": $.fn.dataTable.Responsive.display.childRowImmediate,
            "type": 'none',
            "renderer": $.fn.dataTable.Responsive.renderer.tableAll(),
            "target": ''
        }
    },
});
$(".searchInput_authority").on("blur", function() {
    table_authority.search(this.value).draw();
});

$(".searchInput_authority").on("keyup", function() {
    table_authority.search(this.value).draw();
});

//權限管理filter
//權限管理



//切換tab重新抓取寬度
$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
    $($.fn.dataTable.tables(true)).DataTable()
        .columns.adjust();
});
/*-----------------------------------/
  選取方塊
/*----------------------------------*/
// $('.chkall').addClass('hide');
$('.sall').addClass('hide');
$('.droptool-menu .sall').removeClass('hide');
$('.batch').on('click', function() {
    $('.batch-select').removeClass('hide');
    $('.batch-finish').removeClass('hide');
    $('.chkall').removeClass('hide');
    $('.batch').addClass('hide');
    $('.sall').removeClass('hide');
});
$('.batch-finish').on('click', function() {
    $('.batch-select').addClass('hide');
    $('.batch-finish').addClass('hide');
    $('.chkall').addClass('hide');
    $('.batch').removeClass('hide');
    $('.sall').addClass('hide');
});
$('.nav-tabs li').on('click', function() {
    $("#hetao-list").DataTable();
    $("#hetao-list-2").DataTable();
});

$('input#chkall').change(function() {
    if($(this).is(':checked')){
        $('.sall').text('取消全選');
        $('input.chkall').prop('checked',true);
    } else {
        $('input.chkall').prop('checked',false);
        $('.sall').text('全選');
    }
});

$('.droptool input[type="checkbox"]').click(function() {
    $(this).parents('.tab-pane').find('input.chkall').prop('checked', this.checked);

});
$('input.chkall').click(function() {
    var check = ($(this).parents('.tab-pane').find('input.chkall').filter(":checked").length == $(this).parents('.tab-pane').find('input.chkall').length);
    $(this).parents('.tab-pane').find('.droptool input').prop("checked", check);
});



// 轉mail
$('input#mailall').click(function() {
    $('input.mailall').prop('checked', this.checked);
});

$('input.mailall').click(function() {
    var check = ($('input.mailall').filter(":checked").length == $('input.mailall').length);
    $('input#mailall').prop("checked", check);
});





/*-----------------------------------/
  執行中/延後/已完成 狀態切換
/*----------------------------------*/
$('.table').on('click', '.btn.status', function(){
    $(this).parent().find('.btn.status').removeClass('btn-primary');
    $(this).addClass('btn-primary');
});

/*-----------------------------------/
  總覽-新增日曆設定
/*----------------------------------*/
/*"全天"開關*/
$('body').on('change', '.allday input[type="checkbox"]', function(){
    if ($(this).prop("checked")==true) {
        $('.addcalendar .time-select').addClass('hide');
        $('.addcalendar .day-select').css('width', '100%');
        $('.addcalendar .day-select').css('display', 'inline-block');
        $('.addcalendar .time-select').css('display', 'inline-block');
    } else {
        $('.addcalendar .time-select').removeClass('hide');
        $('.addcalendar .day-select').css('width', '50%');
        $('.addcalendar .day-select').css('display', 'inline-block');
        $('.addcalendar .time-select').css('display', 'inline-block');

    }
});
$('body').on('click', '#newalert button', function(){
    var unit = $("input[name='t']:checked").val()
    var num = $("#newalert input[type='number']").val()
    //$('.o1').attr('data-target', '#newalert').html(num+unit);
    $('#notice').val(num+unit);
    $('input[name="notice"]').val(num);
    $('input[name="noticeTime"]').val(unit);
});

/*"會議對象"*/
var array = [];
$('body').on('click', '#person .add-member', function(){
    var company = $("#person .company").val()
    var role = $("#person .role").val()
    var staffname = $("#person .staffname").find("option:selected").text()
    var token = $("#person .staffname").find("option:selected").val()
    //console.log(token)
    if(array.indexOf(token) == -1){
        array.push(token)
        if((company && role && staffname) !== null){
            $(this).parents('#person').find('.memberwrap').append('<span class="tag"><div><small>'+ company +'/'+ role +'</small><br>'+ staffname +'</div><button class="close" type="button">×</button><span class="tok" hidden>'+token+'×</span></span>');
        }
    }
    else{
        alert('此人員已新增')
    }
});


/*刪除會議對象*/
$('body').on('click', '#person .close', function(){
    var token = $(this).parents('.tag').children('.tok')[0].textContent
    var token = token.substring(0, token.length-1)
    $.each(array, function (i, item) {
        if(item == token){
            array.splice(i, 1);
        }
    });
    $(this).parent('#person .tag').remove();
});

/*選了分公司才能選職稱*/
$('body').on('change', '#person .company', function(){
    if($(this).val() !== "") {
        $('#person .role').prop('disabled','');
    }
});

/*選了職稱才能選員工*/
$('body').on('change', '#person .role', function(){
    if($(this).val() !== "") {
        $('#person .staffname').prop('disabled','');
        $('#person .staffname').val('');
    }
});



/*會議對象按下完成*/
$('body').on('click', '#person .finish', function(){
    var member = $('#person .tag').text()
    var token = $('#person .tok').text()
    var noxx = member.replace(/\×/g, ',')
    var noxxx = token.replace(/\×/g, ',')
    
    var noxx = noxx.split(",");

    console.log(noxx)

    var re = '';
    $.each(noxx, function (i, item) {
        if(i%2 == 0){
            re += item+",";
        }  
    })

    var re = re.substring(0, re.length-1)

    if($('#person .memberwrap span').hasClass('tag')) {
        // $('.main .o2').html(noxx);
        $('textarea[name="meeting"]').html(re);
        $('.main .o2').after("<input type='hidden' name='meeting' value='"+re+"'>");
        $('.main .o2').after("<input type='hidden' name='meetingToken' value='"+noxxx+"'>");
        // $('textarea[name="meeting"]').css('height', 'auto');
        document.getElementById('meeting').style.height = "34px";
        document.getElementById('meeting').style.height = ( document.getElementById('meeting').scrollHeight)+"px";
    }else {
        $('.main .o2').text('會議對象');
        $('textarea[name="meeting"]').css('height', '34px');
    }
});

// 編輯中的"會議對象"
/*"會議對象"*/
var array = [];
$('body').on('click', '#meet .add-member', function(){
    var company = $("#meet .company").val()
    var role = $("#meet .role").val()
    var staffname = $("#meet .staffname").find("option:selected").text()
    var token = $("#meet .staffname").find("option:selected").val()
    if(array == null || array == ''){
        var haveToken = $("input[name='meetingToken']").val();
        var aaa = haveToken.split(",");
        for (var i = 0; i < aaa.length; i++) {
            array.push(aaa[i]);
        }
    }

    if(array.indexOf(token) == -1){
        array.push(token)
        if((company && role && staffname) !== null){
            $('#meet .memberwrap').append('<span class="tag"><div><small>'+ company +'/'+ role +'</small><br>'+ staffname +'</div><button class="close" type="button">×</button><input type="hidden" name="meeting2[]" value='+company+'/'+role+staffname+'><span class="tok" hidden>'+token+'</span></span></span></span>');
        }
    }
    else{
        alert('此人員已新增')
    }
    console.log(array)
});

var count = 0
/*刪除會議對象*/
$('body').on('click', '#meet .close', function(){

    if(count == 0){
        var haveToken = $("input[name='meetingToken']").val();
        var aaa = haveToken.split(",");
        for (var i = 0; i < aaa.length; i++) {
            array.push(aaa[i]);
        }
    }
    // var token = $(this).parents('.memberwrap').children('.tag').children('.tok')[0].textContent
    var token = $(this).parents('.tag').children('.tok')[0].textContent
    console.log(token)
    $.each(array, function (i, item) {
        if(item == token){
            array.splice(i, 1);
        }
    });
    console.log(array)
    $(this).parent('#meet .tag').remove();
    ++count
});
/*選了分公司才能選職稱*/
$('body').on('change', '#meet .company', function(){
    if($(this).val() !== "") {
        $('#meet .role').prop('disabled','');
    }
});
/*選了職稱才能選員工*/
$('body').on('change', '#meet .role', function(){
    if($(this).val() !== "") {
        $('#meet .staffname').prop('disabled','');
        $('#meet .staffname').val('小美');
    }
});
/*會議對象按下完成*/
$('body').on('click', '#meet .finish', function(){
    var member = $('#meet .tag').text()
    console.log(member)
    var noxx = member.replace(/\×/g, ', ')
    if($('#meet .memberwrap span').hasClass('tag')) {
        $('#meet .o2').text(noxx);
    }else {
        $('#meet .o2').text('會議對象');
    }
});


$('.edit-preview-meeting').on('click', function() {
    $('.readmode').css('display', 'none');
    $('.editmode').css('display', 'block');
});
$('.edit-meeting-finish').on('click', function() {
    $('.readmode').css('display', 'block');
    $('.editmode').css('display', 'none');
});

/*"會議對象"*/
$('body').on('click', '#job2 .add-member', function(){
    var company = $("#job2 .company").val()
    var role = $("#job2 .role").val()
    var staffname = $("#job2 .staffname").val()
    if((company && role && staffname) !== null){
        $('#job2 .memberwrap').append('<span class="tag"><div><small>'+ company +'/'+ role +'</small><br>'+ staffname +'</div><button class="close" type="button">×</button><input type="hidden" name="meeting2[]" value='+company+'/'+role+staffname+'></span>');
    }
});
/*刪除會議對象*/
$('body').on('click', '#job2 .close', function(){
    $(this).parent('#job2 .tag').remove();
});
/*選了分公司才能選職稱*/
$('body').on('change', '#job2 .company', function(){
    if($(this).val() !== "") {
        $('#job2 .role').prop('disabled','');
    }
});
/*選了職稱才能選員工*/
$('body').on('change', '#job2 .role', function(){
    if($(this).val() !== "") {
        $('#job2 .staffname').prop('disabled','');
        $('#job2 .staffname').val('小美');
    }
});
/*會議對象按下完成*/
$('body').on('click', '#job2 .finish', function(){
    var member = $('#job2 .tag').text()
    var noxx = member.replace(/\×/g, ', ')
    if($('#job2 .memberwrap span').hasClass('tag')) {
        $('#job2 .o2').text(noxx);
    }else {
        $('#job2 .o2').text('會議對象');
    }
});

$(window).on('resize', function(e) {
    $($.fn.dataTable.tables(true)).DataTable()
        .columns.adjust();
});

var u = navigator.userAgent;
var isIos = u.indexOf('iPhone') > -1 || u.indexOf('Mac') > -1;
if (isIos) {
    $('input[name="keywords"], select').focus(function(e) {
        var mviewport;
        var metas = document.getElementsByTagName('meta') || [];
        for (var i in metas) {
            var meta = metas[i] || {},
                mtname = meta.name || "";
            if (mtname.toLowerCase() == "viewport") {
                mviewport = meta;
                break;
            }
        }
        if (mviewport) {
            var metacontent = mviewport.content;
            if (metacontent && metacontent.replace) {
                mviewport.content = metacontent.replace('user-scalable=yes', 'user-scalable=no');
                setTimeout(function() {
                    mviewport.content = metacontent;
                }, 2000)
            }
        }
    })
}

$(document).ready(function ()
{
    if (/iPhone/.test(navigator.userAgent) && !window.MSStream)
    {
        $(document).on("focus", "input, textarea, select", function()
        {
            $('meta[name=viewport]').remove();
            $('head').append('<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">');
        });

        $(document).on("blur", "input, textarea, select", function()
        {
            $('meta[name=viewport]').remove();
            $('head').append('<meta name="viewport" content="width=device-width, initial-scale=1">');
        });
    }
});


// 隱藏rwd沒有標題的:
$(document).ready(function(){
    $('.dtr-details tr:nth-child(1) td:nth-child(odd)').each(function(){
        if($(this).text()==":") {
            $(this).css('visibility', 'hidden');
        }
    });
    $('.dtr-details tr:nth-last-child(1) td:nth-child(odd)').each(function(){
        if($(this).text()==":") {
            $(this).css('visibility', 'hidden');
        }
    });
});

$(window).on('resize', function(){
    $('.dtr-details tr:nth-child(1) td:nth-child(odd)').each(function(){
        if($(this).text()==":") {
            $(this).css('visibility', 'hidden');
        }
    });
    $('.dtr-details tr:nth-last-child(1) td:nth-child(odd)').each(function(){
        if($(this).text()==":") {
            $(this).css('visibility', 'hidden');
        }
    });
});

$(document).mouseup(function(e) {
    var droptoolmenu = $(".droptool-menu");
    var droptool = $(".droptool");
    var chkall = $('.tab-pane .td-icon .chkall')
    if ($(e.target).closest(chkall).length == 0 && !droptool.is(e.target) && !droptoolmenu.is(e.target) && droptoolmenu.has(e.target).length == 0) {
        droptoolmenu.hide(500);
        chkall.hide(500);
    }
});
