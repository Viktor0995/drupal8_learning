<?php
namespace Drupal\dummy\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route responses for the Dummy module.
 */
class DummyController extends ControllerBase {

    /**
     * Returns a simple page.
     *
     * @return array
     *   A simple renderable array.
     */
    public function buildHelloWorld() {
        $element = array(
            '#markup' => 'Hello, world',
        );
        return $element;
    }

}
