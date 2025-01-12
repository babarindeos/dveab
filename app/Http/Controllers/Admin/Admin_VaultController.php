<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FinancialYear;

class Admin_VaultController extends Controller
{
    //
    public function create(FinancialYear $financial_year)
    {
        return view('admin.financial_years.create_vault', compact('financial_year'));
    }
}
