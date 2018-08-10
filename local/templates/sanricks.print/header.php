<?
/**
 * @global CMain $APPLICATION
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Page\Asset,
    Bitrix\Main\Localization\Loc;

Loc::loadLanguageFile(__FILE__);
CJSCore::Init(array("fx", "ajax"));

Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/svg.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/svg.on.min.js");

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/font.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/bootstrap.min.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/bootstrap-grid.min.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/koorochka.carousel.min.css");
?>
<!DOCTYPE html>
<html lang="<?=LANG?>">
<head>
    <title><?$APPLICATION->ShowTitle()?></title>
    <?$APPLICATION->ShowHead();?>
</head>
<body id="sanricks" class="h-100">
<?$APPLICATION->ShowPanel();?>
<header id="header" class="container">
    <div class="text-center">
        <h5>International Taekwon-Do Federation</h5>
        <h1 class="text-info">Taekwon-Do ITF</h1>
    </div>
</header>
<div class="container">