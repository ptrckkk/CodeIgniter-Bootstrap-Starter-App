<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Initial_DB extends CI_Migration
{

    public function up()
    {
        parent::__construct();
        $this->load->dbforge();

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'display_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 50
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'date_created' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
                'default' => NULL
            ),
            'last_login_date' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
                'default' => NULL
            )
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }

}