@extends('index')

@section('main')
  <button class="btn-rounded btn btn-m btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <span data-feather="plus" class="align-text-bottom"></span>
    Add Card
  </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('card.store') }}" method="post">
          @csrf
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Card</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          {{-- <div style="margin:5px;">
            <button type="button" class="btn-rounded btn btn-m btn-primary" id="add-more">
                <span data-feather="plus" class="align-text-bottom"></span>
            </button>
          </div> --}}
          <div class="modal-body" id="clone">
            <input type="text" name="cards_categories_id" value="{{ Request::segment(2) }}" class="form-control d-none">
            <p>Card's Question:</p>
            <input type="text" name="cards_question[]" class="form-control">

            <br>
            
            <p>Card's Answer:</p>
            <input type="text" name="cards_answer[]" class="form-control">
            <hr>
          </div>
          <div id="target-clone">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

    
  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('card.store') }}" method="post">
          @csrf
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Card</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="clone">
            <input type="text" name="cards_categories_id" value="{{ Request::segment(2) }}" class="form-control d-none">
            <p>Card's Question:</p>
            <input type="text" name="cards_question[]" class="form-control">

            <br>
            
            <p>Card's Answer:</p>
            <input type="text" name="cards_answer[]" class="form-control">
            <hr>
          </div>
          <div id="target-clone">

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

  <h2>{{ $category->categories_name }}'s Categories</h2>
  <div class="table-responsive">
      <table class="table table-striped table-sm" id="myTable">
          <thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Question</th>
                  <th scope="col">Answer</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($cards as $key=>$card)
              <tr>
                <td>{{ $key+1 }}</td>
                <td id="cards_question">{{ $card->cards_question }}</td>
                <td id="cards_answer">{{ $card->cards_answer }}</td>
                <td>
                  
                  <form action="{{ route('card.destroy', $card->cards_id ) }}" method="POST">
                    <button class="btn btn-sm btn-outline-primary btn-edit" data-value="{{ $card->cards_id }}">
                      <span data-feather="edit" class="align-text-bottom"></span>
                      Edit Card (pengembangan)
                    </button>
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">
                      <span data-feather="trash" class="align-text-bottom"></span>
                      Delete Card
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
      </table>
  </div>

  <script>
    $("#add-more").click(function(){
      $("#clone").clone().appendTo("#target-clone");
    });
  </script>

  <script>
    $(".btn-edit").click(function(e){
      e.preventDefault();
      $('#editModal').modal('show');
      let post_id = $(this).attr('data-value');
      url = "card/edit/"+post_id;

      $.ajax({
          url:  url,
          type: "GET",
          cache: false,
          success:function(response){

              //fill data to form
              $('#cards_question').val(response.data.id);
              $('#cards_answer').val(response.data.title);

          }
      });
    });
  </script>
@endsection