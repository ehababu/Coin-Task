@extends('main')


@section('title','Create Categories')
@section('style')
    
@endsection


@section('content')
        <form onsubmit="event.preventDefault(); createCategory();">
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Category's Name">
        </div>

        <div style="margin-bottom: 20px" class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="active">
            <label class="form-check-label" for="active">Active Status</label>
        </div>
        <button type="submit" id="button-create" class="btn btn-primary col-md-3">Create</button>
        <a href="{{route('categories.index')}}" class="btn btn-danger col-md-3">Cancel</a
    
        </form>

@endsection

@section('script')

        <script>
            function createCategory() {
                let data = {
                    name: document.getElementById('name').value,
                    active: document.getElementById('active').checked
                }

                post("{{route('categories.store')}}", data, 'button-create', "{{route('categories.index')}}");
            }
        </script>

@endsection

