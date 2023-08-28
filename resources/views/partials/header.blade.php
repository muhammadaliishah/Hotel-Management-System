<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Messages Dropdown Menu -->
      @auth
    <li class="nav-item">
        <a  class="nav-link text-black"  title="Manage">Hello {{auth()->user()->name}}</a>
    </li>
    <li class="nav-item">
        <form  class="form-inline">
            <a  href="{{ route('logout.perform') }}" class="nav-link btn btn-link text-black">Logout</a>
        </form>
    </li>
    @endauth
    </ul>
  </nav>
  <!-- /.navbar -->