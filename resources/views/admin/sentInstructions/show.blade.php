@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sentInstruction.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sent-instructions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sentInstruction.fields.id') }}
                        </th>
                        <td>
                            {{ $sentInstruction->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sentInstruction.fields.url') }}
                        </th>
                        <td>
                            {{ $sentInstruction->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sentInstruction.fields.validation_date') }}
                        </th>
                        <td>
                            {{ $sentInstruction->validation_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sentInstruction.fields.user') }}
                        </th>
                        <td>
                            {{ $sentInstruction->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sentInstruction.fields.status') }}
                        </th>
                        <td>
                            {{ $sentInstruction->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sentInstruction.fields.workers_list') }}
                        </th>
                        <td>
                            {{ $sentInstruction->workers_list->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sentInstruction.fields.instruction') }}
                        </th>
                        <td>
                            {{ $sentInstruction->instruction->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sentInstruction.fields.worker') }}
                        </th>
                        <td>
                            @foreach($sentInstruction->workers as $key => $worker)
                                <span class="label label-info">{{ $worker->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sent-instructions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection