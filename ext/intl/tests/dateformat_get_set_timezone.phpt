--TEST--
IntlDateFormatter: get/setTimeZone()
--FILE--
<?php
ini_set("intl.error_level", E_WARNING);
ini_set("intl.default_locale", "pt_PT");
ini_set("date.timezone", 'Atlantic/Azores');

$ts = strtotime('2012-01-01 00:00:00 UTC');

function d(IntlDateFormatter $df) {
global $ts;
echo $df->format($ts), "\n";
var_dump(
$df->getTimeZoneID(),
$df->getTimeZone()->getID());
echo "\n";
}

$df = new IntlDateFormatter('pt_PT', 0, 0, 'Europe/Minsk');
d($df);

$df->setTimeZone(NULL);
d($df);

$df->setTimeZone('Europe/Madrid');
d($df);

$df->setTimeZone(IntlTimeZone::createTimeZone('Europe/Paris'));
d($df);

$df->setTimeZone(new DateTimeZone('Europe/Amsterdam'));
d($df);

?>
==DONE==
--EXPECT--
Domingo, 1 de Janeiro de 2012 3:00:00 GMT+03:00
string(12) "Europe/Minsk"
string(12) "Europe/Minsk"

Sábado, 31 de Dezembro de 2011 23:00:00 Hora Padrão dos Açores
string(15) "Atlantic/Azores"
string(15) "Atlantic/Azores"

Domingo, 1 de Janeiro de 2012 1:00:00 Hora Padrão da Europa Central
string(13) "Europe/Madrid"
string(13) "Europe/Madrid"

Domingo, 1 de Janeiro de 2012 1:00:00 Hora Padrão da Europa Central
string(12) "Europe/Paris"
string(12) "Europe/Paris"

Domingo, 1 de Janeiro de 2012 1:00:00 Hora Padrão da Europa Central
string(16) "Europe/Amsterdam"
string(16) "Europe/Amsterdam"

==DONE==
