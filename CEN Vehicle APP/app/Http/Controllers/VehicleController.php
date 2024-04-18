<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::select('id','code','vehicle')->orderBy('id','DESC')->paginate(5);
        return view('vehicle.list', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicles = Vehicle::select('id','code','vehicle')->get();
        return view('vehicle.create', compact('vehicles'));
        $notification = array(
            'message' => 'Vehicle Added successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_name' => ['required'],
            'vehicle_code' => ['required'],
        ]);
        $data = [
            'code'      =>  $request->vehicle_code,
            'vehicle'     =>  $request->vehicle_name,
        ];
        $user = Vehicle::create($data);
        return redirect('/vehicles');
        // $notification = array(
        //     'message' => 'Vehicle Created successfully',
        //     'alert-type' => 'success'
        // );
        // return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $vehicles=Vehicle::find($id);
        return view('vehicle.view', compact('vehicles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $vehicles=Vehicle::find($id);
        return view('vehicle.edit', compact('vehicles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'vehicle' => 'required',
            'code' => 'required',
          ]);
          $vehicle_update = Vehicle::find($id);
          $vehicle_update->update($request->all());
          return redirect('/vehicles')->with('success', 'Vehicle record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $vehicle_records=Vehicle::find($id);  
        $vehicle_records->delete();  
        return redirect('/vehicles')->with('success', 'Driver record deleted successfully.');
    }
}
