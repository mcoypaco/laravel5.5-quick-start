<?php

namespace App\Repositories;

use App\Repositories\Contracts\Resource;

class UserRepository extends Repository implements Resource
{
    public function collection()
    {
        return 'App\Http\Resources\UserCollection';
    }
    
    public function findBy()
    {
        return ['email'];
    }

    public function model()
    {
        return 'App\User';
    }
}