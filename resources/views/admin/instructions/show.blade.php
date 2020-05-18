@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.instruction.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.instructions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.instruction.fields.id') }}
                        </th>
                        <td>
                            {{ $instruction->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instruction.fields.name') }}
                        </th>
                        <td>
                            {{ $instruction->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instruction.fields.category') }}
                        </th>
                        <td>
                            {{ $instruction->category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instruction.fields.create_document') }}
                        </th>
                        <td>
                            {{ App\Instruction::CREATE_DOCUMENT_SELECT[$instruction->create_document] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instruction.fields.import_pdf') }}
                        </th>
                        <td>
                            @foreach($instruction->import_pdf as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instruction.fields.description') }}
                        </th>
                        <td>
                            {!! $instruction->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instruction.fields.url') }}
                        </th>
                        <td>
                            {{ $instruction->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instruction.fields.user') }}
                        </th>
                        <td>
                            {{ $instruction->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instruction.fields.company') }}
                        </th>
                        <td>
                            {{ $instruction->company->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.instructions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection