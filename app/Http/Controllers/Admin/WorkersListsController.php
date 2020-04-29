<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWorkersListRequest;
use App\Http\Requests\StoreWorkersListRequest;
use App\Http\Requests\UpdateWorkersListRequest;
use App\Worker;
use App\WorkersList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WorkersListsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('workers_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = WorkersList::with(['workers', 'team'])->select(sprintf('%s.*', (new WorkersList)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'workers_list_show';
                $editGate      = 'workers_list_edit';
                $deleteGate    = 'workers_list_delete';
                $crudRoutePart = 'workers-lists';

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
            $table->editColumn('is_listed', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_listed ? 'checked' : null) . '>';
            });
            $table->editColumn('worker', function ($row) {
                $labels = [];

                foreach ($row->workers as $worker) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $worker->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'is_listed', 'worker']);

            return $table->make(true);
        }

        return view('admin.workersLists.index');
    }

    public function create()
    {
        abort_if(Gate::denies('workers_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workers = Worker::all()->pluck('name', 'id');

        return view('admin.workersLists.create', compact('workers'));
    }

    public function store(StoreWorkersListRequest $request)
    {
        $workersList = WorkersList::create($request->all());
        $workersList->workers()->sync($request->input('workers', []));

        return redirect()->route('admin.workers-lists.index');

    }

    public function edit(WorkersList $workersList)
    {
        abort_if(Gate::denies('workers_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workers = Worker::all()->pluck('name', 'id');

        $workersList->load('workers', 'team');

        return view('admin.workersLists.edit', compact('workers', 'workersList'));
    }

    public function update(UpdateWorkersListRequest $request, WorkersList $workersList)
    {
        $workersList->update($request->all());
        $workersList->workers()->sync($request->input('workers', []));

        return redirect()->route('admin.workers-lists.index');

    }

    public function show(WorkersList $workersList)
    {
        abort_if(Gate::denies('workers_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workersList->load('workers', 'team');

        return view('admin.workersLists.show', compact('workersList'));
    }

    public function destroy(WorkersList $workersList)
    {
        abort_if(Gate::denies('workers_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workersList->delete();

        return back();

    }

    public function massDestroy(MassDestroyWorkersListRequest $request)
    {
        WorkersList::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
