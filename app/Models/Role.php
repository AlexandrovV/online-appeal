<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Kodeine\Acl\Models\Eloquent\Role as AclRole;

class Role extends AclRole {
    use HasFactory;
}

