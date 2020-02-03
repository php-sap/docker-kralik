<?php
$configFile = __DIR__ . DIRECTORY_SEPARATOR . 'sap.json';
/**
 * Determine whether the file exists or not.
 */
if (file_exists($configFile) !== true) {
    throw new RuntimeException(sprintf(
        'Cannot find config file %s! Create one from the template.',
        $configFile
    ));
}
/**
 * Try to read the configuration file.
 */
if (($configJson = file_get_contents($configFile)) === false) {
    throw new RuntimeException(sprintf(
        'Cannot read from config file %s!',
        $configFile
    ));
}
$config = json_decode($configJson, true);
if (!is_array($config)) {
    throw new RuntimeException(sprintf(
        'Invalid format of config file %s!',
        $configFile
    ));
}
echo 'Calling RFC_PING ... ';
$connection = new \SAPNWRFC\Connection($config);
$function = $connection->getFunction('RFC_PING');
$result = $function->invoke();
echo 'OK.' . PHP_EOL;
