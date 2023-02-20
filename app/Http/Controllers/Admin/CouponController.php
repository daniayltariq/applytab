<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies=CompanyProfile::all();
        $coupons=Coupon::orderBy('id','DESC')->paginate(10);
        return view('backend.coupon.list',compact('coupons','companies'));
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
        // validate coupon data
        $validator = Validator::make($request->all(),[
            'code' => 'required|unique:coupons',
            'qty' => 'required|numeric',
            'discount_percentage' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'companies' => 'required|array',
            'companies.*' => 'required|exists:company_profile,id',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // store coupon data
        $coupon=new Coupon;
        $coupon->code=$request->code;
        $coupon->qty=$request->qty;
        $coupon->discount_percentage=$request->discount_percentage;
        $coupon->start_date=Carbon::parse($request->start_date)->format('Y-m-d');
        $coupon->end_date=Carbon::parse($request->end_date)->format('Y-m-d');
        $coupon->companies=implode(',',$request->companies);
        $coupon->save();

        return redirect()->back()->with('success','Coupon created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $coupons=Coupon::orderBy('id','DESC')->paginate(10);
        $coupon=Coupon::find($id);
        $companies=CompanyProfile::all();

        $res=[];
        if (session()->has('updated')) {
            $res['updated']=session()->get('updated');
        }
        return view('backend.coupon.list',compact('coupons','coupon','companies'))->with($res);
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
        // validate coupon data
        $validator = Validator::make($request->all(),[
            'code' => 'required|unique:coupons,code,'.$id,
            'qty' => 'required|numeric',
            'discount_percentage' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'companies' => 'required|array',
            'companies.*' => 'required|exists:company_profile,id',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // store coupon data
        $coupon=Coupon::find($id);
        $coupon->code=$request->code;
        $coupon->qty=$request->qty;
        $coupon->discount_percentage=$request->discount_percentage;
        $coupon->start_date=Carbon::parse($request->start_date)->format('Y-m-d');
        $coupon->end_date=Carbon::parse($request->end_date)->format('Y-m-d');
        $coupon->companies=implode(',',$request->companies);
        $coupon->save();

        return redirect()->route('backend.coupon.index')->with([
            'success'=>'Coupon Updated successfully',
            "updated" => true,
        ]);
    }

    // deactivate coupon
    public function deactive($id)
    {
        $coupon=Coupon::find($id);
        $coupon->status=$coupon->status==0 ?1:0;
        $coupon->save();

        return redirect()->back()->with('success','Coupon deactivated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon=Coupon::find($id);
        $coupon->delete();
        return redirect()->back();
    }
}
