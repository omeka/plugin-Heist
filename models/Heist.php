<?php

class Heist extends Omeka_Record_AbstractRecord implements Zend_Acl_Resource_Interface
{
    public $pairing_id;

    public $device_id;

    public $omeka_id;

    public $table_id;

    public $item_ids;

    public function getResourceId()
    {
        return 'Heists';
    }
}
