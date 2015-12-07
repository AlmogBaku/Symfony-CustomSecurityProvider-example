<?php
/**
 * @author  Almog Baku
 *          almog.baku@gmail.com
 *          http://www.almogbaku.com/
 *
 * 24/06/15 23:23
 */

namespace AlmogBaku\ApiBundle\Form;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\PropertyAccess\PropertyAccess;

class RestFormSubscriber implements EventSubscriberInterface {

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(FormEvents::PRE_SUBMIT => "preSubmit");
    }

    /**
     * Remove null fields on update
     * Fixes boolean value
     * @param FormEvent $event
     */
    public function preSubmit(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($form->all() as $name => $child) {
            if (!isset($data[$name])) {
                $form->remove($name);
                continue;
            }

            if(!is_null($form->getData()) && is_bool($accessor->getValue($form->getData(), $name)) && isset($data[$name])) {
                $val = $data[$name];
                $data[$name] = ($val=="true")||($val=="1")||($val=="on");
            }
        }
        $event->setData($data);
    }
}