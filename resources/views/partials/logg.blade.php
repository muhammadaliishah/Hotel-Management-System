
<ul class="navbar-nav">
	@auth
    <li class="nav-item">
        <a  class="nav-link text-white"  title="Manage">Hello {{auth()->user()->name}}</a>
    </li>
    <li class="nav-item">
        <form  class="form-inline">
            <a  href="{{ route('logout.perform') }}" class="nav-link btn btn-link text-white">Logout</a>
        </form>
    </li>
    @endauth
    @guest
    <li class="nav-item">
        {{-- <a href="{{ route('login.perform') }}" class="nav-link text-white" >Login</a> --}}
    </li>
    @endguest
</ul>
