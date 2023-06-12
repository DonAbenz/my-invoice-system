<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class InvoiceFilter extends QueryFilters
{
    public function search(string $terms)
    {
        $query = $this->builder;

        collect(str_getcsv($terms, ' ', '"'))->filter()->each(function ($term) use ($query) {
            $term = $term . '%';

            $query->where(function ($query) use ($term) {
                $query->where('code', 'like', $term)
                    ->orWhere('customer_name', 'like', $term);
                // ->orWhereHas(function ($query) use ($term) {
                // });
            });
        });
    }
    
}
