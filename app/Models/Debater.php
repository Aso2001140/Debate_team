<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debater extends Model
{
    use HasFactory;
    protected $fillable = ["r_id","u_id"];
    protected $primaryKey = 'd_id' ;

    public function insert($user_id,$room_id){
        //1か0かのフラグを生成
        $flag=random_int(0,1);
        //値が含まれていない場合
        if(Debater::where('d_pd')->doesntExist()){
            $insert = Debater::create([
                'r_id'=>$user_id,
                'u_id'=>$room_id,
                'd_pd'=>$flag
            ]);
        }
        //0の値が含まれている場合
        else if(Debater::where('d_pd','0')){
            $insert = Debater::create([
                'r_id'=>$user_id,
                'u_id'=>$room_id,
                'd_pd'=>1
            ]);
        }else {
            $insert = Debater::create([
                'r_id'=>$user_id,
                'u_id'=>$room_id,
                'd_pd'=>0
            ]);
        }
        $insert->save();
    }
}
