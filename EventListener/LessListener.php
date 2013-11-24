<?php

namespace FrancisBesset\Carew\Less\EventListener;

use Carew\Event\CarewEvent;
use Carew\Event\Events;
use lessc;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;

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

    public function onDocuments(CarewEvent $event)
    {
        $this->filesystem->mkdir(dirname($this->output));

        $this->less->importDir = dirname($this->input);
        file_put_contents($this->output, $this->less->parse(file_get_contents($this->input)));
    }

    public static function getSubscribedEvents()
    {
        return array(
            Events::DOCUMENTS => 'onDocuments',
        );
    }
}
