@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-3">
        <div class="col-md-8">
            <h2>Transaction List</h2>
            <h5>Total Transaction: {{ count($transactions) }}</h5>
        </div>
        <div class="col-md-4 text-right">
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addIncome"><i class="fas fa-plus"></i> Add Income</a>
            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#addSpending"><i class="fas fa-minus"></i> Add Spending</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-header">Income</div>
                <div class="card-body">
                    <h5>Rp. {{ number_format($incomeTotal) }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-header">Spending</div>
                <div class="card-body">
                    <h5>Rp. {{ number_format($spendingTotal) }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-header">Different</div>
                <div class="card-body">
                    <h5>Rp. {{ number_format($incomeTotal - $spendingTotal) }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-md-12">
            <x-alert></x-alert>
        </div>
    </div>

    <div class="row justify-content-center my-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-12">
                            <form action="" method="get" class="form-inline">
                                <input type="text" name="query" class="form-control mx-2" placeholder="Search transaction..">
                                <select name="date" id="date" class="form-control">
                                    <option value="" selected disabled>-- Date --</option>
                                    <option value="">--Not Choice--</option>
                                    @foreach (Helper::getDates() as $date)
                                        <option value="{{ $date }}" @if (request('date') != null && $date == request('date'))
                                            selected
                                        @endif>{{ $date }}</option>
                                    @endforeach
                                </select>
                                <select name="month" id="month" class="form-control mx-2">
                                    @php
                                        $month = Helper::getMonths();
                                    @endphp
                                    @for ($i = 0; $i < count($month); $i++)
                                        <option value="{{ $month[$i] }}" @if (request('month') != null && $month[$i] == request('month')) 
                                        selected 
                                        @elseif (!request('month') && $month[$i] == date('F', time()))
                                        selected
                                        @endif>{{ $month[$i] }}</option>
                                    @endfor
                                </select>
                                <select name="year" id="year" class="form-control text-center content-center mx-2" style="max-width: 80%">
                                    @php
                                        $years = Helper::getYears();
                                    @endphp
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}" @if ($year == date('Y', time())) selected @endif>{{ $year }}</option>
                                    @endforeach
                                </select>
                                <select name="category" id="category" class="form-control mx-2">
                                    <option value="" selected disabled>-- Category --</option>
                                    <option value="">--Not Choice--</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->id }} - {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary mx-2">Submit</button>
                                <button type="reset" class="btn btn-secondary mx-2">Reset</button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Transaction Status</th>
                                        <th>Transaction Description</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $key => $transaction)
                                    <tr>
                                        <td>
                                            {{-- {{ $transactions->count() * ($transactions->currentPage() - 1) + $loop->iteration }} --}}
                                            {{ $key+=1 }}
                                        </td>
                                        <td>{{ $transaction->date }}</td>
                                        <td>
                                            <p class="font-italic">{{ $transaction->transaction_status->status_name }}</p>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                {{ $transaction->description }}
                                                @if ($transaction->category)
                                                <a href="{{ route('transactions.index') }}?category={{ $transaction->category->id }}">
                                                    <div class="badge badge-{{ $transaction->category->color }} badge-sm py-2">{{ $transaction->category->name }}</div>
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            @if ($transaction->transaction_status_id == 2)
                                                -
                                            @endif
                                            Rp. {{ number_format($transaction->amount) }}
                                        </td>
                                        <td>
                                            <a class="btn btn-link" id="editbutton" data-url="{{ route('transactions.show', $transaction->id) }}" data-urlupdate="{{ route('transactions.update', $transaction->id) }}">Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-right">Income Total</th>
                                        <th class="text-right">Rp. {{ number_format($incomeTotal) }}</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-right">Spending Total</th>
                                        <th class="text-right">Rp. {{ number_format($spendingTotal) }}</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-right">Final Total</th>
                                        <th class="text-right">Rp. {{ number_format($incomeTotal - $spendingTotal) }}</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-modal name="addIncome" action="{{ route('transactions.store') }}" method="post" title="Add Income Transaction" okButton="Add Income" okButtonColorClass="success" closeButton="Close" closeButtonColorClass="secondary">
    <input type="hidden" name="transaction_status" value="1">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" class="form-control" id="date" value="{{ date('d-m-Y', time()) }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    <option value="" selected disabled>-- Category --</option>
                    <option value="">--Not Choice--</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->id }} - {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="amount">Amount</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Rp.</div>
                    </div>
                    <input type="number" name="amount" class="form-control" id="amount">
                </div>
            </div>
        </div>
    </div>
</x-modal>


<x-modal name="addSpending" action="{{ route('transactions.store') }}" method="post" title="Add Spending Transaction" okButton="Add Spending" okButtonColorClass="danger" closeButton="Close" closeButtonColorClass="secondary">
    <input type="hidden" name="transaction_status" value="2">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" class="form-control" id="date" value="{{ date('d-m-Y', time()) }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    <option value="" selected disabled>-- Category --</option>
                    <option value="">--Not Choice--</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->id }} - {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="amount">Amount</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Rp.</div>
                    </div>
                    <input type="number" name="amount" class="form-control" id="amount">
                </div>
            </div>
        </div>
    </div>
</x-modal>


<x-modal name="updateTransaction" method="post" title="Edit Transaction" okButton="Edit" okButtonColorClass="primary" closeButton="Close" closeButtonColorClass="secondary">
    @csrf
    @method('put')
    {{-- <input type="hidden" name="transaction_status" value="2"> --}}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" class="form-control" id="date" value="{{ date('d-m-Y', time()) }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="amount">Amount</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Rp.</div>
                    </div>
                    <input type="number" name="amount" class="form-control" id="amount">
                </div>
            </div>
        </div>
    </div>
</x-modal>

@endsection

@section('script')
<script>
    $(document).ready(function() {

        $('table td #editbutton').on('click', async function (e) {

            e.preventDefault();
            let url = $(this).data('url');

            let transaction = await axios.get(url);

            if (transaction.status == 200) {

                let categories = await axios.get(`{{ route('categories.index') }}`);

                if (categories.status == 200) {

                    $('#updateTransaction form #date').val(transaction.data.data.date);
                    $('#updateTransaction form #description').val(transaction.data.data.description);
                    $('#updateTransaction form #amount').val(transaction.data.data.amount);
                    let options = $('#updateTransaction form #category');

                    options.html(`
                    <option value="">-- Not Choice --</option>
                    ${
                        categories.data.data.map((one) => {

                            let selected = (transaction.data.data.category_id == one.id) ? 'selected' : '';

                            return `<option value="${one.id}" ${selected}>${one.id} - ${one.name}</option>`
                        })
                    }
                    `);
                }
            }

            let urlUpdate = $(this).data('urlupdate');

            let form = $('#updateTransaction form').attr('action', urlUpdate);
            console.log(urlUpdate);

            $('#updateTransaction').modal('show');

        });

    });
</script>
@endsection
