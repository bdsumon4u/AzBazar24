<?php

return [
    
    /*
     * The Facebook Pixel id, should be a code that looks something like "XXXXXXXXXXXXXXXX".
     */
    'facebook_pixel_id' => env('FACEBOOK_PIXEL_ID', '721035656838069'),
    
    /*
     * Use this variable instead of `facebook_pixel_id` if you need to use multiple facebook pixels
     */
    'facebook_pixel_ids' => ['547373544097493', '115065284864734', '1056337305533903', '1269818087229135', '721035656838069'],
    
    /*
     * Enable or disable script rendering. Useful for local development.
     */
    'enabled'           => true,

    'csp_callback'      => '',
];