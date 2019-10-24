<script src="https://kit.fontawesome.com/1580feb638.js"></script>

	<div>
		<?php echo $this->Form->input('name', array('id' => 'name')); ?>
	</div>

	<div>
		<?php echo $this->Form->input('value', array('id' => 'value')); ?>
	</div>

	<button id="form-prod">
		Cadastrar produtos
	</button>

<table id="table" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Produto</th>
	  <th>Value</th>
	  <th>Quantidade</th>
	  <th>Created</th>
	  <th>Ações</th>
    </tr>
  </thead>
  <tbody id="body">
			<?php foreach($products as $product): ?>
			<tr id="<?= $product['Product']['id']; ?>">
				<td><?= $product['Product']['id']; ?></td>
				<td><?= $product['Product']['name']; ?></td>
				<td><?= $product['Product']['value']; ?></td>
				<td id="quantity<?= $product['Product']['id']; ?>"><?= $product['Product']['quantity']; ?></td>
				<td><?= $product['Product']['created']; ?></td>
				<td>
					<button onclick="showId(<?= $product['Product']['id']; ?>)">
						<i alt="excluir" class="fas fa-trash-alt"></i>
					</button>
					<button onclick="showEditId(<?= $product['Product']['id']; ?>)">
						<i class="fas fa-edit"></i>
					</button>
				</td>
			</tr>
	<?php endforeach; ?>

	</tbody>
</table>

<script>


	$(document).ready(() => {
		$("#form-prod").on('click', () => {
			var name = $('#name').val()
			var value = $('#value').val()


			const urlx = <?= json_encode(Router::url(array(
			'controller' => 'products',
			'action' => 'addProducts',
			))) ?>;

			$.ajax({
				type: 'GET',
				url: urlx,
				data: {
					'name': name,
					'value' : value
				},
				dataType: 'json',
				success: dados => {

					if (dados.menssagem == "false") {
						alert('Já existe este produto')
					} else {
						$('<tr id='+dados.id+'>').appendTo('#body').append('<td>' + dados.id + '<td>' + dados.name + '<td>' + dados.value + '<td>' + dados.quantity + '<td>' + dados.created + '<td>'+'<button onclick=showId('+dados.id+')><i alt="excluir" class="fas fa-trash-alt"')
					}

				}

			})

		})

	})


</script>


<script>


	function showId(id) {


		const urlA = <?= json_encode(Router::url(array(
			'controller' => 'products',
			'action' => 'deleteproduct',
		))) ?>;



		$.ajax({
			type: 'GET',
			url: urlA,
			data: "id="+id,
			dataType: 'json',
			success: dados => {
				if (dados.mensagem == "Sucesso") {
					$('#'+id).remove()
				}
			}
		})

	}

	function abc(id) {
		console.log(id + ' abc')
	}

</script>


<script>

	function showEditId(id) {
	console.log(id)
	$('#quantity'+id).html('<input id="quant"  placeholder="Insira a quantidade"> ')

	}

	$('#quant').click(function (event) {
		if(event.target.id != 'text2'){
			$('#quant').hide();
		}
	});


</script>