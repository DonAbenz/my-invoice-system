<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class InvoiceFilter extends QueryFilters
{
    public function search(string $data)
    {
        $query = $this->builder;

        $query->selectRaw('*, match(code, customer_name) against(? in boolean mode) as score', [$data])
            ->whereRaw('match(code, customer_name) against(? in boolean mode)', [$data]);
    }
}
