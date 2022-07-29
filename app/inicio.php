 <?php require_once ('../config/conexion.php'); 

      if(isset($_SESSION['sesion'])){
      $nombre = $_SESSION['sesion']['nombre'];
      $foto = $_SESSION['sesion']['perfil'];
      $permiso = $_SESSION['sesion']['permisos'];
      }else
       echo '<script> window.location="login.php"; </script>';
  ?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>SICONG / DPCP</title>
    <link rel="icon" type="image/png" href="../img/logopestana.jpg"/>
    <!-- vendor css -->

    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../lib/rickshaw/rickshaw.min.css" rel="stylesheet">

    <link href="../lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="../lib/select2/css/select2.min.css" rel="stylesheet">

    <!-- Starlight CSS -->
  
    <link href="../lib/jquery.steps/jquery.steps.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/starlight.css">

    <!-- include the core styles -->
    <link rel="stylesheet" href="../css/alertify.core.css" />
    <!-- include a theme, can be included into the core instead of 2 separate files -->
    <link rel="stylesheet" href="../css/alertify.default.css" />

    <link href="../css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="../css/adjuntos.css" rel="stylesheet">
   
  </head>
<style type="text/css">
    @media print{
        .oculto-impresion, .oculto-impresion *{
          display: none !important;
        }

        .pull-right {
        float: right !important;
      }
       .pull-center {
        float: center !important;
      }
      .pull-left {
         float: left !important;
      }

      .empresat {
        font-size: 20px !important;
      }
      .datot {
        font-size: 20px !important;
      }
      .imgt{
        display:inline !important;
      }

    }

    .datot{
      text-align: center !important;
    }
</style>
  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo"><img src="../img/logosicong.png"></div>
    <div class="sl-sideleft oculto-impresion">
      <div class="input-group input-group-search">
        <input type="search" name="search" class="form-control" placeholder="Buscar">
        <span class="input-group-btn">
          <button class="btn"><i class="fa fa-search"></i></button>
        </span><!-- input-group-btn -->
      </div><!-- input-group -->

      <label class="sidebar-label">Menu de opciones</label>
      <div class="sl-sideleft-menu">
        <a href="#" id="inicio" class="sl-menu-link active">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Empresas</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="#" id="lista_reportes" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
            <span class="menu-item-label">Lista de Reportes</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

        <a href="#" id="grafic" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
            <span class="menu-item-label">Estadisticas</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="#" id="graficos" class="nav-link">Reporte Mensual</a></li>
          <li class="nav-item"><a href="#" id="xempresa" class="nav-link">Por Empresa</a></li>
        </ul>
        
        <a href="#" id="config" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
            <span class="menu-item-label">Configuracion</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="#" id="usuarios" class="nav-link">Permisos de Usuarios</a></li>
          <li class="nav-item"><a href="#" id="asistencia" class="nav-link">Asistencia Vigilantes</a></li>
        </ul>

        
      </div><!-- sl-sideleft-menu -->

      <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="sl-header oculto-impresion">
      <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      </div><!-- sl-header-left -->
      <div class="sl-header-right">
        <nav class="nav">
          <div class="dropdown">
             <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name" id="permiso" permiso="<?=$permiso?>" > <?=$nombre?> </span>
              <img src="<?=$foto?>" class="wd-32 rounded-circle" alt="Foto de Perfil">
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <li><a href=""><i class="icon ion-ios-person-outline"></i> Editar Perfil</a></li>
                <li><a href=""><i class="icon ion-ios-gear-outline"></i> Configuracion</a></li>
                <li><a href=""><i class="icon ion-ios-download-outline"></i> Descargas</a></li>
                <li><a href="consultas/cerrar_sesion.php"><i class="icon ion-power"></i> Cerrar Sesion</a></li>
              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>
        <div class="navicon-right">
          <a id="btnRightMenu" href="" class="pos-relative">
            <i class="icon ion-ios-bell-outline"></i>
            <!-- start: if statement -->
            <span class="square-8 bg-danger"></span>
            <!-- end: if statement -->
          </a>
        </div><!-- navicon-right -->
      </div><!-- sl-header-right -->
    </div><!-- sl-header -->
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    <div class="sl-sideright">
      <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" role="tab" href="#messages">Mensajes (0)</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" role="tab" href="#notifications">Notificaciones (0)</a>
        </li>
      </ul><!-- sidebar-tabs -->
 
    
    </div><!-- sl-sideright -->
    <!-- ########## END: RIGHT PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div id="contenido" class="contenido">
       
      </div><!-- sl-pagebody -->
     
      <!-- sl-pagebody -->
        <footer class="sl-footer">
          <div class="footer-center">
            <div class="mg-b-2">Copyright &copy; 2018. Dep. Tecnologia de la informacion</div>
          </div>
        </footer>

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../lib/jquery/jquery.js"></script>
    <script src="../lib/popper.js/popper.js"></script>
    <script src="../lib/bootstrap/bootstrap.js"></script>
    <script src="../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../lib/jquery.sparkline.bower/jquery.sparkline.min.js"></script>
    <script src="../js/eventos.js"></script>

    <script src="../lib/d3/d3.js"></script>
    <script src="../lib/highlightjs/highlight.pack.js"></script>
    <script src="../lib/select2/js/select2.min.js"></script>

    <script src="../lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../lib/datatables/dataTables.buttons.min.js"></script>
    <script src="../lib/datatables/buttons.bootstrap4.min.js"></script>
    <script src="../lib/datatables/jszip.min.js"></script>
    <script src="../lib/datatables/pdfmake.min.js"></script>
    <script src="../lib/datatables/vfs_fonts.js"></script>
    <script src="../lib/datatables/buttons.html5.min.js"></script>
    <script src="../lib/datatables/buttons.print.min.js"></script>
    <script src="../lib/datatables/buttons.colVis.min.js"></script>

    <script src="../js/starlight.js"></script>
    <script src="../js/ResizeSensor.js"></script>
    <script src="../js/alertify.min.js"></script>
    <script src="../js/inicio/inicio.js"></script>

  </body>
</html>
