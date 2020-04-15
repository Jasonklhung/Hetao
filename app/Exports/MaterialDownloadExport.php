<?php

namespace App\Exports;

use App\Material;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MaterialDownloadExport implements FromQuery ,WithHeadings
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
            $res = Material::find($value);
            $res->statusDL = 'Y';
            $res->save();
        }

        return Material::query()
                ->select('materials.date','materials.emp_id','materials.emp_name','materials.materials_number','materials.materials_spec','materials.quantity','materials.other')
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
            '備註'
        ];
    }
}
