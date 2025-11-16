<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasUuids;
    protected $fillable = ['id', 'controller', 'action'];
    public $incrementing = false;
    protected $keyType = 'string';

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }
}
