<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Demo\AdminHelper\Citrus\AdminInterface\NewsEditHelper;
use Demo\AdminHelper\Citrus\AdminInterface\NewsListHelper;
use Demo\AdminHelper\Citrus\AdminInterface\PackagesEditHelper;
use Demo\AdminHelper\Citrus\AdminInterface\PackagesListHelper;

if (!Loader::includeModule('demo.adminhelper')) return;

Loc::loadMessages(__FILE__);

return array(
    array(
        'parent_menu' => 'global_menu_services',
        "section" => "citrus_packages",
        'sort' => 50,
        'icon' => 'xdimport_menu_icon',
        'page_icon' => 'xdimport_menu_icon',
        'text' => Loc::getMessage("CITRUS_AREALTY_MENU"),
        "module_id" => "citrus.arealty",
        "items_id" => "menu_citrus_arealty",
        'items' => array(
            array(
                "text" => Loc::getMessage("CITRUS_AREALTY_MENU_PACKAGES"),
                "items_id" => "menu_citrus_packages",
                "items" => array(
                    array(
                        "url" => PackagesListHelper::getUrl(),
                        "text" => Loc::getMessage("CITRUS_AREALTY_MENU_PACKAGES_HISTORY"),
                        "more_url" => array(
                            PackagesEditHelper::getUrl(),
                        ),
                    ),
                    array(
                        "url" => NewsListHelper::getUrl(),
                        "text" => Loc::getMessage("CITRUS_AREALTY_MENU_PACKAGES_MAIN"),
                        "more_url" => array(
                            NewsEditHelper::getUrl(),
                        ),
                    ),
                ),
            )
        )
    )
);