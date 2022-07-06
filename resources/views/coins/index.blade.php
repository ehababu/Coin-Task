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
                            onclick="toggleCoin({{ $coin->id }})" id="toggle_{{ $coin->id }}">
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
        function toggleCoin(id) {
            let btn = document.getElementById(`toggle_${id}`);
            btn.disabled = true;
            axios
                .put(`/coins/${id}/toggle`)
                .then(function(response) {
                    toastr.success(response.data.message);
                    if (response.data.status == 1) {
                        btn.setAttribute('class', 'btn btn-success');
                        btn.innerHTML = 'Active';
                    } else {
                        btn.setAttribute('class', 'btn btn-danger');
                        btn.innerHTML = 'Inactive';
                    }
                    btn.disabled = false;
                })
                .catch(function(error) {
                    btn.disabled = false;
                    toastr.error(error.response.data.message);
                });
        }

        function deleteCoin(id, reference) {
            confirmDelete('/coins', id, reference);
        }
    </script>
@endsection



@section('script')
<script>
        function toggleCoin(id) {
            let btn = document.getElementById(`toggle_${id}`);
            btn.disabled = true;
            axios
                .put(`/coins/${id}/toggle`)
                .then(function(response) {
                    toastr.success(response.data.message);
                    if (response.data.status == 1) {
                        btn.setAttribute('class', 'btn btn-success');
                        btn.innerHTML = 'Active';
                    } else {
                        btn.setAttribute('class', 'btn btn-danger');
                        btn.innerHTML = 'Inactive';
                    }
                    btn.disabled = false;
                })
                .catch(function(error) {
                    btn.disabled = false;
                    toastr.error(error.response.data.message);
                });
        }

        function deleteCoin(id, reference) {
            confirmDelete('/coins', id, reference);
  }
    
@endsection