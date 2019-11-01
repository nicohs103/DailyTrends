@extends('adminlte::page')
@section('css')
<style>
.button_new{
    font-size: 25px;
}
</style>

@stop

@section('title', 'Feed')

@section('content_header')
@include('flash::message')
    <h1>{{ ucwords(trans('app.users')) }}</h1>

    <div class="page-title-actions" style="float:right">
        <a href="{{url('admin/users/create')}}"  class='btn btn-grey button_new'><i class="fa fa-fw fa-plus-square"></i>
            {{strtoupper(trans('app.new'))}}</a>
    </div>
@stop

@section('content')

<div class="main-card mb-3 card">
    <div class="card-body">
        <table id="data-user" class="table table-hover table-striped table-bordered responsive">
            <thead>
                <tr>
                    <th>{{ ucwords(trans('app.name')) }}</th>
                    <th>{{ ucwords(trans('app.email')) }}</th>
                    <th>{{ ucwords(trans('app.created_at')) }}</th>
                    <th class="columna_acciones">{{ ucwords(trans('app.actions')) }}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

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


        var ruta = "{{ route('admin.users.getUsersDatatable') }}";
        var  feed_table = $('#data-user').DataTable({

            ajax: {url: ruta,
                    type: "GET",
                    data:function (d) {

                    },
                },
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created_at'},
                {data: 'actions', name: 'actions', sortable: false, class: 'text-right' }, 
            ],
            order: [0, 'ASC'],
            language: {"url": "http://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"},


        });

</script>
@stop
