@extends('templates.default')
@section('header')
<link rel="stylesheet" type="text/css" href="{{ url('css/shop.css') }}?v={{rand()}}" media="screen" />
@endsection
@section('pagecontent')
<section class="productsmain">
  <div class="container">
    <div class="row">
          <div class="col-md-12">
            <div id="bc1" class="btn-group btn-breadcrumb">
              <a href="{{url('/')}}" class="btn btn-default"><i class="fa fa-home"></i></a>
              <a href="{{url('/rifas')}}" class="btn btn-default"><div>Rifas</div></a>  
              <a href="{{url('/rifa')}}/{{$producto->slug}}" class="btn btn-default"><div>{{$producto->nombre}}</div></a>
            </div>
          </div>
        </div>
    <div class="row">
      <div class="col-md-6">
        <div class="img-box">
          
            <div class="row">
              <div class="col-md-3">
                @if($producto->poplets->count()>0)
                  @foreach($producto->poplets as $poplet)
                  <img src="{{url('/uploads/productos/poplets')}}/{{$producto->id}}/{{$poplet->imagen}}" alt="" class="responsive-img materialboxed">
                  @endforeach
                @endif
                
              </div>
              <div class="col-md-9">
                <div class="img-containerlarge">
                  <img src="{{url('/uploads/productos')}}/{{$producto->imagen}}" alt="" class="responsive-img materialboxed">
                </div>
              </div>
            </div>
          
        </div>
        
      </div>
      <div class="col-md-6">
        <h4>{{$producto->nombre}}</h4>
      </div>
    </div>
  </div>
</section>


        


@endsection





@section('scripts')
@endsection