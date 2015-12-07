<?php

namespace AlmogBaku\LibraryBundle\Controller;

use AlmogBaku\LibraryBundle\Entity\Author;
use AlmogBaku\LibraryBundle\Form\AuthorType;
use Doctrine\ORM\NoResultException;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AlmogBaku\ApiBundle\Exception\InvalidFormException;
use Symfony\Component\HttpFoundation\Request;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Class PolicyRestController
 * @package AlmogBaku\PolicyBundle\Controller
 *
 * @Route("/authors")
 */
class AuthorRestController extends FOSRestController
{
    /**
     * Get all authors
     *
     * @Get("/")
     * @View("::api.html.twig")
     * @ApiDoc(
     *  resource=true,
     *  authenticationRoles={"FULLY_AUTHENTICATED"},
     *  output="array<AlmogBaku\LibraryBundle\Entity\Author>",
     * )
     * @Secure(roles="IS_AUTHENTICATED_FULLY,ROLE_SHARED_SECRET")
     * @return Author[]
     */
    public function getAllAction()
    {
        $repo = $this->getDoctrine()->getRepository("LibraryBundle:Author");
        return $repo->findAll();
    }

    /**
     * Create new author
     *
     * @Post("/")
     * @View("::api.html.twig", statusCode=201)
     *
     * @ApiDoc(
     *  input="AlmogBaku\LibraryBundle\Form\AuthorType",
     *  output="AlmogBaku\LibraryBundle\Entity\Author",
     *  statusCodes={
     *      201="Created new author",
     *      400="Inserted object is not valid and have errors"
     *  }
     * )
     *
     * @param Request $request
     * @return Author
     */
    public function createAction(Request $request)
    {
        $author = new Author();
        $form = $this->createForm(new AuthorType(), $author);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();

            $view = $this->view($author);
            $view->setLocation($this->generateUrl("single-author", ['id'=>$author->getId()]));

            return $view;
        }
        throw new InvalidFormException($form);
    }

    /**
     * Update new author
     *
     * @Put("/{id}")
     * @View("::api.html.twig", statusCode=204)
     *
     * @ApiDoc(
     *  input="AlmogBaku\LibraryBundle\Form\AuthorType",
     *  output="AlmogBaku\LibraryBundle\Entity\Author"
     * )
     *
     * @param Author $author
     * @param Request $request
     * @return Author
     */
    public function updateAction(Author $author, Request $request)
    {
        $form = $this->createForm(new AuthorType(), $author, ['method'=>'PUT']);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();

            $view = $this->view($author);
            $view->setLocation($this->generateUrl("single-author", ['id'=>$author->getId()]));

            return $view;
        }
        throw new InvalidFormException($form);
    }

    /**
     * Get author
     *
     * @Get("/{id}", name="single-author")
     * @View("::api.html.twig")
     * @ApiDoc(
     *  output="AlmogBaku\LibraryBundle\Entity\Author",
     * )
     * @param Author $author
     * @return Author
     */
    public function getAuthorAction(Author $author) {
        return $author;
    }

    /**
     * Dalete author
     *
     * @Delete("/{id}")
     * @View("::api.html.twig")
     * @ApiDoc()
     * @param Author $author
     * @return Author
     */
    public function removeAuthorAction(Author $author) {
        $em=$this->getDoctrine()->getManager();
        $em->remove($author);
        $em->flush();
        return true;
    }
}