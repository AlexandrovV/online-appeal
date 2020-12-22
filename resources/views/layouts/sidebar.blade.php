<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
        <img src="{{asset('/img/iitu-logo.png')}}"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">IITU Appeal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('/img/avatardefault.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->email }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @role('student')
                <li class="nav-header">&nbsp;&nbsp;&nbsp;ЗАЯВКИ</li>

                <a href="{{ route('appeal-form') }}" class="nav-link">
                    <i class="far fa-edit nav-icon"></i>
                    <p>Создать заявку</p>
                </a>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>Мои заявки
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('student-status-appeals', ['status' => 'waiting']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>На рассмотрении</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('student-status-appeals', ['status' => 'accepted']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Подтверждены</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('student-status-appeals', ['status' => 'cancelled']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Отменены</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('student-appeals') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Все</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole

                @role('admin|manager|dept')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-stack-overflow"></i>
                        <p>Аппеляции
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            @role('admin|manager')
                            <a href="{{ route('manager-status-appeals', ['status' => 'waiting']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Готовы к рассмотрению</p>
                            </a>
                            @endrole
                            @role('dept')
                            <a href="{{ route('department-status-appeals', ['status' => 'waiting']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Готовы к рассмотрению</p>
                            </a>
                            @endrole
                        </li>
                        <li class="nav-item">
                            @role('admin|manager')
                            <a href="{{ route('manager-status-appeals', ['status' => 'accepted']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Подтверждены</p>
                            </a>
                            @endrole
                            @role('dept')
                            <a href="{{ route('department-status-appeals', ['status' => 'accepted']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Подтверждены</p>
                            </a>
                            @endrole
                        </li>
                        <li class="nav-item">
                            @role('admin|manager')
                                <a href="{{ route('manager-status-appeals', ['status' => 'cancelled']) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Отменены</p>
                                </a>
                            @endrole
                            @role('dept')
                                <a href="{{ route('department-status-appeals', ['status' => 'cancelled']) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Отменены</p>
                                </a>
                            @endrole
                        </li>
                        <li class="nav-item">
                            @role('admin|manager')
                                <a href="{{ route('manager-appeals') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Все</p>
                                </a>
                            @endrole
                            @role('dept')
                            <a href="{{ route('department-appeals') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Все</p>
                            </a>
                            @endrole
                        </li>
                    </ul>
                </li>
                @endrole

                @role('admin')
                <li class="nav-header">ПОЛЬЗОВАТЕЛИ</li>

                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-user-tag"></i>
                        <p>Изменить роль</p>
                    </a>
                </li>


                <li class="nav-header">ХРАНИЛИЩЕ</li>

                <li class="nav-item">
                    <a href="{{route('department-all')}}" class="nav-link">
                        <i class="nav-icon fas fa-university"></i>
                        <p>Департаменты</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('teacher-all')}}" class="nav-link">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>Учителя</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('subject-all') }}" class="nav-link">
                        <i class="nav-icon fas fa-atom"></i>
                        <p>Предметы</p>
                    </a>
                </li>
                @endrole

                @role('admin|manager|dept')
                <li class="nav-header">ЛОГИРОВАНИЕ</li>

                <li class="nav-item">
                    <a href="https://adminlte.io/docs/3.0" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Отправленные письма</p>
                    </a>
                </li>
                @endrole

                <li class="nav-header">СИСТЕМА</li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p class="text">Выйти из системы</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
