<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilters
{
    protected $data;
    protected $builder;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        // dd($this->fields());

        foreach ($this->fields() as $method => $value) {
            if (!method_exists($this, $method)) {
                continue;
            }

            if (strlen($value)) {
                call_user_func_array([$this, $method], (array) $value);
            }
        }

        return $this->builder;
    }

    public function fields()
    {
        return $this->data;
    }
}
