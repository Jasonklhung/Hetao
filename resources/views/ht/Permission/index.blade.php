@extends('layout.app')

@section('content')
        <!-- <div class="main permission">
            <div class="main-content">
                <div class="container-fluid">
                    <h3 class="page-title">權限管理 <span>Authority</span></h3>
                    @include('common.message')
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-user-tie"></i>權限管理列表
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                    <div class="tab-pane" id="viewers-tab-02">
                                                        <div class='coupon'>
                                                            <form class='form-inline'>
                                                                <input type="text" class="form-control mr-s searchInput searchInput_authority" placeholder="請輸入關鍵字">
                                                                <div class='btn-wrap'>
                                                                    <a href='{{ route('ht.Permission.create',['organization'=>$organization]) }}'><button class='btn-bright' type='button'>新增人員</button></a>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <table class="table table-hover dt-responsive table-striped" id="hetao-list-authority">
                                                            <thead class="rwdhide">
                                                                <tr>
                                                                    <th class="desktop">人員職稱</th>
                                                                    <th class="desktop">人員名稱</th>
                                                                    <th class="desktop">是否完成驗證</th>
                                                                    <th class="desktop">最後登入時間</th>
                                                                    <th class="desktop">編輯/刪除</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($users as $data)
                                                                <tr>
                                                                    <td>{{ $data->job }}</td>
                                                                    <td>{{ $data->name }}</td>
                                                                    @if($data->is_verified == 'N')
                                                                    <td>否</td>
                                                                    @else
                                                                    <td>是</td>
                                                                    @endif
                                                                    <td>{{ $data->updated_at }}</td>
                                                                    <td>
                                                                        <a href="{{ route('ht.Permission.edit',['organization'=>$organization,'id'=>$data->id]) }}"><button type="button" class="btn btn-primary">編輯</button></a>
                                                                        <form method="post" class="d-inline" action="{{ route('ht.Permission.destroy',['organization'=>$organization]) }}">
                                                                            @csrf
                                                                            <input type="hidden" name="_method" value="DELETE">
                                                                            <input type="hidden" name="id" value="{{$data->id}}">
                                                                        <button type="submit" class="btn btn-default">刪除</button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
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
        </div> -->
        <!-- 右邊內容 -->
        <div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">權限管理 <span>Authority</span></h3>
                    @include('common.message')
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-cog"></i>權限管理列表
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <div class='coupon w-100'>
                                                    <form class='form-inline'>
                                                        <input type="text" class="form-control mr-s searchInput searchInput_authority" placeholder="請輸入關鍵字">
                                                        <div class='btn-wrap'>
                                                            <a href='{{ route('ht.Permission.create',['organization'=>$organization]) }}'><button class='btn-bright mr-s' type='button'>新增人員</button></a>
                                                            <a href='#' data-toggle="modal" data-target="#addstation"><button class='btn-bright' type='button'>新增營站</button></a>
                                                        </div>
                                                        <select name="" id="" class="mb-s form-control d-inline w-auto float-right r-w-100">
                                                            <option value="" selected>所有營站</option>
                                                            <option value="">竹北H000</option>
                                                            <option value="">竹南H000</option>
                                                            <option value="">竹東H000</option>
                                                        </select>
                                                    </form>
                                                </div>
                                                <table class="table table-hover dt-responsive table-striped" id="hetao-list-authority">
                                                    <thead class="rwdhide">
                                                        <tr>
                                                            <th class="desktop">地區</th>
                                                            <th class="desktop">營站</th>
                                                            <th class="desktop">人員職稱</th>
                                                            <th class="desktop">人員名稱</th>
                                                            <th class="desktop">是否完成驗證</th>
                                                            <th class="desktop">電話</th>
                                                            <th class="desktop">最後登入時間</th>
                                                            <th class="desktop">編輯/刪除</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($users as $data)
                                                        <tr>
                                                            <td>{{ $data->area }}</td>
                                                            <td>{{ $data->company }}</td>
                                                            <td>{{ $data->job }}</td>
                                                            <td>{{ $data->name }}</td>
                                                            @if($data->is_verified == 'N')
                                                            <td>否</td>
                                                            @else
                                                            <td>是</td>
                                                            @endif
                                                            <td>{{ $data->mobile }}</td>
                                                            <td>{{ $data->updated_at }}</td>
                                                            <td>
                                                                <a href="{{ route('ht.Permission.edit',['organization'=>$organization,'id'=>$data->id]) }}"><button type="button" class="btn btn-primary">編輯</button></a>
                                                                <form method="post" class="d-inline" action="{{ route('ht.Permission.destroy',['organization'=>$organization]) }}">
                                                                    @csrf
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <input type="hidden" name="id" value="{{$data->id}}">
                                                                    <button type="submit" class="btn btn-default">刪除</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        @endforeach
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
@endsection

@section('modal')
<!-- Modal-新增營站 -->
<div class="modal fade Overview-set" id="addstation" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-none">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body m-0">
                <form action="">
                    <ul>
                        <li class="mb-s">
                            <span class="mb-xs">地區</span>
                            <select class="form-control">
                                <option value="" selected hidden disabled>請選擇</option>
                                <option value="">新北</option>
                                <option value="">桃園</option>
                                <option value="">新竹</option>
                                <option value="">苗栗</option>
                                <option value="">高雄</option>
                                <option value="">屏東</option>
                            </select>
                        </li>
                        <li class="mb-s">
                            <span class="mb-xs">站名</span>
                            <input class="form-control" type="text">
                        </li>
                        <li class="mb-s">
                            <span class="mb-xs">代碼</span>
                            <input class="form-control" type="text">
                        </li>
                    </ul>
                </form>
                <div class="text-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">確認</button>  
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">

</script>
@endsection