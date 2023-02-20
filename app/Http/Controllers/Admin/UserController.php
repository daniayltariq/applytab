<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Service;

use App\Models\Nationality;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Domain\Mail\InviteTalent;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Domain\Mail\DeactivateUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users=User::whereHas('roles',function($q){
            $q->where('name','<>','superadmin');
        })
        ->when($request->query('type'),function($q)use($request){
            $q->whereHas('roles',function($q)use($request){
                $q->where('name',$request->query('type'));
            });
        })
        ->when($request->query('search_text'),function($q)use($request){
            $search=$request->query('search_text');
            $q->where(function($q2)use($search){
                $q2->where('first_name','LIKE','%'.$search.'%')
                ->orWhere('last_name','LIKE','%'.$search.'%')
                ->orWhere('email','LIKE','%'.$search.'%')
                ->orWhere('phone','LIKE','%'.$search.'%');
            });
        })->where('active',1);

        $roles=(clone $users)->get();
        $users=$users->paginate(10);

        return view('backend.user.list',compact('roles','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $users=User::whereHas('roles',function($q){
            $q->where('name','<>','superadmin');
        })->where('active',1);

        $salesperson=User::salesperson()->where('active',1)->get();
        $purchaser=User::purchaser()->where('active',1)->get();

        $roles=(clone $users)->get();
        $permissions=Permission::all();
        return view('backend.user.create',compact('salesperson','purchaser','roles','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $country_data=null;
        if (array_key_exists('phone',$request->all()) && $request->phone && $request->new_phone) {
            $country_data=json_decode($request->new_phone,true);
            if(!is_array($country_data)){
                return '';
            }
            $request->phone = str_replace(' ','','+'.' '.$country_data['dialCode'].$request->phone);
        }
        $validator = Validator::make($request->all(),[
            'role' => 'required|string|exists:roles,name',
            'first_name' => ['required_if:role,==,employee','string'],
            'last_name' => ['required_if:role,==,employee','string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string',
            'profile_image'=>'nullable|image|max:5000',
            'password' => ['required_if:role,==,employee'],
            'designation' => ['required_if:role,==,employee'],
            'salesperson' => ['required_if:role,==,customer','array'],
            'salesperson.*' => ['exists:users,id'],
            'purchaser' => ['required_if:role,==,vendor','array'],
            'purchaser.*' => ['exists:users,id'],
            'permissions' => ['required_if:role,==,employee','array'],
            'permissions.*' => ['string',function($attribute, $value, $fail) use ($request){
                $perm=Permission::where('name',$value)->first();
                if (!$perm) {
                    return $fail('Invalid permission');
                } 
            }],

        ]);
        
        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }
        
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender ?? '',
            'designation' => $request->designation ?? '',
            'phone' =>$request->phone,
            'phone_c_data'=>$request->new_phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'association' => $request->role=='customer' ? implode('|',$request->salesperson) : ($request->role=='vendor' ? implode('|',$request->purchaser) :null)
        ]);

        if($request->hasFile('profile_image')){

            $user->profile_image = custom_file_upload($request->profile_image,USER_IMAGE_PATH,$user->id);
        }
        $user->save();

        $user->assignRole($request->role);

        //if permissions are set assign them to the user
        if ($request->role=='employee') {
            $user->givePermissionTo($request->permissions);
        }
        
        activity('user')
            ->performedOn($user)
            ->causedBy(auth()->user())
            ->withProperties(['user_id' => $user->id])
            ->log('User created by ' . auth()->user()->name);

        return redirect()->back()->with("status", "User has been Created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (get_user_by_md5($id)) {
            $user =User::findOrFail(get_user_by_md5($id)->id);
            $view_data=view('backend.user.modal',compact('user'))->render();
            $res=array(
                'status' => 'success',
                'data' => $view_data
            );
            
        }else{
            $res=array(
                'status' => 'error',
                'message'=>"data not found"
        
            );
        }

        return Response::json($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (get_user_by_md5($id)) {
            $user =User::findOrFail(get_user_by_md5($id)->id);
            $roles=Role::where('name','<>','superadmin')->get();
            $permissions=Permission::all();

            $salesperson=User::salesperson()->where('active',1)->get();
            $purchaser=User::purchaser()->where('active',1)->get();
            return view('backend.user.create',compact('salesperson','purchaser','user','roles','permissions'));
        } else {
            return redirect()->back()->with("error", "User not found.");
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // dd($request->all());
        $country_data=null;
        if (array_key_exists('phone',$request->all()) && $request->phone && $request->new_phone) {
            $country_data=json_decode($request->new_phone,true);
            if(!is_array($country_data)){
                return '';
            }
            $request->phone = str_replace(' ','','+'.' '.$country_data['dialCode'].$request->phone);
        }
       
        $user =User::findOrFail(get_user_by_md5($id)->id);
        $validator = Validator::make($request->all(),[
            'role' => 'required|string|exists:roles,name',
            'first_name' => ['required_if:role,==,employee','string'],
            'last_name' => ['required_if:role,==,employee','string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email','unique:users,email,'.$user->id],
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string',
            'password' => ['nullable'],
            'designation' => ['required_if:role,==,employee'],
            'profile_image'=>'nullable|image|max:5000',
            'salesperson' => ['required_if:role,==,customer','array'],
            'salesperson.*' => ['exists:users,id'],
            'purchaser' => ['required_if:role,==,vendor','array'],
            'purchaser.*' => ['exists:users,id'],
            'permissions' => ['required_if:role,==,employee','array'],
            'permissions.*' => ['string',function($attribute, $value, $fail) use ($request){
                $perm=Permission::where('name',$value)->first();
                if (!$perm) {
                    return $fail('Invalid permission');
                }
            }],
        ]);
        
        if ($validator->fails()) {
            // dd($request->all());
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $user->fill($request->except(['_token','password','phone','phone_c_data']));
        $user->designation = $request->designation ?? '';
        $user->phone = $request->phone;
        $user->phone_c_data = $request->new_phone;
        $user->association = $request->role=='customer' ? implode('|',$request->salesperson) : ($request->role=='vendor' ? implode('|',$request->purchaser) :null);
        
        if (!is_null($request->password)) {
            $user->password=Hash::make($request->password);
        }
        
        if($request->hasFile('profile_image')){

            $user->profile_image = custom_file_upload($request->profile_image,USER_IMAGE_PATH,$user->id);
        }

        $user->save();

        $user->roles()->detach();
        $user->assignRole($request->role);

        $user->permissions()->detach();
        //if permissions are set assign them to the user
        if ($request->role=='employee') {
            $user->givePermissionTo($request->permissions);
        }

        activity('user')
            ->performedOn($user)
            ->causedBy(auth()->user())
            ->withProperties(['user_id' => $user->id])
            ->log('User updated by ' . auth()->user()->name);

        return redirect()->back()->with("status", "User has been Updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::findOrFail($id);
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->active=0;
        $user->save();

        activity('user')
            ->performedOn($user)
            ->causedBy(auth()->user())
            ->withProperties(['user_id' => $user->id])
            ->log('User deleted by ' . auth()->user()->name);

        return redirect()->back()->with("status", "User Deleted.");
    }
}
