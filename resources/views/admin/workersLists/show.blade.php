@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.workersList.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.workers-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.workersList.fields.id') }}
                        </th>
                        <td>
                            {{ $workersList->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workersList.fields.name') }}
                        </th>
                        <td>
                            {{ $workersList->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workersList.fields.is_listed') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $workersList->is_listed ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workersList.fields.worker') }}
                        </th>
                        <td>
                            @foreach($workersList->workers as $key => $worker)
                                <span class="label label-info">{{ $worker->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.workers-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
