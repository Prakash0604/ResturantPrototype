@extends('index')
@section('content')
<div class="container mt-5">
    <h2 class="text-dark text-center">Bill List</h2>
    <div class="container bg-white">
        <form action="{{ route('bills.index') }}" method="get">
            <div class="row">
           <div class="mb-3 col-5">
            <label for="" class="form-label">Starting Date</label>
            <input
                type="date"
                name="start_date"
                id=""
                class="form-control"
                placeholder=""
                value="{{ request('start_date') }}"
                aria-describedby="helpId"
            />
           </div>
           <div class="mb-3 col-5">
            <label for="" class="form-label">Ending Date</label>
            <input
                type="date"
                name="end_date"
                id=""
                class="form-control"
                placeholder=""
                 value="{{ request('end_date') }}"
                aria-describedby="helpId"
            />
           </div>
           <div class="mb-3 col-2 mt-2">
           <button class="btn btn-primary mt-4">Filter</button>
           <a href="{{ route('bills.index') }}" class="btn btn-secondary mt-4">Clear</a>
        </div>
        </div>
        </form>
    </div>
    <div
        class="table-responsive mt-3"
    >
        <table
            class="table table-primary"
        >
            <thead>
                <tr>
                    <th scope="col">SN</th>
                    <th scope="col">Table No</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $n=1;
                @endphp
                @foreach($bills as $bill)
                <tr>
                    <td>{{ $n++ }}</td>
                    <td>{{ $bill->order->table->table_number }}</td>
                    <td>{{ number_format($bill->grand_total, 2) }}</td>
                    <td>
                        <a href="{{ route('bills.view', $bill->order_id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('bills.print', $bill->order_id) }}" class="btn btn-primary" target="_blank">Print</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $bills->links() }}
    </div>

</div>
@endsection
