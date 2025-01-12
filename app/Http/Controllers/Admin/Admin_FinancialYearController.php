<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FinancialYear;

class Admin_FinancialYearController extends Controller
{
    //
    public function index()
    {
            $financial_years = FinancialYear::orderBy('created_at', 'desc')->get();
            return view('admin.financial_years.index', compact('financial_years'));
    }

    public function create()
    {
            return view('admin.financial_years.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'start_date' => ['required', 'date', 'before:end_date'],
            'end_date' => ['required', 'date', 'after:start_date'],
        ]);


        try
        {
            $create = FinancialYear::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Financial Year has been successfully created'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Financial Year'
                ];
            }
        }
        catch(\Exception $e)
        {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => $e->getMessage()
                ];
        }


        return redirect()->back()->with($data);


    }

    public function edit(FinancialYear $financial_year)
    {
        return view('admin.financial_years.edit', compact('financial_year'));
    }

    public function update(Request $request, FinancialYear $financial_year)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'start_date' => ['required', 'date', 'before:end_date'],
            'end_date' => ['required', 'date', 'after:start_date']
        ]);

        try
        {
            $updated = $financial_year->update($formFields);


        }
        catch(\Exception $e)
        {

        }
    }

    public function show(FinancialYear $financial_year)
    {
        return view('admin.financial_years.show', compact('financial_year'));
    }
}
