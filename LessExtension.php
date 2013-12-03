<?php

/*
 * This file is part of the Less plugin for carew.
 *
 * (c) Francis Besset <francis.besset@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace FrancisBesset\Carew\Less;

use Carew\Carew;
use Carew\ExtensionInterface;
use FrancisBesset\Carew\Less\EventListener\LessListener;
use lessc;

/**
 * @author Francis Besset <francis.besset@gmail.com>
 */
class LessExtension implements ExtensionInterface
{
    public function register(Carew $carew)
    {
        $container = $carew->getContainer();
        $config = $container['config']['less'];

        foreach ($container['themes'] as $theme) {
            if (is_file($theme.'/'.$config['input'])) {
                $input = $theme.'/'.$config['input'];

                break;
            }
        }

        $eventDispatcher = $carew->getEventDispatcher()->addSubscriber(new LessListener(
            new lessc(),
            $container['filesystem'],
            $input,
            $config['output']
        ));
    }
}
