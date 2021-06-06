<?php

namespace Demo\AdminHelper\Citrus\AdminInterface;

use DigitalWand\AdminHelper\Helper\AdminListHelper;

/**
 * Хелпер описывает интерфейс, выводящий список новостей.
 *
 * {@inheritdoc}
 */
class PackagesListHelper extends AdminListHelper
{
    protected static $model = '\Demo\AdminHelper\Citrus\PackagesTable';
}