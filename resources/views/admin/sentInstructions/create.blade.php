@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.sentInstruction.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sent-instructions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="url">{{ trans('cruds.sentInstruction.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', '') }}">
                @if($errors->has('url'))
                    <span class="text-danger">{{ $errors->first('url') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sentInstruction.fields.url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="validation_date">{{ trans('cruds.sentInstruction.fields.validation_date') }}</label>
                <input class="form-control datetime {{ $errors->has('validation_date') ? 'is-invalid' : '' }}" type="text" name="validation_date" id="validation_date" value="{{ old('validation_date') }}">
                @if($errors->has('validation_date'))
                    <span class="text-danger">{{ $errors->first('validation_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sentInstruction.fields.validation_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.sentInstruction.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sentInstruction.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.sentInstruction.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $status)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sentInstruction.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="workers_list_id">{{ trans('cruds.sentInstruction.fields.workers_list') }}</label>
                <select class="form-control select2 {{ $errors->has('workers_list') ? 'is-invalid' : '' }}" name="workers_list_id" id="workers_list_id">
                    @foreach($workers_lists as $id => $workers_list)
                        <option value="{{ $id }}" {{ old('workers_list_id') == $id ? 'selected' : '' }}>{{ $workers_list }}</option>
                    @endforeach
                </select>
                @if($errors->has('workers_list'))
                    <span class="text-danger">{{ $errors->first('workers_list') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sentInstruction.fields.workers_list_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="instruction_id">{{ trans('cruds.sentInstruction.fields.instruction') }}</label>
                <select class="form-control select2 {{ $errors->has('instruction') ? 'is-invalid' : '' }}" name="instruction_id" id="instruction_id">
                    @foreach($instructions as $id => $instruction)
                        <option value="{{ $id }}" {{ old('instruction_id') == $id ? 'selected' : '' }}>{{ $instruction }}</option>
                    @endforeach
                </select>
                @if($errors->has('instruction'))
                    <span class="text-danger">{{ $errors->first('instruction') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sentInstruction.fields.instruction_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="workers">{{ trans('cruds.sentInstruction.fields.worker') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('workers') ? 'is-invalid' : '' }}" name="workers[]" id="workers" multiple>
                    @foreach($workers as $id => $worker)
                        <option value="{{ $id }}" {{ in_array($id, old('workers', [])) ? 'selected' : '' }}>{{ $worker }}</option>
                    @endforeach
                </select>
                @if($errors->has('workers'))
                    <span class="text-danger">{{ $errors->first('workers') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sentInstruction.fields.worker_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection