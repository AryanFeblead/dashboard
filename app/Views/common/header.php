<script>
    var baseUrl = "<?= base_url(); ?>";
</script>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Admin</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="<?= base_url('assets/img/kaiadmin/favicon.ico') ?>" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Fonts and icons -->
<script src="<?= base_url('assets/js/plugin/webfont/webfont.min.js') ?>"></script>
<script src="<?= base_url('assets/js/core/jquery-3.7.1.min.js') ?>"></script>
<script src="<?= base_url('assets/js/core/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/js/core/bootstrap.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
        integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- jQuery Scrollbar -->
<script src="<?= base_url('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') ?>"></script>

<!-- Chart JS -->
<script src="<?= base_url('assets/js/plugin/chart.js/chart.min.js') ?>"></script>

<!-- jQuery Sparkline -->
<script src="<?= base_url('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') ?>"></script>

<!-- Chart Circle -->
<script src="<?= base_url('assets/js/plugin/chart-circle/circles.min.js') ?>"></script>

<!-- Datatables -->
<script src="<?= base_url('assets/js/plugin/datatables/datatables.min.js') ?>"></script>

<!-- Bootstrap Notify -->
<script src="<?= base_url('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') ?>"></script>

<!-- Sweet Alert -->
<script src="<?= base_url('assets/js/plugin/sweetalert/sweetalert.min.js') ?>"></script>

<!-- Kaiadmin JS -->
<script src="<?= base_url('assets/js/kaiadmin.min.js') ?>"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="<?= base_url('assets/js/setting-demo.js') ?>"></script>
<script src="<?= base_url('assets/js/demo.js') ?>"></script>
<script src="<?= base_url('assets/js/custome.js') ?>"></script>

  <script>
    WebFont.load({
      google: {
        families: ["Public Sans:300,400,500,600,700"]
      },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["assets/css/fonts.min.css"],
      },
      active: function () {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
<link rel="stylesheet" href="<?= base_url('assets/css/plugins.min.css') ?>" />
<link rel="stylesheet" href="<?= base_url('assets/css/kaiadmin.min.css') ?>" />

<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="<?= base_url('assets/css/demo.css') ?>" />

</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a href="index.html" class="logo">
            <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
        <!-- End Logo Header -->
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <ul class="nav nav-secondary">
            <li class="nav-section">
              <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
              </span>
              <h4 class="text-section">Components</h4>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#base">
                <i class="fas fa-layer-group"></i>
                <p>Product</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="base">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="<?= site_url("/addProduct") ?>">
                      <span class="sub-item">Add
                        Products</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= site_url("/viewProduct") ?>">
                      <span class="sub-item">View
                        Product</span>
                    </a>
                  </li>

                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#sidebarLayouts">
                <i class="fas fa-th-list"></i>
                <p>Customer</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="sidebarLayouts">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="<?= site_url("/addCustomer") ?>">
                      <span class="sub-item">Add
                        Customer</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= site_url("/viewCustomer") ?>">
                      <span class="sub-item">View
                        Customer</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#forms">
                <i class="fas fa-pen-square"></i>
                <p>Order</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="forms">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="<?= site_url("/addOrder") ?>">
                      <span class="sub-item">Add
                        Orders</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= site_url("/viewOrder") ?>">
                      <span class="sub-item">View
                        Orders</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a href="<?= site_url("/report") ?>">
                <i class="fas fa-table"></i>
                <p>Report</p>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    