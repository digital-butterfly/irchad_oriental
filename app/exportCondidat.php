<?php


namespace App;

use App\ProjectApplication;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;





class exportCondidat implements FromArray, WithHeadings,WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct($status, $type)
    {
        $this->status = $status;
        $this->type = $type;
//        dd($this->type);
    }



    public function headings(): array
    {
       if ($this->type==="Candidatures"){
           return [
               '#',
               'Adhérant',
               'id secteurs',
               'township_id',
               'sheet_id',
               'title',
               'description',
               'market_type',
               'business_model',
               'financial_data',
               'Entreprise',
               'Formation',
               'Status',
               'progress',
               'training',
               'incorporation',
               'Financement',
               'Crée à',
               'mise a jour',
               'supprimé a ',
               'Crée par ',
               'mise a jour par',

           ];
       }
       elseif ($this->type==="Member"){

           return [
               '#',
               'identity_number',
               'first_name',
               'last_name',
               'email',
               'phone',
               'status',
               'gender',
               'birth_date',
               'address',
               'township_id',
               'degrees',
               'professional_experience',
               'reduced_mobility',
               'created_at',
               'updated_at',
               'deleted_at'


           ];
       }

    }
    public function array(): array
    {
        $data=null;
        if ($this->type==="Candidatures"){
        $data = (array) json_decode(ProjectApplication::all()->where('status',$this->status));
//        dd($data);
            return $data;
}elseif ($this->type==="Member"){
            $data =  (Member::all()->where('status',$this->status)->toArray());
             return $data;
        }


    }
    public function map($data):array
    {
        if ($this->type==="Candidatures"){
//            dd($data);
            return [

                $data->id,
                $data->member_id,
                $data->category_id,
                $data->township_id,
                $data->sheet_id,
                $data->title,
                $data->description,
                $data->market_type,
                array_values((array)$data->business_model),
                array_values((array)$data->financial_data),
                array_values((array)$data->company),
                array_values((array)$data->training_needs),
                $data->status,
                $data->progress,
                $data->training,
                $data->incorporation,
                $data->funding,
                $data->created_at,
                $data->updated_at,
                $data->deleted_at,
                $data->created_by,
                $data->updated_by,
        ];
    }
        elseif ($this->type==="Member"){
            return [

                $data['id'],
                $data['identity_number'],
                $data['first_name'],
                $data['last_name'],
                $data['email'],
                $data['phone'],
                $data['status'],
                $data['birth_date'],
                $data['address'],
                $data['township_id'],
                $data['degrees'],
                $data['professional_experience'],
                $data['reduced_mobility'],
                $data['created_at'],
                $data['updated_at'],
                $data['deleted_at'],
            ];
        }
    }
}
