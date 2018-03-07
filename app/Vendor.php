<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = "vendors";
    protected $primaryKey = "id";

    protected $fillable = [
        'id',
        'name',
        'type',
        'contract',
        'expire_date',
        'account_details',
        'address',
        'city',
        'state',
        'zip',
    ];





}
