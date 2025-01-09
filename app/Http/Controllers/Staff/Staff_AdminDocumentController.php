<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminDocument;


class Staff_AdminDocumentController extends Controller
{
    //
    public function index()
    {
        $documents = AdminDocument::orderby('id', 'desc')->paginate(10);
        return view('staff.admin_documents.index', compact('documents'));
    }
}
