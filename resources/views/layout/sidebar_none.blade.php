<!-- 左邊選單pc -->
<!--         <div class="sidebar pc" id="sidebar-nav">
    <div class="sidebar-scroll"> -->
        <!-- 使用者 -->
                <!-- div class="hetao-user" style="text-align: left; padding: 30px;">
                    <p class="title">賀桃後台系統</p>
                    <select name="" id="">
                        <option value="">竹北H000</option>
                        <option value="">竹南H000</option>
                        <option value="">竹東H000</option>
                    </select>
                    <p class="show-login-option">曾曾，您好</p>
                    <a href="">登出</a><span> | </span> <a href="">下載教育手冊</a>
                </div> -->
                <!-- <nav class="navbar navbar-default">
                    <div class="hetao-logo">
                        <a href="{{ route('ht.Overview.index',['organization'=>$organization]) }}">{{Auth::user()->organization['company_name']}}</a>
                    </div>
                </nav> -->
                <!-- 使用者 -->
                <!-- <div class="hetao-user">
                    <p class="show-login-option">{{Auth::user()->name}}，您好</p>
                    <br>
                    <button class="btn-primary" onclick="location.href='{{ route('ht.Auth.logout') }}'">登出</button>
                </div> -->
                <!-- nav>
                    <ul class="nav">

                    @if(Auth::user()->permission->overview == 'Y')
                        @if(url()->current() == route('ht.Overview.index',['organization'=>$organization]))
                        <li class="selected">
                            <a href="{{ route('ht.Overview.index',['organization'=>$organization]) }}"><i class="fas fa-angle-double-right"></i> <span>總覽</span></a>
                        </li>
                        @else
                        <li>
                            <a href="{{ route('ht.Overview.index',['organization'=>$organization]) }}"><i class="fas fa-angle-double-right"></i> <span>總覽</span></a>
                        </li>
                        @endif
                    @endif

                    @if(Auth::user()->permission->assistant == 'N' && Auth::user()->permission->supervisor == 'N' && Auth::user()->permission->staff == 'N')

                    @else
                        <li class="c-l">
                            <a class="collapsed" data-toggle="collapse" href="#sub-1"><i class="fas fa-angle-double-right"></i> <span>行程管理</span> <span class="float-right">+</span><span class="badge">{{$caseCount}}</span></a>
                            <div class="collapse" id="sub-1">
                                <ul class="nav">

                                 @if(Auth::user()->permission->assistant == 'Y')
                                    @if(url()->current() == route('ht.StrokeManage.assistant.index',['organization'=>$organization]))
                                    <li class="selected">
                                        <a href="{{ route('ht.StrokeManage.assistant.index',['organization'=>$organization]) }}">助理</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.StrokeManage.assistant.index',['organization'=>$organization]) }}">助理</a>
                                    </li>
                                    @endif
                                @endif

                                @if(Auth::user()->permission->supervisor == 'Y')
                                    @if(url()->current() == route('ht.StrokeManage.supervisor.index',['organization'=>$organization]))
                                    <li class="selected">
                                        <a href="{{ route('ht.StrokeManage.supervisor.index',['organization'=>$organization]) }}">主管</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.StrokeManage.supervisor.index',['organization'=>$organization]) }}">主管</a>
                                    </li>
                                    @endif
                                @endif

                                @if(Auth::user()->permission->staff == 'Y')
                                    @if(url()->current() == route('ht.StrokeManage.staff.index',['organization'=>$organization]))
                                    <li class="selected">
                                        <a href="{{ route('ht.StrokeManage.staff.index',['organization'=>$organization]) }}">員工</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{ route('ht.StrokeManage.staff.index',['organization'=>$organization]) }}">員工</a>
                                    </li>
                                    @endif
                                @endif
                                </ul>
                            </div>
                        </li>
                    @endif

                    @if(Auth::user()->permission->reservation == 'N' && Auth::user()->permission->satisfaction == 'N' && Auth::user()->permission->contact == 'N')

                    @else
                        <li class="c-2">
                            <a class="collapsed" data-toggle="collapse" href="#sub-2"><i class="fas fa-angle-double-right"></i> <span>表單設定</span> <span class="float-right">+</span></a>
                            <div class="collapse" id="sub-2">
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

                    @if(Auth::user()->permission->timeset == 'Y')
                        @if(url()->current() == route('ht.Timeset.index',['organization'=>$organization]))
                        <li class="selected">
                            <a class="" href="{{ route('ht.Timeset.index',['organization'=>$organization]) }}"><i class="fas fa-angle-double-right"></i> <span>推播時間設定</span></a>
                        </li>
                        @else
                        <li>
                            <a class="" href="{{ route('ht.Timeset.index',['organization'=>$organization]) }}"><i class="fas fa-angle-double-right"></i> <span>推播時間設定</span></a>
                        </li>
                        @endif
                    @endif

                    @if(Auth::user()->permission->permission == 'Y')
                        @if(url()->current() == route('ht.Permission.index',['organization'=>$organization]))
                        <li>
                            <a class="" href="{{ route('ht.Permission.index',['organization'=>$organization]) }}"><i class="fas fa-angle-double-right"></i> <span>權限管理</span></a>
                        </li>
                        @else
                        <li>
                            <a class="" href="{{ route('ht.Permission.index',['organization'=>$organization]) }}"><i class="fas fa-angle-double-right"></i> <span>權限管理</span></a>
                        </li>
                        @endif
                    @endif
                    @if(Auth::user()->permission->contactUs == 'N' && Auth::user()->permission->satisfactionSurvey == 'N')

                    @else
                        <li class="c-3">
                            <a class="collapsed" data-toggle="collapse" href="#sub-3"><i class="fas fa-angle-double-right"></i> <span>表單查看</span> <span class="float-right">+</span></a>
                            <div class="collapse" id="sub-3">
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
                    </ul>
                </nav> -->
<!--             </div>
</div> -->
<!-- 選單rwd -->
<!--         <side-bar class="rwd">
            <div style="height: calc(100vh - 60px);overflow-y: auto;">
            @if(Auth::user()->permission->overview == 'Y')
            <a class="" href="{{ route('ht.Overview.index',['organization'=>$organization]) }}">
                @if(url()->current() == route('ht.Overview.index',['organization'=>$organization]))
                <sb-item class="selected"><i class="fas fa-angle-double-right fa-fw"></i> 總覽</sb-item>
                @else
                <sb-item><i class="fas fa-angle-double-right fa-fw"></i> 總覽</sb-item>
                @endif
            </a>
            @endif
            @if(Auth::user()->permission->assistant == 'N' && Auth::user()->permission->supervisor == 'N' && Auth::user()->permission->staff == 'N')

            @else
            <sb-menu>
                <sb-menu-title><i class="fas fa-angle-double-right fa-fw"></i> <span> 行程管理</span><span class="badge">{{$caseCount}}</span></sb-menu-title>

                @if(Auth::user()->permission->assistant == 'Y')
                    @if(url()->current() == route('ht.StrokeManage.assistant.index',['organization'=>$organization]))
                <sb-item class="selected" onclick="javascript:location.href='{{ route('ht.StrokeManage.assistant.index',['organization'=>$organization]) }}'">助理</sb-item>
                    @else
                <sb-item onclick="javascript:location.href='{{ route('ht.StrokeManage.assistant.index',['organization'=>$organization]) }}'">助理</sb-item>
                    @endif
                @endif

                @if(Auth::user()->permission->supervisor == 'Y')
                    @if(url()->current() == route('ht.StrokeManage.supervisor.index',['organization'=>$organization]))
                <sb-item class="selected" onclick="javascript:location.href='{{ route('ht.StrokeManage.supervisor.index',['organization'=>$organization]) }}'">主管</sb-item>
                    @else
                <sb-item onclick="javascript:location.href='{{ route('ht.StrokeManage.supervisor.index',['organization'=>$organization]) }}'">主管</sb-item>
                    @endif
                @endif

                @if(Auth::user()->permission->staff == 'Y')
                    @if(url()->current() == route('ht.StrokeManage.staff.index',['organization'=>$organization]))
                <sb-item class="selected" onclick="javascript:location.href='{{ route('ht.StrokeManage.staff.index',['organization'=>$organization]) }}'">員工</sb-item>
                    @else
                <sb-item onclick="javascript:location.href='{{ route('ht.StrokeManage.staff.index',['organization'=>$organization]) }}'">員工</sb-item>
                    @endif
                @endif
            </sb-menu>
            @endif

            @if(Auth::user()->permission->reservation == 'N' && Auth::user()->permission->satisfaction == 'N' && Auth::user()->permission->contact == 'N')

            @else
            <sb-menu2>
                <sb-menu-title2><i class="fas fa-angle-double-right fa-fw"></i> <span> 表單設定</span><span class="badge"></span></sb-menu-title2>

                @if(Auth::user()->permission->reservation == 'Y')
                    @if(url()->current() == route('ht.Form.reservation.index',['organization'=>$organization]))
                <sb-item2 class="selected" onclick="javascript:location.href='{{ route('ht.Form.reservation.index',['organization'=>$organization]) }}'">線上預約</sb-item2>
                    @else
                <sb-item2 onclick="javascript:location.href='{{ route('ht.Form.reservation.index',['organization'=>$organization]) }}'">線上預約</sb-item2>
                    @endif
                @endif

                @if(Auth::user()->permission->satisfaction == 'Y')
                    @if(url()->current() == route('ht.Form.satisfaction.index',['organization'=>$organization]))
                <sb-item2 class="selected" onclick="javascript:location.href='{{ route('ht.Form.satisfaction.index',['organization'=>$organization]) }}'">滿意度調查</sb-item2>
                    @else
                <sb-item2 onclick="javascript:location.href='{{ route('ht.Form.satisfaction.index',['organization'=>$organization]) }}'">滿意度調查</sb-item2>
                    @endif
                @endif

                @if(Auth::user()->permission->contact == 'Y')
                    @if(url()->current() == route('ht.Form.contact.index',['organization'=>$organization]))
                <sb-item2 class="selected" onclick="javascript:location.href='{{ route('ht.Form.contact.index',['organization'=>$organization]) }}'">與我聯繫</sb-item2>
                    @else
                <sb-item2 onclick="javascript:location.href='{{ route('ht.Form.contact.index',['organization'=>$organization]) }}'">與我聯繫</sb-item2>
                    @endif
                @endif
            </sb-menu2>
            @endif

            @if(Auth::user()->permission->timeset == 'Y')
            <a class="" href="{{ route('ht.Timeset.index',['organization'=>$organization]) }}">
                    @if(url()->current() == route('ht.Timeset.index',['organization'=>$organization]))
                <sb-item class="selected"><i class="fas fa-angle-double-right fa-fw"></i> 推播時間設定</sb-item>
                    @else
                <sb-item><i class="fas fa-angle-double-right fa-fw"></i> 推播時間設定</sb-item>
                    @endif
            </a>
            @endif

            @if(Auth::user()->permission->permission == 'Y')
            <a class="" href="{{ route('ht.Permission.index',['organization'=>$organization]) }}">
                    @if(url()->current() == route('ht.Permission.index',['organization'=>$organization]))
                <sb-item class="selected"><i class="fas fa-angle-double-right fa-fw"></i> 權限管理</sb-item>
                    @else
                <sb-item><i class="fas fa-angle-double-right fa-fw"></i> 權限管理</sb-item>
                    @endif
            </a>
            @endif

            @if(Auth::user()->permission->ContactUs == 'N' && Auth::user()->permission->satisfactionSurvey == 'N')

            @else
            <sb-menu3>
                <sb-menu-title3><i class="fas fa-angle-double-right fa-fw"></i> <span> 表單查看</span><span class="badge"></span></sb-menu-title3>

                @if(Auth::user()->permission->contactUs == 'Y')
                    @if(url()->current() == route('ht.FormDetails.ContactUs.index',['organization'=>$organization]))
                <sb-item3 class="selected" onclick="javascript:location.href='{{ route('ht.FormDetails.ContactUs.index',['organization'=>$organization]) }}'">與我聯繫</sb-item3>
                    @else
                <sb-item3 onclick="javascript:location.href='{{ route('ht.FormDetails.ContactUs.index',['organization'=>$organization]) }}'">與我聯繫</sb-item3>
                    @endif
                @endif

                @if(Auth::user()->permission->satisfactionSurvey == 'Y')
                    @if(url()->current() == route('ht.FormDetails.satisfactionSurvey.index',['organization'=>$organization]))
                <sb-item3 class="selected" onclick="javascript:location.href='{{ route('ht.FormDetails.satisfactionSurvey.index',['organization'=>$organization]) }}'">滿意度調查</sb-item3>
                    @else
                <sb-item3 onclick="javascript:location.href='{{ route('ht.FormDetails.satisfactionSurvey.index',['organization'=>$organization]) }}'">滿意度調查</sb-item3>
                    @endif
                @endif
            </sb-menu3>
            @endif
        </div>
    </side-bar>