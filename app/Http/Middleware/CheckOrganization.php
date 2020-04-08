<?php

namespace App\Http\Middleware;

use App\Model\Organization;
use Closure;
use Auth;
use App\Exceptions\PermissionException;
class CheckOrganization
{
	/**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

	public function handle($request, Closure $next)
	{
		//如果取得 organization 模型
		if(is_string($request->organization)){
			$organization = Organization::find($request->organization);
		}else{
			$organization = $request->organization;
		}

		//判斷是否為自己的組織
		if(Auth::user()->organization_id == $organization->id){
			return $next($request);
		}else{
			
			$all = explode(',',Auth::user()->organizations);
			$count = 0;
			foreach ($all as $key => $value) {

				if($value == $organization->id){
					$count++;
				}
			}

			if($count > 0){
				
				return $next($request);
			}
			else{

				Auth::logout();
				return redirect()->route('ht.Auth.show');
			}
		}

	}
}