<!-- Main content -->
<section class="content">

	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<!-- Default box -->
				<div class="card">
					<div class="card-header" style="background-color: lightgray; color:#181E24;">
						<h3 class="card-title">Formulário dos Tributação</h3>


						<div class="card-tools">
							<a href="<?php echo URL_BASE . "tributacao" ?>" class="btn btn-danger"> <i class="fas fa-arrow-left"></i> Voltar</a>
						</div>
					</div>
					<?php
					$this->verErro();
					$this->verMsg();
					?>
				<form action="<?php echo URL_BASE ."tributacao/salvar" ?>" method="POST">
					<div class="p-5 pb-0 pt-4 mb-4 width-100 float-left">	                       	
						<div class="tab-content current py-4 px-5">
							<div class="rows p-5">
								<div class="col-12 mb-3">
									<label class="text-label">Descrição da tributação</label>	
					          <input type="text" name="tributacao" value="<?php echo isset($tributacao) ? $tributacao->tributacao : null ?>" placeholder="Digite aqui..." class="form-campo">
                              			</div>  
								<div class="col-12" style="clear:both">
									<input type="hidden" name="id_tributacao" value="<?php echo isset($tributacao)? $tributacao->id_tributacao: null?>">
									<input type="submit" class="btn btn-success m-auto px-4" value="Inserir Tributação">
								</div>		 
							</div>  					
						</div>
					</div>
				</form>
				</div>
			</div>
		</div>	
	</div>
</section>