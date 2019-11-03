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
    <h1>Feeds</h1>

    <div class="page-title-actions" style="float:right">
        <a href="{{url('admin/feed/create')}}"  class='btn btn-grey button_new'><i class="fa fa-fw fa-plus-square"></i>
            {{strtoupper(trans('app.new'))}}</a>
    </div>
@stop

@section('content')

<div class="main-card mb-3 card">
    <div class="card-body">
        <table id="data-feed" class="table table-hover table-striped table-bordered responsive">
            <thead>
                <tr>
                    <th>{{ ucfirst(trans('app.title')) }}</th>
                    <th>{{ ucfirst(trans('app.body')) }}</th>
                    <th>{{ ucfirst(trans('app.image')) }}</th>
                    <th>{{ ucfirst(trans('app.source')) }}</th>
                    <th>{{ ucfirst(trans('app.publisher')) }}</th>
                    <th>{{ ucfirst(trans('app.created_at')) }}</th>
                    <th>{{ ucfirst(trans('app.last_editor')) }}</th>                    
                    <th class="columna_acciones">{{ ucfirst(trans('app.actions')) }}</th>
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


        var ruta = "{{ route('admin.feed.getFeedsDatatable') }}";
        var  feed_table = $('#data-feed').DataTable({

            ajax: {url: ruta,
                    type: "GET",
                    data:function (d) {

                    },
                },
            columns: [
                {data: 'title', name: 'title'},
                {data: 'body', name: 'body'},
                {data: 'image', name: 'image'},
                {data: 'source', name: 'source'},
                {data: 'publisher', name: 'publisher'},
                {data: 'created_at', name: 'created_at'},
                {data: 'last_editor_id', name: 'last_editor_id'},
                {data: 'actions', name: 'actions', sortable: false, class: 'text-right' }, 
            ],
            order: [5, 'DESC'],
            language: {"url": "http://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"},


        });



</script>
@stop
