<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;
use App\Http\Classes\OrganClass;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Signature;


class Staff_ProfileController extends Controller
{
    //

    public function create()
    {
        $isProfile = Profile::where('user_id', Auth::user()->id)->first();

        return view('staff.profile.create')->with('profile', $isProfile);
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([            
            'designation' => 'required',
            'phone' => 'required'
        ]);

        $avatar = '';
        $new_filename = '';
        $user_id = '';
        $bio = '';

        $user_id = auth()->user()->id;

        if ($request->hasFile('avatar'))
        {
           
            $filename = $user_id;

            $avatar_file = $request->file('avatar');
            $new_filename = $filename.'.'.$avatar_file->getClientOriginalExtension();

            $avatar_file->storeAs('avatars', $new_filename);
        }

        if ($new_filename!='')
        {
            $new_filename = 'avatars/'.$new_filename;
        }

        try
        {

            $isProfile = Profile::where('user_id', auth()->user()->id)->first();
            

            if ($isProfile && $new_filename=='')
            {
                $new_filename = $isProfile->avatar;               
            }

            $store_data = [
                'user_id' => $user_id,
                'designation' => $formFields['designation'],
                'phone' => $formFields['phone'],
                'avatar' => $new_filename,
                'bio' => $bio
            ];
           
            

            if ($isProfile==null)
            {
                $create = Profile::create($store_data);

                if ($create)
                {
                    $data = [
                        'error' => true,
                        'status' => 'success',
                        'message' => 'Profile has been successfully created'
                    ];
                }
                else
                {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => 'An error occurred creating your Profile'
                    ];
                }
            }
            else
            {
                
                $update = $isProfile->update($store_data);

                if ($update)
                {
                    $data = [
                        'error'=> true,
                        'status' => 'success',
                        'message' => 'Profile has been successfully updated'
                    ];
                }
                else
                {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => 'An error occurred updating your Profile'
                    ];
                }
            }
        }
        catch(\Exception $e)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => 'An error occurred '.$e->getMessage()
            ];
            dd($e->getMessage());
        }

        $isProfile = Profile::where('user_id', Auth::user()->id)->first();

        return redirect()->back()->with(['profile' => $isProfile]);
    }

    public function upload_avatar(Request $request)
    {
        dd($request->hasFile('avatar'));
    }

    public function myprofile()
    {
        $currentUser = Auth::user();

        //$userprofile = Staff::where('fileno', $fileno)->first();
        $userprofile = $currentUser->staff;

        $organ = OrganClass::getOrganBySegment($userprofile);

        return view('staff.profile.myprofile', compact('userprofile', 'organ'));
    }

    public function edit()
    {
        return view('staff.profile.edit');
    }

    public function update(Request $request)
    {
        $formFields = $request->validate([
            'designation' => 'required',
            'phone' => 'required'
        ]);

        $profile = Profile::where('user_id', auth()->user()->id)->first();
        
        $profile->designation = $formFields['designation'];
        $profile->phone = $formFields['phone'];
        $profile->update();

        return redirect()->route('staff.profile.myprofile');
    }

    public function update_avatar(Request $request)
    {
        $formFields = $request->validate([
            'photo' => 'required|file|mimes:png,jpg,jpeg|max:500'
        ]);

        try
        {
            $update = '';
            if ($request->hasFile('photo'))
            {
                $filename = auth()->user()->id;
                $avatar_file = $request->file('photo');
                $new_filename = $filename.'.'.$avatar_file->getClientOriginalExtension();
                
                $update = $avatar_file->storeAs('avatars', $new_filename);

                if ($update != '')
                {
                    $profile = Profile::where('user_id', auth()->user()->id)->first();
                    $profile->avatar = $update;
                    $profile->save();
                }

                
            }
        }
        catch(\Exception $e)
        {

        }
        
        return redirect()->back();
    }

    public function user_profile($fileno)
    {
        
        $userprofile = Staff::where('fileno', $fileno)->first();

        $organ = OrganClass::getOrganBySegment($userprofile);
        

        return view('staff.profile.user_profile', compact('userprofile', 'organ'));
    }

    public function change_password()
    {
        return view('staff.profile.change_password');
    }

    public function update_password(Request $request)
    {
        $formFields = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',            
        ]);

        $current_user = Auth::user();

        if (Hash::check($request->current_password, $current_user->password))
        {
            
            $current_user->password = Hash::make($request->input('new_password'));
            $updated = $current_user->save();
            if ($updated)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'Your Password has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating your password'
                ];

            }
        }
        else
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => 'Sorr, your current password is incorrect'
            ];
        }

        return redirect()->back()->with($data);


    }


    public function my_signature()
    {
        $signature = Signature::where('user_id', Auth::id())->first();
        
        return view('staff.profile.my_signature', compact('signature'));
    }

    public function upload_signature(Request $request)
    {
        $formFields = $request->validate([
            'signature' => 'required|file|mimes:png'
        ]);



        $formFields['user_id'] = Auth::user()->id;
        
        $filename = "";
        $new_filename = "";

        try
        {   

            if ($request->hasFile('signature'))
            {
                $filename = Auth::id().".";

                $signature = $request->file('signature');
                $new_filename = $filename.$signature->getClientOriginalExtension();

                $signature->storeAs('signatures', $new_filename);

            }

            $formFields['signature'] = 'signatures/'.$new_filename;

            $create = Signature::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'Your signature has been uploaded'
                ];
            }
            else
            {
                throw new \Exception("Upload error");
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


    public function update_signature(Request $request)
    {
        $formFields = $request->validate([
            'signature' => 'required|file|mimes:png'
        ]);

        $formFields['user_id'] = Auth::user()->id;
        
        $filename = "";
        $new_filename = "";

        try
        {   

            if ($request->hasFile('signature'))
            {
                $filename = Auth::id().".";

                $signature = $request->file('signature');
                $new_filename = $filename.$signature->getClientOriginalExtension();

                $signature->storeAs('signatures', $new_filename);

            }

            $formFields['signature'] = 'signatures/'.$new_filename;

            $my_signature = Signature::where('user_id', Auth::id())->first();


            $update = $my_signature->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'Your signature has been successfully updated'
                ];
            }
            else
            {
                throw new \Exception("Update error");
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


}
