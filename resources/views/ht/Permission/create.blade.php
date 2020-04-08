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
                                            <i class="fas fa-cog"></i>人員權限管理
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <form method="post" action="{{ route('ht.Permission.store',['organization'=>$organization]) }}" id="permissionForm">
                                                    @csrf
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">人員職稱</label>
                                                        <div class='form-group batch-select'><select class='form-control' name="job" id="job" required="">
                                                                <option value="" selected disabled="">請選擇職務</option>
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
                                                        <label class="d-block title-deco">員工手機號碼</label>
                                                        <input type="text" class="form-control" name="mobile" placeholder="請填寫員工手機號碼 ex:0912345678" required="">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">身分證字號</label>
                                                        <input type="text" class="form-control" name="ID_number" placeholder="請填寫身分證字號" required="">
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">分公司</label>
                                                        <div class="">
                                                            <table>
                                                                @foreach($company_res as $key => $value)
                                                                <tr class="bd-bottom">
                                                                    <td class="py-s"><span class="mr-s text-nowrap">{{ $key }}：</span></td>
                                                                    <td>
                                                                        @foreach($value as $k => $v)
                                                                        <label class="mr-s" for="newtaipei1"><input type="checkbox" class="companyInput" name="company[]" value="{{$v['id']}}"> {{$v['name']}}</label>
                                                                        @endforeach
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="form-item">
                                                        <label class="d-block title-deco">預設權限</label>
                                                        <div class="form-control authority">
                                                            <ul>
                                                                <li>
                                                                    <span class="text-left"><i class="w-20px fas fa-calendar-alt"></i> 總覽</span>
                                                                    <ul class="text-left pl-m">
                                                                        <li class="si">行程總覽
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="overview" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                        <li class="si">通知設定
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="notice" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left"><i class="w-20px far fa-list-alt"></i> 派工單</span>
                                                                    <ul class="text-left pl-m">
                                                                        <li class="si">個人工單
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="assistant" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                        <li class="si">全站工單
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="supervisor" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                        <li class="si">工單進度
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="staff" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left"><i class="w-20px fas fa-sync-alt"></i> 週期循環</span>
                                                                    <ul class="text-left pl-m">
                                                                        <li class="si">個人週期
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="cycle_self" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                        <li class="si">全站週期
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="cycle_all" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                        <li class="si">全站進度
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="cycle_now" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left"><i class="w-20px fas fa-boxes"></i> 領退料管理</span>
                                                                    <ul class="text-left pl-m">
                                                                        <li class="si">領料申請
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="material" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                        <li class="si">料單管理
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="material_case" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                        <li class="si">庫存管理
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="material_stock" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left"><i class="w-20px fas fa-info-circle"></i> 客戶資料查詢</span>
                                                                    <label class="switch">
                                                                        <input type="checkbox" name="custom_info" checked>
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left"><i class="w-20px fas fa-briefcase"></i> 業務管理</span>
                                                                    <ul class="text-left pl-m">
                                                                        <li class="si">個人業務
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="business_self" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                        <li class="si">全站業務
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="business_all" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left"><i class="w-20px far fa-chart-bar"></i> 業績查詢</span>
                                                                    <ul class="text-left pl-m">
                                                                        <li class="si">個人業績
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="performance_self" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                        <li class="si">全站業績
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="performance_all" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left"><i class="w-20px far fa-file-alt"></i> 表單設定</span>
                                                                    <ul class="text-left pl-m">
                                                                        <li class="si">線上預約
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="reservation" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                        <li class="si">滿意度調查
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="satisfaction" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                        <li class="si">與我聯繫
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="contact" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left"><i class="w-20px fas fa-search"></i> 表單查看</span>
                                                                    <ul class="text-left pl-m">
                                                                        <li class="si">與我聯繫
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="contactUs" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                        <li class="si">滿意度調查
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="satisfactionSurvey" checked>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left"><i class="w-20px far fa-clock"></i> 推播時間設定</span>
                                                                    <label class="switch">
                                                                        <input type="checkbox" name="timeset" checked>
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </li>
                                                                <li>
                                                                    <span class="text-left"><i class="w-20px fas fa-cog"></i> 權限管理</span>
                                                                    <label class="switch">
                                                                        <input type="checkbox" name="permission" checked>
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

        $('#permissionForm').on('submit',function(){
           var res = $('.companyInput:checkbox:checked').length
           
            if(res == 0){

                alert("請填選分公司")
                
                $('.companyInput').focus()

                return false
            }

        })


        $('#job').on('change',function(){
            var value = $('#job').val();

            if(value == '助理'){
                document.all.assistant.checked = true;
                document.all.supervisor.checked = true;
                document.all.staff.checked = true;

                document.all.reservation.checked = true;
                document.all.satisfaction.checked = true;
                document.all.contact.checked = true;

                document.all.timeset.checked = true;
                document.all.permission.checked = false;
            }
            else if(value == '主管'){
                document.all.assistant.checked = true;
                document.all.supervisor.checked = true;
                document.all.staff.checked = true;

                document.all.reservation.checked = false;
                document.all.satisfaction.checked = false;
                document.all.contact.checked = false;

                document.all.timeset.checked = false;
                document.all.permission.checked = false;
            }
            else if(value == '員工'){
                document.all.assistant.checked = true;
                document.all.supervisor.checked = false;
                document.all.staff.checked = true;

                document.all.reservation.checked = false;
                document.all.satisfaction.checked = false;
                document.all.contact.checked = false;

                document.all.timeset.checked = false;
                document.all.permission.checked = false;
            }
        });
    });
</script>

@endsection