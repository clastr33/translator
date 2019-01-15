<?php
class Controller_Allwordslist extends Controller
{
    function __construct()
    {
        $this->model = new Model_Allwordslist();
        $this->view = new View();
    }

    function action_index()
    {
        $data = $this->model->get_data();
        $this->view->generate('view_allwordslist.php', 'view_template.php', $data);
    }
}
