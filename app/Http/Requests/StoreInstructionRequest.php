<?php

namespace App\Http\Requests;

use App\Instruction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreInstructionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('instruction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'            => [
                'required'],
            'create_document' => [
                'required'],
        ];
    }
}
