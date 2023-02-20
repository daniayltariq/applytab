<?php

namespace App\Imports;

use App\User;

use Carbon\Carbon;
use App\Models\Field;
use App\Models\RawData;
use Illuminate\Support\Str;
use App\Models\CustomerContact;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactImport implements WithValidation, SkipsOnFailure, ToCollection, WithStartRow,WithChunkReading/* , ShouldQueue */
{
    use Importable, SkipsFailures;
    
    public $orig_data; 
    private $errors = []; // array to accumulate errors

    public function __construct()
    {
        /* $this->contest_id = $data;  */
    }

    public function startRow(): int
    {
        return 2;
    }

     public function chunkSize(): int
    {
        return 500;
    } 

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $rows)
    {
        $rows = $rows->toArray();
        $this->orig_data = $rows;
        /* dd($rows); */
        // iterating each row and validating it:
        foreach ($rows as $key=>$row) {
            /* if ($key==0) {
                continue;
            } */
           /* $validator = Validator::make($row, $this->rules(), $this->validationMessages());
            if ($validator->fails()) {
                foreach ($validator->errors()->messages() as $messages) {
                    foreach ($messages as $error) {
                        // accumulating errors:
                        $this->errors[] = $error;
                    }
                }
            } else { */

                // $contact = new CustomerContact();
                // $contact->name = $row[0];
                // $contact->dob_and_social_security_no = $row[1];

                // $split=explode('-',$row[1]);

                // $contact->dob = Carbon::createFromFormat('Ymd',$split[0]);
                // $contact->social_security_no=$split[1] ?? '';
                // $contact->gender = $row[2];

                // $gender_types=Field::where('validation_type','GENDER')->get();
                // foreach ($gender_types as $key => $gender) {
                //     if (preg_match("/\b".$gender->value."\b/i",$row[2])) {
                //         $contact->gender_type = $gender->id;
                //         break;
                //     }
                // }

                // $contact->address = $row[3];

                // $address_types=Field::where('validation_type','PROPERTY_TYPE')->get();
                // foreach ($address_types as $key => $type) {
                //     if (preg_match("/\b".$type->value."\b/i",$row[3])) {
                //         $contact->address_type = $type->id;
                //         break;
                //     }
                // }

                $contact = new RawData();
                $contact->operator = $row[0] ?? '';
                /* $contact->address = $row[1]; */
                $contact->full_name = $row[1] ?? '';
                $contact->social_security_no = $row[2] ?? '';
                $contact->gender = $row[3] ?? '';
                $contact->age = $row[4] ?? '';
                $contact->street_address = $row[5] ?? '';
                $contact->postal_number = $row[6] ?? '';
                $contact->city = $row[7] ?? '';

                $contact->sq_mtr_housing = $row[8] ?? '';
                $contact->mobile = $row[9]?? '';
                $contact->nix = isset($row[10]) && $row[10] !='' ?  1 : (isset($row[11]) && $row[11] != '' ? 1 : (isset($row[12]) && $row[12]!= '' ? 1: 0));
                
                $contact->tel1 = $row[13] ?? '';
                $contact->tel2 = $row[14] ?? '';

                $contact->tel3 = $row[15] ?? '';
                $contact->tel4 = $row[16] ?? '';
                $contact->tel5 = $row[17] ?? '';
                $contact->tel6 = $row[18] ?? '';
                $contact->tel7 = $row[19] ?? '';
                
                $contact->tel8 = $row[20] ?? '';
                $contact->tel9 = $row[21] ?? '';

               /*  $contact->web2 = $row[16];
                $contact->condominiums = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[17]); */
               
                $contact->save();

            /* } */
        }
    }

    // this function returns all validation errors after import:
    public function getErrors()
    {
        return $this->errors;
    }

    public function rules(): array
    {
        return [
            '0' => 'required|max:255',
            '1' => 'required'/* |unique:customer_contacts,dob' */,
            '2' => 'required',
            '3' => 'required',
            '4' => 'required',
            '5' => 'required',
            '6' => 'required',
            '7' => 'required',
            '8' => 'required',
            '9' => 'nullable',
            '10' => 'nullable',
            '11' => 'nullable',
            '12' => 'nullable',
            '13' => 'nullable',
            '14' => 'nullable',
            '15' => 'nullable',
            '16' => 'nullable',
            '17' => 'nullable',

        ];
    }

    public function validationMessages()
    {
        return [
            '0.required' => trans('name is required'),
            '1.required' => trans('national id is required'),
            '1.unique' => trans('national id must be unique'),
            '2.required' => trans('address is required'),
            '3.required' => trans('gender is required'),
            '4.required' => trans('post number is required'),
            '5.required' => trans('city is required'),
            '6.required' => trans('tel0 is required'),
            '7.required' => trans('tel1 is required'),
            '8.required' => trans('tel2 is required'),
            '9.required' => trans('tel3 is required'),
            '10.required' => trans('tel4 is required'),
            '11.required' => trans('tel5 is required'),
            '12.required' => trans('tel6 is required'),
            '13.required' => trans('tel7 is required'),
            '14.required' => trans('tel8 is required'),
            '15.required' => trans('tel9 is required'),
            '16.required' => trans('web2 is required'),
            '17.required' => trans('condominiums is required'),
        ];
    }
    
}
