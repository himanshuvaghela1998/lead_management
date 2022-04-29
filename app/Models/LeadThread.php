<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadThread extends Model
{
    use HasFactory;

    protected $appends = ['secret'];
    
    public function getSecretAttribute()
    {
        $encrypted_string=openssl_encrypt($this->id,config('services.encryption.type'),config('services.encryption.secret'));
        return base64_encode($encrypted_string);
    }
    
    function getLead()
    {
        return $this->belongsto(Lead::class,'lead_id','id');
    }
}
