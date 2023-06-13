<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class InvoiceFilter extends QueryFilters
{
    public function search(string $data = null)
    {
        $query = $this->builder;

        $query->when($data, function ($query, $search) {
            $query->selectRaw('*, match(code, customer_name) against(? in boolean mode) as score', [$search])
                ->whereRaw('match(code, customer_name) against(? in boolean mode)', [$search]);
        }, function ($query) {
            $query->latest();
        });
    }
}
