<?php

namespace App\Models;

use App\Traits\ScopedCompanyOutlet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends BaseModel
{
    use HasFactory, SoftDeletes, ScopedCompanyOutlet;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'service_type_id',
        'company_id',
        'outlet_id',
        'image',
        'estimated_time',
        'estimated_time_unit',
        'is_active',
    ];

    /**
     * Company of the extra.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Outlet of the extra.
     */
    public function outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class);
    }
}
