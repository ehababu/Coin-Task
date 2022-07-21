@extends('main')

@section('title','All Categories')

@section('style')
    
@endsection

@section('content')


<a href="{{route('categories.create')}}" class="btn btn-primary">+ Create Category</a>

<table class="table table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Status</th>
        <th scope="col">Manage</th>       
      </tr>
    </thead>
    <tbody>

     @forelse ($categories as $category)

            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $category->name }}</td>  
              <td>
                <button class="btn @if ($category->is_active) btn-success @else btn-danger @endif"
                    onclick="({{ $category->id }})" id="to{{ $category->id }}">
                    {{ $category->active_status }}
                </button>
            </td>
            <td>
              <a href="{{route('categories.edit', $category)}}" class="btn btn-outline-primary">Edit</a>
              <button type="button" onclick="deleteCoin({{ $category->id }}, this)"
                  class="btn btn-outline-danger">Delete</button>
          </td>
            
          </tr>

        @empty
          <td style="text-align: center" colspan="7">No categories to be displayed</td>

         
     @endforelse
     
       
    </tbody>
  </table>
    
@endsection
@section('script')

          <script>
           
            function deleteCoin(id, reference) {
                confirmDelete('/categories', id, reference);
            }
            
        </script>
@endsection
