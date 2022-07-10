<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    /*protected $fillable = [
        'user_id','message','user_name','room_id'
     ];*/

    //外部キー
    protected $guarded = array('id');

     public function user(){
        return $this->belongsTo(User::class);
      }
}