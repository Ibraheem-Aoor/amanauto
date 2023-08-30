<?php

namespace App\Traits;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Trackable
{
    /**
     * This Trait used for Admin track relation "addedBy"
     */

    public function addedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }
}
