<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Staff;
use App\Models\User;
use App\Models\Workflow;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class Admin_DashboardController extends Controller
{
    //
    public function index(){

        $documents_count = Document::count();
        $users_count = User::count();
        $staff_count = Staff::count();
        $workflows_count = Workflow::count();
        $departments_count = Department::count();

        // directorate documents
        $segment_documents = DB::table("documents")
                                    ->join("users", "documents.uploader", "users.id")
                                    ->join("staff", "users.id", "staff.user_id")
                                    ->join("segments", "segments.id", "staff.segment_id")
                                    ->select("segments.name", DB::raw("COUNT(documents.id) as document_count"))->groupBy("users.id")->get();

        
        // Staff in Organs
        $staff_segments = DB::table("segments")
                          ->join("staff", "staff.segment_id", "=", "segments.id")
                          ->select("segments.name", DB::raw("COUNT(staff.id) as staff_count"))->groupBy("segments.name")->get();
        
        

    /****** 

        /* $ministries_documents = DB::table("documents")
                                    ->join("users", "documents.uploader","=", "users.id")
                                    ->join("staff", "users.id", "staff.user_id")
                                    ->join("departments", "staff.department_id", "departments.id")
                                    ->join("ministries", "departments.ministry_id", "ministries.id")
                                    ->select("users.*", "staff.*", "departments.*", "ministries.*", "uploader")->groupBy("users.id")->get(); 
        

        $ministries_documents = DB::table("documents")
                                ->join("users", "documents.uploader","=", "users.id")
                                ->join("staff", "users.id", "=", "staff.user_id")
                                ->join("departments", "staff.department_id", "=", "departments.id")
                                ->join("ministries", "departments.ministry_id", "=", "ministries.id")
                                ->select("ministries.name", DB::raw("COUNT(documents.id) as document_count"))->groupBy("ministries.name")->get();


        $departments_documents = DB::table("documents")
                                ->join("users", "documents.uploader","=", "users.id")
                                ->join("staff", "users.id", "=", "staff.user_id")
                                ->join("departments", "staff.department_id", "=", "departments.id")        
                                ->select("departments.department_name", DB::raw("COUNT(documents.id) as document_count"))->groupBy("departments.department_name")->get();


        $staff_ministries = DB::table("ministries")
                                ->join("departments", "departments.ministry_id", "=", "ministries.id")
                                ->join("staff", "staff.department_id", "=", "departments.id")
                                ->select("ministries.name", DB::raw("COUNT(staff.id) as staff_count"))->groupBy("ministries.name")->get();
       

        $staff_departments = DB::table("ministries")
                                ->join("departments", "departments.ministry_id", "=", "ministries.id")
                                ->join("staff", "staff.department_id", "=", "departments.id")
                                ->select("departments.department_name", DB::raw("COUNT(staff.id) as staff_count"))->groupBy("departments.department_name")->get();
       
        
                

        // Ministry Document Chart Data
        $ministries_documents_chart_data = [];
        $item = ['Ministry', 'Documents'];        
        array_push($ministries_documents_chart_data, $item);

        foreach($ministries_documents as $mds)
        {
            $item = [];
            $item[0] = $mds->name;
            $item[1] = intval($mds->document_count);
            array_push($ministries_documents_chart_data, $item);
        }
       //dd($ministries_documents_chart_data);

       // Department Document Chart Data
       $departments_documents_chart_data = [];
       $item = ['Department', 'Documents'];
       array_push($departments_documents_chart_data, $item);

       foreach($departments_documents as $dds)
       {
            $item = [];
            $item[0] = $dds->department_name;
            $item[1] = intval($dds->document_count);
            array_push($departments_documents_chart_data, $item);
       }

       // Ministry Staff Chart Data
       $ministries_staff_chart_data = [];
       $item = ['Ministries', 'Staff'];
       array_push($ministries_staff_chart_data, $item);

       foreach($staff_ministries as $sm)
       {
            $item = [];
            $item[0] = $sm->name;
            $item[1] = intval($sm->staff_count);
            array_push($ministries_staff_chart_data, $item);
       }

       // Department Staff Chart Data
       $departments_staff_chart_data = [];
       $item = ['Departments', 'Staff'];
       array_push($departments_staff_chart_data, $item);

       foreach($staff_departments as $sd)
       {
            $item = [];
            $item[0] = $sd->department_name;
            $item[1] = intval($sd->staff_count);
            array_push($departments_staff_chart_data, $item);
       }

       //dd($ministries_staff_chart_data);       
        

         return view('admin.dashboard')->with([
            "documents_count" => $documents_count,
            "users_count" => $users_count,
            "staff_count" =>$staff_count,
            "workflows_count" => $workflows_count,
            "departments_count" => $departments_count,
            "ministries_documents_chart_data" => $ministries_documents_chart_data,
            "departments_documents_chart_data" => $departments_documents_chart_data,
            "ministries_staff_chart_data" => $ministries_staff_chart_data,
            "departments_staff_chart_data" => $departments_staff_chart_data
        ]); 

    *****/


    


       // Segment Document Chart Data
       $segment_documents_chart_data = [];
       $item = ['Organs', 'Documents'];
       array_push($segment_documents_chart_data, $item);

       foreach($segment_documents as $sd)
       {
            $item = [];
            $item[0] = $sd->name;
            $item[1] = intval($sd->document_count);
            array_push($segment_documents_chart_data, $item);
       }

       
       // Segment Staff Chart Data
       $segment_staff_chart_data = [];
       $item = ['Organs', 'Staff'];
       array_push($segment_staff_chart_data, $item);

       foreach($staff_segments as $ss)
       {
            $item = [];
            $item[0] = $ss->name;
            $item[1] = intval($ss->staff_count);
            array_push($segment_staff_chart_data, $item);
       }

       

       

        return view('admin.dashboard')->with([
            "documents_count" => $documents_count,
            "users_count" => $users_count,
            "staff_count" =>$staff_count,
            "workflows_count" => $workflows_count,
            "departments_count" => $departments_count,
            "segment_documents_chart_data" => $segment_documents_chart_data,
            "segment_staff_chart_data" => $segment_staff_chart_data,
        ]);

    }
}
