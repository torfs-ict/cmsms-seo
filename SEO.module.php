<?php

use NetDesign\NetDesignModule;

class SEO extends NetDesignModule {

    /**
     * @return string
     */
    public function GetFriendlyName() {
        return 'Zoekmachineoptimalisatie';
    }

    /**
     * @return array
     */
    public function GetAdminMenuItems()
    {
        $ret = [];
        // Keywords
        $item = CmsAdminMenuItem::from_module($this);
        $item->title = 'SEO - Sleutelwoorden';
        $item->action = 'keywords';
        $item->section = 'content';
        $item->url = $this->create_url('m1_', $item->action);
        $ret[] = $item;

        return $ret;
    }


    /**
     * @return bool
     */
    public function HasAdmin() {
        return true;
    }

    /**
     * Function that will get called as module is installed. This function should
     * do any initialization functions including creating database tables. It
     * should return a string message if there is a failure. Returning nothing (FALSE)
     * will allow the install procedure to proceed.
     *
     * The default behavior of this method is to include a file named method.install.php
     * in the module directory, if one can be found.  This provides a way of splitting
     * secondary functions into other files.
     *
     * @return string|false A value of FALSE indicates no error.  Any other value will be used as an error message.
     */
    public function Install() {
        $this->RegisterSmartyPlugin('seoKeywords', 'function', 'SmartyKeywordsPlugin');
        $db = $this->MySQL();
        $db->query("CREATE TABLE `#__module_seo_keywords` (`client` VARCHAR(255) NOT NULL, `keyword` VARCHAR(255) NOT NULL);");
        return false;
    }

    /**
     * Function that will get called as module is uninstalled. This function should
     * remove any database tables that it uses and perform any other cleanup duties.
     * It should return a string message if there is a failure. Returning nothing
     * (FALSE) will allow the uninstall procedure to proceed.
     *
     * The default behaviour of this function is to include a file called method.uninstall.php
     * in your module directory to do uninstall operations.
     *
     * @return string|false A result of FALSE indicates that the module uninstalled correctly, any other value indicates an error message.
     */
    public function Uninstall() {
        $db = $this->MySQL();
        $db->query("DROP TABLE `#__module_seo_keywords`;");
        $this->RemoveSmartyPlugin();
        return false;
    }

    public static function SmartyKeywordsPlugin($params, Smarty_Internal_Template $template) {
        $seo = SEO::GetInstance();
        $keywords = (array)$seo->MySQL()->query("SELECT `keyword` FROM `#__module_seo_keywords` WHERE `client` = ? ORDER BY `keyword` ASC", $seo->ClientId())->fetchAll(PDO::FETCH_COLUMN);
        array_walk($keywords, function(&$item) {
            $item = htmlentities($item);
        });
        return implode(', ', $keywords);
    }

}