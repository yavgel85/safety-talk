@can($viewGate)
    <a class="btn btn-xs btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
        {{ trans('global.view') }}
    </a>
@endcan
@can($editGate)
    <a class="btn btn-xs btn-info" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
        {{ trans('global.edit') }}
    </a>
@endcan
@if(isset($showGate))
    @can($showGate)
{{--        <a class="btn btn-xs btn-secondary" href="{{ route('admin.' . $crudRoutePart . '.show_mw', $row->id) }}">--}}
{{--            {{ trans('global.show') }}--}}
{{--        </a>--}}

{{--        <form action="{{ route('admin.' . $crudRoutePart . '.show_mw', $row->id) }}" method="POST" style="display: inline-block;">--}}
{{--            <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
            <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-xs btn-secondary" data-toggle="modal" data-target="#showModal">
                {{ trans('global.show') }}
            </button>
            <!-- Modal -->
            <div id="showModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal Header</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <embed src="{{ asset('/storage/Invitation.pdf') }}" frameborder="0" width="100%" height="400px">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
{{--        </form>--}}
    @endcan
@endif
@if(isset($sendGate))
    @can($sendGate)
{{--        <a class="btn btn-xs btn-warning" href="{{ route('admin.' . $crudRoutePart . '.send', $row->id) }}">--}}
{{--            {{ trans('global.send') }}--}}
{{--        </a>--}}

        <form action="{{ route('admin.' . $crudRoutePart . '.send', $row->id) }}" method="POST" style="display: inline-block;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#sendModal">
                {{ trans('global.send') }}
            </button>
            <!-- Modal -->
            <div id="sendModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Sending of Instruction</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="user_id">Site Manager</label>
                                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                                    @foreach($siteManagers as $id => $user)
                                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('user'))
                                    <span class="text-danger">{{ $errors->first('user') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.instruction.fields.user_helper') }}</span>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" >Send</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endcan
@endif
@can($deleteGate)
    <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
    </form>
@endcan
