<?php
class View
{
    //public $template_view; // Here we can set template by default.

    function generate($content_view, $template_view, $data = null)
    {
        include 'mvcphp/views/'.$template_view;
    }
}
