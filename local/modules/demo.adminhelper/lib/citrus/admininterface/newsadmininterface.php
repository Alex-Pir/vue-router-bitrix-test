<?php

namespace Demo\AdminHelper\Citrus\AdminInterface;

use Bitrix\Main\Localization\Loc;
use DigitalWand\AdminHelper\Helper\AdminInterface;
use DigitalWand\AdminHelper\Widget\DateTimeWidget;
use DigitalWand\AdminHelper\Widget\FileWidget;
use DigitalWand\AdminHelper\Widget\NumberWidget;
use DigitalWand\AdminHelper\Widget\OrmElementWidget;
use DigitalWand\AdminHelper\Widget\StringWidget;
use DigitalWand\AdminHelper\Widget\UrlWidget;
use DigitalWand\AdminHelper\Widget\UserWidget;
use DigitalWand\AdminHelper\Widget\VisualEditorWidget;

Loc::loadMessages(__FILE__);

/**
 * Описание интерфейса (табок и полей) админки новостей.
 *
 * {@inheritdoc}
 */
class NewsAdminInterface extends AdminInterface
{
    /**
     * @inheritdoc
     */
    public function dependencies()
    {
        return array();
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return array(
            'MAIN' => array(
                'NAME' => Loc::getMessage('DEMO_AH_NEWS_TAB_TITLE'),
                'FIELDS' => array(
                    'ID' => array(
                        'WIDGET' => new NumberWidget(),
                        'READONLY' => true,
                        'FILTER' => true,
                        'HIDE_WHEN_CREATE' => true
                    ),
                    'TITLE' => array(
                        'WIDGET' => new StringWidget(),
                        'SIZE' => 80,
                        'FILTER' => '%',
                        'REQUIRED' => true
                    ),
                    'DATE_CREATE' => array(
                        'WIDGET' => new DateTimeWidget(),
                        'READONLY' => true,
                        'HIDE_WHEN_CREATE' => true
                    ),
                    'DATE_INSERT' => array(
                        'WIDGET' => new DateTimeWidget()
                    ),
                    'DATE_FINISHED' => array(
                        'WIDGET' => new DateTimeWidget()
                    ),
                    'CREATED_BY' => array(
                        'WIDGET' => new UserWidget(),
                        'READONLY' => true,
                        'HIDE_WHEN_CREATE' => true
                    ),
                    'MODIFIED_BY' => array(
                        'WIDGET' => new UserWidget(),
                        'READONLY' => true,
                        'HIDE_WHEN_CREATE' => true
                    )
                )
            )
        );
    }

    /**
     * @inheritdoc
     */
    public function helpers()
    {
        return array(
            '\Demo\AdminHelper\Citrus\AdminInterface\NewsListHelper' => array(
                'BUTTONS' => array(
                    'LIST_CREATE_NEW' => array(
                        'TEXT' => Loc::getMessage('DEMO_AH_NEWS_BUTTON_ADD_NEWS'),
                    ),
                    'LIST_CREATE_NEW_SECTION' => array(
                        'TEXT' => Loc::getMessage('DEMO_AH_NEWS_BUTTON_ADD_CATEGORY'),
                    )
                )
            ),
            '\Demo\AdminHelper\Citrus\AdminInterface\NewsEditHelper' => array(
                'BUTTONS' => array(
                    'ADD_ELEMENT' => array(
                        'TEXT' => Loc::getMessage('DEMO_AH_NEWS_BUTTON_ADD_NEWS')
                    ),
                    'DELETE_ELEMENT' => array(
                        'TEXT' => Loc::getMessage('DEMO_AH_NEWS_BUTTON_DELETE')
                    )
                )
            )
        );
    }
}