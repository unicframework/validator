<?php
/**
 * Validator Library
 * Validator library validates users data and form data, json data.
 *
 * @package : Validator Library
 * @category : Library
 * @author : Unic Framework
 * @link : https://github.com/unicframework/unic
 */

namespace Validator;
use Validator\Validation;

class Validator {
  /**
   * Store validation rules
   *
   * @var array
   */
  private static $rules;

  /**
   * Store error messages
   *
   * @var array
   */
  private static $messages;

  /**
   * Set Rules
   * Set validation rules.
   *
   * @param array $rules
   * @return void
   */
  public static function make(array $rules, array $messages=[]) {
    // Parse validation rules
    $parsed_rules = [];
    foreach($rules as $data_key => $data_rules) {
      $parsed_data_rules = [];
      if(is_array($data_rules)) {
        $parsed_data_rules = $data_rules;
      } else {
        $tmp_rules = array_map(function($value) {
          // Remove white space
          return trim($value);
        }, explode('|', $data_rules));
        foreach($tmp_rules as $rule) {
          $tmp_rule = array_map(function($value) {
            // Remove white space
            return trim($value);
          }, explode(':', $rule));
          if(count($tmp_rule) == 2) {
            if(strtolower($tmp_rule[1]) == 'true') {
              $tmp_rule[1] = true;
            } else if(strtolower($tmp_rule[1]) == 'false') {
              $tmp_rule[1] = false;
            } else {
              $tmp_rule_value = array_map(function($value) {
                // Remove white space
                return trim($value);
              }, explode(',', $tmp_rule[1]));
              if(count($tmp_rule_value) > 1) {
                $tmp_rule[1] = $tmp_rule_value;
              }
            }
            $parsed_data_rules[$tmp_rule[0]] = $tmp_rule[1];
          } else {
            $parsed_data_rules[$tmp_rule[0]] = true;
          }
        }
      }
      $tmp_data_key = array_map(function($value) {
        // Remove white space
        return trim($value);
      }, explode(',', $data_key));
      foreach($tmp_data_key as $data_key) {
        $parsed_rules[$data_key] = $parsed_data_rules;
      }
    }
    self::$rules = $parsed_rules;

    // Parse validation messages
    $parsed_messages = [];
    foreach($messages as $data_key => $data_messages) {
      $parsed_data_messages = [];
      if(is_array($data_messages)) {
        $parsed_data_messages = $data_messages;
      } else {
        $tmp_messages = array_map(function($value) {
          // Remove white space
          return trim($value);
        }, explode('|', $data_messages));
        foreach($tmp_messages as $message) {
          $tmp_message = array_map(function($value) {
            // Remove white space
            return trim($value);
          }, explode(':', $message));
          if(count($tmp_message) == 2) {
            $parsed_data_messages[$tmp_message[0]] = $tmp_message[1];
          } else {
            $parsed_data_messages = $tmp_message[0];
          }
        }
      }
      $tmp_data_key = array_map(function($value) {
        // Remove white space
        return trim($value);
      }, explode(',', $data_key));
      foreach($tmp_data_key as $data_key) {
        $parsed_messages[$data_key] = $parsed_data_messages;
      }
    }
    self::$messages = $parsed_messages;

    return new Validation(self::$rules, self::$messages);
  }
}
