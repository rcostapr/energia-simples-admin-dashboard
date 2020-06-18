<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <img alt="Logotipo Energia Simples" src="/img/brand.png" width="auto" height="45" />
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-right d-none d-md-inline colpad">
        <button class="border-0" id="sidebarToggle"></button>
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item{{ $_SERVER["REQUEST_URI"] == '/' ? ' active' : '' }}">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item{{ $_SERVER["REQUEST_URI"] == '/buttons.php' ? ' active' : '' }}" href="buttons.php">Buttons</a>
                <a class="collapse-item{{ $_SERVER["REQUEST_URI"] == '/cards.php' ? ' active' : '' }}" href="cards.php">Cards</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item{{ $_SERVER["REQUEST_URI"] == '/utilities-color.php' ? ' active' : '' }}" href="utilities-color.php">Colors</a>
                <a class="collapse-item{{ $_SERVER["REQUEST_URI"] == '/utilities-border.php' ? ' active' : '' }}" href="utilities-border.php">Borders</a>
                <a class="collapse-item{{ $_SERVER["REQUEST_URI"] == '/utilities-animation.php' ? ' active' : '' }}" href="utilities-animation.php">Animations</a>
                <a class="collapse-item{{ $_SERVER["REQUEST_URI"] == '/utilities-other.php' ? ' active' : '' }}" href="utilities-other.php">Other</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item{{ $_SERVER["REQUEST_URI"] == '/login.php' ? ' active' : '' }}" href="login.php">Login</a>
                <a class="collapse-item{{ $_SERVER["REQUEST_URI"] == '/register.php' ? ' active' : '' }}" href="register.php">Register</a>
                <a class="collapse-item{{ $_SERVER["REQUEST_URI"] == '/forgot-password.php' ? ' active' : '' }}" href="forgot-password.php">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item{{ $_SERVER["REQUEST_URI"] == '/404.php' ? ' active' : '' }}" href="404.php">404 Page</a>
                <a class="collapse-item{{ $_SERVER["REQUEST_URI"] == '/blank.php' ? ' active' : '' }}" href="blank.php">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item{{ $_SERVER["REQUEST_URI"] == '/charts.php' ? ' active' : '' }}">
        <a class="nav-link" href="charts.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item{{ $_SERVER["REQUEST_URI"] == '/tables.php' ? ' active' : '' }}">
        <a class="nav-link" href="tables.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Nav Item - CKEditor -->
    <li class="nav-item{{ $_SERVER["REQUEST_URI"] == '/ckeditor.php' ? ' active' : '' }}">
        <a class="nav-link" href="ckeditor.php">
            <i class="fas fa-text-width"></i>
            <span>CK Editor</span></a>
    </li>
</ul>