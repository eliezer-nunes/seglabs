//Executa apenas na pagian de transportes
if ((window.location.href).indexOf('page=transportes') >= 0) {

    //Botão novo transporte
    $('.btn_novo_transporte').on('click', function(){
        //Alterando o title do modal
        $('#transporteModalLabel').text('Cadastrar Transporte');

        //Limpando formulário
        document.getElementById("form_transporte").reset();

        //Exibido botao salvar
        $('.btn_salvar_transporte').removeClass('d-none')
        
        //Escondendo botao editar
        $('.btn_editar_transporte').addClass('d-none')
        
        //Exibindo modal
        $('#modal_novo_transporte').modal('show');

    })

    //Botão salvar do modal
    $('.btn_salvar_transporte').on('click', function(){
        //Cadastrando transporte
        $.ajax({
            url: 'controller/transportes.php',
            type: 'post',
            data: $('#form_transporte').serializeArray(),
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
    $('.btn_show_transporte').on('click', function(){
        var id = $(this).attr('tid');
        
        //Inserindo o id no formulario
        $('#id').val(id);
        
        //Alterando o title do modal
        $('#transporteModalLabel').text('Editar Transporte');
        
        //Escondendo botao salvar
        $('.btn_salvar_transporte').addClass('d-none')
        
        //Exibindo botao editar
        $('.btn_editar_transporte').removeClass('d-none')
        
        //Buscando daddos do transporte a ser editado
        $.ajax({
            url: 'controller/transportes.php',
            type: 'GET',
            data: {'id':id},
            dataType: "json",
            complete: function (ret) {
                ret = ret.responseJSON;
                var form = document.getElementById('form_transporte');
                form.tipo.value = ret.tipo_id;
                form.altura.value = formateNumberView(ret.altura);
                form.largura.value = formateNumberView(ret.largura);
                form.comprimento.value = formateNumberView(ret.comprimento);
                form.responsavel.value = ret.responsavel;

                $('#modal_novo_transporte').modal('show');
            }
        });
    });

    //Botaão editar do madal
    $('.btn_editar_transporte').on('click', function(){
        //Atualizando transporte
        $.ajax({
            url: 'controller/transportes.php?'+arrayToParameters($('#form_transporte').serializeArray()),
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

    //Botão remover da grid
    $('.btn_remove_transporte').on('click', function(){
        var id = $(this).attr('tid');

        //Exibindo mensagem de confirmação
        showModalConfirmation("Você está preste a excluir um transporte!", removeTransporte, id);
    });

    //Removendo transporte
    function removeTransporte(id) {
        $.ajax({
            url: 'controller/transportes.php?id='+id,
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