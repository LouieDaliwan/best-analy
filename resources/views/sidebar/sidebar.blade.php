<div id="sidebar" data-sidebar class="sidebar sidebar-fixed active">
  <header class="sidebar-header">
    @brand(url('logo.png'))
  </header>
  <div class="sidebar-content">
    <nav class="sidebar-nav" data-sidebar-nav>
      @foreach (sidebar()->all() ?? [] as $i => $menu)
        @if ($menu->is('header'))

          <div class="sidebar-group-separator mt-6 pl-4 {{ $menu->class() }}">
            <small>{{ $menu->text() }}</small>
          </div>

        @elseif ($menu->hasChild())

          @can($menu->key('permissions'))
            <div class="sidebar-dropdown">
              <a role="button" title="{{ $menu->description() }}" href="#" aria-expanded="{{ $menu->active() ? 'true' : 'false' }}" data-toggle="collapse" data-target="#sidebar-dropdown-{{ $menu->id() }}" class="sidebar-dropdown-toggle sidebar-item {{ $menu->active() ? 'active' : null }}">
                @if ($menu->icon())
                  <span class="mr-3">@icon($menu->icon())</span>
                @endif
                @if ($menu->text())
                  <span>@lang($menu->text())</span>
                @endif
                @if ($menu->has('badge'))
                  @badge($menu->badge())
                @endif

                @if ($menu->hasChild())
                  <span class="ml-auto sidebar-toggle-icon">
                    <i class="mdi mdi-chevron-down"></i>
                  </span>
                @endif
              </a>
              <div id="sidebar-dropdown-{{ $menu->id() }}" class="sidebar-dropdown-menu collapse {{ $menu->active() ? 'show active' : null }}" data-parent="[data-sidebar-nav]">
                @include('theme::sidebar.menus', ['menus' => $menu->children()])
              </div>
            </div>
          @endcan

        @else

          @can($menu->key('permissions'))
            <a role="button" title="{{ $menu->description() }}" href="{{ $menu->url() }}" class="sidebar-item {{ $menu->active() ? 'active' : null }}">
              @if ($menu->icon())
                <span class="mr-3">
                  @icon($menu->icon())
                </span>
              @endisset

              @lang($menu->text())

              @if ($menu->has('badge'))
                @badge($menu->badge())
              @endif
            </a>
          @endcan

        @endif
      @endforeach

    </nav>
  </div>
</div>
