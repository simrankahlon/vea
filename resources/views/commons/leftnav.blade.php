<div class="sidebar">

        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/home') }}"><i class="icon-grid"></i> Dashboard <!--<span class="tag tag-info">NEW</span>--></a>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-call-in"></i>Enquiry</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/enquiry/create') }}"><i class="icon-arrow-right"></i> Add</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/enquiry') }}"><i class="icon-arrow-right"></i> List</a>
                        </li>
                     </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-compass"></i>Orientation</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/orientation/list') }}"><i class="icon-arrow-right"></i>List</a>
                        </li>
                     </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-calendar"></i>Waiting List</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/waiting_list/list') }}"><i class="icon-arrow-right"></i>List</a>
                        </li>
                     </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-home"></i>Admission</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/admission/create') }}"><i class="icon-arrow-right"></i> Add</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/admission') }}"><i class="icon-arrow-right"></i> List</a>
                        </li>
                     </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-layers"></i>Batch</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/batch/create') }}"><i class="icon-arrow-right"></i> Add</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/batch') }}"><i class="icon-arrow-right"></i> List</a>
                        </li>
                     </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="{{ url('/remedial/create') }}"><i class="icon-bulb"></i>Remedial Att.</a>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-layers"></i>Remedial Batch</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/remedialbatch/create') }}"><i class="icon-arrow-right"></i> Add</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/remedialbatch') }}"><i class="icon-arrow-right"></i> List</a>
                        </li>
                     </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-credit-card"></i>Fees</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/fee/create') }}"><i class="icon-arrow-right"></i> Add</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/fee') }}"><i class="icon-arrow-right"></i> List</a>
                        </li>
                     </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-note"></i>Test Schedule</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/testscheduler/create') }}"><i class="icon-arrow-right"></i> Add</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/testscheduler') }}"><i class="icon-arrow-right"></i> List</a>
                        </li>
                     </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="{{ url('/marks/create') }}"><i class="icon-hourglass"></i>Marks</a>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="{{ url('/schoolmarks/create') }}"><i class="icon-globe"></i>School Marks</a>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="{{ url('/attendance/create') }}"><i class="icon-target"></i>Attendance</a>
                </li>
                
                <li class="divider"></li>
                
                <li class="nav-title">
                    Admin
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Users</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/users/create') }}" target="_top"><i class="icon-arrow-right"></i> Create</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/users') }}" target="_top"><i class="icon-arrow-right"></i> List</a>
                        </li>
                        
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-list"></i>To-Do List</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/todolist/create') }}"><i class="icon-arrow-right"></i> Add</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/todolist') }}"><i class="icon-arrow-right"></i> List</a>
                        </li>
                     </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-user-follow"></i>Parent Meet Details</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/parentsmeet/create') }}"><i class="icon-arrow-right"></i> Add</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/parentsmeet') }}"><i class="icon-arrow-right"></i> List</a>
                        </li>
                     </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-envelope-letter"></i> Excel Sheet</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/export/create') }}" target="_top"><i class="icon-arrow-right"></i> Export</a>
                        </li>
                        
                    </ul>
                </li>
            </ul>
        </nav>
    </div>