<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class producto_model extends CI_Model{
    public function listaproducto()
    
    {
        $this->db->select('*');
        $this->db->from('productos');
        return $this->db->get();
    }

    public function inscribircliente($idProducto,$data)
    {
        $this->db->trans_start(); //iniciamos la transaccion

        $this->db->insert('clientes',$data);   //insertamos clientes
        $idcliente=$this->db->insert_id();     //recupera ultimo id insert

        $data2['idProducto']=$idProducto;    //creamos data2
        $data2['idcliente']=$idcliente;        //creamos data 2
        $this->db->insert('inscripcion',$data2);   //registrar inscripcion

        $this->db->trans_complete(); //finalizamos la transaccion
        
        if($this->db->trans_status()===FALSE )
        {
            return false;
        }

    }

   
    

}