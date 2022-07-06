@extends('main')

@section('title','Edit Coin')

@section('style')
    
@endsection

@section('content')

        <form onsubmit="event.preventDefault(); updateCoin();">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter Coin's Name" value="{{$coin->name}}">
            </div>
            <div class="form-group col-md-6">
                <label for="token">Token</label>
                <input type="text" class="form-control" id="token" placeholder="Enter Coin's Token" value="{{$coin->token}}">
            </div>
            <div class="form-group col-md-6">
                <label for="max-dic">Maximum Decimal Numbers</label>
                <input type="number" class="form-control" id="max-dic" placeholder="Enter Coin's Maximum Decimal Numbers" value="{{$coin->max_decimal_numbers}}">
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="virtual" @checked($coin->is_virtual)>
                <label class="form-check-label" for="virtual">Virtual Coin</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="active" @checked($coin->is_active)>
                <label class="form-check-label" for="active">Active Coin</label>
            </div>
            <button type="submit" id="button-update" class="btn btn-primary col-md-3">Update</button>
            <a href="{{route('coins.index')}}" class="btn btn-danger col-md-3">Cancel</a>
        </form>
            
@endsection


@section('script')
    <script>
            function updateCoin() {
                let data = {
                    name: document.getElementById('name').value,
                    token: document.getElementById('token').value,
                    max: document.getElementById('max-dic').value,
                    virtual: document.getElementById('virtual').checked,
                    active: document.getElementById('active').checked

                }
                update("{{route('coins.update', $coin)}}", data, "button-update", "{{route('coins.index')}}")
            }
        </script>
@endsection