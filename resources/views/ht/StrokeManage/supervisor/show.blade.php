@extends('layout.app')

@section('content')
        <div class="main dispatch-form">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">行程管理 <span>Management</span></h3>
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-tasks"></i>檢視滿意度調查
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <div class="field">
                                                    <small class="mb-xs d-block">工單編號：190806001</small>
                                                    <small class="mb-xs d-block">客戶代碼：楊梅國中</small>
                                                </div>
                                                <div class="field">
                                                    <h4 class="title-deco">滿意度調查表</h4>
                                                    <h5>派工人員服務相關</h5>
                                                    <ul>
                                                        <li><p>服務態度：非常滿意</p></li>
                                                        <li><p>技術專業：非常滿意</p></li>
                                                        <li>
                                                            <p>時間掌控：非常滿意</p>
                                                        </li>
                                                        <li>
                                                            <p>服務態度：非常滿意</p>
                                                        </li>
                                                        <li>
                                                            <p>技術專業：非常滿意</p>
                                                        </li>
                                                        <li>
                                                            <p>時間掌控：非常滿意</p>
                                                        </li>
                                                    </ul>
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

@endsection