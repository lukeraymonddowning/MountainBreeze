let mix = require("laravel-mix");
let purgecss = require("@fullhuman/postcss-purgecss");

mix.js(`src/scripts/app.js`, "dist/").postCss(`src/styles/style.css`, "./", [
  require("tailwindcss"),
  ...(process.env.NODE_ENV === "production"
    ? [
        purgecss({
          content: ["**/*.php", "**/*.html"],
          defaultExtractor: (content) => content.match(/[\w-/:]+(?<!:)/g) || [],
        }),
      ]
    : []),
]);
