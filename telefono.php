<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | General Form Elements</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="./css/toastr.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">


    <?php
    include 'validar_usuario.php';
    include 'menubar.php'
    ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Telefono</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">General Form</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Telefono agregar</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="marca">Marca</label>
                          <input type="text" class="form-control" id="marca" placeholder="Ingrese marca">
                        </div>
                        <div class="form-group">
                          <label for="modelo">Modelo</label>
                          <input type="text" class="form-control" id="modelo" placeholder="Ingrese modelo">
                        </div>
                        <div class="form-group">
                          <label for="serie">Serie</label>
                          <input type="text" class="form-control" id="serie" placeholder="Ingrese serie">
                        </div>
                        <div class="form-group">
                          <label for="contrasena">Contraseña</label>
                          <input type="text" class="form-control" id="contrasena" placeholder="Ingrese contraseña">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="color">Color</label>
                          <input type="text" class="form-control" id="color" placeholder="Ingrese color">
                        </div>
                        <div class="form-group">
                          <label>Cliente</label>
                          <select class="form-control select2" id="cliente" style="width: 100%;">
                            
                          </select>
                        </div>
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="memoria">
                          <label class="form-check-label" for="memoria">Memoria</label>
                        </div>
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="sim">
                          <label class="form-check-label" for="sim">Sim</label>
                        </div>
                        <div class="card-footer text-center">
                          <button type="submit" class="btn btn-primary" id="btn_submit">Submit</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->


              </div>
              <!-- /.card -->

            </div>
            <!--/.col (left) -->



          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.1.0
      </div>
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- Page specific script -->
  <!-- Select2 -->
  <script src="plugins/select2/js/select2.full.min.js"></script>
  <!-- Toastr -->
  <script src="./js/toastr.min.js"></script>
  <script src="./js/telefono.js"></script>
  <script>
    $(function() {
      bsCustomFileInput.init();
    });
  </script>
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
  </script>
</body>

</html>