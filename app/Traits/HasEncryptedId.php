<?php

namespace App\Traits;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasEncryptedId
{
    /**
     * This Trait used to apply custom encrypted id to get when needed
     */

    /**
     * Get Encrypted Id
     */
    public function getEncryptedId()
    {
        return encrypt($this->id);
    }
}
