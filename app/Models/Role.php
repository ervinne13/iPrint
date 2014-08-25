<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    const CODE_ADMIN       = "ADMIN";
    const CODE_STORE_OWNER = "STORE";
    const CODE_USER        = "USER";

}
