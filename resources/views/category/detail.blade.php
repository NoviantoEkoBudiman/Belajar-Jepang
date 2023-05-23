@extends('index')

@section('main')
    <button class="btn-rounded btn btn-m btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <span data-feather="plus" class="align-text-bottom"></span>
        Add Category
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('category.store') }}" method="post">
            @csrf
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Category's Name:</p>
              <input type="text" name="categories_languages_id" value="{{ Request::segment(2) }}" class="form-control d-none">
              <input type="text" name="categories_name" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <br>

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
                  <td><a href="{{ route('card.show',$category->categories_id) }}" class="btn btn-sm btn-outline-primary"><span data-feather="plus" class="align-text-bottom"></span> Add Cards</a></td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
@endsection