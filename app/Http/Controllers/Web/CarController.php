<?php

namespace App\Http\Controllers\Web;

use App\Forms\CarForm;
use App\Http\Controllers\Controller;
use App\Http\Upload\UploadTrait;
use App\Models\Car;
use App\Models\Picture;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;

class CarController extends Controller
{
    use UploadTrait;

    private $_formBuilder;

    public function __construct(FormBuilder $builder)
    {
        $this->_formBuilder = $builder;
        $this->middleware('role:super_admin')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response|mixed
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cars = Car::withTrashed()->get();
            return DataTables::of($cars)
                ->addIndexColumn()
                ->addColumn('action', function ($car) {
                    return view('pages.cars._actions', compact('car'));
                })
                ->addColumn('type', function ($car) {
                    return view('pages.cars._type', compact('car'));
                })
                ->addColumn('owner', function ($car) {
                    return view('pages.cars._owner', compact('car'));
                })
                ->rawColumns(['action', 'owner', 'type'])
                ->make();
        }
        return view('pages.cars.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|mixed
     */
    public function create()
    {
        $form = $this->_getForm();
        $car = new Car();
        return view('pages.cars.create', compact('form', 'car'));
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
        $car = $this->_fillCarData($request);
        $car->save();
        if (!empty($request->file('pictures'))) {
            $this->uploadCarPictures($request->file('pictures'), $car);
        }
        return redirect()->route('car_index')
            ->with(
                'success',
                __('labels.actions.messages.success.created')
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
        $car = Car::with(['user', 'type', 'pictures', 'displacements'])->find($id);
        if (empty($car)) {
            $car = Car::withTrashed()->find($id);
            if (empty($car)) {
                return redirect()->route('car_index')
                    ->with(
                        'error',
                        __('labels.actions.messages.error.not_found')
                    );
            }
        }
        return view('pages.cars.details', compact('car'));
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
        $car = Car::with('pictures')->find($id);
        if (empty($car)) {
            $car = Car::withTrashed()->with('pictures')->find($id);
            if (empty($car)) {
                return redirect()->route('car_index')
                    ->with(
                        'error',
                        __('labels.actions.messages.error.not_found')
                    );
            }
        }
//        dd($car->pictures);
        $form = $this->_getForm($car);
        return view('pages.cars.create', compact('form', 'car'));
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
        $car = Car::query()->find($id);
        if (empty($car)) {
            return redirect()->route('car_index')
                ->with(
                    'error',
                    __('labels.actions.messages.error.not_found')
                );
        }
        $form = $this->_getForm($car);
        $form->redirectIfNotValid();
        $car = $this->_fillCarData($request, $car);
        $car->update();
        if (!empty($request->file('pictures'))) {
            foreach ($request->file('pictures') as $file) {
                if (!File::exists(public_path('assets/images/cars/' . $file->getClientOriginalName()))) {
                    $this->uploadCarPictures($file, $car);
                }
            }
        }
        return redirect()->route('car_index')
            ->with(
                'success',
                __('labels.actions.messages.success.updated')
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
        $car = Car::query()->find($id);
        if (empty($car)) {
            return redirect()->route('car_index')
                ->with(
                    'error',
                    __('labels.actions.messages.error.not_found')
                );
        }
        $car->delete();
        return redirect()->route('car_index')
            ->with(
                'success',
                __('labels.actions.messages.success.deleted')
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
        $car = Car::withTrashed()->find($id);
        if (empty($car)) {
            return redirect()->route('car_index')
                ->with(
                    'error',
                    __('labels.actions.messages.error.not_found')
                );
        }
        $car->restore();
        return redirect()->route('car_index')
            ->with(
                'success',
                __('labels.actions.messages.success.restored')
            );
    }

    /**
     * Delete car picture
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function removeImage(Request $request)
    {
        $id = $request->input('id');
        $img = Picture::query()->find($id);
        if (!empty($img)) {
            File::delete(public_path('assets/images/cars/' . $img->src));
            $img->delete();
            return \response()->json(['success' => 'Supprimé!']);
        }
        return \response()->json(['error' => 'Not found!']);
    }

    /**
     * Fill car's data
     *
     * @param Request $req
     * @param Car|null $car
     * @return Car|null
     */
    private function _fillCarData(Request $req, ?Car $car = null)
    {
        $c = $car ?: new Car();
        $c->color = $req->input('color');
        $c->gray_card = $req->input('gray_card');
        $c->model = $req->input('model');
        $c->registration_number = $req->input('registration_number');
        $c->type_id = $req->input('type_id');
        $c->user_id = $req->input('user_id');
        return $c;
    }

    /**
     * Form to manage Car's data
     *
     * @param Car|null $car
     * @return Form
     */
    private function _getForm(?Car $car = null)
    {
        $car = $car ?: new Car();
        return $this->_formBuilder->create(
            CarForm::class,
            [
                'model' => $car
            ]
        );
    }
}
