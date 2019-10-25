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
				<td id="idSub"><?= $product['Product']['id']; ?></td>
				<td id="nameSub"><?= $product['Product']['name']; ?></td>
				<td id = "valueSub"><?= $product['Product']['value']; ?></td>
				<td id="quantitySub"><?= $product['Product']['quantity']; ?></td>
				<td><?= $product['Product']['created']; ?></td>
				<td>
				<button onclick="showEditId(<?= $product['Product']['id']; ?>)"  type="button" class="" data-toggle="modal" data-target="#modalExemplo">
					<i class="fas fa-edit"></i>
				</button>

				<!-- Modal -->
				<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Título do modal</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<?= $this->Form->input('name', array('id' => 'editName')); ?>
						<?= $this->Form->input('value', array('id' => 'editValue')); ?>
						<?= $this->Form->input('quantity', array('type' => 'number', 'id' => 'editQuantity')); ?>

						<button id='submitEdit'>
								Editar
						</button>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
					</div>
					</div>
				</div>
				</div>
					<button onclick="showId(<?= $product['Product']['id']; ?>)">
						<i alt="excluir" class="fas fa-trash-alt"></i>
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

</script>


<script>

	function showEditId(id) {





		const urlRecuperar= <?= json_encode(Router::url(array(
			'controller' => 'products',
			'action' => 'recuperar',
		)))?>+'/'+id;


			$.ajax({
				type: 'GET',
				url: urlRecuperar,
				dataType: 'json',
				success: dados => {
					$('#editName').val(dados.name)
					$('#editValue').val(dados.value)
					$('#editQuantity').val(dados.quantity)

				}
			})

			$('#submitEdit').on('click', () => {

			const urlEdit= <?= json_encode(Router::url(array(
				'controller' => 'products',
				'action' => 'edit',
			)))?>+'/'+id;


				var name = $('#editName').val();
				var value = $('#editValue').val();
				var quantity = $('#editQuantity').val();

				console.log()

				$.ajax({
					type: 'GET',
					url: urlEdit,
					data: {
						'name' : name,
						'value': value,
						'quantity' : quantity
					},
					dataType: 'json',
					success: dados => {
						console.log(dados)
						$('#idSub').html(dados.id)
						$('#nameSub').html(dados.name)
						$('#quantitySub').html(dados.quantity)
						$('#valueSub').html(dados.value)
						$('#modalExemplo').modal('hide')
					}
				})

			})

	}


</script>