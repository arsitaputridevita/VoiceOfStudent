<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href=" ">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Tentang</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('backend.pengumuman.index')}}">
              <i class="bi bi-circle"></i><span>Table Pengumuman</span>
            </a>
          </li>
          <li>
            <a href="{{route('backend.departemen.index')}}">
              <i class="bi bi-circle"></i><span>Table Departemen</span>
            </a>
          </li>
          <li>
            <a href="{{route('backend.keluhan.index')}}">
              <i class="bi bi-circle"></i><span>Table Keluhan</span>
            </a>
          </li>
          <li>
            <a href="{{route('backend.kategori.index')}}">
              <i class="bi bi-circle"></i><span>Table kategori</span>
            </a>
          </li>
          <li>
            <a href="{{route('backend.priority.index')}}">
              <i class="bi bi-circle"></i><span>Table priority</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->


      <li class="nav-heading">Pages</li>

     
    </ul>

  </aside>