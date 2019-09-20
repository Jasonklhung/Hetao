@extends('layout.app')

@section('content')
<div class="main dispatch-form">
	<div class="main-content">
		<div class="container-fluid">
			<!-- 活動分析 -->
			<h3 class="page-title">行程管理 <span>Management</span></h3>
			<div class="panel bg-transparent">
				<div class="panel-body">
					<div class="row">
						<!-- 分析數據-->
						<div class="col-md-12 wrap">
							<div class="panel" id="manager">
								<div class="panel-title">
									<i class="fas fa-tasks"></i>處理線上預約表單
								</div>
								<div class="panel-body">
									<div class="tabbable">
										<div class="field">
											<span>狀態：</span>
											<button type="button" class="btn btn-primary">處理</button>
											<button type="button" class="btn btn-default">棄單</button>
										</div>
										<div class="field">
											<h4 class="title-deco">客戶線上預約表單</h4>
											<h5>聯繫方式</h5>
											<ul>
												<li><p>姓名：王○○</p></li>
												<li><p>電子郵件：abc@gmail.com</p></li>
											</ul>
											<h5>派工相關</h5>
											<ul>
												<li><p>派工類型：維修飲用水設備</p></li>
												<li><p>目前飲用水設備狀況：不冰/不熱</p></li>
											</ul>
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

@endsection