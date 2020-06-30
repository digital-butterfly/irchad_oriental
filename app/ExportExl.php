<?php

namespace App;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;




class exportExl implements FromCollection
{
    use Exportable;

    private $collection;

    public function __construct($arrays)
    {
        $output = [];

        foreach ($arrays as $array) {
            // get headers for current dataset
            $output[] = array_keys($array[0]);
            // store values for each row
            foreach ($array as $row) {
                $output[] = array_values($row);
            }
            // add an empty row before the next dataset
            $output[] = [''];
        }

        $this->collection = collect($output);
    }

    public function collection()
    {
        return $this->collection;
    }


}
