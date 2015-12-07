<?php
/**
 * @author  Almog Baku
 *          almog.baku@gmail.com
 *          http://www.almogbaku.com/
 *
 * 16/04/15 01:48
 */

namespace AlmogBaku\ApiBundle\Exception;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class InvalidFormException extends BadRequestHttpException
{
    protected $errors;
    public function __construct(Form $form = null)
    {
        parent::__construct((string) $form->getErrors(true, false));
    }
}