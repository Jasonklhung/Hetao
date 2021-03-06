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

                                                            @if($contact->isNotEmpty())
                                                                @foreach($contact as $key => $data)
                                                                    @if($data->name == '感謝頁')
                                                                        <div class="sec0{{$key}} section mr-s active">
                                                                            <label for="sec0{{$key}}">
                                                                                <i class="fas fa-check-circle fa-fw"></i>
                                                                                <a class="thx" data-toggle="tab" href="#{{$data->name}}">
                                                                                <input class="form-control formName" type="text" value="{{$data->name}}" disabled=""></a>
                                                                                <input type="checkbox" id="sec0{{$key}}" class="form-sec-btn">
                                                                            </label>
                                                                        </div>
                                                                    @else
                                                                         <div class="sec0{{$key}} section mr-s">
                                                                            <label for="sec0{{$key}}">
                                                                                <i class="fas fa-check-circle fa-fw"></i>
                                                                                <a class="thx" data-toggle="tab" href="#{{$data->name}}">
                                                                                <input class="form-control formName" type="text" value="{{$data->name}}"></a>
                                                                                <input type="checkbox" id="sec0{{$key}}" class="form-sec-btn">
                                                                            </label>
                                                                            <button class="close"type="button">&times;</button>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <div class="sec03 section mr-s active">
                                                                    <label for="sec03">
                                                                        <i class="fas fa-check-circle fa-fw"></i>
                                                                        <a class="thx" data-toggle="tab" href="#thankyou3">
                                                                        <input class="form-control formName" type="text" value="感謝頁" disabled=""></a><input type="checkbox" id="sec03" class="form-sec-btn">
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            <!-- 新增頁面 -->
                                                            <div class="add-section3 mr-s">
                                                                <i class="fas fa-plus"></i>
                                                            </div>
                                                            <!-- 儲存 -->
                                                            <button type="button" id="save" class="save">
                                                                <i class="fas fa-save"></i>
                                                            </button>
                                                            <div class="sticky toolbar text-center">
                                                                <ul>
                                                                    <li class="t01"><img src="{{ asset('img/head.png') }}">標題</li><li class="t02"><img src="{{ asset('img/article.png') }}">文章</li><li class="t03"><img src="{{ asset('img/divider.png') }}">隔線</li><li class="t04"><img src="{{ asset('img/select.png') }}">單選</li><li class="t05"><img src="{{ asset('img/checked.png') }}">多選</li><li class="t06"><img src="{{ asset('img/drop.png') }}">下拉</li><li class="t07"><img src="{{ asset('img/simple.png') }}">簡答</li><li class="t08"><img src="{{ asset('img/multiple.png') }}">段落</li><li class="t09"><img src="{{ asset('img/date.png') }}">日期</li><li class="t10"><img src="{{ asset('img/time.png') }}">時間</li><li class="rwdmenu"><i class="fas fa-pencil-alt"></i></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- 感謝頁 開頭-->
                                                        @if($contact->isNotEmpty())
                                                            @foreach($contact as $k => $data)
                                                                @php
                                                                    $form = json_decode($data->form);

                                                                    $testArr = array();
                                                                    $number = 0;
                                                                    $numberSel = 0;

                                                                    foreach($form as $abc){

                                                                        array_push($testArr,$abc->name);
                                                                    }

                                                                    foreach($form as $test){
                                                                        if(preg_match("/^radio+[0-9]+Href+$/", $test->name)){
                                                                            $radioHrefY = true;
                                                                        }
                                                                        elseif(preg_match("/^select+[0-9]+Href+$/", $test->name)){
                                                                            $selectHrefY = true;
                                                                        }
                                                                    }
                                                                @endphp

                                                                @if($data->name == '感謝頁')
                                                                    <div class="tab-pane fade in active" id="{{$data->name}}">
                                                                        <div class="panel panel-default panel-type page">
                                                                            <div class="panel-heading text-center font-l font-r">與我聯繫表單</div>
                                                                            <div class="panel-body font-sm pdx-0">
                                                                                <div class="last-page tab-content">
                                                                                    <form class="form-content-0 classForm" id="FormId{{$k}}" action="">
                                                                                        <div class="form-group mgy-sm pd-l">
                                                                                           @foreach($form as $v => $value)
                                                                                                @if(preg_match("/^title+[0-9]+$/", $value->name))
                                                                                                    <div class="tp-title pd-l">
                                                                                                        <button class="close" type="button"><i class="far fa-trash-alt"></i></button><input class="form-control title" name="{{$value->name}}" type="text" value="{{$value->value}}" placeholder="填寫標題">
                                                                                                    </div>
                                                                                                @elseif(preg_match("/^article+[0-9]+$/", $value->name))
                                                                                                    <div class="form-group mgy-sm pd-l">
                                                                                                        <button class="close" type="button"><i class="far fa-trash-alt"></i></button><input type="text" name="{{$value->name}}" class="form-control article" placeholder="輸入文字" value="{{$value->value}}">
                                                                                                    </div>
                                                                                                @elseif(preg_match("/^line+[0-9]+$/", $value->name))
                                                                                                    <div class="pd-l">
                                                                                                        <hr><input type="hidden" class="line" name="{{$value->name}}"><button class="close" type="button"><i class="far fa-trash-alt"></i></button>
                                                                                                    </div>
                                                                                                @elseif(preg_match("/^radio+[0-9]+$/", $value->name))
                                                                                                    @foreach($form as $fo => $follows)
                                                                                                        @php
                                                                                                            if(preg_match("/^radio+[0-9]+$/", $value->name)){

                                                                                                            $num = explode('radio',$value->name)[1];
                                                                                                            $folw = $value->name.'follow1'.$num;

                                                                                                                if(in_array($folw,$testArr)){
                                                                                                                    $radioF = 'Y';
                                                                                                                }
                                                                                                                else{
                                                                                                                    $radioF = 'N';
                                                                                                                    $number = $fo;
                                                                                                                }
                                                                                                            }
                                                                                                        @endphp

                                                                                                        @if($radioF == 'Y')
                                                                                                        @if(preg_match("/^radio+[0-9]+follow+[0-9]+$/", $follows->name))
                                                                                                            @if(explode('follow',$follows->name)[0] == $value->name)
                                                                                                                @if($follows->value == 'on')
                                                                                                    <div class="pd-l item link">
                                                                                                                @else
                                                                                                    <div class="pd-l item">
                                                                                                                @endif
                                                                                                            @endif
                                                                                                        @endif
                                                                                                        @elseif($radioF == 'N' && $number == $v)
                                                                                                    <div class="pd-l item">
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                        <p class="title-deco">
                                                                                                            <input class="form-control radio" name="{{$value->name}}" value="{{$value->value}}" type="text" placeholder="未命名的問題">
                                                                                                        </p>
                                                                                                        <div class="select-con">
                                                                                                        @foreach($form as $a => $aaa)

                                                                                                                @php
                                                                                                                    if(preg_match("/^radio+[0-9]+$/", $value->name)){

                                                                                                                    $folw = $value->name.'Href';

                                                                                                                        if(in_array($folw,$testArr)){
                                                                                                                            $radioF = 'Y';
                                                                                                                        }
                                                                                                                        else{
                                                                                                                            $radioF = 'N';
                                                                                                                            $number = $a;
                                                                                                                        }
                                                                                                                    }
                                                                                                                @endphp
                                                                                                                
                                                                                                            @if($radioF == 'Y')

                                                                                                                @if(preg_match("/^radio+[0-9]+Opt+$/", $aaa->name))
                                                                                                                @if(explode('Opt',$aaa->name)[0] == $value->name)
                                                                                                            <div class="mb-s">    
                                                                                                                    <button class="close" type="button">×</button>
                                                                                                                    <div class="out mr-s">

                                                                                                                    </div>
                                                                                                                    <input type="text" name="{{$aaa->name}}" value="{{$aaa->value}}" placeholder="填寫選項文字">
                                                                                                                    <select class="form-control" name="{{explode('Opt',$aaa->name)[0]}}Href">
                                                                                                                    @endif
                                                                                                                @elseif(preg_match("/^radio+[0-9]+Href+$/", $aaa->name))
                                                                                                                    @if(explode('Href',$aaa->name)[0] == $value->name)
                                                                                                                    <option value="">請選擇</option>
                                                                                                                        @foreach($contact as $r => $res)
                                                                                                                            @if($aaa->value == $res->name)
                                                                                                                    <option value="{{$res->name}}" selected="">{{$res->name}}</option>
                                                                                                                            @else
                                                                                                                    <option value="{{$res->name}}">{{$res->name}}</option>
                                                                                                                         @endif
                                                                                                                    @endforeach
                                                                                                                </select>
                                                                                                            </div>
                                                                                                                @endif
                                                                                                                @endif
                                                                                                            @elseif($radioF == 'N' && $number == $v)
                                                                                                                @foreach($form as $a => $aaa)
                                                                                                                    @if(preg_match("/^radio+[0-9]+Opt+$/", $aaa->name))
                                                                                                                        @if(explode('Opt',$aaa->name)[0] ==$value->name)
                                                                                                                <div class="mb-s">
                                                                                                                    <button class="close" type="button">×</button>
                                                                                                                    <div class="out mr-s">

                                                                                                                    </div>
                                                                                                                    <input type="text" name="{{$aaa->name}}" placeholder="填寫選項文字" value="{{$aaa->value}}">
                                                                                                                    <select class="form-control" name="{{explode('Opt',$aaa->name)[0]}}Href">
                                                                                                                        
                                                                                                                    </select>
                                                                                                                </div>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                        </div>
                                                                                                        <a href="javascript:void(0)" class="select-fun">
                                                                                                            <div class="out mr-s"></div>新增選項
                                                                                                        </a>
                                                                                                        <div class="itemfoot">
                                                                                                            <button class="ml-s close" type="button">
                                                                                                                <i class="far fa-trash-alt"></i>
                                                                                                            </button>
                                                                                                            @foreach($form as $c => $ccc)
                                                                                                                @php
                                                                                                                if(preg_match("/^radio+[0-9]+$/", $value->name)){

                                                                                                                $folw = $value->name.'Req';

                                                                                                                    if(in_array($folw,$testArr)){
                                                                                                                        $radioF = 'Y';
                                                                                                                    }
                                                                                                                    else{
                                                                                                                        $radioF = 'N';
                                                                                                                        $number = $c;
                                                                                                                    }
                                                                                                                }
                                                                                                                @endphp
                                                                                                                @if($radioF == 'Y')
                                                                                                                @if(preg_match("/^radio+[0-9]+Req+$/", $ccc->name))
                                                                                                                    @if(explode('Req',$ccc->name)[0] == $value->name)
                                                                                                                        @if($ccc->value == 'on')
                                                                                                                        <label class="switch">
                                                                                                                            <input type="checkbox" checked="" name="{{$ccc->name}}">
                                                                                                                            <span class="slider round"></span>
                                                                                                                        </label>
                                                                                                                        @else
                                                                                                                        <label class="switch">
                                                                                                                            <input type="checkbox" name="{{$ccc->name}}Req">
                                                                                                                            <span class="slider round"></span>
                                                                                                                        </label>
                                                                                                                        @endif
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                                @elseif($radioF == 'N' && $number == $v)
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$ccc->name}}Req">
                                                                                                                    <span class="slider round"></span>
                                                                                                                </label>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                            @foreach($form as $x => $xxx)
                                                                                                                @php
                                                                                                                if(preg_match("/^radio+[0-9]+$/", $value->name)){

                                                                                                                $num = explode('radio',$value->name)[1];
                                                                                                                $folw = $value->name.'follow1'.$num;

                                                                                                                    if(in_array($folw,$testArr)){
                                                                                                                        $radioF = 'Y';
                                                                                                                    }
                                                                                                                    else{
                                                                                                                        $radioF = 'N';
                                                                                                                        $number = $x;
                                                                                                                    }
                                                                                                                }
                                                                                                                @endphp
                                                                                                            @if($radioF == 'Y')
                                                                                                                @if(preg_match("/^radio+[0-9]+follow+[0-9]+$/", $xxx->name))
                                                                                                                    @if(explode('follow',$xxx->name)[0] == $value->name)
                                                                                                                        @if($xxx->value == 'on')
                                                                                                            <input class="followw" name="{{$xxx->name}}" id="{{explode('follow',$xxx->name)[1]}}" checked="" type="checkbox">
                                                                                                                        @else
                                                                                                            <input class="followw" name="{{$xxx->name}}" id="{{explode('follow',$xxx->name)[1]}}" type="checkbox">
                                                                                                                        @endif
                                                                                                            <label class="followanswer" for="{{explode('follow',$xxx->name)[1]}}">依答案至相關頁面</label>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @elseif($radioF == 'N' && $number == $v)
                                                                                                            <input class="followw" name="{{$xxx->name}}follow1{{$num}}" id="follow1{{$num}}" type="checkbox">
                                                                                                            <label class="followanswer" for="follow1{{$num}}">依答案至相關頁面</label>
                                                                                                            @endif
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @elseif(preg_match("/^multi+[0-9]+$/", $value->name))
                                                                                                    <div class="pd-l item">
                                                                                                        <p class="title-deco">
                                                                                                            <input class="form-control multi" type="text" name="{{$value->name}}" value="{{$value->value}}" placeholder="未命名的問題"></p>
                                                                                                            <div class="multi-con">
                                                                                                                @foreach($form as $d => $ddd)
                                                                                                                    @if(preg_match("/^multi+[0-9]+Opt+$/", $ddd->name))
                                                                                                                    @if(explode('Opt',$ddd->name)[0] == $value->name)
                                                                                                                <div class="mb-s">
                                                                                                                    <button class="close" type="button">×</button>
                                                                                                                    <div class="shape mr-s">
                                                                                                                        
                                                                                                                    </div>
                                                                                                                    <input type="text" name="{{$ddd->name}}" value="{{$ddd->value}}" placeholder="選項文字">
                                                                                                                    <select class="form-control">
                                                                                                                        
                                                                                                                    </select>
                                                                                                                </div>
                                                                                                                    @endif
                                                                                                                    @endif
                                                                                                                @endforeach
                                                                                                            </div>
                                                                                                            <a href="javascript:void(0)" class="multi-fun">
                                                                                                                <div class="shape mr-s">
                                                                                                                    
                                                                                                                </div>新增選項
                                                                                                            </a>
                                                                                                                <div class="itemfoot">
                                                                                                                    <button class="ml-s close" type="button">
                                                                                                                        <i class="far fa-trash-alt">
                                                                                                                            
                                                                                                                        </i>
                                                                                                                    </button>
                                                                                                                @foreach($form as $e => $eee)
                                                                                                                    @php
                                                                                                                        if(preg_match("/^multi+[0-9]+$/", $value->name)){

                                                                                                                        $folw = $value->name.'Req';

                                                                                                                            if(in_array($folw,$testArr)){
                                                                                                                                $radioF = 'Y';
                                                                                                                            }
                                                                                                                            else{
                                                                                                                                $radioF = 'N';
                                                                                                                                $number = $e;
                                                                                                                            }
                                                                                                                        }
                                                                                                                    @endphp
                                                                                                                @if($radioF == 'Y')
                                                                                                                    @if(preg_match("/^multi+[0-9]+Req+$/", $eee->name))
                                                                                                                    @if(explode('Req',$eee->name)[0] == $value->name)
                                                                                                                        @if($eee->value == 'on')
                                                                                                                    <label class="switch">
                                                                                                                        <input type="checkbox" name="{{$eee->name}}" checked="">
                                                                                                                        <span class="slider round"></span>
                                                                                                                    </label>
                                                                                                                        @else
                                                                                                                    <label class="switch">
                                                                                                                        <input type="checkbox" name="{{$eee->name}}">
                                                                                                                        <span class="slider round"></span>
                                                                                                                    </label>    
                                                                                                                        @endif
                                                                                                                    @endif
                                                                                                                    @endif
                                                                                                                @elseif($radioF == 'N' && $number == $v)
                                                                                                                    <label class="switch">
                                                                                                                        <input type="checkbox" name="{{$eee->name}}">
                                                                                                                        <span class="slider round"></span>
                                                                                                                    </label>
                                                                                                                @endif
                                                                                                                @endforeach
                                                                                                                </div>
                                                                                                        </div>
                                                                                                @elseif(preg_match("/^select+[0-9]+$/", $value->name))
                                                                                                    @foreach($form as $fol => $followS)
                                                                                                        @php
                                                                                                            if(preg_match("/^select+[0-9]+$/", $value->name)){

                                                                                                            $num = explode('select',$value->name)[1];
                                                                                                            $folw = $value->name.'follow3'.$num;

                                                                                                                if(in_array($folw,$testArr)){
                                                                                                                    $selectF = 'Y';
                                                                                                                }
                                                                                                                else{
                                                                                                                    $selectF = 'N';
                                                                                                                    $numberSel = $fol;
                                                                                                                }
                                                                                                            }
                                                                                                        @endphp
                                                                                                        @if($selectF == 'Y')
                                                                                                        @if(preg_match("/^select+[0-9]+follow+[0-9]+$/", $followS->name))
                                                                                                            @if(explode('follow',$followS->name)[0] == $value->name)
                                                                                                                @if($followS->value == 'on')
                                                                                                    <div class="pd-l item link">
                                                                                                                @else
                                                                                                    <div class="pd-l item">
                                                                                                                @endif
                                                                                                            @endif
                                                                                                        @endif
                                                                                                        @elseif($selectF == 'N' && $numberSel == $v)
                                                                                                    <div class="pd-l item">
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                        <p class="title-deco">
                                                                                                            <input class="form-control select" name="{{$value->name}}" value="{{$value->value}}" type="text" placeholder="未命名的問題">
                                                                                                        </p>
                                                                                                        <ol class="drop-con">
                                                                                                            @foreach($form as $f => $fff)
                                                                                                               @php
                                                                                                                    if(preg_match("/^select+[0-9]+$/", $value->name)){

                                                                                                                    $folw = $value->name.'Href';

                                                                                                                        if(in_array($folw,$testArr)){
                                                                                                                            $radioF = 'Y';
                                                                                                                        }
                                                                                                                        else{
                                                                                                                            $radioF = 'N';
                                                                                                                            $number = $f;
                                                                                                                        }
                                                                                                                    }
                                                                                                                @endphp
                                                                                                                
                                                                                                                @if($radioF == 'Y')
                                                                                                                    @if(preg_match("/^select+[0-9]+Opt+$/", $fff->name))
                                                                                                                        @if(explode('Opt',$fff->name)[0] == $value->name)
                                                                                                                <li class="mb-s">
                                                                                                                    <button class="close" type="button">×</button>
                                                                                                                    <input type="text" name="{{$fff->name}}" value="{{$fff->value}}" placeholder="選項文字">
                                                                                                                    <select class="form-control" name="{{explode('Opt',$fff->name)[0]}}Href">
                                                                                                                        @endif
                                                                                                                    @elseif(preg_match("/^select+[0-9]+Href+$/", $fff->name))
                                                                                                                    @if(explode('Href',$fff->name)[0] ==$value->name)
                                                                                                                            
                                                                                                                        <option value="">請選擇</option>
                                                                                                                            @foreach($contact as $rr => $rres)
                                                                                                                                @if($fff->value == $rres->name)
                                                                                                                                    <option value="{{$rres->name}}" selected="">{{$rres->name}}</option>
                                                                                                                                @else
                                                                                                                                    <option value="{{$rres->name}}">{{$rres->name}}</option>
                                                                                                                                @endif
                                                                                                                            @endforeach
                                                                                                                    
                                                                                                                    </select>
                                                                                                                </li>
                                                                                                                    @endif
                                                                                                                    @endif
                                                                                                                @elseif($radioF == 'N' && $number == $v)
                                                                                                                    @foreach($form as $f=> $fff)
                                                                                                                    @if(preg_match("/^select+[0-9]+Opt+$/", $fff->name))
                                                                                                                        @if(explode('Opt',$fff->name)[0] == $value->name)
                                                                                                                <li class="mb-s">
                                                                                                                    <button class="close" type="button">×</button>
                                                                                                                    <input type="text" name="{{$fff->name}}" value="{{$fff->value}}" placeholder="選項文字">
                                                                                                                    <select class="form-control" name="{{explode('Opt',$fff->name)[0]}}Href">
                                                                                                                        
                                                                                                                    </select>
                                                                                                                </li>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                            @endif
                                                                                                            @endforeach
                                                                                                            <li class="mb-s drop-fun-dot">
                                                                                                                <a href="javascript:void(0)" class="drop-fun">新增選項
                                                                                                                </a>
                                                                                                            </li>
                                                                                                        </ol>
                                                                                                        <div class="itemfoot">
                                                                                                            <button class="ml-s close" type="button">
                                                                                                                <i class="far fa-trash-alt">
                                                                                                                    
                                                                                                                </i>
                                                                                                            </button>
                                                                                                        @foreach($form as $g => $ggg)
                                                                                                                @php
                                                                                                                    if(preg_match("/^select+[0-9]+$/", $value->name)){

                                                                                                                    $folw = $value->name.'Req';

                                                                                                                        if(in_array($folw,$testArr)){
                                                                                                                            $selectF = 'Y';
                                                                                                                        }
                                                                                                                        else{
                                                                                                                            $selectF = 'N';
                                                                                                                            $numberSel = $g;
                                                                                                                        }
                                                                                                                    }
                                                                                                                @endphp
                                                                                                            @if($selectF == 'Y')
                                                                                                            @if(preg_match("/^select+[0-9]+Req+$/", $ggg->name))
                                                                                                                @if(explode('Req',$ggg->name)[0] == $value->name)
                                                                                                                    @if($ggg->value == 'on')
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$ggg->name}}" checked="">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @else
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$ggg->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endif
                                                                                                            @elseif($selectF == 'N' && $numberSel == $v)
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$ggg->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                        @foreach($form as $y => $yyy)
                                                                                                            @php
                                                                                                                if(preg_match("/^select+[0-9]+$/", $value->name)){

                                                                                                                $num = explode('select',$value->name)[1];
                                                                                                                $folw = $value->name.'follow3'.$num;

                                                                                                                    if(in_array($folw,$testArr)){
                                                                                                                        $selectF = 'Y';
                                                                                                                    }
                                                                                                                    else{
                                                                                                                        $selectF = 'N';
                                                                                                                        $numberSel = $y;
                                                                                                                    }
                                                                                                                }
                                                                                                            @endphp
                                                                                                            @if($selectF == 'Y')
                                                                                                                @if(preg_match("/^select+[0-9]+follow+[0-9]+$/", $yyy->name))
                                                                                                                    @if(explode('follow',$yyy->name)[0] == $value->name)
                                                                                                                        @if($yyy->value == 'on')
                                                                                                            <input class="followw" name="{{$yyy->name}}" id="{{explode('follow',$yyy->name)[1]}}" checked="" type="checkbox">
                                                                                                                        @else
                                                                                                            <input class="followw" name="{{$yyy->name}}" id="{{explode('follow',$yyy->name)[1]}}" type="checkbox">
                                                                                                                        @endif
                                                                                                            <label class="followanswer" for="{{explode('follow',$yyy->name)[1]}}">依答案至相關頁面</label>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @elseif($selectF == 'N' && $numberSel == $v)
                                                                                                            <input class="followw" name="{{$yyy->name}}follow3{{$num}}" id="follow3{{$num}}" type="checkbox">
                                                                                                            <label class="followanswer" for="follow3{{$num}}">
                                                                                                                依答案至相關頁面</label>
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @elseif(preg_match("/^qa+[0-9]+$/", $value->name))
                                                                                                    <div class="pd-l item">
                                                                                                        <p class="title-deco">
                                                                                                            <input class="form-control qa" type="text" name="{{$value->name}}" value="{{$value->value}}" placeholder="未命名的問題">
                                                                                                        </p>
                                                                                                        <input class="lock" type="text" value="簡答文字" disabled=""><div class="itemfoot">
                                                                                                            <button class="ml-s close" type="button">
                                                                                                                <i class="far fa-trash-alt">
                                                                                                                    
                                                                                                                </i>
                                                                                                            </button>
                                                                                                            @foreach($form as $i => $iii)
                                                                                                                @php
                                                                                                                if(preg_match("/^qa+[0-9]+$/", $value->name)){

                                                                                                                $folw = $value->name.'Req';

                                                                                                                    if(in_array($folw,$testArr)){
                                                                                                                        $radioF = 'Y';
                                                                                                                    }
                                                                                                                    else{
                                                                                                                        $radioF = 'N';
                                                                                                                        $number = $i;
                                                                                                                    }
                                                                                                                }
                                                                                                                @endphp
                                                                                                                @if($radioF == 'Y')
                                                                                                                @if(preg_match("/^qa+[0-9]+Req+$/", $iii->name))
                                                                                                                    @if(explode('Req',$iii->name)[0] == $value->name)
                                                                                                                    @if($iii->value == 'on')
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$iii->name}}" checked="">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @else
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$iii->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                                @endif
                                                                                                                @elseif($radioF == 'N' && $number == $v)
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$iii->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @elseif(preg_match("/^part+[0-9]+$/", $value->name))
                                                                                                    <div class="pd-l item">
                                                                                                        <p class="title-deco">
                                                                                                            <input class="form-control part" type="text" name="{{$value->name}}" value="{{$value->value}}" placeholder="未命名的問題">
                                                                                                        </p>
                                                                                                        <input class="lock" type="text" value="詳答文字" disabled=""><div class="itemfoot">
                                                                                                            <button class="ml-s close" type="button">
                                                                                                                <i class="far fa-trash-alt">
                                                                                                                    
                                                                                                                </i>
                                                                                                            </button>
                                                                                                            @foreach($form as $j => $jjj)
                                                                                                                @php
                                                                                                                if(preg_match("/^part+[0-9]+$/", $value->name)){

                                                                                                                $folw = $value->name.'Req';

                                                                                                                    if(in_array($folw,$testArr)){
                                                                                                                        $radioF = 'Y';
                                                                                                                    }
                                                                                                                    else{
                                                                                                                        $radioF = 'N';
                                                                                                                        $number = $j;
                                                                                                                    }
                                                                                                                }
                                                                                                                @endphp
                                                                                                                @if($radioF == 'Y')
                                                                                                                @if(preg_match("/^part+[0-9]+Req+$/", $jjj->name))
                                                                                                                @if(explode('Req',$jjj->name)[0] == $value->name)
                                                                                                                    @if($jjj->value == 'on')
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$jjj->name}}" checked="">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @else
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$jjj->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                                @endif
                                                                                                                @elseif($radioF == 'N' && $number == $v)
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$jjj->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @elseif(preg_match("/^date+[0-9]+$/", $value->name))
                                                                                                    <div class="pd-l item">
                                                                                                        <p class="title-deco">
                                                                                                            <input class="form-control date" type="text" name="{{$value->name}}" value="{{$value->value}}" placeholder="未命名的問題">
                                                                                                        </p>
                                                                                                        <input class="lock datime" type="text" value="年/月/日" disabled="">
                                                                                                        <span class="glyphicon glyphicon-calendar date-icon" aria-hidden="true"></span>
                                                                                                        <div class="itemfoot">
                                                                                                            <button class="ml-s close" type="button">
                                                                                                                <i class="far fa-trash-alt">
                                                                                                                    
                                                                                                                </i>
                                                                                                            </button>
                                                                                                            @foreach($form as $k => $kkk)
                                                                                                                @php
                                                                                                                if(preg_match("/^date+[0-9]+$/", $value->name)){

                                                                                                                $folw = $value->name.'Req';

                                                                                                                    if(in_array($folw,$testArr)){
                                                                                                                        $radioF = 'Y';
                                                                                                                    }
                                                                                                                    else{
                                                                                                                        $radioF = 'N';
                                                                                                                        $number = $k;
                                                                                                                    }
                                                                                                                }
                                                                                                                @endphp
                                                                                                                @if($radioF == 'Y')
                                                                                                                @if(preg_match("/^date+[0-9]+Req+$/", $kkk->name))
                                                                                                                    @if(explode('Req',$kkk->name)[0] == $value->name)
                                                                                                                    @if($kkk->value == 'on')
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$kkk->name}}" checked="">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @else
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$kkk->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                                @endif
                                                                                                                @elseif($radioF == 'N' && $number == $v)
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$kkk->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @elseif(preg_match("/^time+[0-9]+$/", $value->name))
                                                                                                    <div class="pd-l item">
                                                                                                        <p class="title-deco">
                                                                                                            <input class="form-control time" type="text" name="{{$value->name}}" value="{{$value->value}}" placeholder="未命名的問題">
                                                                                                        </p>
                                                                                                        <input class="lock datime" type="text" value="時：分" disabled="">
                                                                                                        <span class="glyphicon glyphicon-time time-icon" aria-hidden="true"></span>
                                                                                                        <div class="itemfoot">
                                                                                                            <button class="ml-s close" type="button">
                                                                                                                <i class="far fa-trash-alt">
                                                                                                                    
                                                                                                                </i>
                                                                                                            </button>
                                                                                                            @foreach($form as $l => $lll)
                                                                                                                @php
                                                                                                                if(preg_match("/^time+[0-9]+$/", $value->name)){

                                                                                                                $folw = $value->name.'Req';

                                                                                                                    if(in_array($folw,$testArr)){
                                                                                                                        $radioF = 'Y';
                                                                                                                    }
                                                                                                                    else{
                                                                                                                        $radioF = 'N';
                                                                                                                        $number = $l;
                                                                                                                    }
                                                                                                                }
                                                                                                                @endphp
                                                                                                                @if($radioF == 'Y')
                                                                                                                @if(preg_match("/^time+[0-9]+Req+$/", $lll->name))
                                                                                                                    @if(explode('Req',$lll->name)[0] == $value->name)
                                                                                                                    @if($lll->value == 'on')
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$lll->name}}" checked="">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @else
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$lll->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                                @endif
                                                                                                                @elseif($radioF == 'N' && $number == $v)
                                                                                                                    <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$lll->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @elseif(preg_match("/^thx+$/", $value->name))
                                                                                                    <textarea class="form-control" name="{{$value->name}}" placeholder="填寫歡迎詞" row="1">{{$value->value}}
                                                                                                    </textarea>
                                                                                                @endif
                                                                                           @endforeach
                                                                                        </div>
                                                                                    </form>   
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="tab-pane fade in" id="{{$data->name}}">
                                                                        <div class="panel panel-default panel-type page">
                                                                            <div class="panel-heading text-center font-l font-r">與我聯繫表單</div>
                                                                            <div class="panel-body font-sm pdx-0">
                                                                                <div class="last-page tab-content">
                                                                                    <form class="form-content-0 classForm" id="FormId{{$k}}" action="">
                                                                                        <div class="form-group mgy-sm pd-l">
                                                                                           @foreach($form as $v => $value)
                                                                                                @if(preg_match("/^title+[0-9]+$/", $value->name))
                                                                                                    <div class="tp-title pd-l">
                                                                                                        <button class="close" type="button"><i class="far fa-trash-alt"></i></button><input class="form-control title" name="{{$value->name}}" type="text" value="{{$value->value}}" placeholder="填寫標題">
                                                                                                    </div>
                                                                                                @elseif(preg_match("/^article+[0-9]+$/", $value->name))
                                                                                                    <div class="form-group mgy-sm pd-l">
                                                                                                        <button class="close" type="button"><i class="far fa-trash-alt"></i></button><input type="text" name="{{$value->name}}" class="form-control article" placeholder="輸入文字" value="{{$value->value}}">
                                                                                                    </div>
                                                                                                @elseif(preg_match("/^line+[0-9]+$/", $value->name))
                                                                                                    <div class="pd-l">
                                                                                                        <hr><input type="hidden" class="line" name="{{$value->name}}"><button class="close" type="button"><i class="far fa-trash-alt"></i></button>
                                                                                                    </div>
                                                                                                @elseif(preg_match("/^radio+[0-9]+$/", $value->name))
                                                                                                    @foreach($form as $fo => $follows)
                                                                                                        @php
                                                                                                            if(preg_match("/^radio+[0-9]+$/", $value->name)){

                                                                                                            $num = explode('radio',$value->name)[1];
                                                                                                            $folw = $value->name.'follow1'.$num;

                                                                                                                if(in_array($folw,$testArr)){
                                                                                                                    $radioF = 'Y';
                                                                                                                }
                                                                                                                else{
                                                                                                                    $radioF = 'N';
                                                                                                                    $number = $fo;
                                                                                                                }
                                                                                                            }
                                                                                                        @endphp

                                                                                                        @if($radioF == 'Y')
                                                                                                        @if(preg_match("/^radio+[0-9]+follow+[0-9]+$/", $follows->name))
                                                                                                            @if(explode('follow',$follows->name)[0] == $value->name)
                                                                                                                @if($follows->value == 'on')
                                                                                                    <div class="pd-l item link">
                                                                                                                @else
                                                                                                    <div class="pd-l item">
                                                                                                                @endif
                                                                                                            @endif
                                                                                                        @endif
                                                                                                        @elseif($radioF == 'N' && $number == $v)
                                                                                                    <div class="pd-l item">
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                        <p class="title-deco">
                                                                                                            <input class="form-control radio" name="{{$value->name}}" value="{{$value->value}}" type="text" placeholder="未命名的問題">
                                                                                                        </p>
                                                                                                        <div class="select-con">
                                                                                                        @foreach($form as $a => $aaa)

                                                                                                                @php
                                                                                                                    if(preg_match("/^radio+[0-9]+$/", $value->name)){

                                                                                                                    $folw = $value->name.'Href';

                                                                                                                        if(in_array($folw,$testArr)){
                                                                                                                            $radioF = 'Y';
                                                                                                                        }
                                                                                                                        else{
                                                                                                                            $radioF = 'N';
                                                                                                                            $number = $a;
                                                                                                                        }
                                                                                                                    }
                                                                                                                @endphp
                                                                                                                
                                                                                                            @if($radioF == 'Y')

                                                                                                                @if(preg_match("/^radio+[0-9]+Opt+$/", $aaa->name))
                                                                                                                @if(explode('Opt',$aaa->name)[0] == $value->name)
                                                                                                            <div class="mb-s">    
                                                                                                                    <button class="close" type="button">×</button>
                                                                                                                    <div class="out mr-s">

                                                                                                                    </div>
                                                                                                                    <input type="text" name="{{$aaa->name}}" value="{{$aaa->value}}" placeholder="填寫選項文字">
                                                                                                                    <select class="form-control" name="{{explode('Opt',$aaa->name)[0]}}Href">
                                                                                                                    @endif
                                                                                                                @elseif(preg_match("/^radio+[0-9]+Href+$/", $aaa->name))
                                                                                                                    @if(explode('Href',$aaa->name)[0] == $value->name)
                                                                                                                    <option value="">請選擇</option>
                                                                                                                        @foreach($contact as $r => $res)
                                                                                                                            @if($aaa->value == $res->name)
                                                                                                                    <option value="{{$res->name}}" selected="">{{$res->name}}</option>
                                                                                                                            @else
                                                                                                                    <option value="{{$res->name}}">{{$res->name}}</option>
                                                                                                                         @endif
                                                                                                                    @endforeach
                                                                                                                </select>
                                                                                                            </div>
                                                                                                                @endif
                                                                                                                @endif
                                                                                                            @elseif($radioF == 'N' && $number == $v)
                                                                                                                @foreach($form as $a => $aaa)
                                                                                                                    @if(preg_match("/^radio+[0-9]+Opt+$/", $aaa->name))
                                                                                                                        @if(explode('Opt',$aaa->name)[0] ==$value->name)
                                                                                                                <div class="mb-s">
                                                                                                                    <button class="close" type="button">×</button>
                                                                                                                    <div class="out mr-s">

                                                                                                                    </div>
                                                                                                                    <input type="text" name="{{$aaa->name}}" placeholder="填寫選項文字" value="{{$aaa->value}}">
                                                                                                                    <select class="form-control" name="{{explode('Opt',$aaa->name)[0]}}Href">
                                                                                                                        
                                                                                                                    </select>
                                                                                                                </div>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                        </div>
                                                                                                        <a href="javascript:void(0)" class="select-fun">
                                                                                                            <div class="out mr-s"></div>新增選項
                                                                                                        </a>
                                                                                                        <div class="itemfoot">
                                                                                                            <button class="ml-s close" type="button">
                                                                                                                <i class="far fa-trash-alt"></i>
                                                                                                            </button>
                                                                                                            @foreach($form as $c => $ccc)
                                                                                                                @php
                                                                                                                if(preg_match("/^radio+[0-9]+$/", $value->name)){

                                                                                                                $folw = $value->name.'Req';

                                                                                                                    if(in_array($folw,$testArr)){
                                                                                                                        $radioF = 'Y';
                                                                                                                    }
                                                                                                                    else{
                                                                                                                        $radioF = 'N';
                                                                                                                        $number = $c;
                                                                                                                    }
                                                                                                                }
                                                                                                                @endphp
                                                                                                                @if($radioF == 'Y')
                                                                                                                @if(preg_match("/^radio+[0-9]+Req+$/", $ccc->name))
                                                                                                                    @if(explode('Req',$ccc->name)[0] == $value->name)
                                                                                                                        @if($ccc->value == 'on')
                                                                                                                        <label class="switch">
                                                                                                                            <input type="checkbox" checked="" name="{{$ccc->name}}">
                                                                                                                            <span class="slider round"></span>
                                                                                                                        </label>
                                                                                                                        @else
                                                                                                                        <label class="switch">
                                                                                                                            <input type="checkbox" name="{{$ccc->name}}Req">
                                                                                                                            <span class="slider round"></span>
                                                                                                                        </label>
                                                                                                                        @endif
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                                @elseif($radioF == 'N' && $number == $v)
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$ccc->name}}Req">
                                                                                                                    <span class="slider round"></span>
                                                                                                                </label>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                            @foreach($form as $x => $xxx)
                                                                                                                @php
                                                                                                                if(preg_match("/^radio+[0-9]+$/", $value->name)){

                                                                                                                $num = explode('radio',$value->name)[1];
                                                                                                                $folw = $value->name.'follow1'.$num;

                                                                                                                    if(in_array($folw,$testArr)){
                                                                                                                        $radioF = 'Y';
                                                                                                                    }
                                                                                                                    else{
                                                                                                                        $radioF = 'N';
                                                                                                                        $number = $x;
                                                                                                                    }
                                                                                                                }
                                                                                                                @endphp
                                                                                                            @if($radioF == 'Y')
                                                                                                                @if(preg_match("/^radio+[0-9]+follow+[0-9]+$/", $xxx->name))
                                                                                                                    @if(explode('follow',$xxx->name)[0] == $value->name)
                                                                                                                        @if($xxx->value == 'on')
                                                                                                            <input class="followw" name="{{$xxx->name}}" id="{{explode('follow',$xxx->name)[1]}}" checked="" type="checkbox">
                                                                                                                        @else
                                                                                                            <input class="followw" name="{{$xxx->name}}" id="{{explode('follow',$xxx->name)[1]}}" type="checkbox">
                                                                                                                        @endif
                                                                                                            <label class="followanswer" for="{{explode('follow',$xxx->name)[1]}}">依答案至相關頁面</label>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @elseif($radioF == 'N' && $number == $v)
                                                                                                            <input class="followw" name="{{$xxx->name}}follow1{{$num}}" id="follow1{{$num}}" type="checkbox">
                                                                                                            <label class="followanswer" for="follow1{{$num}}">依答案至相關頁面</label>
                                                                                                            @endif
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @elseif(preg_match("/^multi+[0-9]+$/", $value->name))
                                                                                                    <div class="pd-l item">
                                                                                                        <p class="title-deco">
                                                                                                            <input class="form-control multi" type="text" name="{{$value->name}}" value="{{$value->value}}" placeholder="未命名的問題"></p>
                                                                                                            <div class="multi-con">
                                                                                                                @foreach($form as $d => $ddd)
                                                                                                                    @if(preg_match("/^multi+[0-9]+Opt+$/", $ddd->name))
                                                                                                                    @if(explode('Opt',$ddd->name)[0] == $value->name)
                                                                                                                <div class="mb-s">
                                                                                                                    <button class="close" type="button">×</button>
                                                                                                                    <div class="shape mr-s">
                                                                                                                        
                                                                                                                    </div>
                                                                                                                    <input type="text" name="{{$ddd->name}}" value="{{$ddd->value}}" placeholder="選項文字">
                                                                                                                    <select class="form-control">
                                                                                                                        
                                                                                                                    </select>
                                                                                                                </div>
                                                                                                                    @endif
                                                                                                                    @endif
                                                                                                                @endforeach
                                                                                                            </div>
                                                                                                            <a href="javascript:void(0)" class="multi-fun">
                                                                                                                <div class="shape mr-s">
                                                                                                                    
                                                                                                                </div>新增選項
                                                                                                            </a>
                                                                                                                <div class="itemfoot">
                                                                                                                    <button class="ml-s close" type="button">
                                                                                                                        <i class="far fa-trash-alt">
                                                                                                                            
                                                                                                                        </i>
                                                                                                                    </button>
                                                                                                                @foreach($form as $e => $eee)
                                                                                                                    @php
                                                                                                                        if(preg_match("/^multi+[0-9]+$/", $value->name)){

                                                                                                                        $folw = $value->name.'Req';

                                                                                                                            if(in_array($folw,$testArr)){
                                                                                                                                $radioF = 'Y';
                                                                                                                            }
                                                                                                                            else{
                                                                                                                                $radioF = 'N';
                                                                                                                                $number = $e;
                                                                                                                            }
                                                                                                                        }
                                                                                                                    @endphp
                                                                                                                @if($radioF == 'Y')
                                                                                                                    @if(preg_match("/^multi+[0-9]+Req+$/", $eee->name))
                                                                                                                    @if(explode('Req',$eee->name)[0] == $value->name)
                                                                                                                        @if($eee->value == 'on')
                                                                                                                    <label class="switch">
                                                                                                                        <input type="checkbox" name="{{$eee->name}}" checked="">
                                                                                                                        <span class="slider round"></span>
                                                                                                                    </label>
                                                                                                                        @else
                                                                                                                    <label class="switch">
                                                                                                                        <input type="checkbox" name="{{$eee->name}}Req">
                                                                                                                        <span class="slider round"></span>
                                                                                                                    </label>    
                                                                                                                        @endif
                                                                                                                    @endif
                                                                                                                    @endif
                                                                                                                @elseif($radioF == 'N' && $number == $v)
                                                                                                                    <label class="switch">
                                                                                                                        <input type="checkbox" name="{{$eee->name}}Req">
                                                                                                                        <span class="slider round"></span>
                                                                                                                    </label>
                                                                                                                @endif
                                                                                                                @endforeach
                                                                                                                </div>
                                                                                                        </div>
                                                                                                @elseif(preg_match("/^select+[0-9]+$/", $value->name))
                                                                                                    @foreach($form as $fol => $followS)
                                                                                                        @php
                                                                                                            if(preg_match("/^select+[0-9]+$/", $value->name)){

                                                                                                            $num = explode('select',$value->name)[1];
                                                                                                            $folw = $value->name.'follow3'.$num;

                                                                                                                if(in_array($folw,$testArr)){
                                                                                                                    $selectF = 'Y';
                                                                                                                }
                                                                                                                else{
                                                                                                                    $selectF = 'N';
                                                                                                                    $numberSel = $fol;
                                                                                                                }
                                                                                                            }
                                                                                                        @endphp
                                                                                                        @if($selectF == 'Y')
                                                                                                        @if(preg_match("/^select+[0-9]+follow+[0-9]+$/", $followS->name))
                                                                                                            @if(explode('follow',$followS->name)[0] == $value->name)
                                                                                                                @if($followS->value == 'on')
                                                                                                    <div class="pd-l item link">
                                                                                                                @else
                                                                                                    <div class="pd-l item">
                                                                                                                @endif
                                                                                                            @endif
                                                                                                        @endif
                                                                                                        @elseif($selectF == 'N' && $numberSel == $v)
                                                                                                    <div class="pd-l item">
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                        <p class="title-deco">
                                                                                                            <input class="form-control select" name="{{$value->name}}" value="{{$value->value}}" type="text" placeholder="未命名的問題">
                                                                                                        </p>
                                                                                                        <ol class="drop-con">
                                                                                                            @foreach($form as $f => $fff)
                                                                                                               @php
                                                                                                                    if(preg_match("/^select+[0-9]+$/", $value->name)){

                                                                                                                    $folw = $value->name.'Href';

                                                                                                                        if(in_array($folw,$testArr)){
                                                                                                                            $radioF = 'Y';
                                                                                                                        }
                                                                                                                        else{
                                                                                                                            $radioF = 'N';
                                                                                                                            $number = $f;
                                                                                                                        }
                                                                                                                    }
                                                                                                                @endphp
                                                                                                                
                                                                                                                @if($radioF == 'Y')
                                                                                                                    @if(preg_match("/^select+[0-9]+Opt+$/", $fff->name))
                                                                                                                        @if(explode('Opt',$fff->name)[0] == $value->name)
                                                                                                                <li class="mb-s">
                                                                                                                    <button class="close" type="button">×</button>
                                                                                                                    <input type="text" name="{{$fff->name}}" value="{{$fff->value}}" placeholder="選項文字">
                                                                                                                    <select class="form-control" name="{{explode('Opt',$fff->name)[0]}}Href">
                                                                                                                        @endif
                                                                                                                    @elseif(preg_match("/^select+[0-9]+Href+$/", $fff->name))
                                                                                                                    @if(explode('Href',$fff->name)[0] ==$value->name)
                                                                                                                            
                                                                                                                        <option value="">請選擇</option>
                                                                                                                            @foreach($contact as $rr => $rres)
                                                                                                                                @if($fff->value == $rres->name)
                                                                                                                                    <option value="{{$rres->name}}" selected="">{{$rres->name}}</option>
                                                                                                                                @else
                                                                                                                                    <option value="{{$rres->name}}">{{$rres->name}}</option>
                                                                                                                                @endif
                                                                                                                            @endforeach
                                                                                                                    
                                                                                                                    </select>
                                                                                                                </li>
                                                                                                                    @endif
                                                                                                                    @endif
                                                                                                                @elseif($radioF == 'N' && $number == $v)
                                                                                                                    @foreach($form as $f=> $fff)
                                                                                                                    @if(preg_match("/^select+[0-9]+Opt+$/", $fff->name))
                                                                                                                        @if(explode('Opt',$fff->name)[0] == $value->name)
                                                                                                                <li class="mb-s">
                                                                                                                    <button class="close" type="button">×</button>
                                                                                                                    <input type="text" name="{{$fff->name}}" value="{{$fff->value}}" placeholder="選項文字">
                                                                                                                    <select class="form-control" name="{{explode('Opt',$fff->name)[0]}}Href">
                                                                                                                        
                                                                                                                    </select>
                                                                                                                </li>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                            @endif
                                                                                                            @endforeach
                                                                                                            <li class="mb-s drop-fun-dot">
                                                                                                                <a href="javascript:void(0)" class="drop-fun">新增選項
                                                                                                                </a>
                                                                                                            </li>
                                                                                                        </ol>
                                                                                                        <div class="itemfoot">
                                                                                                            <button class="ml-s close" type="button">
                                                                                                                <i class="far fa-trash-alt">
                                                                                                                    
                                                                                                                </i>
                                                                                                            </button>
                                                                                                        @foreach($form as $g => $ggg)
                                                                                                                @php
                                                                                                                    if(preg_match("/^select+[0-9]+$/", $value->name)){

                                                                                                                    $folw = $value->name.'Req';

                                                                                                                        if(in_array($folw,$testArr)){
                                                                                                                            $selectF = 'Y';
                                                                                                                        }
                                                                                                                        else{
                                                                                                                            $selectF = 'N';
                                                                                                                            $numberSel = $g;
                                                                                                                        }
                                                                                                                    }
                                                                                                                @endphp
                                                                                                            @if($selectF == 'Y')
                                                                                                            @if(preg_match("/^select+[0-9]+Req+$/", $ggg->name))
                                                                                                                @if(explode('Req',$ggg->name)[0] == $value->name)
                                                                                                                    @if($ggg->value == 'on')
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$ggg->name}}" checked="">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @else
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$ggg->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endif
                                                                                                            @elseif($selectF == 'N' && $numberSel == $v)
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$ggg->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                        @foreach($form as $y => $yyy)
                                                                                                            @php
                                                                                                                if(preg_match("/^select+[0-9]+$/", $value->name)){

                                                                                                                $num = explode('select',$value->name)[1];
                                                                                                                $folw = $value->name.'follow3'.$num;

                                                                                                                    if(in_array($folw,$testArr)){
                                                                                                                        $selectF = 'Y';
                                                                                                                    }
                                                                                                                    else{
                                                                                                                        $selectF = 'N';
                                                                                                                        $numberSel = $y;
                                                                                                                    }
                                                                                                                }
                                                                                                            @endphp
                                                                                                            @if($selectF == 'Y')
                                                                                                                @if(preg_match("/^select+[0-9]+follow+[0-9]+$/", $yyy->name))
                                                                                                                    @if(explode('follow',$yyy->name)[0] == $value->name)
                                                                                                                        @if($yyy->value == 'on')
                                                                                                            <input class="followw" name="{{$yyy->name}}" id="{{explode('follow',$yyy->name)[1]}}" checked="" type="checkbox">
                                                                                                                        @else
                                                                                                            <input class="followw" name="{{$yyy->name}}" id="{{explode('follow',$yyy->name)[1]}}" type="checkbox">
                                                                                                                        @endif
                                                                                                            <label class="followanswer" for="{{explode('follow',$yyy->name)[1]}}">依答案至相關頁面</label>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @elseif($selectF == 'N' && $numberSel == $v)
                                                                                                            <input class="followw" name="{{$yyy->name}}follow3{{$num}}" id="follow3{{$num}}" type="checkbox">
                                                                                                            <label class="followanswer" for="follow3{{$num}}">
                                                                                                                依答案至相關頁面</label>
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @elseif(preg_match("/^qa+[0-9]+$/", $value->name))
                                                                                                    <div class="pd-l item">
                                                                                                        <p class="title-deco">
                                                                                                            <input class="form-control qa" type="text" name="{{$value->name}}" value="{{$value->value}}" placeholder="未命名的問題">
                                                                                                        </p>
                                                                                                        <input class="lock" type="text" value="簡答文字" disabled=""><div class="itemfoot">
                                                                                                            <button class="ml-s close" type="button">
                                                                                                                <i class="far fa-trash-alt">
                                                                                                                    
                                                                                                                </i>
                                                                                                            </button>
                                                                                                            @foreach($form as $i => $iii)
                                                                                                                @php
                                                                                                                if(preg_match("/^qa+[0-9]+$/", $value->name)){

                                                                                                                $folw = $value->name.'Req';

                                                                                                                    if(in_array($folw,$testArr)){
                                                                                                                        $radioF = 'Y';
                                                                                                                    }
                                                                                                                    else{
                                                                                                                        $radioF = 'N';
                                                                                                                        $number = $i;
                                                                                                                    }
                                                                                                                }
                                                                                                                @endphp
                                                                                                                @if($radioF == 'Y')
                                                                                                                @if(preg_match("/^qa+[0-9]+Req+$/", $iii->name))
                                                                                                                    @if(explode('Req',$iii->name)[0] == $value->name)
                                                                                                                    @if($iii->value == 'on')
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$iii->name}}" checked="">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @else
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$iii->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                                @endif
                                                                                                                @elseif($radioF == 'N' && $number == $v)
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$iii->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @elseif(preg_match("/^part+[0-9]+$/", $value->name))
                                                                                                    <div class="pd-l item">
                                                                                                        <p class="title-deco">
                                                                                                            <input class="form-control part" type="text" name="{{$value->name}}" value="{{$value->value}}" placeholder="未命名的問題">
                                                                                                        </p>
                                                                                                        <input class="lock" type="text" value="詳答文字" disabled=""><div class="itemfoot">
                                                                                                            <button class="ml-s close" type="button">
                                                                                                                <i class="far fa-trash-alt">
                                                                                                                    
                                                                                                                </i>
                                                                                                            </button>
                                                                                                            @foreach($form as $j => $jjj)
                                                                                                                @php
                                                                                                                if(preg_match("/^part+[0-9]+$/", $value->name)){

                                                                                                                $folw = $value->name.'Req';

                                                                                                                    if(in_array($folw,$testArr)){
                                                                                                                        $radioF = 'Y';
                                                                                                                    }
                                                                                                                    else{
                                                                                                                        $radioF = 'N';
                                                                                                                        $number = $j;
                                                                                                                    }
                                                                                                                }
                                                                                                                @endphp
                                                                                                                @if($radioF == 'Y')
                                                                                                                @if(preg_match("/^part+[0-9]+Req+$/", $jjj->name))
                                                                                                                @if(explode('Req',$jjj->name)[0] == $value->name)
                                                                                                                    @if($jjj->value == 'on')
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$jjj->name}}" checked="">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @else
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$jjj->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                                @endif
                                                                                                                @elseif($radioF == 'N' && $number == $v)
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$jjj->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @elseif(preg_match("/^date+[0-9]+$/", $value->name))
                                                                                                    <div class="pd-l item">
                                                                                                        <p class="title-deco">
                                                                                                            <input class="form-control date" type="text" name="{{$value->name}}" value="{{$value->value}}" placeholder="未命名的問題">
                                                                                                        </p>
                                                                                                        <input class="lock datime" type="text" value="年/月/日" disabled="">
                                                                                                        <span class="glyphicon glyphicon-calendar date-icon" aria-hidden="true"></span>
                                                                                                        <div class="itemfoot">
                                                                                                            <button class="ml-s close" type="button">
                                                                                                                <i class="far fa-trash-alt">
                                                                                                                    
                                                                                                                </i>
                                                                                                            </button>
                                                                                                            @foreach($form as $k => $kkk)
                                                                                                                @php
                                                                                                                if(preg_match("/^date+[0-9]+$/", $value->name)){

                                                                                                                $folw = $value->name.'Req';

                                                                                                                    if(in_array($folw,$testArr)){
                                                                                                                        $radioF = 'Y';
                                                                                                                    }
                                                                                                                    else{
                                                                                                                        $radioF = 'N';
                                                                                                                        $number = $k;
                                                                                                                    }
                                                                                                                }
                                                                                                                @endphp
                                                                                                                @if($radioF == 'Y')
                                                                                                                @if(preg_match("/^date+[0-9]+Req+$/", $kkk->name))
                                                                                                                    @if(explode('Req',$kkk->name)[0] == $value->name)
                                                                                                                    @if($kkk->value == 'on')
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$kkk->name}}" checked="">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @else
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$kkk->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                                @endif
                                                                                                                @elseif($radioF == 'N' && $number == $v)
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$kkk->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @elseif(preg_match("/^time+[0-9]+$/", $value->name))
                                                                                                    <div class="pd-l item">
                                                                                                        <p class="title-deco">
                                                                                                            <input class="form-control time" type="text" name="{{$value->name}}" value="{{$value->value}}" placeholder="未命名的問題">
                                                                                                        </p>
                                                                                                        <input class="lock datime" type="text" value="時：分" disabled="">
                                                                                                        <span class="glyphicon glyphicon-time time-icon" aria-hidden="true"></span>
                                                                                                        <div class="itemfoot">
                                                                                                            <button class="ml-s close" type="button">
                                                                                                                <i class="far fa-trash-alt">
                                                                                                                    
                                                                                                                </i>
                                                                                                            </button>
                                                                                                            @foreach($form as $l => $lll)
                                                                                                                @php
                                                                                                                if(preg_match("/^time+[0-9]+$/", $value->name)){

                                                                                                                $folw = $value->name.'Req';

                                                                                                                    if(in_array($folw,$testArr)){
                                                                                                                        $radioF = 'Y';
                                                                                                                    }
                                                                                                                    else{
                                                                                                                        $radioF = 'N';
                                                                                                                        $number = $l;
                                                                                                                    }
                                                                                                                }
                                                                                                                @endphp
                                                                                                                @if($radioF == 'Y')
                                                                                                                @if(preg_match("/^time+[0-9]+Req+$/", $lll->name))
                                                                                                                    @if(explode('Req',$lll->name)[0] == $value->name)
                                                                                                                    @if($lll->value == 'on')
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$lll->name}}" checked="">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @else
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$lll->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                                @endif
                                                                                                                @elseif($radioF == 'N' && $number == $v)
                                                                                                                    <label class="switch">
                                                                                                                    <input type="checkbox" name="{{$lll->name}}Req">
                                                                                                                    <span class="slider round">
                                                                                                                        
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                           @endforeach
                                                                                        </div>
                                                                                    </form>   
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                        <div class="tab-pane fade in active" id="thankyou3">
                                                            <div class="panel panel-default panel-type page">
                                                                <div class="panel-heading text-center font-l font-r">與我聯繫表單</div>
                                                                <div class="panel-body font-sm pdx-0">
                                                                    <div class="last-page tab-content">
                                                                        <form class="form-content-0 classForm" id="FormId999" action="">
                                                                            <div class="form-group mgy-sm pd-l">
                                                                                <textarea class="form-control" name="thx" placeholder="填寫歡迎詞" row="1">感謝您耐心填寫表單，我們將會盡速聯繫您！</textarea>
                                                                            </div>
                                                                        </form>   
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
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
@if($contact->isNotEmpty())
<script src="{{ asset('js/formset.js') }}"></script>
@else
<script src="{{ asset('js/formset2.js') }}"></script>
@endif
<!-- <script src="{{ asset('js/formset2.js') }}"></script> -->
<!-- ▲本頁引用▲ -->
<script type="text/javascript">

    @if($contact->isNotEmpty())
        var k = '{{$count}}';
        var c = '{{$count}}';

        if(c == 0){
            var d = 0
        }
        else{
           var d = c-1
        }

        $('body').on('click', '.add-section3', function(){
            k++
            c++
            $(this).parent().children('.sec0'+d+'').before('<div class="sec-3-'+ k +' section mr-s"><label for="sec-3-'+ k +'"><i class="fas fa-check-circle fa-fw"></i><a data-toggle="tab" href="#p-3-'+ k +'"><input class="form-control formName" type="text" placeholder="未命名"></a><input type="checkbox" id="sec-3-'+ k +'" class="form-sec-btn"></label><button class="close"type="button">&times;</button></div>');
            $(this).parent().parent().children('#感謝頁').before('<div class="tab-pane fade" id="p-3-'+ k +'"><div class="panel panel-default panel-type page"><div class="panel-heading text-center font-l font-r">與我聯繫表單</div><div class="panel-body font-sm pdx-0"><div class="last-page tab-content"><form class="form-content-0 classForm" id="FormId'+c+'"></form></div></div></div></div>');
            $(".add-section3").parent().find('.thx').siblings(".section:last").click();
        });

    @else
        var k = 1
        var c = 1 
        $('body').on('click', '.add-section3', function(){
            k++
            c++
            $(this).parent().children('.sec03').before('<div class="sec-3-'+ k +' section mr-s"><label for="sec-3-'+ k +'"><i class="fas fa-check-circle fa-fw"></i><a data-toggle="tab" href="#p-3-'+ k +'"><input class="form-control formName" type="text" placeholder="未命名"></a><input type="checkbox" id="sec-3-'+ k +'" class="form-sec-btn"></label><button class="close"type="button">&times;</button></div>');
            $(this).parent().parent().children('#thankyou3').before('<div class="tab-pane fade" id="p-3-'+ k +'"><div class="panel panel-default panel-type page"><div class="panel-heading text-center font-l font-r">與我聯繫表單</div><div class="panel-body font-sm pdx-0"><div class="last-page tab-content"><form class="form-content-0 classForm" id="FormId'+c+'"></form></div></div></div></div>');
            $(".add-section3").parent().find('.thx').siblings(".section:last").click();
        });
    @endif

</script>
<script type="text/javascript">
    $('#save').on('click',function(){

        var obj = document.getElementsByClassName("formName");
        var obj2 = document.getElementsByClassName("classForm");

        var DataArray = new Array(); 
        var FormName = new Array();

        for (var i = 0; i <obj2.length; i++) {

            var name = obj[i].value
            var formId = obj2[i].id
            var formdata = $('#'+formId+'').serializeArray()

            console.log(formId)

            DataArray.push(formdata)
            FormName.push(name)
        }

        console.log(DataArray)
        console.log(FormName)

        if(FormName.indexOf("") == -1){
            $.ajax({
                method:'post',
                url:'{{ route('ht.Form.contact.store',['organization'=>$organization]) }}',
                data:{
                    '_token':'{{csrf_token()}}',
                    'name':FormName,
                    'form':DataArray,
                },
                dataType:'json',
                success:function(res){
                    if(res.success == 'ok'){
                        window.location = '{{ route('ht.Form.contact.index',['organization'=>$organization]) }}';
                        alert('新增成功')
                    }
                },
            })
        }
        else{
            alert('表單名稱不能為空')
        }
    })
</script>
@endsection