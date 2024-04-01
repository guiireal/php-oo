<?php

require_once 'Preferences.php';

$preferences = Preferences::getInstance();

echo $preferences->getProperty('lang');

$preferences->setProperty('lang', 'pt');

$preferences->save();

echo $preferences->getProperty('lang');

$preferences2 = Preferences::getInstance();

echo $preferences2->getProperty('lang');