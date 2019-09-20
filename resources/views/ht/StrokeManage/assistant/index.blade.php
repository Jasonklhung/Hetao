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
                                            <div class="tabbable">
                                                <!-- tab標籤 -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#viewers-tab-01">客戶線上預約</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#viewers-tab-02">派工單</a>
                                                    </li>
                                                </ul>
                                                <!-- tab標籤內容 -->
                                                <div class="tab-content">
                                                    <!-- 客戶線上預約 -->
                                                    <div class="tab-pane active" id="viewers-tab-01">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-a">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">姓名</th>
                                                                    <th class="desktop">聯絡電話</th>
                                                                    <th class="desktop">電子郵件</th>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th class="desktop">預約日期</th>
                                                                    <th class="desktop">狀態</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="watch" onclick="javascript:location.href='detail.html'">
                                                                    <td>多拉A夢</td>
                                                                    <td><a href="tel:0987654321">0987654321</a></td>
                                                                    <td><a href="mailto:abc@mail.com">abc@gmail.com</a></td>
                                                                    <td>維修飲用水設備</td>
                                                                    <td>2019-08-06 16:30</td>
                                                                    <td>
                                                                    </td>
                                                                </tr>
                                                                <tr class="watch">
                                                                    <td>多拉A夢</td>
                                                                    <td><a href="tel:0987654321">0987654321</a></td>
                                                                    <td><a href="mailto:abc@mail.com">abc@gmail.com</a></td>
                                                                    <td>維修飲用水設備</td>
                                                                    <td>2019-08-06 16:30</td>
                                                                    <td>
                                                                    </td>
                                                                </tr>
                                                                <tr class="watch">
                                                                    <td>多拉A夢</td>
                                                                    <td><a href="tel:0987654321">0987654321</a></td>
                                                                    <td><a href="mailto:abc@mail.com">abc@gmail.com</a></td>
                                                                    <td>維修飲用水設備</td>
                                                                    <td>2019-08-06 16:30</td>
                                                                    <td>
                                                                    </td>
                                                                </tr>
                                                                <tr class="watch">
                                                                    <td>多拉A夢</td>
                                                                    <td><a href="tel:0987654321">0987654321</a></td>
                                                                    <td><a href="mailto:abc@mail.com">abc@gmail.com</a></td>
                                                                    <td>維修飲用水設備</td>
                                                                    <td>2019-08-06 16:30</td>
                                                                    <td>
                                                                    </td>
                                                                </tr>
                                                                <tr class="watch">
                                                                    <td>多拉A夢</td>
                                                                    <td><a href="tel:0987654321">0987654321</a></td>
                                                                    <td><a href="mailto:abc@mail.com">abc@gmail.com</a></td>
                                                                    <td>維修飲用水設備</td>
                                                                    <td>2019-08-06 16:30</td>
                                                                    <td>
                                                                    </td>
                                                                </tr>
                                                                <tr class="watch">
                                                                    <td>多拉A夢</td>
                                                                    <td><a href="tel:0987654321">0987654321</a></td>
                                                                    <td><a href="mailto:abc@mail.com">abc@gmail.com</a></td>
                                                                    <td>維修飲用水設備</td>
                                                                    <td>2019-08-06 16:30</td>
                                                                    <td>
                                                                    </td>
                                                                </tr>
                                                                <tr class="watch">
                                                                    <td>多拉A夢</td>
                                                                    <td><a href="tel:0987654321">0987654321</a></td>
                                                                    <td><a href="mailto:abc@mail.com">abc@gmail.com</a></td>
                                                                    <td>維修飲用水設備</td>
                                                                    <td>2019-08-06 16:30</td>
                                                                    <td>
                                                                    </td>
                                                                </tr>
                                                                <tr class="watch">
                                                                    <td>多拉A夢</td>
                                                                    <td><a href="tel:0987654321">0987654321</a></td>
                                                                    <td><a href="mailto:abc@mail.com">abc@gmail.com</a></td>
                                                                    <td>維修飲用水設備</td>
                                                                    <td>2019-08-06 16:30</td>
                                                                    <td>
                                                                    </td>
                                                                </tr>
                                                                <tr class="past watch">
                                                                    <td>多拉A夢</td>
                                                                    <td><a href="tel:0987654321">0987654321</a></td>
                                                                    <td><a href="mailto:abc@mail.com">abc@gmail.com</a></td>
                                                                    <td>維修飲用水設備</td>
                                                                    <td>2019-08-06 16:30</td>
                                                                    <td>處理</td>
                                                                </tr>
                                                                <tr class="past watch">
                                                                    <td>多拉A夢</td>
                                                                    <td><a href="tel:0987654321">0987654321</a></td>
                                                                    <td><a href="mailto:abc@mail.com">abc@gmail.com</a></td>
                                                                    <td>維修飲用水設備</td>
                                                                    <td>2019-08-06 16:30</td>
                                                                    <td>棄單</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- 派工單 -->
                                                    <div class="tab-pane" id="viewers-tab-02">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-a-2">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">派工類型</th>
                                                                    <th class="desktop">客戶代碼</th>
                                                                    <th class="desktop">地址</th>
                                                                    <th class="desktop">電話</th>
                                                                    <th class="desktop">派工原因</th>
                                                                    <th class="desktop">承辦人員</th>
                                                                    <th class="desktop">工單編號</th>
                                                                    <th class="desktop">工單日期</th>
                                                                    <th class="desktop">負責主管</th>
                                                                    <th class="desktop"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>維修</td>
                                                                    <td>楊梅國中</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>邱小姐</td>
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        <select class="form-control" id="sel1">
                                                                            <option selected hidden disabled>待指派</option>
                                                                            <option>Ricky</option>
                                                                            <option>Eva</option>
                                                                            <option>Apple</option>
                                                                            <option>Banana</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <a target="_blank" href="editdispatch.html"><button type="button" class="btn btn-primary" style="margin-right: 28px;">處理</button></a>
                                                                        <input id="chk" class="chkall hide" type="checkbox" value="" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>維修</td>
                                                                    <td>楊梅國中</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>邱小姐</td>
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        <select class="form-control" id="sel1">
                                                                            <option selected hidden disabled>待指派</option>
                                                                            <option>Ricky</option>
                                                                            <option>Eva</option>
                                                                            <option>Apple</option>
                                                                            <option>Banana</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <a target="_blank" href=""><button type="button" class="btn btn-primary" style="margin-right: 28px;">處理</button></a>
                                                                        <input id="chk" class="chkall hide" type="checkbox" value="" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>維修</td>
                                                                    <td>楊梅國中</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>邱小姐</td>
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        <select class="form-control" id="sel1">
                                                                            <option selected hidden disabled>待指派</option>
                                                                            <option>Ricky</option>
                                                                            <option>Eva</option>
                                                                            <option>Apple</option>
                                                                            <option>Banana</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <a target="_blank" href=""><button type="button" class="btn btn-primary" style="margin-right: 28px;">處理</button></a>
                                                                        <input id="chk" class="chkall hide" type="checkbox" value="" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>維修</td>
                                                                    <td>楊梅國中</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>邱小姐</td>
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        <select class="form-control" id="sel1">
                                                                            <option selected hidden disabled>待指派</option>
                                                                            <option>Ricky</option>
                                                                            <option>Eva</option>
                                                                            <option>Apple</option>
                                                                            <option>Banana</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <a target="_blank" href=""><button type="button" class="btn btn-primary" style="margin-right: 28px;">處理</button></a>
                                                                        <input id="chk" class="chkall hide" type="checkbox" value="" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>維修</td>
                                                                    <td>楊梅國中</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>邱小姐</td>
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        <select class="form-control" id="sel1">
                                                                            <option selected hidden disabled>待指派</option>
                                                                            <option>Ricky</option>
                                                                            <option>Eva</option>
                                                                            <option>Apple</option>
                                                                            <option>Banana</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <a target="_blank" href=""><button type="button" class="btn btn-primary" style="margin-right: 28px;">處理</button></a>
                                                                        <input id="chk" class="chkall hide" type="checkbox" value="" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>維修</td>
                                                                    <td>楊梅國中</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>邱小姐</td>
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        <select class="form-control" id="sel1">
                                                                            <option selected hidden disabled>待指派</option>
                                                                            <option>Ricky</option>
                                                                            <option>Eva</option>
                                                                            <option>Apple</option>
                                                                            <option>Banana</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <a target="_blank" href=""><button type="button" class="btn btn-primary" style="margin-right: 28px;">處理</button></a>
                                                                        <input id="chk" class="chkall hide" type="checkbox" value="" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>維修</td>
                                                                    <td>楊梅國中</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>邱小姐</td>
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        <select class="form-control" id="sel1">
                                                                            <option selected hidden disabled>待指派</option>
                                                                            <option>Ricky</option>
                                                                            <option>Eva</option>
                                                                            <option>Apple</option>
                                                                            <option>Banana</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <a target="_blank" href=""><button type="button" class="btn btn-primary" style="margin-right: 28px;">處理</button></a>
                                                                        <input class="chkall hide" type="checkbox" value="" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>維修</td>
                                                                    <td>楊梅國中</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>邱小姐</td>
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        <select class="form-control" id="sel1">
                                                                            <option selected hidden disabled>待指派</option>
                                                                            <option>Ricky</option>
                                                                            <option>Eva</option>
                                                                            <option>Apple</option>
                                                                            <option>Banana</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <a target="_blank" href=""><button type="button" class="btn btn-primary" style="margin-right: 28px;">處理</button></a>
                                                                        <input id="chk" class="chkall hide" type="checkbox" value="" />
                                                                    </td>
                                                                </tr>
                                                                <tr class="past">
                                                                    <td>維修</td>
                                                                    <td>楊梅國中</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>邱小姐</td>
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        王大明
                                                                    </td>
                                                                    <td>
                                                                    </td>
                                                                </tr>
                                                                <tr class="past">
                                                                    <td>維修</td>
                                                                    <td>楊梅國中</td>
                                                                    <td><a href="https://goo.gl/maps/792UzW6hhFk46drx7" target="_blank">楊梅區秀才路919號</a></td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>載清缸 宿舍1.3樓+教學1樓右邊</td>
                                                                    <td>邱小姐</td>
                                                                    <td>00000000</td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        王大明
                                                                    </td>
                                                                    <td>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
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

@endsection