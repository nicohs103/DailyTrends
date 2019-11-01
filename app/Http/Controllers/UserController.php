<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DataTableBase;
use App\User;
use Flash;
use DataTables;
use Illuminate\Http\Request;

class UserController extends Controller
{


    public function index()
    {
        return view('admin.user.index');
    }

    public function getUsersDatatable(Request $request)
    {
        $users = User::all();

        $dataTable = DataTables::of($users);
        $dataTable->addColumn('actions', 'admin.user.datatables_actions');
        $dataTable->rawColumns(['actions']);

        $columns = ['name', 'email', 'created_at'];
        $base = new DataTableBase($users, $dataTable, $columns);
        return $base->render(null);
    }

    public function create()
    {
        return view('admin.user.show');
    }


    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::find($request->user_id);

        if (empty($user)) {
            Flash::error(trans('app.not_found'));
            return redirect(url('admin/users'));
        }

        $user->name = $request->name;
        $user->email = strtolower($request->email);
        $user->save();

        Flash::info(trans('app.saved_successfully'));
        return redirect(url('admin/users'));
    }


    public function store(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $input['password'] = bcrypt($input['password']);
        $input['email'] = strtolower($input['email']);
        $user = User::create($input);

        Flash::success(trans('app.updated_successfully'));
        return redirect(url('admin/users'));
    }

    public function storePassword(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::find($request->user_id);

        if (empty($user)) {
            Flash::error(trans('app.not_found'));
            return redirect(url('admin/users'));
        }

        $user = User::find($input['user_id']);
        $user->password = bcrypt($input['password']);
        $user->save();

        Flash::put('info', trans('app.saved_successfully'));
        return redirect(url('admin/users'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            Flash::error(trans('app.not_found'));
            return redirect(url('admin/users'));
        }

        return view('admin.user.show', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            Flash::error(trans('app.not_found'));
            return redirect(url('admin/users'));
        }

        $user->delete();
        Flash::info(trans('app.deleted_successfully'));
        return redirect(url('admin/users'));
    }
}
