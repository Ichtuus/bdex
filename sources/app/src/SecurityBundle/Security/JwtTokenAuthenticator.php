<?php

namespace App\SecurityBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\TokenExtractorInterface;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\AuthorizationHeaderTokenExtractor;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTEncodedEvent;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Authentication\Token\PreAuthenticationJWTUserToken;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\InvalidTokenException;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\ExpiredTokenException;
use App\Repository\UserRepository;

class JwtTokenAuthenticator extends AbstractGuardAuthenticator
{
    private $passwordEncoder;
    private $tokenExtractor;
    private $preAuthenticationTokenStorage;
    private $user;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, TokenExtractorInterface $tokenExtractor, UserRepository $user)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->tokenExtractor = $tokenExtractor;
        $this->preAuthenticationTokenStorage = new TokenStorage();
        $this->user = $user;
    }

    public function supports(Request $request)
    {
        return $request->get("_route") === "login" && $request->isMethod("POST");
    }


    public function getCredentials(Request $request)
    {
        $content = $request->getContent();
        $json = json_decode($content, true);


        return [
            'email' => $json["email"],
            'password' => $json["password"]
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $userProvider->loadUserByUsername($credentials['email']);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {

        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse([
            'error' => $exception->getMessageKey()
        ], 400);
    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // do nothing - let the controller be called
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new JsonResponse([
            'error' => 'Access Denied'
        ]);
    }

    public function supportsRememberMe()
    {
        return false;
    }

    /*
    * @return TokenExtractorInterface
    */
    protected function getTokenExtractor()
    {
        return $this->tokenExtractor;
    }
}