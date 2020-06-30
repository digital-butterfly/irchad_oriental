<?php

namespace App;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;





class exportExl implements FromCollection
{
    use Exportable;

    private $collection;
    protected $far;
    public function collection()
    {

        return $this->collection;
    }
    public function __construct($arrays)
    {

        $this->far=$arrays;



                $this->collection = collect($arrays);


        }










}
