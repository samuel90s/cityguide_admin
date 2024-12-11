<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Dashboard Menu -->
        <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if (Auth::user()->role == 1)
    <!-- Destinations (Includes Culinary) -->
    <li class="nav-item {{ Request::is('destinations*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('destinations.index') }}">
            <i class="ti-location-pin menu-icon"></i>
            <span class="menu-title">Destinations</span>
        </a>
    </li>

    <!-- Accommodations -->
    <li class="nav-item {{ Request::is('accommodations*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('accommodations.index') }}">
            <i class="ti-home menu-icon"></i>
            <span class="menu-title">Accommodations</span>
        </a>
    </li>

    <!-- Events -->
    <li class="nav-item {{ Request::is('events*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('events.index') }}">
            <i class="ti-calendar menu-icon"></i>
            <span class="menu-title">Events</span>
        </a>
    </li>

    <!-- Transportations -->
    <li class="nav-item {{ Request::is('transportations*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('transportations.index') }}">
            <i class="ti-car menu-icon"></i>
            <span class="menu-title">Transportations</span>
        </a>
    </li>
@endif

    </ul>
</nav>
