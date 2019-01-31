<?php

namespace App\Http\Transformers;

use App\Models\Auth\Role;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{
    public function transform(Role $role)
    {
        return [
            'name'  =>  $role->name,
        ];
    }

}