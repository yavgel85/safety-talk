<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreInstructionRequest;
use App\Http\Requests\UpdateInstructionRequest;
use App\Http\Resources\Admin\InstructionResource;
use App\Instruction;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstructionsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('instruction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstructionResource(Instruction::with(['user', 'company', 'category', 'team'])->get());

    }

    public function store(StoreInstructionRequest $request)
    {
        $instruction = Instruction::create($request->all());

        return (new InstructionResource($instruction))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Instruction $instruction)
    {
        abort_if(Gate::denies('instruction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstructionResource($instruction->load(['user', 'company', 'category', 'team']));

    }

    public function update(UpdateInstructionRequest $request, Instruction $instruction)
    {
        $instruction->update($request->all());

        return (new InstructionResource($instruction))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Instruction $instruction)
    {
        abort_if(Gate::denies('instruction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instruction->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
