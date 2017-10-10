<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface Resource 
{
    public function collection();

    public function findBy();

    public function model();

    public function search(Request $request);
}