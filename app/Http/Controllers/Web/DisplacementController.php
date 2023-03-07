<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Displacement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class DisplacementController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|super_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response|mixed
     */
    public function index(Request $request)
    {
        if ($request) {
            if ($request->ajax()) {
                $trips = Displacement::with(['client', 'car.user'])
                    ->orderBy('created_at', 'desc')
                    ->get();
                try {
                    return DataTables::of($trips)
                        ->addIndexColumn()
                        ->addColumn('action', function ($trip) {
                            return view('pages.displacements._actions', compact('trip'));
                        })
                        ->addColumn('status', function ($trip) {
                            return view('pages.displacements._status', compact('trip'));
                        })
                        ->addColumn('driver', function ($trip) {
                            return view('pages.displacements._driver', compact('trip'));
                        })
                        ->addColumn('client', function ($trip) {
                            return view('pages.displacements._client', compact('trip'));
                        })
                        ->rawColumns(['action', 'client', 'driver', 'status'])
                        ->make();
                } catch (\Exception $e) {
                }
            }
        }
        return view('pages.displacements.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|mixed
     */
    public function create()
    {
        $role = Role::findByName('driver');
        dd($role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response|mixed
     */
    public function store(Request $request)
    {
        //
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
        $trip = Displacement::with(['alerts', 'client', 'car.user'])->find($id);
        if (empty($trip)) {
                return redirect()->route('displacement_index')
                    ->with(
                        'error',
                        __('labels.actions.messages.error.not_found')
                    );
        }
        return view('pages.displacements.details', compact('trip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Displacement $displacement
     * @return Response|mixed
     */
    public function edit(Displacement $displacement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Displacement $displacement
     * @return Response|mixed
     */
    public function update(Request $request, Displacement $displacement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Displacement $displacement
     * @return Response|mixed
     */
    public function destroy(Displacement $displacement)
    {
        //
    }
}
