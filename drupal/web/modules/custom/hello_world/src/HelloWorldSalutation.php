<?php

namespace Drupal\hello_world;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Prepares the salutation to the world
 */
class HelloWorldSalutation {
  
  use StringTranslationTrait;

  /**
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * HelloWorldSalutation constructor
   * 
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * Returns the salutation
   */
  public function getSalutation() {

    $config = $this->configFactory->get('hello_world.custom_salutation');
    $salutation = $config->get('salutation');

    if ($salutation != "") {
      return $salutation;
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
}