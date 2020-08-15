<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= isset($idt->nm_perusahaan) ? $idt->nm_perusahaan : 'not-set'; ?><?= isset($template['title']) ? ' | ' . $template['title'] : ''; ?></title>
  <link rel="shortcut icon" href="<?php echo base_url('assets/'); ?>images/importa.png" />

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="<?= base_url('assets/dist/sweetalert.css'); ?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/bootstrap/css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/ionicons/css/ionicons.min.css'); ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/select2.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/AdminLTE.min.css'); ?>">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/iCheck/all.css'); ?>">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/skins/_all-skins.min.css'); ?>">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/css/styles.css'); ?>">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/datepicker/datepicker3.css'); ?>">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/timepicker/bootstrap-timepicker.min.css'); ?>">
  <!-- bootstrap datetimepicker -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/datetimepicker/bootstrap-datetimepicker.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/custom_ddr.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/my.css'); ?>">

  <!-- jQuery 2.2.3 -->
  <!--<script src="<?= base_url('assets/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>-->
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <!-- bootstrap datepicker -->
  <script src="<?= base_url('assets/plugins/daterangepicker/moment.min.js'); ?>"></script>
  <script src="<?= base_url('assets/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
  <!-- bootstrap time picker -->
  <script src="<?= base_url('assets/plugins/timepicker/bootstrap-timepicker.min.js'); ?>"></script>
  <!-- bootstrap datetimepicker -->
  <script src="<?= base_url('assets/plugins/datetimepicker/bootstrap-datetimepicker.js'); ?>"></script>
  <script src="<?= base_url('assets/plugins/datetimepicker/moment-with-locales.js'); ?>"></script>

  <!-- Sweet Alert -->
  <script src="<?= base_url('assets/dist/sweetalert.min.js'); ?>"></script>
  <!-- Form Jquery -->
  <script src="<?= base_url('assets/plugins/jqueryform/jquery.form.js'); ?>"></script>
  <script src="<?= base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/scripts.js'); ?>" type="text/javascript"></script>
  <!-- <script src="<?= base_url('assets/adminlte/bootstrap/js/bootstrap-filestyle.js'); ?>"></script> -->

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css') ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style>
    .tooltip.top .tooltip-inner {
      max-width: 310px;
      padding: 5px 8px;
      color: #fff;
      text-align: center;
      font-size: 14px;
      background-color: indigo;
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;
      border-radius: 5px
    }

    .tooltip.top .tooltip-arrow {
      border-top-color: indigo;
    }

    .img-upload {
      width: 208px;
      height: 208px;
      float: left;
      background: #eee;
      padding: 5px 5px 5px 5px;
      margin: 3px;
    }

    .img-upload>img {
      display: block;
      display: block;
      margin: auto auto;

    }

    .box-opload {
      float: left;
      width: 208px;
      float: left;
      margin: 3px;
    }

    .progress {
      position: relative;
      top: -7px;
      width: 200px;
      height: 5px;
      margin-left: 8px;

    }

    .progress>.progress-bar {
      height: 4px;
      position: relative !important;
      bottom: 0px;
    }

    #holder.hover {
      border: 10px dashed #0c0 !important;
    }

    .boxfile {
      align-items: center;
      display: flex;
      justify-content: center;
      top: 50px;
      position: relative;
      height: 40px;
      width: 300px;
    }

    .drag {
      font-size: 30px;
      color: #ccc;
      align-items: center;
      display: flex;
      justify-content: center;
    }

    .material-switch>input[type="checkbox"] {
      display: none;
    }

    .material-switch>label {
      cursor: pointer;
      height: 0px;
      position: relative;
      width: 40px;
    }

    .material-switch>label::before {
      background: rgb(0, 0, 0);
      /* box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5); */
      border-radius: 10px;
      content: '';
      height: 18px;
      margin-top: -8px;
      position: absolute;
      opacity: 0.3;
      transition: all 0.4s ease-in-out;
      width: 37px;
    }

    .material-switch>label::after {
      background: rgb(255, 255, 255);
      border-radius: 16px;
      box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
      content: '';
      height: 14px;
      left: 3px;
      margin-top: -6px;
      position: absolute;
      top: 0px;
      transition: all 0.3s ease-in-out;
      width: 14px;
    }

    .material-switch>input[type="checkbox"]:checked+label::before {
      background: inherit;
      opacity: 1;
    }

    .material-switch>input[type="checkbox"]:checked+label::after {
      /* background: inherit; */
      left: 20px;
    }


    @media (min-width: 768px) {
      .sidebar-mini.sidebar-collapse .sidebar-menu>li:hover>.treeview-menu {
        top: 45px
      }

      .sidebar-mini.sidebar-collapse .sidebar-menu>li:hover>a>span {
        height: 50px;
      }

      .sidebar-mini.sidebar-collapse .main-sidebar {
        -webkit-transform: translate(0, 0);
        -ms-transform: translate(0, 0);
        -o-transform: translate(0, 0);
        transform: translate(0, 0);
        width: 55px !important;
      }

      .sidebar-mini.sidebar-collapse .main-header .navbar {
        margin-left: 55px !important;
      }

      .sidebar-mini.sidebar-collapse .main-header .logo {
        width: 55px;
      }
    }

    /* always show scrollbars */

    ::-webkit-scrollbar {
      -webkit-appearance: none;
      width: 10px;
      right: -80px;
    }

    ::-webkit-scrollbar-thumb {
      border-radius: 5px;
      background-color: silver;
      box-shadow: 0 0 1px rgba(0, 0, 0, .5);
    }

    .fa-size-25 {
      font-size: 20px;
    }
    }
  </style>
  <script type="text/javascript">
    var baseurl = "<?= base_url(); ?>";
    var siteurl = "<?php echo site_url(); ?>";
    var base_url = siteurl;
    var active_controller = '<?php echo $this->uri->segment(1); ?>' + '/';
    var active_function = '<?php echo $this->uri->segment(2); ?>' + '/';
  </script>
</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
  <div class="ajax_loader">
    <img src="<?php echo base_url('assets/images/loading_1.gif'); ?>">
  </div>
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="<?= site_url(); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>IDF</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><?= isset($idt->nm_perusahaan) ? $idt->nm_perusahaan : 'not-set'; ?></b></span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Notifications Menu -->


            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?= (isset($userData->photo) && file_exists('assets/images/users/' . $userData->photo)) ? base_url('assets/images/users/' . $userData->photo) : base_url('assets/images/male-def.png'); ?>" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">
                  <?php echo isset($userData->nm_lengkap) ? ucwords($userData->nm_lengkap) : $userData->username; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?= (isset($userData->photo) && file_exists('assets/images/users/' . $userData->photo)) ? base_url('assets/images/users/' . $userData->photo) : base_url('assets/images/male-def.png'); ?>" class="img-circle" alt="User Image">

                  <p>
                    <?= isset($userData->nm_lengkap) ? ucwords($userData->nm_lengkap) : $userData->username; ?> - <?= isset($userData->groups) ? $userData->groups : '-'; ?>
                    <small>Member since <?= isset($userData->created_on) ? date('M Y', strtotime($userData->created_on)) : '-'; ?></small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat bg-green">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?= site_url('users/logout'); ?>" class="btn btn-default btn-flat bg-red">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar Menu -->
        <?= $this->menu_generator->build_menus(); ?>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <i class="<?= isset($template['page_icon']) ? $template['page_icon'] : 'fa fa-table'; ?>"></i>
          <?= isset($template['title']) ? $template['title'] : ''; ?>
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">