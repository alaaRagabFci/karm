<li class="nav-item {{Request::is('/') ? 'start active open':'' }}">
    <a href="{{ url('/') }}" class="nav-link nav-toggle">
        <i class="icon-home"></i>
        <span class="title">لوحة التحكم</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('settings') ? 'start active open':'' }}">
    <a href="{{ url('settings') }}" class="nav-link nav-toggle">
        <i class="fa fa-cogs"></i>
        <span class="title">الأعدادات</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('countries', 'regions') ? 'start active open':'' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-globe"></i>
        <span class="title">المدن والأحياء</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{Request::is('countries') ? 'start active open':'' }}">
            <a href="{{ url('/countries') }}" class="nav-link ">
                <i class="fa fa-globe"></i>
                <span class="title"> المدن </span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item {{Request::is('regions') ? 'start active open':'' }}">
            <a href="{{ url('regions') }}" class="nav-link nav-toggle">
                <i class="fa fa-globe"></i>
                <span class="title">الأحياء</span>
                <span class="selected"></span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item {{Request::is('categories') ? 'start active open':'' }}">
    <a href="{{ url('categories') }}" class="nav-link nav-toggle">
        <i class="fa fa-list-alt" aria-hidden="true"></i>
        <span class="title">الأقسام الرئيسية</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('users', 'drivers', 'cashairs') ? 'start active open':'' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-users"></i>
        <span class="title">المستخدمين</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{Request::is('users') ? 'start active open':'' }}">
            <a href="{{ url('/users') }}" class="nav-link ">
                <i class="fa fa-users"></i>
                <span class="title"> الأعضاء </span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item {{Request::is('drivers') ? 'start active open':'' }}">
            <a href="{{ url('/drivers') }}" class="nav-link ">
                <i class="fa fa-motorcycle"></i>
                <span class="title"> الموصلون </span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item {{Request::is('cashairs') ? 'start active open':'' }}">
            <a href="{{ url('/cashairs') }}" class="nav-link ">
                <i class="fa fa-cutlery" aria-hidden="true"></i>
                <span class="title"> الكاشير </span>
                <span class="selected"></span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item {{Request::is('receving-types') ? 'start active open':'' }}">
    <a href="{{ url('receving-types') }}" class="nav-link nav-toggle">
        <i class="fa fa-money-bill"></i>
        <span class="title">اليات استلام الطلبات</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('meals') ? 'start active open':'' }}">
    <a href="{{ url('meals') }}" class="nav-link nav-toggle">
        <i class="fa fa-cutlery" aria-hidden="true"></i>
        <span class="title">الواجبات</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('additions') ? 'start active open':'' }}">
    <a href="{{ url('additions') }}" class="nav-link nav-toggle">
        <i class="fab fa-angellist"></i>
        <span class="title">الأضافات</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('sliders') ? 'start active open':'' }}">
    <a href="{{ url('sliders') }}" class="nav-link nav-toggle">
        <i class="fab fa-adversal"></i>
        <span class="title">سلايدر العروض</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('promocodes') ? 'start active open':'' }}">
    <a href="{{ url('promocodes') }}" class="nav-link nav-toggle">
        <i class="fa fa-tag"></i>
        <span class="title">كوبونات خصم</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('orders') ? 'start active open':'' }}">
    <a href="{{ url('orders') }}" class="nav-link nav-toggle">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        <span class="title">الطلبات</span>
        <span class="selected"></span>
    </a>
</li>


