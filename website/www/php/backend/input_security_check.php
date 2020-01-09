<?php
/*
 * Classe che implementa controlli di sicurezza negli input
 */

class Input_security_check
{
    /* Il metodo esegue dei controlli generali sui campi per prevenire attacchi sql */
    public static function general_controls($field)
    {
        return trim(htmlentities(strip_tags($field)));
    }
    /* Il metodo esegue dei controlli sul campo username */
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
    /* Il metodo esegue dei controlli sul campo password */
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
    /* Il metodo esegue dei controlli sul campo description */
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
    /* Il metodo esegue dei controlli sul campo title */
    public static function title_input_check($field)
    {
        if (strlen($field) < 3  ||  strlen($field) > 40) {
            return false;
        }
        $field = Input_security_check::general_controls($field);
        $field = Input_security_check::tag_conversion_language($field);
        return addslashes($field);
    }
    /* Il metodo esegue dei controlli sul campo search */
    public static function search_input_check($field)
    {
        if (strlen($field) > 40) {
            return false;
        }
        $field = Input_security_check::general_controls($field);
        if (!preg_match('/[a-zA-Z ]/i', $field)) {
            return false;
        }
        return $field;
    }
    /* Il metodo gestisce l'input di lingue */
    public static function tag_conversion_language($field)
    {
        while (preg_match('/\[([A-Za-z]{2}?)=(.*?)\]/', $field, $output)) {
            $tag='<span xml:lang="'.$output[1].'">'.$output[2].'</span>';
            $field = str_replace($output[0], $tag, $field);
        }
        return $field;
    }
    /* Il metodo gestisce l'input di enfasi */
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
    /* Il metodo controlla i tag e li sostituisce per i campi edit */
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