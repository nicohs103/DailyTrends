@extends('adminlte::page')

@section('title', ucfirst(trans('app.edit_user')))

@section('content_header')
@include('flash::message')
<h1>{{ucfirst(trans('app.edit_user'))}}</h1>
@stop

@section('content')

    <div class="container">
        <div class="row">

            @if(isset($user))
            {{ Form::open(['url' => ['admin/users', $user->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'id' => 'form-feed', 'autocomplete'=>'off'])}}
            @else
            {{ Form::open(['url' => 'admin/users', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'form-feed', 'autocomplete'=>'off'])}}
            @endif

            @csrf
            <input type="hidden" id="user_id" name="user_id" value="{{isset($user->id) ? $user->id : null}}">

            <div class="position-relative row form-group">
                {!! Form::label('name', ucfirst(trans('app.name')).':', ['class' => 'col-sm-2 col-form-label
                text-right']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name', isset($user) ? $user->name : null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="position-relative row form-group">
                {!! Form::label('email', ucfirst(trans('app.email')).':', ['class' => 'col-sm-2 col-form-label
                text-right']) !!}
                <div class="col-sm-10">
                    {!! Form::email('email', isset($user) ? $user->email : null, ['class' => 'form-control']) !!}
                </div>
            </div>


            @if(!isset($user))
            <div class="position-relative row form-group">
                {!! Form::label('password', ucfirst(trans('app.password')).':', ['class' => 'col-sm-2 col-form-label
                text-right']) !!}
                <div class="col-sm-10">
                    {!! Form::password('password',['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="position-relative row form-group">
                {!! Form::label('password_confirmation', ucfirst(trans('app.repetir_password')).':', ['class' =>
                'col-sm-2 col-form-label text-right']) !!}
                <div class="col-sm-10">
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>
            </div>
            @endif

            <div class="position-relative row">
                <!-- Submit Field -->
                <div class="col-sm-12 text-right mb-0">    
                        <div class="col-sm-12 text-right">
                                {!! Form::submit( ucwords(trans('app.save')), ['class' => 'btn btn-primary', 'name' =>
                                'submitbutton', 'value' => 'save']) !!}
                        </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    @if(isset($user))
    
    <div class="container">
            <div class="row">

            <h3 >{{ucfirst(trans('app.cambiar_password'))}}</h3>
            {{ Form::open(['route' => 'admin.users.store-password', 'method' => 'POST', 'id' => 'form-users', 'autocomplete'=>'off'])}}
            @csrf
            <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">


            <div class="position-relative row form-group">
                {!! Form::label('password', ucfirst(trans('app.nuevo_password')).':', ['class' => 'col-sm-2
                col-form-label text-right']) !!}
                <div class="col-sm-10">
                    {!! Form::password('password',['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="position-relative row form-group">
                {!! Form::label('password_confirmation', ucfirst(trans('app.repetir_password')).':', ['class' =>
                'col-sm-2 col-form-label text-right']) !!}
                <div class="col-sm-10">
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="position-relative row">
                <!-- Submit Field -->
                <div class="col-sm-12 text-right">
                        {!! Form::submit( ucwords(trans('app.save')), ['class' => 'btn btn-primary', 'name' =>
                        'submitbutton', 'value' => 'save']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    @endif
    
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


</script>
@stop