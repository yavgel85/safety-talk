<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWorkerRequest;
use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\User;
use App\Worker;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WorkersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('worker_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Worker::with(['user', 'team'])->select(sprintf('%s.*', (new Worker)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'worker_show';
                $editGate      = 'worker_edit';
                $deleteGate    = 'worker_delete';
                $crudRoutePart = 'workers';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : "";
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.workers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('worker_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.workers.create', compact('users'));
    }

    public function store(StoreWorkerRequest $request)
    {
        $worker = Worker::create($request->all());

        return redirect()->route('admin.workers.index');

    }

    public function edit(Worker $worker)
    {
        abort_if(Gate::denies('worker_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $worker->load('user', 'team');

        return view('admin.workers.edit', compact('users', 'worker'));
    }

    public function update(UpdateWorkerRequest $request, Worker $worker)
    {
        $worker->update($request->all());

        return redirect()->route('admin.workers.index');

    }

    public function show(Worker $worker)
    {
        abort_if(Gate::denies('worker_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $worker->load('user', 'team');

        return view('admin.workers.show', compact('worker'));
    }

    public function destroy(Worker $worker)
    {
        abort_if(Gate::denies('worker_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $worker->delete();

        return back();

    }

    public function massDestroy(MassDestroyWorkerRequest $request)
    {
        Worker::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
