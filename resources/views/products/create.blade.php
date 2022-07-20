@extends('main')

@section('title', 'Create Product')

@section('style')
@endsection

@section('content')
    <form  enctype="multipart/form-data"
        onsubmit="event.preventDefault(); createproduct();">
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter product's Name">
        </div>
        <div class="form-group col-md-6">
            <label for="barcode">Barcode</label>
            <input type="file" class="form-control" id="barcode" placeholder="Enter product's Barcode">
        </div>
        <div class="form-group col-md-6">
            <label for="category_name">Category Name</label>
            <select class="form-select" aria-label="Default select example">
                @foreach ($categoris as $category )
                <option value="{{$category->name}}">{{$category->name}}</option>
                @endforeach
              </select>
        </div>

        <div class="form-group col-md-6">
            <label for="description">Description </label>
            <input type="text" class="form-control" id="description" placeholder="Enter product's Description">
        </div>

        <div class="form-group col-md-6">
            <label for="image">Image </label>
            <input type="file" class="form-control" id="image" placeholder="Enter product's Image">
        </div>

        <div class="form-group col-md-6">
            <label for="Keywords">Keywords </label>
            <input type="text" class="form-control" id="Keywords" placeholder="Enter product's Keywords">
        </div>


        <div style="margin-bottom: 20px" class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="active">
            <label class="form-check-label" for="active">Active Status</label>
        </div>
        <button type="submit" id="button-create" class="btn btn-primary col-md-3">Create</button>
        <a href="{{route('products.index')}}" class="btn btn-danger col-md-3">Cancel</a>
    </form>
@endsection

@section('script')
    <script>
        function createproduct() {
            alert('rr');

            let data = {
                name: document.getElementById('name').value,
                barcode: document.getElementById('barcode').value,
                category_id: document.getElementById('category_name').value,
                description: document.getElementById('description').value,
                image: document.getElementById('image').value,
                Keywords: document.getElementById('Keywords').value,
                active: document.getElementById('active').checked
            }
            console.log(data);

            post("{{route('products.store')}}",data, 'button-create', "{{route('products.index')}}");
        }
    </script>
@endsection
