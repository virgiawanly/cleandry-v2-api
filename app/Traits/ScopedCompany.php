<?php

namespace App\Traits;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

trait ScopedCompany
{
    /**
     * Whether to use company scope or not.
     */
    protected static $useCompanyScope = true;

    /**
     * Boot the scoped user company.
     */
    protected static function bootScopedCompany(): void
    {
        if (self::$useCompanyScope) {
            static::creating(function (Model $model) {
                $model->company_id = auth()->check() ? auth()->user()->company_id : $model->company_id;
            });

            static::addGlobalScope(new CompanyScope);
        }
    }

    /**
     * Disable the company scope.
     */
    public static function withoutCompanyScope(): static
    {
        self::$useCompanyScope = false;

        return new static;
    }
}
