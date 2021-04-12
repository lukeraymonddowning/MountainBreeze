let mix = require("laravel-mix");

mix.js(`src/scripts/app.js`, "dist/")
    .postCss(`src/styles/style.css`, "./", [require("tailwindcss")]);
