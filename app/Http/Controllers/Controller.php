<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use \App\Models\{Transaction, Category};

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Get List of Category
     */
    protected function getCategoryList()
    {
        return Category::orderBy('name')->where('is_active', 1)->get();
    }

    /**
     * Get Transactions
     */
    public function getTransactions($yearMonth) {

        $categoryId = request('category');

        $transactionQuery = Transaction::query();
        $transactionQuery->where('date', 'like', $yearMonth .'%');
        
        if (request('query')) {

            $transactionQuery = $transactionQuery->where('description', 'like', '%' . request('query') . '%');
        }

        $transactionQuery->when($categoryId, function ($qb, $categoryId) {
            if ($categoryId == null) {
                $qb->whereNull('category_id');
            } else {
                $qb->where('category_id', $categoryId);
            }
        });

        return $transactionQuery->orderBy('date', 'desc')->with('category')->get();
    }

    /**
     * Get income total of a transaction listing
     */
    protected function getIncomeTotal($transactions) {

        return $transactions->sum(function ($transaction) {
            return ($transaction->transaction_status_id == 1) ? $transaction->amount : 0;
        });
    }

    /**
     * Get spending total of a transaction listing
     */
    protected function getSpendingTotal($transactions) {

        return $transactions->sum(function ($transaction) {
            return ($transaction->transaction_status_id == 2) ? $transaction->amount : 0;
        });
    }

    /**
     * Prepare yearMonth raw data
     */
    protected function getYearMonth() {

        $date = request('date');
        $year = request('year', date('Y'));
        $month = request('month', date('m'));
        $getMonth = Helper::getMonths();

        for ($i=0; $i<count($getMonth); $i++) {

            if($getMonth[$i] == $month) {
                // if(strlen((string)$i) == 1) {
                //     $month = "0" . $i+1;
                // } else {
                    $month = $i+1;
                // }
            }
        }

        $yearMonth = $year.'-'.$month;

        $explodedYearMonth = explode('-', $yearMonth);

        if (count($explodedYearMonth) == 2 && checkdate($explodedYearMonth[1], 01, $explodedYearMonth[0])) {

            if (checkdate($explodedYearMonth[1], $date, $explodedYearMonth[0])) {
                
                if (strlen($explodedYearMonth[1]) == 1) {

                    $zeroPaddingMonth = $explodedYearMonth[1] = '0' . $explodedYearMonth[1];
                    return $explodedYearMonth[0].'-'.$zeroPaddingMonth.'-'.$date;
                } else {

                    return $explodedYearMonth[0].'-'.$explodedYearMonth[1].'-'.$date;
                }

            }

            if (strlen($explodedYearMonth[1]) == 1) {

                $zeroPaddingMonth = $explodedYearMonth[1] = '0' . $explodedYearMonth[1];
                return $explodedYearMonth[0].'-'.$zeroPaddingMonth;
            } else {

                return $explodedYearMonth[0].'-'.$explodedYearMonth[1];
            }

        }

        return date('Y-m');
    }
}
