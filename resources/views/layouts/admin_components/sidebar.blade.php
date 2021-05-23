<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('bower_components/admin-lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME' , 'APK_ZOM') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('bower_components/admin-lte/dist/img/user2-160x160.jpg') }}"
                     class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name  }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" @if($direction == "rtl")  style="padding: 0px !important;"
                @endif data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item  menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('common.settings') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(auth()->user()->hasRole('super_admin'))
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}"
                                   class="nav-link @if(request()->is('admin/users/*')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('common.users') }}</p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}"
                               class="nav-link @if(request()->is('admin/categories/*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('common.categories') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tags.index') }}"
                               class="nav-link @if(request()->is('admin/tags/*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('common.tags') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('os-types.index') }}"
                               class="nav-link @if(request()->is('admin/os-types/*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('common.os_types') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('versions.index') }}"
                               class="nav-link @if(request()->is('admin/versions/*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('common.os_versions') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('vendors.index') }}"
                               class="nav-link @if(request()->is('admin/vendors/*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('common.vendor') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sliders.index') }}"
                               class="nav-link @if(request()->is('admin/sliders/*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('common.sliders') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sections.index') }}"
                               class="nav-link @if(request()->is('admin/sections/*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('common.sections') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('footers.index') }}"
                               class="nav-link @if(request()->is('admin/footers/*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('common.footer_management') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('settings.edit') }}"
                               class="nav-link @if(request()->is('admin/footers/*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('common.general_settings') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  @if(request()->is('admin/apps/*') || request()->is('admin/apps') ) menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="fab fa-app-store"></i>
                        {{ __('common.apps') }}
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('apps.index') }}"
                               class="nav-link @if(request()->is('admin/apps/*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('common.apps') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('apps.create') }}"
                               class="nav-link @if(request()->is('admin/apps/*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('common.add_new') . ' ' . __('common.app') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('languages.index') }}"
                       class="nav-link @if(request()->is('languages/*') || request()->is('languages') ) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('common.languages') }}</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
