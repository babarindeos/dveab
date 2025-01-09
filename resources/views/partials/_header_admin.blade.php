<header class="flex flex-col shadow-md bg-gradient-to-b from-green-700 to-green-500">

    
    
    <nav class="py-3 border-0">
        <div class="max-w-8xl mx-auto px-2 sm:px-8 lg:px-4">
            <div class="flex items-center justify-between h-16">

                <!-- Logo -->
                <div class="flex flex-shrink-0">
                    <!-- logo //-->
                    <div class="flex flex-row px-2 md:px-4 py-2">
                        <img src="{{ asset('images/logo.png')}}" />
                    </div>
                    <!-- end of logo //-->
                    <!-- Name //-->
                    <div class="flex flex-col item-center justify-center">
                            <div class="text-white font-bold text-2xl font-serif">DVEAB</div>
                            <div class="text-white font-semibold font-serif text-xs opacity-70">O-ORBDA</div>
                                
                    </div>
                    <!-- end of name //-->
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden px-4">
                    <button class="text-white focus:outline-none" id="mobile-menu-button">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <!-- Main Menu -->
                <div class="hidden lg:flex space-x-4">
                    @auth
                        @if (Auth::user()->role==='admin')

                            <a href='{{ route("admin.dashboard.index") }}' class="flex font-semibold items-center text-white hover:border-b-yellow-100 hover:border-b-4 mx-2 ">Dashboard</a>

                            <a  href='{{ route("admin.tracker.index") }}' class="flex font-semibold items-center text-white hover:border-b-yellow-100 hover:border-b-4 mx-3 ">VoteBook</a>

                            <div class="relative group">
                                <button class="text-white px-1 py-2 rounded-md font-semibold">
                                    Financial Year
                                </button>
                                <!-- Sub-menu -->
                                <div class="absolute hidden group-hover:block bg-white text-gray-800 mt-0 py-2 shadow-lg w-[200%]">
                                    <a href="{{ route('admin.financial_years.index')}}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Manage Financial Year</a>
                                    <a href="{{ route('admin.financial_years.create')}} " class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-">Create Financial Year</a>

                                </div>
                            </div>

                            <div class="relative group">
                                <button class="text-white px-1 py-2 rounded-md font-semibold">
                                    Organs
                                </button>
                                <!-- Sub-menu -->
                                <div class="absolute hidden group-hover:block bg-white text-gray-800 mt-0 py-2 shadow-lg w-[350%]">
                                    <a href="{{ route('admin.directorates.index')}}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Directorates</a>
                                    <a href="{{ route('admin.departments.index')}} " class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-">Departments</a>
                                    <a href="{{ route('admin.divisions.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Divisions</a>
                                    <a href="{{ route('admin.branches.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Branches</a>
                                    <a href="{{ route('admin.sections.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Sections</a>
                                    <a href="{{ route('admin.units.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Units</a>
                                </div>
                            </div>
                            <a  href='{{ route('admin.staff.index') }}' class="flex font-semibold items-center text-white hover:border-b-yellow-100 hover:border-b-4 mx-3 ">Users</a>
                            
                            
                           
                            
                            <form action="{{ route('admin.auth.logout') }}" method="POST" class="flex items-center justify-center border-0">
                                @csrf
                                
                                <button type="submit" class="flex font-semibold items-center hover:border-b-yellow-100 text-white hover:border-b-4 mx-3 ">Sign Out</button>
                            </form>  
                        @endif
                    @endauth     
                </div>
                
            </div>
            
            <!-- Mobile Menu -->
            <div class="lg:hidden hidden" id="mobile-menu">
                <a href="#" class="block text-white px-4 py-2 hover:bg-gray-700 rounded-md">Dashboard</a>
                <div class="relative">
                    <button class="block w-full text-left text-white px-4 py-2 hover:bg-gray-700 rounded-md focus:outline-none" id="services-mobile">
                        Organs
                    </button>
                    <!-- Sub-menu for Mobile -->
                    <div class="hidden bg-slate-50 rounded-md" id="services-sub-menu-mobile">
                        <a href="{{ route('admin.directorates.index') }}" class="block px-4 py-2 hover:bg-gray-200">Directorates</a>
                        <a href="{{ route('admin.departments.index') }}" class="block px-4 py-2 hover:bg-gray-200">Departments</a>
                        <a href="{{ route('admin.divisions.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200">Divisions</a>
                        <a href="{{ route('admin.branches.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200">Branches</a>
                        <a href="{{ route('admin.sections.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200">Sections</a>
                        <a href="{{ route('admin.units.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200">Units</a>
                    </div>
                </div>
                <a href="#" class="block text-white px-4 py-2 hover:bg-gray-700 rounded-md">Users</a>
                <a href="#" class="block text-white px-4 py-2 hover:bg-gray-700 rounded-md">Documents</a>
                <a href="#" class="block text-white px-4 py-2 hover:bg-gray-700 rounded-md">Tracker</a>
                <a href="#" class="block text-white px-4 py-2 hover:bg-gray-700 rounded-md">Analytics</a>
                <form action="{{ route('admin.auth.logout') }}" method="POST" class="block w-full">
                    @csrf
                    
                    <button type="submit" class="block w-full text-white px-4 py-2 hover:bg-gray-700 rounded-md">Sign Out</button>
                </form> 
            </div>
        </div>
    </nav>
    
    <script>
        // Toggle Mobile Menu
        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    
        // Toggle Mobile Sub-menu
        document.getElementById('services-mobile').addEventListener('click', function () {
            document.getElementById('services-sub-menu-mobile').classList.toggle('hidden');
        });
    </script>

    
</header>
