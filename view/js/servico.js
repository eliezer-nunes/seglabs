//Executa apenas na pagina de servicos
if ((window.location.href).indexOf('page=servicos') >= 0) {

    //Quando o formulário foi renderizado
    $( document ).ready(function() {
        filter();
    });

    //Quando o modal for fechado
    $("#modal_novo_servico").on('hidden.bs.modal', function(){
        //Limpando formulário do modal
        document.getElementById("form_servico").reset();
    });

    //Botão Novo Serviço
    $('.btn_salvar_servico').on('click', function(){
        //Cadastrando Serviço
        $.ajax({
            url: 'controller/servicos.php',
            type: 'post',
            data: $('#form_servico').serializeArray(),
            dataType: "json",
            complete: function (ret) {
                if(validaResponse(ret)){
                    //Limpando formulário do modal
                    document.getElementById("form_servico").reset();

                    //Fechando modal
                    $('#modal_novo_servico').modal('hide');

                    //Aplicando filtro
                    filter();
                }
            }
        });
    });

    //Botão Cancelar da grid
    function cancelar(id){
        //Exibindo mensagem de confirmação
        showModalConfirmation("Você está preste a cancelar um serviço!", cancelarServico, id);
    }

    function cancelarServico(id){
        //Cancelando o serviço
        $.ajax({
            url: 'controller/servicos.php',
            type: 'post',
            data: {'action':'cancelar', 'id':id},
            dataType: "json",
            complete: function (ret) {
                if(validaResponse(ret)){
                    filter();
                }
            }
        });
    }

    //Botão Finalizar da grid
    function finalizar(id){
        //Exibindo mensagem de confirmação
        showModalConfirmation("Você está preste a finalizar um serviço!", finalizarServico, id);
    }

    function finalizarServico(id) {
        //Finalizando serviço
        $.ajax({
            url: 'controller/servicos.php',
            type: 'post',
            data: {'action':'finalizar', 'id':id},
            dataType: "json",
            complete: function (ret) {
                if(validaResponse(ret)){
                    filter();
                }
            }
        });
    }

    //Botão Aplicar (filtro)
    $('.btn_filtrar').on('click', function(){
        filter();
    });


    function filter(){
        //Lmpando a tabela de serviços
        $('#table_servicos tbody').html('');
        
        //Escondendo a mensagem "Nenhum resgistro encontrado"
        $('.not_data_table').addClass('d-none');
        
        //Buscando dados em conformidade com os filtros
        $.ajax({
            url: 'controller/servicos.php?data='+JSON.stringify($('#form_filters').serializeArray()),
            type: 'GET',
            dataType: "json",
            complete: function (ret) {
                var html = getHtmlBody(ret.responseJSON);
                if(html == '')
                    //Exibindo a menasgem "Nenhum resgistro encontrado"
                    $('.not_data_table').removeClass('d-none');
                
                //Inserindo os serviços na grid
                $('#table_servicos tbody').html(html);
            }
        });
    }

    //Montando o html para redenrizar os serviços na grid
    function getHtmlBody(servicos){
        var html = '';
        for(i=0;i<servicos.length;i++){
            var status = '';
            if(parseInt(servicos[i]['cancelado']) == 1  && parseInt(servicos[i]['finalizado']) == 0 ){
                status += '<span class="badge bg-danger">Cancelado</span>'; 
            } else if(parseInt(servicos[i]['cancelado']) == 0  && parseInt(servicos[i]['finalizado']) == 1){
                status += '<span class="badge bg-success">Carga entregue</span>';
            }else { 
                status += '<span class="badge bg-secondary">Em transporte</span>';
            } 
            
            var botoes = '';
            botoes += '<a href="javascript:void(0);" class="btn btn-outline-danger btn-sm btn_cancelar_servico" onclick="cancelar('+servicos[i]['id']+');">Cancelar&nbsp;<i class="far fa-times-circle"></i></a>'
            botoes += '&nbsp;';
            botoes += '<a href="javascript:void(0);" class="btn btn-outline-success btn-sm btn_finalizar_servico" onclick="finalizar('+servicos[i]['id']+')">Finalizar&nbsp;<i class="far fa-check-circle"></i></a>';

            html += '<tr>';
                html += '<td>'+servicos[i]['id']+'</td>';
                html += '<td>'+servicos[i]['origem']+'</td>';
                html += '<td>'+servicos[i]['destino']+'</td>';
                html += '<td>'+formatDateViw(servicos[i]['data_saida'])+'</td>';
                html += '<td>'+servicos[i]['nome']+'</td>';
                html += '<td>'+servicos[i]['responsavel']+'</td>';
                html += '<td>'+formatCurrency(servicos[i]['valor'])+'</td>';
                html += '<td>'+status+'</td>';
                html += '<td>'+botoes+'</td>';
            html += '</tr>';
        }
        return html;
    }


}