<!-- Main content -->
<section class="content">

        <div class="container-fluid">
                <div class="row">
                        <div class="col-12">
                                <!-- Default box -->
                                <div class="card">
                                        <div class="card-header" style="background-color: lightgray; color:#181E24;">
                                                <h3 class="card-title">Formulário dos emitentes</h3>


                                                <div class="card-tools">
                                                        <a href="<?php echo URL_BASE . "emitente" ?>" class="btn btn-danger"> <i class="fas fa-arrow-left"></i> Voltar</a>
                                                </div>
                                        </div>
                                        <?php
                                        $this->verErro();
                                        $this->verMsg();
                                        ?>
                                        <form action="<?php echo URL_BASE . "emitente/salvar" ?>" method="POST">
                                                <div class="p-5 pb-0 pt-4 width-100 float-left">
                                                        <div id="tab">

                                                                <div id="tab-1" class="cx-tab tab-pane active">
                                                                        <span class="d-block mt-4 mb-4 h4 border-bottom">Informações Emitente</span>
                                                                        <div class="rows pb-4">


                                                                                <div class="col-6 mb-3">
                                                                                        <label class="text-label"><b class="text-vermelho">*</b> Razão Social</label>
                                                                                        <input type="text" name="razao_social" value="<?php echo isset($emitente->razao_social) ? $emitente->razao_social : null ?>" class="form-campo">
                                                                                </div>
                                                                                <div class="col-6 mb-3">
                                                                                        <label class="text-label">Nome Fantasia</label>
                                                                                        <input type="text" name="nome_fantasia" value="<?php echo isset($emitente->nome_fantasia) ? $emitente->nome_fantasia : null ?>" class="form-campo">
                                                                                </div>

                                                                                <div class="col-4 mb-3">
                                                                                        <label class="text-label">CNPJ</label>
                                                                                        <input type="text" name="cnpj" id="cnpj" value="<?php echo isset($emitente->cnpj) ? $emitente->cnpj : null ?>" class="form-campo mascara-cnpj">
                                                                                </div>

                                                                                <div class="col-4 mb-3">
                                                                                        <label class="text-label"><b class="text-vermelho">*</b> Insc. Estadual</label>
                                                                                        <input type="text" name="ie" value="<?php echo isset($emitente->ie) ? $emitente->ie : null ?>" placeholder="Digite aqui..." class="form-campo">
                                                                                </div>
                                                                                <div class="col-4 mb-3">
                                                                                        <label class="text-label">Insc. Municipal</label>
                                                                                        <input type="text" name="im" value="<?php echo isset($emitente->im) ? $emitente->im : null ?>" placeholder="Digite aqui..." class="form-campo">
                                                                                </div>


                                                                                <div class="col-2 mb-3">
                                                                                        <label class="text-label">Fone:</label>
                                                                                        <input type="text" name="fone" value="<?php echo isset($emitente->fone) ? $emitente->fone : null ?>" placeholder="Digite aqui..." class="form-campo mascara-fone">
                                                                                </div>
                                                                                <div class="col-2 mb-3">
                                                                                        <label class="text-label">Celular:</label>
                                                                                        <input type="text" name="celular" value="<?php echo isset($emitente->celular) ? $emitente->celular : null ?>" placeholder="Digite aqui..." class="form-campo mascara-fone">
                                                                                </div>

                                                                                <div class="col-4 mb-3">
                                                                                        <label class="text-label">E-mail</label>
                                                                                        <input type="email" name="email" value="<?php echo isset($emitente->email) ? $emitente->email : null ?>" placeholder="Digite aqui..." class="form-campo">
                                                                                </div>

                                                                                <div class="col-4 mb-3">
                                                                                        <label class="text-label">E-mail Contabilidade</label>
                                                                                        <input type="email" name="email_contabilidade" value="<?php echo isset($emitente->email_contabilidade) ? $emitente->email_contabilidade : null ?>" placeholder="Digite aqui..." class="form-campo">
                                                                                </div>


                                                                        </div>

                                                                        <span class="d-block mt-4 h4 border-bottom">Informações básicas</span>
                                                                        <div class="rows pb-4">

                                                                                <div class="col-2 mb-3">
                                                                                        <label class="text-label">Cep</label>
                                                                                        <input type="text" name="cep" value="<?php echo isset($emitente->cep) ? $emitente->cep : null ?>" placeholder="Digite aqui..." class="form-campo busca_cep">
                                                                                </div>

                                                                                <div class="col-4 mb-3">
                                                                                        <label class="text-label">Logradouro</label>
                                                                                        <input type="text" name="logradouro" value="<?php echo isset($emitente->logradouro) ? $emitente->logradouro : null ?>" placeholder="Digite aqui..." class="form-campo rua">
                                                                                </div>
                                                                                <div class="col-2 mb-4">
                                                                                        <label class="text-label">Numero</label>
                                                                                        <input type="text" name="numero" value="<?php echo isset($emitente->numero) ? $emitente->numero : null ?>" placeholder="Digite aqui..." class="form-campo">
                                                                                </div>
                                                                                <div class="col-4 mb-3">
                                                                                        <label class="text-label">Bairro</label>
                                                                                        <input type="text" name="bairro" value="<?php echo isset($emitente->bairro) ? $emitente->bairro : null ?>" placeholder="Digite aqui..." class="form-campo bairro">
                                                                                </div>
                                                                                <div class="col-4 mb-3">
                                                                                        <label class="text-label">Complemento</label>
                                                                                        <input type="text" name="complemento" value="<?php echo isset($emitente->complemento) ? $emitente->complemento : null ?>" placeholder="Digite aqui..." class="form-campo">
                                                                                </div>


                                                                                <div class="col-2 mb-2">
                                                                                        <label class="text-label">UF</label>
                                                                                        <input type="text" name="uf" value="<?php echo isset($emitente->uf) ? $emitente->uf : null ?>" class="form-campo estado">
                                                                                </div>

                                                                                <div class="col-4 mb-3">
                                                                                        <label class="text-label">Cidade</label>
                                                                                        <input type="text" name="cidade" value="<?php echo isset($emitente->cidade) ? $emitente->cidade : null ?>" placeholder="Digite aqui..." class="form-campo cidade">
                                                                                </div>
                                                                                <div class="col-2 mb-3">
                                                                                        <label class="text-label">Ibge</label>
                                                                                        <input type="text" name="ibge" value="<?php echo isset($emitente->ibge) ? $emitente->ibge : null ?>" class="form-campo ibge">
                                                                                </div>

                                                                        </div>
                                                                        <div class="rows pb-4">
                                                                                <div class="col-12"><span class="d-block mt-4 h4 border-bottom">Dados Fiscais</span></div>
                                                                                <div class="col-6 mb-3">
                                                                                        <label class="text-label">CNAE</label>
                                                                                        <input type="text" name="cnae" value="<?php echo isset($emitente->cnae) ? $emitente->cnae : null ?>" placeholder="Digite aqui..." class="form-campo">
                                                                                </div>
                                                                                <div class="col-6 mb-3">
                                                                                        <label class="text-label">Regime Tributário</label>
                                                                                        <select class="form-campo" name="regime_tributario">
                                                                                                <option value="1">Simples Nacional</option>
                                                                                                <option value="2">Lucro Presumido</option>
                                                                                                <option value="3">Lucro Real</option>
                                                                                        </select>
                                                                                </div>
                                                                                <div class="col-12 mb-5 pt-4  text-center">
                                                                                        <input type="hidden" name="id_emitente" value="<?php echo isset($emitente->id_emitente) ? $emitente->id_emitente : null ?>">
                                                                                        <input type="submit" value="Salvar alterações" class="btn btn-success btn-bg d-block m-auto">
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