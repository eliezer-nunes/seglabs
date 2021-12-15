<!-- Botao novo sevico -->
<div class="container-fluid main-container mb-3">
    <div class="p-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_novo_servico">Novo Serviço&nbsp;<i class="fas fa-plus-circle"></i></button>
    </div>
</div>
<!-- Filtros -->
<div class="container-fluid main-container mb-3">
    <div class="p-3">
        <h4 class="mb-2">Filtros</h4>
        <form id="form_filters">
            <div class="row">
                <div class="col-3 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option value="t">Em transporte</option>
                        <option value="f">Carga entregue</option>
                        <option value="c">Cancelado</option>
                    </select>
                </div>
                <div class="col-3 mb-3">
                    <label for="origem" class="form-label">Origem</label>
                    <input type="text" class="form-control" name="origem"> 
                </div>
                <div class="col-3 mb-3">
                    <label for="destino" class="form-label">Destino</label>
                    <input type="text" class="form-control" name="destino">
                </div>
                <div class="col-3 mb-3">
                    <label for="data_saida" class="form-label">Data saída</label>
                    <input type="text" class="form-control mask-data" name="data_saida">
                </div>
                <div class="col-4 mb-3">
                    <label for="valor" class="form-label">Preço</label>
                    <input type="text" class="form-control" name="valor" onkeypress="return somenteNumeros(event)">
                </div>
                <div class="col-4 mb-3">
                    <label for="tipo_id" class="form-label">Tipo</label>
                    <select class="form-select" name="tipo_id">
                        <option value=""></option>
                        <?php
                            $tipo = new TipoTransporte();
                            foreach($tipo->findAllAsc() as $key => $value){
                        ?>
                            <option value="<?=$value->id?>"><?=$value->nome?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-4 mb-3">
                    <label for="responsavel" class="form-label">Responsável</label>
                    <input type="text" class="form-control" name="responsavel">
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-12 mb-3">
                <button type="button" class="btn btn-outline-primary btn_filtrar"><i class="fas fa-filter"></i>&nbsp;Aplicar</button>
            </div>
        </div>
    </div>
</div>
<!-- tabela de serviços -->
<div class="container-fluid main-container">
    <div class="p-3">
        <table id="table_servicos" class="table mt-3 mb-3">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Origem</th>
                <th scope="col">Destino</th>
                <th scope="col">Data Saída</th>
                <th scope="col">Tipo</th>
                <th scope="col">Responsável</th>
                <th scope="col">Preço</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div class="not_data_table text-center p3">Nenhum registro encontrado</div>
    </div>
</div>

<!-- Modal novo serviço -->
<div class="modal fade" id="modal_novo_servico" tabindex="-1" aria-labelledby="Novo Serviço" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastro Serviço</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form_servico">
            <input type="hidden" name="action" value="insert">
            <div class="mb-3">
                <label for="origem" class="form-label">Origem</label>
                <input type="text" class="form-control" id="origem" name="origem">
            </div>
            <div class="mb-3">
                <label for="destino" class="form-label">Destino</label>
                <input type="text" class="form-control" id="destino" name="destino">
            </div>
            <div class="mb-3">
                <label for="data_saida" class="form-label">Data saída</label>
                <input type="text" class="form-control mask-data" id="data_saida" name="data_saida">
            </div>
            <div class="mb-5">
                <label for="transporte_id" class="form-label">Trasporte</label>
                <select class="form-select" name="transporte_id" id="transporte_id">
                    <option value="">Selecione um transporte</option>
                    <?php
                        $transporte = new Transporte();
                        foreach($transporte->findAll() as $key => $value){
                            $tipo = new TipoTransporte();
                            $tipo = $tipo->find($value->tipo_id);
                    ?>
                    <option value="<?=$value->id?>"><?=($tipo->nome).' - '.$value->responsavel?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-success btn_salvar_servico">Salvar</button>
      </div>
    </div>
  </div>
</div>