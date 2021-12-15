<!-- Botao novo tipo de transporte -->
<div class="container-fluid main-container mb-4">
    <div class="p-3">
        <button type="button" class="btn btn-primary btn_novo_tipo_transporte">Novo Tipo Transporte&nbsp;<i class="fas fa-plus-circle"></i></button>
    </div>
</div>
<!-- tabela de tipos de transporte -->
<div class="container-fluid main-container">
    <div class="p-3">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Custo médio (m3)</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $transporte = new TipoTransporte();
                    foreach($transporte->findAll() as $key => $value){
                ?>
                <tr>
                    <td><?=$value->id?></td>
                    <td><?=$value->nome?></td>
                    <td><?=Util::formatNumberView($value->custo_medio)?></td>
                    <td>
                        <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm btn_show_tipo_transporte" ttid="<?=$value->id?>">Editar&nbsp;<i class="far fa-edit"></i></a>
                        <a href="javascript:void(0);" class="btn btn-outline-danger btn-sm btn_remove_tipo_transporte" ttid="<?=$value->id?>">Remover&nbsp;<i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal novo tipo transporte -->
<div class="modal fade" id="modal_novo_tipo_transporte" tabindex="-1" aria-labelledby="Novo Serviço" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tipoTransporteModalLabel">Cadastrar Tipo Transporte</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form_tipo_transporte">
            <input type="hidden" name="id" id="id">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome*</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="custo_medio" class="form-label">Custo médio (m3)*</label>
                <input type="text" class="form-control" id="custo_medio" name="custo_medio" onkeypress="return somenteNumeros(event)" required>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-success btn_salvar_tipo_transporte">Salvar</button>
        <button type="button" class="btn btn-success btn_editar_tipo_transporte d-none">Editar</button>
      </div>
    </div>
  </div>
</div>
