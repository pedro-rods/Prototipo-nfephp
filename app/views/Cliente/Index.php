  <!-- Main content -->
  <section class="content">

  	<div class="container-fluid">
  		<div class="row">
  			<div class="col-12">
  				<!-- Default box -->
  				<div class="card">
  					<div class="card-header" style="background-color: lightgray; color:#181E24;">
  						<h3 class="card-title">Tabela de clientes</h3>

  					</div>
  					
  					<div class="container-fluid">
  						<div class="card">
					<?php 
                   $this->verErro();
                   $this->verMsg();
                ?>
  							<div class="card-body">
  								<table class="table table-hover">
  									<thead>
  										<tr>
  											<td align="center"><strong>Id</strong></td>
  											<td align="center"><strong>Nome</strong></td>
  											<td align="center"><strong>Email</strong></td>
  											<td align="center"><strong>CPF</strong></td>
  											<td align="center"><strong>Ação</strong></td>
  										</tr>
  									</thead>
  									<tbody>
  										<?php foreach ($lista as $cliente) { ?>
  											<tr>
  												<td align="center"><?php echo $cliente->id_cliente ?></td>
  												<td align="center"><?php echo $cliente->nome ?></td>
  												<td align="center"><?php echo $cliente->email ?></td>
  												<td align="center"><?php echo $cliente->cpf ?></td>
  												<td align="center">
  													<a href="<?php echo URL_BASE . "cliente/edit/" . $cliente->id_cliente; ?>" class="d-inline-block btn btn-outline-success btn-sm"><i class="fas fa-edit"></i> Editar</a>
  													<a href="<?php echo URL_BASE . "cliente/excluir/" . $cliente->id_cliente; ?>" class="d-inline-block btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i>Excluir</a>
  												</td>
  											</tr>
  										<?php }; ?>


  									</tbody>
  									<trfoot>
  										<tr>
  											<td align="center"><strong>Id</strong></td>
  											<td align="center"><strong>Empresa</strong></td>
  											<td align="center"><strong>Email</strong></td>
  											<td align="center"><strong>CPF</strong></td>
  											<td align="center"><strong>Ação</strong></td>
  										</tr>
  									</trfoot>
  								</table>
  							</div>
  							<!-- /.card-body -->
  							<div class="card-footer">

  							</div>
  							<!-- /.card-footer-->
  						</div>
  						<!-- /.card -->
  					</div>
  				</div>
  			</div>
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->