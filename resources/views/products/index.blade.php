@extends('main')

@section('title', 'All Product')

@section('style')
@endsection

@section('content')



    <a href="{{ route('products.create') }}" class="btn btn-primary">+ Create Product</a>
    <table class="table table-sm table-striped ">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Barcode</th>
                <th scope="col">Category Name</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Keywords</th>
                <th scope="col">Status</th>
                <th scope="col">Manage</th>


            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->barcode }}</td>
                    <td>{{ $product->category_id }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->image }}</td>
                    <td>{{ $product->keywords }}</td>

                    <td>
                        <button class="btn @if ($product->is_active) btn-success @else btn-danger @endif"
                            onclick="   ({{ $product->id }})" id="toggle_{{ $product->id }}">
                            {{ $product->active_status }}
                        </button>
                    </td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-primary">Edit</a>
                        <button type="button" onclick="deleteCoin({{ $product->id }}, this)"
                            class="btn btn-outline-danger">Delete</button>
                    </td>
                </tr>
            @empty
                <td style="text-align: center" colspan="7">No products to be displayed</td>
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
                .put(`/products/${id}/toggle`)
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
            confirmDelete('/products', id, reference);
        }
    </script>
@endsection



