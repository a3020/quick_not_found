<?php

namespace Concrete\Package\QuickNotFound;

use A3020\QuickNotFound\Middleware\QuickNotFoundMiddleware;
use Concrete\Core\Http\ServerInterface;
use Concrete\Core\Package\Package;

final class Controller extends Package
{
    protected $pkgHandle = 'quick_not_found';
    protected $appVersionRequired = '8.4.0';
    protected $pkgVersion = '0.9.0';
    protected $pkgAutoloaderRegistries = [
        'src/QuickNotFound' => '\A3020\QuickNotFound',
    ];

    public function getPackageName()
    {
        return t('Quick Not Found');
    }

    public function getPackageDescription()
    {
        return t('Quickly return 404 if a file is not found.');
    }

    public function on_start()
    {
        $this->app->extend(ServerInterface::class, function(ServerInterface $server) {
            return $server->addMiddleware($this->app->make(QuickNotFoundMiddleware::class));
        });
    }
}
