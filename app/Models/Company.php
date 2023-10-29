<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends BaseModel
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'website',
        'logo',
    ];

    /**
     * Outlets on this company.
     */
    public function outlets(): HasMany
    {
        return $this->hasMany(Outlet::class);
    }
}
