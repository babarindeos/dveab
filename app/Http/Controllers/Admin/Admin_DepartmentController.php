<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\College;
use App\Models\Department;
use App\Models\Ministry;
use App\Models\Directorate;
use App\Models\Segment;
use App\Models\Organ;
use App\Models\SegmentOrgan;
use Illuminate\Support\Facades\DB;

class Admin_DepartmentController extends Controller
{
    //
    public function index(){
        $segment = Segment::findOrFail(2);

        $departments = Organ::where('segment_id', $segment->id)
                            ->orderBy('name', 'asc')
                            ->paginate(20);
        
        return view('admin.departments.index', compact('departments'));
    }

    public function create(){
        $segment = Segment::findOrFail(1);

        $directorates = Organ::where('segment_id', $segment->id)
                              ->orderBy('name', 'asc')
                              ->get();
        return view('admin.departments.create', compact('directorates'));
    }

    public function store(Request $request){
        
        $formFields = $request->validate([
            'directorate' => 'required',
            'name' => 'required|string|unique:organs,name',
            'code' => ['required', 'string', 'unique:organs,code']
        ]);

        $segment = Segment::findOrFail(2);

        $formFields['segment_id'] = $segment->id;
        $formFields['parent'] = $formFields['directorate'];       

        DB::beginTransaction();

        try{

            $create = Organ::create($formFields);

            if ($create){
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Department has been successfully created'
                ];

                $current_segment = Segment::findOrFail(2);

                $segment_organs_data = [
                    'segment_id' => $current_segment->id,
                    'organ_id' => $create->id
                ];

                SegmentOrgan::create($segment_organs_data);

            }else{
                /* $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Department'
                ]; */

                throw new \Exception("fatal error creating Department");
            }
    

            DB::commit();

        }catch(\Exception $e)
        {
            $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => $e->getMessage()
            ];

            DB::rollBack();
        }
        
        return redirect()->back()->with($data);
        
    }


    public function edit(Organ $organ){

        
        $segment = Segment::findOrFail(1);

        $directorates = Organ::where('segment_id', $segment->id)
                              ->orderBy('name', 'asc')->get();
        
        $department = $organ;

        return view('admin.departments.edit', compact('directorates', 'department'));
    }

    public function update(Request $request, Organ $organ){
        $formFields = $request->validate([
            'directorate' => 'required',
            'name' => ['required', 'string'],
            'code' => 'required | string'
        ]);

        

        $formFields['parent'] = $formFields['directorate'];

        try{
            $update = $organ->update($formFields);

            if ($update){
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Department has been successfully updated'
                ];
            }else{
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Department'
                ];
            }
        }catch(\Exception $e){
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

        $department = $organ;
        
        return view('admin.departments.confirm_delete', compact('department'));

    }

    public function destroy(Request $request, Department $department)
    {

    }

}
