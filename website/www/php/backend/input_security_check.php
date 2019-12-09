<?php
/*
 * Classe che implementa controlli di sicurezza negli input
 */ 

class Input_security_check{

    public static function general_controls($field){
        return trim(htmlentities(strip_tags($field)));
    }

    public static function username_check($field){
        $field = Input_security_check::general_controls($field);
        if(!preg_match('/[^a-z_\-0-9]/i', $field)) //caratteri supportati: a-z A-Z 0-9 - _
            return $field;
        return FALSE;
    }

    public static function password_check($field){
        $field = Input_security_check::general_controls($field);
        if(!preg_match('/[^a-z_!?\-0-9]/i', $field)) //caratteri supportati: a-z A-Z 0-9 - _ ! ?
            return $field;
        return FALSE;
    }
 
    public static function general_inputs_check($field){
        $field = Input_security_check::general_controls($field);
        if(!preg_match('/[^a-z 0-9]/i', $field)) //caratteri supportati: a-z A-Z 0-9 e spazio
            return $field;
        return FALSE;
    }

}


?>