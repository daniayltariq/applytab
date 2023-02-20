<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\User;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Domain\Mail\InviteTalent;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Domain\Mail\DeactivateUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->date);
        $users = User::when($request->query('date'), function($q) use ($request){
                            //query where between given date
                            $date = explode('-',$request->date);
                            
                            return $q->whereBetween('created_at', [ Carbon::parse(trim($date[0]))->format('Y-m-d'), Carbon::parse(trim($date[1]))->format('Y-m-d') ]);
                        })->when($request->query('role') && $request->query('role') !='superadmin', function ($query) use ($request) {
                            return $query->whereHas(
                                'roles', function($q) use ($request){
                                    $q->whereNotIn('name',['employee','superadmin'])->where('name',$request->query('role'));
                                }
                            );
                        })->when($request->query('search_text'), function($q) use ($request){
                            return $q->where('first_name','LIKE','%'.$request->search_text.'%')
                                    ->orWhere('last_name','LIKE','%'.$request->search_text.'%')->with('roles');
                        })->paginate(25);
        
        
        
        $roles=Role::where('name','<>','superadmin')->get();
        
        // dd($users);
        return view('backend.user.list',compact('users','roles'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
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
        $user= User::findOrFail($id);
        
        return view('backend.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
