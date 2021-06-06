<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? 
	define("SITE_SERVER_PROTOCOL", (CMain::IsHTTPS()) ? "https://" : "http://"); // Переменная определяет протокол, по которому работает ваш сайт
	$curPage = $APPLICATION->GetCurPage(); // Получаем текущий адрес страницы
?>
<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
	<head>
		<title><?$APPLICATION->ShowTitle()?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">

		<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon.ico" />

		<meta property="og:url" content="<?=SITE_SERVER_PROTOCOL . SITE_SERVER_NAME . $curPage?>">
		<meta property="og:type" content="website">
		<meta property="og:title" content="<?$APPLICATION->ShowTitle()?>">
		<meta property="og:description" content="<?=$APPLICATION->ShowProperty("description")?>">
		<meta property="og:image" content="<?=SITE_TEMPLATE_PATH?>/images/favicon/og-image.jpg">

		<meta name="theme-color" content="#ffffff" />
  	<link rel="icon" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon.ico" />
  	<link rel="icon" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon.svg" sizes="any" type="image/svg+xml" />
  	<link rel="icon" type="image/png" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-16x16.png" sizes="16x16" />
  	<link rel="icon" type="image/png" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-32x32.png" sizes="32x32" />
  	<link rel="icon" type="image/png" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-48x48.png" sizes="48x48" />
  	<link rel="icon" type="image/png" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-96x96.png" sizes="96x96" />
  	<link rel="icon" type="image/png" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-144x144.png" sizes="144x144" />
  	<link rel="icon" type="image/png" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-192x192.png" sizes="192x192" />
  	<link rel="icon" type="image/png" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-256x256.png" sizes="256x256" />
  	<link rel="icon" type="image/png" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-384x384.png" sizes="384x384" />
  	<link rel="icon" type="image/png" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-512x512.png" sizes="512x512" />
  	<link rel="apple-touch-icon" sizes="57x57" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-57x57.png" />
  	<link rel="apple-touch-icon" sizes="60x60" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-60x60.png" />
  	<link rel="apple-touch-icon" sizes="72x72" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-72x72.png" />
  	<link rel="apple-touch-icon" sizes="76x76" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-76x76.png" />
  	<link rel="apple-touch-icon" sizes="114x114" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-114x114.png" />
  	<link rel="apple-touch-icon" sizes="120x120" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-120x120.png" />
  	<link rel="apple-touch-icon" sizes="144x144" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-144x144.png" />
  	<link rel="apple-touch-icon" sizes="152x152" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-152x152.png" />
  	<link rel="apple-touch-icon" sizes="167x167" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-167x167.png" />
  	<link rel="apple-touch-icon" sizes="180x180" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-180x180.png" />
  	<link rel="mask-icon" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon.svg" color="#96e349" />
  	<meta name="application-name" content="1dsp.ru" />
  	<meta name="msapplication-tooltip" content="1dsp.ru" />
  	<meta name="msapplication-TileColor" content="#ffffff" />
  	<meta name="msapplication-TileImage" content="<?=SITE_TEMPLATE_PATH?>/images/favicon/ms-tile-260x260.png" />
  	<meta name="msapplication-square70x70logo" content="<?=SITE_TEMPLATE_PATH?>/images/favicon/ms-tile-126x126.png" />
  	<meta name="msapplication-square150x150logo" content="<?=SITE_TEMPLATE_PATH?>/images/favicon/ms-tile-270x270.png" />
  	<meta name="msapplication-wide310x150logo" content="<?=SITE_TEMPLATE_PATH?>/images/favicon/ms-tile-558x270.png" />
  	<meta name="msapplication-square310x310logo" content="<?=SITE_TEMPLATE_PATH?>/images/favicon/ms-tile-558x558.png" />

  	<meta name="msapplication-config" content="browserconfig.xml" />
  	<link rel="manifest" href="<?=SITE_DIR?>manifest.json" />



		<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/1dsp_scripts.js"); ?>
		<? $APPLICATION->ShowMeta('keywords'); ?>
		<? $APPLICATION->ShowMeta('description'); ?>
		<? $APPLICATION->ShowHeadStrings(); ?>
		<? $APPLICATION->ShowCSS(); ?>
		<? $APPLICATION->ShowHeadScripts(); ?>

		<? $a_user = getUserPhone(); ?>
		<script type="text/javascript">
			window.clientIP = "<? echo $_SERVER['REMOTE_ADDR']; ?>";
    		window.clientPhone = "<?=$a_user['phone']?>";
    		window.clientAgent = "<?=$a_user['agent']?>";
    		window.clientTS = "<?=$a_user['ts']?>";
    		window.clientTSU = "<?=$a_user['ts_u']?>";
  		</script>
  		<!-- Google Tag Manager -->
    	<script>
    		(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true; j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl; f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-KMGLRR');
    	</script>
    	<!-- End Google Tag Manager -->
	</head>
	<body>
		<script type="text/javascript" >
    		(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
    		m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    		(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    		ym(1738447, "init", {
    			clickmap:true,
    			trackLinks:true,
    			accurateTrackBounce:true,
    			webvisor:true,
    			trackHash:true,
    			ecommerce:"dataLayer"
    		});
		</script>
		<noscript><div><img src="https://mc.yandex.ru/watch/1738447" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
		<!-- Google Tag Manager (noscript) -->
		<noscript>
    		<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KMGLRR" height="0" width="0" style="display:none;visibility:hidden"></iframe>
		</noscript>
		<!-- End Google Tag Manager (noscript) -->
		<!--Панель админа-->
		<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
		<!--КОНЕЦ Панель админа-->

		<!--Спрайт иконок-->
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR."include/sprite_icon.php"
			), false
		);?>
		<!--КОНЕЦ Спрайт иконок-->

		<!--Хидер-->
		<header class="header">
			<!--Верхняя панель-->
  		<div class="header__topbar">
    		<div class="container">
      		<div class="row header__topbar-block">
						<!--Основное меню-->
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu",
							"top_menu",
							array(
								"ROOT_MENU_TYPE" => "top",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_TIME" => "36000000",
								"CACHE_SELECTED_ITEMS" => "N"
							), false
						);?>
						<!--КОНЕЦ Основное меню-->
						<div class="header__user d-flex">
							<? if ($USER->IsAuthorized()) { ?>
								<a class="button_header-topbar" href="/personal/"><svg><title>Личный кабинет</title><use xlink:href="#user-personal"/></svg><span class="d-none d-md-block">Личный кабинет</span></a>
							<? } else { ?>
								<a class="button_header-topbar button_border-right" href="/login/?login=yes&backurl=%2F"><svg><title>Войти</title><use xlink:href="#user-login"/></svg><span class="d-none d-md-block">Вход</span></a>
								<a class="button_header-topbar" href="/login/?register=yes&backurl=%2F"><svg><title>Регистрация</title><use xlink:href="#user-add"/></svg><span class="d-none d-md-block">Регистрация</span></a>
							<? } ?>
						</div>
					</div>
				</div>
			</div>
			<!--КОНЕЦ Верхняя панель-->
			<!--Средняя панель-->
			<div class="header__middlebar">
    		<div class="container">
      		<div class="row align-items-center">
						<!--Логотип-->
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/logo.php"
							), false
						);?>
						<!--КОНЕЦ Логотип-->
						<div class="col-12 d-sm-none"></div>
						<!--Контакты-->
						<div class="header__contacts col col-md-5 col-lg-4 col-xl-3 row justify-content-around">
          		<div class="header__phone col-12 row">
            		<div class="header__phone-number col-12 calltouch__phone calltouch__phone_dark">
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										array(
											"AREA_FILE_SHOW" => "file",
											"PATH" => SITE_DIR."include/contacts_phone_main.php"
										), false
									);?>
								</div>
							</div>
          		<div class="col-12"></div>
          		<div class="col-9 col-sm-12 row justify-content-center">
            		<a target="blank" class="col-9 gtm-watsapp-button" href="https://api.whatsapp.com/send?phone=79067357874">
             			<svg style="display:inline-block;width:20px;height:20px;"><title>WhatsApp</title><use xlink:href="#icon-watsapp"/></svg>
              		WhatsApp
            		</a>
          		</div>
          		<div class="col-12"></div>
          		<div class="col-auto m-auto">
            		<div class="header__link js-modal-open" data-modal="callback">Заказать обратный звонок</div>
          		</div>
        		</div>
						<!--КОНЕЦ Контакты-->
						<!--Поиск-->
						<?$APPLICATION->IncludeComponent(
	"arturgolubev:search.title", 
	"1dsp", 
	array(
		"CATEGORY_0" => array(
			0 => "iblock_catalog",
			1 => "iblock_references",
		),
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0_forum" => array(
			0 => "all",
		),
		"CATEGORY_0_iblock_catalog" => array(
			0 => "2",
		),
		"CATEGORY_0_iblock_references" => array(
			0 => "4",
		),
		"CHECK_DATES" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONTAINER_ID" => "smart-title-search",
		"CONVERT_CURRENCY" => "N",
		"FILTER_NAME" => "",
		"INPUT_ID" => "smart-title-search-input",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "rank",
		"PAGE" => "#SITE_DIR#search/index.php",
		"PREVIEW_HEIGHT" => "75",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PREVIEW_WIDTH" => "75",
		"PRICE_CODE" => array(
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"SHOW_INPUT" => "Y",
		"SHOW_PREVIEW" => "Y",
		"SHOW_PREVIEW_TEXT" => "Y",
		"TOP_COUNT" => "5",
		"USE_LANGUAGE_GUESS" => "Y",
		"COMPONENT_TEMPLATE" => "1dsp"
	),
	false
);?>

						<!--КОНЕЦ Поиск-->							
					</div>
				</div>
			</div>
			<!--КОНЕЦ Средняя панель-->
			<!--Нижняя панель-->
			<div class="header__bottombar">
    		<div class="container">
					<!--Каталог-->
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"catalog_menu",
						array(
							"ROOT_MENU_TYPE" => "catalog",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "36000000",
							"USE_EXT" => "Y"
						), false
					);?>
					<!--КОНЕЦ Каталог-->
				</div>
			</div>
			<!--КОНЕЦ Нижняя панель-->
		</header>
		<!--КОНЕЦ Хидер-->
		