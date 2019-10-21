@extends('layout.app')

@section('content')
<div class="main">
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
                                            <i class="fas fa-tasks"></i>行程管理
                                        </div>
                                        <div class="panel-body">
                                            @if(!empty($action) && $action == 'report')
                                            <div class="tabbable">
                                                <!-- tab標籤 -->
                                                <ul class="nav nav-tabs">
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-01">待指派工單</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-02">已指派工單</a>
                                                    </li>
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-03">行程回報</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 待指派工單 -->
                                                    <div class="tab-pane" id="viewers-tab-01">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-su">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">地址</th>
                                                                    <th class="desktop">電話</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th class="desktop">負責人</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>楊梅國中</td>
                                                                    <td>邱小姐</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>維修</td>
                                                                    <td>
                                                                        <select class="form-control" style="margin-right:28px;">
                                                                            <option selected hidden disabled>待指派</option>
                                                                            <option>Karen</option>
                                                                            <option>Stacy</option>
                                                                            <option>Wang</option>
                                                                            <option>Belly</option>
                                                                        </select>
                                                                        <input class="chkall hide" type="checkbox" value="" />
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- 已指派工單 -->
                                                    <div class="tab-pane" id="viewers-tab-02">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-su-2">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">地址</th>
                                                                    <th class="desktop">電話</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th class="desktop">狀態</th>
                                                                    <th class="desktop">負責人</th>
                                                                    <th class="desktop"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>楊梅國中</td>
                                                                    <td>邱小姐</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>維修</td>
                                                                    <td><span class="ing">執行中</span></td>
                                                                    <td>Andy</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr class="past">
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>楊梅國中</td>
                                                                    <td>邱小姐</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>維修</td>
                                                                    <td><span>已完成</span></td>
                                                                    <td>Andy</td>
                                                                    <td></td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- 行程回報 -->
                                                    <div class="tab-pane active" id="viewers-tab-03">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-s-2">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">地址</th>
                                                                    <th class="desktop">電話</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th class="desktop">狀態</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>楊梅國中</td>
                                                                    <td>邱小姐</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>維修</td>
                                                                    <td>
                                                                        <button type="button" class="btn status">轉單</button>
                                                                        <button type="button" class="btn status">延後</button>
                                                                        <button type="button" class="btn status">已完成</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end -->
                                            </div>
                                            @else
                                            <div class="tabbable">
                                                <!-- tab標籤 -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-01">待指派工單</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-02">已指派工單</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-03">行程回報</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 待指派工單 -->
                                                    <div class="tab-pane active" id="viewers-tab-01">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-su">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">地址</th>
                                                                    <th class="desktop">電話</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th class="desktop">負責人</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>楊梅國中</td>
                                                                    <td>邱小姐</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>維修</td>
                                                                    <td>
                                                                        <select class="form-control" style="margin-right:28px;">
                                                                            <option selected hidden disabled>待指派</option>
                                                                            <option>Karen</option>
                                                                            <option>Stacy</option>
                                                                            <option>Wang</option>
                                                                            <option>Belly</option>
                                                                        </select>
                                                                        <input class="chkall hide" type="checkbox" value="" />
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- 已指派工單 -->
                                                    <div class="tab-pane" id="viewers-tab-02">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-su-2">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">地址</th>
                                                                    <th class="desktop">電話</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th class="desktop">狀態</th>
                                                                    <th class="desktop">負責人</th>
                                                                    <th class="desktop"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>楊梅國中</td>
                                                                    <td>邱小姐</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>維修</td>
                                                                    <td><span class="ing">執行中</span></td>
                                                                    <td>Andy</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr class="past">
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>楊梅國中</td>
                                                                    <td>邱小姐</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>維修</td>
                                                                    <td><span>已完成</span></td>
                                                                    <td>Andy</td>
                                                                    <td></td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
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