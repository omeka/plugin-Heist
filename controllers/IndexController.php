<?php

class Heist_IndexController extends Omeka_Controller_AbstractActionController
{

    public function init()
    {
        $this->_helper->db->setDefaultModelName('Heist');
    }
}
