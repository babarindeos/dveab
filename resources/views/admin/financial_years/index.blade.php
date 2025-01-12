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
                        <a href="{{  route('admin.financial_years.create') }}" class="border boder px-8 py-2 text-sm border-green-500 rounded-md hover:text-white hover:bg-green-600">
                            Create Financial Year
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

        <section class="flex flex-col w-[95%] md:w-[93%] mx-auto px-4 md:px-1">
                <table class="table-auto border-collapse border border-1 border-gray-200" 
                            >
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="text-center font-semibold py-4" width='10%'>SN</th>
                            <th class="font-semibold py-2 text-left" width='30%'>Name</th>
                            <th class="font-semibold py-2 text-left" width='20%'>Start Date</th>
                            <th class="font-semibold py-2 text-left" width='20%'>End Date</th>
                            <th class="font-semibold py-2 text-center">Action</th>
                        </tr>
                    </head>
                    <tbody>
                        @php    
                            $counter = 0;
                        @endphp
                        @foreach($financial_years as $fyear)
                            <tr>
                                <td class='text-center py-4 '>{{ ++$counter }}.</td>
                                <td>
                                    <a class="hover:underline" href="{{ route('admin.financial_years.show',['financial_year'=>$fyear->id]) }}">
                                        {{ $fyear->name }}
                                    </a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($fyear->start_date)->format('jS F, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($fyear->end_date)->format('jS F, Y') }}</td>
                                <td class='text-center'>
                                    <a href="{{ route('admin.financial_years.edit',['financial_year'=>$fyear->id]) }}" class='border border-green-700 px-5 py-1 text-sm rounded-full hover:bg-green-500 hover:text-white hover:border-green-500'>Edit</a>
                                    <a href="{{ route('admin.financial_years.confirm_delete',['financial_year'=>$fyear->id]) }}" class='border border-green-700 px-5 py-1 text-sm rounded-full border-red-400 hover:bg-red-400 hover:text-white'>Delete</a>
                                </td>


                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </table>
        </section>
           




       
    </div>



</x-admin-layout>