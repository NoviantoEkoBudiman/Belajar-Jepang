@extends('index')

@section('main')

    <h2>{{ $language->languages_name }}'s Categories</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm" id="myTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category's Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($categories as $key=>$category)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $category->categories_name }}</td>
                  <td><a href="{{ route('play.show',$category->categories_id) }}" class="btn btn-sm btn-outline-primary"><span data-feather="command" class="align-text-bottom"></span> Play this card</a></td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
@endsection