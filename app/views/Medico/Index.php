<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <div class="card">
          <div class="card-header" style="background-color: lightgray; color:#181E24;">
            <h3 class="card-title">Tabela de médicos</h3>


          </div>
          <div class="card-body">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total de médicos cadastrados:</span>
                <span class="info-box-number"><?php echo $total ?></span>
              </div>
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
                      <td align="center"><strong>Nome</strong></td>
                      <td align="center"><strong>Telefone</strong></td>
                      <td align="center"><strong>Data</strong></td>
                      <td align="center" colspan="2"><strong>AÇÕES</strong></td>

                    </tr>
                  </thead>

                  <?php
                  foreach ($lista as $item) :
                  ?>
                    <tbody>
                      <tr>
                        <td align="center"><?php echo $item->id_medico; ?></td>
                        <td align="center"><?php echo $item->nome; ?></td>
                        <td align="center"><?php echo $item->telefone; ?></td>
                        <td align="center"><?php echo $item->horario; ?></td>
                        <td align="center">
                          <a href="<?php echo URL_BASE . "medico/edit/" . $item->id_medico; ?>" class="d-inline-block btn btn-outline-success btn-sm"><i class="fas fa-edit"></i>Editar</a>
                        </td>
                        <td align="center">
                          <a href="<?php echo URL_BASE . "medicos/excluir/" . $item->id_medico; ?>" class="d-inline-block btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i>Excluir</a>
                        </td>

                      </tr>
                    </tbody>
                  <?php endforeach; ?>
                  <tfoot>
                    <tr>
                      <td align="center"><strong>NOME</strong></td>
                      <td align="center"><strong>CRM</strong></td>
                      <td align="center"><strong>TEL</strong></td>
                      <td align="center"><strong>DATA</strong></td>
                      <td align="center" colspan="2"><strong>AÇÕES</strong></td>

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