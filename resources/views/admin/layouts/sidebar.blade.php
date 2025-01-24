<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <span class="brand-text font-weight">Katar</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Dashboard Menu -->
        <li class="nav-item">
          <a href="/" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <!-- Transaksi -->
        <li class="nav-item">
          <a href="/admin/transaksi" class="nav-link {{ Request::is('admin/transaksi') ? 'active' : '' }}">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>
              Transaksi
            </p>
          </a>
        </li>

        <!-- Produk Management Menu -->
        <li class="nav-item">
          <a href="/admin/produk" class="nav-link {{ Request::is('admin/produk') ? 'active' : '' }}">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Produk
            </p>
          </a>
        </li>

        <!-- Jabatan Management Menu -->
        <li class="nav-item">
          <a href="/admin/jabatan" class="nav-link {{ Request::is('admin/jabatan') ? 'active' : '' }}">
            <i class="nav-icon fas fa-briefcase"></i> 
            <p>
              Jabatan
            </p>
          </a>
        </li>

        <!-- Staff Management Menu -->
        <li class="nav-item">
          <a href="/admin/staff" class="nav-link {{ Request::is('admin/staff') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Staff
            </p>
          </a>
        </li>

        <!-- Kategori Management Menu -->
        <li class="nav-item">
          <a href="/admin/kategori" class="nav-link {{ Request::is('admin/kategori') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tags"></i>
            <p>
              Kategori
            </p>
          </a>
        </li>

        <!-- Merk Management Menu -->
        <li class="nav-item">
          <a href="/admin/merk" class="nav-link {{ Request::is('admin/merk') ? 'active' : '' }}">
            <i class="nav-icon fas fa-trademark"></i>
            <p>
              Merk
            </p>
          </a>
        </li>


        <!-- User Management Menu -->
        <li class="nav-item">
          <a href="/admin/user" class="nav-link {{ Request::is('admin/user') ? 'active' : ''}} ">
            <i class="nav-icon fas fa-users"></i>
            <p>
              User
            </p>
          </a>
        </li>

        <!-- Logout Button -->
        <li class="nav-item fixed-bottom">
            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                  @csrf
                  <button type="submit" class="nav-link text-sm" style="background: none; border: none; color: white;">
                <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</>
            </button>
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<div class="content-wrapper">
