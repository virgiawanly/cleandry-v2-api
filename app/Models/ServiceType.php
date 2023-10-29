<?php

namespace App\Models;

use App\Traits\ScopedCompanyOutlet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceType extends BaseModel
{
    use HasFactory, SoftDeletes, ScopedCompanyOutlet;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'is_active'
    ];
}
