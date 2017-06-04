<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Captcha_Table extends CI_Migration
{

    public function up()
    {
        parent::__construct();
        $this->load->dbforge();

        $fields = array(
            'captcha_id' => array(
                'type' => 'INT',
                'constraint' => 13,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'captcha_time' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsinged' => TRUE,
                'null' => FALSE
            ),
            'ip_address' => array(
                'type' => 'VARCHAR(45)',
                'null' => FALSE
            ),
            'word' => array(
                'type' => 'VARCHAR(50)',
                'null' => FALSE
            )
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('captcha_id', TRUE);
        $this->dbforge->add_key('word');
        $this->dbforge->create_table('captcha', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('captcha');
    }

}