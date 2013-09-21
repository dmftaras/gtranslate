<?php
require 'gtranslate.class.php';

$a = new GTranslate();
$a->SetInLang("en");
$a->SetOutLang("zh-CN");
echo $a->translate("My name is John");

?>