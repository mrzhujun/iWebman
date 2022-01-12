<?php
/**
 * User: ZhuJun
 * Date: 2021/12/17
 * Time: 下午 06:51
 * Email: mr.zhujun1314@gmail.com
 */

use Dotenv\Dotenv;
use Webman\Bootstrap;
use Webman\Config;

require_once __DIR__ . '/../vendor/autoload.php';
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