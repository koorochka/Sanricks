<?
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
use Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->addExternalCss(SITE_TEMPLATE_PATH . "/css/lc.css");

if(empty($arResult["BASKET_ITEMS"])){
    require_once "empty.php";
    return false;
}
?>

<form id="order-form"
      action="<?=POST_FORM_ACTION_URI?>"
      method="POST"
      name="ORDER_FORM"
      enctype="multipart/form-data"
      onsubmit="return BX.saleOrderAjax.submit(this)">

    <?
    echo bitrix_sessid_post();

    if (strlen($arResult['PREPAY_ADIT_FIELDS']) > 0)
    {
        echo $arResult['PREPAY_ADIT_FIELDS'];
    }
    ?>
    <input type="hidden"
           name="json"
           value="Y">

    <input type="hidden"
           name="save"
           value="Y">

    <input type="hidden"
           name="via_ajax"
           value="Y">

    <input type="hidden"
           name="is_ajax_post"
           value="Y">

    <input type="hidden"
           id="DELIVERY_ID"
           name="DELIVERY_ID"
           value="<?=$arResult["USER_VALS"]["DELIVERY_ID"]?>">

    <input type="hidden"
           id="PAY_SYSTEM_ID"
           name="PAY_SYSTEM_ID"
           value="<?=$arResult["USER_VALS"]["PAY_SYSTEM_ID"]?>">

    <input type="hidden"
           name="PERSON_TYPE"
           value="1">

    <input type="hidden"
           name="<?=$arParams['ACTION_VARIABLE']?>"
           value="saveOrderAjax">

    <input type="hidden"
           name="location_type"
           value="code">

    <input type="hidden"
           name="BUYER_STORE"
           id="BUYER_STORE"
           value="<?=$arResult['BUYER_STORE']?>">

    <h1><?=Loc::getMessage("ORDER_FORM_TITLE")?></h1>

    <div class="mb-3">
        <div class="d-inline-block border border-dark rounded rounded-circle section-number">1</div>
        <h2 class="h3 d-inline-block"><?=Loc::getMessage("ORDER_FORM_USER_INFO_TITLE")?></h2>
    </div>
    <div class="alert alert-warning mb-5">

        <?
        foreach ($arResult["JS_DATA"]["ORDER_PROP"]["properties"] as $property):
            if(
                $property["CODE"] == "FIO" ||
                $property["CODE"] == "EMAIL" ||
                $property["CODE"] == "TEL"
            ):
        ?>
        <div class="row mt-2 mb-2">
            <div class="col-12 col-lg-8">
                <input class="form-control"
                       placeholder="<?=$property["NAME"]?> *"
                       <?if ($property["CODE"] == "TEL"):?>
                           onkeyup="inputPhoneModificator(this, event)"
                       <?endif;?>
                       value="<?=implode(" ", $property["VALUE"])?>"
                       name="ORDER_PROP_<?=$property["ID"]?>">
            </div>
        </div>
        <?
            endif;
        endforeach;
        ?>
    </div>


    <div class="mb-3">
        <div class="d-inline-block border border-dark rounded rounded-circle section-number">2</div>
        <h2 class="h3 d-inline-block"><?=Loc::getMessage("ORDER_FORM_DELIVERY_TITLE")?></h2>
    </div>





    <!-- Nav tabs -->
    <ul id="lc-tabs" class="nav nav-tabs text-15 text-uppercase align-content-center">

        <?foreach ($arResult["DELIVERY"] as $arDelivery):?>
            <li class="nav-item">
                <a class="pointer <?=($arResult["USER_VALS"]["DELIVERY_ID"] == $arDelivery["ID"]) ? "nav-link active" : "nav-link"?>"
                   onclick="BX.saleOrderAjax.tab(<?=$arDelivery["ID"]?>, this)"><?=$arDelivery["NAME"]?></a>
            </li>
        <?endforeach;?>

    </ul>

    <!-- Tab panes -->
    <div id="lc-tabs-content" class="p-5">

        <div class="mb-2 for-delyvery for-delyvery-2 for-delyvery-4 <?
        if($arResult["USER_VALS"]["DELIVERY_ID"] == 2 || $arResult["USER_VALS"]["DELIVERY_ID"] == 4){
            echo "d-block";
        }else{
            echo "d-none";
        }?>">
            <div class="row align-items-center">
                <?
                foreach ($arResult["JS_DATA"]["ORDER_PROP"]["properties"] as $property):
                    if($property["CODE"] == "ADRESS"):
                ?>
                        <div class="col-12 col-sm-3 col-lg-2">
                            <b><?=$property["NAME"]?></b>
                        </div>
                        <div class="col-12 col-sm-9 col-lg-6">
                            <input class="form-control"
                                   placeholder="<?=$property["DESCRIPTION"]?>"
                                   value="<?=implode(" ", $property["VALUE"])?>"
                                   name="ORDER_PROP_<?=$property["ID"]?>">
                        </div>
                <?
                    endif;
                endforeach;
                ?>
            </div>
        </div>

        <?if($arResult["JS_DATA"]["PAY_SYSTEM"]):?>
            <div class="mb-2 for-delyvery for-delyvery-2 for-delyvery-3 <?
            if($arResult["USER_VALS"]["DELIVERY_ID"] == 2 || $arResult["USER_VALS"]["DELIVERY_ID"] == 3){
                echo "d-block";
            }else{
                echo "d-none";
            }?>">
                <b class="d-block mb-2"><?=Loc::getMessage("ORDER_PAY_SYSTEM")?></b>
                <div id="PAY_SYSTEM_BLOCK">
                <?foreach ($arResult["JS_DATA"]["PAY_SYSTEM"] as $arItem):?>
                    <div class="form-check p-0">
                        <label class="checkbox">
                            <input id="PAY_SYSTEM_<?=$arItem["ID"]?>"
                                   onchange="BX.saleOrderAjax.paySystem(<?=$arItem["ID"]?>, this)"
                                   value="<?=$arItem["ID"]?>"
                                   type="checkbox"><span></span>
                        </label>
                        <label class="form-check-label" for="PAY_SYSTEM_<?=$arItem["ID"]?>"><?=$arItem["NAME"]?></label>
                    </div>
                <?endforeach;?>
                </div>
            </div>
        <?endif;?>

        <div class="for-delyvery for-delyvery-2 for-delyvery-3 <?
        if($arResult["USER_VALS"]["DELIVERY_ID"] == 2 || $arResult["USER_VALS"]["DELIVERY_ID"] == 3){
            echo "d-block";
        }else{
            echo "d-none";
        }?>">
            <?
            foreach ($arResult["JS_DATA"]["ORDER_PROP"]["properties"] as $property):
                if($property["TYPE"] == "FILE"):
            ?>
            <div class="row">
                <div class="col-12 col-md-9 col-lg-8">
                    <div class="custom-file">
                        <input name="ORDER_PROP_<?=$property["ID"]?>"
                               class="custom-file-input"
                               size="0"
                               type="file"><span class="bx-input-file-desc"></span>
                        <label class="custom-file-label" for="ORDER_PROP_<?=$property["ID"]?>"><?=$property["NAME"]?></label>
                    </div>
                </div>
            </div>
            <?
                endif;
            endforeach;
            ?>
        </div>

        <?if($arResult["JS_DATA"]["STORE_LIST"]):?>
            <div class="mt-4 for-delyvery for-delyvery-3 <?
            if($arResult["USER_VALS"]["DELIVERY_ID"] == 3){
                echo "d-block";
            }else{
                echo "d-none";
            }?>">
                <b class="d-block mb-2"><?=Loc::getMessage("ORDER_STORE_TITLE")?></b>
                <input type="hidden"
                       id="ORDER_PROP_7"
                       name="ORDER_PROP_7"
                       value="<?=$arResult["USER_VALS"]["ORDER_PROP"][7]?>">

                <div id="STORE_LIST_BLOCK">
                    <?foreach ($arResult["JS_DATA"]["STORE_LIST"] as $arItem):?>
                        <div class="form-check p-0">
                            <label class="checkbox">
                                <input id="STORE_LIST_<?=$arItem["ID"]?>"
                                       name="STORE_LIST_<?=$arItem["ID"]?>"
                                       onchange="BX.saleOrderAjax.store('<?=$arItem["ADDRESS"]?>', this)"
                                       value="<?=$arItem["ID"]?>"
                                       type="checkbox">
                                <span></span>
                            </label>
                            <label class="form-check-label" for="STORE_LIST_<?=$arItem["ID"]?>"><?=$arItem["ADDRESS"]?></label>
                        </div>
                    <?endforeach;?>
                </div>
            </div>
        <?endif;?>

    </div>

    <div class="text-right pt-4 mt-3">
        <input type="submit"
               class="btn btn-danger text-uppercase pl-4 pr-4"
               value="<?=Loc::getMessage("ORDER_FORM_SUBMIT")?>">
    </div>
</form>

<?
/*
unset($arResult["JS_DATA"]);
unset($arResult["GRID"]);
unset($arResult["BASKET_ITEMS"]);
*/

//d($arResult["JS_DATA"]["ORDER_PROP"]["properties"]);
//d($arResult["JS_DATA"]["STORE_LIST"]);
//d($arResult["JS_DATA"]["BASKET_ITEMS"]);
//d($arResult["USER_VALS"]);

?>