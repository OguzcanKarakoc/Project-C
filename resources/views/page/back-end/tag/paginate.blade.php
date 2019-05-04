<div class="col-12">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tags as $tag)
        <tr>
          <td>{{ $tag->id }}</td>
          <td>{{ $tag->name }}</td>
          <td>
            <div class="btn-group" role="group" aria-label="Basic example">
              <a href="{{ route('tags.edit', $tag->id )  }}" class="btn btn-info">Edit</a>
              <form action="{{ route('tags.destroy', $tag->id) }}" method="post">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="row">
  <div class="col-12">{!! $tags->render() !!}</div>
</div>