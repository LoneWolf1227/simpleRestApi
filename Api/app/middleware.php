<?php
declare(strict_types=1);

use Slim\App;

return function (App $app) {
    $settings = $app->getContainer()->get('settings')['errorDisplay'];

    $app->addErrorMiddleware(
        $settings['displayErrorDetails'],
        $settings['logErrors'],
        $settings['logErrorDetails']
    );
};