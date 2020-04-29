<?php

namespace App\Http\Requests;

use App\SentInstruction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateSentInstructionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sent_instruction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'validation_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable'],
            'workers.*'       => [
                'integer'],
            'workers'         => [
                'array'],
        ];

    }
}
