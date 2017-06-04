<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Captcha_Model extends CI_Model
{

    /**
     * This function checks if a captcha text exists in the database. Furthermore, it also makes
     * sure that a captcha exists only for the IP that it was created for.
     * What it also does is to check if old captcha entries are to be removed from the database
     * table.
     *
     * @param $text string The text of the captcha to check if it exists.
     * @return bool Returns TRUE if a captcha with the given text exists, otherwise FALSE.
     */
    public function does_captcha_exist($text)
    {
        // Delete old captchas
        $expiration = time() - CAPTCHA_EXPIRATION_TIME;
        $this->db->query('DELETE FROM captcha WHERE captcha_time < ' . $expiration);

        // See if a captcha exists
        $sql = 'SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
        $binds = array($text, $this->input->ip_address(), $expiration);
        $query = $this->db->query($sql, $binds);
        $row = $query->row();
        return ($row->count > 0);
    }

}