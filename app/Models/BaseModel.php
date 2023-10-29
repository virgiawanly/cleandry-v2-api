<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BaseModel extends Model
{
    use LogsActivity;

    /**
     * The attributes that are searchable in the query.
     */
    protected $searchables = [];

    /**
     * Scope a query to search for a query.
     */
    public function scopeSearch(Builder $query, string $keyword): Builder
    {
        if (!$keyword) {
            return $query;
        }

        return $query->where(function ($subQuery) use ($keyword) {
            // escape the search query for % characters
            $keyword = str_replace('%', '\\%', $keyword);
            foreach ($this->searchables as $searchable) {
                $subQuery->orWhere($searchable, 'LIKE', "%{$keyword}%");
            }
        });
    }

    /**
     * Scope a query to order by a column.
     */
    public function scopeOfOrder(Builder $query, string $sort, string $order): Builder
    {
        if (!$sort) {
            return $query;
        }

        if (!$order) {
            $order = 'asc';
        }

        return $query->orderBy($sort, $order);
    }

    /**
     * Default activity log options.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll()->logOnlyDirty();
    }
}
