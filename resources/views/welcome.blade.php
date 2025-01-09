<x-guest-layout>
<div class="flex flex-col w-full borders h-full">

    <div class="flex flex-col md:flex-row  ">
            <!-- left  panel //-->
            <div class="flex flex-col w-full  md:w-[70%] ">
                    <img src="{{ asset('images/votebook.jpg') }}" />
            </div>
            <!-- end of left panel //-->



            <!-- Right  panel //-->
            <div class="flex flex-col w-full  md:w-[30%] items-center justify-center py-8">

                <section class="flex flex-col w-full border border-0">
                    <div class="flex flex-col w-full border border-0" >
                    <form  action="{{ route('staff.auth.login') }}" method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center space-y-2">
                            @csrf

                            <div class="flex flex-col w-[80%] md:w-[80%] py-4 mt-4 font-serif" >
                                <h2 class="font-semibold text-xl py-1" >Sign In</h2>
                                Staff Members Only 
                                
                            </div>

                            <!-- username //-->
                            <div class="w-[80%]">

                                <input type="text" name="email" class="border border-1 border-gray-400 bg-gray-50
                                                                        w-full p-4 rounded-md 
                                                                        focus:outline-none
                                                                        focus:border-blue-500 
                                                                        focus:ring
                                                                        focus:ring-blue-100" placeholder="Username"
                                                                        
                                                                        value="{{ old('email') }}"
                                                                        
                                                                        style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                        required
                                                                        />  
                                                                                                                                            

                                                                        @error('email')
                                                                            <span class="text-red-700 text-sm">
                                                                                {{$message}}
                                                                            </span>
                                                                        @enderror
                                
                            </div><!-- end of username //-->

                            <!-- password //-->
                            <div class="w-[80%]">

                                <input type="password" name="password" class="border border-1 border-gray-400 bg-gray-50
                                    w-full p-4 rounded-md 
                                    focus:outline-none
                                    focus:border-blue-500 
                                    focus:ring
                                    focus:ring-blue-100" placeholder="Password"
                                    
                                    value="{{ old('password') }}"
                                    
                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                    required
                                    />  
                                                                                                        

                                    @error('password')
                                        <span class="text-red-700 text-sm">
                                            {{$message}}
                                        </span>
                                    @enderror

                            </div><!-- end of password //-->

                            <!-- submit //-->
                            <!-- submit button //-->
                            <div class="flex flex-col border-red-900 w-[80%] md:w-[80%] py-1 md:py-2">
                                <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                               hover:bg-gray-500
                                               rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Login</button>
                            </div>

                            <!-- end of submit //-->

                        </form>
                    </div>
                </section>
                    
            </div>
            <!-- end of right panel //-->
    </div>








    <!-- section //-->
    <section class="bg-green-100">

<div class=" flex flex-col items-start justify-center h-64  w-[95%] mx-auto">
    <div>
            <h1 class="text-4xl font-bold">Departmental Vote Expenditure Allocation Book (DVEAB)</h1>
            <h1 class="text-2xl py-1">Ogun Oshun River Basin Authority</h1>
    </div>

</div>
</section>
<!-- end of section //-->


<!-- section //-->
<section class="flex flex-col py-8 mx-auto w-full">
<div class="flex flex-col md:flex-row md:w-[80%] w-[90%] mx-auto border-0" >
    <div class="flex flex-row w-full space-x-4">
        <div class="flex  w-[50%] border justify-center items-center rounded-md border-green-600 border">
                <!--  tab 1 //-->
                <div class="flex py-16 px-8 font-bold text-xl justify-center 
                            items-center text-center ">
                            Expenditure Tracking
                </div>
                <!-- end of tab //-->
        </div>

        <div class="flex w-[50%] border justify-center items-center rounded-md border-green-600 border">
                 <!--  tab 2 //-->
                 <div class="flex flex py-16 px-8 font-bold text-xl justify-center 
                            items-center text-center">
                            Approvals and Permissions
                </div>
                <!-- end of tab 2//-->
        </div>
    </div>
</div>
</section>
<!-- end of section //-->


<!-- section //-->
<section class="flex flex-col py-4 mx-auto w-full">
<div class="flex flex-col md:flex-row md:w-[80%] w-[90%] mx-auto border-0" >
    <div class="flex flex-row w-full space-x-4">
        <div class="flex  w-[50%] border justify-center items-center rounded-md border-green-600 border">
                <!--  tab 1 //-->
                <div class="flex py-16 px-8 font-bold text-xl justify-center 
                            items-center text-center">
                            Reporting and Analytics
                </div>
                <!-- end of tab //-->
        </div>

        <div class="flex w-[50%] border justify-center items-center rounded-md border-green-600 border">
                 <!--  tab 2 //-->
                 <div class="flex py-16 px-8 font-bold text-xl justify-center 
                            items-center text-center">
                            Budget Reallocation
                </div>
                <!-- end of tab 2//-->
        </div>
    </div>
</div>
</section>
<!-- end of section //-->


<!-- section //-->
<section class="flex flex-col py-4 mx-auto w-full">
<div class="flex flex-col md:flex-row md:w-[80%] w-[90%] mx-auto border-0" >
    <div class="flex flex-row w-full space-x-4">
        <div class="flex  w-[50%] border justify-center items-center rounded-md border-green-600 border">
                <!--  tab 1 //-->
                <div class="flex py-16 px-8 font-bold text-xl justify-center 
                            items-center text-center">
                            Audit and History Tracking
                </div>
                <!-- end of tab //-->
        </div>

        <div class="flex w-[50%] border justify-center items-center rounded-md border-green-600 border">
                 <!--  tab 2 //-->
                 <div class="flex py-16 px-8 font-bold text-xl justify-center 
                            items-center text-center">
                            Notifications and Alerts
                </div>
                <!-- end of tab 2//-->
        </div>
    </div>
</div>
</section>
<!-- end of section //-->



</div>
</x-guest-layout>