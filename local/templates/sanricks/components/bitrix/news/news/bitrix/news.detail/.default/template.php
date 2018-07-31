<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
?>
<h1 class="news__h1 text-center-xs hidden-print"><?=$arResult["NAME"]?></h1>
<div class="slider__item slider__item--detail">
	<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="" class="hidden-sm hidden-xs visible-print">

	<? if($arResult["PROPERTIES"]["IMG_TITLE"]["VALUE"] || $arResult["PROPERTIES"]["IMG_TITLE_2"]["VALUE"]):?>
		<div class="slider__caption slider__caption--detail">
			<div class="slider__caption--title slider__caption--title-small"><div class="h2"><span class="color-black"><? echo $arResult["PROPERTIES"]["IMG_TITLE"]["VALUE"]; ?> </span> <? echo $arResult["PROPERTIES"]["IMG_TITLE_2"]["VALUE"]; ?></div></div>
			<div class="slider__caption--desc"><? echo $arResult["PROPERTIES"]["IMG_TXT"]["VALUE"]; ?></div>
		</div>
	<? endif; ?>
</div>
<?echo $arResult["DETAIL_TEXT"];?>

<?$this->SetViewTarget("event_bottom");?>
	<div class="description">
		<div class="row">
			<div class="col-lg-12"><div class="description__date hidden-xs"><?echo $arResult["DISPLAY_ACTIVE_FROM"]?></div></div>
		</div>
	</div>
<?$this->EndViewTarget();?>


