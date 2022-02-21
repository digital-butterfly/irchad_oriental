<?php


namespace App;

use App\ProjectApplication;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;



class exportCondidat implements FromArray, WithHeadings,WithMapping,ShouldAutoSize,WithStyles,WithColumnWidths
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
 public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 30,
            'C' => 30,
            'D' => 30,
            'E' => 30,
            'F' => 25,
            'L' => 45,
            'G' => 20,
            'H' => 20,
            'I' => 25,
            'J' => 20,
            'K' => 35,
            'M' => 45,
            'N' => 45,
            'O' => 45,
            'P' => 45,

        ];
    }
public function styles(Worksheet $sheet)
    {
        return [
        // Style the first row as bold text.
        1    => ['font' => ['bold' => true]],
        'A' => ['alignment' => ['wrapText' => true]],
        'B' => ['alignment' => ['wrapText' => true]],
        'C' => ['alignment' => ['wrapText' => true]],
        'D' => ['alignment' => ['wrapText' => true]],
        'E' => ['alignment' => ['wrapText' => true]],
        'F' => ['alignment' => ['wrapText' => true]],
        'g' => ['alignment' => ['wrapText' => true]],
        'H' => ['alignment' => ['wrapText' => true]],
        'I' => ['alignment' => ['wrapText' => true]],
        'J' => ['alignment' => ['wrapText' => true]],
        'K' => ['alignment' => ['wrapText' => true]],
        'L' => ['alignment' => ['wrapText' => true]],
        'M' => ['alignment' => ['wrapText' => true]],
        'N' => ['alignment' => ['wrapText' => true]],
        'O' => ['alignment' => ['wrapText' => true]],
        'P' => ['alignment' => ['wrapText' => true]],

        ];
    }

    public function headings(): array
    {
       if ($this->type==="Candidatures"){
           return [
               '#',
               'Adhérant',
               'secteurs',
               'Sous secteurs',
               'Communes',
               'Titre',
               'Genre',
              'CIN',
               'Tél',
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
               'Numéro identité',
               'Prénom',
               'Nom de famille',
               'Email',
               'Téléphone', 
               'Statut du compte',
               'Sexe',
               'Date de naissance',
               'Age',
               'Addresse',
              // 'Commune',
               'Diplômes',
               'Experience professionnelle',
               'Mobilité réduite',
               'created_at',
               'Créé par'
             


           ];
       }

    }
    public function array(): array
    {
        $data=null;
        if ($this->type==="Candidatures"){
            if ($this->status!=null){
                $data = (array) json_decode(ProjectApplication::all()->where('status',$this->status));
            }
            else{
                $data = (array) json_decode(ProjectApplication::all());
            }


            return $data;
}
        elseif ($this->type==="Member"){
            if ($this->status!=null){
            $data =  (Member::all()->where('status',$this->status)->toArray());}
            else{
                $data =  (Member::all()->toArray());}
            }
             return $data;



    }
    public function map($data):array
    {
        if ($this->type==="Candidatures"){
            return [

                $data->id,
                Member::findOrFail($data->member_id)->getFullNameAttribute($data->member_id),
                ProjectCategory::findOrFail($data->category_id)->getParent->title,
                ProjectCategory::findOrFail($data->category_id)->title,
                Township::findOrFail($data->township_id)->title,
                $data->title,
                Member::where('id', $data->member_id)->pluck('gender')->first(),
                Member::where('id', $data->member_id)->pluck('identity_number')->first(),
                Member::where('id', $data->member_id)->pluck('phone')->first(),
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
                $data['gender'],
                $data['birth_date'],
                (date('Y') - date('Y',strtotime($data['birth_date']))),
                $data['address'],
                //Township::findOrFail($data['township_id'])->title ?? '',
                implode(",",array_map(function($el){
                    return $el->label;
                },array_values((array)$data['degrees']))),
                 implode(",",array_map(function($el){
                    return $el->label;
                },array_values((array)$data['professional_experience']))),
                $data['reduced_mobility'],
                $data['created_at'],
                $data['cree_par'],
            ];

        }
    }
}
