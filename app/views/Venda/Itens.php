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
						<div class="rows">
							<div class="col-6 position-relative border-right">
								<div class="p-1 pb-2">
									<label class="text-label"><i class="fas fa-user"></i> Cliente</label>
									<span class="d-block text-branco h5 mb-0"><?php echo $venda->nome ?></span>								  
								</div>
							</div>
														
							<div class="col-2 border-right">
								<label class="text-label"><i class="fas fa-calendar-alt"></i> Data</label>
								<span class="d-block text-branco h5 mb-0"><?php echo databr($venda->data_venda) ?></span>
							</div>	
							<div class="col-2 border-right">
								<label class="text-label"><i class="fas fa-clock"></i> Hora</label>
								<span class="d-block text-branco h5 mb-0"><?php echo $venda->hora_venda ?></span>
							</div>
							<div class="col-2">
								<label class="text-label"><i class="fas fa-dollar-sign"></i> Total</label>
								<span class="d-block text-branco h5 mb-0">R$<?php echo $venda->total ?>,00</span>
							</div>							
							                                                                                                                    
						</div>
				</div>


				<form action="<?php echo URL_BASE."itemvenda/salvar" ?>" method="POST" >
					<div class="caixa bg-cinza">
						<div class="rows p-4">
							<div class="col-6 mb-3 position-relative">
									 <label class="text-label">Nome do Produto</label>
									 <select id="id_produto" name="id_produto"  class="form-campo" onchange="buscarProduto()">
									 	<option>Selecione um produto</option>
									 	<?php foreach($produtos as $produto){
									 		 echo "<option value='$produto->id_produto'>$produto->produto</option>";
									 	 }; ?>
									 </select>
							</div>
														
							<div class="col-2 mb-3">
									 <label class="text-label">Preço</label>
									 <input type="text" name="valor" id="valor"   class="form-campo">
							</div>	
							<div class="col-2 mb-3">
									 <label class="text-label">Qtde</label>
									 <input type="text" name="qtde" id="qtde"  class="form-campo">
							</div>
							<div class="col-2 mt-4  mt-sm-4">
								<?php echo "<input type='hidden'  id='id_venda' name='id_venda' value='$venda->id_venda'>"?>                              
                                <input type="submit" value="Inserir" class="btn btn-success width-100">
							</div>                                                                                                                    
						</div>
					</div>		
				</form>			

					
						<table class="table table-hover" >
						<thead>
							   <tr>
                                        
                                        <th align="left">Id_prod</th>
                                        <th align="left">Produto</th>
                                        <th align="center">Preço</th>
                                        <th align="center">Quantidade</th>							
                                        <th align="center">Subtotal</th>
                                        <th align="center">Excluir</th>
                                  </tr>
						</thead>
						<tbody id="lista_itens">
                               <?php 
							 	$contador = 0;  
							   foreach($itens as $item): ?>
                                <tr>
                                    <td align="left"><?php echo $item->id_item_venda ?></td>
                                    <td align="left"><?php echo $item->produto ?></td>
                                    <td align="center"><?php echo $item->valor ?></td>
                                    <td align="center"><?php echo $item->qtde ?></td>							
                                    <td align="center"><?php echo $item->subtotal ?></td>
                                    <td align="center"><a href="javascript:;" onclick="return excluir(this)" data-entidade ="itemvenda" data-id="<?php echo $item->id_item_venda ?>" class="fas fa-trash-alt text-vermelho"> Excluir</a> </td>
                                </tr>
                               <?php  
								$contador++; 
								endforeach;  ?>
                              
                       </tbody>
						</table>
						
						<footer class="caixa-rodape text-right"> 
							<?php if ($contador > 0): ?>
								<a href="<?php echo URL_BASE."venda/excluirItens/".$item->id_venda ?>" onclick="" class="btn btn-warning d-inline-block"><i class="fas fa-broom"></i> Excluir Itens</a>
								<a href="<?php echo URL_BASE."venda/excluir/".$item->id_venda ?>" onclick="" class="btn btn-danger d-inline-block"><i class="fas fa-trash"></i> Excluir Venda</a>
								<a href="<?php echo URL_BASE."venda/finalizar/".$item->id_venda ?>" class="btn btn-success d-inline-block"><i class="fas fa-check"></i> Finalizar Venda</a>
							<?php endif;?>
							</footer>
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

