<?php

namespace App\Repositories;

use Illuminate\Http\Request;

use App\Repositories\Support\Search;

class Repository 
{
    protected $limit = 10;

    protected $search;

    public function __construct(Search $search)
    {
        $this->search = $search;
    }

    /**
     * Search for a specific user in the database.
     * 
     * @param Illuminate\Http\Request $request
     * @return \App\Http\Resources\UserCollection
     */
    public function search(Request $request)
    {
        $users = $this->search->matches($this->model(), $this->findBy())->paginate($this->limit);

        $collection = $this->collection();

        return new $collection($users);
    }
}