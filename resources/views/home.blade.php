@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-3">
        <div class="col-md-4">
            <h2>Transaction List</h2>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4 text-right">
        {{-- <div class=""> --}}
                <a href="#" class="btn btn-success">Add Income</a>
                <a href="#" class="btn btn-danger">Add Spending</a>
            {{-- </div> --}}
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-header">Income</div>
                <div class="card-body">
                    {{ Helper::balance() }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-header">Spending</div>
                <div class="card-body">
                    {{ Helper::balance() }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-header">Different</div>
                <div class="card-body">
                    {{ Helper::balance() }}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center my-5">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-12">
                            <form action="" method="get" class="form-inline">
                                <input type="text" name="query" class="form-control mx-2" placeholder="Search transaction..">
                                <select name="month" id="month" class="form-control mx-2">
                                    @php
                                        $month = Helper::getMonths();
                                    @endphp
                                    @for ($i = 0; $i < count($month); $i++)
                                        <option value="{{ $month[$i] }}" @if ($month[$i] == date('F', time())) selected @endif>{{ $month[$i] }}</option>
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
                                </select>
                                <button type="submit" class="btn btn-primary mx-2">Submit</button>
                                <button id="reset" class="btn btn-secondary mx-2">Reset</button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Transaction Description</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
