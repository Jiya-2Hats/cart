<?php
class Dashboard extends BaseController
{

    public function __construct()
    {
        if (!SessionControl::checkSession()) {
            header(HEADER_LOCATION . '/login');
            exit;
        }
    }

    public function index()
    {
        $this->view('dashboard');
    }
}
