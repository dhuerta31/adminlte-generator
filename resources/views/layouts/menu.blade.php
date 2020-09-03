<li class="{{ 'home' == request()->path() ? 'active' : '' }}">
    <a href="{{route('home')}}">
        <i class="fa fa-dashboard"></i> 
        <span>Panel</span>
    </a>
</li>

@if(Auth::user()->rol == 1)
<li class="{{ 'users' == request()->path() ? 'active' : '' }}">
    <a href="{{route('users')}}">
        <i class="fa fa-group"></i> 
        <span>Users</span>
    </a>
</li>
@else

@endif
<li class="{{ 'valor_uf' == request()->path() ? 'active' : '' }}">
    <a href="{{route('valor_uf')}}">
        <i class="fa fa-money"></i> 
        <span>Valor UF</span>
    </a>
</li>
<li class="{{ 'profile' == request()->path() ? 'active' : '' }}">
    <a href="{{route('profile')}}">
        <i class="fa fa-user"></i> 
        <span>Profile</span>
    </a>
</li>
<li>
    <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-off').submit();">
        <i class="fa fa-sign-out"></i> 
        <span>Cerrar sesión</span>
    </a>
    <form id="logout-off" action="{{ url('/logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</li>