<?php

namespace App\Http\Controllers\Admin\Chat;

use App\Events\MyEvent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(){
        $visitors = Chat::with('visitor')->orderBy('created_at','desc')->get();
        // return $visitors;
        return view('admin.chats.index',get_defined_vars());
    }

    public function message(Request $request){
        // return $request->all();

        $message = $request->message;
        $username = $request->username;
        $channel_name = $request->channel_name;
        $visitor_id = $request->visitor_id;
        event(new MyEvent($message,$username,$channel_name));


        $chat = Chat::where('visitor_id',$visitor_id)->first();

        if($request->agent_id){
            $agent_id = $request->agent_id;

            // save the message
            Message::create([
                'chat_id'   =>  $chat->id,
                'from'      =>  $agent_id,
                'message'   =>  $message
            ]);

        }else{

           $chat = Chat::where('visitor_id',$visitor_id)->first();
            $chat->status = 'deactive';
            $chat->update();
 // if message sent from user side

            Message::create([
                'chat_id'   =>  $chat->id,
                'from'      =>  $visitor_id,
                'message'   =>  $message
            ]);
        }







        // $agent_id = Auth::user()->id;

        // event(new MyEvent($message,$username,$channel_name));
        // return "data sent to pusher";

        return response()->json(
            [
                'status'    =>  'success',
                'message'   =>  'Message sent successfully to pusher!',
                'data'      =>  $message
            ]
        );
    }

    public function getVisitorInfo(Request $request){
        // return $request->id;
        $visitor = Chat::with('visitor')->where('visitor_id',$request->id)->first();
            $visitor->sender_name = $visitor->getSenderName($visitor->agent_id);


        // return $visitor;

        return response()->json(
            [
                'status'    =>  '200',
                'message'   =>  'Visitor data fetched successfully!',
                'data'      =>  $visitor
            ]
        );
    }




    public function checkMessage(Request $request)
    {
        // return $request->all();
        $ipaddress = $request->ipaddress;
        $visitor_id = $request->id;
    //    $agent_id = Auth::user()->id;

       $checkmessage = Chat::where('visitor_id',$visitor_id)->first();
    //    return $checkmessage;

       if($checkmessage)
       {
            $messages = Message::with('chat')->where('chat_id',$checkmessage->id)->get();
            foreach ($messages as $message) {
                $message->sender_name = $message->getSenderName($message->from);
            }
            // return $messages;
            // $chats = Chat::where('visitor_id',$visitor_id)->where('ip_address',$ipaddress)->get();
        // return $messages;
            return response()->json(
                [
                    'status'    =>  'success',
                    'message'   =>  'Old user joined the Chat',
                    'data' => $messages
                ]
            );
       }
       else{
            return response()->json(
                [
                    'status'    =>  'success',
                    'message'   =>  'New User joined the Chat'
                ]
            );
        }

    }


public function tabClose(Request $request){
    // return

    // $chat = Chat::where('id',207)->first();
    // $chat->agent_id = $channel_name;
    // $chat->update();

    $message = 'user left';
    $username = 'exited';
    $channel_name = $request->channel_name;


    $chat = Chat::where('visitor_id',$request->visitor_id)->first();
    Message::create([
        'chat_id'   =>  $chat->id,
        'from'      =>  $chat->visitor_id,
        'message'   =>  $message
    ]);
    
    event(new MyEvent($message,$username,$channel_name));


    return response()->json(
        [
            'status' => 'true',
            'message'   =>  'user left',
            'data'  => $request->all()
        ]
    );
}


}
