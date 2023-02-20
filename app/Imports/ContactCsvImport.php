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
use Illuminate\Support\Facades\Validator;

class ContactCsvImport
{
    
    public $orig_data; 
    private $errors = []; // array to accumulate errors

    public function __construct()
    {
        /* $this->contest_id = $data;  */
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function import($request)
    {
        $handle = fopen($request->file('contact_data')->getPathName(), "r");
        
        $gender_types=Field::where('validation_type','GENDER')->get();
        $address_types=Field::where('validation_type','PROPERTY_TYPE')->get();

        while (($row = fgetcsv($handle)) !== FALSE) {
        //$row[0] = '1004000018' in first iteration
        /* print_r($row); */
            
            if (isset($row[2]) && !is_null($row[2]) && $row[2] !='') {
                $split=explode('-',$row[2]);
                $social_security_split['dob'] = Carbon::createFromFormat('Ymd',$split[0]);
                $social_security_split['ss_no']=$split[1] ?? '';
            }

            if (isset($row[3]) && !is_null($row[3]) && $row[3] !='') {
                $gender_type ='';
                foreach ($gender_types as $key => $gender) {
                    if (preg_match("/\b".$gender->value."\b/i",$row[3])) {
                        $gender_type = $gender->id;
                        break;
                    }
                }
            }

            if (isset($row[5]) && !is_null($row[5]) && $row[5] !='') {
                $address_type ='';
                foreach ($address_types as $key => $type) {
                    if (preg_match("/\b".$type->value."\b/i",$row[5])) {
                        $address_type = $type->id;
                        break;
                    }
                }
            }


            $data[]=[
                'operator' => utf8_encode($row[0] )?? '',
                'name'=>utf8_encode($row[1] )?? '',
                'dob_and_social_security_no'=>utf8_encode($row[2] )?? '',
                'dob'=>isset($social_security_split['dob']) ? utf8_encode($social_security_split['dob'] ) : '',
                'social_security_no'=>isset($social_security_split['ss_no']) ? utf8_encode($social_security_split['ss_no'] ) : '',
                'address'=>utf8_encode($row[5] )?? '',
                'address_type'=>$address_type ?? '',
                'gender'=>utf8_encode($row[3] )?? '',
                'gender_type'=>$gender_type ?? '',
                'age'=>utf8_encode($row[4] )?? '',
                'post_number'=>utf8_encode($row[6] )?? '',
                'city'=>utf8_encode($row[7] )?? '',
                'sq_mtr_housing'=> utf8_encode($row[8] )?? '',
                'mobile' => utf8_encode($row[9])?? '',
                'nix' => isset($row[10]) && $row[10] !='' ?  1 : (isset($row[11]) && $row[11] != '' ? 1 : (isset($row[12]) && $row[12]!= '' ? 1: 0)),
                'tel1' => isset($row[13]) ?utf8_encode($row[13]) : '' ,
                'tel2' => isset($row[14]) ?utf8_encode($row[14]) : '' ,

                'tel3' => isset($row[15]) ?utf8_encode($row[15]) : '' ,
                'tel4' => isset($row[16]) ?utf8_encode($row[16]) : '' ,
                'tel5' => isset($row[17]) ?utf8_encode($row[17]) : '' ,
                'tel6' => isset($row[18]) ?utf8_encode($row[18]) : '' ,
                'tel7' => isset($row[19]) ?utf8_encode($row[19]) : '' ,
                
                'tel8' => isset($row[20]) ?utf8_encode($row[20]) : '' ,
                'tel9' => isset($row[21]) ?utf8_encode($row[21]) : '' ,
    
            ];

            if (count($data)==2000) {
                /* schedule()->dispatch(new contactImportJob($data)); */
                $contact=CustomerContact::insert($data);
                $data=[];
            }
            
        }
        if (count($data)>1) {
            $contact=CustomerContact::insert($data);
        }
        fclose($handle);
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
