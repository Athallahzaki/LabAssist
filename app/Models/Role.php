<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['role_code', 'role_label'];

    /* ================= RELATIONSHIP ================= */

    public function users()
    {
        return $this->hasMany(User::class);
    }

    /* ================= CONSTANT ================= */

    public const ADMIN_CODE = 'admin';
    public const STUDENT_CODE = 'student';
}
