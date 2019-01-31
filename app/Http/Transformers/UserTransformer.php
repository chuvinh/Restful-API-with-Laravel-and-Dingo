<?php

namespace App\Http\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public $availableIncludes = [
        'roles',
    ];

    protected $defaultIncludes = [
        'roles',
    ];

    public function transform(User $user)
    {
        return [
            'id'    =>  $user->id,
            'name'  =>  $user->name,
            'email' =>  $user->email,
        ];
    }

    //the function name should be include and include name
    public function includeRoles(User $user)
    {
        return $this->collection($user->roles, new RoleTransformer);
    }
}