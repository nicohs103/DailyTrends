@extends('adminlte::page')

@section('title', ucfirst(trans('app.edit_feed')))

@section('content_header')
@include('flash::message')
<h1>{{ucfirst(trans('app.edit_feed'))}}</h1>
@stop

@section('content')
    
@if(isset($feed))
{{ Form::open(['url' => ['admin/feed', $feed->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'id' => 'form-feed'])}}
@else
{{ Form::open(['url' => 'admin/feed', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'form-feed'])}}
@endif

@csrf


<div class="form-row">
    <div class="col-md-8">
        <div class="position-relative form-group">
            {!! Form::label('title', ucwords(trans('app.title')).':') !!}
            {!! Form::text('title', isset($feed) ? $feed->title : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="position-relative form-group">
            {!! Form::label('body', ucwords(trans('app.body')).':') !!}
            {!! Form::textarea('body', isset($feed) ? $feed->body : null, ['class' => 'form-control', 'rows' => 30, 'id' => 'body']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="position-relative form-group">
            {!! Form::label('source', ucwords(trans('app.source')).':') !!}
            {!! Form::text('source', isset($feed) ? $feed->source : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="position-relative form-group">
            {!! Form::label('publisher', ucwords(trans('app.publisher')).':') !!}
            {!! Form::text('publisher', isset($feed) ? $feed->publisher : null, ['class' => 'form-control']) !!}
        </div>
    </div>

</div>

<div class="clearfix"></div>

<div id="imagen_bloque">
    {{-- IMAGEN --}}
    @if(isset($imagen) && isset($feed))
    <div class="form-row">
        <div class="col-md-1 eliminar_imagen_div">
            <a href="#" onclick="eliminarImage('Feed', {{$feed->id}}, 'imagen');"
                class="btn-icon">
                <i class="fal fa-trash-alt btn-icon-wrapper"></i>
            </a>
        </div>
        <div class="col-md-6">
            <div class="position-relative form-group">
                <img src="{{url($imagen)}}" style="height:200px;">
            </div>
        </div>
    </div>
    @endif
    {{-- ADD IMAGEN --}}
    <!-- Document Field -->
    <div class="form-row">
        <div class="col-md-6">
            <div class="position-relative form-group">
                {!! Form::label('file', 'Imagen:') !!}
                <input type="file" id="imagen" name="imagen">
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="col-sm-12 text-right">
        {!! Form::submit( ucwords(trans('app.save')), ['class' => 'btn btn-primary', 'name' =>
        'submitbutton', 'value' => 'save']) !!}
</div>
{!! Form::close() !!}

<div class="clearfix"></div>
@stop


@section('js')
<script type="text/javascript">
    $(document).ready(function() {        
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            });

           

        }); // End document ready


function eliminarImage(modelo, id, nombre){
    $.get(
          "{{ route('admin.feed.ajaxDestroyMedia') }}",
          {modelo:modelo, id:id, nombre:nombre},
          function(data){
            location.reload();
          }
      );
  }

</script>
@stop