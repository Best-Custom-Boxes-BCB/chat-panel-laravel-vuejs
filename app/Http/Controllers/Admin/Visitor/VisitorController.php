<?php

namespace App\Http\Controllers\Admin\Visitor;

use App\Events\notificationEvent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stevebauman\Location\Facades\Location;

class VisitorController extends Controller
{
    public function index(Request $request){
        // return  $ip = $request->channel_name;
        $ip = '182.185.142.240';
        // $ip = '81.109.34.34'; /* england*/
        // $ip = '104.194.28.0'; /* canada*/
        $visitor = Location::get($ip);
        // return $visitor;
        // $verifyIP = Visitor::where('ip_address',$visitor->ip)->first();
        // if($verifyIP){
        //     // user is old fetch visitor info and chats
        //     $old_Chat   =   Chat::with('visitor')->where('id',$verifyIP->id)->first();
        //     // return $old_Chat;
        //     event(new notificationEvent($old_Chat));

        //     return response()->json(
        //         [
        //             'status'    =>  'success',world map
        //             'message'   =>  'Data saved successfully.!',
        //             'data'   =>     $verifyIP
        //         ]
        //     );

        // }else{

            // save the ip_address coming from visitor
            $visitors =  Visitor::create([
                'ip_address'                => $visitor->ip,
                'channel_name'              => $request->channel_name,
                'country_name'              => $visitor->countryName,
                'country_code'              => $visitor->countryCode,
                'region_name'               => $visitor->regionName,
                'region_code'               => $visitor->regionCode,
                'city_name'                 => $visitor->cityName,
                'zip_code'                  => $visitor->zipCode,
                'currency_code'             => $visitor->currencyCode,
                'latitude'                  => $visitor->latitude,
                'longitude'                 => $visitor->longitude,
            ]);

            $chat = new Chat();
            $chat->visitor_id = $visitors['id'];
            $chat->save();

            // fetch the data with visitorInfo using relation for notification

            $Info = Chat::with('visitor')->where('id',$chat->id)->first();
            event(new notificationEvent($Info));

            return response()->json(
                [
                    'status'    =>  'success',
                    'message'   =>  'Data saved successfully.!',
                    'data'   =>     $visitors
                ]
            );
        // }

    }

    public function VisitorPage(){
        $date = date("Y-m-d");  // Aj ka date
        // $visitors = Chat::with('visitor')->whereDate('updated_at', '=', $date)->orderBy('created_at','desc')->get();
        $visitors = Chat::with('visitor','messages')->orderBy('created_at','desc')->get();
        foreach ($visitors as $visitor) {
                $visitor->agent_name = $visitor->getSenderName($visitor->agent_id);
        }
        // return $visitors[1]->messages[0]->message;

        return response()->json([
            'status'    =>  '200',
            'message'   =>  'Record fetched successfully',
            'data'      =>  $visitors
        ]);


        // return $visitors;
        // return view('admin.visitor.live-visitor' ,get_defined_vars());
}
    public function changeStatus($id){
        // return $id;

        $status = Chat::find($id);

        if($status->agent_id == null){
            $status->agent_id = Auth::user()->id;
            $status->status = 'active';
            $status->update();
        }else{
            $status->status = 'active';
            $status->update();
        }


        return response()->json([
            'status'   =>  'success',
            'message'   =>  'Status Changed'
        ]);

        return view('admin.visitor.live-visitor' ,get_defined_vars());
    }







}
