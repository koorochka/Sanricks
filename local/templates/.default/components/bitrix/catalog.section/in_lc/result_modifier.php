<?
/**
 * @var array $arResult
 * @var array $arParams
 */
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Iblock\SectionTable;

$sections = array();
$arResult["SECTIONS"] = array();

foreach($arResult["ITEMS"] as $arItem){
	if($arItem["IBLOCK_SECTION_ID"] > 0){
        $sections[$arItem["IBLOCK_SECTION_ID"]] = $arItem["IBLOCK_SECTION_ID"];
	}
}
if($sections){

    $sections = SectionTable::getList(array(
        "filter" => array(
            "IBLOCK_ID"=>$arParams["IBLOCK_ID"],
            "ID"=>$sections
        ),
        "select" => array(
            "ID",
            "NAME"
        )
    ));
    while ($section = $sections->fetch()){
        $arResult["SECTIONS"][$section["ID"]] = $section;
    }

}
?>