<?php

namespace App\Traits;

use App\Models\Scopes\OutletScope;
use Illuminate\Database\Eloquent\Model;

trait ScopedOutlet
{
    /**
     * Whether to use outlet scope or not.
     */
    protected static $useOutletScope = true;

    /**
     * Boot the scoped user outlet.
     */
    protected static function bootScopedOutlet(): void
    {
        if (self::$useOutletScope) {
            static::creating(function (Model $model) {
                $model->outlet_id = auth()->check() ? auth()->user()->outlet_id : $model->outlet_id;
            });

            static::addGlobalScope(new OutletScope);
        }
    }

    /**
     * Disable the outlet scope.
     */
    public static function withoutOutletScope(): static
    {
        self::$useOutletScope = false;

        return new static;
    }
}
