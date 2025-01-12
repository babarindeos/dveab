<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Segment;
use App\Models\SegmentOrgan;
use App\Models\Organ;

class Admin_DirectorateController extends Controller
{

    //
    public function index()
    {
        $directorates = Organ::where('segment_id', 1)
                              ->orderBy('name','asc')
                              ->orderBy('code','asc')
                              ->paginate(20);
        return view('admin.directorates.index', compact('directorates'));
    }

    public function create()
    {
        return view('admin.directorates.create');
    }


    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'string', 'unique:organs,name'],
            'code' => ['required', 'string', 'unique:organs,code']
        ]);

       /*  $directorate_exist = Directorate::where('name', $request->input('name'))
                                    ->Orwhere('code', $request->input('code'))
                                    ->exists(); */

        

            DB::beginTransaction();

            try
            {   

                $current_segment = Segment::findOrFail(1);
                
                $formFields['segment_id'] = $current_segment->id;

                $create = Organ::create($formFields);

                if ($create)
                {
                    $data = [
                        'error' => true,
                        'status' => 'success',
                        'message' => 'Directorate has been successfully created'
                    ];

                    

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
                        'message' => 'An error occurred creating the Directorate. '
                    ]; */
                    throw new \Exception("fatal creation of Directorate");
                }

                DB::commit();
            }
            catch(\Exception $e)
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

    public function show(Directorate $directorate)
    {
        $departments = Department::where('directorate_id', $directorate->id)->paginate(2);
        
        return view('admin.directorates.show', compact('directorate','departments'));
    }


    public function edit(Organ $organ)
    {
        $directorate = $organ;
        return view('admin.directorates.edit', compact('directorate'));
    }

    public function update(Request $request, Organ $organ)
    {
        $formFields = $request->validate([
            'name' => 'required | string',
            'code' => 'required | string'
        ]);


        try
        {
            $update = $organ->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Directorate has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Directorate'
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

    public function confirm_delete(Organ $organ)
    {
        
        return view('admin.directorates.confirm_delete', compact('organ'));

    }

    public function destroy(Request $request, Directorate $directorate)
    {

    }




}
