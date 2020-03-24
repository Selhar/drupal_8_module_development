<?php
namespace Drupal\hello_world\Logger;

use Drupal\Core\Logger\RfcLoggerTrait;
use Psr\Log\LoggerInterface;

/**
 * A logger that sends an email when the log type is "error".
 */
class MailLogger implements LoggerInterface {
  
  use RfcLoggerTrait;
  
  /**
  * {@inheritdoc}
  */
  public function log($level, $message, array $context = array()) {
    //Log our messages to the logging system
  }
}
