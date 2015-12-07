<?php
/**
 * @author  Almog Baku
 *          almog@GoDisco.net
 *          http://www.GoDisco.net/
 *
 * 23/06/15 20:43
 */

namespace AlmogBaku\LibraryBundle\Controller;


use AlmogBaku\LibraryBundle\Entity\Author;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class BookRestController
 * @package AlmogBaku\LibraryBundle\Controller
 */
class BookRestController extends FOSRestController {

    /**
     * @Get("/authors/{id}/books/")
     * @param Author $author
     * @ApiDoc(
     *  resource=true,
     *  output="array<AlmogBaku\LibraryBundle\Entity\Book>",
     * )
     * @return \AlmogBaku\LibraryBundle\Entity\Book[]|array
     */
    public function getAllBooksByAuthorAction(Author $author) {
        $repo = $this->getDoctrine()->getRepository("LibraryBundle:Book");
        return $repo->findBy(["author" => $author]);
    }
}