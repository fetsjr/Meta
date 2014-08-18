<?php

Blade::extend(function($view, $compiler){
    $pattern = $compiler->createPlainMatcher('meta');

    return preg_replace($pattern, '<?php echo Meta::render();?>', $view);
});