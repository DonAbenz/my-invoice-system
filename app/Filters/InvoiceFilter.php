<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class InvoiceFilter extends QueryFilters
{
    public function search(string $data = null)
    {
        $query = $this->builder;

        $query->when($data, function ($query, $search) {

            if (strlen($search) > 3) {
                $query->selectRaw('*, match(code, customer_name) against(? in boolean mode) as score', [$search])
                    ->whereRaw('match(code, customer_name) against(? in boolean mode)', [$search]);
            } else {
                $query->where('code', 'LIKE', "%{$search}%")
                    ->orWhere('customer_name', 'LIKE', "%{$search}%");
            }
        }, function ($query) {
            $query->latest();
        });
    }
}
