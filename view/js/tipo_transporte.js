//Executa apenas na pagina de tipo transporte
if ((window.location.href).indexOf('page=tipo_transporte') >= 0) {

    //Botão Novo Tipo Transporte
    $('.btn_novo_tipo_transporte').on('click', function(){
        //Alterando o title do modal
        $('#tipoTransporteModalLabel').text('Cadastrar Tipo Transporte');

        //Limpando formulário
        document.getElementById("form_tipo_transporte").reset();

        //Exibido botao salvar
        $('.btn_salvar_tipo_transporte').removeClass('d-none')
        
        //Escondendo botao editar
        $('.btn_editar_tipo_transporte').addClass('d-none')
        
        //Exibindo modal
        $('#modal_novo_tipo_transporte').modal('show');

    })

    //Botão Salvar do modal
    $('.btn_salvar_tipo_transporte').on('click', function(){
        //Cadastrando tipo de transporte
        $.ajax({
            url: 'controller/tipos_transporte.php',
            type: 'post',
            data: $('#form_tipo_transporte').serializeArray(),
            dataType: "json",
            complete: function (ret) {
                if(validaResponse(ret)){
                    setTimeout(() => {
                        document.location.reload('true');
                    }, 1000);
                }
            }
        });
    });

    //Botão Editar da grid
    $('.btn_show_tipo_transporte').on('click', function(){
        var id = $(this).attr('ttid');
        //Inserindo o id no formulario
        $('#id').val(id);
        
        //Alterando o title do modal
        $('#tipoTransporteModalLabel').text('Editar Tipo Transporte');
        
        //Escondendo botao salvar
        $('.btn_salvar_tipo_transporte').addClass('d-none')
        
        //Exibindo botao editar
        $('.btn_editar_tipo_transporte').removeClass('d-none')
        
        //Buscando tipo de transporte a ser editado
        $.ajax({
            url: 'controller/tipos_transporte.php',
            type: 'GET',
            data: {'id':id},
            dataType: "json",
            complete: function (ret) {
                ret = ret.responseJSON;
                var form = document.getElementById('form_tipo_transporte');
                form.nome.value = ret.nome;
                form.custo_medio.value = formateNumberView(ret.custo_medio);

                //Exibindo modal
                $('#modal_novo_tipo_transporte').modal('show');
            }
        });
    });

    //Botão Editar do madal
    $('.btn_editar_tipo_transporte').on('click', function(){
        //Atualizando o tipo de transporte
        $.ajax({
            url: 'controller/tipos_transporte.php?'+arrayToParameters($('#form_tipo_transporte').serializeArray()),
            type: 'PUT',
            dataType: "json",
            complete: function (ret) {
                if(validaResponse(ret)){
                    setTimeout(() => {
                        document.location.reload('true');
                    }, 1000);
                }
            }
        });
    });

    //Botão Remover da grid
    $('.btn_remove_tipo_transporte').on('click', function(){
        var id = $(this).attr('ttid');
        //Exibindo mensagem de confirmação
        showModalConfirmation("Você está preste a excluir um tipo de transporte!", removeTipoTransporte, id);
    });

    function removeTipoTransporte(id) {
        //Removendo tipo de transporte
        $.ajax({
            url: 'controller/tipos_transporte.php?id='+id,
            type: 'DELETE',
            dataType: "json",
            complete: function (ret) {
                if(validaResponse(ret)){
                    setTimeout(() => {
                        document.location.reload('true');
                    }, 1000);
                }
            }
        });
    }
}