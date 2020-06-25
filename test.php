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
/**
 * Create connection instance to SAP using the config.
 */
$connection = new \SAPNWRFC\Connection($config);
/**
 * First test: Call RFC_PING to see if remote function calls work.
 */
echo 'Calling RFC_PING ... ';
try {
    $rfcPing = $connection->getFunction('RFC_PING');
    $result = $rfcPing->invoke();
} catch (Exception $exception) {
    echo 'FAIL! ' . get_class($exception) . ': ' . $exception->getMessage() . PHP_EOL;
    exit(1);
}
echo 'OK.' . PHP_EOL;
/**
 * Second test step 1: Get the description of a remote function.
 */
echo 'Get description of RFC_WALK_THRU_TEST ... ';
$walkthrough = $connection->getFunction('RFC_WALK_THRU_TEST');
if (!method_exists($walkthrough, 'getFunctionDescription')) {
    echo 'FAIL! ' . get_class($walkthrough) . '::getFunctionDescription() doesn\'t exist.' . PHP_EOL;
    exit(1);
}
/**
 * Second test step 2: Rudimentary check whether the description is as expected.
 */
$description = $walkthrough->getFunctionDescription();
if (!is_array($description) || !array_key_exists('TEST_OUT', $description)) {
    echo 'FAIL! Cannout find TEST_OUT in description.' . PHP_EOL;
    exit(1);
}
if (!is_array($description['TEST_OUT'])
    || !array_key_exists('typedef', $description['TEST_OUT'])
) {
    echo 'FAIL! Cannout find TEST_OUT.typedef in description.' . PHP_EOL;
    exit(1);
}
if (!is_array($description['TEST_OUT']['typedef'])
    || !array_key_exists('RFCCHAR1', $description['TEST_OUT']['typedef'])
) {
    echo 'FAIL! Cannout find TEST_OUT.typedef.RFCCHAR1 in description.' . PHP_EOL;
    exit(1);
}
echo 'OK.' . PHP_EOL;
