@extends('main')

@section('title', 'Create Coin')

@section('style')
@endsection

@section('content')
    <form onsubmit="event.preventDefault(); createCoin();">
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Coin's Name">
        </div>
        <div class="form-group col-md-6">
            <label for="token">Token</label>
            <input type="text" class="form-control" id="token" placeholder="Enter Coin's Token">
        </div>
        <div class="form-group col-md-6">
            <label for="max-dic">Maximum Decimal Numbers</label>
            <input type="number" class="form-control" id="max-dic" placeholder="Enter Coin's Maximum Decimal Numbers">
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="virtual">
            <label class="form-check-label" for="virtual">Virtual Coin</label>
        </div>
        <div style="margin-bottom: 20px" class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="active">
            <label class="form-check-label" for="active">Active Status</label>
        </div>
        <button type="submit" id="button-create" class="btn btn-primary col-md-3">Create</button>
        <a href="{{route('coins.index')}}" class="btn btn-danger col-md-3">Cancel</a>
    </form>
@endsection

@section('script')
    <script>
        function createCoin() {
            let data = {
                name: document.getElementById('name').value,
                token: document.getElementById('token').value,
                max: document.getElementById('max-dic').value,
                virtual: document.getElementById('virtual').checked,
                active: document.getElementById('active').checked
            }

            post("{{route('coins.store')}}", data, 'button-create', "{{route('coins.index')}}");
        }
    </script>
@endsection
