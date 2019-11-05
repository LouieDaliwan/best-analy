@foreach ($menus as $submenu)
  @can($submenu->key('permissions'))
    @if ($submenu->is('divider'))

      <div class="sidebar-dropdown-divider"></div>

    @else

      <a title="{{ $submenu->description() }}" class="sidebar-dropdown-item {{ $submenu->active() ? 'active' : null }}" href="{{ $submenu->url() }}" data-order="{{ $submenu->order() }}">
        @if ($submenu->icon())
          <span class="mr-3">@icon($submenu->icon())</span>
        @endif

        @lang($submenu->text())

        @if ($submenu->has('badge'))
          @badge($submenu->badge())
        @endif
      </a>

    @endif
  @endcan
@endforeach
