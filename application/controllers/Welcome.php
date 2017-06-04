<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function index()
    {
        $this->load->view(
            EFFECTIVE_TEMPLATE_FILE_NAME,
            [
                LAYOUT_CONTENT_PAGE_NAME => 'welcome/index',
                PAGE_TITLE => 'Welcome',
                current_page_name => CURRENT_PAGE_WELCOME
            ]
        );
    }

}
