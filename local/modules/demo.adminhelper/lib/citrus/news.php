<?php

namespace Demo\AdminHelper\Citrus;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type\DateTime;

Loc::loadMessages(__FILE__);

/**
 * Модель новостей.
 */
class NewsTable extends DataManager
{
    /**
     * @inheritdoc
     */
    public static function getTableName()
    {
        return 'd_ah_news';
    }

    /**
     * @inheritdoc
     */
    public static function getMap()
    {
        return array(
            'ID' => array(
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true
            ),
            'DATE_CREATE' => array(
                'data_type' => 'datetime',
                'title' => Loc::getMessage('DEMO_AH_NEWS_DATE_CREATE'),
                'default_value' => new DateTime()
            ),
            'DATE_INSERT' => array(
                'data_type' => 'datetime',
                'title' => Loc::getMessage('DEMO_AH_NEWS_DATE_INSERT')
            ),
            'DATE_FINISHED' => array(
                'data_type' => 'datetime',
                'title' => Loc::getMessage('DEMO_AH_NEWS_DATE_FINISHED')
            ),
            'CREATED_BY' => array(
                'data_type' => 'integer',
                'title' => Loc::getMessage('DEMO_AH_NEWS_CREATED_BY'),
                'default_value' => static::getUserId()
            ),
            'MODIFIED_BY' => array(
                'data_type' => 'integer',
                'title' => Loc::getMessage('DEMO_AH_NEWS_MODIFIED_BY'),
                'default_value' => static::getUserId()
            ),
            'TITLE' => array(
                'data_type' => 'string',
                'title' => Loc::getMessage('DEMO_AH_NEWS_TITLE')
            )
        );
    }

    /**
     * @inheritdoc
     */
    public static function update($primary, array $data)
    {
        $data['MODIFIED_BY'] = static::getUserId();

        return parent::update($primary, $data);
    }

    /**
     * Возвращает идентификатор пользователя.
     *
     * @return int|null
     */
    public static function getUserId()
    {
        global $USER;

        return $USER->GetID();
    }

    public static function getFilePath()
    {
        return __FILE__;
    }
}
