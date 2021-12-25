<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryId = request()->get('category');
        $categories = $this->getCategoryList();
        $year = $this->getYearQuery(request()->get('year'));
        $month = Helper::getMonths();
        $data = $this->getYearlyTransactionSummary($year, auth()->user()->id, $categoryId);


        return view('reports.index', compact('year', 'month', 'data', 'categories', 'categoryId'));
    }

    /**
     * Get correct year from query string.
     *
     * @param  int|string  $yearQuery
     * @return int
     */
    private function getYearQuery($yearQuery)
    {
        return in_array($yearQuery, Helper::getYears()) ? $yearQuery : date('Y');
    }

    /**
     * Get transaction yearly report data.
     *
     * @param  int|string  $year
     * @param  int  $userId
     * @param  int|null  $partnerId
     * @return \Illuminate\Support\Collection
     */
    private function getYearlyTransactionSummary($year, $userId, $categoryId = null) 
    {
        $selectRawQuery = "MONTH(date) AS month, YEAR(date) AS year, count(`id`) AS count, 
            SUM(IF(transaction_status_id = 1, amount, 0)) AS transaction_in, SUM(IF(transaction_status_id = 2, amount, 0)) AS transaction_out";

        $reportQuery = DB::table('transactions')->select(DB::raw($selectRawQuery))
                        ->where(DB::raw('YEAR(date)'), $year)
                        ->where('creator_id', $userId);

        if ($categoryId) {
            $reportQuery->where('category_id', $categoryId);
        }

        $reportData = $reportQuery->orderBy('year', 'asc')
                        ->orderBy('month', 'ASC')
                        ->groupBy(DB::raw('YEAR(date)'))
                        ->groupBy(DB::raw('MONTH(date)'))
                        ->get();

        gettype($reportData);
        $monthNotAssign = 12 - count($reportData);
        $monthExisting = [];

        foreach ($reportData as $one) {
            $monthExisting[] = $one->month;
        }

        for ($i=1; $i<=$monthNotAssign; $i++) {

            $obj = new \stdClass;
            $obj->month = $i;
            $obj->year = $year;
            $obj->count = 0;
            $obj->transaction_in = "0";
            $obj->transaction_out = "0";
            
            if (!in_array($i, $monthExisting)) {
                $reportData->push($obj);
            }   
        }

        $reportData = $reportData->sortBy('month');

        foreach ($reportData as $report) {
            $key = str_pad($report->month, 2, '0', STR_PAD_LEFT);
            $reports[$key] = $report;
            $reports[$key]->difference = $report->transaction_in - $report->transaction_out;
        }

        return collect($reports);
    }
}
