<?php

/**
 * Checks if a user is logged in.
 *
 * @return bool Returns TRUE if the user / requester is logged, FALSE otherwise.
 */
function is_logged_in()
{
    $ci = &get_instance();
    return (isset($ci->session->get_userdata()['is_logged_in']) &&
        $ci->session->get_userdata()['is_logged_in']);
}
