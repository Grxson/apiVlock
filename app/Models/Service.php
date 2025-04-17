<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = ['id_services',
                        'name',
                        'status',
                        'image'];

    public function service(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
