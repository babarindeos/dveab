<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-1 mt-6 px-4 border-red-900 mx-auto">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div class="flex flex-1" >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Financial Years</h1>
                    </div>

                    <!-- create Financial Year  //-->
                    <div class="flex flex-1 justify-end border-0 space-x-4">
                        <a href="{{  route('admin.financial_years.index') }}" class="border boder px-8 py-2 text-sm border-green-500 rounded-md hover:text-white hover:bg-green-600">
                            Financial Years
                        </a>


                    </div>
                    <!-- end of financial Years //-->                    
                    
            </div>
        </section>
        <!-- end of page header //-->

        <!-- Financial Year //-->
        <!-- <section class="flex flex-col py-2 px-2 justify-end w-[95%] mx-auto md:px-1">
                <div class="flex justify-end border border-0">
                
                    <input type="text" name="search" class="w-4/5 md:w-2/5 border border-1 border-gray-400 bg-gray-50
                                p-2 rounded-md 
                                focus:outline-none
                                focus:border-blue-500 
                                focus:ring
                                focus:ring-blue-100" placeholder="Search"                
                            
                                style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                  
                    
                    />  
                </div>
                
         </section> -->

        
        <section class="py-8 mt-2">
            <div>
                <form  action="{{ route('admin.financial_years.update',['financial_year'=>$financial_year->id]) }} " method="POST" enctype="multipart/form-data" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                    @csrf

                    

                    <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                        <h2 class="font-semibold text-xl py-1" >Edit Financial Year</h2>
                        
                    </div>


                    @include('partials._session_response')
                    
                    

                    <!-- name //-->
                    <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                    
                        
                        <input type="text" name="name" class="border border-1 border-gray-400 bg-gray-50
                                                                w-full p-4 rounded-md 
                                                                focus:outline-none
                                                                focus:border-blue-500 
                                                                focus:ring
                                                                focus:ring-blue-100" placeholder="Name of Financial Year"
                                                                
                                                                value="{{ $financial_year->name }}"
                                                                
                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                required
                                                                />  
                                                                                                                                    

                                                                @error('name')
                                                                    <span class="text-red-700 text-sm">
                                                                        {{$message}}
                                                                    </span>
                                                                @enderror
                        
                    </div><!-- end of name of financial year  //-->


                    <!-- Dates //-->
                    <div class="flex flex-row border-red-900 w-[80%] md:w-[60%] py-3 space-x-4 ">

                                    <!-- Start Date //-->
                                    <div class='w-full'>
                                            <input type="date" name="start_date" class="border border-1 border-gray-400 bg-gray-50
                                                                            w-full p-4 rounded-md 
                                                                            focus:outline-none
                                                                            focus:border-blue-500 
                                                                            focus:ring
                                                                            focus:ring-blue-100" placeholder="Start Date"
                                                                            
                                                                            value="{{ $financial_year->start_date }}"
                                                                            
                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                            required
                                                                            />  
                                                                                                                                                

                                                                            @error('start_date')
                                                                                <span class="text-red-700 text-sm">
                                                                                    {{$message}}
                                                                                </span>
                                                                            @enderror

                                    </div>

                                    <!-- End Date //-->
                                    <div class='w-full'>
                                            <input type="date" name="end_date" class="border border-1 border-gray-400 bg-gray-50
                                                                            w-full p-4 rounded-md 
                                                                            focus:outline-none
                                                                            focus:border-blue-500 
                                                                            focus:ring
                                                                            focus:ring-blue-100" placeholder="End Date"
                                                                            
                                                                            value="{{ $financial_year->end_date }}"
                                                                            
                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                            required
                                                                            />  
                                                                                                                                                

                                                                            @error('end_date')
                                                                                <span class="text-red-700 text-sm">
                                                                                    {{$message}}
                                                                                </span>
                                                                            @enderror

                                    </div>
                        
                    </div><!-- end of Dates //-->

                    
                    <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                        <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                       hover:bg-gray-500
                                       rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Update Financial Year </button>
                    </div>
                    
                </form><!-- end of new college form //-->
            <div>

        </section>
       
           




       
    </div>



</x-admin-layout>