<?
/**
 * @var array $arResult
 * @var array $arParams
 */
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>
<div class="alert alert-warning p-0 text-center"
     id="catalog-section-panel">

    <div class="row no-gutters">
        <div class="col col-percent-10 border-right border-secondary"></div>
        <div class="col-1 p-2 border-right border-secondary">
            <a href="<?=$APPLICATION->GetCurPageParam("sort=KOD", array("sort"));?>">
                <?=Loc::getMessage("SECTION_SORT_BY_KOD")?> <div class="icon icon-arrow"></div>
            </a>
        </div>
        <div class="col col-percent p-2 border-right border-secondary">
            <a href="<?=$APPLICATION->GetCurPageParam("sort=KOD", array("sort"));?>">
                <?=Loc::getMessage("SECTION_SORT_BY_ARTICLE")?> <div class="icon icon-arrow"></div>
            </a>
        </div>
        <div class="col-1 p-2 border-right border-secondary">
            <?=Loc::getMessage("SECTION_SORT_BY_SIZE")?>
        </div>
        <div class="col-1 p-2 border-right border-secondary">
            <?=Loc::getMessage("SECTION_SORT_BY_TYPE")?>
        </div>
        <div class="col-1 p-2 border-right border-secondary">
            <?=Loc::getMessage("SECTION_SORT_BY_VIEW")?>
        </div>
        <div class="col col-percent-10 p-2 border-right border-secondary">
            <a href="<?=$APPLICATION->GetCurPageParam("sort=KOD", array("sort"));?>">
                <?=Loc::getMessage("SECTION_SORT_BY_BREND")?> <div class="icon icon-arrow"></div>
            </a>
        </div>
        <div class="col col-percent-10 p-2 border-right border-secondary">
            <a href="<?=$APPLICATION->GetCurPageParam("sort=KOD", array("sort"));?>">
                <?=Loc::getMessage("SECTION_SORT_BY_AMOUNT")?>
            </a>
        </div>
        <div class="col col-percent-10 p-2 border-right border-secondary">
            <a href="<?=$APPLICATION->GetCurPageParam("sort=KOD", array("sort"));?>">
                <?=Loc::getMessage("SECTION_SORT_BY_PRICE")?> <div class="icon icon-arrow"></div>
            </a>
        </div>
        <div class="col-2 pt-1 pb-1">
            <a href="<?=$APPLICATION->GetCurPageParam("template=list", array("template"));?>"
               id="template-list"
               class="<?=$arResult["TEMPLATE"]=="list"?"template-type template-type-active":"template-type"?>"></a>
            <a href="<?=$APPLICATION->GetCurPageParam("template=tiles", array("template"));?>"
               id="template-tiles"
               class="<?=$arResult["TEMPLATE"]=="tiles"?"template-type template-type-active":"template-type"?>"></a>
        </div>
    </div>









</div>