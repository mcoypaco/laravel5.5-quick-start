<?php

namespace App\Repositories;

use App\Repositories\Contracts\CanSearch;
use App\Repositories\Support\Searchable;

class UserRepository extends Repository implements CanSearch
{
    use Searchable;

    /**
     * Path for the Eloquent model.
     * 
     * @var string
     */
    protected $modelPath = 'App\User';
    
    /**
     * Path for the resource of the Eloquent model.
     * 
     * @var string
     */
    protected $resourcePath = 'App\Http\Resources\User';

    /**
     * Path for the resource collection of the Eloquent model.
     * 
     * @var string
     */
    protected $resourceCollectionPath = 'App\Http\Resources\UserCollection';

    /**
     * Column index for searching.
     * 
     * @return array
     */
    public function findBy()
    {
        return ['email'];
    }
}