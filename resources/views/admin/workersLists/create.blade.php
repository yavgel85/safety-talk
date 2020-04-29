@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.workersList.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.workers-lists.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.workersList.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.workersList.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_listed') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_listed" value="0">
                    <input class="form-check-input" type="checkbox" name="is_listed" id="is_listed" value="1" {{ old('is_listed', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_listed">{{ trans('cruds.workersList.fields.is_listed') }}</label>
                </div>
                @if($errors->has('is_listed'))
                    <span class="text-danger">{{ $errors->first('is_listed') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.workersList.fields.is_listed_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="workers">{{ trans('cruds.workersList.fields.worker') }}</label>
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
                <span class="help-block">{{ trans('cruds.workersList.fields.worker_helper') }}</span>
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