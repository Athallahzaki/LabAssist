<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    protected $fillable = ['group', 'code', 'label'];

    /* ================= QUERY SCOPE ================= */

    public function scopeGroup($query, string $group)
    {
        return $query->where('group', $group);
    }
}
