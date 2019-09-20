@extends('layout.app')

@section('content')
        <div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">權限管理 <span>Authority</span></h3>
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-user-tie"></i>權限管理列表
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">

                                                    <!-- 派工單 -->
                                                    <div class="tab-pane" id="viewers-tab-02">
                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-authority">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th>人員職稱</th>
                                                                    <th>人員名稱</th>
                                                                    <th>分公司</th>
                                                                    <th>電話</th>
                                                                    <th>最後登入時間</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>助理</td>
                                                                    <td>多拉A夢</td>
                                                                    <td>中壢</td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        <a href="edituser.html"><button type="button" class="btn btn-primary">編輯</button></a>
                                                                        <button type="button" class="btn btn-default">刪除</button>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>主管</td>
                                                                    <td>葉大雄</td>
                                                                    <td>台北</td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-primary">編輯</button>
                                                                        <button type="button" class="btn btn-default">刪除</button>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>助理</td>
                                                                    <td>靜香</td>
                                                                    <td>台北</td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-primary">編輯</button>
                                                                        <button type="button" class="btn btn-default">刪除</button>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>員工</td>
                                                                    <td>小夫</td>
                                                                    <td>高雄</td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-primary">編輯</button>
                                                                        <button type="button" class="btn btn-default">刪除</button>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>員工</td>
                                                                    <td>胖虎</td>
                                                                    <td>楊梅</td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-primary">編輯</button>
                                                                        <button type="button" class="btn btn-default">刪除</button>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>主管</td>
                                                                    <td>小丸子</td>
                                                                    <td>彰化</td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-primary">編輯</button>
                                                                        <button type="button" class="btn btn-default">刪除</button>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>員工</td>
                                                                    <td>世修</td>
                                                                    <td>台北</td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-primary">編輯</button>
                                                                        <button type="button" class="btn btn-default">刪除</button>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>員工</td>
                                                                    <td>永澤</td>
                                                                    <td>板橋</td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-primary">編輯</button>
                                                                        <button type="button" class="btn btn-default">刪除</button>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>員工</td>
                                                                    <td>小玉</td>
                                                                    <td>台北</td>
                                                                    <td><a href="tel:5551234567">03-3322101</a></td>
                                                                    <td>2019-08-06 10:30</td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-primary">編輯</button>
                                                                        <button type="button" class="btn btn-default">刪除</button>
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
@endsection

@section('scripts')

@endsection