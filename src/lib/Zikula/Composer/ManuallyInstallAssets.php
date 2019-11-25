<?php

declare(strict_types=1);

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - https://ziku.la/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\Composer;

use Composer\Script\Event;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class ManuallyInstallAssets
 *
 * Manually install vendor assets to a defined path in the web directory.
 */
class ManuallyInstallAssets
{
    /**
     * @var array
     * The list of assets. [[vendorPath => destinationPath]]
     */
    protected static $assets = [
        '/mmenu.js/dist/mmenu.js' => '/mmenu/js/mmenu.js',
        '/mmenu.js/dist/mmenu.css' => '/mmenu/css/mmenu.css',
        '/dimsemenov/magnific-popup/dist/jquery.magnific-popup.js' => '/magnific-popup/jquery.magnific-popup.js',
        '/dimsemenov/magnific-popup/dist/jquery.magnific-popup.min.js' => '/magnific-popup/jquery.magnific-popup.min.js',
        '/dimsemenov/magnific-popup/dist/magnific-popup.css' => '/magnific-popup/magnific-popup.css',
    ];

    public static function install(Event $event): void
    {
        $webDir = $event->getComposer()->getPackage()->getExtra()['symfony-web-dir'];
        if (!is_dir($webDir)) {
            $event->getIO()->write(sprintf('The %s (%s) specified in composer.json was not found in %s, can not %s.', 'symfony-web-dir', $webDir, getcwd(), 'manually install assets'));

            return;
        }
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
        if (!is_dir($vendorDir)) {
            $event->getIO()->write(sprintf('The %s (%s) specified in composer.json was not found in %s, can not %s.', 'vendor-dir', $vendorDir, getcwd(), 'manually install assets'));

            return;
        }
        $fs = new Filesystem();
        $event->getIO()->write('<info>Zikula manually installing assets:</info>');
        foreach (static::$assets as $assetPath => $destinationPath) {
            $fs->copy($vendorDir . $assetPath, $webDir . $destinationPath, true);
            $event->getIO()->write(sprintf('Zikula installed <comment>%s</comment> in <comment>%s</comment>', $assetPath, $webDir . $destinationPath));
        }
    }
}
