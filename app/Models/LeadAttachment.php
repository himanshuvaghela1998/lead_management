<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadAttachment extends Model
{
    use HasFactory;

    protected $table = 'leads_attachments';
    function getLead()
    {
        return $this->belongsto(Lead::class,'lead_id','id');
    }
}
