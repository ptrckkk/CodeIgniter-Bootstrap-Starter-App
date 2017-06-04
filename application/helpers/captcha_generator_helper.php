<?php

/**
 * This function creates a captcha, stores it in the database and returns the image which is to be
 * displayed on a view.
 *
 * @return string Returns the image which directly can be printed on a view.
 */
function generate_captcha()
{
    $ci = &get_instance();

    $ci->load->helper('captcha');
    $values = array(
        'img_path' => './../application/assets/captchas/',
        'img_url' => base_url() . '../application/assets/captchas/',
        'font_path' => './../application/assets/fonts/xerox-serif-narrow-italic.ttf',
        'img_width' => 200,
        'img_height' => 50,
        'expiration' => CAPTCHA_EXPIRATION_TIME,
        'word_length' => 8,
        'font_size' => 20,
        'pool' => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
    );

    $captcha = create_captcha($values);
    $data = array(
        'captcha_time' => $captcha['time'],
        'ip_address' => $ci->input->ip_address(),
        'word' => $captcha['word']
    );

    $query = $ci->db->insert_string('captcha', $data);
    $ci->db->query($query);

    return $captcha['image'];
}
