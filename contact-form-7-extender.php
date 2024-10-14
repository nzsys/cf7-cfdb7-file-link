<?php declare(strict_types=1);
/*
Plugin Name: Contact Form 7 and CFDB7 Extender
Description: This extension for Contact Form 7 and its plugin CFDB7 adds a link to a file in the email body.
Version: 1.0
Author: nzsys
*/

include __DIR__ . '/src/Container/DIContainer.php';
include __DIR__ . '/src/ServiceProvider.php';
include __DIR__ . '/src/Main/Extender.php';

$container = new DIContainer;
$serviceProvider = new ServiceProvider($container);

$container->get(Extender::class);
