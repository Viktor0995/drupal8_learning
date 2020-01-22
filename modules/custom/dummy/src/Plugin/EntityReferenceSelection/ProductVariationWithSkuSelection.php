<?php

namespace Drupal\dummy\Plugin\EntityReferenceSelection;

use Drupal\Component\Utility\Html;
use Drupal\Core\Entity\Plugin\EntityReferenceSelection\DefaultSelection;

/**
 * Provides autocomplete selection for commerce order item with SKU support.
 *
 * @EntityReferenceSelection(
 *   id = "dummy:article",
 *   label = @Translation("Article nodes"),
 *   entity_types = {"article"},
 *   group = "default",
 *   weight = 5
 * )
 */
class ProductVariationWithSkuSelection extends DefaultSelection {

  /**
   * {@inheritdoc}
   */
  public function getReferenceableEntities($match = NULL, $match_operator = 'CONTAINS', $limit = 0) {
      $target_type = $this->getConfiguration()['target_type'];

      $query = $this->buildEntityQuery($match, $match_operator);
      if ($limit > 0) {
          $query->range(0, $limit);
      }

      $result = $query->execute();

      if (empty($result)) {
          return [];
      }

      $options = [];
      $entities = $this->entityTypeManager->getStorage($target_type)->loadMultiple($result);
      foreach ($entities as $entity_id => $entity) {
          $bundle = $entity->bundle();
          $options[$bundle][$entity_id] = Html::escape($this->entityRepository->getTranslationFromContext($entity)->label());
      }

      return $options;
  }

}
