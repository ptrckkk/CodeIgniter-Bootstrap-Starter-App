<?php

/**
 * This method simply conducts a redirect to the homepage.
 */
function redirect_to_homepage()
{
    redirect(base_url());
}

/**
 * @param string $controller
 * @param string $action
 */
function redirect_to_controller_action($controller, $action = '')
{
    redirect(sprintf(
            '%sindex.php/%s%s', base_url(), $controller, ($action != '') ? '/' . $action : '')
    );
}
