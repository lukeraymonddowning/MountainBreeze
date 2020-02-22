<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\View\Factory;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\View\FileViewFinder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Compilers\BladeCompiler;

add_action('wp_enqueue_scripts', function () {
    if (!function_exists('enablejQuery') || !enablejQuery()) {
        wp_deregister_script('jquery');
    }
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_script('app', get_stylesheet_directory_uri() . '/dist/app.js');
});

add_filter('template_include', function ($template) {
    $templateName = wp_basename(wp_basename($template, '.php'), '.blade');
    if (getBladeViewFactory()->exists($templateName)) {
        $GLOBALS['template_name'] = $templateName;
        $template = __DIR__ . '/../mountainbreeze/index.php';
    }

    return $template;
});

collect([
    'index',
    '404',
    'archive',
    'author',
    'category',
    'tag',
    'taxonomy',
    'date',
    'embed',
    'home',
    'frontpage',
    'privacypolicy',
    'page',
    'paged',
    'search',
    'single',
    'singular',
    'attachment'
])->each(function($type) {
    add_filter("{$type}_template_hierarchy", function($templates) {
        return collect($templates)->map(function($template) {
            $filename = wp_basename($template, '.php');
            return ["templates/$filename.blade.php", $template];
        })->flatten()
          ->toArray();
    });
});

function getBladeViewFactory()
{
    $filesystem = new Filesystem;
    $viewResolver = new EngineResolver;

    $viewResolver->register('blade', function () use ($filesystem) {
        return new CompilerEngine(new BladeCompiler($filesystem, getCompiledTemplateDirectory()));
    });

    $viewResolver->register('php', function () {
        return new PhpEngine;
    });

    return new Factory(
        $viewResolver,
        new FileViewFinder($filesystem, getTemplateDirectory()),
        new Dispatcher(new Container)
    );
}

function getTemplateDirectory()
{
    return [__DIR__ . '/../templates/'];
}

function getCompiledTemplateDirectory()
{
    return __DIR__ . '/../compiled/';
}
