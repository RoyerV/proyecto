
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>LISTA DE CLIENTES</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Crear Cliente</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Rellene el formulario para crear un cliente</h3>
              
              <div class="card-body">

<?php
echo form_open_multipart('cliente/agregarbd');
?>

                    <input type="text" name="nombre" placeholder="Escribe el nombre" class="form-control">
                    <input type="text" name="apellido1" placeholder="Apellido Paterno" class="form-control">
                    <input type="text" name="apellido2" placeholder="Apellido Materno" class="form-control">

                    <button type="submit" class="btn btn-success">AGREGAR</button>
<?php
echo form_close();
?>               



              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->