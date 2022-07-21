@extends('main')

@section('title', 'All Coins')

@section('style')
@endsection

@section('content')



    <a href="{{ route('coins.create') }}" class="btn btn-primary">+ Create Coins</a>
    <table class="table table-sm table-striped ">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Token</th>
                <th scope="col">Dec Num</th>
                <th scope="col">Virtual</th>
                <th scope="col">Status</th>
                <th scope="col">Manage</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($coins as $coin)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $coin->name }}</td>
                    <td>{{ $coin->token }}</td>
                    <td>{{ $coin->max_decimal_numbers }}</td>
                    <td>{{ $coin->virtual_status }}</td>
                    <td>
                        <button class="btn @if ($coin->is_active) btn-success @else btn-danger @endif"
                            onclick="   ({{ $coin->id }})" id="{{ $coin->id }}">
                            {{ $coin->active_status }}
                        </button>
                    </td>
                    <td>
                        <a href="{{ route('coins.edit', $coin) }}" class="btn btn-outline-primary">Edit</a>
                        <button type="button" onclick="deleteCoin({{ $coin->id }}, this)"
                            class="btn btn-outline-danger">Delete</button>
                    </td>
                </tr>
            @empty
                <td style="text-align: center" colspan="7">No Coins to be displayed</td>
            @endforelse

        </tbody>
    </table>
@endsection

@section('script')
    <script>
       
        function deleteCoin(id, reference) {
            confirmDelete('/coins', id, reference);
        }
    </script>
@endsection



