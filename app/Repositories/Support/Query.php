<?php

namespace App\Repositories\Support;

use Illuminate\Http\Request;

class Query 
{
    protected $classInstance, $queryBuilder, $request;

    public function __construct(Request $request)
    {        
        $this->request = $request;
        
        return $this->build();
    }
    
    public function model(string $model)
    {
        $this->classInstance = new $className;
    
        $this->queryBuilder = $className::query();
    }

    protected function build()
    {
        return $this->queryBuilder->where(function($query) {
            foreach($classInstance->fillable as $column) {
                if($this->request()->has($column)) $query->orWhere($column, 'like', request()->$column.'%');
            }
        });
    }
}