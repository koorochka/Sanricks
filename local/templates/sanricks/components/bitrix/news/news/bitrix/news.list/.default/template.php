<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);

$max = 91;
?>
<div class="row" id="news-line">
	<?foreach($arResult["ITEMS"] as $arItem):
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

	?>



		<div class="col-lg-3 col-sm-4"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="news__item news__item--line">
				<div class="news__item--img">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$file['src']?>" alt=""></a>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="sticker hidden-xs <?if($arItem["PROPERTIES"]["METKI"]["VALUE"]=="sale"):?>sticker--action<? endif;?>"><? echo $svg; ?></a>
				</div>
				<div class="news__item--info">
					<h5 class="uppercase news__item--title"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__item--link"></a></h5>
					<p class="news__item--text">
						<span class="hidden-xs"><?=$arItem["PREVIEW_TEXT"]=substr($arItem["PREVIEW_TEXT"], 0, $max);?></span>...
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="link--more">читать далее</a>
					</p>
				</div>
				<div class="news__item--date hidden-sm"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>
			</div>
		</div>
	<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
