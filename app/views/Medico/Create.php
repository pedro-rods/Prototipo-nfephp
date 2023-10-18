<!-- Main content -->
<section class="content">

	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<!-- Default box -->
				<div class="card">
					<div class="card-header" style="background-color: lightgray; color:#181E24;">
						<h3 class="card-title">Formulário dos médicos</h3>


						<div class="card-tools">
							<a href="<?php echo URL_BASE . "medico" ?>" class="btn btn-danger"> <i class="fas fa-arrow-left"></i> Voltar</a>
						</div>
					</div>
					<?php 
                   $this->verErro();
                   $this->verMsg();
                ?>
					<form class="form-group" method="post" action="">
						<div class="p-5 pb-0 pt-4 width-100 float-left">
							<div id="tab">

								<div id="tab-1" class="cx-tab tab-pane active">
									<span class="d-block mt-4 mb-4 h4 border-bottom">Informações básicas</span>
									<div class="rows">

										<div class="col-6">
											<label class="text-label">Nome</label>											
											<input type="text" name="nome" value="<?php echo isset($medico->nome) ? $medico->nome : null ?>" class="form-campo" required placeholder="Nome completo">
										</div>


										<div class="col-3 mb-3">
											<label class="text-label">CPF</label>
											<input type="text" name="cpf" value="<?php echo isset($medico->cpf) ? $medico->cpf : null ?>" class="form-campo mascara-cpf" required placeholder="Digite seu CPF">
										</div>
										<div class="col-3 mb-3">
											<label class="text-label">CRM</label>
											<input type="text" name="crm" value="<?php echo isset($medico->crm) ? $medico->crm : null ?>" class="form-campo mascara-crm" required placeholder="Ex:1234567">
										</div>


										<div class="col-3 mb-3">
											<label class="text-label">Celular:</label>
											<input type="text" name="celular" value="<?php echo isset($medico->celular) ? $medico->celular : null ?>" class="form-campo mascara-fone">
										</div>


										<div class="col-8 mb-3">
											<label class="text-label">E-mail</label>
											<input type="text" name="email" value="<?php echo isset($medico->email) ? $medico->email : null ?>" class="form-campo">
										</div>
										<div class="mb-5 mt-4 width-100 d-inline-block" style="clear:both">
											<input type="hidden" name="id_cliente" value="<?php echo isset($cliente->id_cliente) ? $cliente->id_cliente : null ?>">
											<input type="submit" value="Salvar" class="btn btn-info btn-bg d-block m-auto">
										</div>

									</div>
								</div>
					</form>

				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
</section>