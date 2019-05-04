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
      @foreach($categories as $category)
        <tr>
          <td>{{ $category->id }}</td>
          <td>{{ $category->name }}</td>
          <td>
            <div class="btn-group" role="group" aria-label="Basic example">
              <a href="{{ route('categories.edit', $category->id )  }}" class="btn btn-info">Edit</a>
              <form action="{{ route('categories.destroy', $category->id) }}" method="post">
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
  <div class="col-12">{!! $categories->render() !!}</div>
</div>