<x-staff-layout>

    <div class="flex flex-col container mx-4 md:mx-auto">
        <section class="border-b border-gray-200 py-2 mt-2">
                <div class="text-2xl font-semibold ">
                    My Signature              
                </div>                
        </section>

        <section class="flex flex-col md:flex-row rounded w-full mt-3 space-x-4">
            <div class="flex flex-col w-full  md:w-[30%] justify-center items-center 
                        border px-8 py-4 rounded-md">
                    <div class="">
                        @if (Auth::user()->profile->avatar != "" || Auth::user()->profile->avatar != null)
                            <img src="{{ asset('storage/'.Auth::user()->profile->avatar) }}" class="w-36 h-36 rounded-full" />
                        @else
                            <img src="{{ asset('images/avatar_150.jpg') }}" />
                        @endif
                    </div>
                    

            </div>
            <div class="flex flex-col justify-center md:border rounded-md md:w-[70%] py-2 px-4">
                    <div class="flex justify-end px-4 space-x-2">
                            <a href="{{ route('staff.profile.myprofile.edit') }}" class="border px-4 py-1 rounded-md ring-0 
                                 border-gray-500 bg-gray-100 hover:shadow-md text-xs md:text-sm hover:font-semibold">
                                Edit
                            </a>

                            <a href="{{ route('staff.profile.change_password') }}" class="border px-4 py-1 rounded-md ring-0 
                                 border-gray-500 bg-gray-100 hover:shadow-md text-xs md:text-sm hover:font-semibold">
                                Change Password
                            </a>

                            <a href="{{ route('staff.profile.my_signature') }}" class="border px-4 py-1 rounded-md ring-0 
                                 border-gray-500 bg-gray-100 hover:shadow-md text-xs md:text-sm hover:font-semibold">
                                My Signature
                            </a>
                    </div>
                    <div class="mb-4  mx-[10%] md:mx-0 ">
                            <div class="text-xl font-semibold">
                                    {{ Auth::user()->surname }} {{ Auth::user()->firstname }} {{ Auth::user()->middlename }}                                
                            </div>
                            <div class="text-sm">
                                    {{ Auth::user()->profile->designation}}, {{ Auth::user()->staff->fileno}}
                            </div>                            
                    </div>  


                    @include('partials._session_response')

                    @if ($signature == null)
                    
                            <!-- upload signature //-->
                            <div>
                                    <form action="{{ route('staff.profile.upload_signature') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <!-- signature file //-->
                                            <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                                
                                                
                                                <input type="file" name="signature" class="border border-1 border-gray-400 bg-gray-50
                                                                                        w-full p-4 rounded-md 
                                                                                        focus:outline-none
                                                                                        focus:border-blue-500 
                                                                                        focus:ring
                                                                                        focus:ring-blue-100" 
                                                
                                                style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                accept=".png"
                                                />
                                                <div class="flex justify-between">
                                                    <div>
                                                            @error('signature')
                                                                <span class="text-red-700 text-sm">
                                                                    {{$message}}
                                                                </span>
                                                            @enderror
                                                    </div>
                                                    <div>
                                                            <small>
                                                                    only .png image format allowed
                                                            </small>
                                                    </div>
                                                </div>
                                                    
                        
                                            
                                                
                                            </div>
                                            <!-- end of signature file //-->

                                            
                                            <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mb-8">
                                                <button type="submit" class="border border-1 bg-gray-400 py-2 text-white 
                                                            hover:bg-gray-500
                                                            rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Upload Signature</button>
                                            </div>
                                    </form>

                            </div>
                            <!-- end of upload signature //-->
                    
                    @else


                            <div class="py-2">
                                    <a target="_blank" class="underline" href="{{ asset('storage/'.$signature->signature) }}">My signature</a>

                            </div>

                             <!-- update signature //-->
                            <div>
                                    <form action="{{ route('staff.profile.update_signature') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <!-- signature file //-->
                                            <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                                
                                                
                                                <input type="file" name="signature" class="border border-1 border-gray-400 bg-gray-50
                                                                                        w-full p-4 rounded-md 
                                                                                        focus:outline-none
                                                                                        focus:border-blue-500 
                                                                                        focus:ring
                                                                                        focus:ring-blue-100" 
                                                
                                                style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                accept=".png"
                                                />
                                                <div class="flex justify-between">
                                                    <div>
                                                            @error('signature')
                                                                <span class="text-red-700 text-sm">
                                                                    {{$message}}
                                                                </span>
                                                            @enderror
                                                    </div>
                                                    <div>
                                                            <small>
                                                                    only .png image format allowed
                                                            </small>
                                                    </div>
                                                </div>
                                                    
                        
                                            
                                                
                                            </div>
                                            <!-- end of signature file //-->

                                            
                                            <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mb-8">
                                                <button type="submit" class="border border-1 bg-gray-400 py-2 text-white 
                                                            hover:bg-gray-500
                                                            rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Update Signature</button>
                                            </div>
                                    </form>

                            </div>
                            <!-- end of update signature //-->   






                    @endif




            </div>
           




        </section>
    


    </div>


</x-staff-layout>