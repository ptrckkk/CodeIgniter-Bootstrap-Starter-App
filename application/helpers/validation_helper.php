<?php

/**
 * @param $str string The value to check.
 * @return bool Returns TRUE if the captcha was entered successfully else false.
 */
function validation_rule_valid_captcha($str)
{
    $ci = &get_instance();
    $ci->load->model('Captcha_Model');
    if ($ci->Captcha_Model->does_captcha_exist($str)) {
        return TRUE;
    } else {
        $ci->form_validation->set_message('valid_captcha', $ci->lang->line('form_validation_wrong_captcha'));
        return FALSE;
    }
}
