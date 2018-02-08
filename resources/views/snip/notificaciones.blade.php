@if (session('status'))
    <div class="alert alert-success alert-dismissable fade show">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
      {{ session('status') }}
    </div>
  @endif
@if (count($errors)>0)
  <div class="alert alert-danger alert-dismissable fade show">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="alert alert-danger alert-dismissable fade show" id="cart-errors" style="display: none;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
  <ul>
      <li><span class="card-errors"></span></li>
  </ul>
</div>

@if (Session::get('mensaje'))
  <div class="alert alert-{{ Session::get('class') }} alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
    <ul>
        <li>{!! Session::get('mensaje') !!}</li>
    </ul>
  </div>
@endif