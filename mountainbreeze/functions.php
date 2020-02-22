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

function mountain_breeze_enqueue()
{
    wp_deregister_script('jquery');
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_script('app', get_stylesheet_directory_uri() . '/dist/app.js');
}

add_action('wp_enqueue_scripts', 'mountain_breeze_enqueue');

function mountain_breeze_load_blade_view($template)
{
    $templateName = wp_basename($template, '.php');
    if (getBladeViewFactory()->exists($templateName)) {
        $GLOBALS['template_name'] = $templateName;
        $template = __DIR__ . '/../mountainbreeze/index.php';
    }

    return $template;
}

add_filter('template_include', 'mountain_breeze_load_blade_view');

function getBladeViewFactory()
{
    $filesystem = new Filesystem;
    $eventDispatcher = new Dispatcher(new Container);

    $viewResolver = new EngineResolver;
    $bladeCompiler = new BladeCompiler($filesystem, getCompiledTemplateDirectory());

    $viewResolver->register('blade', function () use ($bladeCompiler) {
        return new CompilerEngine($bladeCompiler);
    });

    $viewResolver->register('php', function () {
        return new PhpEngine;
    });

    $viewFinder = new FileViewFinder($filesystem, getTemplateDirectory());
    return new Factory($viewResolver, $viewFinder, $eventDispatcher);
}

function getTemplateDirectory()
{
    return [__DIR__ . '/../templates/'];
}

function getCompiledTemplateDirectory()
{
    return __DIR__ . '/../compiled/';
}
