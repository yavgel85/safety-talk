<?php

namespace App\Http\Requests;

use App\Worker;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateWorkerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('worker_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name' => [
                'required'],
        ];

    }
}
