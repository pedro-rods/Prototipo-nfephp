  <!-- Main content -->
  <section class="content">

  	<div class="container-fluid">
  		<div class="row">
  			<div class="col-12">
  				<!-- Default box -->
  				<div class="card">
  					<div class="card-header" style="background-color: lightgray; color:#181E24;">
  						<h3 class="card-title">Tabela de clientes</h3>
  						<div class="card-tools">
  							<a class="btn btn-success" href="<?php echo URL_BASE."venda/create" ?>" ><i class="fas fa-plus"></i> Adicionar venda</a>
  						</div>
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
  											<td align="center"><strong>Id-venda</strong></td>
  											<td align="center"><strong>Id-cliente</strong></td>
  											<td align="left"><strong>Cliente</strong></td>
  											<td align="center"><strong>Data</strong></td>
  											<td align="center"><strong>Hora</strong></td>
  											<td align="center"><strong>Total</strong></td>
  											<td align="center"><strong>Ação</strong></td>
  										</tr>
  									</thead>
  									<tbody>
  										<?php foreach ($vendas as $venda) : ?>
  											<tr>
  												<td align="center"><?php echo $venda->id_venda ?></td>
  												<td align="center"><?php echo $venda->id_cliente ?></td>
  												<td align="left"><?php echo $venda->nome ?></td>
  												<td align="center"><?php echo databr($venda->data_venda) ?></td>
  												<td align="center"><?php echo $venda->hora_venda ?></td>
  												<td align="center"><?php echo $venda->total ?></td>
  												<td align="center">
  													<?php if ($venda->finalizada == 'S') : ?>
  														<a href="<?php echo URL_BASE . "notafiscal/salvarNota/" . $venda->id_venda ?>" class="d-inline-block btn btn-outline-success btn-sm"><i class="fas fa-edit"></i> Emitir Nota</a>
  													<?php else : ?>
  														<a href="<?php echo URL_BASE . "venda/edit/" . $venda->id_venda ?>" class="d-inline-block btn btn-outline-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
  													<?php endif; ?>

  													<a href="#" class="d-inline-block btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i> Excluir</a>
  												</td>
  											</tr>
  										<?php endforeach; ?>
  									</tbody>
  									<tfoot>
  										<tr>
  											<td align="center"><strong>Id-venda</strong></td>
  											<td align="center"><strong>Id-cliente</strong></td>
  											<td align="left"><strong>Cliente</strong></td>
  											<td align="center"><strong>Data</strong></td>
  											<td align="center"><strong>Hora</strong></td>
  											<td align="center"><strong>Total</strong></td>
  											<td align="center"><strong>Ação</strong></td>
  										</tr>
  									</tfoot>
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