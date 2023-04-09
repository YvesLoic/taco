<?php

namespace App\Http\Controllers\Web;

use App\Forms\CityForm;
use App\Http\Controllers\Controller;
use App\Models\City;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;

class CityController extends Controller
{
    private $_formBuilder;

    public function __construct(FormBuilder $formBuilder)
    {
        $this->_formBuilder = $formBuilder;
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
            $cities = City::all();
            return DataTables::of($cities)
                ->addIndexColumn()
                ->addColumn('action', function ($city) {
                    return view('pages.cities._actions', compact('city'));
                })
                ->addColumn('effective', function ($city) {
                    return view('pages.cities._effective', compact('city'));
                })
                ->addColumn('country', function ($city) {
                    return view('pages.cities._country', compact('city'));
                })
                ->rawColumns(['action', 'effective', 'country'])
                ->make();
        }
        return view('pages.cities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|mixed
     */
    public function create()
    {
        $form = $this->_getForm();
        return view('pages.cities.create', compact('form'));
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
        $city = $this->_fillCityData($request);
        $city->save();
        return redirect()->route('city_index')
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
        $city = City::with('users')->find($id);
        if (empty($city)) {
            $city = City::withTrashed()->with('users')->find($id);
            if (empty($city)) {
                return redirect()->route('city_index')
                    ->with(
                        'error',
                        __('labels.actions.messages.error.not_found')
                    );
            }
        }
        return view('pages.cities.details', compact('city'));
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
        $city = City::query()->find($id);
        if (empty($city)) {
            $city = City::withTrashed()->find($id);
            if (empty($city)) {
                return redirect()->route('city_index')
                    ->with(
                        'error',
                        __('labels.actions.messages.error.not_found')
                    );
            }
        }
        $form = $this->_getForm($city);
        return view('pages.cities.create', compact('form'));
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
        $city = City::query()->find($id);
        if (empty($city)) {
            return redirect()->route('city_index')
                ->with(
                    'error',
                    __('labels.actions.messages.error.not_found')
                );
        }
        $form = $this->_getForm($city);
        $form->redirectIfNotValid();
        $city = $this->_fillCityData($request, $city);
        $city->update();
        return redirect()->route('city_index')
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
        $city = City::query()->find($id);
        if (empty($city)) {
            return redirect()->route('city_index')
                ->with(
                    'error',
                    __('labels.actions.messages.error.not_found')
                );
        }
        $city->delete();
        return redirect()->route('city_index')
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
        $city = City::withTrashed()->find($id);
        if (empty($city)) {
            return redirect()->route('city_index')
                ->with(
                    'error',
                    __('labels.actions.messages.error.not_found')
                );
        }
        $city->restore();
        return redirect()->route('city_index')
            ->with(
                'success',
                __('labels.actions.messages.success.restored')
            );
    }

    /**
     * Fill City's data
     *
     * @param Request $request
     * @param City|null $city
     * @return City
     */
    private function _fillCityData(Request $request, City $city = null)
    {
        $city = $city ?: new City();
        $city->country_id = $request->input('country_id');
        $city->name = $request->input('name');
        return $city;
    }

    /**
     * Create the type form with default model or not
     *
     * @param City|null $city
     * @return Form
     */
    private function _getForm(City $city = null)
    {
        $city = $city ?: new City();
        return $this->_formBuilder->create(
            CityForm::class,
            [
                'model' => $city
            ]
        );
    }
}
