<?php

namespace App\Http\Controllers\Web;

use App\Forms\TypeForm;
use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;

class TypeController extends Controller
{

    private $_formBuilder;

    public function __construct(FormBuilder $builder)
    {
        $this->_formBuilder = $builder;
        $this->middleware('role:super_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response|mixed
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $types = Type::withTrashed()->get();
            return DataTables::of($types)
                ->addIndexColumn()
                ->addColumn('action', function ($type) {
                    return view('pages.types._actions', compact('type'));
                })
                ->addColumn('effective', function ($type) {
                    return view('pages.types._effective', compact('type'));
                })
                ->addColumn('status', function ($type) {
                    return view('pages.types._status', compact('type'));
                })
                ->rawColumns(['action', 'status', 'effective'])
                ->make();
        }
        return view('pages.types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|mixed
     */
    public function create()
    {
        $form = $this->_getForm();
        return view('pages.types.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response|mixed
     */
    public function store(Request $request)
    {
        $form = $this->_getForm();
        $form->redirectIfNotValid();
        $type = $this->_fillTypeData($request);
        $type->save();
        return redirect()->route('type_index')
            ->with(
                'success',
                __('labels.actions.messages.created_content')
            );
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Response|mixed
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $type = Type::with('cars.pictures')->find($id);
        if (empty($type)) {
            $type = Type::withTrashed()->with('cars')->find($id);
            if (empty($type)) {
                return redirect()->route('type_index')
                    ->with(
                        'error',
                        __('labels.actions.messages.error.not_found')
                    );
            }
        }
        return view('pages.types.details', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @return Response|mixed
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $type = Type::query()->find($id);
        if (empty($type)) {
            $type = Type::withTrashed()->find($id);
            if (empty($type)) {
                return redirect()->route('type_index')
                    ->with(
                        'error',
                        __('labels.actions.messages.error.not_found')
                    );
            }
        }
        $form = $this->_getForm($type);
        return view('pages.types.create', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response|mixed
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $type = Type::query()->find($id);
        if (empty($type)) {
            return redirect()->route('type_index')
                ->with(
                    'error',
                    __('labels.actions.messages.error.not_found')
                );
        }
        $form = $this->_getForm($type);
        $form->redirectIfNotValid();
        $type = $this->_fillTypeData($request, $type);
        $type->update();
        return redirect()->route('type_index')
            ->with(
                'success',
                __('labels.actions.messages.updated_content')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return Response|mixed
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $type = Type::query()->find($id);
        if (empty($type)) {
            return redirect()->route('type_index')
                ->with(
                    'error',
                    __('labels.actions.messages.error.not_found')
                );
        }
        $type->delete();
        return redirect()->route('type_index')
            ->with(
                'success',
                __('labels.actions.messages.deleted_content')
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Request $request
     * @return Response|mixed
     */
    public function restore(Request $request)
    {
        $id = $request->id;
        $type = Type::withTrashed()->find($id);
        if (empty($type)) {
            return redirect()->route('type_index')
                ->with(
                    'error',
                    __('labels.actions.messages.error.not_found')
                );
        }
        $type->restore();
        return redirect()->route('type_index')
            ->with(
                'success',
                __('labels.actions.messages.restored_content')
            );
    }

    /**
     * Fill Type's data
     *
     * @param Request $request
     * @param Type|null $type
     * @return Type|null
     */
    private function _fillTypeData(Request $request, Type $type = null)
    {
        $type = $type ?: new Type();
        $type->amount = $request->input('amount');
        $type->label = $request->input('label');
        return $type;
    }

    /**
     * Create the type form with default model or not
     *
     * @param Type|null $type
     * @return Form
     */
    private function _getForm(Type $type = null)
    {
        $type = $type ?: new Type();
        return $this->_formBuilder->create(
            TypeForm::class,
            [
                'model' => $type
            ]
        );
    }
}
