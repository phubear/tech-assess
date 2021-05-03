<?php

namespace Drupal\bad_module_name\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Component\Serialization\Json;
use Exception;

class BadController extends ControllerBase {

  public function runThatAccessibilityApi() {
    $jsonString = \Drupal::request()->getContent();
    parse_str($jsonString, $jsonData);

    // No pathname
    if (!isset($jsonData['pathname'])) {
      $response = new JsonResponse(NULL, 400);
      return $response;
    }

    try {
      $pathName = $jsonData['pathname'];
      $settings = \Drupal::config('bad_module_name.settings');
      $hv = $settings->get('bad_api_header') ?: 'AOaxT3DBGfyXtR68PgFzcZma4bfzLeuLFaLuX9jGHC'; // I don't trust you people to save config.

      // Your massive url
      $url = "https://us-central1-api-project-30183362591.cloudfunctions.net/axe-puppeteer-test?url=https://dev-tech-homework.pantheonsite.io" . $pathName;

      $client = \Drupal::httpClient();
      $request = $client->get($url, [
        'headers' => [
          'x-tableau-auth' => $hv,
          'Content-Type' => 'application/json',
        ],
      ])->getBody()->getContents();

      $data = Json::decode($request);
      $violations = [];

      // Skipping a bit of validations possibly. Happy path
      foreach ($data['violations'] as $violation) {
        $violations[] = [
          'id' => $violation['id'],
          'count' => count($violation['nodes']),
        ];
      }

      $response = new JsonResponse(['violations' => $violations]);
      return $response;
    }
    catch (Exception $e) {
      // Catch some bad stuff here and log it or something. Only good modules do that.
      // This is bad module, we only give 1 bad output for all errors.
      $response = new JsonResponse(NULL, 503);
      return $response;
    }
  }
}
