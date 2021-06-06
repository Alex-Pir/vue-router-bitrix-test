<? use Bitrix\Main\UI\Extension;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

Extension::load([
	'citrus.vue.vue-select',
	'citrus.vue.vue-form.fields',
	'citrus.vue.order.location',
]);