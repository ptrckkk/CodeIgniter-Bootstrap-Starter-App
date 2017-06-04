<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model
{

    private $password_hash_options = ['cost' => 11];

    /**
     * Inserts a new record into the 'users' table.
     *
     * @param $record array An array with the following keys: display_name, email, and password.
     * Note that for password pass the password that is to be set as password. The proper hashing
     * of the password will be done by this function. Also, an API key for the user will be
     * generated by this function.
     * Furthermore, it is assumed that the fields have been checked for validity.
     * @return bool Returns TRUE if the insertion was successful, FALSE otherwise.
     */
    public function add($record)
    {
        $record['password'] = password_hash(
            $record['password'], PASSWORD_BCRYPT, $this->password_hash_options
        );
        $now = new DateTime();
        $record['date_created'] = $now->format('Y-m-d H:i:s');

        $this->db->insert('users', $record);
        return ($this->db->affected_rows() == 1);
    }

    /**
     * Checks if the given credentials are valid, i. e., if a user with the given email address and
     * password exists.
     *
     * @param $data array An array with two values: email, password. The password should be passed
     * as blank text as it will be processed in this function.
     * @return bool Returns TRUE if a user with the given email and password exists, FALSE
     * otherwise.
     */
    public function is_login_correct($data)
    {
        define('QUERY', 'SELECT password FROM users WHERE email = ?');
        $pw_hash = $this->db->query(QUERY, [$data['email']])->row()->password;
        return password_verify($data['password'], $pw_hash);
    }

    /**
     * This function retrieves data for a user by its email address.
     *
     * @param $email string The email address of the user to get the data for.
     * @return array Returns an array with the following keys (which correspond to the DB columns):
     * user_id, display_name, email, date_created, last_login_date.
     */
    public function get_user_by_email($email)
    {
        define(
            'SELECT_QUERY',
            'SELECT id, display_name, email, date_created, last_login_date FROM users WHERE email = ?'
        );
        $row = $this->db->query(SELECT_QUERY, [$email])->row();
        if ($this->db->affected_rows() == 1) {
            return [
                'user_id' => $row->id,
                'display_name' => $row->display_name,
                'email' => $row->email,
                'date_created' => $row->date_created,
                'last_login_date' => $row->last_login_date,
            ];
        } else {
            return [];
        }
    }

}