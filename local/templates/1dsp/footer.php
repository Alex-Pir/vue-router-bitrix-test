<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="footer__block col-6 col-lg-auto">
				<!--Основное меню-->
				<div class="footer__title">Наше меню</div>
				<div class="footer__content menu menu_main-footer">
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"footer_menu",
						array(
							"ROOT_MENU_TYPE" => "footer_menu",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "36000000"
						), false
					);?>
				</div>
				<!--КОНЕЦ Основное меню-->
      </div>
      <div class="footer__block col-6 col-lg-auto">
				<!--Каталог-->
        <div class="footer__title">Наш каталог</div>
        <div class="footer__content menu menu_catalog-footer">
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"footer_menu",
						array(
							"ROOT_MENU_TYPE" => "catalog",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "36000000",
							"USE_EXT" => "Y"
						), false
					);?>
        </div>
				<!--КОНЕЦ Каталог-->
      </div>
      <div class="footer__block col-12 col-sm-6 col-lg-auto">
        <div class="footer__title">Наши контакты</div>
        <div class="footer__content">
          <div>
            <span class="footer__span">Люблино: </span>
            <span class="footer__link calltouch__phone calltouch__phone_light">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/contacts_phone_main.php"
								), false
							);?>
						</span>
          </div>
          <div>
            <span class="footer__span">Сущевка: </span>
            <span class="footer__link calltouch__phone_light">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/contacts_phone_sub.php"
								), false
							);?>
						</span>
          </div>
          <br/>
          <div>
            <span class="footer__span">Продажа: </span>
            <span class="footer__link">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/contacts_mail_main.php"
								), false
							);?>
						</span>
          </div>
          <div>
            <span class="footer__span">Распил: </span>
            <span class="footer__link">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/contacts_mail_raspil.php"
								), false
							);?>
						</span>
          </div>
        </div>
      </div>
      <div class="footer__block col-12 order-sm-1 col-lg col-xl-3">
        <div class="footer__title">Наши адреса</div>
        <div class="footer__content">
          <div>
            <span class="footer__span">Главный офис:</span><br/>
            <?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/contacts_address_main.php"
							), false
						);?>
          </div>
          <div>
            <span class="footer__span">Дополнительный офис:</span><br/>
            <?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/contacts_address_sub.php"
							), false
						);?>
          </div>
          <div>
            <span class="footer__span">Склад:</span><br/>
            <?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/contacts_address_storehouse.php"
							), false
						);?>
          </div>
        </div>
      </div>
      <div class="footer__block col-12 col-sm-6 col-lg order-lg-1">
        <div class="footer__title">Данные компании</div>
        <div class="footer__content">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR."include/contacts_requisites.php"
						), false
					);?>
        </div>
      </div>
      <div class="footer__separator col-12 order-1"></div>
      <div class="footer__copyright col-12 order-1">
				Первый ДСП &copy; 2009 - <?echo date('Y')?><br /><br/>
        Вся информация на сайте – собственность компании Первый ДСП.<br/>
        Публикация информации с сайта 1DSP.ru без разрешения запрещена. Все права защищены.
      </div>
      <div class="col-12 col-sm-6 order-1">
        <a class="footer__link footer__link_bottom" href="/about/privacy/" rel="nofollow">Политика конфиденциальности</a>
      </div>
      <div class="col-12 col-sm-6 order-1">
        <a class="footer__link footer__link_bottom" href="/about/terms/" rel="nofollow">Пользовательское соглашение</a>
      </div>
      <div class="col-12 order-1 footer__gk-rf">Сайт не является публичной офертой согласно положениям статьи 437 ГК РФ</div>
    </div>
  </div>
</footer>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
	  "AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/modal.php"
  ),
  false
);?>

	</body>
</html>