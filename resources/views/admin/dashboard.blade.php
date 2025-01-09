<x-admin-layout>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div class="x flex-col container mx-4 mb-8 border border-0 md:mx-auto">

        <!-- Page Header //-->
        <section class="border-b border-gray-200 py-2 mt-2">
            <div class="text-2xl font-semibold ">
                Dashboard         
            </div>            
        </section>
        <!-- end of Page Header //-->


        <!-- board //-->
        <section class="flex flex-row border border-0 py-1 mt-3">
                <div class="flex flex-col md:flex-row mx-auto md:space-x-2 w-4/5 justify-center items-center">
                    
                    <!-- Document //-->
                    <div class="flex flex-col border border-1 border-yellow-500 
                                w-full md:w-[20%] px-4 py-4 mt-1 rounded-md bg-yellow-500">
                                
                            <div class="flex flex-row">
                                    <div class="flex flex-col flex-1 w-3/4">
                                        <div class="text-white text-3xl">
                                            {{ number_format($documents_count)}}
                                        </div>                            
                                    
                                        <div class="text-sm text-white font-normal">
                                            Documents
                                        </div>
                                    </div>
                                    <div class="w-1/4 flex justify-center items-center border-0">
                                        <i class="fa-regular fa-file text-4xl text-white opacity-50 "></i>
                                    </div>

                            </div>
                    </div>
                    <!-- end of Document //-->


                    <!-- Workflow //-->
                    <div class="flex flex-col border border-1 border-pink-500 
                                w-full md:w-[20%] px-4 py-4 mt-1 rounded-md bg-pink-500">
                                
                            <div class="flex flex-row">
                                    <div class="flex flex-col flex-1 w-3/4">
                                        <div class="text-white text-3xl">
                                            {{ number_format($workflows_count)}}
                                        </div>                            
                                    
                                        <div class="text-sm text-white font-normal">
                                            Workflows
                                        </div>
                                    </div>
                                    <div class="w-1/4 flex justify-center items-center border-0">
                                        
                                        <i class="fa-solid fa-person-digging text-4xl text-white opacity-50 "></i>
                                    </div>

                            </div>
                    </div>
                    <!-- end of Workflow //-->



                    <!-- Staff //-->
                    <div class="flex flex-col border border-1 border-blue-500 
                                        w-full md:w-[20%] px-4 py-4 mt-1 rounded-md bg-blue-500">
                                        
                            <div class="flex flex-row">
                                    <div class="flex flex-col flex-1 w-3/4">
                                        <div class="text-white text-3xl">
                                            {{ number_format($staff_count)}}
                                        </div>                            
                                    
                                        <div class="text-sm text-white font-normal">
                                            Staff
                                        </div>
                                    </div>
                                    <div class="w-1/4 flex justify-center items-center border-0">
                                        
                                        <i class="fa-solid fa-users text-4xl text-white opacity-50 "></i>
                                    </div>

                            </div>
                    </div>
                    <!-- end of Staff //-->


                    <!-- Department //-->
                    <div class="flex flex-col border border-1 border-purple-500 
                                        w-full md:w-[20%] px-4 py-4 mt-1 rounded-md bg-purple-500">
                                        
                            <div class="flex flex-row">
                                    <div class="flex flex-col flex-1 w-3/4">
                                        <div class="text-white text-3xl">
                                            {{ number_format($departments_count)}}
                                        </div>                            
                                    
                                        <div class="text-sm text-white font-normal">
                                            Departments
                                        </div>
                                    </div>
                                    <div class="w-1/4 flex justify-center items-center border-0">
                                        
                                        <i class="fa-regular fa-building text-4xl text-white opacity-50 "></i>
                                    </div>

                            </div>
                    </div>
                    <!-- end of Departments //-->
                    


                    

                    

                    
                </div>
        </section>
        <!-- end of board //-->


        <!-- Document Charts //-->
        <section class="flex flex-col w-full md:flex-row border-0 py-4">
                <!-- Documents by Organs //-->
                <div class="flex-1 border-0">
                        <div class="hidden">
                            Documents By Organs
                        </div>
                        <div>
                            <div id="organ_document_piechart_3d" style="width: 650px; height: 400px;"></div>
                        </div>
                </div>
                <!-- end of Documents by Organs //-->

                <!-- Staff by Organs //-->
                <div class="flex-1">
                        <div class="hidden">
                            Staff by Organs
                        </div>
                        <div>
                            <div id="organ_staff_piechart_3d" style="width:650px; height:400px"></div>
                        </div>
                </div>
                <!-- end of Staff by Organs //-->
        </section>
        <!-- end of Document Charts //-->
        
        
        




            
    </div>
</x-admin-layout>



<script type="text/javascript">
    
    // Convert PHP array to a JSON object for JavaScript
    var segmentDocumentsChartData = {!! json_encode($segment_documents_chart_data) !!};
    var segmentStaffChartData = {!! json_encode($segment_staff_chart_data) !!}

 
    // Output the array in the console
    console.log(segmentDocumentsChartData);
    console.log(segmentStaffChartData);

</script> 
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        
        
        /*
        var dataArray = [];
        Object.entries(ministriesDocumentsChartData).forEach(([ministry, count]) =>{
            dataArray.push([ministry, count]);
        });
        console.log(dataArray);
        */

        //--------   Segment Documents Chart  //-----------------
        var segment_documents_data = google.visualization.arrayToDataTable(segmentDocumentsChartData);

        var optionsOrganDocument = {
          title: 'Documents by Organs',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('organ_document_piechart_3d'));
        chart.draw(segment_documents_data, optionsOrganDocument);


        //------------ Segment Staff Chart -------------------
        var segment_staff_data = google.visualization.arrayToDataTable(segmentStaffChartData);

        var optionsSegmentStaff = {
            title: 'Staff by Organs',
            is3D: true,
        }

        var chart = new google.visualization.PieChart(document.getElementById('organ_staff_piechart_3d'));
        chart.draw(segment_staff_data, optionsSegmentStaff);


        
        

      }
</script> 