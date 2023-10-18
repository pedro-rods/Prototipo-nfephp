<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header" style="background-color: lightgray; color:#181E24;">
                        <h3 class="card-title">Nova consulta</h3>


                        <div class="card-tools">
                            <a href="<?php echo URL_BASE . "consulta" ?>" class="btn btn-danger"> <i class="fas fa-arrow-left"></i> Voltar</a>
                        </div>
                    </div>
                    <?php
                    $this->verErro();
                    $this->verMsg();
                    ?>
                    <form class="form" method="POST" action="<?php echo URL_BASE . "consulta/salvar" ?>">


                        <div class="p-5 pb-0 pt-4 width-100 float-left">
                            <div id="tab">

                                <div id="tab-1" class="cx-tab tab-pane active">
                                    <span class="d-block mt-4 mb-4 h4 border-bottom">Informações sobre a consulta</span>
                                    <div class="rows">

                                        <div class="col-6 mb-3">
                                            <label class="text-label">Data:</label>
                                            <input class="form-campo" type="date" name="date" id="date" value="<?php echo $date->format("Y-m-d") ?>" />
                                        </div>


                                        <div class="col-6 mb-3">
                                            <label class="text-label">Horário:</label>
                                            <input class="form-campo" type="time" name="time" id="time" value="<?php echo $date->format("H:i") ?>" />
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="text-label">Paciente:</label>
                                            <input class="form-campo" type="text" id="title" name="title" value="" />
                                        </div> </br>


                                        <div class="col-12 mb-3">
                                            <label class="text-label">Motivo da consulta:</label>
                                            <input class="form-campo" type="text" id="description" name="description" placeholder="Motivo da consulta" />
                                        </div>


                                        <input class="form-campo" type="text" id="id_consulta" name="id_consulta" hidden value="" />
                                        
                                    </div>

                                </div>
                            </div>

                            <input type="submit" value="Marcar" class="btn btn-info btn-bg d-block m-auto">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>