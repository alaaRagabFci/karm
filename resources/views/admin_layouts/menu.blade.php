<li class="nav-item {{Request::is('adminpanel') ? 'start active open':'' }}">
    <a href="{{ url('/adminpanel') }}" class="nav-link nav-toggle">
        <i class="icon-home"></i>
        <span class="title">Dashboard</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('vehicles') ? 'start active open':'' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-truck"></i>
        <span class="title">Vehicles</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{Request::is('vehicles') ? 'start active open':'' }}">
            <a href="{{ url('/vehicles') }}" class="nav-link ">
                <i class="fa fa-truck"></i>
                <span class="title"> Vehicles </span>
                <span class="selected"></span>
            </a>
        </li>
    </ul>
</li>
