@extends('index')

@section('main')
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category's Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($languages as $key=>$language)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $language->languages_name }}</td>
                  <td><a href="{{ route('select_category',$language->languages_id) }}" class="btn btn-sm btn-outline-primary"><span data-feather="command" class="align-text-bottom"></span> Play This Language</a></td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
@endsection