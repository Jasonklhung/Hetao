<?php

namespace App\Exports;

use App\BusinessTrack;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BusinessDownloadExport implements FromQuery ,WithHeadings
{
   use Exportable;

   public function search(array $id)
    {
        $this->id = $id;
        
        return $this;
    }

    public function query()
    {

        return BusinessTrack::query()
                ->select('businesses.date','business_tracks.level','business_tracks.schedule','business_tracks.category','businesses.name','business_tracks.touch','business_case_details.numbers','business_case_details.money','business_case_details.quantity','business_case_details.total','business_tracks.date_again','business_tracks.result','business_tracks.other')
                ->leftjoin('businesses','business_tracks.business_id','=','businesses.id')
                ->leftjoin('business_case_details','business_case_details.business_track_id','=','business_tracks.id')
                ->whereIn('business_tracks.id',$this->id);
    }

    public function headings() :array
    {
        return [
            '日期',
            '分級',
            '進度',
            '住家 / 商用',
            '客戶名稱',
            '採購人',
            '產品型號',
            '單價(含稅)',
            '台數',
            '總金額',
            '下次覆訪日期',
            '結果',
            '備註'
        ];
    }
}
