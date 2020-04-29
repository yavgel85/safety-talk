<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Http\Resources\Admin\WorkerResource;
use App\Worker;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('worker_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkerResource(Worker::with(['user', 'team'])->get());

    }

    public function store(StoreWorkerRequest $request)
    {
        $worker = Worker::create($request->all());

        return (new WorkerResource($worker))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Worker $worker)
    {
        abort_if(Gate::denies('worker_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkerResource($worker->load(['user', 'team']));

    }

    public function update(UpdateWorkerRequest $request, Worker $worker)
    {
        $worker->update($request->all());

        return (new WorkerResource($worker))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Worker $worker)
    {
        abort_if(Gate::denies('worker_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $worker->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
