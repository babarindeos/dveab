<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Department;
use App\Models\Segment;
use App\Models\Organ;
use App\Models\SegmentOrgan;
use Illuminate\Support\Facades\DB;

class Admin_DivisionController extends Controller
{
    //
    public function index()
    {
        $segment = Segment::findOrFail(3);

        $divisions = Organ::where('segment_id', $segment->id)
                          ->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.divisions.index', compact('divisions'));
    }

    public function create()
    {
        $segment = Segment::findOrFail(2);

        $departments = Organ::where('segment_id', $segment->id)
                             ->orderBy('name', 'desc')->get();

        return view('admin.divisions.create')->with('departments', $departments);
    }

    public function store(Request $request)
    {
        $segment = Segment::findOrFail(3);

        $formFields = $request->validate([
            'department' => ['required', 'string'],
            'name' => ['required', 'string', 'unique:divisions,name'],
            'code' => ['required', 'string', 'unique:divisions,code']
        ]);

        $formFields['segment_id'] = $segment->id;
        $formFields['parent'] =  $formFields['department'];
        
        DB::beginTransaction();

        try
        {
            $create = Organ::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'Division has been successfully created'
                ];

                $current_segment = Segment::findOrFail(3);

                $segment_organs_data = [
                    'segment_id' => $current_segment->id,
                    'organ_id' => $create->id
                ];

                SegmentOrgan::create($segment_organs_data);
            }
            else
            {
                /* $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Division'
                ]; */

                throw new \Exception("fatal error creating Division");
            }

            DB::commit();
            
        }
        catch(\Exception $e)
        {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'An error occurred'.$e->getMessage()
                ];

                DB::rollBack();
        }
        
        return redirect()->back()->with($data);
    }

    public function edit(Organ $organ)
    {
        $segment = Segment::findOrFail(2);

        $departments = Organ::where('segment_id', $segment->id)
                                ->orderBy('name', 'asc')->get();

        $division = $organ;

        return view('admin.divisions.edit', ['departments' => $departments, 'division' => $division]);
    }

    public function update(Request $request, Organ $organ)
    {
        $formFields = $request->validate([
            'department' => ['required', 'string'],
            'name' => ['required', 'string'],
            'code' => ['required', 'string'],
        ]);

        $segment = Segment::findOrFail(3);
        $formFields['segment_id'] = $segment->id; 
        $formFields['parent'] = $formFields['department'];

        

        try
        {
            $update = $organ->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'Division has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Division'
                ];
            }
        }
        catch(\Exception $e)
        {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred '.$e->getMessage()
                ];
        }
        
        return redirect()->back()->with($data);

    }

    public function confirm_delete(Organ $organ)
    {
        if ($organ == null)
        {
            return redirect()->back();
        }

        $division = $organ;
        
        return view('admin.divisions.confirm_delete', compact('division'));
    }

    public function destroy()
    {

    }


}
