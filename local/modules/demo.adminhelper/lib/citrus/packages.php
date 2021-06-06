<?php

namespace Demo\AdminHelper\Citrus;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type\DateTime;

Loc::loadMessages(__FILE__);

/**
 * Модель категорий новостей.
 */
class PackagesTable extends DataManager
{
    /**
     * @inheritdoc
     */
    public static function getTableName()
    {
        return 'd_ah_packages';
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
                'autocomplete' => true,
            ),
            'PACKAGE_ID' => array(
                'data_type' => 'integer',
                'title' => Loc::getMessage('DEMO_AH_NEWS_CATEGORIES_PARENT_ID')
            ),
            'DATE_INSERT' => array(
                'data_type' => 'datetime',
                'title' => Loc::getMessage('DEMO_AH_NEWS_CATEGORIES_DATE_CREATE'),
                'default_value' => new DateTime()
            ),
            'TITLE' => array(
                'data_type' => 'string',
                'title' => Loc::getMessage('DEMO_AH_NEWS_CATEGORIES_TITLE')
            ),
            'PACKAGE' => array(
                'data_type' => '\Demo\AdminHelper\Citrus\NewsTable',
                'reference' => array('=this.PACKAGE_ID' => 'ref.ID'),
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
     * Gets current user ID.
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
