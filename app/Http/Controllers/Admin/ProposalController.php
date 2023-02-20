<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Proposal;

use Illuminate\Support\Str;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $proposals=Proposal::when($request->query('req'),function($q){
            return $q->where('req_id',request()->query('req'));
        })->paginate(10);
        
        return view('backend.proposal.list',compact('proposals'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $roles=Role::where('name','<>','superadmin')->get();
        return view('backend.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function userProposals($id)
    {
        $user=User::findOrFail($id);
        return view('backend.proposal.list',['proposals'=>$user->proposals()->paginate(10)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user= User::findOrFail($id);
        $roles=Role::where('name','<>','superadmin')->get();
        return view('backend.user.create',compact('user','roles'));
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
        /* dd($request->all()); */
        $validator = Validator::make($request->all(),[
            'gender'  => 'required|string',
            'f_name' => 'required|string',
            'l_name' => 'required|string',
            'phone' => ['required', 'string'],
            'email' => ['required', 'email','unique:users,email,'.$id],
            'dob' => 'required|date',
            'country' => 'required|string',
            'password'  => 'string|nullable',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $country_data=json_decode($request->new_phone,true);
        $user =User::findOrFail($id);
        $user->fill($request->except(['_token']));
        
        $user->phone=Str::of($request->phone)->prepend('+'.$country_data['dialCode']);
        $user->phone_c_data=$request->new_phone;
        if (!is_null($request->password)) {
            $user->password=Hash::make($request->password);
        }

        // store gender
        $user->gender = $request->gender;
        $user->save();

        /* $user->profile->fill($request->all());
        $user->profile->save();

        if ($request->skills) {
            $user->skills()->delete();
            foreach($request->skills as $skill){
                $skills[] = ['candidate_id' => $user->id,'skill_id' => $skill];
            }
            \App\Models\CandidateSkill::insert($skills);
        } */
        
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
        $company=Company::findOrFail($id);
        
        $company->delete();
        return redirect()->back();
    }

}
