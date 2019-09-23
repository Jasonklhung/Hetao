<!-- 左邊選單pc -->
        <div class="sidebar pc" id="sidebar-nav">
            <div class="sidebar-scroll">
                <nav class="navbar navbar-default">
                    <div class="hetao-logo">
                        <a href="{{ route('ht.Overview.index') }}">賀桃</a>
                    </div>
                </nav>
                <!-- 使用者 -->
                <div class="hetao-user">
                    <p class="show-login-option">賀桃，您好</p>
                </div>
                <nav>
                    <ul class="nav">
                        <li>
                            <a href="{{ route('ht.Overview.index') }}"><i class="fas fa-angle-double-right"></i> <span>總覽</span></a>
                        </li>
                        <li class="c-l">
                            <a class="collapsed" data-toggle="collapse" href="#sub-1"><i class="fas fa-angle-double-right"></i> <span>行程管理</span> <span class="float-right">-</span><span class="badge">5</span></a>
                            <div class="collapse in" id="sub-1">
                                <ul class="nav">
                                    <li class="selected">
                                        <a href="{{ route('ht.StrokeManage.assistant.index') }}">助理</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('ht.StrokeManage.supervisor.index') }}">主管</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('ht.StrokeManage.staff.index') }}">員工</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="c-2">
                            <a class="collapsed" data-toggle="collapse" href="#sub-2"><i class="fas fa-angle-double-right"></i> <span>表單設定</span> <span class="float-right">-</span></a>
                            <div class="collapse in" id="sub-2">
                                <ul class="nav">
                                    <li class="selected">
                                        <a href="{{ route('ht.Form.reservation.index') }}">線上預約</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('ht.Form.satisfaction.index') }}">滿意度調查</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('ht.Form.contact.index') }}">與我聯繫</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a class="" href="{{ route('ht.Timeset.index') }}"><i class="fas fa-angle-double-right"></i> <span>推播時間設定</span></a>
                        </li>
                        <li>
                            <a class="" href="{{ route('ht.Permission.index') }}"><i class="fas fa-angle-double-right"></i> <span>權限管理</span></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- 選單rwd -->
        <side-bar class="rwd">
            <a class="" href="{{ route('ht.Overview.index') }}">
                <sb-item><i class="fas fa-angle-double-right fa-fw"></i> 總覽</sb-item>
            </a>
            <sb-menu open>
                <sb-menu-title><i class="fas fa-angle-double-right fa-fw"></i> <span> 行程管理</span><span class="badge">5</span></sb-menu-title>
                <sb-item class="selected" onclick="javascript:location.href='{{ route('ht.StrokeManage.assistant.index') }}'">助理</sb-item>
                <sb-item onclick="javascript:location.href='{{ route('ht.StrokeManage.supervisor.index') }}'">主管</sb-item>
                <sb-item onclick="javascript:location.href='{{ route('ht.StrokeManage.staff.index') }}'">員工</sb-item>
            </sb-menu>
            <sb-menu>
                <sb-menu-title><i class="fas fa-angle-double-right fa-fw"></i> <span> 表單設定</span><span class="badge">5</span></sb-menu-title>
                <sb-item onclick="javascript:location.href='{{ route('ht.Form.reservation.index') }}'">線上預約</sb-item>
                <sb-item onclick="javascript:location.href='{{ route('ht.Form.satisfaction.index') }}'">滿意度調查</sb-item>
                <sb-item onclick="javascript:location.href='{{ route('ht.Form.contact.index') }}'">與我聯繫</sb-item>
            </sb-menu>
            <a class="" href="{{ route('ht.Timeset.index') }}">
                <sb-item><i class="fas fa-angle-double-right fa-fw"></i> 推播時間設定</sb-item>
            </a>
            <a class="" href="{{ route('ht.Permission.index') }}">
                <sb-item><i class="fas fa-angle-double-right fa-fw"></i> 權限管理</sb-item>
            </a>
        </side-bar>