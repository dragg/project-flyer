<?php

function flash($title = null, $message = null)
{
    $flash = app(\App\Http\Flash::class);

    if (func_num_args() == 0) {
        return $flash;
    }

    return $flash->info($title, $message);
}

function link_to($body, $path, $type)
{
    $csrf = csrf_field();

    if (is_object($path)) {
        /** @noinspection PhpUndefinedMethodInspection */
        $action = $path->getTable();

        if (in_array($type, ['PUT', 'PATCH', 'DELETE'])) {
            /** @noinspection PhpUndefinedMethodInspection */
            $action .= '/' . $path->getKey();
        }
    } else {
        $action = $path;
    }

    return <<<EOT
    <form method="POST" action="{$action}">
        <input type="hidden" name="_method" value="{$type}">
        $csrf

        <button type="submit">{$body}</button>
    </form>
EOT;

}