<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySentInstructionRequest;
use App\Http\Requests\StoreSentInstructionRequest;
use App\Http\Requests\UpdateSentInstructionRequest;
use App\Instruction;
use App\SentInstruction;
use App\Status;
use App\User;
use App\Worker;
use App\WorkersList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SentInstructionsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('sent_instruction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SentInstruction::with(['user', 'status', 'workers_list', 'instruction', 'workers', 'team'])->select(sprintf('%s.*', (new SentInstruction)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'sent_instruction_show';
                $editGate      = 'sent_instruction_edit';
                $deleteGate    = 'sent_instruction_delete';
                $crudRoutePart = 'sent-instructions';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('url', function ($row) {
                return $row->url ? $row->url : "";
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->addColumn('workers_list_name', function ($row) {
                return $row->workers_list ? $row->workers_list->name : '';
            });

            $table->addColumn('instruction_name', function ($row) {
                return $row->instruction ? $row->instruction->name : '';
            });

            $table->editColumn('worker', function ($row) {
                $labels = [];

                foreach ($row->workers as $worker) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $worker->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'status', 'workers_list', 'instruction', 'worker']);

            return $table->make(true);
        }

        return view('admin.sentInstructions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sent_instruction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workers_lists = WorkersList::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $instructions = Instruction::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workers = Worker::all()->pluck('name', 'id');

        return view('admin.sentInstructions.create', compact('users', 'statuses', 'workers_lists', 'instructions', 'workers'));
    }

    public function store(StoreSentInstructionRequest $request)
    {
        $sentInstruction = SentInstruction::create($request->all());
        $sentInstruction->workers()->sync($request->input('workers', []));

        return redirect()->route('admin.sent-instructions.index');

    }

    public function edit(SentInstruction $sentInstruction)
    {
        abort_if(Gate::denies('sent_instruction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workers_lists = WorkersList::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $instructions = Instruction::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workers = Worker::all()->pluck('name', 'id');

        $sentInstruction->load('user', 'status', 'workers_list', 'instruction', 'workers', 'team');

        return view('admin.sentInstructions.edit', compact('users', 'statuses', 'workers_lists', 'instructions', 'workers', 'sentInstruction'));
    }

    public function update(UpdateSentInstructionRequest $request, SentInstruction $sentInstruction)
    {
        $sentInstruction->update($request->all());
        $sentInstruction->workers()->sync($request->input('workers', []));

        return redirect()->route('admin.sent-instructions.index');

    }

    public function show(SentInstruction $sentInstruction)
    {
        abort_if(Gate::denies('sent_instruction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sentInstruction->load('user', 'status', 'workers_list', 'instruction', 'workers', 'team');

        return view('admin.sentInstructions.show', compact('sentInstruction'));
    }

    public function destroy(SentInstruction $sentInstruction)
    {
        abort_if(Gate::denies('sent_instruction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sentInstruction->delete();

        return back();

    }

    public function massDestroy(MassDestroySentInstructionRequest $request)
    {
        SentInstruction::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
