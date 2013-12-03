<?php

/*
 * This file is part of the Less plugin for carew.
 *
 * (c) Francis Besset <francis.besset@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace FrancisBesset\Carew\Less\EventListener;

use Carew\Event\CarewEvent;
use Carew\Event\Events;
use lessc;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * @author Francis Besset <francis.besset@gmail.com>
 */
class LessListener implements EventSubscriberInterface
{
    protected $less;
    protected $filesystem;
    protected $input;
    protected $output;

    public function __construct(lessc $less, Filesystem $filesystem, $input, $output)
    {
        $this->less = $less;
        $this->filesystem = $filesystem;
        $this->input = $input;
        $this->output = $output;
    }

    public function onTerminate(CarewEvent $event)
    {
        $output = $event->getArgument('webDir').'/'.$this->output;
        $this->filesystem->mkdir(dirname($output));

        $this->less->importDir = dirname($this->input);
        file_put_contents($output, $this->less->parse(file_get_contents($this->input)));
    }

    public static function getSubscribedEvents()
    {
        return array(
            Events::TERMINATE => 'onTerminate',
        );
    }
}
