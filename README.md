# MountainBreeze
A Wordpress theme template for the modern web developer.

# Features
- [Tailwind CSS](https://tailwindcss.com) baked in
- [Alpine JS](https://github.com/alpinejs/alpine) baked in
- [The Laravel Blade templating engine](https://laravel.com/docs/6.x/blade)
- [Laravel Collections](https://laravel.com/docs/6.x/collections)
- [Laravel Mix](https://laravel-mix.com)
- jQuery removed by default

# Getting started
We've made Mountain Breeze super quick to get up and running, allowing you to start developing your theme in seconds.

Requirements:
- Composer
- NPM

From the `wp-content/themes` directory of your Wordpress development environment, run 

```bash
composer create-project lukeraymonddowning/mountain-breeze
```

If you want to do things manually, clone, fork or download the repository to your Wordpress 'wp-content/themes' directory.

Then, from the theme directory, run ```$ composer install``` from the terminal or command prompt. The theme will automatically run ```$ npm install``` for you and even build the needed stylesheets for you.

# Our motivation
Wordpress powers over 1/3rd of the internet, which is just insane when you think about it. Whilst it
is a powerful platform with a low barrier to entry, we also think it can be a messy platform, 
and parts of it are beginning to show their age. 

Especially when compared to a framework like Laravel, Wordpress can become a burden to develop in. 
But it doesn't have to be. In fact, with just a little tweaking, you can have the best of both worlds.

This is our *opinionated* Wordpress theme setup. These opinions come from years of developing with Wordpress
and Laravel, of using jQuery and Alpine, of using Bootstrap and Tailwind, and from seeing what made our lives as developers easier.

We include libraries that we think truly add value, remove ones we feel don't, 
and give you the flexibility to make any adjustments you want.

Our thanks goes to the many creators and contributors behind Laravel, Tailwind CSS, Alpine JS and all of
their components for providing such an outstanding experience for web developers. Without them, none of this
would be possible.

Happy coding!

# Building assets
Mountain Breeze builds your style.css and js files using Laravel Mix. This allows you to use the latest
Javascript features and advanced CSS.

To build your assets for development, run ```$ npm run dev``` from the theme directory in the terminal.

When you're ready for production, run ```$ npm run prod``` from the theme directory in the terminal. This
will minify and prepare your files ready for go live.

# Using Blade
Mountain Breeze ships with Blade support baked in. Blade is a powerful templating engine provided in the 
Laravel framework, and developers love it for the power it offers whilst remaining easy and enjoyable
to use.

All blade files are stored in the theme's 'templates' directory. Mountain Breeze can automatically detect
which wordpress template file it should use and, if a matching blade file exists, will use that instead.
You don't even have to include the corresponding template file (eg: page.php) in the root directory.

We have already done this for you for the index.php file, which you can find at 'templates/index.blade.php'.

But it gets even better. The Wordpress Loop is one of the most common patterns in Wordpress development.
To help with this, Mountain Breeze includes a custom blade directive: ```@loop```. This allows you to 
quickly implement the Wordpress loop in any template file. Here is an example:

```
<div>
    @loop
        <h3>{{ the_title(); }}</h3>
        <p>{{ the_excerpt(); }}</p>
    @endloop
</div>
```

Pretty awesome, huh?

For more details on using blade, check out the documentation at https://laravel.com/docs/6.x/blade

# Using Tailwind
Tailwind is baked right into Mountain Breeze, and you can start using it right away. In fact, 
you can check out our example index file in 'templates/index.blade.php' to see it in use.

If you would like to customise Tailwind, you can edit the included tailwind.config.js file.
Available options can be found at https://tailwindcss.com/docs/configuration

# Using Alpine
Alpine is baked right into Mountain Breeze, and you can start using it right away. In fact,
you can check out our example index file in 'templates/index.blade.php' to see it in use.

# Using Collections
Laravel Collections provide an awesome wrapper around arrays, and provide many useful utilities
to make developing easier. You can create a Collection by calling the ```collect(array $array)```
helper function.

For more details on using collections, check out the documentation at https://laravel.com/docs/6.x/collections

# Using Mix
Laravel Mix is a webpack wrapper that take the complexity out of webpack. Especially for newer developers,
webpack can be one of the biggest hurdles to development, but the power it offers cannot be taken lightly.

Mix takes all the pain out of webpack, leaving you with the power you need. Our default mix configuration
should suffice for most projects, but if you want to customise it further, check out the documentation at
https://laravel-mix.com

# No jQuery?
jQuery has been and always will be close to our hearts. For years, it was the only real way to endure
javascript development on the web. But the web has finally caught up, and the problems that once plagued
it don't really exist anymore. Especially for simple Wordpress sites, jQuery is nothing more than an
unnecessary burden that hogs resources and user bandwidth.

We believe libraries like Alpine JS offer a much nicer syntax at a much lower cost, so we opted to remove
jQuery by default in the theme. 

If you really can't do without it, you can get it back by pasting the following code in your functions.php file:

```
public function enablejQuery()
{
    return true;
}
``` 
