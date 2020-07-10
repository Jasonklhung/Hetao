<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
use App\ContactAnswer;
use Carbon\Carbon;
use GuzzleHttp\Client;

class ContactController extends Controller
{
    public function index()
    {
        $data = Contact::all();

        return $data;
    }

    public function store(Request $request)
    {
    	$form = array();

    	foreach ($request->form as $key => $value) {

             $form[$key] = $value;
        }

        $date = Carbon::now()->format('Y-m-d');
        $caseDate = explode('-',$date)[0].explode('-',$date)[1].explode('-',$date)[2];
        $case = ContactAnswer::all();

        if($case->isNotEmpty()){
            foreach ($case as $key => $value) {
                $cDate = explode(' ', $value->created_at)[0];

                if($cDate == $date){
                    $all = ContactAnswer::whereDate('created_at',$date)->get();
                    $count = count($all)+1;
                    $count=str_pad($count,4,0,STR_PAD_LEFT); 
                    $number = $caseDate.$count;
                }
                else{
                    $number = $caseDate.'0001';
                }
            }
        }
        else{

            $caseDate = explode('-',$date)[0].explode('-',$date)[1].explode('-',$date)[2];
            $number = $caseDate.'0001';
        }

    	$res = new ContactAnswer;
        $res->number = $number;
    	$res->form = json_encode($form);
    	$res->save();   

        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://notify-api.line.me/api/notify', [
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded','Authorization'=> 'Bearer vlsUUu5KTNA1uChSjBMrmoXaaVbqXzjXzPVWekuz9zy'],
            'body' => json_encode([
                'message' => 'test'
            ])
        ]);

        $response = $response->getBody()->getContents();

        $data = json_decode($response);

    	return $data;
    }

    public function show()
    {
        $data = ContactAnswer::all();
        $result = array();
        $date = array();

        foreach ($data as $key => $value) {

            $res = array();

            $data = json_decode($value->form);

            foreach ($data as $k => $v) {
                foreach ($v as $kk => $vv) {
                    if(preg_match("/^radio+[0-9]+Question+$/", $vv->name)){
                        $radioName = explode('Question', $vv->name)[0];
                        foreach ($v as $r => $rr) {
                            if(preg_match("/^$radioName+Question+$/", $rr->name)){
                                $res[$radioName]['question'] = $rr->value;
                            }
                            elseif(preg_match("/^$radioName+Opt$/", $rr->name)){
                                $res[$radioName]['answer'] = $rr->value;
                            }
                        }

                        $res = array_values($res);
                    }
                    elseif(preg_match("/^multi+[0-9]+Question+$/", $vv->name)){
                        $multiName = explode('Question', $vv->name)[0];
                        foreach ($v as $r => $rr) {
                            if(preg_match("/^$multiName+Question+$/", $rr->name)){
                                $res[explode('Question', $rr->name)[0]]['question'] = $rr->value;
                            }
                            elseif(preg_match("/^$multiName+Opt$/", $rr->name)){
                                $res[explode('Opt', $rr->name)[0]]['answer'][] = $rr->value;
                            }
                        }
                        $res = array_values($res);
                    }
                    elseif(preg_match("/^select+[0-9]+Question+$/", $vv->name)){
                        $selectName = explode('Question', $vv->name)[0];
                        foreach ($v as $r => $rr) {
                            if(preg_match("/^$selectName+Question+$/", $rr->name)){
                                $res[explode('Question', $rr->name)[0]]['question'] = $rr->value;
                            }
                            elseif(preg_match("/^$selectName+$/", $rr->name)){
                                $res[$rr->name]['answer'] = $rr->value;
                            }
                        }
                        $res = array_values($res);
                    }
                    elseif(preg_match("/^qa+[0-9]+Question+$/", $vv->name)){
                        $qaName = explode('Question', $vv->name)[0];
                        foreach ($v as $r => $rr) {
                            if(preg_match("/^$qaName+Question+$/", $rr->name)){
                                $res[explode('Question', $rr->name)[0]]['question'] = $rr->value;
                            }
                            elseif(preg_match("/^$qaName+$/", $rr->name)){
                                $res[$rr->name]['answer'] = $rr->value;
                            }
                        }
                        $res = array_values($res);
                    }
                    elseif(preg_match("/^part+[0-9]+Question+$/", $vv->name)){
                        $partName = explode('Question', $vv->name)[0];
                        foreach ($v as $r => $rr) {
                            if(preg_match("/^$partName+Question+$/", $rr->name)){
                                $res[explode('Question', $rr->name)[0]]['question'] = $rr->value;
                            }
                            elseif(preg_match("/^$partName+$/", $rr->name)){
                                $res[$rr->name]['answer'] = $rr->value;
                            }
                        }
                        $res = array_values($res);
                    }
                    elseif(preg_match("/^date+[0-9]+Question+$/", $vv->name)){
                        $dateName = explode('Question', $vv->name)[0];
                        foreach ($v as $r => $rr) {
                            if(preg_match("/^$dateName+Question+$/", $rr->name)){
                                $res[explode('Question', $rr->name)[0]]['question'] = $rr->value;
                            }
                            elseif(preg_match("/^$dateName+$/", $rr->name)){
                                $res[$rr->name]['answer'] = $rr->value;
                            }
                        }
                        $res = array_values($res);
                    }
                    elseif(preg_match("/^time+[0-9]+Question+$/", $vv->name)){
                        $timeName = explode('Question', $vv->name)[0];
                        foreach ($v as $r => $rr) {
                            if(preg_match("/^$timeName+Question+$/", $rr->name)){
                                $res[explode('Question', $rr->name)[0]]['question'] = $rr->value;
                            }
                            elseif(preg_match("/^$timeName+$/", $rr->name)){
                                $res[$rr->name]['answer'] = $rr->value;
                            }
                        }
                        $res = array_values($res);
                    }
                }
            }
            

            $result[$key]['id'] = $value->id;
            $result[$key]['data'] = $res;
            $result[$key]['status'] = $value->status;

        }

        return $result;
    }
}
