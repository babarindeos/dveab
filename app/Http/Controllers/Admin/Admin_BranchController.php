<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Branch;
use App\Models\Organ;
use App\Models\Segment;
use App\Models\SegmentOrgan;
use Illuminate\Support\Facades\DB;


class Admin_BranchController extends Controller
{
    //
    public function index()
    {
        $branch_segment = Segment::findOrFail(4);

        $branches = Organ::where('segment_id', $branch_segment->id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(20);
        

        
        return view('admin.branches.index')->with('branches', $branches);
    }

    public function create()
    {
        $division_segment = Segment::findOrFail(3);
        $divisions = Organ::where('segment_id', $division_segment->id)
                          ->orderBy('created_at', 'asc')->get();

        return view('admin.branches.create', compact('divisions'));
    }


    public function store(Request $request)
    {

        $formFields = $request->validate([
            'division' => ['required', 'string'],
            'name' => ['required', 'string', 'unique:organs,name'],
            'code' => ['required', 'string', 'unique:organs,code']
        ]);

        $branch_segment = Segment::findOrFail(4);

        $formFields['parent'] = $formFields['division'];
        $formFields['segment_id'] = $branch_segment->id;


        DB::beginTransaction();

        try
        {
            $create = Organ::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'Branch has been successfully created'
                ];

                $current_segment = Segment::findOrFail(4);

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
                    'message' => 'An error occurred creating the Branch'
                ]; */
                throw new \Exception("fatal error creating Branch");
            }

            DB::commit();
            
        }
        catch(\Exception $e)
        {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred'.$e->getMessage()
                ];

                DB::rollBack();
        }
        
        return redirect()->back()->with($data);
    }

    public function edit(Branch $branch)
    {
        $divisions = Division::orderBy('name', 'asc')->get();

        return view('admin.branches.edit', ['divisions' => $divisions, 'branch' => $branch]);
    }

    public function update(Request $request, Branch $branch)
    {
        $formFields = $request->validate([
            'division' => ['required', 'string'],
            'name' => ['required', 'string'],
            'code' => ['required', 'string'],
        ]);

        $formFields['division_id'] = $formFields['division'];

        try
        {
            $update = $branch->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'Branch has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Branch'
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

    public function confirm_delete(Branch $branch)
    {
        if ($branch == null)
        {
            return redirect()->back();
        }

        return view('admin.branches.destroy', compact('branch'));
    }

    public function destroy()
    {

    }


}
