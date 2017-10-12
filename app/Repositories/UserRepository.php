<?php

namespace App\Repositories;

use App\Repositories\Contracts\{ CanSearch, MustBeUnique };
use App\Repositories\Support\{ Searchable, Unique};

class UserRepository extends Repository implements CanSearch, MustBeUnique
{
    use Searchable, Unique;

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
    
    /**
     * Columns that should be unique in the storage.
     * 
     * @return array
     */
    public function uniqueBy()
    {
        return ['email'];
    }
}