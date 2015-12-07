<?php
/**
 * @author  Almog Baku
 *          almog.baku@gmail.com
 *          http://www.almogbaku.com/
 *
 * 14/04/15 22:53
 */

namespace AlmogBaku\ApiBundle\Controller;

use FOS\OAuthServerBundle\Controller\AuthorizeController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class OAuthAuthorizeController
 * @package AlmogBaku\ApiBundle\Controller
 *
 * {@inheritdoc}
 * @Route("/oauth/v2")
 */
class OAuthAuthorizeController extends AuthorizeController {
    /**
     * Authorize user
     *
     * @Route("/auth", name="fos_oauth_server_authorize")
     * @Method({"GET","POST"})
     *
     * @ApiDoc(
     *  section="OAuth",
     *  requirements={
     *      { "name"="client_id", "dataType"="string", "description"="The client application's identifier"},
     *      { "name"="response_type", "dataType"="string", "requirement"="code|token", "description"="Response type"}
     *  },
     *  parameters={
     *      { "name"="redirect_uri", "dataType"="uri", "required"=false, "description"="The redirect URI registered by the client"},
     *      { "name"="scope", "dataType"="string", "required"=false, "description"="The scope of the authorization"},
     *      { "name"="state", "dataType"="string", "required"=false, "description"="Any client state that needs to be passed on to the client request URI"},
     *  }
     * )
     */
    public function authorizeAction(Request $request)
    {
        return parent::authorizeAction($request);
    }
}