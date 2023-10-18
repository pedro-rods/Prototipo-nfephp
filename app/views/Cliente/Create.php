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
							<a href="<?php echo URL_BASE . "cliente" ?>" class="btn btn-danger"> <i class="fas fa-arrow-left"></i> Voltar</a>
						</div>
					</div>
					<?php
					$this->verErro();
					$this->verMsg();
					?>
					<form action="<?php echo URL_BASE . "cliente/salvar" ?>" method="POST">
						<div class="p-5 pb-0 pt-4 width-100 float-left">
							<div id="tab">

								<div id="tab-1" class="cx-tab tab-pane active">
									<span class="d-block mt-4 mb-4 h4 border-bottom">Informações básicas</span>
									<div class="rows pb-4">

										<div class="col-6 mb-3">
											<label class="text-label">Nome</label>
											<input type="text" name="nome" value="<?php echo isset($cliente->nome) ? $cliente->nome : null ?>" class="form-campo" required placeholder="Nome Completo">
										</div>
										<div class="col-6 mb-3">
											<label class="text-label">Nome Fantasia</label>
											<input type="text" name="nome_fantasia" value="<?php echo isset($cliente->nome_fantasia) ? $cliente->nome_fantasia : null ?>" class="form-campo" placeholder="Apenas para empresas">
										</div>

										<div class="col-3 mb-3">
											<label class="text-label">CPF</label>
											<input type="text" name="cpf" value="<?php echo isset($cliente->cpf) ? $cliente->cpf : null ?>" class="form-campo mascara-cpf" required>
										</div>


										<div class="col-3 mb-3">
											<label class="text-label">CNPJ</label>
											<input type="text" name="cnpj" value="<?php echo isset($cliente->cnpj) ? $cliente->cnpj : null ?>" class="form-campo mascara-cnpj" placeholder="Apenas para empresas">
										</div>
										<div class="col-3 mb-3">
											<label class="text-label">Fone:</label>
											<input type="text" name="fone" value="<?php echo isset($cliente->fone) ? $cliente->fone : null ?>" class="form-campo mascara-fone">
										</div>
										<div class="col-3 mb-3">
											<label class="text-label">Celular:</label>
											<input type="text" name="celular" value="<?php echo isset($cliente->celular) ? $cliente->celular : null ?>" class="form-campo mascara-fone">
										</div>


										<div class="col-8 mb-3">
											<label class="text-label">E-mail</label>
											<input type="text" name="email" value="<?php echo isset($cliente->email) ? $cliente->email : null ?>" class="form-campo">
										</div>


									</div>
								</div>

								<div id="tab-2" class="cx-tab tab-pane">
									<span class="d-block mt-4 h4 border-bottom">Endereço</span>
									<div class="rows pb-4">
										<div class="col-2 mb-3">
											<label class="text-label">Cep</label>
											<input type="text" name="cep" value="<?php echo isset($cliente->cep) ? $cliente->cep : null ?>" placeholder="Digite aqui..." class="form-campo busca_cep" required>
										</div>

										<div class="col-4 mb-3">
											<label class="text-label">Logradouro</label>
											<input type="text" name="logradouro" value="<?php echo isset($cliente->logradouro) ? $cliente->logradouro : null ?>" placeholder="Digite aqui..." class="form-campo rua">
										</div>
										<div class="col-2 mb-4">
											<label class="text-label">Numero</label>
											<input type="text" name="numero" value="<?php echo isset($cliente->numero) ? $cliente->numero : null ?>" placeholder="Digite aqui..." class="form-campo">
										</div>
										<div class="col-4 mb-3">
											<label class="text-label">Bairro</label>
											<input type="text" name="bairro" value="<?php echo isset($cliente->bairro) ? $cliente->bairro : null ?>" placeholder="Digite aqui..." class="form-campo bairro">
										</div>
										<div class="col-4 mb-3">
											<label class="text-label">Complemento</label>
											<input type="text" name="complemento" value="<?php echo isset($cliente->complemento) ? $cliente->complemento : null ?>" placeholder="Digite aqui..." class="form-campo">
										</div>


										<div class="col-2 mb-2">
											<label class="text-label">UF</label>
											<input type="text" name="uf" value="<?php echo isset($cliente->uf) ? $cliente->uf : null ?>" class="form-campo estado">
										</div>

										<div class="col-4 mb-3">
											<label class="text-label">Cidade</label>
											<input type="text" name="cidade" value="<?php echo isset($cliente->cidade) ? $cliente->cidade : null ?>" placeholder="Digite aqui..." class="form-campo cidade">
										</div>
										<div class="col-2 mb-3">
											<label class="text-label">Ibge</label>
											<input type="text" name="ibge" value="<?php echo isset($cliente->ibge) ? $cliente->ibge : null ?>" id="rg" class="form-campo ibge mascara-cep">
										</div>
									</div>
								</div>

								<div id="tab-3" class="cx-tab tab-pane">
									<span class="d-block mt-4 h4 border-bottom">Informações Adicionais</span>
									<div class="rows pb-4">
										<div class="col-4 mb-3">
											<label class="text-label">Insc. Estadual</label>
											<input type="text" name="ie" value="<?php echo isset($cliente->ie) ? $cliente->ie : null ?>" class="form-campo">
										</div>
										<div class="col-4 mb-3">
											<label class="text-label">Insc. Municipal</label>
											<input type="text" name="im" value="<?php echo isset($cliente->im) ? $cliente->im : null ?>" class="form-campo">
										</div>


										<div class="col-4 mb-3">
											<label class="text-label">RG</label>
											<input type="text" name="rg" value="<?php echo isset($cliente->rg) ? $cliente->rg : null ?>" class="form-campo mascara-rg">
										</div>
										<div class="col-4 mb-3">
											<label class="text-label">Cód. Estrangeiro</label>
											<input type="text" name="idEstrangeiro" value="<?php echo isset($cliente->idEstrangeiro) ? $cliente->idEstrangeiro : null ?>" class="form-campo">
										</div>
										<div class="col-4 mb-3">
											<label class="text-label">IE Subst. Trib.</label>
											<select name="indIEDest" class="form-campo">
												<option value="0">Selecione </option>
												<option value="1">1 - Contribuinte do ICMS</option>
												<option value="2">2- Contribuinte Isento</option>
												<option value="9">3 - Não Contribuinte</option>
											</select>
										</div>

									</div>
								</div>
							</div>
							<!--Botao-->
							<div class="mb-5 mt-4 width-100 d-inline-block" style="clear:both">
								<input type="hidden" name="id_cliente" value="<?php echo isset($cliente->id_cliente) ? $cliente->id_cliente : null ?>">
								<input type="submit" value="Salvar" class="btn btn-info btn-bg d-block m-auto">
							</div>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>