<?php

namespace App\Repositories\Support;

use Illuminate\Http\Request;

trait Unique
{
    /**
     * Check in the specified resource exists in the storage.
     * 
     * @param \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function checkDuplicate(Request $request)
    {
        return response()->json(
            $this->checkDuplicateQuery($this->model(), $this->findBy(), $request)->first() ? true : false
        );
    }

    /**
     * Builds the search query for the model.
     * 
     * @param string $class
     * @param array $columns
     * @return mixed
     */
    protected function checkDuplicateQuery(string $class, array $columns, Request $request)
    {
        return $class::query()->where(function($query) use($columns, $request) {
            foreach ($columns as $column) {
                if($request->has($column)) $query->where($column, $request->$column);
            }
        }); 
    }
}
