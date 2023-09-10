<?php

namespace App\Traits;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasStatus
{
    /**
     * This Trait used to apply status scope for a model
     */

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
