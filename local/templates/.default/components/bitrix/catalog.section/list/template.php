<?
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
use Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
    <div class="mb-2"><?=$arResult["NAV_STRING"]?></div>
<?endif?>
<div id="catalog-section-list">
<?foreach($arResult["LIST"] as $key=>$val): ?>
    <? if($key != "NO_VAR"): ?>

        <div class="row no-gutters mt-4">
            <div class="col-2 pr-5">
                <div class="preview-picture"
                     data-src="<?=$val[0]["DETAIL_PICTURE"]["SRC"]?>">
                    <?if(is_array($val[0]["PREVIEW_PICTURE"])):?>
                        <img src="<?=$val[0]["PREVIEW_PICTURE"]["SRC"]?>"
                             class="preview-picture-img img-fluid"
                             onclick="previewPicture.show(this.parentNode)"
                             width="<?=$val[0]["PREVIEW_PICTURE"]["WIDTH"]?>"
                             height="<?=$val[0]["PREVIEW_PICTURE"]["SRC"]["HEIGHT"]?>"
                             title="<?=$val[0]["PREVIEW_PICTURE"]["TITLE"]?>"
                             alt="<?=$val[0]["PREVIEW_PICTURE"]["ALT"]?>">
                    <?else:?>
                        <img src="<?=$templateFolder?>/images/no_photo.png"
                             class="preview-picture-img img-fluid"
                             onclick="previewPicture.show(this.parentNode)"
                             width="80"
                             height="80"
                             title="<?=$val[0]["NAME"]?>"
                             alt="<?=$val[0]["NAME"]?>">
                    <?endif;?>
                </div>
            </div>
            <div class="col">
                <a href="<?=$$val[0]["DETAIL_PAGE_URL"]?>"
                   class="d-none d-lg-block h4 left-24 text-uppercase mb-3 color-black"><?=$val[0]["NAME"]?></a>

                <?
                $i = 0;
                foreach($val as $item):
                    $i++;
                    unset($a_sclad);
                    unset($b_sclad);
                    unset($c_sclad);
                    $a_sclad = $arResult["AMOUNT"]["1"][$item["ID"]];
                    $b_sclad = $arResult["AMOUNT"]["2"][$item["ID"]];
                    $c_sclad = $arResult["AMOUNT"]["3"][$item["ID"]];
                    ?>
                    <?d($item["DISPLAY_PROPERTIES"]["NEW"]["DISPLAY_VALUE"])?>
                <div class="row no-gutters bg-warning pt-1 pb-1 mb-1 text-center align-items-center">
                    <div class="col-10">
                        <div class="row no-gutters align-items-center"
                             onclick="return link('<?=$val[0]["DETAIL_PAGE_URL"]?>')">
                            <div class="col-5">
                                <div class="row no-gutters">

                                    <div class="col-3">
                                        <?=$item["PROPERTIES"]["KOD"]["VALUE"];?>
                                    </div>
                                    <div class="col-4">
                                        <?=$item["PROPERTIES"]["ARTICLE"]["VALUE"]?>
                                    </div>
                                    <div class="col-5">
                                        <?=$item["DISPLAY_PROPERTIES"]["TIPORAZMER"]["DISPLAY_VALUE"]?>
                                    </div>
                                </div>

                            </div>
                            <div class="col-1" onclick="return link('<?=$val[0]["DETAIL_PAGE_URL"]?>')">уп./шт.</div>
                            <div class="col-6">
                                <div class="row no-gutters align-items-center">
                                    <div class="col-3">
                                        <?=$item["DISPLAY_PROPERTIES"]["BREND"]["DISPLAY_VALUE"];?>
                                    </div>
                                    <div class="col-3" onclick="return link('<?=$val[0]["DETAIL_PAGE_URL"]?>')">

                                        <?
                                        switch ($arParams["SCLAD"]){
                                            case 1:
                                                echo amount_see($a_sclad);
                                                break;
                                            case 2:
                                                amount_see($b_sclad);
                                                break;
                                            case 3:
                                                amount_see($c_sclad);
                                                break;
                                        }
                                        ?>
                                    </div>
                                    <div class="col-3">
                                        <?=$item["MIN_PRICE"]["PRINT_VALUE"];?>
                                    </div>
                                    <div class="col-3">

                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                    <form class="col"
                          action="<?=POST_FORM_ACTION_URI?>"
                          method="post">

                        <div class="row no-gutters">
                            <div class="col">
                                <a href="#" class="pointer icon-counter h4 col-4 p-0" onclick="return quantityCounter(this.parentNode.parentNode, false)">&minus;</a>
                                <input value="1"
                                       class="input-counter-min col-4 text-center"
                                       name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>"
                                       type="text">
                                <a href="#" class="pointer icon-counter h4 col-4 p-0" onclick="return quantityCounter(this.parentNode, true)">+</a>
                            </div>
                            <div class="col">
                                <input type="hidden" name="<?=$arParams["ACTION_VARIABLE"]?>" value="BUY">
                                <input type="hidden" name="<?=$arParams["PRODUCT_ID_VARIABLE"]?>" value="<?=$item["ID"]?>">
                                <input type="hidden" name="<?=$arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?=Loc::getMessage("CATALOG_ADD")?>">
                                <input type="submit" class="btn btn-danger btn-sm" value="">
                            </div>
                        </div>




                    </form>
                </div>

                <?endforeach;?>

                <div class="left-24 mt-3 d-none d-md-block">
                    <?if(!empty($item["DISPLAY_PROPERTIES"]["BREND"])):?>
                        <span class="padding-right-15">
                                <span class="color-orange"><?=$item["DISPLAY_PROPERTIES"]["BREND"]["NAME"]?>:</span>
                                <b><?=$item["DISPLAY_PROPERTIES"]["BREND"]["DISPLAY_VALUE"]?></b>
                            </span>
                    <?endif;?>
                    <?if(!empty($item["DISPLAY_PROPERTIES"]["GARANTIYA"])):?>
                        <span class="padding-right-15">
                                <span class="color-orange"><?=$item["DISPLAY_PROPERTIES"]["GARANTIYA"]["NAME"]?>:</span>
                                <b><?=$item["DISPLAY_PROPERTIES"]["GARANTIYA"]["DISPLAY_VALUE"]?></b>
                            </span>
                    <?endif;?>

                    <span class="doc padding-right-15"> <a href="#"><?=Loc::getMessage("CATALOG_SERT")?></a></span>

                    <span class="doc padding-right-15"> <a href="#"><?=Loc::getMessage("CATALOG_PASPORT")?></a></span>
                </div>

            </div>

        </div>

    <? endif; ?>

    <? if($key == "NO_VAR"):?>


        <div class="row no-gutters mt-4">
            <div class="col-2 pr-5">
                <div class="preview-picture"
                     data-src="<?=$item["DETAIL_PICTURE"]["SRC"]?>">
                    <?if(is_array($item["PREVIEW_PICTURE"])):?>
                        <img src="<?=$item["PREVIEW_PICTURE"]["SRC"]?>"
                             class="preview-picture-img"
                             onclick="previewPicture.show(this.parentNode)"
                             width="<?=$item["PREVIEW_PICTURE"]["WIDTH"]?>"
                             height="<?=$item["PREVIEW_PICTURE"]["SRC"]["HEIGHT"]?>"
                             title="<?=$item["PREVIEW_PICTURE"]["TITLE"]?>"
                             alt="<?=$item["PREVIEW_PICTURE"]["ALT"]?>">
                    <?else:?>
                        <img src="<?=$templateFolder?>/images/no_photo.png"
                             class="preview-picture-img"
                             onclick="previewPicture.show(this.parentNode)"
                             width="80"
                             height="80"
                             title="<?=$item["NAME"]?>"
                             alt="<?=$item["NAME"]?>">
                    <?endif;?>
                </div>
            </div>
            <div class="col">

                <a href="<?=$item["DETAIL_PAGE_URL"]?>"
                   class="d-none d-lg-block h4 left-24 text-uppercase mb-3 color-black"><?=$item["NAME"]?></a>

                <div class="row no-gutters bg-warning pt-1 pb-1 mb-1 text-center align-items-center">
                    <div class="col-10">
                        <div class="row no-gutters align-items-center"
                             onclick="return link('<?=$item["DETAIL_PAGE_URL"]?>')">
                            <div class="col-5">
                                <div class="row no-gutters">

                                    <div class="col-3">
                                        <?=$item["DISPLAY_PROPERTIES"]["KOD"]["DISPLAY_VALUE"];?>
                                    </div>
                                    <div class="col-4">
                                        <?=$item["DISPLAY_PROPERTIES"]["ARTICLE"]["DISPLAY_VALUE"]?>
                                    </div>
                                    <div class="col-5">
                                        <?=$item["DISPLAY_PROPERTIES"]["TIPORAZMER"]["DISPLAY_VALUE"]?>
                                    </div>
                                </div>

                            </div>
                            <div class="col-1" onclick="return link('<?=$item["DETAIL_PAGE_URL"]?>')">
                                <?=$item["DISPLAY_PROPERTIES"]["UPK"]["DISPLAY_VALUE"]?>
                            </div>
                            <div class="col-6">
                                <div class="row no-gutters align-items-center">
                                    <div class="col-3">
                                        <?=$item["DISPLAY_PROPERTIES"]["BREND"]["DISPLAY_VALUE"]?>
                                    </div>
                                    <div class="col-3" onclick="return link('<?=$item["DETAIL_PAGE_URL"]?>')">

                                        <?
                                        switch ($arParams["SCLAD"]){
                                            case 1:
                                                echo amount_see($a_sclad);
                                                break;
                                            case 2:
                                                amount_see($b_sclad);
                                                break;
                                            case 3:
                                                amount_see($c_sclad);
                                                break;
                                        }
                                        ?>
                                    </div>
                                    <div class="col-3">
                                        <?=$item["MIN_PRICE"]["PRINT_VALUE"];?>
                                    </div>
                                    <div class="col-3">

                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                    <form class="col"
                          action="<?=POST_FORM_ACTION_URI?>"
                          method="post">

                        <div class="row no-gutters">
                            <div class="col">
                                <a href="#" class="pointer icon-counter h4 col-4 p-0" onclick="return quantityCounter(this.parentNode.parentNode, false)">&minus;</a>
                                <input value="1"
                                       class="input-counter-min col-4 text-center"
                                       name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>"
                                       type="text">
                                <a href="#" class="pointer icon-counter h4 col-4 p-0" onclick="return quantityCounter(this.parentNode, true)">+</a>
                            </div>
                            <div class="col">
                                <input type="hidden" name="<?=$arParams["ACTION_VARIABLE"]?>" value="BUY">
                                <input type="hidden" name="<?=$arParams["PRODUCT_ID_VARIABLE"]?>" value="<?=$item["ID"]?>">
                                <input type="hidden" name="<?=$arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?=Loc::getMessage("CATALOG_ADD")?>">
                                <input type="submit" class="btn btn-danger btn-sm" value="">
                            </div>
                        </div>




                    </form>
                </div>

                <div class="left-24 mt-3 d-none d-md-block">
                    <?if(!empty($item["DISPLAY_PROPERTIES"]["BREND"])):?>
                        <span class="padding-right-15">
                                <span class="color-orange"><?=$item["DISPLAY_PROPERTIES"]["BREND"]["NAME"]?>:</span>
                                <b><?=$item["DISPLAY_PROPERTIES"]["BREND"]["DISPLAY_VALUE"]?></b>
                            </span>
                    <?endif;?>
                    <?if(!empty($item["DISPLAY_PROPERTIES"]["GARANTIYA"])):?>
                        <span class="padding-right-15">
                                <span class="color-orange"><?=$item["DISPLAY_PROPERTIES"]["GARANTIYA"]["NAME"]?>:</span>
                                <b><?=$item["DISPLAY_PROPERTIES"]["GARANTIYA"]["DISPLAY_VALUE"]?></b>
                            </span>
                    <?endif;?>

                    <span class="doc padding-right-15"> <a href="#"><?=Loc::getMessage("CATALOG_SERT")?></a></span>

                    <span class="doc padding-right-15"> <a href="#"><?=Loc::getMessage("CATALOG_PASPORT")?></a></span>
                </div>



            </div>

        </div>

    <? endif; ?>

<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <div class="mt-5"><?=$arResult["NAV_STRING"]?></div>
<?endif?>