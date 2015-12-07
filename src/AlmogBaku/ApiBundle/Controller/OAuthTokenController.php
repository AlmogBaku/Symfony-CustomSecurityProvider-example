<?php
/**
 * @author  Almog Baku
 *          almog.baku@gmail.com
 *          http://www.almogbaku.com/
 *
 * 14/04/15 22:56
 */

namespace AlmogBaku\ApiBundle\Controller;

use FOS\OAuthServerBundle\Controller\TokenController;
use FOS\OAuthServerBundle\Model\TokenInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class OAuthTokenController
 * @package AlmogBaku\ApiBundle\Controller
 *
 * {@inheritdoc}
 * @Route("/oauth/v2", service="almogbaku.api.oauth_server.controller.token")
 */
class OAuthTokenController extends TokenController {
    /**
     * Get access token
     * @param Request $request
     * @return TokenInterface
     *
     * @Route("/token", name="fos_oauth_server_token")
     * @Method({"GET","POST"})
     *
     * @ApiDoc(
     *  section="OAuth",
     *  output="FOS\OAuthServerBundle\Model\TokenInterface",
     *  requirements={
     *      { "name"="client_id", "dataType"="string", "description"="The client application's identifier"},
     *      { "name"="client_secret", "dataType"="string", "description"="The client application's secret"},
     *      { "name"="grant_type", "dataType"="string", "requirement"="refresh_token|authorization_code|password|client_credentials|custom", "description"="Grant type"},
     *  },
     *  parameters={
     *      { "name"="username", "dataType"="string", "required"=false, "description"="User name (for `password` grant type)"},
     *      { "name"="password", "dataType"="string", "required"=false, "description"="User password (for `password` grant type)"},
     *      { "name"="refresh_token", "dataType"="string", "required"=false, "description"="The authorization code received by the authorization server(for `refresh_token` grant type`"},
     *      { "name"="code", "dataType"="string", "required"=false, "description"="The authorization code received by the authorization server (For `authorization_code` grant type)"},
     *      { "name"="scope", "dataType"="string", "required"=false, "description"="If the `redirect_uri` parameter was included in the authorization request, and their values MUST be identical"},
     *      { "name"="redirect_uri", "dataType"="string", "required"=false, "description"="If the `redirect_uri` parameter was included in the authorization request, and their values MUST be identical"},
     *  }
     * )
     */
    public function tokenAction(Request $request)
    {
        return parent::tokenAction($request);
    }
}