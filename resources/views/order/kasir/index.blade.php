@extends('layouts.template')

@section('content')
    <div class="container mt-3">
        <form class="d-flex" method="GET" style="width: 350px; display:flex; margin-bottom:-35px;">
            <input class="form-control me-2" type="date" placeholder="Search" name="date" aria-label="Search">
            <button class="btn btn-info me-2" type="submit">Search</button>
            <button class="btn btn-secondary" type="submit">Clear</button>
        </form>
        <div class="d-flex justify-content-end">
            <a href="{{ route('kasir.order.create') }}" class="btn btn-primary" style="margin-bottom: 12px;">Pembelian Baru</a>
        </div>
    </div>
    <table class=" table table-striped table-bordered table-hover table-dark">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Pembeli</th>
                <th>Obat</th>
                <th>Total Bayar</th>
                <th>Kasir</th>
                <th>Tanggal Pembeli</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($orders as $item)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $item['name_customer']}}</td>
                <td>
                @foreach($item['medicines'] as $medicine)
                    <ol>
                        <li>
                            {{ $medicine['name_medicines'] }} ( {{ number_format($medicine['price'],0,',','.') }} ) : Rp. {{ number_format
                            ($medicine['sub_price'],0,',','.') }} <small>QTY     {{ $medicine['qty'] }}</small>
                        </li>
                    </ol>
                @endforeach
            </td>
            <td>
                Rp. {{ number_format($item['total_price'],0,',','.') }}
            </td>
            <td>{{ $item['user'] ['name'] }}</td>
            <td>{{ $item['created_at']->translatedFormat('d F Y') }}</td>
            <td>
                <a href="{{ route('kasir.order.download', $item['id']) }}" class="btn btn-secondary">Download Setruk</a>
            </td>
        </tr>

            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            @if ($orders->count())
                {{ $orders->links() }}
            @endif
        </div>
    </div>
@endsection