<?php
/*
 * Classe che implementa controlli di sicurezza negli input
 */ 

class Input_security_check{

    public static function general_controls($field){
        return trim(htmlentities(strip_tags($field)));
    }

    public static function username_check($field){
        if(strlen($field) == 0 ||  strlen($field) > 20)
            return FALSE;
        $field = Input_security_check::general_controls($field);
        if(preg_match('/[a-z_\-0-9]/i', $field)) //caratteri supportati: a-z A-Z 0-9 - _
            return $field;
        return FALSE;
    }

    public static function password_check($field){
        if(strlen($field) == 0  ||  strlen($field) > 20)
            return FALSE;
        $field = Input_security_check::general_controls($field);
        if(preg_match('/[a-z_!?\-0-9]/i', $field)) //caratteri supportati: a-z A-Z 0-9 - _ ! ?
            return $field;
        return FALSE;
    }
 
    public static function description_input_check($field){
        if(strlen($field) < 20  ||  strlen($field) > 500)
            return FALSE;
        $field = Input_security_check::general_controls($field);
        return addslashes($field);
    }

    public static function title_input_check($field){
        if(strlen($field) < 3  ||  strlen($field) > 40)
            return FALSE;
        $field = Input_security_check::general_controls($field);
        return addslashes($field);
    }

}


?>