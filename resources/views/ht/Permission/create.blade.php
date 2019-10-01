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
                                                <form method="post" action="{{ route('ht.Permission.store',['organization'=>$organization]) }}">
                                                    @csrf
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">人員職稱</label>
                                                        <div class='form-group batch-select'><select class='form-control' name="job" id="job">
                                                                <option value="" selected>請選擇職務</option>
                                                                <option value="助理">助理</option>
                                                                <option value="主管">主管</option>
                                                                <option value="員工">員工</option>
                                                            </select></div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">人員名稱</label>
                                                        <input type="text" class="form-control" name="name" placeholder="請填寫人員名稱" required="">
                                                    </div>
                                                     <div class="form-item">
                                                        <label class="d-block title-deco">員工編號</label>
                                                        <input type="text" class="form-control" name="emp_id" placeholder="請填寫員工編號" required="">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">身分證字號</label>
                                                        <input type="text" class="form-control" name="ID_number" placeholder="請填寫身分證字號" required="">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">分公司</label>
                                                        <div class='form-group batch-select'><select class='form-control' required="">
                                                                <option selected disabled hidden>請選擇分公司</option>
                                                                @foreach($company as $company)
                                                                <option>{{$company->name}}</option>
                                                                @endforeach
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
                                                                                <input type="checkbox" id="assistant" name="jobCheck" checked>
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        <li class="si">主管<label class="switch">
                                                                                <input type="checkbox" id="supervisor" name="jobCheck" checked>
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        <li class="si">員工<label class="switch">
                                                                                <input type="checkbox" id="staff" name="jobCheck" checked>
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                    </ul>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left">表單設定</span>
                                                                    <ul class="text-left">
                                                                        <li class="si">線上預約<label class="switch">
                                                                                <input type="checkbox" name="formset" checked>
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        <li class="si">滿意度調查<label class="switch">
                                                                                <input type="checkbox" name="formset" checked>
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        <li class="si">與我聯繫<label class="switch">
                                                                                <input type="checkbox" name="formset" checked>
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                    </ul>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left">推播時間設定</span>
                                                                    <label class="switch">
                                                                        <input type="checkbox" id="timeset" name="timeset" checked>
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left">權限管理</span>
                                                                    <label class="switch">
                                                                        <input type="checkbox" id="permission" name="permission">
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('ht.Permission.index',['organization'=>$organization]) }}"><button type="button" class="btn btn-default">返回</button></a>
                                                        <button type="submit" class="btn btn-primary">儲存</button>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#job').on('change',function(){
            var value = $('#job').val();

            if(value == '助理'){
                document.all.jobCheck[0].checked = true;
                document.all.jobCheck[1].checked = false;
                document.all.jobCheck[2].checked = false;

                document.all.formset[0].checked = true;
                document.all.formset[1].checked = true;
                document.all.formset[2].checked = true;

                document.all.timeset.checked = true;
                document.all.permission.checked = false;
            }
            else if(value == '主管'){
                document.all.jobCheck[0].checked = false;
                document.all.jobCheck[1].checked = true;
                document.all.jobCheck[2].checked = false;

                document.all.formset[0].checked = false;
                document.all.formset[1].checked = false;
                document.all.formset[2].checked = false;

                document.all.timeset.checked = false;
                document.all.permission.checked = false;
            }
            else if(value == '員工'){
                document.all.jobCheck[0].checked = false;
                document.all.jobCheck[1].checked = false;
                document.all.jobCheck[2].checked = true;

                document.all.formset[0].checked = false;
                document.all.formset[1].checked = false;
                document.all.formset[2].checked = false;
                
                document.all.timeset.checked = false;
                document.all.permission.checked = false;
            }
        });
    });
</script>

@endsection