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
        });
    });


    $(function() {
        $('.date-select').datetimepicker({
            format: 'YYYY-MM-DD',
            ignoreReadonly: true,
            allowInputToggle: true,
            locale: 'ZH-TW',
            useCurrent: false,
        });
    });



    $(function() {
        $('.time-select').datetimepicker({
            format: 'HH:mm',
            ignoreReadonly: true,
            allowInputToggle: true
        });
    });
});

/*-----------------------------------/
  datatables設定
/*----------------------------------*/

$.fn.dataTable.Responsive.defaults
//助理-預約表單
// var table_a = $("#hetao-list-a").DataTable({
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
//         "extend": 'colvis',
//         "collectionLayout": 'fixed two-column'
//     }],
//     "order": [],
//     "columnDefs": [{
//         "targets": [5],
//         "orderable": false,
//     }],
//     "responsive": {
//         "breakpoints": [
//         { name: 'desktop', width: Infinity},
//         { name: 'tablet',  width: 1300},
//         ],
//         "details": {
//             "display": $.fn.dataTable.Responsive.display.childRowImmediate,
//             "type": 'none',
//             renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
//             "target": ''
//         }
//     },
// });
// $(".searchInput_a").on("keyup", function() {
//     table_a.search(this.value).draw();
// });
//助理-派工單
// var table_a2 = $("#hetao-list-a-2").DataTable({
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
//         "targets": [9],
//         "orderable": false,
//     }],
//     "responsive": {
//         "breakpoints": [
//         { name: 'desktop', width: Infinity},
//         { name: 'tablet',  width: 1370},
//         ],
//         "details": {
//             "display": $.fn.dataTable.Responsive.display.childRowImmediate,
//             "type": 'none',
//             renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
//             "target": ''
//         }
//     },
// });
// $(".searchInput_a2").on("keyup", function() {
//     table_a2.search(this.value).draw();
// });

//助理-預約表單rwd的頁面連結
$(document).ready(function(){
    $('#hetao-list-a .child').attr("onclick","javascript:location.href='detail.html'")
});


//員工-已接受的工單
var table_s2 = $("#hetao-list-s-2").DataTable({
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
        "extend": "colvis",
        "collectionLayout": "fixed two-column"
    }],
    "order": [],
    "columnDefs": [{
        "targets": [],
        "orderable": false,
    },{ 
        "width": "80px", 
        "targets": 8 }
    ],
    "responsive": {
        "breakpoints": [
        { name: 'desktop', width: Infinity},
        { name: 'tablet',  width: 1300},
        ],
        "details": {
            "display": $.fn.dataTable.Responsive.display.childRowImmediate,
            "type": 'none',
            "renderer": $.fn.dataTable.Responsive.renderer.tableAll(),
            "target": ''
        }
    },
});
$(".searchInput_s2").on("keyup", function() {
    table_s2.search(this.value).draw();
});

//員工-派工單filter
// $('#hetao-list-s-2_filter').append(
    // "<div class='form-group mr-s batch-select'><select class='form-control' id='sel1'><option selected>所有狀態</option><option>執行中</option><option>延後</option><option>已完成</option></select></div>"+
//     "<div class='coupon'>" +
//     "<form class='form-inline'>" +
//     "<div class='form-group'>" +
//     "<div class='datetime'>" +
//     "<div class='input-group date date-select'>" +
//     "<input class='form-control' placeholder='選擇起始日期' type='text'> <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div></div><span class='rwd-hide'>~</span><div class='datetime'>" +
//     "<div class='input-group date date-select mr-s'>" +
//     "<input class='form-control' placeholder='選擇結束日期' type='text'> <span class='input-group-addon mr-s'><span class='glyphicon glyphicon-calendar'></span></span>" +
//     "</div>" +
//     "</div>" +
//     "</div>" +
//     "<div class='btn-wrap'>" +
//     "<button class='mr-s' href=''>確認送出</button>" +
//     "<button class='mr-s' href=''>重新設定時間</button>" +
//     "</div>" +
//     "</form>" +
//     "</div>"
// );

// var table_su = $("#hetao-list-su").DataTable({
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
//         "extend": 'colvis',
//         "collectionLayout": 'fixed two-column'
//     }],
//     "order": [],
//     "columnDefs": [{
//         "targets": [8],
//         "orderable": false,
//     }],
//     "responsive": {
//         "breakpoints": [
//         { name: 'desktop', width: Infinity},
//         { name: 'tablet',  width: 1300},
//         ],
//         "details": {
//             "display": $.fn.dataTable.Responsive.display.childRowImmediate,
//             "type": 'none',
//             renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
//             "target": ''
//         }
//     },
// });
// $(".searchInput_su").on("keyup", function() {
//     table_su.search(this.value).draw();
// });

//主管-已指派工單
// var table_su2 = $("#hetao-list-su-2").DataTable({
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
//         "targets": [9],
//         "orderable": false,
//     }],
//     "responsive": {
//         "breakpoints": [
//         { name: 'desktop', width: Infinity},
//         { name: 'tablet',  width: 1300},
//         ],
//         "details": {
//             "display": $.fn.dataTable.Responsive.display.childRowImmediate,
//             "type": 'none',
//             renderer: $.fn.dataTable.Responsive.renderer.tableAll(),
//             "target": ''
//         }
//     },
// });
// $(".searchInput_su2").on("keyup", function() {
//     table_su2.search(this.value).draw();
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
        { name: 'tablet',  width: 1300},
        ],
        "details": {
            "display": $.fn.dataTable.Responsive.display.childRowImmediate,
            "type": 'none',
            "renderer": $.fn.dataTable.Responsive.renderer.tableAll(),
            "target": ''
        }
    },
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
$('body').on('click', '#person .add-member', function(){
    var company = $("#person .company").val()
    var role = $("#person .role").val()
    var staffname = $("#person .staffname").val()
    if((company && role && staffname) !== null){
        $('#person .memberwrap').append('<span class="tag"><div><small>'+ company +'/'+ role +'</small><br>'+ staffname +'</div><button class="close" type="button">×</button></span>');
    }
});
/*刪除會議對象*/
$('body').on('click', '#person .close', function(){
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
        $('#person .staffname').val('小美');
    }
});
/*會議對象按下完成*/
$('body').on('click', '#person .finish', function(){
    var member = $('#person .tag').text()
    var noxx = member.replace(/\×/g, ', ')
    if($('#person .memberwrap span').hasClass('tag')) {
        $('.main .o2').text(noxx);
        console.log(noxx)
        $('.main .o2').append("<input type='hidden' name='meeting' value='"+noxx+"'>");
    }else {
        $('.main .o2').text('會議對象');
    }
});

// 編輯中的"會議對象"
/*"會議對象"*/
$('body').on('click', '#meet .add-member', function(){
    var company = $("#meet .company").val()
    var role = $("#meet .role").val()
    var staffname = $("#meet .staffname").val()
    if((company && role && staffname) !== null){
        $('#meet .memberwrap').append('<span class="tag"><div><small>'+ company +'/'+ role +'</small><br>'+ staffname +'</div><button class="close" type="button">×</button><input type="hidden" name="meeting2[]" value='+company+'/'+role+staffname+'></span>');
    }
});
/*刪除會議對象*/
$('body').on('click', '#meet .close', function(){
    $(this).parent('#meet .tag').remove();
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
    var noxx = member.replace(/\×/g, ', ')
    if($('#meet .memberwrap span').hasClass('tag')) {
        $('#meet .o2').text(noxx);
    }else {
        $('#meet .o2').text('會議對象');
    }
});


// $('.edit-preview-meeting').on('click', function() {
//     alert(123)
//     $('.readmode').css('display', 'none');
//     $('.editmode').css('display', 'block');
// });
// $('.edit-meeting-finish').on('click', function() {
//     $('.readmode').css('display', 'block');
//     $('.editmode').css('display', 'none');
// });

// /*"會議對象"*/
// $('body').on('click', '#job2 .add-member', function(){
//     var company = $("#job2 .company").val()
//     var role = $("#job2 .role").val()
//     var staffname = $("#job2 .staffname").val()
//     if((company && role && staffname) !== null){
//         $('#job2 .memberwrap').append('<span class="tag"><div><small>'+ company +'/'+ role +'</small><br>'+ staffname +'</div><button class="close" type="button">×</button></span>');
//     }
// });
// 刪除會議對象
// $('body').on('click', '#job2 .close', function(){
//     $(this).parent('#job2 .tag').remove();
// });
// /*選了分公司才能選職稱*/
// $('body').on('change', '#job2 .company', function(){
//     if($(this).val() !== "") {
//         $('#job2 .role').prop('disabled','');
//     }
// });
// /*選了職稱才能選員工*/
// $('body').on('change', '#job2 .role', function(){
//     if($(this).val() !== "") {
//         $('#job2 .staffname').prop('disabled','');
//         $('#job2 .staffname').val('小美');
//     }
// });
// /*會議對象按下完成*/
// $('body').on('click', '#job2 .finish', function(){
//     var member = $('#job2 .tag').text()
//     var noxx = member.replace(/\×/g, ', ')
//     if($('#job2 .memberwrap span').hasClass('tag')) {
//         $('#job2 .o2').text(noxx);
//     }else {
//         $('#job2 .o2').text('會議對象');
//     }
// });

