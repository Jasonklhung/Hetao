@extends('layout.app')

@section('content')
		<div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">業務管理</h3>
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-briefcase"></i>個人業務 - 業務拜訪紀錄
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <form>
                                                    <div class="col-sm-6">
                                                        <div class="form-item">
                                                            <label class="d-block"><span class="text-danger">* </span>拜訪日期</label>
                                                            <div class="datetime">
                                                                <div class="input-group date day-set">
                                                                    <input class="form-control" placeholder="請選擇日期" type="text"> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-item">
                                                            <label class="d-block"><span class="text-danger">* </span>業務人員</label>
                                                            <input type="text" class="form-control" value="曾曾">
                                                        </div>
                                                        <div class="form-item">
                                                            <label class="d-block"><span class="text-danger">* </span>拜訪時間</label>
                                                            <select class="form-control mr-s">
                                                                <option selected hidden disabled value="">請選擇</option>
                                                                <option value="">上午(AM)</option>
                                                                <option value="">下午(PM)</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-item">
                                                            <label class="d-block"><span class="text-danger">* </span>業主名稱</label>
                                                            <input type="text" class="form-control" value="">
                                                        </div>
                                                        <div class="form-item">
                                                            <label class="d-block"><span class="text-danger">* </span>拜訪類型</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type" class="mr-s">拜訪</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type" class="mr-s">陌訪</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type" class="mr-s">洽機</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type" class="mr-s">看現場</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type" class="mr-s">送機器</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type" class="mr-s">收款</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type" class="mr-s">送文件</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type" class="mr-s">協助安裝</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type" class="mr-s">其他</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type" class="mr-s">支援</label>
                                                        </div>
                                                        <div class="form-item">
                                                            <label class="d-block"><span class="text-danger">* </span>拜訪內容</label>
                                                            <input type="text" class="form-control" value="">
                                                        </div>
                                                    </div>    

                                                    <div class="col-sm-6">
                                                        <div class="form-item">
                                                            <label class="d-block"><span class="text-danger">* </span>拜訪地址</label>
                                                            <div class="d-flex mb-s">
                                                                <select class="form-control mr-s">
                                                                    <option selected hidden disabled value="">縣市</option>
                                                                </select>

                                                                <select class="form-control ml-s">
                                                                    <option selected hidden disabled value="">鄉鎮市</option>
                                                                </select>
                                                            </div>    
                                                            <input type="text" class="form-control" placeholder="地址">
                                                        </div>
                                                        <div class="form-item">
                                                            <label class="d-block"><span class="text-danger">* </span>聯絡電話</label>
                                                            <input type="number" class="form-control" placeholder="聯絡電話">
                                                        </div>
                                                        <div class="form-item">
                                                            <label class="d-block">備註其他</label>
                                                            <textarea rows="5" class="form-control" placeholder=""></textarea>
                                                        </div>
                                                        <div class="form-item">
                                                            <label class="d-block">附件上傳</label>
                                                            
                                                            <span class="form-control">
                                                                <input type="file" class="d-none upload" id="upload">
                                                                <label for="upload">檔名</label>
                                                                <a target="_blank" href="img/bg.jpg" download><i class="fas fa-file-download float-right my-xs" data-toggle="tooltip" data-placement="top" title="下載附件"></i></a>
                                                            </span>
                                                        </div>
                                                        <div class="form-item ">
                                                            <span class="d-block">狀態
                                                                <label class="switch follow-status">
                                                                    <input type="checkbox" checked>
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="col-sm-12 mb-s">
                                                        <a href="個人業務.html"><button type="button" class="btn btn-default">返回</button></a>
                                                        <button type="button" class="btn btn-primary">更新</button>
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

@section('modal')

@endsection

@section('scripts')
<script>
	$('.upload').on('change', function(e){
		var files = e.target.files
		var fileName = files[0].name
		$(this).siblings('label[for="upload"]').html(`<i class="fas fa-paperclip text-primary"></i> `+ fileName);
	});
</script>
@endsection