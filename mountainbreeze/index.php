<?php

/**
 * If the theme detects that there is a blade equivalent of the
 * template it is currently trying to load, it will instead
 * redirect here, which will then load the blade file
 */

echo getBladeViewFactory()->make($GLOBALS['template_name'], [
    "data" => [1, 2, 3, 4]
])->render();

