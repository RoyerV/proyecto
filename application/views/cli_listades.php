<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>bootstrap/css/bootstrap.css">
    <script src="<?php echo base_url();?>bootstrap/js/boststrap.js"></script>


</head>
<body>
    <h1>INICIO</h1>

   <div class="container">
        <div class="row">
            <div class="col-md-12">



                <a href="<?php echo base_url(); ?>index.php/cliente/index">
                
                <button type="button" class="btn btn-warning">Ver lista habilitados</button>
                
              
            </a>



                <h1>Lista de clientes deshabilitados</h1>

                <table class="table">
                    <tr>
                        <td>No</td>
                        <td>Nombre</td>
                        <td>Apellido P.</td>
                        <td>Apellido M.</td>
                        <td>Compra</td>
                        <td>Deshabilitar</td>
                    </tr>

                    <?php

                    $indice=1;
                     
                    foreach($clientes->result() as $row)
                    {
                        ?>
                            <tr>
                                <td><?php echo $indice ?></td>
                                <td><?php echo $row->nombre; ?></td>
                                <td><?php echo $row->primerApellido; ?></td>
                                <td><?php echo $row->segundoApellido; ?></td>
                                <td><?php echo $row->compra; ?></td>
                 


<td>
<?php 
echo form_open_multipart('cliente/habilitarbd');
?>
<input type="hidden" name="idcliente" value="<?php echo $row->idCliente; ?>">
<button type="submit" class="btn btn-warning">HABILITAR</button>
<?php
echo form_close();
?>
</td>
                            </tr>

                        <?php
                        $indice++;

                    }
                    ?>

                    

                </table>

            </div>


        </div>

   </div>

    


    



    

 <script src="<?php echo base_url();?>bootstrap/js/boststrap.bundle.min.js"></script>

</body>
</html>