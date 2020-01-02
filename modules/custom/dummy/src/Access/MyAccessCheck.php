<?php

namespace Drupal\dummy\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Routing\Access\AccessInterface;
use Symfony\Component\Routing\Route;

/**
 * Allows access to routes to be controlled by an '_dummy_access_check' boolean parameter.
 */
class MyAccessCheck implements AccessInterface {

    /**
     * Checks access to the route based on the _access parameter.
     *
     * @param \Symfony\Component\Routing\Route $route
     *   The route to check against.
     *
     * @return \Drupal\Core\Access\AccessResultInterface
     *   The access result.
     */
    public function access(Route $route) {
        if ($route->getRequirement('_dummy_access_check') === 'TRUE') {
            return AccessResult::allowed();
        }
        elseif ($route->getRequirement('_dummy_access_check') === 'FALSE') {
            return AccessResult::forbidden();
        }
        else {
            return AccessResult::neutral();
        }
    }

}

