<?php

namespace App\Repositories\Support;

class Search 
{
    public function matches(string $class, array $columns)
    {
        $classInstance = new $class;
        
        $model = $class::query();

        $model->where(function($query) use($classInstance, $columns) {
            foreach ($columns as $column) {
                if(request()->has($column)) $query->orWhere($column, 'like', request()->$column.'%');
            }
        });

        return $model;
    }

    // Todo: build
}