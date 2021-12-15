<?php

/* 
 * Created by Eliézer Santos Nunes
*/
class Util {
    //Formatando data para ser pesistida
    static function dateFormatSql($date) {
        return date('Y-m-d', strtotime(str_replace('/', '.', $date)));
    }

    //Formatando data para ser exibida
    static function dateFormatView($date) {
        return date('d/m/Y', strtotime(str_replace('/', '.', $date)));
    }

    //Formatando numero para ser persistido
    static function formatNumber($number){
        $number = str_replace('.', '', $number);
        return str_replace(',', '.', $number);
    }

    //Formatando numero para ser exibido
    static function formatNumberView($number){
        return number_format($number,2,",",".");
    }

    //Verificando se o parametro existe e é diferente de vazio
    static function hasParameter($parameter){
        if(isset($parameter) && !empty($parameter)){
            return true;
        }else{
            return false;
        }
    }

}
