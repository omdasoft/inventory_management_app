<?php
namespace App\Http\Controllers;

use App\Models\OauthToken;
use Illuminate\Http\Request;
use App\Services\SallaAuthService;
use Illuminate\Support\Facades\Cache;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

class OAuthController extends Controller
{
    /**
     * @var SallaAuthService
     */
    private $service;

    public function __construct(SallaAuthService $service)
    {
        $this->service = $service;
    }

    public function redirect()
    {
        return redirect($this->service->getProvider()->getAuthorizationUrl());
    }

    public function callback(Request $request)
    {
        abort_if($this->service->isEasyMode(), 401, 'The Authorization mode is not supported');

        // Try to obtain an access token by utilizing the authorisations code grant.
        try {
            $token = $this->service->getAccessToken('authorization_code', [
                'code' => $request->code ?? '',
            ]);

            $ttl = $token->getExpires();
            $ouathToken = OauthToken::first();

            if ($ouathToken) {
                $ouathToken->delete();
            }

            OauthToken::create([
                'access_token' => $token->getToken(),
                'expires_in' => $token->getExpires(),
                'refresh_token' => $token->getRefreshToken(),
            ]);

            Cache::remember('salla_access_token', $ttl, function() use ($token) {
                return $token->getToken();
            });
            
            return redirect('/admin/dashboard');
        } catch (IdentityProviderException $e) {
            return redirect('/admin/dashboard')->withStatus($e->getMessage());
        }
    }

    public function getToken()
    {
        $accessToken = OauthToken::value('access_token');
        return response()->json(['access_token' => $accessToken]);
    }
}
