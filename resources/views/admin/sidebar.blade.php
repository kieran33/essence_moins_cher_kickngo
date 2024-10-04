 <!-- Sidebar -->
            <nav id="sidebar">
                <!-- Sidebar Scroll Container -->
                <div id="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <!-- Adding .sidebar-mini-hide to an element will hide it when the sidebar is in mini mode -->
                    <div class="sidebar-content">
                        <!-- Side Header -->
                        <div class="side-header side-content bg-white-op">
                            <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                            <button class="btn btn-link text-gray pull-right hidden-md hidden-lg" style="padding: 5px;" type="button" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times"></i>
                            </button>
                            
                            <a class="h5 text-white" href="{{ URL::to('admin/dashboard') }}">
                                <span class="h4 font-w600 sidebar-mini-hide">{{getcong('site_name')}}</span>
                            </a>
                        </div>
                        <!-- END Side Header -->

                        <!-- Side Content -->
                        <div class="side-content">
                            <ul class="nav-main">
                                <li><a class="{{classActivePath('dashboard')}}" href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i><span class="sidebar-mini-hide">{{trans('words.dashboard')}}</span></a></li>
                                <li><a class="{{classActivePath('ville')}}" href="{{ URL::to('admin/ville') }}"><i class="fa fa-bars"></i>{{trans('words.categories')}}</a></li>
                                <li><a class="{{classActivePath('categories')}}" href="{{ URL::to('admin/categories') }}"><i class="fa fa-list-ul"></i>{{trans('words.sub_categories')}}</a></li>
                                <li><a class="{{classActivePath('locations')}}" href="{{ URL::to('admin/locations') }}"><i class="fa fa-location-arrow"></i>{{trans('words.locations')}}</a></li>
                                <li><a class="{{classActivePath('entreprise')}}" href="{{ URL::to('admin/entreprise') }}"><i class="fa fa-map-marker"></i>{{trans('words.listings')}}</a></li>
                                <li><a class="{{classActivePath('plan')}}" href="{{ URL::to('admin/plan') }}"><i class="fa fa-money"></i>{{trans('words.plan')}}</a></li>
                                <li><a class="{{classActivePath('payment_gateway')}}" href="{{ URL::to('admin/payment_gateway') }}"><i class="fa fa-credit-card"></i>{{trans('words.payment_gateway')}}</a></li>
                                <li><a class="{{classActivePath('transaction')}}" href="{{ URL::to('admin/transaction') }}"><i class="fa fa-list"></i>{{trans('words.transactions')}}</a></li>                                
                                <li><a class="{{classActivePath('users')}}" href="{{ URL::to('admin/users') }}"><i class="fa fa-users"></i>{{trans('words.users')}}</a></li>
                                <li><a class="{{classActivePath('settings')}}" href="{{ URL::to('admin/settings') }}"><i class="fa fa-cog"></i>{{trans('words.settings')}}</a></li> 
                            </ul>
                        </div>
                        <!-- END Side Content -->
                    </div>
                    <!-- Sidebar Content -->
                </div>
                <!-- END Sidebar Scroll Container -->
            </nav>
            <!-- END Sidebar -->