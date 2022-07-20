@extends('main')

@section('title','Edit Category')

@section('style')
    
@endsection

@section('content')


        <form onsubmit="event.preventDefault(); updateCategory();">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter category's Name" value="{{$category->name}}">
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="active" @checked($category->is_active)>
                <label class="form-check-label" for="active">Active Category</label>
            </div>
            <button type="submit" id="button-update" class="btn btn-primary col-md-3">Update</button>
            <a href="{{route('categories.index')}}" class="btn btn-danger col-md-3">Cancel</a>
        </form>
            
@endsection

@section('script')

        <script>
            function updateCategory() {
                let data = {
                    name: document.getElementById('name').value,
                    active: document.getElementById('active').checked

                }
                update("{{route('categories.update', $category)}}", data, "button-update", "{{route('categories.index')}}")
            }
        </script>
    
@endsection