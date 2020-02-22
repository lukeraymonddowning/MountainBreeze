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
    wp_deregister_script('jquery');
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_script('app', get_stylesheet_directory_uri() . '/dist/app.js');
});

add_filter('template_include', function ($template) {
    $templateName = wp_basename($template, '.php');
    if (getBladeViewFactory()->exists($templateName)) {
        $GLOBALS['template_name'] = $templateName;
        $template = __DIR__ . '/../mountainbreeze/index.php';
    }

    return $template;
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
