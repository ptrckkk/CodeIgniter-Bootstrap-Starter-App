<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    private $create_form_validation_config = [
        array(
            'field' => 'display_name',
            'label' => 'Display name',
            'rules' => 'required|trim|min_length[2]|xss_clean',
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|trim|valid_email|is_unique[users.email]',
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|min_length[8]'
        ),
        array(
            'field' => 'captcha',
            'label' => 'Captcha',
            'rules' => 'required|callback_valid_captcha'
        )
    ];

    private $login_validation_config = [
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|trim|valid_email',
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        )
    ];

    /**
     * Default controller action. Currently redirects to the page where one can create an account.
     */
    public function index()
    {
        redirect_to_controller_action('user', 'create');
    }

    /**
     * Controller function for creating a new account (displays the view as well as handles the
     * POST request for creating a new account).
     */
    public function create()
    {
        // Handle a POST request
        if ($this->input->method(TRUE) === 'POST') {
            $this->form_validation->set_rules($this->create_form_validation_config);
            // There are input errors => redirect for user to correct inputs
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata([
                    'has_validation_error' => TRUE,
                    'validation_error_message' => validation_errors(),
                    'display_name' => $this->input->post('display_name'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                ]);
                redirect_to_controller_action('user', 'create');
            } // Inputs are valid => create database entry
            else {
                $this->User_Model->add([
                    'display_name' => $this->input->post('display_name'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                ]);
                $this->session->set_flashdata([
                    'has_success_message' => TRUE,
                    'success_message' => $this->lang->line('SUCCESSFUL_USER_CREATION'),
                ]);
                redirect_to_controller_action('user', 'create');
            }
        } // We do not need to handle a POST request => display the form
        else {
            $this->load->helper('captcha_generator');
            $this->load->view(
                EFFECTIVE_TEMPLATE_FILE_NAME,
                [
                    LAYOUT_CONTENT_PAGE_NAME => 'user/create',
                    PAGE_TITLE => 'Create Account',
                    current_page_name => CURRENT_PAGE_USER_CREATE,
                    'captcha_image' => generate_captcha()
                ]
            );
        }
    }

    /**
     * Controller function for logging in (displays the view as well as handles the POST request
     * for logging in).
     */
    public function login()
    {
        // Handle a POST request
        if ($this->input->method(TRUE) === 'POST') {
            $this->form_validation->set_rules($this->login_validation_config);
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata([
                    'has_login_error' => TRUE,
                    'login_error' => validation_errors(),
                    'email' => $this->input->post('email'),
                ]);
                redirect_to_controller_action('user', 'login');
            } // Inputs are valid => do login
            else {
                $login_data = [
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                ];
                if ($this->User_Model->is_login_correct($login_data)) {
                    $session_data = $this->User_Model->get_user_by_email($login_data['email']);
                    $session_data['is_logged_in'] = TRUE;
                    $session_data['has_welcome_message_been_shown'] = FALSE;
                    $this->session->set_userdata($session_data);
                    redirect_to_controller_action('welcome');
                } else {
                    $this->session->set_flashdata([
                        'has_login_error' => TRUE,
                        'login_error' => 'Invalid email / password combination!',
                        'email' => $this->input->post('email'),
                    ]);
                    redirect_to_controller_action('user', 'login');
                }
            }
        } // We do not need to handle a POST request => display the form
        else {
            $this->load->view(
                EFFECTIVE_TEMPLATE_FILE_NAME,
                [
                    LAYOUT_CONTENT_PAGE_NAME => 'user/login',
                    PAGE_TITLE => 'Login',
                    current_page_name => CURRENT_PAGE_LOGIN
                ]
            );
        }
    }

    public function logout()
    {
        if (is_logged_in()) {
            $this->session->sess_destroy();
            $this->load->view(
                EFFECTIVE_TEMPLATE_FILE_NAME,
                [
                    LAYOUT_CONTENT_PAGE_NAME => 'user/logout',
                    PAGE_TITLE => 'You were logged out',
                    current_page_name => CURRENT_PAGE_LOGOUT
                ]
            );
        } else {
            redirect_to_homepage();
        }
    }

    /**
     * @see validation_helper->validation_rule_valid_captcha
     */
    public function valid_captcha($str)
    {
        $this->load->helper('validation');
        return validation_rule_valid_captcha($str);
    }

}
