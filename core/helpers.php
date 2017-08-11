<?php

// dump.
function dump($data)
{
    var_dump($data);
}

// dump and die.
function dd($data)
{
    die(var_dump($data));
}

function redirect($path)
{
    header("Location: /{$path}");
}

function view($name, $params = [])
{
    // Twig
    // where the templates are held
    $loader = new Twig_Loader_Filesystem(__DIR__ . '/../app/views');

    // where to cache the compiled templates.
    // Default is 'cache' => false.
    // set 'cache' => 'path/to/cache/folder; if caching is required.
    $twig = new Twig_Environment($loader, array(
        'cache' => __DIR__ . '/../storage/cache/twig'
    ));

    // extend Twig with custom filters (twig filter name, callback, options)
    $highlight = new Twig_SimpleFilter('highlight', 'highlight', ['is_safe' => ['html']]);
    $twig->addFilter($highlight);

    // extend Twig with custom functions (twig function name, callback, options)
    $lorem = new Twig_SimpleFunction('lorem', 'lorem');
    $twig->addFunction($lorem);

    return $twig->render("{$name}.twig", $params);
}

function highlight($message, $type)
{
    switch ($type) {
        case 'warning':
            return '<span class="text-warning">' . $message . '</span>';

        case 'success':
            return '<span class="text-success">' . $message . '</span>';

        case 'complete':
            return '<span class="text-success text-complete">' . $message . '</span>';

        default:
            return $message;
    }
}

function lorem($count)
{
    $ipsum = "The game's not big enough unless it scares you a little. We could cause a diplomatic crisis. Take the ship into the Neutral Zone Fate protects fools, little children and ships named Enterprise. Fear is the true enemy, the only enemy. And blowing into maximum warp speed, you appeared for an instant to be in two places at once. I'm afraid I still don't understand, sir. Mr. Crusher, ready a collision course with the Borg ship. You're going to be an interesting companion, Mr. Data. Wait a minute - you've been declared dead. You can't give orders around here. Ensign Babyface! Smooth as an android's bottom, eh, Data? Mr. Worf, you do remember how to fire phasers? Not if I weaken first. This should be interesting. Commander William Riker of the Starship Enterprise.";

    $ipsumArray = explode(" ", $ipsum);
    $wordCount = count($ipsumArray);

    if ($count > $wordCount || $count > getrandmax()) {
        return $ipsum;
    }

    $offset = mt_rand(0, $wordCount - $count);

    return implode(" ", array_slice($ipsumArray, $offset, $count));
}

function dateStamp()
{
    $d = getdate();
    $m = $d['mon'] < 10 ? '0' . $d['mon'] : $d['mon'];
    $day =  $d['mday'] < 10 ? '0' . $d['mday'] : $d['mday'];
    $h =  $d['hours'] < 10 ? '0' . $d['hours'] : $d['hours'];
    $min =  $d['minutes'] < 10 ? '0' . $d['minutes'] : $d['minutes'];
    $s =  $d['seconds'] < 10 ? '0' . $d['seconds'] : $d['seconds'];
    return "{$d['year']}-{$m}-{$day}T{$h}:{$min}:{$s}";
}

function guid()
{
    if (function_exists('com_create_guid')) {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}
