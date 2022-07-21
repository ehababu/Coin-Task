@extends('main')

@section('title', 'All Product')

@section('style')
@endsection

@section('content')



    <a href="{{ route('products.create') }}" class="btn btn-primary">+ Create Product</a>
    <table class="table table-sm table-striped">
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
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td><img src="{{ Storage::url($product->image) }}" width="150"/></td>
                    <td>
                        @foreach ($product->keywords as $keyword)
                        {{$keyword}}
                        <br>
                        @endforeach
                    </td>

                    <td>
                        <button class="btn @if ($product->is_active) btn-success @else btn-danger @endif"
                            onclick="   ({{ $product->id }})" id="{{ $product->id }}">
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
                <td style="text-align: center" colspan="9">No products to be displayed</td>
            @endforelse

        </tbody>
    </table>
@endsection

@section('script')
    <script>
      
        function deleteCoin(id, reference) {
            confirmDelete('/products', id, reference);
        }
    </script>
@endsection