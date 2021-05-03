<?php

namespace Drupal\bad_module_name\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Bad Block.
 *
 * @Block(
 *   id = "bad_block",
 *   admin_label = @Translation("Bad Block"),
 *   category = @Translation("Bad Block"),
 * )
 */
class BadBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Lazy to do a template, so here we go.
    return [

      '#type' => 'inline_template',
      '#template' =>
      "<div class='analysis-wrapper'>
        <button class='analysis-trigger-button'>
        Click Here
        </button>
        <div id='useless-junk-here'></div>
      </div>",
      '#attached' => [
        'library' => [
          'bad_module_name/bad-js',
        ],
      ],
    ];
  }

}
