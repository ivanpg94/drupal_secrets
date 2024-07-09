<?php

namespace Drupal\node_view_counter\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\Request;

class NodeViewCounterSubscriber implements EventSubscriberInterface {

  /**
   * Incrementa el contador de vistas.
   */
  public function onKernelRequest(RequestEvent $event) {
    $request = $event->getRequest();
    $node = $this->getNodeFromRequest($request);

    if ($node instanceof NodeInterface) {
      $counter_field_name = 'field_counter';

      // Verifica si el nodo no es nulo y si el campo existe en el nodo.
      if ($node && $node->hasField($counter_field_name)) {
        $counter_value = $node->get($counter_field_name)->value + 1;
        $node->set($counter_field_name, $counter_value);
        $node->save();
      }
    }
  }

  /**
   * Obtiene el nodo desde la solicitud.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   La solicitud actual.
   *
   * @return \Drupal\node\NodeInterface|null
   *   El nodo o NULL si no se encuentra.
   */
  private function getNodeFromRequest(Request $request) {
    $node = NULL;
    if ($route_match = \Drupal::routeMatch()) {
      if ($route_match->getRouteName() == 'entity.node.canonical') {
        $node = $route_match->getParameter('node');
      }
    }
    return $node;
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = ['onKernelRequest'];
    return $events;
  }
}
