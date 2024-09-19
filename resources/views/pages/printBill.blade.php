@extends('index')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Bill for Table: {{ $bill->order->table->table_number }} <span class="float-end">Bill No: {{ $bill->id }}</span></h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Menu Item</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bill->billOrderItems as $item)
                        <tr>
                            <td>{{ $item->menuItem->name }}</td>
                            <td>{{ number_format($item->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Subtotal</th>
                        <td>{{ number_format($bill->total_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Tax</th>
                        <td>{{ number_format($bill->tax, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Discount</th>
                        <td>{{ number_format($bill->discount, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Service Charge</th>
                        <td>{{ number_format($bill->service_charge, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td><strong>{{ number_format($bill->grand_total, 2) }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" onclick="window.print()">Print Bill</button>
            <a class="btn btn-secondary" href="{{ route('bills.index') }}">Back</a>
        </div>
    </div>
</div>

@endsection
