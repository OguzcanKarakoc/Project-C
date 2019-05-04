<div class="col-12">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">price</th>
            <th scope="col">actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($shipments as $shipment)
            <tr>
                <td>{{ $shipment->id }}</td>
                <td>{{ $shipment->name }}</td>
                <td>{{ $shipment->price }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('shipments.edit', $shipment->id )  }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('shipments.destroy', $shipment->id) }}" method="post">
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
    <div class="col-12">{!! $shipments->render() !!}</div>
</div>