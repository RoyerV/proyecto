<?php

class Cliente extends CI_Controller 
{

    
        public function index()
        {
            $lista=$this->cliente_model->listaclientes();
            $data['clientes']=$lista;


            $this->load->view('inicio');
            $this->load->view('cli_lista',$data);
        }

        public function inscribir()
        {
            $data['infoproductos']=$this->producto_model->listaproducto();
          


            $this->load->view('inicio');
            $this->load->view('inscribirform',$data);
        }

        public function inscribirbd()
        {
            $this->load->view('inicio');  //mostrar formulario para agregar un nuevo cliente a BD//

            $data['nombre']=$_POST['nombre'];
            $data['primerApellido']=$_POST['apellido1'];
            $data['segundoApellido']=$_POST['apellido2'];

            $idProducto=$_POST['idProducto'];

            $this->producto_model->inscribircliente($idProducto,$data);
            redirect('cliente/index','refresh');

        }


        public function subirfoto()
        {
        
            $data['idcliente']=$_POST['idcliente'];


            $this->load->view('inicio');
            $this->load->view('subirform',$data);
        }

        public function subir()
        {
        
            $idcliente=$_POST['idcliente'];
            $nombrearchivo=$idcliente.".jpg";

            $config['upload_path']='./uploads/clientes/';

            $config['file_name']=$nombrearchivo;

            $direccion="./uploads/clientes/".$nombrearchivo;

            if(file_exists($direccion))
            {
                unlink($direccion);
            }

            $config['allowed_types']='jpg';

            $this->load->library('upload',$config);

            if(!$this->upload->do_upload())
            {
                $data['error']=$this->upload->display_errors();
            }
            else
            {
                $data['foto']=$nombrearchivo;
                $this->cliente_model->modificarcliente($idcliente,$data); //base de datos
                $this->upload->data();//copia el archivo a carpeta
            }

            redirect('cliente/indexlte','refresh');


        }

   
       
        public function agregar()
        {
            $this->load->view('inclte/cabecera');
            $this->load->view('inclte/menusuperior');
            $this->load->view('inclte/menulateral');
            $this->load->view('cli_formulario'); 
            $this->load->view('inclte/pie');
             //mostrar formulario para agregar un nuevo cliente//

        } 

        public function agregarbd()
        {
            $this->load->view('inicio');  //mostrar formulario para agregar un nuevo cliente a BD//

            $data['nombre']=$_POST['nombre'];
            $data['primerApellido']=$_POST['apellido1'];
            $data['segundoApellido']=$_POST['apellido2'];

            $this->cliente_model->agregarcliente($data);
            redirect('cliente/index','refresh');

        }

        public function eliminarbd()
        {
            $this->load->view('inicio'); 

            $idcliente=$_POST['idcliente'];
            $this->cliente_model->eliminarcliente($idcliente);

            redirect('cliente/index','refresh');
        }

        public function modificar()
        {
            $this->load->view('inicio');
            $idcliente=$_POST['idcliente'];
            $data['infocliente']=$this->cliente_model->recuperarcliente($idcliente);

            $this->load->view('cli_modificar',$data);
        }

        public function modificarbd()
        {
            $idcliente=$_POST['idcliente'];
            $data['nombre']=$_POST['nombre'];
            $data['primerApellido']=$_POST['apellido1'];
            $data['segundoApellido']=$_POST['apellido2'];
            $this->cliente_model-> modificarcliente($idcliente,$data);

            redirect('cliente/index','refresh');
        }
       
        public function deshabilitarbd()
        {
            $idcliente=$_POST['idcliente'];
            $data['habilitado']='0';

            $this->cliente_model-> modificarcliente($idcliente,$data);

            redirect('cliente/index','refresh');

        }

        public function habilitarbd()
        {
            $idcliente=$_POST['idcliente'];
            $data['habilitado']='1';

            $this->cliente_model-> modificarcliente($idcliente,$data);

            redirect('cliente/deshabilitados','refresh');

        }

        public function deshabilitados()
        {
            $lista=$this->cliente_model->listaclientesdes();
            $data['clientes']=$lista;


            $this->load->view('inicio');
            $this->load->view('cli_listades',$data);
        }

        
        public function indexlte()
        { 
            if($this->session->userdata('login'))
            {
                $lista=$this->cliente_model->listaclientes();
                $data['clientes']=$lista;
    
                $fechaprueba=formatearFecha('2023-06-23 15:09:57');
                $data['fechatest']=$fechaprueba;
    
    
                $this->load->view('inclte/cabecera');
                $this->load->view('inclte/menusuperior');
                $this->load->view('inclte/menulateral');
                $this->load->view('cli_listalte',$data);
                $this->load->view('inclte/pie');
            }
            else
            {
                redirect('usuarios/index','refresh');
            }
            
        }

        public function listapdf()
        {
            if($this->session->userdata('login'))
            {
                $lista=$this->cliente_model->listaclientes();
                $lista=$lista->result();

                $this->pdf=new Pdf();
                $this->pdf->AddPage();
                $this->pdf->AliasNbPages();
                $this->pdf->SetTitle("Lista de clientes");

                $this->pdf->SetLeftMargin(15);
                $this->pdf->SetRightMargin(15);
                $this->pdf->SetFillColor(210,210,210); //RGB
                $this->pdf->SetFont('Arial','B',11);
                //I Italic=cursi, U underline, Bbold=negrilla, '' normal

                $this->pdf->Ln(5);
                $this->pdf->Cell(30);
                $this->pdf->Cell(120,10,'LISTA DE CLIENTES',0,0,'C',1);
                //ancho, alto, texto, borde,generacion de la sig celda
                //0=derecha, 1=siguiente linea 2= debajo
                //alineacion LCR, fill 0 1

                $this->pdf->Ln(10);
                $this->pdf->SetFont('Arial','B',7);

                $this->pdf->Cell(30);
                $this->pdf->Cell(7,5,'No.','TBLR',0,'L',1);
                $this->pdf->Cell(50,5,'NOMBRE','TBLR',0,'L',1);
                $this->pdf->Cell(31,5,'ORIMER APELLIDO','TBLR',0,'L',1);
                $this->pdf->Cell(31,5,'SEGUNDO APELLIDO','TBLR',0,'L',1);
                $this->pdf->Ln(5);

                
                $this->pdf->SetFont('Arial','',9);

                $num=1;

                foreach($lista as $row)
                {
                    $nombre=$row->nombre;
                    $primerApellido=$row->primerApellido;
                    $segundoApellido=$row->segundoApellido;

                    $this->pdf->Cell(30);
                    $this->pdf->Cell(7,5,$num,'TBLR',0,'L',0);
                    $this->pdf->Cell(50,5,$nombre,'TBLR',0,'L',0);
                    $this->pdf->Cell(31,5,$primerApellido,'TBLR',0,'L',0);
                    $this->pdf->Cell(31,5,$segundoApellido,'TBLR',0,'L',0);
                    $this->pdf->Ln(5);
                    $num++;
                }
               
                $this->pdf->Output("listaclientes.pdf","I");
                //I mostrar en navegador
                // D Forzar descarga

                
            }
            else
            {
                redirect('usuarios/index','refresh');
            }


        }
}