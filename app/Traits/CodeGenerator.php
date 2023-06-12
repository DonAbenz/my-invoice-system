<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait CodeGenerator
{
    protected function generateCode($table)
    {
        $permittedChars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($table === 'users') $permittedChars = '0123456789';
        if ($table === 'accounts') $permittedChars = '0123456789';
        $vendorid = substr(str_shuffle($permittedChars), 1, 10);
        $validate = DB::table($table)->where('code', $vendorid)->first();
        if ($validate) {
            $this->generateCode($table);
        }
        return $vendorid;
    }
}
