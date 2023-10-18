<!-- Main content -->
<section class="content">

	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<!-- Default box -->
				<div class="card">
					<div class="card-header" style="background-color: lightgray; color:#181E24;">
						<h3 class="card-title">Formulário dos clientes</h3>


						<div class="card-tools">
							<a href="<?php echo URL_BASE . "venda" ?>" class="btn btn-danger"> <i class="fas fa-arrow-left"></i> Voltar</a>
						</div>
					</div>
					<?php
					$this->verErro();
					$this->verMsg();
					?>
					<form action="<?php echo URL_BASE . "venda/salvar" ?>" method="POST">

						<div class="rows p-4">
							<div class="col-6 mb-3 position-relative">
								<label class="text-label">Cliente</label>
								<select class="form-campo" name="id_cliente">
									<?php foreach ($clientes as $cliente) : ?>
										<option value="<?php echo $cliente->id_cliente ?>"><?php echo $cliente->nome ?></option>
									<?php endforeach; ?>

								</select>
							</div>

							<div class="col-2 mb-3">
								<label class="text-label">Data</label>
								<input type="date" name="data_venda" value="<?php echo hoje() ?>" class="form-campo">
							</div>
							<div class="col-2 mb-3">
								<label class="text-label">Hora</label>
								<input type="time" name="hora_venda" value="<?php echo agora() ?>" class="form-campo">
							</div>



							<div class="col-2 mt-4  mt-sm-4">
								<input type="submit" value="Inserir" id="btnInserirProduto" class="btn btn-info width-100">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	</div>
</section>