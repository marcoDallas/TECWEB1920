<?php
/*
 * Classe che implementa controlli di sicurezza negli input
 */

class Input_security_check
{
    public static function general_controls($field)
    {
        return trim(htmlentities(strip_tags($field)));
    }

    public static function username_check($field)
    {
        if (strlen($field) < 5 ||  strlen($field) > 20) {
            return false;
        }
        $field = Input_security_check::general_controls($field);
        if (preg_match('/[a-z_\-0-9]/i', $field)) { //caratteri supportati: a-z A-Z 0-9 - _
            return $field;
        }
        return false;
    }

    public static function password_check($field)
    {
        if (strlen($field) < 5  ||  strlen($field) > 20) {
            return false;
        }
        $field = Input_security_check::general_controls($field);
        if (preg_match('/[a-z_!?\-0-9]/i', $field)) { //caratteri supportati: a-z A-Z 0-9 - _ ! ?
            return $field;
        }
        return false;
    }
 
    public static function description_input_check($field)
    {
        if (strlen($field) < 20  ||  strlen($field) > 500) {
            return false;
        }
        $field = Input_security_check::general_controls($field);
        $field = Input_security_check::tag_conversion_language($field);
        $field = Input_security_check::tag_conversion_emph($field);
        return addslashes($field);
    }

    public static function title_input_check($field)
    {
        if (strlen($field) < 3  ||  strlen($field) > 40) {
            return false;
        }
        $field = Input_security_check::general_controls($field);
        $field = Input_security_check::tag_conversion_language($field);
        return addslashes($field);
    }


    public static function search_input_check($field)
    {
        if (strlen($field) < 3  ||  strlen($field) > 40) {
            return false;
        }
        $field = Input_security_check::general_controls($field);
        if (!preg_match('/[a-zA-Z ]/i', $field)) {
            return false;
        }
        return $field;
    }


    public static function tag_conversion_language($field)
    {
        while (preg_match('/\[([A-Za-z]{2}?)=(.*?)\]/', $field, $output)) {
            $tag='<span xml:lang="'.$output[1].'">'.$output[2].'</span>';
            $field = str_replace($output[0], $tag, $field);
        }
        return $field;
    }

    public static function tag_conversion_emph($field)
    {
        while (preg_match('/\[\*(.*?)\*\]/', $field, $output)) {
            $tag = "<strong>$output[1]</strong>";
            $field = str_replace($output[0], $tag, $field);
        }
        while (preg_match('/\[\-(.*?)\-\]/', $field, $output)) {
            $tag = "<em>$output[1]</em>";
            $field = str_replace($output[0], $tag, $field);
        }
        return $field;
    }

    public static function tag_check($field)
    {
        while (preg_match('/<strong>(.*?)<\/strong>/', $field, $output)) {
            $rep= "[*$output[1]*]";
            $field = str_replace($output[0], $rep, $field);
        }
        while (preg_match('/<em>(.*?)<\/em>/', $field, $output)) {
            $rep= "[-$output[1]-]";
            $field = str_replace($output[0], $rep, $field);
        }
        while (preg_match('/<span xml:lang="(.*?)">(.*?)<\/span>/', $field, $output)) {
            $rep= "[$output[1]=$output[2]]";
            $field = str_replace($output[0], $rep, $field);
        }
        return $field;
    }
}
?>