<?php
function setClass($e)
{
    switch ($e->status) {
        case 'pending':
            return 'bg-warning';
        case 'ongoing':
            return 'bg-success';
        case 'ended':
            return 'bg-danger';
        default:
            return 'bg-info';
    }
}

function tripDefaultImage($e, $base)
{
    switch ($e->type) {
        case 'depot':
            return $base . '/guest.png';
        case 'course':
            return $base . '/no_image.jpg';
        default:
            return $base . '/fr.png';
    }
}
