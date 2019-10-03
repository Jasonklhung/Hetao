@extends('layout.app')

@section('content')
<div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 表單設定 -->
                    <h3 class="page-title">表單設定 <span>Form</span></h3>
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-pencil-alt"></i>表單樣式設定
                                        </div>
                                        <div class="panel-body design-form">
                                            <div class="tabbable">
                                                <!-- tab標籤 -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-03">與我聯繫</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content mgt-xl">
                                                    <!-- 與我聯繫 -->
                                                    <div class="tab-pane active viewers" id="viewers-tab-03">
                                                        <!-- 編輯列 -->
                                                        <div class="nav nav-tabs">
                                                                <div class="sec03 section mr-s active">
                                                                    <label for="sec03">
                                                                        <i class="fas fa-check-circle fa-fw"></i>
                                                                        <a class="thx" data-toggle="tab" href="#thankyou3">
                                                                        <span>感謝頁</span> </a><input type="checkbox" id="sec03" class="form-sec-btn">
                                                                    </label>
                                                                </div>
                                                            <!-- 新增頁面 -->
                                                            <div class="add-section3 mr-s">
                                                                <i class="fas fa-plus"></i>
                                                            </div>
                                                            <!-- 儲存 -->
                                                            <button type="submit" class="save">
                                                                <i class="fas fa-save"></i>
                                                            </button>
                                                            <div class="sticky toolbar text-center">
                                                                <ul>
                                                                    <li class="t01"><img src="{{ asset('img/head.png') }}">標題</li><li class="t02"><img src="{{ asset('img/article.png') }}">文章</li><li class="t03"><img src="{{ asset('img/divider.png') }}">隔線</li><li class="t04"><img src="{{ asset('img/select.png') }}">單選</li><li class="t05"><img src="{{ asset('img/checked.png') }}">多選</li><li class="t06"><img src="{{ asset('img/drop.png') }}">下拉</li><li class="t07"><img src="{{ asset('img/simple.png') }}">簡答</li><li class="t08"><img src="{{ asset('img/multiple.png') }}">段落</li><li class="t09"><img src="{{ asset('img/date.png') }}">日期</li><li class="t10"><img src="{{ asset('img/time.png') }}">時間</li><li class="rwdmenu"><i class="fas fa-pencil-alt"></i></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- 感謝頁 開頭-->
                                                        <div class="tab-pane fade in active" id="thankyou3">
                                                            <div class="panel panel-default panel-type page">
                                                                <div class="panel-heading text-center font-l font-r">與我聯繫</div>
                                                                <div class="panel-body font-sm pdx-0">
                                                                    <div class="last-page tab-content">
                                                                        <form class="form-content-0" action="">
                                                                            <div class="form-group mgy-sm pd-l">
                                                                                <textarea class="form-control" placeholder="填寫歡迎詞" row="1">感謝您耐心填寫表單，我們將會盡速聯繫您！</textarea>
                                                                            </div>
                                                                        </form>   
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- 感謝頁 結束-->
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
        </div>
@endsection

@section('scripts')
<!-- ▼本頁引用▼ -->
<script src="{{ asset('js/formset.js') }}"></script>
<!-- ▲本頁引用▲ -->
<script type="text/javascript">
    var k = 1
    var c = 0 
    $('body').on('click', '.add-section3', function(){
        k++
        c++
        $(this).parent().children('.sec03').before('<div class="sec-3-'+ k +' section mr-s"><label for="sec-3-'+ k +'"><i class="fas fa-check-circle fa-fw"></i><a data-toggle="tab" href="#p-3-'+ k +'"><input class="form-control" type="text" placeholder="未命名"></a><input type="checkbox" id="sec-3-'+ k +'" class="form-sec-btn"></label><button class="close"type="button">&times;</button></div>');
        $(this).parent().parent().append('<div class="tab-pane fade" id="p-3-'+ k +'"><div class="panel panel-default panel-type page"><div class="panel-heading text-center font-l font-r">線上預約表單</div><div class="panel-body font-sm pdx-0"><div class="last-page tab-content"><form class="form-content-0" action=""></form></div></div></div></div>');
        $(".add-section").parent().find('.thx').siblings(".section:last").click();
    });
</script>
@endsection