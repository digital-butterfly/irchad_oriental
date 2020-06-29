<?php

namespace App;

use App\Member;
use Illuminate\Database\Eloquent\Model;

use Maatwebsite\Excel\Concerns\FromArray;
use function GuzzleHttp\Promise\all;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;




class exportExl implements FromQuery{

    public function query()
    {
        return Member::query('select identity_number');
//        return view('ProjectApplication',compact('title'));
    }


}
