<?php

namespace App\Models;

use App\Traits\ScopedCompany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outlet extends BaseModel
{
    use HasFactory, SoftDeletes, ScopedCompany;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'company_id',
    ];

    /**
     * Get the company that owns the outlet.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
