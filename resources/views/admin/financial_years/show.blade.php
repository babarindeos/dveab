<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-1 mt-6 px-4 border-red-900 mx-auto">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div class="flex flex-1" >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Financial Year</h1>
                    </div>

                    <!-- create Financial Year  //-->
                    <div class="flex flex-1 justify-end border-0 space-x-4">
                        <a href="{{  route('admin.financial_years.vaults.create',['financial_year'=>$financial_year->id]) }}" class="border boder px-8 py-2 text-sm border-green-500 rounded-md hover:text-white hover:bg-green-600">
                            Create Vault
                        </a>


                    </div>
                    <!-- end of financial Years //-->                    
                    
            </div>
        </section>
        <!-- end of page header //-->

        <!-- financial year information //-->
         <section class="flex flex-col border-0<div>Vault</div> w-[95%] mx-auto px-4">
                <div class="border-0 text-xl font-semibold mt-1">
                        {{ $financial_year->name }}
                </div>
                <div>
                        {{ \Carbon\Carbon::parse($financial_year->start_date)->format('l jS, F, Y') }} -
                        {{ \Carbon\Carbon::parse($financial_year->end_date)->format('l jS, F, Y') }}
                </div>

        </section>
        <!-- end of financial year information //-->



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

        <section class="flex flex-col w-[95%] md:w-[93%] mx-auto px-4 md:px-1 mt-8">
                <div class='text-xl'>Vaults</div>
        </section>
           




       
    </div>



</x-admin-layout>