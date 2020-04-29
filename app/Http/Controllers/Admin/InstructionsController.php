<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Company;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyInstructionRequest;
use App\Http\Requests\StoreInstructionRequest;
use App\Http\Requests\UpdateInstructionRequest;
use App\Instruction;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InstructionsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('instruction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Instruction::with(['user', 'company', 'category', 'team'])->select(sprintf('%s.*', (new Instruction)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'instruction_show';
                $editGate      = 'instruction_edit';
                $deleteGate    = 'instruction_delete';
                $crudRoutePart = 'instructions';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('url', function ($row) {
                return $row->url ? $row->url : "";
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('company_name', function ($row) {
                return $row->company ? $row->company->name : '';
            });

            $table->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'company', 'category']);

            return $table->make(true);
        }

        return view('admin.instructions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('instruction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.instructions.create', compact('users', 'companies', 'categories'));
    }

    public function store(StoreInstructionRequest $request)
    {
        $instruction = Instruction::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $instruction->id]);
        }

        return redirect()->route('admin.instructions.index');

    }

    public function edit(Instruction $instruction)
    {
        abort_if(Gate::denies('instruction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $instruction->load('user', 'company', 'category', 'team');

        return view('admin.instructions.edit', compact('users', 'companies', 'categories', 'instruction'));
    }

    public function update(UpdateInstructionRequest $request, Instruction $instruction)
    {
        $instruction->update($request->all());

        return redirect()->route('admin.instructions.index');

    }

    public function show(Instruction $instruction)
    {
        abort_if(Gate::denies('instruction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instruction->load('user', 'company', 'category', 'team');

        return view('admin.instructions.show', compact('instruction'));
    }

    public function destroy(Instruction $instruction)
    {
        abort_if(Gate::denies('instruction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instruction->delete();

        return back();

    }

    public function massDestroy(MassDestroyInstructionRequest $request)
    {
        Instruction::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('instruction_create') && Gate::denies('instruction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Instruction();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
