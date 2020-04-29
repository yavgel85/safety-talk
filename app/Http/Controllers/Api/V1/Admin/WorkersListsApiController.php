<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkersListRequest;
use App\Http\Requests\UpdateWorkersListRequest;
use App\Http\Resources\Admin\WorkersListResource;
use App\WorkersList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkersListsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('workers_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkersListResource(WorkersList::with(['workers', 'team'])->get());

    }

    public function store(StoreWorkersListRequest $request)
    {
        $workersList = WorkersList::create($request->all());
        $workersList->workers()->sync($request->input('workers', []));

        return (new WorkersListResource($workersList))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(WorkersList $workersList)
    {
        abort_if(Gate::denies('workers_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkersListResource($workersList->load(['workers', 'team']));

    }

    public function update(UpdateWorkersListRequest $request, WorkersList $workersList)
    {
        $workersList->update($request->all());
        $workersList->workers()->sync($request->input('workers', []));

        return (new WorkersListResource($workersList))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(WorkersList $workersList)
    {
        abort_if(Gate::denies('workers_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workersList->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
