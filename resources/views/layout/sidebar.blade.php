<!-- 左邊選單pc -->
        <div class="sidebar pc" id="sidebar-nav">
            <div class="sidebar-scroll">
                <!-- 使用者 -->
                <div class="hetao-user" style="text-align: left; padding: 30px;">
                    <p class="title">賀桃後台系統</p>
                    @php
                        $res = explode(',',Auth::user()->organizations_name);
                        $rs = explode(',',Auth::user()->organizations);
                    @endphp
                    <select name="organizations" id="organizations">
                        @php
                            foreach($res as $key => $value){
                                foreach($rs as $k => $v){
                                   if($key == $k){
                                     if($organization->id == $v){
                        @endphp
                        <option value="{{$v}}" selected="">{{$value}}</option>
                        @php
                                        }
                                        else{
                        @endphp
                        <option value="{{$v}}">{{$value}}</option>
                        @php
                                        }
                                    }
                                }
                            }
                        @endphp
                    </select>
                    <p class="show-login-option">{{Auth::user()->name}}，您好 <a class="m-0 float-right" href="{{ route('ht.Auth.logout') }}">登出</a></p>
                </div>
                <nav>
                    <ul class="nav">
                    <!-------總覽------->
                        <li class="c-l">
                            <a class="collapsed" data-toggle="collapse" href="#sub-1"><i class="fas fa-calendar-alt fa-fw"></i> <span>總覽</span> <span class="float-right">+</span></a>
                            <div class="collapse" id="sub-1">
                                <ul class="nav">
                                @if(Auth::user()->permission->overview == 'Y')
                                    @if(url()->current() == route('ht.Overview.index',['organization'=>$organization]))
                                    <li class="select">
                                        <a href="{{ route('ht.Overview.index',['organization'=>$organization]) }}">行程總覽</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.Overview.index',['organization'=>$organization]) }}">行程總覽</a>
                                    </li>
                                    @endif
                                @endif

                                @if(Auth::user()->permission->notice == 'Y')
                                    @if(url()->current() == route('ht.Overview.notice.index',['organization'=>$organization]))
                                    <li class="select">
                                        <a href="{{ route('ht.Overview.notice.index',['organization'=>$organization]) }}">通知設定</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.Overview.notice.index',['organization'=>$organization]) }}">通知設定</a>
                                    </li>
                                    @endif
                                @endif
                                </ul>
                            </div>
                        </li>
                    <!-------總覽End------->

                    <!-------派工單------->
                    @if(Auth::user()->permission->assistant == 'N' && Auth::user()->permission->supervisor == 'N' && Auth::user()->permission->staff == 'N')

                    @else
                        <li class="c-l">
                            <a class="collapsed" data-toggle="collapse" href="#sub-2"><i class="far fa-list-alt fa-fw"></i> <span>派工單</span> <span class="float-right">+</span><span class="badge">{{$caseCount}}</span></a>
                            <div class="collapse" id="sub-2">
                                <ul class="nav">

                                 @if(Auth::user()->permission->assistant == 'Y')
                                    @if(url()->current() == route('ht.StrokeManage.assistant.index',['organization'=>$organization]))
                                    <li class="selected">
                                        <a href="{{ route('ht.StrokeManage.assistant.index',['organization'=>$organization]) }}">個人工單</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.StrokeManage.assistant.index',['organization'=>$organization]) }}">個人工單</a>
                                    </li>
                                    @endif
                                @endif

                                @if(Auth::user()->permission->supervisor == 'Y')
                                    @if(url()->current() == route('ht.StrokeManage.supervisor.index',['organization'=>$organization]))
                                    <li class="selected">
                                        <a href="{{ route('ht.StrokeManage.supervisor.index',['organization'=>$organization]) }}">全站工單</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.StrokeManage.supervisor.index',['organization'=>$organization]) }}">全站工單</a>
                                    </li>
                                    @endif
                                @endif

                                @if(Auth::user()->permission->staff == 'Y')
                                    @if(url()->current() == route('ht.StrokeManage.staff.index',['organization'=>$organization]))
                                    <li class="selected">
                                        <a href="{{ route('ht.StrokeManage.staff.index',['organization'=>$organization]) }}">工單進度</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.StrokeManage.staff.index',['organization'=>$organization]) }}">工單進度</a>
                                    </li>
                                    @endif
                                @endif
                                </ul>
                            </div>
                        </li>
                    @endif
                    <!-------派工單End------->

                    <!-------週期循環------->
                    @if(Auth::user()->permission->cycle_self == 'N' && Auth::user()->permission->cycle_all == 'N' && Auth::user()->permission->cycle_now == 'N')

                    @else
                        <li class="c-l">
                            <a class="collapsed" data-toggle="collapse" href="#sub-3"><i class="fas fa-sync-alt fa-fw"></i> <span>週期循環</span> <span class="float-right">+</span></a>
                            <div class="collapse" id="sub-3">
                                <ul class="nav">
                                @if(Auth::user()->permission->cycle_self == 'Y')
                                    @if(url()->current() == route('ht.Cycle.self.index',['organization'=>$organization]))
                                    <li class="select">
                                        <a href="{{ route('ht.Cycle.self.index',['organization'=>$organization]) }}">個人週期</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.Cycle.self.index',['organization'=>$organization]) }}">個人週期</a>
                                    </li>
                                    @endif
                                @endif

                                @if(Auth::user()->permission->cycle_all == 'Y')
                                    @if(url()->current() == route('ht.Cycle.all.index',['organization'=>$organization]))
                                    <li class="select">
                                        <a href="{{ route('ht.Cycle.all.index',['organization'=>$organization]) }}">全站週期</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.Cycle.all.index',['organization'=>$organization]) }}">全站週期</a>
                                    </li>
                                    @endif
                                @endif

                                @if(Auth::user()->permission->cycle_now == 'Y')
                                    @if(url()->current() == route('ht.Cycle.now.index',['organization'=>$organization]))
                                    <li class="select">
                                        <a href="{{ route('ht.Cycle.now.index',['organization'=>$organization]) }}">全站進度</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.Cycle.now.index',['organization'=>$organization]) }}">全站進度</a>
                                    </li>
                                    @endif
                                @endif
                                </ul>
                            </div>
                        </li>
                    @endif
                    <!-------週期循環End------->

                    <!-------領退料管理------->
                    @if(Auth::user()->permission->material == 'N' && Auth::user()->permission->material_case == 'N' && Auth::user()->permission->material_stock == 'N')

                    @else
                        <li class="c-l">
                            <a class="collapsed" data-toggle="collapse" href="#sub-4"><i class="fas fa-boxes fa-fw"></i> <span>領退料管理</span> <span class="float-right">+</span></a>
                            <div class="collapse" id="sub-4">
                                <ul class="nav">
                                @if(Auth::user()->permission->material == 'Y')
                                    @if(url()->current() == route('ht.Material.material.index',['organization'=>$organization]))
                                    <li class="select">
                                        <a href="{{ route('ht.Material.material.index',['organization'=>$organization]) }}">領料申請</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.Material.material.index',['organization'=>$organization]) }}">領料申請</a>
                                    </li>
                                    @endif
                                @endif

                                @if(Auth::user()->permission->material_case == 'Y')
                                    @if(url()->current() == route('ht.Material.case.index',['organization'=>$organization]))
                                    <li class="select">
                                        <a href="{{ route('ht.Material.case.index',['organization'=>$organization]) }}">料單管理</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.Material.case.index',['organization'=>$organization]) }}">料單管理</a>
                                    </li>
                                    @endif
                                @endif


                                @if(Auth::user()->permission->material_stock == 'Y')
                                    @if(url()->current() == route('ht.Material.stock.index',['organization'=>$organization]))
                                    <li class="select">
                                        <a href="{{ route('ht.Material.stock.index',['organization'=>$organization]) }}">庫存管理</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.Material.stock.index',['organization'=>$organization]) }}">庫存管理</a>
                                    </li>
                                    @endif
                                @endif

                                </ul>
                            </div>
                        </li>
                    @endif
                    <!-------領退料管理End------->

                    <!-------客戶資料查詢------->
                    @if(Auth::user()->permission->custom_info == 'N')

                    @else
                        @if(url()->current() == route('ht.Customer.index',['organization'=>$organization]))
                        <li class="select">
                            <a class="" href="{{ route('ht.Customer.index',['organization'=>$organization]) }}"><i class="fas fa-info-circle fa-fw"></i> <span>客戶資料查詢</span></a>
                        </li>
                        @else
                        <li>
                            <a class="" href="{{ route('ht.Customer.index',['organization'=>$organization]) }}"><i class="fas fa-info-circle fa-fw"></i> <span>客戶資料查詢</span></a>
                        </li>
                        @endif
                    @endif
                    <!-------客戶資料查詢End------->

                    <!-------業務管理------->
                    @if(Auth::user()->permission->business_self == 'N' && Auth::user()->permission->business_all == 'N')

                    @else
                        <li class="c-l">
                            <a class="collapsed" data-toggle="collapse" href="#sub-5"><i class="fas fa-briefcase fa-fw"></i> <span>業務管理</span> <span class="float-right">+</span></a>
                            <div class="collapse" id="sub-5">
                                <ul class="nav">
                                @if(Auth::user()->permission->business_self == 'Y')
                                    @if(url()->current() == route('ht.Business.self.index',['organization'=>$organization]))
                                    <li class="select">
                                        <a href="{{ route('ht.Business.self.index',['organization'=>$organization]) }}">個人業務</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.Business.self.index',['organization'=>$organization]) }}">個人業務</a>
                                    </li>
                                    @endif
                                @endif

                                @if(Auth::user()->permission->business_all == 'Y')
                                    @if(url()->current() == route('ht.Business.all.index',['organization'=>$organization]))
                                    <li class="select">
                                        <a href="{{ route('ht.Business.all.index',['organization'=>$organization]) }}">全站業務</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.Business.all.index',['organization'=>$organization]) }}">全站業務</a>
                                    </li>
                                    @endif
                                @endif
                                </ul>
                            </div>
                        </li>
                    @endif
                    <!-------業務管理End------->

                    <!-------業績查詢------->
                    @if(Auth::user()->permission->performance_self == 'N' && Auth::user()->permission->performance_all == 'N')

                    @else
                        <li class="c-l">
                            <a class="collapsed" data-toggle="collapse" href="#sub-6"><i class="far fa-chart-bar fa-fw"></i> <span>業績查詢</span> <span class="float-right">+</span></a>
                            <div class="collapse" id="sub-6">
                                <ul class="nav">
                                @if(Auth::user()->permission->performance_self == 'Y')
                                    @if(url()->current() == route('ht.Performance.self.index',['organization'=>$organization]))
                                    <li class="select">
                                        <a href="{{ route('ht.Performance.self.index',['organization'=>$organization]) }}">個人業績</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.Performance.self.index',['organization'=>$organization]) }}">個人業績</a>
                                    </li>
                                    @endif
                                @endif

                                @if(Auth::user()->permission->performance_all == 'Y')
                                    @if(url()->current() == route('ht.Performance.all.index',['organization'=>$organization]))
                                    <li class="select">
                                        <a href="{{ route('ht.Performance.all.index',['organization'=>$organization]) }}">全站業績</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.Performance.all.index',['organization'=>$organization]) }}">全站業績</a>
                                    </li>
                                    @endif
                                @endif
                                </ul>
                            </div>
                        </li>
                    @endif
                    <!-------業績查詢End------->

                    <!-------表單設定------->
                    @if(Auth::user()->permission->reservation == 'N' && Auth::user()->permission->satisfaction == 'N' && Auth::user()->permission->contact == 'N')

                    @else
                        <li class="c-l">
                            <a class="collapsed" data-toggle="collapse" href="#sub-7"><i class="far fa-file-alt fa-fw"></i> <span>表單設定</span> <span class="float-right">+</span></a>
                            <div class="collapse" id="sub-7">
                                <ul class="nav">

                                @if(Auth::user()->permission->reservation == 'Y')
                                    @if(url()->current() == route('ht.Form.reservation.index',['organization'=>$organization]))
                                    <li class="selected">
                                        <a href="{{ route('ht.Form.reservation.index',['organization'=>$organization]) }}">線上預約</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.Form.reservation.index',['organization'=>$organization]) }}">線上預約</a>
                                    </li>
                                    @endif
                                @endif

                                @if(Auth::user()->permission->satisfaction == 'Y')
                                    @if(url()->current() == route('ht.Form.satisfaction.index',['organization'=>$organization]))
                                    <li class="selected">
                                        <a href="{{ route('ht.Form.satisfaction.index',['organization'=>$organization]) }}">滿意度調查</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.Form.satisfaction.index',['organization'=>$organization]) }}">滿意度調查</a>
                                    </li>
                                    @endif
                                @endif

                                 @if(Auth::user()->permission->contact == 'Y')
                                    @if(url()->current() == route('ht.Form.contact.index',['organization'=>$organization]))
                                    <li class="selected">
                                        <a href="{{ route('ht.Form.contact.index',['organization'=>$organization]) }}">與我聯繫</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.Form.contact.index',['organization'=>$organization]) }}">與我聯繫</a>
                                    </li>
                                    @endif
                                @endif
                                </ul>
                            </div>
                        </li>
                    @endif
                    <!-------表單設定End------->

                    <!-------表單查看------->
                    @if(Auth::user()->permission->contactUs == 'N' && Auth::user()->permission->satisfactionSurvey == 'N')

                    @else
                        <li class="c-l">
                            <a class="collapsed" data-toggle="collapse" href="#sub-8"><i class="fas fa-search fa-fw"></i> <span>表單查看</span> <span class="float-right">+</span></a>
                            <div class="collapse" id="sub-8">
                                <ul class="nav">

                                @if(Auth::user()->permission->contactUs == 'Y')
                                    @if(url()->current() == route('ht.FormDetails.ContactUs.index',['organization'=>$organization]))
                                    <li class="selected">
                                        <a href="{{ route('ht.FormDetails.ContactUs.index',['organization'=>$organization]) }}">與我聯繫</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.FormDetails.ContactUs.index',['organization'=>$organization]) }}">與我聯繫</a>
                                    </li>
                                    @endif
                                @endif

                                @if(Auth::user()->permission->satisfactionSurvey == 'Y')
                                    @if(url()->current() == route('ht.FormDetails.satisfactionSurvey.index',['organization'=>$organization]))
                                    <li class="selected">
                                        <a href="{{ route('ht.FormDetails.satisfactionSurvey.index',['organization'=>$organization]) }}">滿意度調查</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.FormDetails.satisfactionSurvey.index',['organization'=>$organization]) }}">滿意度調查</a>
                                    </li>
                                    @endif
                                @endif
                                </ul>
                            </div>
                        </li>
                    @endif
                    <!-------表單查看End------->

                    <!-------推播時間設定------->
                    @if(Auth::user()->permission->timeset == 'Y')
                        @if(url()->current() == route('ht.Timeset.index',['organization'=>$organization]))
                        <li class="selected">
                            <a class="" href="{{ route('ht.Timeset.index',['organization'=>$organization]) }}"><i class="far fa-clock fa-fw"></i> <span>推播時間設定</span></a>
                        </li>
                        @else
                        <li>
                            <a class="" href="{{ route('ht.Timeset.index',['organization'=>$organization]) }}"><i class="far fa-clock fa-fw"></i> <span>推播時間設定</span></a>
                        </li>
                        @endif
                    @endif
                    <!-------推播時間設定End------->

                    <!-------權限管理------->
                    @if(Auth::user()->permission->permission == 'Y')
                        @if(url()->current() == route('ht.Permission.index',['organization'=>$organization]))
                        <li class="selected">
                            <a class="" href="{{ route('ht.Permission.index',['organization'=>$organization]) }}"><i class="fas fa-cog fa-fw"></i> <span>權限管理</span></a>
                        </li>
                        @else
                        <li>
                            <a class="" href="{{ route('ht.Permission.index',['organization'=>$organization]) }}"><i class="fas fa-cog fa-fw"></i> <span>權限管理</span></a>
                        </li>
                        @endif
                    @endif
                    <!-------權限管理End------->
                    </ul>
                </nav>
            </div>
        </div>
        <!-- 選單rwd -->
        <side-bar class="rwd">
            <div class="hetao-user">
                <p class="title">賀桃後台系統</p>
                @php
                        $res = explode(',',Auth::user()->organizations_name);
                        $rs = explode(',',Auth::user()->organizations);
                    @endphp
                    <select name="organizations" id="organizationsSide">
                        @php
                            foreach($res as $key => $value){
                                foreach($rs as $k => $v){
                                   if($key == $k){
                                     if($organization->id == $v){
                        @endphp
                        <option value="{{$v}}" selected="">{{$value}}</option>
                        @php
                                        }
                                        else{
                        @endphp
                        <option value="{{$v}}">{{$value}}</option>
                        @php
                                        }
                                    }
                                }
                            }
                        @endphp
                    </select>
                <p class="show-login-option">{{Auth::user()->name}}，您好</p>
            </div>
            <div>
                <sb-menu class="sb-menu">
                    <sb-menu-title class="sb-menu-title"><i class="fas fa-calendar-alt fa-fw"></i> <span> 總覽</span></sb-menu-title>
                    @if(Auth::user()->permission->overview == 'Y')
                    <sb-item class="sb-item" onclick="javascript:location.href='{{ route('ht.Overview.index',['organization'=>$organization]) }}'">行程總覽</sb-item>
                    @endif

                    @if(Auth::user()->permission->notice == 'Y')
                    <sb-item class="sb-item" onclick="javascript:location.href='{{ route('ht.Overview.notice.index',['organization'=>$organization]) }}'">通知設定</sb-item>
                    @endif
                </sb-menu>

                @if(Auth::user()->permission->assistant == 'N' && Auth::user()->permission->supervisor == 'N' && Auth::user()->permission->staff == 'N')

                @else
                <sb-menu2 class="sb-menu">
                    <sb-menu-title2 class="sb-menu-title"><i class="far fa-list-alt fa-fw"></i> <span> 派工單</span><span class="badge">{{$caseCount}}</span></sb-menu-title2>
                    @if(Auth::user()->permission->assistant == 'Y')
                    <sb-item2 class="sb-item" onclick="javascript:location.href='{{ route('ht.StrokeManage.assistant.index',['organization'=>$organization]) }}'">個人工單</sb-item2>
                    @endif
                    @if(Auth::user()->permission->supervisor == 'Y')
                    <sb-item2 class="sb-item" onclick="javascript:location.href='{{ route('ht.StrokeManage.supervisor.index',['organization'=>$organization]) }}'">全站工單</sb-item2>
                    @endif
                    @if(Auth::user()->permission->staff == 'Y')
                    <sb-item2 class="sb-item" onclick="javascript:location.href='{{ route('ht.StrokeManage.staff.index',['organization'=>$organization]) }}'">工單進度</sb-item2>
                    @endif
                </sb-menu2>
                @endif

                @if(Auth::user()->permission->cycle_self == 'N' && Auth::user()->permission->cycle_all == 'N' && Auth::user()->permission->cycle_now == 'N')

                @else
                <sb-menu3 class="sb-menu">
                    <sb-menu-title3 class="sb-menu-title"><i class="fas fa-sync-alt fa-fw"></i> <span>週期循環</span></sb-menu-title3>
                    @if(Auth::user()->permission->cycle_self == 'Y')
                    <sb-item3 class="sb-item" onclick="javascript:location.href='{{ route('ht.Cycle.self.index',['organization'=>$organization]) }}'">個人週期</sb-item3>
                    @endif
                    @if(Auth::user()->permission->cycle_all == 'Y')
                    <sb-item3 class="sb-item" onclick="javascript:location.href='{{ route('ht.Cycle.all.index',['organization'=>$organization]) }}'">全站週期</sb-item3>
                    @endif
                    @if(Auth::user()->permission->cycle_now == 'Y')
                    <sb-item3 class="sb-item" onclick="javascript:location.href='{{ route('ht.Cycle.now.index',['organization'=>$organization]) }}'">全站進度</sb-item3>
                    @endif
                </sb-menu3>
                @endif

                @if(Auth::user()->permission->material == 'N' && Auth::user()->permission->material_case == 'N' && Auth::user()->permission->material_stock == 'N')

                @else
                <sb-menu4 class="sb-menu">
                    <sb-menu-title4 class="sb-menu-title"><i class="fas fa-boxes fa-fw"></i> <span>領退料管理</span></sb-menu-title4>
                    @if(Auth::user()->permission->material == 'Y')
                    <sb-item4 class="sb-item" onclick="javascript:location.href='{{ route('ht.Material.material.index',['organization'=>$organization]) }}'">領料申請</sb-item4>
                    @endif
                    @if(Auth::user()->permission->material_case == 'Y')
                    <sb-item4 class="sb-item" onclick="javascript:location.href='{{ route('ht.Material.case.index',['organization'=>$organization]) }}'">料單管理</sb-item4>
                    @endif
                    @if(Auth::user()->permission->material_stock == 'Y')
                    <sb-item4 class="sb-item" onclick="javascript:location.href='{{ route('ht.Material.stock.index',['organization'=>$organization]) }}'">庫存管理</sb-item4>
                    @endif
                </sb-menu4>
                @endif


                @if(Auth::user()->permission->custom_info == 'N')
                <a class="" href="{{ route('ht.Customer.index',['organization'=>$organization]) }}">
                    <sb-item class="sb-item"><i class="fas fa-info-circle fa-fw"></i>客戶資料查詢</sb-item>
                </a>
                @endif

                @if(Auth::user()->permission->business_self == 'N' && Auth::user()->permission->business_all == 'N')

                @else
                <sb-menu5 class="sb-menu">
                    <sb-menu-title5 class="sb-menu-title"><i class="fas fa-briefcase fa-fw"></i> <span>業務管理</span></sb-menu-title5>
                    @if(Auth::user()->permission->business_self == 'Y')
                    <sb-item5 class="sb-item" onclick="javascript:location.href='{{ route('ht.Business.self.index',['organization'=>$organization]) }}'">個人業務</sb-item5>
                    @endif
                    @if(Auth::user()->permission->business_all == 'Y')
                    <sb-item5 class="sb-item" onclick="javascript:location.href='{{ route('ht.Business.all.index',['organization'=>$organization]) }}'">全站業務</sb-item5>
                    @endif
                </sb-menu5>
                @endif

                @if(Auth::user()->permission->performance_self == 'N' && Auth::user()->permission->performance_all == 'N')

                @else
                <sb-menu6 class="sb-menu">
                    <sb-menu-title6 class="sb-menu-title"><i class="far fa-chart-bar fa-fw"></i> <span>業績查詢</span></sb-menu-title6>
                    @if(Auth::user()->permission->performance_self == 'Y')
                    <sb-item6 class="sb-item" onclick="javascript:location.href='{{ route('ht.Performance.self.index',['organization'=>$organization]) }}'">個人業績</sb-item6>
                    @endif
                    @if(Auth::user()->permission->performance_all == 'Y')
                    <sb-item6 class="sb-item" onclick="javascript:location.href='{{ route('ht.Performance.all.index',['organization'=>$organization]) }}'">全站業績</sb-item6>
                    @endif
                </sb-menu6>
                @endif

                @if(Auth::user()->permission->reservation == 'N' && Auth::user()->permission->satisfaction == 'N' && Auth::user()->permission->contact == 'N')

                @else
                <sb-menu7 class="sb-menu">
                    <sb-menu-title7 class="sb-menu-title"><i class="far fa-file-alt fa-fw"></i> <span>表單設定</span></sb-menu-title7>
                    @if(Auth::user()->permission->reservation == 'Y')
                    <sb-item7 class="sb-item" onclick="javascript:location.href='{{ route('ht.Form.reservation.index',['organization'=>$organization]) }}'">線上預約</sb-item7>
                    @endif
                    @if(Auth::user()->permission->satisfaction == 'Y')
                    <sb-item7 class="sb-item" onclick="javascript:location.href='{{ route('ht.Form.satisfaction.index',['organization'=>$organization]) }}'">滿意度調查</sb-item7>
                    @endif
                    @if(Auth::user()->permission->contact == 'Y')
                    <sb-item7 class="sb-item" onclick="javascript:location.href='{{ route('ht.Form.contact.index',['organization'=>$organization]) }}'">與我聯繫</sb-item7>
                    @endif
                </sb-menu7>
                @endif

                @if(Auth::user()->permission->contactUs == 'N' && Auth::user()->permission->satisfactionSurvey == 'N')

                @else
                <sb-menu8 class="sb-menu">
                    <sb-menu-title8 class="sb-menu-title"><i class="fas fa-search fa-fw"></i> <span>表單查看</span></sb-menu-title8>
                    @if(Auth::user()->permission->contactUs == 'Y')
                    <sb-item8 class="sb-item" onclick="javascript:location.href='{{ route('ht.FormDetails.ContactUs.index',['organization'=>$organization]) }}'">與我聯繫</sb-item8>
                    @endif
                    @if(Auth::user()->permission->satisfactionSurvey == 'Y')
                    <sb-item8 class="sb-item" onclick="javascript:location.href='{{ route('ht.FormDetails.satisfactionSurvey.index',['organization'=>$organization]) }}'">滿意度調查</sb-item8>
                    @endif
                </sb-menu8>
                @endif

                @if(Auth::user()->permission->timeset == 'Y')
                <a class="" href="{{ route('ht.Timeset.index',['organization'=>$organization]) }}">
                    <sb-item class="sb-item"><i class="far fa-clock fa-fw"></i> 推播時間設定</sb-item>
                </a>
                @endif

                @if(Auth::user()->permission->permission == 'Y')
                <a class="" href="{{ route('ht.Permission.index',['organization'=>$organization]) }}">
                    <sb-item><i class="fas fa-angle-double-right fa-fw"></i> 權限管理</sb-item>
                </a>
                @endif
            </div>
        </side-bar>