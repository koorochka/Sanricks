<?
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>
<div class="bg-warning border border-success text-center">
    <div class="row align-items-center">
        <div class="pt-3 pb-3 col"><b><?=Loc::getMessage("CATALOG_KOD")?></b></div>
        <div class="pt-3 pb-3 col"><b><?=Loc::getMessage("CATALOG_ARTICLE")?></b></div>
        <div class="pt-3 pb-3 col col-lg-3"><b><?=Loc::getMessage("CATALOG_NAME")?></b></div>
        <div class="pt-3 pb-3 col col-lg-2"><b><?=Loc::getMessage("CATALOG_TIPORAZMER")?></b></div>
        <div class="pt-3 pb-3 col col-lg-2"><b><?=Loc::getMessage("CATALOG_BREND")?></b></div>
        <div class="pt-3 pb-3 col"></div>
    </div>
    <?foreach ($arResult['ITEMS'] as $item):?>
        <div class="row align-items-center">

            <div class="pt-3 pb-3 col">
                <?=$item["PROPERTIES"]["KOD"]["VALUE"]?>
            </div>

            <div class="pt-3 pb-3 col">
                <?=$item["PROPERTIES"]["ARTICLE"]["VALUE"]?>
            </div>

            <a href="<?=$item["DETAIL_PAGE_URL"]?>"
               class="pt-3 pb-3 col col-lg-3 text-left">
                <?=$item["NAME"]?>
            </a>


            <div class="pt-3 pb-3 col col-lg-2">
                <?=$item["PROPERTIES"]["TIPORAZMER"]["VALUE"]?>
            </div>
            <div class="pt-3 pb-3 col col-lg-2 text-left">
                <?=$item["DISPLAY_PROPERTIES"]["BREND"]["DISPLAY_VALUE"]?>
            </div>

            <form class="pt-3 pb-3 col"
                  onsubmit="sanricksWait()"
                  action="<?=$arParams["PAGE"]?>"
                  method="post">
                <input type="hidden" name="<?=$arParams["ACTION_VARIABLE"]?>" value="BUY">
                <input type="hidden" name="<?=$arParams["PRODUCT_ID_VARIABLE"]?>" value="<?=$item["ID"]?>">
                <input type="hidden" name="<?=$arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?=Loc::getMessage("CATALOG_ADD")?>">
                <input type="submit" class="btn btn-danger btn-sm" value="">
            </form>

        </div>
    <?endforeach;?>
</div>