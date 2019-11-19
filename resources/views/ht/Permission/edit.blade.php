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
                                                <form method="post" action="{{ route('ht.Permission.update',['organization'=>$organization]) }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$user->id}}">
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">人員職稱</label>
                                                        <div class='form-group batch-select'><select class='form-control' id="job" name="job">
                                                                <option value="" selected>請選擇職務</option>
                                                                <option value="助理">助理</option>
                                                                <option value="主管">主管</option>
                                                                <option value="員工">員工</option>
                                                            </select></div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">人員名稱</label>
                                                        <input type="text" class="form-control" placeholder="請填寫人員名稱" name="name" value="{{ $user->name }}">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">員工編號</label>
                                                        <input type="text" class="form-control" name="emp_id" value="{{ $user->emp_id }}" placeholder="請填寫員工編號" required="">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">員工手機號碼</label>
                                                        <input type="text" class="form-control" name="mobile" value="{{ $user->mobile }}" placeholder="請填寫員工手機號碼 ex:0912345678" required="">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">身分證字號</label>
                                                        <input type="text" class="form-control" name="ID_number" value="{{ $user->ID_number }}" placeholder="請填寫身分證字號" required="">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">分公司</label>
                                                        <div class='form-group batch-select'><select class='form-control' id="company" name="company">
                                                            <option value="" selected disabled="true">請選擇分公司</option>
                                                            @foreach($company as $company)
                                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                                            @endforeach
                                                            </select></div>
                                                    </div>
                                                    <!-- <div class="form-item">
                                                        <label class="d-block title-deco">人員部門</label>
                                                        <div class='form-group batch-select'><select class='form-control' name="dept" id="dept" required="">
                                                             <option value="" selected disabled="true">請選擇部門</option>
                                                             @foreach($dept as $dept)
                                                             <option value="{{$dept->id}}">{{$dept->name}}</option>
                                                             @endforeach
                                                            </select></div>
                                                    </div> -->
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">預設權限</label>
                                                        <div class="form-control authority">
                                                            <ul>
                                                                <li>
                                                                    <span class="text-left">總覽</span>
                                                                    @if($permission->overview == 'Y')
                                                                    <label class="switch">
                                                                        <input type="checkbox" checked>
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                    @else
                                                                    <label class="switch">
                                                                        <input type="checkbox">
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                    @endif
                                                                </li>
                                                                <li>
                                                                    <span class="text-left">行程管理</span>
                                                                    <ul class="text-left">

                                                                        @if($permission->assistant == 'Y')
                                                                        <li class="si">助理<label class="switch">
                                                                                <input type="checkbox" id="assistant" name="assistant" checked>
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        @else
                                                                        <li class="si">助理<label class="switch">
                                                                                <input type="checkbox" id="assistant" name="assistant">
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        @endif

                                                                        @if($permission->supervisor == 'Y')
                                                                        <li class="si">主管<label class="switch">
                                                                                <input type="checkbox" id="supervisor" name="supervisor" checked>
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        @else
                                                                        <li class="si">主管<label class="switch">
                                                                                <input type="checkbox" id="supervisor" name="supervisor">
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        @endif

                                                                        @if($permission->staff == 'Y')
                                                                        <li class="si">員工<label class="switch">
                                                                                <input type="checkbox" id="staff" name="staff" checked>
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        @else
                                                                        <li class="si">員工<label class="switch">
                                                                                <input type="checkbox" id="staff" name="staff">
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        @endif
                                                                    </ul>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left">表單設定</span>
                                                                    <ul class="text-left">

                                                                        @if($permission->reservation == 'Y')
                                                                        <li class="si">線上預約<label class="switch">
                                                                                <input type="checkbox" name="reservation" checked>
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        @else
                                                                        <li class="si">線上預約<label class="switch">
                                                                                <input type="checkbox" name="reservation">
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        @endif

                                                                        @if($permission->satisfaction == 'Y')
                                                                        <li class="si">滿意度調查<label class="switch">
                                                                                <input type="checkbox" name="satisfaction" checked>
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        @else
                                                                        <li class="si">滿意度調查<label class="switch">
                                                                                <input type="checkbox" name="satisfaction">
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        @endif

                                                                        @if($permission->contact == 'Y')
                                                                        <li class="si">與我聯繫<label class="switch">
                                                                                <input type="checkbox" name="contact" checked>
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        @else
                                                                        <li class="si">與我聯繫<label class="switch">
                                                                                <input type="checkbox" name="contact">
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        @endif
                                                                    </ul>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left">推播時間設定</span>

                                                                    @if($permission->timeset == 'Y')
                                                                    <label class="switch">
                                                                        <input type="checkbox" id="timeset" name="timeset" checked>
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                    @else
                                                                    <label class="switch">
                                                                        <input type="checkbox" id="timeset" name="timeset">
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                    @endif
                                                                </li>
                                                                <li>
                                                                    <span class="text-left">權限管理</span>

                                                                    @if($permission->permission == 'Y')
                                                                    <label class="switch">
                                                                        <input type="checkbox" id="permission" name="permission" checked="">
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                    @else
                                                                    <label class="switch">
                                                                        <input type="checkbox" id="permission" name="permission">
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                    @endif
                                                                </li>
                                                                <li>
                                                                    <span class="text-left">與我聯繫/滿意度表單</span>
                                                                    <ul class="text-left">

                                                                        @if($permission->contactUs == 'Y')
                                                                        <li class="si">與我聯繫<label class="switch">
                                                                                <input type="checkbox" name="contactUs" checked>
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        @else
                                                                        <li class="si">與我聯繫<label class="switch">
                                                                                <input type="checkbox" name="contactUs">
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        @endif

                                                                        @if($permission->satisfactionSurvey == 'Y')
                                                                        <li class="si">滿意度調查<label class="switch">
                                                                                <input type="checkbox" name="satisfactionSurvey" checked>
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        @else
                                                                        <li class="si">滿意度調查<label class="switch">
                                                                                <input type="checkbox" name="satisfactionSurvey">
                                                                                <span class="slider round"></span>
                                                                            </label></li>
                                                                        @endif
                                                                    </ul>
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

        $.ajax({
            method:'get',
            url:'{{ route('ht.Permission.getUserInfo',['organization'=>$organization]) }}',
            data:{ 'user_id':'{{$user->id}}' },
            dataType:'json',
            success:function(data){

                var job = $("#job").find("option");
                for (var j = 1; j < job.length; j++) {
                    if ($(job[j]).val() == data[0].job) {
                        $(job[j]).attr("selected", "selected");
                    }
                }

                var company = $("#company").find("option");
                for (var j = 1; j < company.length; j++) {
                    if ($(company[j]).val() == data[1].id) {
                        $(company[j]).attr("selected", "selected");
                    }
                }

                // var dept = $("#dept").find("option");
                // for (var j = 1; j < dept.length; j++) {
                //     if ($(dept[j]).val() == data[2].id) {
                //         $(dept[j]).attr("selected", "selected");
                //     }
                // }
            }
        })

</script>
@endsection