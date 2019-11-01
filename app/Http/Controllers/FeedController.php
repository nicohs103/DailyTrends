<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;
use App\Services\DataTableBase;
use DataTables;
use Flash;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.feed.index');
    }

    public function getFeedsDatatable (Request $request){
        $feed = Feed::all();
        $dataTable = DataTables::of($feed);
        $dataTable->editColumn('body', function ($feed) {
            $max = 50;
            $string = substr($feed['body'], 0, $max);
            return $string . '...';
        });

        $dataTable->addColumn('actions', 'admin.feed.datatables_actions');
        $dataTable->rawColumns(['actions']);

        $columns = ['title', 'body', 'image', 'source', 'publisher'];
        $base = new DataTableBase($feed, $dataTable, $columns);
        return $base->render(null);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.feed.show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'source' => 'required',
            'publisher' => 'required',
        ]);

        $feed = new Feed;
        $feed->title = ucfirst($request->title);
        $feed->body = $request->body;
        $feed->source = $request->source;
        $feed->publisher = ucfirst($request->publisher);
        $feed->save();

        if (isset($request->imagen)) {
            $feed->addMediaFromRequest('imagen')->toMediaCollection('imagen');
        }

        Flash::success(trans('app.created_successfully'));
        return redirect(url('admin/feed'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $feed = Feed::find($id);

        // if(empty($feed)){
        //     Flash::error(trans('app.not_found'));
        //     return redirect(url('admin/feed'));
        // }

        // $media = $feed->getMedia('imagen')->first();
        // if (isset($media)) {
        //     $imagen = $media->getFullUrl();
        // }

        // return view('admin.feed.show', compact('feed','imagen'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feed = Feed::find($id);

        if(empty($feed)){
            Flash::error(trans('app.not_found'));
            return redirect(url('admin/feed/index'));
        }

        $media = $feed->getMedia('imagen')->first();
        if (isset($media)) {
            $imagen = $media->getFullUrl();
        }
        dd($media, $media->getUrl(), $media->getFullUrl());

        return view('admin.feed.show', compact('feed','imagen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $feed = Feed::find($id);

        if(empty($feed)){
            Flash::error(trans('app.not_found'));
            return redirect(url('admin/feed/index'));
        }

        if (isset($request->imagen)) {
            $feed->clearMediaCollection('imagen');
            $feed->addMediaFromRequest('imagen')->toMediaCollection('imagen');
        }

        Flash::success(trans('app.updated_successfully'));

        return view('admin.feed.show', compact('feed'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feed = Feed::find($id);

        if(empty($feed)){
            Flash::error(trans('app.not_found'));
            return redirect(url('admin/feed/index'));
        }

        $feed->delete();
        Flash::success(trans('app.deleted_successfully'));
        return redirect(url('admin/feed/index'));
    }

    public function ajaxDestroyMedia(Request $request)
    {
        $id = $request->id;
        $modelo_nombre = $request->modelo;
        $nombre = $request->nombre;

        switch ($modelo_nombre) {
            case 'Feed':
                $modelo = Feed::find($id);
                break;
        }

        if (isset($modelo)) {
            $modelo->clearMediaCollection($nombre);
        }

        \Session::put('info', trans('app.content_removed'));

    }
}
