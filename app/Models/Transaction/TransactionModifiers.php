<?php

namespace App\Models\Transaction;

trait TransactionModifiers
{
    public function getStatusAttribute($is_active)
    {
        return $is_active ? 'موفق' : 'ناموفق';
    }
}
