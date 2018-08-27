<?
/**
 * @var array $arParams
 * @var array $arResult
 */
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>
<div id="in_lc" class="bg-warning border border-success">

    <div class="alert alert-success pt-4">
        <div class="text-uppercase mt-1 mb-2 text-center"><?=Loc::getMessage("ITEMS_TITLE")?></div>
        <?=Loc::getMessage("ITEMS_DESCRIPTION")?>
        <div class="mt-2 row no-gutters justify-content-between align-items-center">
            <div class="col-auto"><?=Loc::getMessage("ITEMS_SORT_TITLE")?></div>
            <form class="col-auto">
                <select name="sort_r"
                        class="form-control white">
                    <option value="PROPERTY_KOD" <?=($_REQUEST["sort_r"]=="PROPERTY_KOD")?"selected":""?>><?=Loc::getMessage("ITEMS_SORT_KOD")?></option>
                    <option value="NAME" <?=($_REQUEST["sort_r"]=="NAME")?"selected":""?>><?=Loc::getMessage("ITEMS_SORT_NAME")?></option>
                    <option value="SHOW_COUNTER" <?=($_REQUEST["sort_r"]=="SHOW_COUNTER")?"selected":""?>><?=Loc::getMessage("ITEMS_SORT_SHOW_COUNTER")?></option>
                </select>
            </form>
        </div>
    </div>


    <div class="border-bottom border-danger pb-2">
        <?foreach($arResult["SECTIONS"] as $arSection):?>
            <div class="text-bold d-block ml-md-5"><?=$arSection["NAME"]?></div>

            <?foreach($arResult["ITEMS"] as $key => $arItem):?>
                <?if($arItem["IBLOCK_SECTION_ID"] == $arSection["ID"]):?>
                    <div class="row no-gutters mt-1 mb-1">
                        <div class="col-2">
                            <?=$arItem["PROPERTIES"]["KOD"]["VALUE"]?>
                        </div>
                        <div class="col">
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="color-base"><?=$arItem["NAME"]?></a>
                        </div>
                        <form class="col text-right" action="/lc/" method="post">
                            <input type="hidden" name="action" value="BUY">
                            <input type="hidden" name="id" value="">
                            <input type="hidden" name="actionADD2BASKET" value="В корзину">
                            <input type="submit" class="btn btn-danger btn-sm" value="">
                        </form>

                    </div>
                    <?
                    unset($arResult["ITEMS"][$key]);
                endif;
                ?>
            <?endforeach;?>

        <?endforeach;?>

        <?if(!empty($arResult["ITEMS"])):?>
            <div class="text-bold d-block ml-md-5"><?=Loc::getMessage("ITEMS_ATHERS")?></div>
            <?foreach($arResult["ITEMS"] as $key => $arItem):?>
                <div class="row no-gutters mt-1 mb-1">
                    <div class="col-2">
                        <?=$arItem["PROPERTIES"]["KOD"]["VALUE"]?>
                    </div>
                    <div class="col">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="color-base"><?=$arItem["NAME"]?></a>
                    </div>
                    <a href="<?=$arItem["ADD_URL"]?>" class="btn btn-danger btn-sm"></a>
                </div>
            <?endforeach;?>
        <?endif;?>
    </div>

    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <div class="mt-3"><?=$arResult["NAV_STRING"]?></div>
    <?endif?>
</div>

