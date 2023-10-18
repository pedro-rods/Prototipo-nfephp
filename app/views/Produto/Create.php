<!-- Main content -->
<section class="content">

        <div class="container-fluid">
                <div class="row">
                        <div class="col-12">
                                <!-- Default box -->
                                <div class="card">
                                        <div class="card-header" style="background-color: lightgray; color:#181E24;">
                                                <h3 class="card-title">Formulário dos clientes</h3>


                                                <div class="card-tools">
                                                        <a href="<?php echo URL_BASE . "cliente" ?>" class="btn btn-danger"> <i class="fas fa-arrow-left"></i> Voltar</a>
                                                </div>
                                        </div>
                                        <?php
                                        $this->verErro();
                                        $this->verMsg();
                                        ?>
                                        <form action="<?php echo URL_BASE . "produto/salvar" ?>" method="POST">
                                                <div class="pt-2 px-5 pb-5 width-100 d-inline-block">
                                                        <div class="border px-4">
                                                                <span class="d-block mt-4 h4 border-bottom">Produto</span>
                                                                <div class="rows">
                                                                        <div class="col-6">
                                                                                <label class="text-label label">Titulo do produto</label>
                                                                                <input type="text" value="<?php echo isset($produto) ? $produto->produto : "" ?>" name="produto" class="form-campo">
                                                                        </div>

                                                                        <div class="col-4">
                                                                                <label class="text-label">Unidade</label>
                                                                                <select class="form-campo" name="id_unidade">
                                                                                        <?php foreach ($unidades as $unidade) {
                                                                                                $selecionado = ($produto->id_unidade == $unidade->id_unidade) ? "selected" : "";
                                                                                                echo "<option value='$unidade->id_unidade' $selecionado > $unidade->unidade</option>";
                                                                                        } ?>
                                                                                </select>
                                                                        </div>

                                                                        <div class="col-2">
                                                                                <label class="text-label">Preço atual</label>
                                                                                <input type="text" name="preco" value="<?php echo isset($produto) ? $produto->preco : "" ?>" class="form-campo">
                                                                        </div>

                                                                </div>

                                                                <span class="d-block mt-4 h4 border-bottom">Dados Complementares</span>
                                                                <div class="rows">
                                                                        <div class="col-6 ">
                                                                                <label class="text-label">CFOP</label>
                                                                                <select class="form-campo" name="cfop" id="cfop">
                                                                                        <option value="">Escolha uma Opção</option>
                                                                                        <?php foreach ($cfops as $cfop) {
                                                                                                $selecionado =  ($produto->cfop == $cfop->codigo_cfop) ? "selected" : "";
                                                                                                echo "<option value='$cfop->codigo_cfop' $selecionado >" . $cfop->codigo_cfop . " - " . $cfop->desc_cfop . "</option>";
                                                                                        } ?>
                                                                                </select>
                                                                        </div>

                                                                        <div class="col-2">
                                                                                <span class="text-label">Exceção tabela IPI</span>
                                                                                <select class="form-campo" name="extipi">
                                                                                        <option value="">Escolha uma Opção</option>
                                                                                        <?php for ($i = 1; $i <= 8; $i++) {
                                                                                                $cod = "0" . $i;
                                                                                                $selecionado = ($produto->extipi == $cod) ? "selected" : "";
                                                                                                echo "<option value='$cod' $selecionado>$cod</option>";
                                                                                        } ?>

                                                                                </select>
                                                                        </div>

                                                                        <div class="col-2">
                                                                                <small class="text-label">EAN/GTIN</small>
                                                                                <input type="text" name="gtin" value="<?php echo isset($produto) ? $produto->gtin : "" ?>" class="form-campo">
                                                                        </div>

                                                                        <div class="col-2">
                                                                                <label class="text-label">NCM</label>
                                                                                <input type="text" name="ncm" value="<?php echo isset($produto) ? $produto->ncm : "" ?>" class="form-campo">
                                                                        </div>
                                                                        <div class="col-3">
                                                                                <label class="text-label">Código CEST</label>
                                                                                <input type="text" name="cest" value="<?php echo isset($produto) ? $produto->cest : "" ?>" class="form-campo">
                                                                        </div>
                                                                        <div class="col-3">
                                                                                <label class="text-label">Código Benef. Fiscal na UF</label>
                                                                                <input type="text" name="cbenef" value="<?php echo isset($produto) ? $produto->cbenef : "" ?>" class="form-campo">
                                                                        </div>
                                                                        <div class="col-3">
                                                                                <label class="text-label">MVA</label>
                                                                                <input type="text" name="mva" value="<?php echo isset($produto) ? $produto->mva : "" ?>" class="form-campo">
                                                                        </div>
                                                                        <div class="col-3">
                                                                                <label class="text-label">NFCI</label>
                                                                                <input type="text" name="nfci" value="<?php echo isset($produto) ? $produto->mva : "" ?>" class="form-campo">
                                                                        </div>
                                                                        <div class="col-12 mt-4  pb-5">
                                                                                <input type="hidden" name="id_produto" value="<?php echo isset($produto) ? $produto->id_produto : null ?>">
                                                                                <input type="submit" value="Salvar alterações" class="btn btn-success btn-bg d      -block m-auto">
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