<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $fillable = ['id_projects',
                        'name',
                        'description',
                        'year',
                        'address',
                        'service_id',
                        'image_1',
                        'image_2',
                        'image_3',
                        'image_4',
                        'image_5',
                    ]; 

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class , 'service_id', 'id');
    }
}
