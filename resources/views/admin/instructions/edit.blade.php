@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.instruction.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.instructions.update", [$instruction->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.instruction.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $instruction->name) }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.instruction.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="category_id">{{ trans('cruds.instruction.fields.category') }}</label>
                    <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id">
                        @foreach($categories as $id => $category)
                            <option value="{{ $id }}" {{ ($instruction->category ? $instruction->category->id : old('category_id')) == $id ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('category'))
                        <span class="text-danger">{{ $errors->first('category') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.instruction.fields.category_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.instruction.fields.create_document') }}</label>
                    <select class="form-control {{ $errors->has('create_document') ? 'is-invalid' : '' }}" name="create_document" id="create_document" required>
                        <option value disabled {{ old('create_document', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Instruction::CREATE_DOCUMENT_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('create_document', $instruction->create_document) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('create_document'))
                        <span class="text-danger">{{ $errors->first('create_document') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.instruction.fields.create_document_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="import_pdf">{{ trans('cruds.instruction.fields.import_pdf') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('import_pdf') ? 'is-invalid' : '' }}" id="import_pdf-dropzone">
                    </div>
                    @if($errors->has('import_pdf'))
                        <span class="text-danger">{{ $errors->first('import_pdf') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.instruction.fields.import_pdf_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="description">{{ trans('cruds.instruction.fields.description') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $instruction->description) !!}</textarea>
                    @if($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.instruction.fields.description_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="url">{{ trans('cruds.instruction.fields.url') }}</label>
                    <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', $instruction->url) }}">
                    @if($errors->has('url'))
                        <span class="text-danger">{{ $errors->first('url') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.instruction.fields.url_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="user_id">{{ trans('cruds.instruction.fields.user') }}</label>
                    <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                        @foreach($users as $id => $user)
                            <option value="{{ $id }}" {{ ($instruction->user ? $instruction->user->id : old('user_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('user'))
                        <span class="text-danger">{{ $errors->first('user') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.instruction.fields.user_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="company_id">{{ trans('cruds.instruction.fields.company') }}</label>
                    <select class="form-control select2 {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company_id" id="company_id">
                        @foreach($companies as $id => $company)
                            <option value="{{ $id }}" {{ ($instruction->company ? $instruction->company->id : old('company_id')) == $id ? 'selected' : '' }}>{{ $company }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('company'))
                        <span class="text-danger">{{ $errors->first('company') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.instruction.fields.company_helper') }}</span>
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

@section('scripts')
    <script>
        var uploadedImportPdfMap = {}
        Dropzone.options.importPdfDropzone = {
            url: '{{ route('admin.instructions.storeMedia') }}',
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2
            },
            success: function (file, response) {
                $('form').append('<input type="hidden" name="import_pdf[]" value="' + response.name + '">')
                uploadedImportPdfMap[file.name] = response.name
            },
            removedfile: function (file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedImportPdfMap[file.name]
                }
                $('form').find('input[name="import_pdf[]"][value="' + name + '"]').remove()
            },
            init: function () {
                    @if(isset($instruction) && $instruction->import_pdf)
                var files =
                {!! json_encode($instruction->import_pdf) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="import_pdf[]" value="' + file.file_name + '">')
                }
                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        $(document).ready(function () {
            function SimpleUploadAdapter(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                    return {
                        upload: function() {
                            return loader.file
                                .then(function (file) {
                                    return new Promise(function(resolve, reject) {
                                        // Init request
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', '/admin/instructions/ckmedia', true);
                                        xhr.setRequestHeader('x-csrf-token', window._token);
                                        xhr.setRequestHeader('Accept', 'application/json');
                                        xhr.responseType = 'json';

                                        // Init listeners
                                        var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                                        xhr.addEventListener('error', function() { reject(genericErrorText) });
                                        xhr.addEventListener('abort', function() { reject() });
                                        xhr.addEventListener('load', function() {
                                            var response = xhr.response;

                                            if (!response || xhr.status !== 201) {
                                                return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                                            }

                                            $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                                            resolve({ default: response.url });
                                        });

                                        if (xhr.upload) {
                                            xhr.upload.addEventListener('progress', function(e) {
                                                if (e.lengthComputable) {
                                                    loader.uploadTotal = e.total;
                                                    loader.uploaded = e.loaded;
                                                }
                                            });
                                        }

                                        // Send request
                                        var data = new FormData();
                                        data.append('upload', file);
                                        data.append('crud_id', {{ $instruction->id ?? 0 }});
                                        xhr.send(data);
                                    });
                                })
                        }
                    };
                }
            }

            var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor.create(
                    allEditors[i], {
                        extraPlugins: [SimpleUploadAdapter]
                    }
                );
            }
        });
    </script>

@endsection
