<?php


namespace App;


use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExcelPerSheet implements  WithMultipleSheets
{

    use Exportable;

    private $collection;
    protected $far;
    public function __construct($arrays)
    {

        $this->far=$arrays;


    }

    public function sheets(): array
    {$sheets=[];
        foreach($this->far as $test) {

            $sheets[] = new exportExl($test);
        }
        return($sheets);
    }


}
