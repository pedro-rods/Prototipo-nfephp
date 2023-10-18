
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
                  <div class="container"> <a class="btn btn-primary" href="<?php echo URL_BASE . "consulta/create" ?>">Adicionar consulta</a> </div>
                  <div class="calendar"></div>

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