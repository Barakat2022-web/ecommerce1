<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
      <!-- sidebar menu start-->
      <ul class="sidebar-menu" id="nav-accordion">
        <p class="centered"><a href=""><img src="img/ui-sam.jpg" class="img-circle" width="80"></a></p>
        <h5 class="centered">Sam Soffes</h5>

        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-language"></i>
            <span>لغات الموقع   <span class="badge bg-success">{{App\Models\Language::count()}}</span></span>
            </a>

          <ul class="sub">
            <li><a href="{{route('language.index')}}">عرض الكل</a></li>
            <li><a href="{{route('language.create')}}">أضافة لغة جديدة</a></li>

          </ul>
        </li>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-list-alt"></i>
            <span>الأقسام الرئيسية</span>
            <span class="badge bg-success">{{App\Models\main_category::Arabic()->count()}}</span>
            </a>
          <ul class="sub">
            <li><a href="{{route('maincategories.index')}}">عرض الكل</a></li>
            <li><a href="{{route('maincategories.create')}}">أضافة قسم جديد</a></li>

          </ul>
        </li>

        <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-list-alt"></i>
              <span>الأقسام الفرعية</span>
              <span class="badge bg-success">{{App\Models\sub_category::count()}}</span>
              </a>
            <ul class="sub">
              <li><a href="">عرض الكل</a></li>
              <li><a href="">أضافة قسم فرعي جديد</a></li>

            </ul>
        </li>

        <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-list-alt"></i>
              <span>الماركات التجارية</span>
              <span class="badge bg-success">{{App\Models\brand::count()}}</span>
              </a>
            <ul class="sub">
              <li><a href="{{route('brands.index')}}">عرض الكل</a></li>
              <li><a href="{{route('brands.create')}}">أضافة ماركة جديدة</a></li>

            </ul>
          </li>

        <li class="sub-menu">
            <a href="javascript:;">
                <i class="fa fa-cogs"></i>
              <span>المتاجر</span>
              <span class="badge bg-success">{{App\Models\vendor::count()}}</span>
              </a>
            <ul class="sub">
              <li><a href="{{route('vendors.index')}}">عرض الكل</a></li>
              <li><a href="{{route('vendors.create')}}">أضافة متجر جديد</a></li>

            </ul>
          </li>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-book"></i>
            <span>Extra Pages</span>
            </a>
          <ul class="sub">
            <li><a href="blank.html">Blank Page</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="lock_screen.html">Lock Screen</a></li>
            <li><a href="profile.html">Profile</a></li>
            <li><a href="invoice.html">Invoice</a></li>
            <li><a href="pricing_table.html">Pricing Table</a></li>
            <li><a href="faq.html">FAQ</a></li>
            <li><a href="404.html">404 Error</a></li>
            <li><a href="500.html">500 Error</a></li>
          </ul>
        </li>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-tasks"></i>
            <span>Forms</span>
            </a>
          <ul class="sub">
            <li><a href="form_component.html">Form Components</a></li>
            <li><a href="advanced_form_components.html">Advanced Components</a></li>
            <li><a href="form_validation.html">Form Validation</a></li>
            <li><a href="contactform.html">Contact Form</a></li>
          </ul>
        </li>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-th"></i>
            <span>Data Tables</span>
            </a>
          <ul class="sub">
            <li><a href="">Basic Table</a></li>
            <li><a href="">Responsive Table</a></li>
            <li><a href="">Advanced Table</a></li>
          </ul>
        </li>
        <li>
          <a class="active" href="">
            <i class="fa fa-envelope"></i>
            <span>Mail </span>
            <span class="label label-theme pull-right mail-info">3</span>
            </a>
        </li>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class=" fa fa-bar-chart-o"></i>
            <span>Charts</span>
            </a>
          <ul class="sub">
            <li><a href="">Morris</a></li>
            <li><a href="">Chartjs</a></li>
            <li><a href="">Flot Charts</a></li>
            <li><a href="">xChart</a></li>
          </ul>
        </li>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-comments-o"></i>
            <span>Chat Room</span>
            </a>
          <ul class="sub">
            <li><a href="">Lobby</a></li>
            <li><a href=""> Chat Room</a></li>
          </ul>
        </li>
        <li>
          <a href="">
            <i class="fa fa-map-marker"></i>
            <span>Google Maps </span>
            </a>
        </li>
      </ul>
      <!-- sidebar menu end-->
    </div>
  </aside>
  <!--sidebar end-->
