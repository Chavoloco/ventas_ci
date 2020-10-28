<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Proveedores_model");
	}

	public function index()
	{
		$data  = array(
			'proveedores' => $this->Proveedores_model->getProveedores(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/proveedores/list",$data);
		$this->load->view("layouts/footer");

	}
	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/proveedores/add");
		$this->load->view("layouts/footer");
	}

	public function store(){
		$nombre = $this->input->post("nombre");
		$razon_social = $this->input->post("razon_social");
		$cuit = $this->input->post("cuit");
		$telefono = $this->input->post("telefono");
		$email = $this->input->post("email");
		

		$data  = array(
			'nombre' => $nombre,
			'razon_social' => $razon_social,
			'cuit' => $cuit,
			'telefono' => $telefono,
			'email' => $email,
			'estado' => "1"
		);

		if ($this->Proveedores_model->save($data)) {
			redirect(base_url()."mantenimiento/proveedores");
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."mantenimiento/proveedores/add");
		}
	}

	public function edit($id){
		$data =array( 
			"proveedor" => $this->Proveedores_model->getProveedor($id),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/proveedores/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idproveedor = $this->input->post("idproveedor");
		$nombre = $this->input->post("nombre");
		$razon_social = $this->input->post("razon_social");
		$cuit = $this->input->post("cuit");
		$telefono = $this->input->post("telefono");
		$email = $this->input->post("email");
		$data  = array(
            'nombre' => $nombre,
			'razon_social' => $razon_social,
			'cuit' => $cuit,
			'telefono' => $telefono,
			'email' => $email,
		);
		if ($this->Proveedores_model->update($idproveedor,$data)) {
			redirect(base_url()."mantenimiento/proveedores");
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."mantenimiento/proveedores/edit/".$idproveedor);
		}
	}
	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Proveedores_model->update($id,$data);
		echo "mantenimiento/proveedores";
	}

}