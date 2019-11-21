@extends('layout.app')

@section('content')
<div class="main dispatch-form">
	<div class="main-content">
		<div class="container-fluid">
			<!-- 活動分析 -->
			<h3 class="page-title">滿意度調查 <span>Management</span></h3>
			<div class="panel bg-transparent">
				<div class="panel-body">
					<div class="row">
						<!-- 分析數據-->
						<div class="col-md-12 wrap">
							<div class="panel" id="manager">
								<div class="panel-title">
									<i class="fas fa-tasks"></i>滿意度調查表單
								</div>
								<div class="panel-body">
									<div class="tabbable">
										@foreach($res as $d => $data)
											@php
												$form = json_decode($data->form);

											@endphp
										@endforeach

										@php
											$array = array();
											$aaa =  count($form);

											for($i=0;$i<$aaa;$i++){
												foreach($form[$i] as $b =>$bbb){
													
													$array[] = ['name'=>$bbb->name,'value'=>$bbb->value];
												}
											}
										@endphp

										<div class="field">
											@foreach($array as $key => $value)
												@if(preg_match("/^radio+[0-9]+Question+$/", $value['name']))
														<h5><strong>{{$value['value']}}</strong></h5>
													@foreach($array as $k => $v)
														@if(explode('Question',$value['name'])[0].'Opt' == $v['name'])
														<ul>
															<li><p>{{$v['value']}}</p></li>
														</ul>
														@endif
													@endforeach
												@elseif(preg_match("/^multi+[0-9]+Question+$/", $value['name']))
														<h5><strong>{{$value['value']}}</strong></h5>
													@foreach($array as $k => $v)
														@if(explode('Question',$value['name'])[0].'Opt' == $v['name'])
														<ul>
															<li><p>{{$v['value']}}</p></li>
														</ul>
														@endif
													@endforeach
												@elseif(preg_match("/^select+[0-9]+Question+$/", $value['name']))
														<h5><strong>{{$value['value']}}</strong></h5>
													@foreach($array as $k => $v)
														@if(explode('Question',$value['name'])[0] == $v['name'])
														<ul>
															<li><p>{{$v['value']}}</p></li>
														</ul>
														@endif
													@endforeach
												@elseif(preg_match("/^qa+[0-9]+Question+$/", $value['name']))
														<h5><strong>{{$value['value']}}</strong></h5>
													@foreach($array as $k => $v)
														@if(explode('Question',$value['name'])[0] == $v['name'])
														<ul>
															<li><p>{{$v['value']}}</p></li>
														</ul>
														@endif
													@endforeach
												@elseif(preg_match("/^part+[0-9]+Question+$/", $value['name']))
														<h5><strong>{{$value['value']}}</strong></h5>
													@foreach($array as $k => $v)
														@if(explode('Question',$value['name'])[0] == $v['name'])
														<ul>
															<li><p>{{$v['value']}}</p></li>
														</ul>
														@endif
													@endforeach
												@elseif(preg_match("/^date+[0-9]+Question+$/", $value['name']))
														<h5><strong>{{$value['value']}}</strong></h5>
													@foreach($array as $k => $v)
														@if(explode('Question',$value['name'])[0] == $v['name'])
														<ul>
															<li><p>{{$v['value']}}</p></li>
														</ul>
														@endif
													@endforeach
												@elseif(preg_match("/^time+[0-9]+Question+$/", $value['name']))
														<h5><strong>{{$value['value']}}</strong></h5>
													@foreach($array as $k => $v)
														@if(explode('Question',$value['name'])[0] == $v['name'])
														<ul>
															<li><p>{{$v['value']}}</p></li>
														</ul>
														@endif
													@endforeach
												@endif
											@endforeach
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