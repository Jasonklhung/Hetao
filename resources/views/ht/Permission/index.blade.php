@extends('layout.app')

@section('content')
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
                                                                @foreach($users as $data)
                                                                <tr>
                                                                    <td>{{ $data->job }}</td>
                                                                    <td>{{ $data->name }}</td>
                                                                    <td>{{ $data->company }}</td>
                                                                    <td><a href="tel:{{ $data->mobile }}">{{ $data->mobile }}</a></td>
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
        </div>
@endsection

@section('scripts')
<script type="text/javascript">
    //權限管理filter
    $('#hetao-list-authority_filter').append(
        "<div class='coupon'>" +
        "<form class='form-inline'>" +
        "<div class='btn-wrap'>" +
        "<a href='{{ route('ht.Permission.create',['organization'=>$organization]) }}'><button class='btn-bright' type='button'>新增人員</button></a>" +
        "</div>" +
        "</form>" +
        "</div>"
    );
</script>
@endsection