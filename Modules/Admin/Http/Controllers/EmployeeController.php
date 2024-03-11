<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Modules\Admin\Entities\Company;
use Modules\Admin\Entities\Employee;
use Modules\Admin\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin::employee.index');
    }

    public function list(Request $request): JsonResponse
    {
        $search = $request->search;

        $employees = Employee::with('company')->orderBy('id', 'DESC');

        if ($search != '') {
            $employees->where('first_name', 'like', '%' . $search . '%');
        }

        $total = $employees->count();

        $result['data'] = $employees->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] = $total;

        return response()->json($result);
    }


    public function create(): View
    {
        $companies = Company::all();

        return view('admin::employee.create',compact('companies'));
    }
    public function store(EmployeeRequest $request): RedirectResponse
    {
        try {

            $values = $request->validated();

            Employee::create($values);

            return redirect()->route('admin.employees.index')->with('success', 'Employees added successfully!');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'Something went wrong');;
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee): View
    {
        $companies = Company::all();

        return view('admin::employee.edit',compact('companies','employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee): RedirectResponse
    {
        try {

            $values = $request->validated();

            $employee->update($values);

            return redirect()->route('admin.employees.index')->with('success', 'Employees Updated successfully!');


        } catch (\Throwable $th) {

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {

            $employee->delete();

            return response('Deleted successfully!');
        } catch (\Throwable $th) {

            return response($th->getMessage(), 500);
        }
    }
}
