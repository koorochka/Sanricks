<?
/** @var array $arParams */
/** @var array $arResult */

foreach($arResult["ITEMS"] as $key => $arItem){
    $arItem["PREVIEW_PICTURE"] = CFile::ResizeImageGet(
        $arItem["PREVIEW_PICTURE"],
        array("width"=>280,"height" => 180),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true
    );
    $arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["SRC"] = $arItem["PREVIEW_PICTURE"]["src"];
    $arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["WIDTH"] = $arItem["PREVIEW_PICTURE"]["width"];
    $arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["HEIGHT"] = $arItem["PREVIEW_PICTURE"]["height"];
}
?>