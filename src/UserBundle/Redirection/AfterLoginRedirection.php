<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 26/03/2018
 * Time: 02:06
 */

namespace UserBundle\Redirection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{
    private $router;

    /**
     * AfterLoginRedirection constructor.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param Request        $request
     *
     * @param TokenInterface $token
     *
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $roles = $token->getRoles();

        $rolesTab = array_map(function ($role) {
            return $role->getRole();
        }, $roles);

        if (in_array('ROLE_ADMIN', $rolesTab, true)) {
            // c'est un aministrateur : on le rediriger vers l'espace admin
            $redirection = new RedirectResponse($this->router->generate('ecosystem_admin_dashboard'));
        } else{
            if (in_array('ROLE_CITOYEN', $rolesTab, true)) {
                // c'est un utilisaeur client : on le rediriger vers l'accueil
                $redirection = new RedirectResponse($this->router->generate('citoyen_home'));
            }
            else {
                    if (in_array('ROLE_RECYCLEUR', $rolesTab, true)) {
                        // c'est un utilisaeur Gerant : on le rediriger vers l'accueil patisserie
                        $redirection = new RedirectResponse($this->router->generate('recycleur_home'));
                    }
                    else {
                        if (in_array('ROLE_COLLECTEUR', $rolesTab, true)) {
                            // c'est un utilisaeur Gerant : on le rediriger vers l'accueil patisserie
                            $redirection = new RedirectResponse($this->router->generate('collecteur_home'));
                        }


                    }

            }}
        return $redirection;
    }

}