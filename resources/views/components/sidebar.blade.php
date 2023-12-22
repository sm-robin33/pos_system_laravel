<style>
.center{
    display: block;
    margin-left: auto;
    margin-right: auto;
}
</style>
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div class="center">
                <img src="{{asset('assets/img/admin-avatar.png')}}" width="45px" />
            </div>
                {{-- <div class="admin-info"> --}}
                {{-- <div class="font-strong">{{$user['user']['name']}}</div><small class="text-capitalize">{{$user['user']['role']}}</small></div> --}}
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="{{url()->current() == route('admin.dashboard') ? 'active' : ''}}" href="{{route('admin.dashboard')}}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">FEATURES</li>
            {{-- @canany(['create category', 'read category'])
                <li class="{{$activeNav == 'categories' ? 'active' : ''}}">
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-tags"></i>
                        <span class="nav-label">Categories</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        @can('create category')
                            <li>
                                <a class="{{url()->current() == route('categories.create') ? 'active' : ''}}" href="{{route('categories.create')}}">Create New</a>
                            </li>
                        @endcan
                        @can('read category')
                            <li>
                                <a class="{{url()->current() == route('categories.index') ? 'active' : ''}}" href="{{route('categories.index')}}">Manage Categories</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany --}}
            @if(\App\Helper\CustomHelper::canView('Create User|Manage User|Delete User|View User|List Of User', 'Super Admin'))
            <li class="has_sub">
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-users"></i>
                    <span class="nav-label">Users</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                @if(\App\Helper\CustomHelper::canView('Create User', 'Super Admin'))
                  <li><a href="{{ route('admin.user.create') }}">Create new</a></li>
                @endif
                @if(\App\Helper\CustomHelper::canView('Manage User|Delete User|View User|List Of User', 'Super Admin'))
                  <li><a href="{{ route('admin.user.list') }}">List of Users</a></li>
                @endif
              </ul>
            </li>
          @endif

          @if(\App\Helper\CustomHelper::canView('Create Role|Manage Role|Delete Role|View Role|List Of Role', 'Super Admin'))
          <li class="has_sub">
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-cubes"></i>
                        <span class="nav-label">Roles</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        @if(\App\Helper\CustomHelper::canView('Create Role', 'Super Admin'))
                       <li><a href="{{ route('admin.role.create') }}"> Create new</a></li>
                      @endif
                     @if(\App\Helper\CustomHelper::canView('Manage Role|Delete Role|View Role|List Of Role', 'Super Admin'))
                     <li><a href="{{ route('admin.role.list') }}">List of roles</a></li>
                      @endif
                    </ul>
                </li>
            @endif
            <li class="has_sub">
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-cubes"></i>
                    <span class="nav-label">Product</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">   
                   <li><a href="{{ route('admin.product.create') }}"> Create Product</a></li>     
                   <li><a href="{{ route('admin.product.list') }}">List of Products</a></li>
                </ul>
            </li>

            <li class="has_sub">
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-cubes"></i>
                    <span class="nav-label">Brands</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">   
                   <li><a href="{{ route('admin.brand.create') }}"> Create Brand</a></li>     
                   <li><a href="{{ route('admin.brand.list') }}">List of Brands</a></li>
                </ul>
            </li>

            <li class="has_sub">
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-cubes"></i>
                    <span class="nav-label">Category</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">   
                   <li><a href="{{ route('admin.categories.create') }}"> Create Category</a></li>     
                   <li><a href="{{ route('admin.categories.list') }}">List of Category</a></li>
                </ul>
            </li>
            <li class="has_sub">
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-cubes"></i>
                    <span class="nav-label">Sub Category</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">   
                   <li><a href="{{ route('admin.sub-categories.create') }}"> Create Sub-Category</a></li>     
                   <li><a href="{{ route('admin.sub-categories.list') }}">List of Sub-Category</a></li>
                </ul>
            </li>
            <li class="has_sub">
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-cubes"></i>
                    <span class="nav-label">Discount Policy</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">   
                   <li><a href="{{ route('admin.discount.create') }}"> Add Discount Policy</a></li>     
                   <li><a href="{{ route('admin.discount.list') }}">List of Discount Policy</a></li>
                </ul>
            </li>
            <li class="has_sub">
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-cubes"></i>
                    <span class="nav-label">Inventory</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">   
                   <li><a href="{{ route('admin.inventory.create') }}"> Add Inventory</a></li>     
                   <li><a href="{{ route('admin.inventory.list') }}">List of Inventory</a></li>
                </ul>
            </li>


            @if(\App\Helper\CustomHelper::canView('Create Customer|Manage Customer|Delete Customer|List Of Customer', 'Super Admin|Cashier'))
            <li class="has_sub">
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-users"></i>
                    <span class="nav-label">Customers</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                @if(\App\Helper\CustomHelper::canView('Create Customer', 'Super Admin|Cashier'))
                  <li><a href="{{ route('admin.customer.create') }}">Create new</a></li>
                @endif
                @if(\App\Helper\CustomHelper::canView('Manage Customer|Delete Customer|List Of Customer', 'Super Admin|Cashier'))
                  <li><a href="{{ route('admin.customer.list') }}">List of Customers</a></li>
                @endif
              </ul>
            </li>
          @endif

          <li class="has_sub">
            <a href="javascript:;"><i class="sidebar-item-icon fa fa-users"></i>
                <span class="nav-label">Supplier</span><i class="fa fa-angle-left arrow"></i></a>
            <ul class="nav-2-level collapse">   
               <li><a href="{{ route('admin.supplier.create') }}"> Create Supplier</a></li>     
               <li><a href="{{ route('admin.supplier.list') }}">List of Supplier</a></li>
            </ul>
        </li>

        <li class="has_sub">
            <a href="javascript:;"><i class="sidebar-item-icon fa fa-cubes"></i>
                <span class="nav-label">Store</span><i class="fa fa-angle-left arrow"></i></a>
            <ul class="nav-2-level collapse">   
               <li><a href="{{ route('admin.store.create') }}"> Create Store</a></li>     
               <li><a href="{{ route('admin.store.list') }}">List of Store</a></li>
            </ul>
        </li>

          @if(\App\Helper\CustomHelper::canView('Create Measurement|Manage Measurement|Delete Measurement|List Of Measurement', 'Super Admin|Cashier'))
            <li class="has_sub">
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-cubes"></i>
                    <span class="nav-label">Measurements</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                @if(\App\Helper\CustomHelper::canView('Create Measurement', 'Super Admin|Cashier'))
                  <li><a href="{{ route('admin.measurement.create') }}">Create new</a></li>
                @endif
                @if(\App\Helper\CustomHelper::canView('Manage Measurement|Delete Measurement|List Of Measurement', 'Super Admin|Cashier'))
                  <li><a href="{{ route('admin.measurement.list') }}">List of Measurements</a></li>
                @endif
              </ul>
            </li>
          @endif

            @if(\App\Helper\CustomHelper::canView('Manage Permission', 'Super Admin'))
          <li class="has_sub">
                    <a href="{{ route('admin.permission.manage') }}"><i class="sidebar-item-icon fa fa-tags"></i>
                        <span class="nav-label">Permissions</span></i></a>
                    
                </li>
            @endif

            
            {{-- <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-users"></i>
                    <span class="nav-label">Users</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="#">Add User</a>
                    </li>
                    <li>
                        <a href="#">Manage Users</a>
                    </li>
                    <li>
                        <a href="#">Manage Roles</a>
                    </li>
                    <li>
                        <a href="#">Manage Permissions</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-truck"></i>
                    <span class="nav-label">Suppliers</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="#">Add Supplier</a>
                    </li>
                    <li>
                        <a href="#">Manage Suppliers</a>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </div>
</nav>