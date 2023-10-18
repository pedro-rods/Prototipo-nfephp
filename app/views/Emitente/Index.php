  <!-- Main content -->
  <section class="content">

  	<div class="container-fluid">
  		<div class="row">
  			<div class="col-12">
  				<!-- Default box -->
  				<div class="card">
  					<div class="card-header" style="background-color: lightgray; color:#181E24;">
  						<h3 class="card-title">Tabela de Empresas</h3>

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
                                    <td align="center" ><strong>Empresa</strong></td>
                                    <td align="center" ><strong>Nome Fantasia</strong></td>
                                    <td align="center"><strong>CNPJ</strong></td>
                                    <td align="center"><strong>Ação</strong></td>
                               </tr>
                            </thead>
                            <tbody>
                                <?php foreach($lista as $emitente){ ?>              
								<tr>
									<td align="center"><?php echo $emitente->id_emitente ?></td>
									<td align="center"><?php echo $emitente->razao_social ?></td>
									<td align="center"><?php echo $emitente->nome_fantasia ?></td>
									<td align="center"><?php echo $emitente->cnpj ?></td>
									<td align="center">
										<a href="<?php echo URL_BASE ."emitente/edit/".$emitente->id_emitente; ?>" class="d-inline-block btn btn-outline-success btn-sm"><i class="fas fa-edit"></i> Editar</a>
										<a href="<?php echo URL_BASE ."emitente/excluir/".$emitente->id_emitente; ?>" class="d-inline-block btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i> Excluir</a>
									</td>
								</tr>           
								<?php }; ?>               
								     					
							</tbody>
							 <tfoot>
                                <tr>
                                    <td align="center"><strong>Id</strong></td>
                                    <td align="center" ><strong>Empresa</strong></td>
                                    <td align="center" ><strong>Nome Fantasia</strong></td>
                                    <td align="center"><strong>CNPJ</strong></td>
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