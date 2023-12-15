<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'visitor_id ',
        'message',
        'ip_address',
    ];

    /**
     * Get the user associated with the Chat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'visitor_id', 'id');
    }

    /**
     * Get all of the messages for the Chat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'chat_id', 'id');
    }

    function getSenderName($id){
        $name = User::where('id',$id)->first('name');
        if($name){
            return $name->name;
        }else{
            return 'Unknown';
        }
    }

}
