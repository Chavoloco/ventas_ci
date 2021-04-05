<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Productos_model");
		$this->load->model("Categorias_model");
		$this->load->model("Marcas_model");
	}

	public function index()
	{
		$data  = array(
			'productos' => $this->Productos_model->getProductos(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/productos/list",$data);
		$this->load->view("layouts/footer");

	}
	public function add(){
		$data =array( 
			"categorias" => $this->Categorias_model->getCategorias(),
			"marcas" => $this->Marcas_model->getMarcas(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/productos/add",$data);
		$this->load->view("layouts/footer");
	}

	public function store(){
		$codigo = $this->input->post("codigo");
		$nombre = $this->input->post("nombre");
		$peso = $this->input->post("peso");
		$precio_costo = $this->input->post("precio_costo");
		$precio_venta = $this->input->post("precio_venta");
		$categoria = $this->input->post("categoria");
		$marca = $this->input->post("marca");
		$stock_minimo = $this->input->post("stock_minimo");
		$stock = $this->input->post("stock");

		$this->form_validation->set_rules("codigo","Codigo","required|is_unique[productos.codigo]");
		$this->form_validation->set_rules("nombre","Nombre","required");
		$this->form_validation->set_rules("precio_costo","Precio de costo","required");
		$this->form_validation->set_rules("precio_venta","Precio de venta","required");
		$this->form_validation->set_rules("stock_minimo","Stock minimo","required");
		$this->form_validation->set_rules("stock","Stock","required");
		

		if ($this->form_validation->run()){
			
			$data  = array(
				'codigo' => $codigo, 
				'nombre' => $nombre,
				'peso' => $peso,
				'precio_costo' => $precio_costo,
				'precio_venta' => $precio_venta,
				'id_categoria' => $categoria,
				'id_marca' => $marca,
				'stock_minimo' => $stock_minimo,
				'stock' => $stock,
				'estado' => "1"
			);
			
			if ($this->Productos_model->save($data)) {
				redirect(base_url()."mantenimiento/productos");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/productos/add");
			}

		}
		else{
			$this->add();
		}

	}

	public function edit($id){
		$data =array( 
			"producto" => $this->Productos_model->getProducto($id),
			"categorias" => $this->Categorias_model->getCategorias(),
			"marcas" => $this->Marcas_model->getMarcas()
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/productos/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idproducto = $this->input->post("idproducto");
		$codigo = $this->input->post("codigo");
		$nombre = $this->input->post("nombre");
		$peso = $this->input->post("peso");
		$precio_costo = $this->input->post("precio_costo");
		$precio_venta = $this->input->post("precio_venta");
		$id_categoria = $this->input->post("categoria");
		$id_marca = $this->input->post("marca");
		$stock_minimo = $this->input->post("stock_minimo");
		// $stock = $this->input->post("stock");

		$productoActual = $this->Productos_model->getProducto($idproducto);

		if ($codigo == $productoActual->codigo){
			$is_unique = '';
		}
		else{
			$is_unique ='|is_unique[productos.codigo]';
		}

		$this->form_validation->set_rules("codigo","Codigo","required".$is_unique);
		$this->form_validation->set_rules("nombre","Nombre","required");
		$this->form_validation->set_rules("precio_costo","Precio de costo","required");
		$this->form_validation->set_rules("precio_venta","Precio de venta","required");
		$this->form_validation->set_rules("stock_minimo","Stock minimo","required");
		$this->form_validation->set_rules("stock","Stock","required");

		if($this->run()){
			
			$data  = array(
				'codigo' => $codigo, 
				'nombre' => $nombre,
				'peso' => $peso,
				'precio_costo' => $precio_costo,
				'precio_venta' => $precio_venta,
				'id_categoria' => $id_categoria,
				'id_marca' => $id_marca,
				'stock_minimo' => $stock_minimo,
				// 'stock' => $stock,
			);
			if ($this->Productos_model->update($idproducto,$data)) {
				redirect(base_url()."mantenimiento/productos");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/productos/edit/".$idproducto);
			}
		}

		}else{
			$this->edit($idproducto);
		}
		
	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Productos_model->update($id,$data);
		echo "mantenimiento/productos";
	}
// hola que haces
}