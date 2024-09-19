@extends('index')
@section('content')
<div class="container mt-5">
    <h2 class="text-dark text-center">Bill List</h2>
    <div
        class="table-responsive"
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

</div>
@endsection
