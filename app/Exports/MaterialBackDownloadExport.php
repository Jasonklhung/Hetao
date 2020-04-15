<?php

namespace App\Exports;

use App\MaterialBack;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MaterialBackDownloadExport implements FromQuery ,WithHeadings
{
   use Exportable;

   public function search(array $id)
    {
        $this->id = $id;
        
        return $this;
    }

    public function query()
    {
        foreach ($this->id as $key => $value) {
            $res = MaterialBack::find($value);
            $res->statusDL = 'Y';
            $res->save();
        }

        return MaterialBack::query()
                ->select('material_backs.date','material_backs.emp_id','material_backs.emp_name','material_backs.materials_number','material_backs.materials_spec','material_backs.quantity','material_backs.back_quantity','material_backs.other')
        		->whereIn('id',$this->id);
    }

    public function headings() :array
    {
        return [
            '日期',
            '員工編號',
            '姓名',
            '產品料號',
            '品名規格',
            '數量',
            '退料數量',
            '備註'
        ];
    }
}
