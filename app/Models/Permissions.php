<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;
    protected $table = 'test_permissions';
    public function users()
    {
        return $this->belongsToMany(User::class, 'test_permisison_user', 'user_id', 'permission_id')->withPivot('permissions');
    }
}
