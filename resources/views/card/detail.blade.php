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
        <form action="{{ url('card/update_card') }}" method="post">
          @csrf
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Card</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="clone">
            <input type="text" name="cards_categories_id" value="{{ Request::segment(2) }}" class="form-control d-none">
            <p>Card's Question:</p>
            <input type="hidden" name="cards_id" id="cards_id" class="form-control">
            <input type="text" name="cards_question" id="cards_question" class="form-control">

            <br>
            
            <p>Card's Answer:</p>
            <input type="text" name="cards_answer" id="cards_answer" class="form-control">
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
    <input type="checkbox" name="checkbox"> Hide Answer
    <table class="table table-striped table-sm" id="myTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Question</th>
                <th scope="col" id="cards_answer_header">Answer</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($cards as $key=>$card)
            <tr>
              <td>{{ $key+1 }}</td>
              <td id="cards_question">{{ $card->cards_question }}</td>
              <td id="cards_answer" class="cards_answer">{{ $card->cards_answer }}</td>
              <td>
                <form action="{{ route('destroy_card',$card->cards_id) }}" method="POST">
                  <button class="btn btn-sm btn-outline-primary btn-edit" id="editBtn" data-value="{{ $card->cards_id }}">
                    <span data-feather="edit" class="align-text-bottom"></span>
                    Edit Card
                  </button>
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger" type="submit">
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
    $("input[name='checkbox']").click(function(){
      if($("input[name='checkbox']").is(":checked")){
        $(".cards_answer").hide();
        $("#cards_answer_header").hide();
      }else{
        $(".cards_answer").show();
        $("#cards_answer_header").show();
      }
    });
  </script>

  <script>
    $("#add-more").click(function(){
      $("#clone").clone().appendTo("#target-clone");
    });
  </script>

  <script>
    $(".btn-edit").click(function(e){
      e.preventDefault();
      let post_id = $(this).attr('data-value');
      url = "edit_card/"+post_id;
      $.getJSON(url, function(result){
        $("#cards_id").val(result.cards_id)
        $("#cards_question").val(result.cards_question)
        $("#cards_answer").val(result.cards_answer)
      });
      $('#editModal').modal('show');
    });
  </script>
@endsection