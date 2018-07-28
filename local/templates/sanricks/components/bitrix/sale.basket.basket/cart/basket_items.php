<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @var array $arUrls */
/** @var array $arHeaders */
use Bitrix\Sale\DiscountCouponsManager;

if (!empty($arResult["ERROR_MESSAGE"]))
	ShowError($arResult["ERROR_MESSAGE"]);

$bDelayColumn  = false;
$bDeleteColumn = false;
$bWeightColumn = false;
$bPropsColumn  = false;
$bPriceType    = false;

if ($normalCount > 0):

?>
<div id="basket_items_list" class="row mb10 mb0-xs">
	<div class="bx_ordercart_order_table_container col-xs-12">
		<table class="style_row_td table__sort hidden-xs">
			<colgroup><col width="auto" /><col class="col11" width="152" /><col class="col12" width="140" /><col class="col13" width="188" /><col class="col14" width="212" /></colgroup>
			<thead><tr><th></th><th>Цена</th><th>Количество</th><th>Сумма</th><th></th></tr></thead>
		</table>


		<table id="basket_items" class="style_row_td table__sort table__basket last">
			<colgroup><col class="col15 hidden-sm hidden-lg" width="89" /><col width="auto" /><col class="col11 hidden-xs" width="152" /><col class="col12" width="140" /><col class="col13 hidden-xs" width="188" /><col class="col14 hidden-xs" width="212" /></colgroup>
			<thead>
				<tr>
					<?
					foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):
						$arHeaders[] = $arHeader["id"];

						// remember which values should be shown not in the separate columns, but inside other columns
						if (in_array($arHeader["id"], array("TYPE")))
						{
							$bPriceType = true;
							continue;
						}

						elseif ($arHeader["id"] == "DELETE")
						{
							$bDeleteColumn = true;
							continue;
						}


						?>
					<?
					endforeach;

					?>
				</tr>
			</thead>
			<tbody>
				<?
$items = 0;
				$skipHeaders = array('PROPS', 'DELAY', 'DELETE', 'TYPE');

				foreach ($arResult["GRID"]["ROWS"] as $k => $arItem):

					if ($arItem["DELAY"] == "N" && $arItem["CAN_BUY"] == "Y"):

										if (strlen($arItem["PREVIEW_PICTURE_SRC"]) > 0):
											$url = $arItem["PREVIEW_PICTURE_SRC"];
										elseif (strlen($arItem["DETAIL_PICTURE_SRC"]) > 0):
											$url = $arItem["DETAIL_PICTURE_SRC"];
										else:
											$url = $templateFolder."/images/no_photo.png";
										endif;

$items++;
$items_c += $arItem["QUANTITY"];
$arItem[SUM] = str_replace(" ", "", $arItem[SUM]);
$arItem[SUM] = str_replace("руб.", "", $arItem[SUM]);
$arItem[SUM] = number_format($arItem[SUM], 2, '.', '');
					?>
					<tr id="<?=$arItem["ID"]?>"
						 data-item-name="<?=$arItem["NAME"]?>"
						 data-item-brand="<?=$arItem[$arParams['BRAND_PROPERTY']."_VALUE"]?>"
						 data-item-price="<?=$arItem["PRICE"]?>"
						 data-item-currency="<?=$arItem["CURRENCY"]?>"
					>
						<td class="hidden-xs">
							<div class="td__inner">
								<div class="basket__img"><img src="<?=$url?>" alt=""></div>
								<div class="basket__title hidden-xs"><a href="<?=$arItem["DETAIL_PAGE_URL"] ?>" class="basket__link"><?=$arItem["NAME"]?></a></div>
							</div>
						</td>
						<td class="hidden-xs">
							<div class="td__inner">
								<div class="basket__title hidden-sm hidden-lg"><a href="<?=$arItem["DETAIL_PAGE_URL"] ?>" class="basket__link"><?=$arItem["NAME"]?></a></div>
								<div class="product__item--price"><span class="td__price" id="current_price_<?=$arItem["ID"]?>"><?=$arItem["PRICE"]?></span> <span class="product__item--rub">руб.</span></div>
							</div>
						</td>


						<td>
							<div class="td__inner">
                                <div class="basket__img hidden-sm hidden-md hidden-lg moblile-cell"><img src="<?=$url?>" alt=""></div>
								<div class="counter">
									<?
										$ratio = isset($arItem["MEASURE_RATIO"]) ? $arItem["MEASURE_RATIO"] : 0;
										$useFloatQuantity = ($arParams["QUANTITY_FLOAT"] == "Y") ? true : false;
										$useFloatQuantityJS = ($useFloatQuantity ? "true" : "false");
										if (!isset($arItem["MEASURE_RATIO"]))
											$arItem["MEASURE_RATIO"] = 1;
									?>
									<input
										id="QUANTITY_INPUT_<?=$arItem["ID"]?>"
										name="QUANTITY_INPUT_<?=$arItem["ID"]?>"
										maxlength="18"
										value="<?=$arItem["QUANTITY"]?>"
										onchange="updateQuantity('QUANTITY_INPUT_<?=$arItem["ID"]?>', '<?=$arItem["ID"]?>', <?=$ratio?>, <?=$useFloatQuantityJS?>)"

									 type="text"  class="input--counter">

									<a href="javascript:void(0);" class="counter--link counter--plus" onclick="setQuantity(<?=$arItem["ID"]?>, <?=$arItem["MEASURE_RATIO"]?>, 'up', <?=$useFloatQuantityJS?>);">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" class="icon icon-counter"><g><line x1="0.5" y1="6" x2="11.5" y2="6" class="svg-counter"/><line x1="6" y1="0.5" x2="6" y2="11.5" class="svg-counter"/></g></svg>
									</a>
									<a href="javascript:void(0);" class="counter--link counter--minus" onclick="setQuantity(<?=$arItem["ID"]?>, <?=$arItem["MEASURE_RATIO"]?>, 'down', <?=$useFloatQuantityJS?>);">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 1" class="icon icon-counter"><line x1="0.5" y1="0.5" x2="11.5" y2="0.5" class="svg-counter"/></svg>
									</a>
									<input type="hidden" id="QUANTITY_<?=$arItem['ID']?>" name="QUANTITY_<?=$arItem['ID']?>" value="<?=$arItem["QUANTITY"]?>" />
								</div>
							</div>
						</td>
						<td>
							<div class="td__inner">
                                <div class="hidden-sm hidden-md hidden-lg text-left moblile-cell">
                                    <div class="basket__title"><a href="<?=$arItem["DETAIL_PAGE_URL"] ?>" class="basket__link"><?=$arItem["NAME"]?></a></div>
                                    <div class="product__item--price"><span class="td__price" id="current_price_<?=$arItem["ID"]?>"><?=$arItem["PRICE"]?></span> <span class="product__item--rub">руб.</span></div>
                                </div>
                                <div class="product__item--price"><span class="td__summ" id="current_summ_<?=$arItem["ID"]?>"><? echo $arItem["SUM"];?></span> <span class="product__item--rub">руб.</span></div>
							</div>
						</td>
						<td>
							<div class="td__inner">
								<a class="a__delete a__delete--basket" data-id="<? echo $arItem["ID"]; ?>" href="javascript:void(0);" >
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23" class="icon icon-delete icon-delete-big"><g><line class="line__delete" x1="1.09" y1="0.5" x2="22.5" y2="21.92"></line><line class="line__delete" x1="22.5" y1="0.5" x2="0.5" y2="22.5"></line></g></svg>
								</a>
							</div>
						</td>
					</tr>
					<?
					endif;
				endforeach;
				?>
			</tbody>
		</table>

	</div>
</div>
							<div class="row mb20 mb35-sm mb45-xs">
								<div class="col-lg-8 col-sm-6 col-xs-0">

								</div>
								<div class="col-lg-4 col-sm-6 col-xs-12 text-right">
									<a href="javascript:void(0)" class="a__print underline hidden-xs" onclick="window.print();">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 23" class="icon icon-print">
											<g>
												<g>
													<polyline class="svg-print1" points="17.5 2 17.5 7.5 24 7.5"/>
													<path class="svg-print2" d="M3.5,12V2.51c0-.87,2.84-2,3.73-2H17.56L24.5,6.89V12"/>
													<path class="svg-print2" d="M24.5,17v2.88c0,0.87-1.81,2.62-2.7,2.62H7.23c-0.89,0-3.73-1.75-3.73-2.62V17"/>
												</g>
												<path class="svg-print2" d="M28.5,20.5h-4V17.44l-21,0v3h-3V10.37c0-1.12,0-.87,1.16-0.87H3.5v3.2l21,0V9.5h2.7c1.15,0,1.3-.24,1.3.87V20.5Z"/>
												<ellipse class="svg-print2" cx="26.94" cy="10.84" rx="1.09" ry="1.06"/>
											</g>
										</svg><span>распечатать</span>
									</a>
									<a href="javascript:void(0)" class="a__delete a__delete-basket underline" onclick="delAll()">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23" class="icon icon-delete icon-delete-big">
											<g><line class="line__delete" x1="1.09" y1="0.5" x2="22.5" y2="21.92"></line><line class="line__delete" x1="22.5" y1="0.5" x2="0.5" y2="22.5"></line></g>
										</svg><span>удалить все товары</span>
									</a>
								</div>
							</div>

	<input type="hidden" id="column_headers" value="<?=htmlspecialcharsbx(implode($arHeaders, ","))?>" />
	<input type="hidden" id="offers_props" value="<?=htmlspecialcharsbx(implode($arParams["OFFERS_PROPS"], ","))?>" />
	<input type="hidden" id="action_var" value="<?=htmlspecialcharsbx($arParams["ACTION_VARIABLE"])?>" />
	<input type="hidden" id="quantity_float" value="<?=($arParams["QUANTITY_FLOAT"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="price_vat_show_value" value="<?=($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="hide_coupon" value="<?=($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="use_prepayment" value="<?=($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="auto_calculation" value="<?=($arParams["AUTO_CALCULATION"] == "N") ? "N" : "Y"?>" />

	<div class="row">
		<div class="col-lg-4 col-sm-5 col-xs-12 mb40-xs">
			<h4 class="uppercase block-base__title">Скидочный купон</h4>
			<div class="block-base" id="gifts-cupon">
				<div class="row mb25">
					<div class="col-lg-12"><input type="text" placeholder="пример 57748056889" class="input" id="coupon" name="COUPON" value="" onchange="enterCoupon();"></div>
				</div>
				<div class="row">
					<div class="col-lg-12"><input type="button"
                                                  onclick="enterCoupon();"
                                                  class="button button--large right"
                                                  value="Пересчитать"></div>
				</div>
			</div>
			<?
				if (!empty($arResult['COUPON_LIST']))
				{
					foreach ($arResult['COUPON_LIST'] as $oneCoupon)
					{
						$couponClass = 'disabled';
						switch ($oneCoupon['STATUS'])
						{
							case DiscountCouponsManager::STATUS_NOT_FOUND:
							case DiscountCouponsManager::STATUS_FREEZE:
								$couponClass = 'bad';
								break;
							case DiscountCouponsManager::STATUS_APPLYED:
								$couponClass = 'good';
								break;
						}
						?><div class="bx_ordercart_coupon"><input disabled readonly type="text" name="OLD_COUPON[]" value="<?=htmlspecialcharsbx($oneCoupon['COUPON']);?>" class="<? echo $couponClass; ?>"><span class="<? echo $couponClass; ?>" data-coupon="<? echo htmlspecialcharsbx($oneCoupon['COUPON']); ?>"></span><div class="bx_ordercart_coupon_notes"><?
						if (isset($oneCoupon['CHECK_CODE_TEXT']))
						{
							echo (is_array($oneCoupon['CHECK_CODE_TEXT']) ? implode('<br>', $oneCoupon['CHECK_CODE_TEXT']) : $oneCoupon['CHECK_CODE_TEXT']);
						}
						?></div></div><?
					}
					unset($couponClass, $oneCoupon);
				}
			?>
		</div>
		<div class="col-lg-4 col-sm-2 col-xs-0"></div>
		<div class="col-lg-4 col-sm-5 col-xs-12">
			<h4 class="uppercase color-black block-base__title">ИТОГО</h4>
			<div class="block-base text-center">
				<div class="row"><div class="col-lg-12">
					<span class="count"><span class="count__num" id="count__num"><? echo $items_c; ?></span> товаров</span>
					<span class="count"><span class="count__num"><? echo $items; ?></span> наименования</span>
				</div></div>

				<div class="row">
					<div class="col-lg-12"><h4 class="uppercase color-base">на сумму</h4></div>
				</div>
<?
$arResult[allSum_FORMATED] = str_replace(" ", "", $arResult[allSum_FORMATED]);
$arResult[allSum_FORMATED] = str_replace("руб.", "", $arResult[allSum_FORMATED]);
?>
				<div class="row mb15"><div class="col-lg-12"><div class="product__item--price product__item--price-big">
					<span class="td__summ td__summ-big" id="allSum_FORMATED"><?=$arResult[allSum_FORMATED];?></span> <span class="product__item--rub product__item--rub-big">руб.</span>
				</div></div></div>

				<div class="row"><div class="col-lg-12">
						<input type="submit" class="button button--large button-submit right" value="оформить" onclick="checkOut();" class="checkout">
				</div></div>
			</div>
		</div>
	</div>


<?
else:
?>
<div id="basket_items_list">
	<table>
		<tbody>
			<tr>
				<td style="text-align:center">
					<div class=""><?=GetMessage("SALE_NO_ITEMS");?></div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<?
endif;