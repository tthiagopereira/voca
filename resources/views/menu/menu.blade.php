<div class="sidebar">
    <nav class="sidebar-nav ps ps--active-y">

        <ul class="nav">

            {{--home--}}
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-home">

                    </i>
                    Home
                </a>
            </li>


            @can('Acesso a administração do sistema')
                {{--administração do sistema--}}
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle">
                        <i class="fas fa-cogs nav-icon">

                        </i>
                        {{ trans('global.system_management') }}
                    </a>
                    <ul class="nav-dropdown-items">

                        {{--Permissões--}}
                        @can('Pode acessar permissões')
                            <li class="nav-item">
                                <a href="{{ route("admin.permissions.index") }}"
                                   class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="fas fa-unlock-alt nav-icon">

                                    </i>
                                    {{ trans('global.permission.title') }}
                                </a>
                            </li>
                        @endcan

                        {{--tipos de usuários (funções)--}}
                        @can('Pode acessar funções')
                            <li class="nav-item">
                                <a href="{{ route("admin.roles.index") }}"
                                   class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="fas fa-briefcase nav-icon">

                                    </i>
                                    {{ trans('global.role.title') }}
                                </a>
                            </li>
                        @endcan

                        {{--administração de usuários--}}
                        @can('Pode acessar usuários')
                            <li class="nav-item">
                                <a href="{{ route("admin.users.index") }}"
                                   class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                    <i class="fas fa-users nav-icon">

                                    </i>
                                    {{ trans('global.user.title') }}
                                </a>
                            </li>
                        @endcan

                        {{--Gerenciamento de Guichês--}}
                        @can('Pode acessar Administração de guichês')
                            <li class="nav-item">
                                <a href="{{ route("admin.guiches.index") }}"
                                   class="nav-link {{ request()->is('admin/guiches') || request()->is('admin/guiches/*') ? 'active' : '' }}">
                                    <i class="fas fa-chalkboard-teacher">

                                    </i>
                                    {{ trans('global.guiches.guiche_management') }}
                                </a>
                            </li>
                        @endcan

                        {{--Gerenciamento de Painéis--}}
                        @can('Pode acessar administração de painéis')
                            <li class="nav-item">
                                <a href="{{ route("admin.panels.index") }}"
                                   class="nav-link {{ request()->is('admin/panels') || request()->is('admin/panels/*') ? 'active' : '' }}">
                                    <i class="fas fa-desktop">

                                    </i>
                                    {{ trans('global.panels.panels_management') }}
                                </a>
                            </li>
                        @endcan

                        {{--Ver Paineis de Painéis--}}
                        @can('Pode acessar administração de painéis')
                            <li class="nav-item">
                                <a href="{{ route("panelview.index") }}"
                                   class="nav-link {{ request()->is('panelview') || request()->is('panelview/*') ? 'active' : '' }}">
                                    <i class="fas fa-desktop">

                                    </i>
                                    Painel Geral
                                </a>
                            </li>
                        @endcan

                        {{--Gerenciamento de Cores--}}
                        @can('Acesso a administração do sistema')
                            <li class="nav-item">
                                <a href="{{ route("admin.colors.index") }}"
                                   class="nav-link {{ request()->is('admin/colors') || request()->is('admin/colors/*') ? 'active' : '' }}">
                                    <i class="fas fa-paint-brush">

                                    </i>
                                    {{ trans('global.color_control') }}
                                </a>
                            </li>
                        @endcan

                    </ul>

                </li>
            @endcan

            {{--gerenciamento de chamadas--}}
            @can('Pode acessar números')
                <li class="nav-item">
                    <a href="{{ route("admin.numbers.index") }}"
                       class="nav-link {{ request()->is('admin/numbers') || request()->is('admin/numbers/*') ? 'active' : '' }}">
                        <i class="fas fa-sort-numeric-asc nav-icon">

                        </i>
                        {{ trans('global.number.numbers_management') }}
                    </a>
                </li>
            @endcan

            {{--Admin chamadas PIS--}}
            @can('Pode acessar gerenciamento de chamadas (PIS)')
                <li class="nav-item">
                    <a href="{{ route("admin.piscalls.index") }}"
                       class="nav-link {{ request()->is('admin/piscalls') || request()->is('admin/piscalls/*') ? 'active' : '' }}">
                        <i class="fas fa-user-md nav-icon">

                        </i>
                        {{ trans('global.pis_calls.pis_calls_management') }}
                    </a>
                </li>
            @endcan

            {{--Admin chamadas PE--}}
            @can('Pode acessar gerenciamento de chamadas (PE)')
                <li class="nav-item">
                    <a href="{{ route("admin.pecalls.index") }}"
                       class="nav-link {{ request()->is('admin/pecalls') || request()->is('admin/pecalls/*') ? 'active' : '' }}">
                        <i class="fas fa-bullhorn nav-icon">

                        </i>
                        {{ trans('global.pe_calls.pe_calls_management') }}
                    </a>
                </li>
            @endcan

            {{--Controle de dispensados PCD--}}
            @can('Pode acessar dispensados')
                <li class="nav-item">
                    <a href="{{ route("admin.dispensados.index") }}"
                       class="nav-link {{ request()->is('admin/dispensados') || request()->is('admin/dispensados/*') ? 'active' : '' }}">
                        <i class="fas fa-ban nav-icon">

                        </i>
                        {{ trans('global.dismiss_control') }}
                    </a>
                </li>
            @endcan

            {{--Controle de selecionados PCS--}}
            @can('Pode acessar selecionados')
                <li class="nav-item">
                    <a href="{{ route("admin.selecionados.index") }}"
                       class="nav-link {{ request()->is('admin/selecionados') || request()->is('admin/selecionados/*') ? 'active' : '' }}">
                        <i class="fas fa-check-circle nav-icon">

                        </i>
                        {{ trans('global.selected_control') }}
                    </a>
                </li>
            @endcan

            {{--logout--}}
            <li class="nav-item">
                <a href="#" class="nav-link"
                   onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-sign-out-alt">

                    </i>
                    Sair
                </a>
            </li>

        </ul>

        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 869px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 415px;"></div>
        </div>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>

</div>
