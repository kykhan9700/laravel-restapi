<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Profile extends Model
{
    protected $table = "profiles";
    protected $primaryKey = "id";

    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'email',
        'gender',
        'merital_status',
        'dob',
        'address',
        'city',
        'state',
        'zip',
        'phone'
    ];

    /*TODO have to define relation between profile table and candidate metadata table*/
    public function visa_status(){
        return $this->hasOne("candidate_metadata");
    }
    /*DOB check */
    public function dob_check(){
        //    $curr_date = date(Y:h:m, strtotime(date()));

    }

}
