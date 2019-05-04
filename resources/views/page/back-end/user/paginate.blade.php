<div class="col-12">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">first name</th>
        <th scope="col">last name</th>
        <th scope="col">phone number</th>
        <th scope="col">email</th>
        <th scope="col">role</th>
        <th scope="col">actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->first_name }}</td>
          <td>{{ $user->last_name }}</td>
          <td>{{ $user->phone_number }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->role->name }}</td>

          <td>
            <div class="btn-group" role="group" aria-label="Basic example">
              <a href="{{ route('users.show', $user->id )  }}" class="btn btn-primary">Show</a>
              <a href="{{ route('users.edit', $user->id )  }}" class="btn btn-info">Edit</a>
              <form action="{{ route('users.destroy', $user->id) }}" method="post">
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
  <div class="col-12">{!! $users->render() !!}</div>
</div>