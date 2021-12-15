<!-- Botao novo transporte -->
<div class="container-fluid main-container mb-4">
    <div class="p-3">
        <button type="button" class="btn btn-primary btn_novo_transporte">Novo Transporte&nbsp;<i class="fas fa-plus-circle"></i></button>
    </div>
</div>
<!-- tabela de transportes -->
<div class="container-fluid main-container">
    <div class="p-3">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Tipo</th>
                <th scope="col">Altura (m)</th>
                <th scope="col">Largura (m)</th>
                <th scope="col">Comprimeto (m)</th>
                <th scope="col">Responsável</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $transporte = new Transporte();
                    foreach($transporte->findAll() as $key => $value){
                        $tipo = new TipoTransporte();
                        $tipo = $tipo->find($value->tipo_id);
                ?>
                <tr>
                    <td><?=$value->id?></td>
                    <td><?=$tipo->nome?></td>
                    <td><?=Util::formatNumberView($value->altura)?></td>
                    <td><?=Util::formatNumberView($value->largura)?></td>
                    <td><?=Util::formatNumberView($value->comprimento)?></td>
                    <td><?=$value->responsavel?></td>
                    <td>
                        <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm btn_show_transporte" tid="<?=$value->id?>">Editar&nbsp;<i class="far fa-edit"></i></a>
                        <a href="javascript:void(0);" class="btn btn-outline-danger btn-sm btn_remove_transporte" tid="<?=$value->id?>">Remover&nbsp;<i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal novo transporte -->
<div class="modal fade" id="modal_novo_transporte" tabindex="-1" aria-labelledby="Novo Serviço" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="transporteModalLabel">Realizar Transporte</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form_transporte">
            <input type="hidden" name="id" id="id">
            <div class="mb-3">
                <label for="origem" class="form-label">Tipo*</label>
                <select class="form-select" name="tipo" id="tipo" required>
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
            <div class="mb-3">
                <label for="altura" class="form-label">Altura(m)*</label>
                <input type="text" class="form-control" id="altura" name="altura" onkeypress="return somenteNumeros(event)" required>
            </div>
            <div class="mb-3">
                <label for="largura" class="form-label">Largura(m)*</label>
                <input type="text" class="form-control" id="largura" name="largura" onkeypress="return somenteNumeros(event)" required>
            </div>
            <div class="mb-3">
                <label for="comprimento" class="form-label">Comprimento(m)*</label>
                <input type="text" class="form-control" id="comprimento" name="comprimento" onkeypress="return somenteNumeros(event)" required>
            </div>
            <div class="mb-3">
                <label for="responsavel" class="form-label">Responsável*</label>
                <input type="text" class="form-control" id="responsavel" name="responsavel" required>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-success btn_salvar_transporte">Salvar</button>
        <button type="button" class="btn btn-success btn_editar_transporte d-none">Editar</button>
      </div>
    </div>
  </div>
</div>
