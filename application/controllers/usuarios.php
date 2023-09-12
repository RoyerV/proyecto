<?php

class Usuarios extends CI_Controller {

    
        public function index()
        {

            if($this->session->userdata('login'))
            {
                redirect('usuarios/panel','refresh');
            }
            else
            {

                $this->load->view('login');
            }


            
        }


        public function validarusuario()
        {
            
            $login=$_POST['login'];
            $password=md5($_POST['password']);

           $consulta=$this->usuario_model->validar($login,$password);
           
           if($consulta->num_rows()>0)
           {

                foreach($consulta->result() as $row)
                {
                    $this->session->set_userdata('idusuario',$row->idUsuario);
                    $this->session->set_userdata('login',$row->login);
                    $this->session->set_userdata('tipo',$row->tipo);
                    redirect('usuarios/panel','refresh');

                }
           }
           else
           {

                redirect('usuarios/index','refresh');
           }
        }


        public function panel()
        {
            if($this->session->userdata('login'))
            {
                redirect('cliente/indexlte','refresh');
            }
            else
            {
                redirect('usuarios/index','refresh');
            }


        }

        public function logout()
        {
            $this->session->sess_destroy();
            redirect('usuarios/panel','refresh');
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
}