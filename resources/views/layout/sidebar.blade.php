<!-- 左邊選單pc -->
        <div class="sidebar pc" id="sidebar-nav">
            <div class="sidebar-scroll">
                <nav class="navbar navbar-default">
                    <div class="hetao-logo">
                        <a href="{{ route('ht.Overview.index',['organization'=>$organization]) }}">賀桃</a>
                    </div>
                </nav>
                <!-- 使用者 -->
                <div class="hetao-user">
                    <p class="show-login-option">{{Auth::user()->name}}，您好</p>
                </div>
                <nav>
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
                            <a class="collapsed" data-toggle="collapse" href="#sub-1"><i class="fas fa-angle-double-right"></i> <span>行程管理</span> <span class="float-right">+</span><span class="badge"></span></a>
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
                    </ul>
                </nav>
            </div>
        </div>
        <!-- 選單rwd -->
        <side-bar class="rwd">
            @if(Auth::user()->permission->overview == 'Y')
            <a class="" href="{{ route('ht.Overview.index',['organization'=>$organization]) }}">
                <sb-item><i class="fas fa-angle-double-right fa-fw"></i> 總覽</sb-item>
            </a>
            @endif
            @if(Auth::user()->permission->assistant == 'N' && Auth::user()->permission->supervisor == 'N' && Auth::user()->permission->staff == 'N')

            @else
            <sb-menu open>
                <sb-menu-title><i class="fas fa-angle-double-right fa-fw"></i> <span> 行程管理</span><span class="badge">5</span></sb-menu-title>

                @if(Auth::user()->permission->assistant == 'Y')
                <sb-item class="selected" onclick="javascript:location.href='{{ route('ht.StrokeManage.assistant.index',['organization'=>$organization]) }}'">助理</sb-item>
                @endif

                @if(Auth::user()->permission->supervisor == 'Y')
                <sb-item onclick="javascript:location.href='{{ route('ht.StrokeManage.supervisor.index',['organization'=>$organization]) }}'">主管</sb-item>
                @endif

                @if(Auth::user()->permission->staff == 'Y')
                <sb-item onclick="javascript:location.href='{{ route('ht.StrokeManage.staff.index',['organization'=>$organization]) }}'">員工</sb-item>
                @endif
            </sb-menu>
            @endif

            @if(Auth::user()->permission->reservation == 'N' && Auth::user()->permission->satisfaction == 'N' && Auth::user()->permission->contact == 'N')

            @else
            <sb-menu2>
                <sb-menu-title2><i class="fas fa-angle-double-right fa-fw"></i> <span> 表單設定</span><span class="badge">5</span></sb-menu-title2>

                @if(Auth::user()->permission->reservation == 'Y')
                <sb-item2 onclick="javascript:location.href='{{ route('ht.Form.reservation.index',['organization'=>$organization]) }}'">線上預約</sb-item2>
                @endif

                @if(Auth::user()->permission->satisfaction == 'Y')
                <sb-item2 onclick="javascript:location.href='{{ route('ht.Form.satisfaction.index',['organization'=>$organization]) }}'">滿意度調查</sb-item2>
                @endif

                @if(Auth::user()->permission->contact == 'Y')
                <sb-item2 onclick="javascript:location.href='{{ route('ht.Form.contact.index',['organization'=>$organization]) }}'">與我聯繫</sb-item2>
                @endif
            </sb-menu2>
            @endif

            @if(Auth::user()->permission->timeset == 'Y')
            <a class="" href="{{ route('ht.Timeset.index',['organization'=>$organization]) }}">
                <sb-item><i class="fas fa-angle-double-right fa-fw"></i> 推播時間設定</sb-item>
            </a>
            @endif

            @if(Auth::user()->permission->permission == 'Y')
            <a class="" href="{{ route('ht.Permission.index',['organization'=>$organization]) }}">
                <sb-item><i class="fas fa-angle-double-right fa-fw"></i> 權限管理</sb-item>
            </a>
            @endif
        </side-bar>