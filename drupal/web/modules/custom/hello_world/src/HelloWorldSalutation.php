<?php

namespace Drupal\hello_world;

use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Prepares the salutation to the world
 */
class HelloWorldSalutation {
  
  use StringTranslationTrait;

  /**
   * Returns the salutation
   */
  public function getSalutation() {
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