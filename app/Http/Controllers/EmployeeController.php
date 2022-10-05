<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\EmployeeResource;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): AnonymousResourceCollection
    {
        $employee = Employee::all();
        if(empty($employee)) return response(404);
        
        return EmployeeResource::collection($employee);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = Employee::create($request->all());
        if(empty($employee)) return response(404);

        return new EmployeeResource($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): EmployeeResource
    {
        $employee = Employee::findOrFail($id);

        if(empty($employee)) return response(404);

        return new EmployeeResource($employee);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): EmployeeResource
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): EmployeeResource
    {
        $employee = Employee::findOrFail($id);

        if(empty($employee)) return response(404);

        $employee->update($request->all());

        return new EmployeeResource($employee->refresh());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        if(empty($employee)) return response(404);

        $employee->delete();

        return response()->noContent();
    }
}
