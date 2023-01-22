<header>
    <div class="side">
        <button class="toggle-btn icon-btn">
            <i class="fa fa-bars"></i>
        </button>
        DR.CLEAN
    </div>
    <ul class="top-header-links">
        <li>
            <button onclick="$('#logout-form').submit()">
                <i class="fa fa-power-off"></i>
            </button>
        </li>
    </ul>
</header>
<form id="logout-form" action="{{ route('logout') }}" method="post">
    @csrf
</form>
