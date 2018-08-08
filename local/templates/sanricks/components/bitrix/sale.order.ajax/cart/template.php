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
        <div class="row mt-2 mb-2">
            <div class="col-12 col-lg-8">
                <input class="form-control"
                       placeholder="ФИО"
                       value="test fio"
                       name="name">
            </div>
        </div>
        <div class="row mt-2 mb-2">
            <div class="col-12 col-lg-8">
                <input class="form-control"
                       placeholder="Мобильный телефон"
                       value="test phone"
                       name="phone">
            </div>
        </div>
        <div class="row mt-2 mb-2">
            <div class="col-12 col-lg-8">
                <input class="form-control"
                       placeholder="e-mail"
                       value="test mail"
                       name="mail">
            </div>
        </div>
    </div>


    <div class="mb-3">
        <div class="d-inline-block border border-dark rounded rounded-circle section-number">2</div>
        <h2 class="h3 d-inline-block"><?=Loc::getMessage("ORDER_FORM_DELIVERY_TITLE")?></h2>
    </div>

    <!-- Nav tabs -->
    <ul id="lc-tabs" class="nav nav-tabs text-15 text-uppercase align-content-center">

        <?foreach ($arResult["DELIVERY"] as $arDelivery):?>
            <li class="nav-item">
                <a class="<?=($arResult["USER_VALS"]["DELIVERY_ID"] == $arDelivery["ID"]) ? "nav-link active" : "nav-link"?>"
                   href="<?=POST_FORM_ACTION_URI?>"><?=$arDelivery["NAME"]?></a>
            </li>
        <?endforeach;?>

    </ul>

    <!-- Tab panes -->
    <div id="lc-tabs-content" class="p-5">

        <div class="row align-items-center">
            <div class="col-12 col-sm-3 col-lg-2">
                <b>Адрес доставки</b>
            </div>
            <div class="col-12 col-sm-9 col-lg-6">
                <input class="form-control"
                       placeholder="Санкт-Петербург  ул. Благодатная 27 кв 48"
                       name="adress">
            </div>
        </div>

    </div>

    <div class="text-right pt-4 mt-3">
        <input type="submit"
               class="btn btn-danger text-uppercase pl-4 pr-4"
               value="<?=Loc::getMessage("ORDER_FORM_SUBMIT")?>">
    </div>
</form>

