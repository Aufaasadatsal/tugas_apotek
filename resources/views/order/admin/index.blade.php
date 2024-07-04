@extends('layouts.template')

@section('content')
    <div class="my-5 d-flex justify-content-between">
        <form class="d-flex" method="GET" style="width: 350px; display:flex; margin-bottom: -5px;">
            <input class="form-control me-2" type="date" placeholder="Search" name="date" aria-label="Search">
            <button class="btn btn-info me-2" type="submit">Search</button>
            <button class="btn btn-secondary" type="submit">Clear</button>
        </form>

        <a href="{{ route('order.export-excel') }}" class="btn btn-primary">Export Data (excel)</a>
    </div>
    <table class="table table-stripped table-bordered table-dark">
        <thead>
            <tr>
                <th>No</th>
                <th>Pembeli</th>
                <th>Obat</th>
                <th>kasir</th>
                <th>Tanggal Pembelian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ ($orders->currentpage()-1) * $orders->perpage() + $loop->index + 1 }}</td>
                    <td>{{ $order->name_customer }}</td>
                <td>
                    <ol>
                        @foreach($order['medicines'] as $medicine)
                            <li>
                                {{ $medicine['name_medicines']}}
                                ( Rp. {{ number_format($medicine['price'],0,',','.') }} ) :
                                Rp. {{ number_format($medicine['sub_price'],0,',','.') }}
                                <small>QTY {{ $medicine['qty'] }}</small>
                            </li>
                        @endforeach
                    </ol>
                </td>
                <td>{{ $order['user']['name'] }}</td>
                @php
                    setlocale(LC_ALL, 'IND');
                @endphp
                <td>{{ Carbon\Carbon::parse($order->created_at)->formatlocalized('%d %B %Y')}}</td>
                <td> <a href="{{ route('order.export-excel', $order['id']) }}" class="btn btn-secondary">Unduh (.pdf)</a> </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection