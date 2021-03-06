<?php

/**
 * Contao Open Source CMS
 */

/**
 * @file tl_content.php
 * @author Sascha Weidner
 * @version 2.3
 * @package sioweb.contao.extensions.glossar
 * @copyright Sascha Weidner, Sioweb
 */

/* Contao 3.2 support */
if (empty($GLOBALS['glossar']['headlineUnit'])) {
	$this->loadLanguageFile('default');
}

/**
 * Dynamically add the permission check and parent table
 */

if (Input::get('do') == 'glossar') {
	$GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_sw_glossar';
	$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['headerFields'] = ['type', 'title', 'jumpTo', 'tstamp'];
}

$GLOBALS['TL_DCA']['tl_content']['palettes']['glossar'] = '{type_legend},type,glossar,sortGlossarBy,termAsHeadline,useInitialAsDelimitter,differentGlossarDetailPage;{glossartags_legend:hide},glossarShowTags,glossarShowTagsDetails;{pagination_legend:hide},perPage;{alphapagination_legend:hide},addAlphaPagination';
$GLOBALS['TL_DCA']['tl_content']['palettes']['glossar_reader'] = '{type_legend},type';
$GLOBALS['TL_DCA']['tl_content']['palettes']['glossar_cloud'] = '{type_legend},type,glossar';

$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'addAlphaPagination';
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'termAsHeadline';
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'differentGlossarDetailPage';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['addAlphaPagination'] = 'addNumericPagination,showAfterChoose,addOnlyTrueLinks,paginationPosition';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['termAsHeadline'] = 'headlineUnit';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['differentGlossarDetailPage'] = 'jumpToGlossarTerm';

$GLOBALS['TL_DCA']['tl_content']['fields']['glossar'] = [
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['glossar'],
	'default'                 => 'alias',
	'inputType'               => 'select',
	'foreignKey'              => 'tl_glossar.title',
	'eval'                    => ['tl_class' => 'w50', 'includeBlankOption' => true],
	'sql'                     => "varchar(20) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['sortGlossarBy'] = [
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['sortGlossarBy'],
	'default'                 => 'alias',
	'inputType'               => 'select',
	'options'                 => ['id' => 'ID', 'id_desc' => 'ID umgekehrt', 'date' => 'Datum', 'date_desc' => 'Datum umgekehrt', 'alias' => 'Alias', 'alias_desc' => 'Alias umgekehrt'],
	'reference'               => &$GLOBALS['glossar']['sortGlossarBy'],
	'eval'                    => ['tl_class' => 'w50'],
	'sql'                     => "varchar(20) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['headlineUnit'] = [
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['headlineUnit'],
	'inputType'               => 'select',
	'options'                 => array_keys((array)$GLOBALS['TL_LANG']['glossar']['headlineUnit']),
	'reference'               => &$GLOBALS['TL_LANG']['glossar']['headlineUnit'],
	'eval'                    => ['tl_class' => 'w50 clr'],
	'sql'                     => "varchar(20) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['addAlphaPagination'] = [
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['addAlphaPagination'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => ['submitOnChange' => true],
	'sql'                     => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['addNumericPagination'] = [
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['addNumericPagination'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'sql'                     => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['paginationPosition'] = [
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['paginationPosition'],
	'default'                 => 'after',
	'inputType'               => 'select',
	'options'                 => array_keys((array)$GLOBALS['TL_LANG']['glossar']['paginationPositions']),
	'reference'               => &$GLOBALS['TL_LANG']['glossar']['paginationPositions'],
	'eval'                    => ['tl_class' => 'w50 clr'],
	'sql'                     => "varchar(20) NOT NULL default 'after'",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['addOnlyTrueLinks'] = [
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['addOnlyTrueLinks'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => ['submitOnChange' => true],
	'sql'                     => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['showAfterChoose'] = [
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['showAfterChoose'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => ['submitOnChange' => true],
	'sql'                     => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['termAsHeadline'] = [
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['termAsHeadline'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => ['tl_class' => 'w50 clr', 'submitOnChange' => true],
	'sql'                     => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['useInitialAsDelimitter'] = [
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['useInitialAsDelimitter'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => ['tl_class' => 'w50 clr'],
	'sql'                     => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['glossarShowTags'] = [
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['glossarShowTags'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => ['tl_class' => 'w50 clr', 'submitOnChange' => true],
	'sql'                     => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['glossarShowTagsDetails'] = [
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['glossarShowTagsDetails'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => ['tl_class' => 'w50', 'submitOnChange' => true],
	'sql'                     => "char(1) NOT NULL default ''",
];


$GLOBALS['TL_DCA']['tl_content']['fields']['differentGlossarDetailPage'] = [
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['differentGlossarDetailPage'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => ['tl_class' => 'w50 clr', 'submitOnChange' => true],
	'sql'                     => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['jumpToGlossarTerm'] = [
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['jumpToGlossarTerm'],
	'exclude'                 => true,
	'inputType'               => 'pageTree',
	'foreignKey'              => 'tl_page.title',
	'eval'                    => ['tl_class' => 'w50 clr', 'fieldType' => 'radio'],
	'sql'                     => "int(10) unsigned NOT NULL default 0",
	'relation'                => ['type' => 'hasOne', 'load' => 'lazy'],
];
