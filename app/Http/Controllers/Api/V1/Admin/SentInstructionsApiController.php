<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSentInstructionRequest;
use App\Http\Requests\UpdateSentInstructionRequest;
use App\Http\Resources\Admin\SentInstructionResource;
use App\SentInstruction;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SentInstructionsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sent_instruction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SentInstructionResource(SentInstruction::with(['user', 'status', 'workers_list', 'instruction', 'workers', 'team'])->get());

    }

    public function store(StoreSentInstructionRequest $request)
    {
        $sentInstruction = SentInstruction::create($request->all());
        $sentInstruction->workers()->sync($request->input('workers', []));

        return (new SentInstructionResource($sentInstruction))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(SentInstruction $sentInstruction)
    {
        abort_if(Gate::denies('sent_instruction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SentInstructionResource($sentInstruction->load(['user', 'status', 'workers_list', 'instruction', 'workers', 'team']));

    }

    public function update(UpdateSentInstructionRequest $request, SentInstruction $sentInstruction)
    {
        $sentInstruction->update($request->all());
        $sentInstruction->workers()->sync($request->input('workers', []));

        return (new SentInstructionResource($sentInstruction))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(SentInstruction $sentInstruction)
    {
        abort_if(Gate::denies('sent_instruction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sentInstruction->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
