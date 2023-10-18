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
                                    <td align="center" ><strong>id_venda</strong></td>
                                    <td align="center" ><strong>Nome</strong></td>
                                    <td align="center"><strong>Subtotal</strong></td>
                                    <td align="center"><strong>Ação</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach ($lista as $nota){
								if($nota->vNF > 0):
                            ?>                      
								<tr>
									<td align="center"><?php echo $nota->id_nfe  ?></td>
									<td align="center"><?php echo $nota->id_venda ?></td>
									<td align="center"><?php echo $nota->dest_xNome ?></td>
									<td align="center"><?php echo $nota->vNF ?></td>
									
									<td align="center">
									<a target="_blank" href="<?php echo URL_BASE . "nfe/gerarNfe/" .$nota->id_nfe ?>" class="d-inline-block btn btn-outline-success btn-sm"><i class="fas fa-edit"></i> Gerar NFE</a>
									<a target="_blank" href="<?php echo URL_BASE . "nfe/assinarNfe/" .$nota->id_nfe ?>" class="d-inline-block btn btn-outline-success btn-sm"><i class="fas fa-edit"></i> Assinar NFE</a>
									<a target="_blank" href="<?php echo URL_BASE . "nfe/enviarNfe/" .$nota->id_nfe ?>" class="d-inline-block btn btn-outline-success btn-sm"><i class="fas fa-edit"></i> Enviar NFE</a>
									
									<a target="_blank" href="<?php echo URL_BASE . "nfe/cancelarNfe/" .$nota->id_nfe ?>" class="d-inline-block btn btn-outline-success btn-sm"><i class="fas fa-edit"></i> Cancelar Nfe</a>
									<a target="_blank" href="<?php echo URL_BASE . "nfe/getNfe/" .$nota->id_nfe ?>" class="d-inline-block btn btn-outline-success btn-sm"><i class="fas fa-edit"></i> pegar NFE</a>
									
									<a target="_blank" href="<?php echo URL_BASE . "nfe/autorizarNfe/" .$nota->id_nfe ?>" class="d-inline-block btn btn-outline-success btn-sm"><i class="fas fa-edit"></i> Autorizar NFE</a>
									<a target="_blank" href="<?php echo URL_BASE . "nfe/danfe/" .$nota->id_nfe ?>" class="d-inline-block btn btn-outline-success btn-sm"><i class="fas fa-edit"></i> Emitir DANFE</a>
									<a target="_blank" href="<?php echo URL_BASE . "notafiscal/edit/" .$nota->id_nfe ?>" class="d-inline-block btn btn-outline-success btn-sm"><i class="fas fa-edit"></i> Editar NFE</a>
								
										</td>
								</tr>                    
							<?php endif; } ?>   				
							</tbody>
							<tfoot>
							<tr>
								 	<td align="center"><strong>Id</strong></td>
                                    <td align="center" ><strong>id_venda</strong></td>
                                    <td align="center" ><strong>Nome</strong></td>
                                    <td align="center"><strong>Subtotal</strong></td>
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