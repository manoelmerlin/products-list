<?php
class ProductsController extends AppController
{

	public $components = array('RequestHandler');

	public function index()
	{
		$products = $this->Product->find('all', array(
			'group' => array('Product.name')
		));


		$this->set(compact('products'));
	}

	public function addProducts() {
		$name = $this->request->query['name'];
		$value = $this->request->query['value'];

		$salvar = '';
		$menssagem = array(
			'menssagem' => ''
		);

		$products = $this->Product->find('first', array(
			'conditions' => array(
				'Product.name' => $name
			)
		));


		if ($products) {
			$salvar = 'False';
			$menssagem['menssagem'] = 'false';
		}

		$save = array(
			'Product' => array(
				'name' => $name,
				'value' => $value,
				'quantity' => 1
			)
		);

		if ($salvar != 'False') {
			$saveToJsons = $this->Product->save($save);
			foreach ($saveToJsons as $saveToJson) {
				$salvar = $saveToJson;
				echo json_encode($salvar);
			}
		} else {
			echo json_encode($menssagem);
		}

	}

	public function deleteProduct()
	{
		$id = $this->request->query['id'];

		$mensagem = array(
			'mensagem' => ''
		);
		if ($this->Product->deleteAll(array('Product.id' => $id))) {
			$mensagem['mensagem'] = "Sucesso";
		} else {
			$mensagem['mensagem'] = "Erro";
		}

		echo json_encode($mensagem);

	}

}