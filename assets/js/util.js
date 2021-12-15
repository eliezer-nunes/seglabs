//Aplicando máscara de data no input
$(".mask-data").mask("99/99/9999");

//Exibindo a notificação de erro
function showError(msg) {
    $.notify(msg, "error");
}

//Exibindo a notificação de sucesso
function showSuccess(msg) {
    $.notify(msg, "success");
}

//Exibindo a notificação (array)
function showErrorArray(msgs) {
    if (msgs.length > 0) {
        var msg = "";
        for (i = 0; i < msgs.length; i++) {
            msg += msgs[i] + "\n";
        }
        showError(msg);
    }
}

//Exibindo a notificação (array)
function showSuccessArray(msgs) {
    if (msgs.length > 0) {
        var msg = "";
        for (i = 0; i < msgs.length; i++) {
            msg += msgs[i] + "\n";
        }
        showSuccess(msg);
    }
}

//Validando o response se existe erro
//Exibindo a mensagem de erro ou sucesso
function validaResponse(ret) {
    if (ret.responseText === "")
        return true;
    ret = $.parseJSON(ret.responseText);
    if (ret.erro == null)
        return true;
    if (ret.erro === 1) {
        if (ret.msgs[0].length > 0)
            showErrorArray(ret.msgs[0]);
        if (ret.msg !== '')
            showError(ret.msg);
        return false;
    } else {
        if (ret.msgs[0].length > 0)
            showSuccessArray(ret.msgs[0]);
        if (ret.msg !== "")
            showSuccess(ret.msg);
        return true;
    }
}

//Formatando Moeda
function formatCurrency(number) {
    var n = new Number(number);
    var myObj = {
        minimumFractionDigits: 2,
        style: "currency",
        currency: "BRL"
    }
   return n.toLocaleString("pt-BR", myObj);
}

//Aceita apenas números, ponto e vírgula
function somenteNumeros(e) {
    var charCode = e.charCode ? e.charCode : e.keyCode;
    if (charCode != 8 && charCode != 9) {
        if ((charCode < 48 || charCode > 57) && charCode != 44 && charCode != 46) {
            return false;
        }
    }
}

//Convertendo array em parametros url
function arrayToParameters(serializer){
    var _string = '';
    for(var ix in serializer)
    {
        var row = serializer[ix];
        _string += row.name + '=' + row.value + '&';
    }
    var end =_string.length - 1;
    _string = _string.substr(0, end);
    return _string;
}

//Formatando numero
function formateNumberView(number){
    var n = new Number(number);
    var myObj = {
        minimumFractionDigits: 2,
        currency: "BRL"
    }
   return n.toLocaleString("pt-BR", myObj);
}

//Formatando data
function formatDateViw(date){
    date = date.split('-');
    return date[2]+'/'+date[1]+'/'+date[0];
}

/*Exibindo modal de confirmacao
* title: Mensagem a ser exibida no modal
* nameFunction: Nome da função a ser executada
* paramethes: Parametros da função a ser executada
*/
function showModalConfirmation(title, nameFunction, paramethes){
    swal( {
        title: title, 
        text: "Deseja continuar?", 
        type: "warning", 
        showCancelButton: true, 
        confirmButtonClass: "btn-success",
        confirmButtonColor: "#DD6B55", 
        confirmButtonText: "Sim", 
        cancelButtonText: "Não",
        closeOnConfirm: true

    },function(isConfirm) {
            if (isConfirm) {
                nameFunction(paramethes);
            }
        }
    );
}
