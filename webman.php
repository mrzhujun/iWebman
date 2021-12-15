<?php
/**
 * User: ZhuJun
 * Date: 2021/12/15
 * Time: 上午 11:57
 * Email: mr.zhujun1314@gmail.com
 */
#!/usr/bin/env php

use Dotenv\Dotenv;
use Symfony\Component\Console\Application as Cli;
use Webman\Bootstrap;
use Webman\Config;

require_once __DIR__ . '/vendor/autoload.php';

if (class_exists('Dotenv\Dotenv')) {
    if (method_exists('Dotenv\Dotenv', 'createUnsafeImmutable')) {
        Dotenv::createUnsafeImmutable(base_path())->load();
    } else {
        Dotenv::createMutable(base_path())->load();
    }
}
Config::load(config_path(), ['route', 'container']);
if ($timezone = config('app.default_timezone')) {
    date_default_timezone_set($timezone);
}
foreach (config('autoload.files', []) as $file) {
    include_once $file;
}
foreach (config('bootstrap', []) as $class_name) {
    /** @var Bootstrap $class_name */
    $class_name::start(null);
}

$cli = new Cli();
$cli->setName('webman命令行工具');

$dir_iterator = new \RecursiveDirectoryIterator(app_path() . DIRECTORY_SEPARATOR . 'command');
$iterator = new \RecursiveIteratorIterator($dir_iterator);
foreach ($iterator as $file) {
    if (is_dir($file)) {
        continue;
    }
    $class_name = str_replace(DIRECTORY_SEPARATOR, '\\',substr(substr($file, strlen(base_path())), 0, -4));
    if (!is_a($class_name, \Symfony\Component\Console\Command\Command::class, true)) {
        continue;
    }
    $cli->add(new $class_name);
}
$cli->run();