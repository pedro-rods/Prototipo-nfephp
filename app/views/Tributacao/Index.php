  <!-- Main content -->
  <section class="content">

  	<div class="container-fluid">
  		<div class="row">
  			<div class="col-12">
  				<!-- Default box -->
  				<div class="card">
  					<div class="card-header" style="background-color: lightgray; color:#181E24;">
  						<h3 class="card-title">Tabela de Tributação</h3>
						  <div class="card-tools">
  							<a class="btn btn-success" href="<?php echo URL_BASE."tributacao/create" ?>" ><i class="fas fa-plus"></i> Adicionar</a>
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
                                    <td align="center"><strong>Id</strong></td>
                                    <td align="center"><strong>Tributação</strong></td>
                                    <td align="center"><strong>Ação</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach ($lista as $t){
                            ?>                      
								<tr>
									<td align="center"><?php echo $t->id_tributacao ?></td>
									<td align="center"><?php echo $t->tributacao ?></td>
									<td align="center">
										<a href="<?php echo URL_BASE . "tributacao/tributos/" .$t->id_tributacao ?>" class="d-inline-block btn btn-outline-verde btn-pequeno"><i class="fas fa-edit"></i> Tributos</a>
										<a href="<?php echo URL_BASE . "tributacao/edit/" .$t->id_tributacao ?>" class="d-inline-block btn btn-outline-verde btn-pequeno"><i class="fas fa-edit"></i> Editar</a>
										<a href="<?php echo URL_BASE . "tributacao/excluir/" .$t->id_tributacao ?>" class="d-inline-block btn btn-outline-vermelho btn-pequeno"><i class="fas fa-trash-alt"></i> Excluir</a>
									</td>
								</tr>                    
							<?php } ?>	           
								     					
							</tbody>
							<tfoot>
								<tr>
                                    <td align="center"><strong>Id</strong></td>
                                    <td align="center"><strong>Tributação</strong></td>
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