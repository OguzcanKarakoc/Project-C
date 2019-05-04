<form action="{{ route('ajax-paginate') }}">
  <div class="card">
    <div class="card-group-item">
      <header class="card-header">
        <h6 class="title">Range input </h6>
      </header>
      <div class="filter-content">
        <div class="card-body">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Min</label>
              @if (isset($_GET['price']['min']))
              <input type="number" name="price[min]" class="form-control" id="inputEmail4"
                     placeholder="$0" value="{{ $_GET['price']['min'] }}">
              @else
                <input type="number" name="price[min]" class="form-control" id="inputEmail4"
                       placeholder="$0">
              @endif
            </div>
            <div class="form-group col-md-6 text-right">
              <label>Max</label>
              @if (isset($_GET['price']['max']))
              <input type="number" name="price[max]" class="form-control" placeholder="$1,0000"
                     value="{{ $_GET['price']['max'] }}">
              @else
                <input type="number" name="price[max]" class="form-control" placeholder="$1,0000">
              @endif
            </div>
          </div>
        </div> <!-- card-body.// -->
      </div>
    </div> <!-- card-group-item.// -->
    <div class="card-group-item">
      <header class="card-header">
        <h6 class="title">Categories</h6>
      </header>
      <div class="filter-content">
        <div class="card-body">

          @foreach($categories as $category)
            <div class="custom-control custom-checkbox">
              <span
                  class="float-right badge badge-light round">{{ $category->products->count() }}</span>
              @if (isset($_GET['categories']) && is_array($_GET['categories']) && in_array($category->id, $_GET['categories']))
                <input name="categories[]" value="{{ $category->id }}" type="checkbox"
                       class="custom-control-input" id="{{ $category->id }}" checked>
              @else
                <input name="categories[]" value="{{ $category->id }}" type="checkbox"
                       class="custom-control-input" id="{{ $category->id }}">
              @endif
              <label class="custom-control-label"
                     for="{{ $category->id }}">{{ $category->name }}</label>
            </div> <!-- form-check.// -->
          @endforeach
          <div class="form-group" style="margin-top: 5px">
            <input type="submit" class="form-control btn btn-primary" id="submit" value="Filter">
          </div>
        </div> <!-- card-body.// -->
      </div>
    </div> <!-- card-group-item.// -->
  </div> <!-- card.// -->
</form>
