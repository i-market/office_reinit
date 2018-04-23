<?php
$arModules = Array(
    "iblock",
    "currency",
    "catalog",
    "sale",
    //"itinfinity.debug"
);
foreach($arModules as $module)
    Bitrix\Main\Loader::includeModule($module);