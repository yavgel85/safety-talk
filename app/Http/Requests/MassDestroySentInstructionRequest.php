<?php

namespace App\Http\Requests;

use App\SentInstruction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySentInstructionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sent_instruction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sent_instructions,id',
        ];

    }
}
