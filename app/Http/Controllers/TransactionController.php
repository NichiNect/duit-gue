<?php

namespace App\Http\Controllers;

use App\Models\{Category, Transaction};
use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('creator_id', auth()->user()->id)->get();

        $yearMonth = $this->getYearMonth();
        $date = request('date');
        $year = request('year', date('Y'));
        $month = request('month', date('m'));
        $defaultStartDate = explode(' ', auth()->user()->created_at)[0];
        $startDate = $defaultStartDate ? : $year.'-'.$month.'-01';

        $transactions = $this->getTransactions($yearMonth);

        $incomeTotal = $this->getIncomeTotal($transactions);
        $spendingTotal = $this->getSpendingTotal($transactions);

        return view('transactions.index', compact('categories', 'transactions', 'incomeTotal', 'spendingTotal', 'startDate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $transaction = Transaction::create([
            'date' => $request->date,
            'category' => $request->category,
            'description' => $request->description,
            'amount' => $request->amount,
            'category_id' => $request->category ? $request->category : null,
            'transaction_status_id' => $request->transaction_status ? $request->transaction_status : null,
            'creator_id' => auth()->user()->id
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::with('category')->findOrFail($id);

        if (request()->expectsJson()) {
            return response()->json([
                'statusCode' => 200,
                'message' => 'Request successfully.',
                'data' => $transaction
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->update([
            'date' => $request->date,
            'category' => $request->category,
            'description' => $request->description,
            'amount' => $request->amount,
            'category_id' => $request->category ? $request->category : null,
            // 'transaction_status_id' => $request->transaction_status ? $request->transaction_status : null,
            'creator_id' => auth()->user()->id
        ]);

        if (request()->expectsJson()) {
            $transaction = Transaction::with('creator', 'category')->findOrFail($id);

            return response()->json([
                'statusCode' => 200,
                'message' => 'Request successfully.',
                'data' => $transaction
            ]);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
