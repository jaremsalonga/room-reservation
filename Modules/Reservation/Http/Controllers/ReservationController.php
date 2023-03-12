<?php

namespace Modules\Reservation\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Reservation\Services\ReservationService;

class ReservationController extends Controller
{
    public function __construct(protected ReservationService $reservationService) {}

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function reserve(Request $request)
    {
        return $this->reservationService->reserve($request);
    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function export(string $id)
    {
        return $this->reservationService->export($id);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('reservation::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('reservation::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('reservation::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
