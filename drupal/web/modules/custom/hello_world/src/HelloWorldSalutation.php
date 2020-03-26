<?php

namespace Drupal\hello_world;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Prepares the salutation to the world
 */
class HelloWorldSalutation {
  
  use StringTranslationTrait;
 
  const EVENT = 'hello_world.salutation_event';
  
  /**
   * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  protected $eventDispatcher;

  /**
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * HelloWorldSalutation constructor
   * 
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   */
  public function __construct(ConfigFactoryInterface $config_factory, EventDispatcherInterface $eventDispatcher) {
    $this->configFactory = $config_factory;
    $this->eventDispatcher = $eventDispatcher;
  }

  /**
   * Returns the salutation
   */
  public function getSalutation() {

    $config = $this->configFactory->get('hello_world.custom_salutation');
    $salutation = $config->get('salutation');

    if ($salutation != "") {
      $event = new SalutationEvent();
      $event->setValue($salutation);
      $event = $this->eventDispatcher->dispatch(SalutationEvent::EVENT, $event);
      
      return $event->getValue();
    }

    $time = new \DateTime();
    $time = (int) $time->format('G');
    if ($time >= 00 && $time < 12) {
      return $this->t('Good morning world');
    }

    if ($time >= 12 && $time < 18) {
      return $this->t('Good afternoon world');
    }

    if ($time >= 18) {
      return $this->t('Good evening world');
    }
  }

/**
 * Returns the Salutation render array
 */
  public function getSalutationComponent() {
    $render = [
      '#theme' => 'hello_world_salutation',
    ];

    $config = $this->configFactory->get('hello_world.custom_salutation');
    $salutation = $config->get('salutation');

    if ($salutation != "") {
      $render['#salutation'] = $salutation;
      $render['#overridden'] = TRUE;
      return $render;
    }

    $time = new \DateTime();
    $time = (int) $time->format('G');
    $render['#target'] = $this->t('world');

    if ($time >= 00 && $time < 12) {
      $render['#salutation'] = $this->t('Good morning');
      return $render;
    }

    if($time >= 12 && $time < 18) {
      $render['#salutation'] = $this->t('Good evening');
      return $render;
    }

    if($time > 18) {
      $render['#salutation'] = $this->t('Good evening');
      return $render;
    }
  }
}

