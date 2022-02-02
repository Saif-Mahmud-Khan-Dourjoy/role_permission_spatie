<div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.html"><img src="{{asset('backend/assets/images/icon/logo.png')}}" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li class="active">
                                <a href="{{route('admin.dashboard')}}" {{Route::is('admin.dashboard')?'active':''}} ><i class="ti-dashboard"></i><span>dashboard</span></a>
                             </li> 
                             <li> 
                                 <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Roles & Permission</span></a>
                                <ul class="collapse">
                                    <li><a href="{{route('roles.index')}}">All Roles</a></li>
                                    <li><a href="{{route('roles.create')}}">Create Role</a></li>
                                </ul>
                            </li>

                            <li> 
                                 <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Users</span></a>
                                <ul class="collapse">
                                    <li><a href="{{route('users.index')}}">All User</a></li>
                                    <li><a href="{{route('users.create')}}">Create User</a></li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>