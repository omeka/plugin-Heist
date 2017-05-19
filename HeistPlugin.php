<?php

class HeistPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_filters = array(
        'api_resources',
    );

    protected $_hooks = array(
        'install',
        'uninstall',
        'define_acl',
        'upgrade',
    );

    public function hookInstall($args)
    {
        $db = get_db();

        $sql = "
            CREATE TABLE IF NOT EXISTS `$db->Heist` (
              `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
              `pairing_id` int(10) UNSIGNED,
              `device_id` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
              `omeka_id` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
              `table_id` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
              `item_ids` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB;
            ";
        $db->query($sql);
    }
    
    public function hookUpgrade($args)
    {
        $oldVersion = $args['old_version'];
        $newVersion = $args['new_version'];
        $db = get_db();
        if (version_compare($oldVersion, '1.1', '<')) {
            $omekaSql = "ALTER TABLE `$db->Heist` ADD `omeka_id` TINYTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL;";
            $db->query($omekaSql);

            $tableSql = "ALTER TABLE `$db->Heist` ADD `table_id` TINYTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL";
            $db->query($tableSql);
        }
    }

    public function hookUninstall($args)
    {
        $db = get_db();
        $db->query("DROP TABLE IF EXISTS `$db->Heist`");
    }

    public function hookDefineAcl($args)
    {
        $acl = $args['acl'];
        $acl->addResource('Heists');
        $acl->allow(null, 'Heists');
    }

    public function filterApiResources($apiResources)
    {
        $apiResources['heist'] = array(
            'record_type' => 'Heist',
            'actions' => array('index', 'get', 'post', 'put', 'delete'),
            'index_params' => array('id', 'pairing_id', 'device_id', 'omeka_id', 'table_id'),
        );
        return $apiResources;
    }
}
