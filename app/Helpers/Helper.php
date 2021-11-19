<?php

namespace App\Helpers;
use DB;
use \App\Models\User;

class Helper {
    
    public static function balance ($perDate = null, $startDate = null, $categoryId = null)
    {
        $transactionQuery = DB::table('transactions');

        if ($perDate) {
            $transactionQuery->where('date', '<=', $perDate);
        }
        if ($startDate) {
            $transactionQuery->where('date', '>=', $startDate);
        }
        if ($categoryId) {
            $transactionQuery->where('category_id', $categoryId);
        }

        $transactions = $transactionQuery->where('creator_id', auth()->user()->id)->get();

        return $transactions->sum(function ($transaction) {

            $balance = $transaction->transaction_status_id ? $transaction->amount : -$transaction->amount;

            User::findOrFail(auth()->user()->id)->update([
                'balance' => $balance
            ]);

            return $balance;
        });
    }
}