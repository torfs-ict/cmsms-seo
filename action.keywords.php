<?php

/** @var SEO $this */
/** @var array $params */
/** @var string $id */
/** @var int $returnid */
if (!isset($gCms)) exit;
$db = $this->MySQL();

if (array_key_exists('cancel', $params)) {
    $this->Redirect($id, 'keywords', '', ['module_error' => 'Alle wijzigingen werden ongedaan gemaakt.']);
} elseif (array_key_exists('submit', $params)) {
    $db->query("DELETE FROM `#__module_seo_keywords` WHERE `client` = ?", $this->ClientId());
    foreach($params['keywords'] as $keyword) {
        $db->query("INSERT INTO `#__module_seo_keywords` VALUES (?, ?)", $this->ClientId(), $keyword);
    }
    $this->Redirect($id, 'keywords', '', ['module_message' => 'Uw sleutelwoorden werden succesvol opgeslagen.']);
}
$this->smarty->assign('keywords', (array)$db->query("SELECT `keyword` FROM `#__module_seo_keywords` WHERE `client` = ? ORDER BY `keyword` ASC", $this->ClientId())->fetchAll(PDO::FETCH_COLUMN));
echo $this->smarty->fetch($this->GetTemplateResource('keywords.tpl'));