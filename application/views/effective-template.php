<?
$content_to_load = constant(LAYOUT_CONTENT_PAGE_NAME);
$this->load->view('default-template/header');
$this->load->view($$content_to_load);
$this->load->view('default-template/footer');