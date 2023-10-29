<?php

namespace App\Models;

use App\Traits\ScopedCompanyOutlet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Extra extends BaseModel
{
    use HasFactory, SoftDeletes, ScopedCompanyOutlet;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'company_id',
        'outlet_id',
        'name',
        'description',
        'price',
        'image',
        'is_active'
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
