<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_title',
        'project_type_id',
        'status',
        'source_id',
        'billing_type',
        'time_estimation',
        'cost_estimation',
        'lead_details',
    ];

    public function clients()
    {
        return $this->belongsTo(Client::class, 'id', 'lead_id');
    }

    public function projectType()
    {
        return $this->belongsTo(ProjectType::class, 'project_type_id', 'id');
    }
}
