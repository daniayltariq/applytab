<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;

class ContactExport implements FromArray
{
    
    protected $contact_fail,$orig_data,$error_data_export;

    public function __construct(array $orig_data,$contact_fail)
    {
       /* dd($contact_fail); */
       $this->contact_fail = $contact_fail;
       $this->orig_data = $orig_data;
       /* dd($this->contact_fail[0]); */
    }

    public function headings(): array
    {
        return [
            'name' => '0',
            'dob' => '1',
            'address' => '2',
            'gender' => '3',
            'post_number' => '4',
            'city' => '5',
            'tel0' => '6',
            'tel1' => '7',
            'tel2' => '8',
            'tel3' => '9',
            'tel4' => '10',
            'tel5' => '11',
            'tel6' => '12',
            'tel7' => '13',
            'tel8' => '14',
            'tel9' => '15',
            'web2' => '16',
            'condominiums' => '17',
        ];
    }

    public function array(): array
    {
        /* $index = array_search($this->contact_fail[0]->attribute(), $this->headings()); */
        /* dd($this->contact_fail); */
        foreach ($this->contact_fail as $key => $fail) {

            $heading = array_search($fail->attribute(),$this->headings());
            $error=str_replace($fail->attribute(),$heading,$fail->errors());
           /*  dd($error); */
            $this->orig_data[$fail->row()-2][$fail->attribute()]=$error;

            $this->error_data_export[]=$this->orig_data[$fail->row()-2];
        }
        return $this->error_data_export;
    }


}
