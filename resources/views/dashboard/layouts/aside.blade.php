<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar">

  <!-- Sidebar - Brand -->

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="{{ route('dashboard.index') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span class="text-right">لوحة التحكم</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-folder"></i>
      <span>جداول الموقع</span>
    </a>
    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header text-right"> جداول الموقع </h6>
        <a class="collapse-item text-right" href="{{ route('dashboard.users') }}"> جدول المستخدمين </a>
        <a class="collapse-item text-right" href="{{ route('dashboard.reservations') }}">جدول طلبات الحجز</a>
        <a class="collapse-item text-right" href="{{  route('dashboard.agars') }}">جدول العقارات</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-folder"></i>
      <span>ادارة بيانات العقارات</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header text-right"> بيانات العقارات  </h6>
        <a class="collapse-item text-right" href="{{ route('dashboard.b_extra') }}"> ادارة المرافق الاساسية  </a>
        <a class="collapse-item text-right" href="{{ route('dashboard.a_extra') }}">ادارة المرافق الاضافية  </a>
        <a class="collapse-item text-right" href="{{  route('dashboard.sf_extra') }}">ادارة المرافق الخاصة </a>
        <a class="collapse-item text-right" href="{{  route('dashboard.agar_floor') }}">ادارة الطوابق  </a>
        <a class="collapse-item text-right" href="{{  route('dashboard.agar_type') }}"> ادارة انواع العقارات  </a>
        <a class="collapse-item text-right" href="{{  route('dashboard.agar_condition') }}">ادارة شروط السكن  </a>
        <a class="collapse-item text-right" href="{{  route('dashboard.states') }}"> ادارة الولايات  </a>
        <a class="collapse-item text-right" href="{{  route('dashboard.cities') }}"> ادارة المدن </a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard.payment') }}">
      <i class="fas fa-fw fa-credit-card"></i>
      <span class="text-right">ادارة عمليات الدفع</span>
    </a>

    <a class="nav-link" href="{{ route('dashboard.contact') }}">
      <i class="fas fa-fw fa-info-circle"></i>
      <span class="text-right">استفسارات المستخدمين</span>
    </a>

    <a class="nav-link" href="{{ route('dashboard.settings') }}">
      <i class="fas fa-fw fa-cogs"></i>
      <span class="text-right">اعدادات الموقع</span>
    </a>

  </li>


  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->
