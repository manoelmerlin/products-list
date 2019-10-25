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

	public function edit($id) {

		echo $id;
		die;

		$name = $this->request->query['name'];
		$value = $this->request->query['value'];
		$quant = $this->request->query['quantity'];

		$saveToJson = '';

		$save = array(
			'Product' => array(
				'id' => $id,
				'name' => $name,
				'value' => $value,
				'quantity' => $quant
			)
		);

		if ($this->Product->save($save)) {
			foreach ($save as $s) {
				$s['mensagem'] = 'Sucesso';
				$saveToJson = $s;
			}
			echo json_encode($saveToJson);
		}
	}

	public function recuperar($id) {

		$buscarEdit = $this->Product->find('first', array(
			'conditions' => array(
				'id' => $id
			)
		));

		$retornoItens = '';

		foreach($buscarEdit as $b) {
			$retornoItens = $b;
		}

		echo json_encode($retornoItens);

	}

}