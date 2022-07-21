@extends('main')

@section('title', 'Create Product')

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
    <style type="text/css">
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: white !important;
            background-color: #0d6efd;
            padding: 0.2rem;
        }
    </style>
@endsection

@section('content')
    <form enctype="multipart/form-data" method="POST" onsubmit="event.preventDefault(); createproduct();">
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter product's Name">
        </div>
        <div class="form-group col-md-6">
            <label for="barcode">Barcode</label>
            <input type="text" class="form-control" id="barcode" placeholder="Enter product's Barcode">
        </div>
        <div class="form-group col-md-6">
            <label for="category_name">Category Name</label>
            <select id="category_name" class="form-select" aria-label="Default select example">
                @forelse ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @empty
                    <option value="0">No Categories Available</option>
                @endforelse
            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="description">Description </label>
            <textarea id="description" cols="30" rows="10" class="form-control" placeholder="Enter product's Description"></textarea>
        </div>

        <div class="form-group col-md-6">
            <label for="image">Image </label>
            <input type="file" class="form-control" id="image" placeholder="Enter product's Image">
        </div>

        <div class="form-group col-md-6">
            <label for="Keywords">Keywords </label>
            <br>
            <input type="text" data-role="tagsinput" class="form-control" id="keywords"
                placeholder="Enter product's Keywords">
        </div>

        <div class="row">
            <div class="form-group col-md-3">
                <label for="Keywords">Price </label>
                <input type="text" class="form-control" id="price" placeholder="Enter product's Price">
            </div>
            <div class="form-group col-md-3">
                <label for="coin">Coin</label>
                <select id="coin" class="form-select" aria-label="Default select example">
                    <option value="0">Select a Coin</option>
                    @foreach ($coins as $coin)
                        <option value="{{$coin->id}}" @selected($coin->is_virtual)>{{$coin->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="margin-bottom: 20px" class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="active">
            <label class="form-check-label" for="active">Active Status</label>
        </div>
        <button type="submit" id="button-create" class="btn btn-primary col-md-3">Create</button>
        <a href="{{ route('products.index') }}" class="btn btn-danger col-md-3">Cancel</a>
    </form>
@endsection

@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script>
        $(function() {
            $('input')
                .on('change', function(event) {
                    var $element = $(event.target);
                    var $container = $element.closest('.example');

                    if (!$element.data('tagsinput')) return;

                    var val = $element.val();
                    if (val === null) val = 'null';
                    var items = $element.tagsinput('items');

                    $('code', $('pre.val', $container)).html(
                        $.isArray(val) ?
                        JSON.stringify(val) :
                        '"' + val.replace('"', '\\"') + '"'
                    );
                    $('code', $('pre.items', $container)).html(
                        JSON.stringify($element.tagsinput('items'))
                    );
                })
                .trigger('change');
        });
    </script>

    <script>
        function createproduct() {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('barcode', document.getElementById('barcode').value);
            formData.append('category', document.getElementById('category_name').value);
            formData.append('description', document.getElementById('description').value);
            if (document.getElementById('image').files.length > 0) {
                formData.append('image', document.getElementById('image').files[0]);
            }
            formData.append('keywords', document.getElementById('keywords').value);
            formData.append('price', document.getElementById('price').value);
            formData.append('coin', document.getElementById('coin').value);
            formData.append('active', document.getElementById('active').checked ? '1' : '0');

            console.log(formData);

            post("{{ route('products.store') }}", formData, 'button-create', "{{ route('products.index') }}");
        }
    </script>


@endsection