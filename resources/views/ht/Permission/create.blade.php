@extends('layout.app')

@section('content')
        <div class="main dispatch-form">
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
                                            <i class="fas fa-user-tie"></i>人員權限管理
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <form>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">人員職稱</label>
                                                        <div class='form-group batch-select'><select class='form-control'>
                                                                <option selected>助理</option>
                                                                <option>主管</option>
                                                                <option>員工</option>
                                                            </select></div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">人員名稱</label>
                                                        <input type="text" class="form-control" placeholder="請填寫人員名稱">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">分公司</label>
                                                        <div class='form-group batch-select'><select class='form-control'>
                                                                <option selected disabled hidden>請選擇分公司</option>
                                                                <option>台北</option>
                                                                <option>新北</option>
                                                                <option>桃園</option>
                                                                <option>台中</option>
                                                                <option>台南</option>
                                                                <option>高雄</option>
                                                            </select></div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">預設權限</label>
                                                        <div class="form-control authority">
                                                            <ul>
                                                                <li>
                                                                    <span class="text-left">總覽</span>
                                                                    <label class="switch">
                                                                        <input type="checkbox" checked>
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left">行程管理</span>
                                                                    <ul class="text-left">
                                                                        <li class="si">助理<label class="switch">
                                                                                <input type="checkbox" checked>
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        <li class="si">主管<label class="switch">
                                                                                <input type="checkbox" checked>
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        <li class="si">員工<label class="switch">
                                                                                <input type="checkbox" checked>
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                    </ul>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left">表單設定</span>
                                                                    <label class="switch">
                                                                        <input type="checkbox" checked>
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left">推播時間設定</span>
                                                                    <label class="switch">
                                                                        <input type="checkbox" checked>
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left">權限管理</span>
                                                                    <label class="switch">
                                                                        <input type="checkbox" checked>
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <a href="authority.html"><button type="button" class="btn btn-default">返回</button></a>
                                                        <button type="button" class="btn btn-primary">儲存</button>
                                                    </div>
                                                </form>
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