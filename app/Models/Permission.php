<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory;

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
