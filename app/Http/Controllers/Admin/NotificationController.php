<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $all_notify = Notification::when(!auth()->user()->hasRole('superadmin'),function($q){
            $q->where('to_user_id',auth()->user()->id);
        })->where('seen',0)->latest()->limit(10)->get();

        return view('backend.partials.notification',compact('all_notify'));
    }

    public function markNotifications()
    {
        $all_notify = Notification::when(!auth()->user()->hasRole('superadmin'),function($q){
            $q->where('to_user_id',auth()->user()->id);
        })->update(array('seen'=>1));

        return redirect()->back();
    }

    public function view(Request $request)
    {   
        $today   = Notification::when(!auth()->user()->hasRole('superadmin'),function($q){
                                $q->where('to_user_id',auth()->user()->id);
                            })
                            ->whereDate('created_at',\Carbon\Carbon::now()
                            ->format('Y-m-d'))
                            ->orderBy('created_at','desc')
                            ->get();

        $earlier = Notification::when(!auth()->user()->hasRole('superadmin'),function($q){
                                $q->where('to_user_id',auth()->user()->id);
                            })
                            ->whereDate('created_at','<',\Carbon\Carbon::now()->format('Y-m-d'))
                            ->orderBy('created_at','desc')
                            ->paginate(10);
        
        return view('backend.notification.list',compact('today','earlier'));
    }

    public function notifyDetail($id,Request $request)
    {

        $notify = Notification::findOrFail($id);
        
        if ( in_array($notify->type,array('event','ticket_sale')) ){
            $data=Event::where('id',$notify->object['event_id'])->first();
            if ($data) {
                return redirect()->route('organizer.event.show',$data->id);
            }
        }elseif( $notify->type=='ticket' ){
            $data=EventTicket::where('id',$notify->object['ticket_id'])->first();
            if ($data) {
                return redirect()->route('organizer.ticket.show',$data->id);
            }
        }elseif($notify->type=='team_member'){
            $data=User::where('id',$notify->object['team_member_id'])->first();
            if ($data) {
                return redirect()->route('organizer.team.show',$data->id);
            }
        }elseif($notify->type=='refund'){
            $data=RefundRequest::where('id',$notify->object['refund_req_id'])->first();
            if ($data) {
                return redirect()->route('organizer.refund_request.show',$data->id);
            }
        }elseif($notify->type=='guest'){
            return redirect()->route('organizer.digital-guest.index');
        }elseif($notify->type=='withdrawal'){
            return redirect()->route('organizer.payment_requests');
        }
        
        $request->session()->flash('error','Data not found.');
        return redirect()->back();
        
        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
