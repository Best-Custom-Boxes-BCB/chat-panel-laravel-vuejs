<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'from',
        'message'
    ];

    /**
     * Get the chat tha the Message
     *
     * @return \Illuminate\Chat\Eloquent\Relations\BelongsTo
     */
    public function chat()
    {
        return $this->belongsTo(Chat::class, 'chat_id', 'id');
    }

    function getSenderName($id){
        $name = User::where('id',$id)->first('name');
        if($name){
            return $name->name;
        }else{
            $name = Visitor::where('id',$id)->first('id');
            if($name){
                $chat = Chat::where('visitor_id',$name->id)->first();
                return 'Visitor #'.$chat->id;
            }else{
                return 'Unknown';
            }
        }
    }

}
