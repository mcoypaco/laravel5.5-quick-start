<?php

namespace App\Repositories\Support;

use Illuminate\Http\Request;

trait Searchable
{
    /**
     * Search for a specific resource in the database.
     * 
     * @param Illuminate\Http\Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        return $this->resourceCollection(
            $this->build($this->model(), $this->findBy())->paginate($this->itemsPerPage())
        );
    }

    /**
     * Builds the search query for the model.
     * 
     * @param string $class
     * @param array $columns
     * @return mixed
     */
    protected function build(string $class, array $columns)
    {
        return $class::query()->where(function($query) use($columns) {
            foreach ($columns as $column) {
                if(request()->has($column)) $query->orWhere($column, 'like', request()->$column.'%');
            }
        }); 
    }
}