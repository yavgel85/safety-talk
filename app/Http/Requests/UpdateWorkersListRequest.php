<?php

namespace App\Http\Requests;

use App\WorkersList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateWorkersListRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('workers_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name'      => [
                'required'],
            'workers.*' => [
                'integer'],
            'workers'   => [
                'array'],
        ];

    }
}
