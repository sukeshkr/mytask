<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use Modules\Admin\Entities\Company;
use Modules\Admin\Http\Requests\CompanyRequest;
use Modules\Admin\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin::company.index');
    }

    public function list(Request $request): JsonResponse
    {
        $search = $request->search;

        $Companies = Company::orderBy('id', 'DESC');

        if ($search != '') {
            $Companies->where('name', 'like', '%' . $search . '%');
        }



        $total = $Companies->count();

        $result['data'] = $Companies->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] = $total;

        return response()->json($result);
    }


    public function create(): View
    {
        return view('admin::company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request): RedirectResponse
    {
        try {

            $values = $request->validated();

            if (request()->hasFile('logo')) {

                $image_path = public_path('uploads/logo');

                if (!File::isDirectory($image_path)) {

                    File::makeDirectory($image_path, 0777, true, true);
                }
                $uploadedFile1 = request()->file('logo');
                $fileName = $uploadedFile1->hashName();
                $uploadedFile1->move($image_path, $fileName);
                $values['logo'] = 'uploads/logo/' . $fileName;
            }

            Company::create($values);

            return redirect()->route('admin.companies.index')->with('success', 'Company added successfully!');
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
    public function edit(Company $company): View
    {
        return view('admin::company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company): RedirectResponse
    {
        try {

            $values = $request->validated();

            if (request()->hasFile('logo')) {

                $image_path = public_path('uploads/logo');

                if (!File::isDirectory($image_path)) {

                    File::makeDirectory($image_path, 0777, true, true);
                }
                $uploadedFile = request()->file('logo');
                $fileName = $uploadedFile->hashName();
                $uploadedFile->move($image_path, $fileName);
                $values['logo'] = 'uploads/logo/' . $fileName;
            }



            $company->update($values);

            return redirect()->route('admin.companies.index')->with('success', 'Company Updated successfully!');


        } catch (\Throwable $th) {

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company): Response
    {
        try {

            $company->delete();

            return response('Deleted successfully!');
        } catch (\Throwable $th) {

            return response($th->getMessage(), 500);
        }
    }
}
