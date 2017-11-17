<?php

namespace App\Repositories;

use Illuminate\Http\Request;

use App\Repositories\Contracts\{ CanSearch, MustBeUnique };
use App\Repositories\Support\{ Searchable, Unique};
use App\User;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\Resource
     */
    public function create(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return $this->resource($user);
    }

    /**
     * Show the autheticated user's details in a resource form.
     * 
     * @param \App\User $user
     * @return \Illuminate\Http\Resources\Json\Resource
     */
    public function authenticated(User $user)
    {
        return $this->resource($user);
    }
}