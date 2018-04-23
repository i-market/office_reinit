<?$iniDir = $_SERVER["DOCUMENT_ROOT"].'/local/php_interface/include/';
$arIncludes = Array(
    "constants",
    "modules",
    "events",
    "functions"
);
foreach($arIncludes as $include)
    if(file_exists("{$iniDir}{$include}.php"))
        require_once("{$iniDir}{$include}.php")?>