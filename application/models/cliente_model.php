<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class cliente_model extends CI_Model{
    public function listaclientes()
    
    {
        $this->db->select('*');
        $this->db->from('clientes');
        $this->db->where('habilitado','1');
        return $this->db->get();
    }

    public function listaclientesdes()
    
    {
        $this->db->select('*');
        $this->db->from('clientes');
        $this->db->where('habilitado','0');
        return $this->db->get();
    }

    public function agregarcliente($data)
    {
        $this->db->insert('clientes',$data);
    }

    public function eliminarcliente($idcliente)
    {
        $this->db->where('idCliente',$idcliente);
        $this->db->delete('clientes');
    }

    public function recuperarcliente($idcliente)
    {
        $this->db->select('*');
        $this->db->from('clientes');
        $this->db->where('idCliente',$idcliente);
        return $this->db->get(); 
    }

    public function modificarcliente($idcliente,$data)
    {
        $this->db->where('idCliente',$idcliente);
        $this->db->update('clientes',$data); 
    }

    

}