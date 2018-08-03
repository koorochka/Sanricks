<?
/**
 * @var CMain $APPLICATION
 */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");
?>
<?$APPLICATION->IncludeComponent("bitrix:search.page", "sanricks", Array(
	"COMPONENT_TEMPLATE" => "suggest",
		"RESTART" => "Y",	// Искать без учета морфологии (при отсутствии результата поиска)
		"NO_WORD_LOGIC" => "Y",	// Отключить обработку слов как логических операторов
		"CHECK_DATES" => "Y",	// Искать только в активных по дате документах
		"USE_TITLE_RANK" => "Y",	// При ранжировании результата учитывать заголовки
		"DEFAULT_SORT" => "rank",	// Сортировка по умолчанию
		"FILTER_NAME" => "",	// Дополнительный фильтр
		"arrFILTER" => array(	// Ограничение области поиска
			0 => "iblock_Catalogs",
		),
		"arrFILTER_iblock_Catalogs" => array(	// Искать в информационных блоках типа "iblock_Catalogs"
			0 => "1",
		),
		"SHOW_WHERE" => "N",	// Показывать выпадающий список "Где искать"
		"SHOW_WHEN" => "N",	// Показывать фильтр по датам
		"PAGE_RESULT_COUNT" => "50",	// Количество результатов на странице
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"USE_LANGUAGE_GUESS" => "N",	// Включить автоопределение раскладки клавиатуры
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над результатами
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под результатами
		"PAGER_TITLE" => "Результаты поиска",	// Название результатов поиска
		"PAGER_SHOW_ALWAYS" => "Y",	// Выводить всегда
		"PAGER_TEMPLATE" => "modern",	// Название шаблона
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>