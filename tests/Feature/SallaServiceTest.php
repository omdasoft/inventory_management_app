<?php

namespace Tests\Feature;

use Tests\TestCase;
use Salla\OAuth2\Client\Provider\Salla;
use League\OAuth2\Client\Token\AccessToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;
use GuzzleHttp\ClientInterface;
class SallaServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $provider;
    protected function setUp() :void
    {
        $this->provider = new Salla([
            'clientId' => 'ac940263c5658074da4ec65530f813bd',
            'clientSecret' => '654c5698fb336a2751bf65470b656bcf',
            'redirectUri' => 'https://yourservice.com/callback_url',
        ]);
    }

    public function test_authorization_url(): void
    {
        $url = $this->provider->getAuthorizationUrl();
        $uri = parse_url($url);
        parse_str($uri['query'], $query);
        $this->assertArrayHasKey('client_id', $query);
        $this->assertArrayHasKey('redirect_uri', $query);
        $this->assertArrayHasKey('response_type', $query);
        $this->assertArrayHasKey('scope', $query);
    }

    public function test_base_access_token_url(): void
    {
        $url = $this->provider->getBaseAccessTokenUrl([]);
        $uri = parse_url($url);

        $this->assertEquals('/oauth2/token', $uri['path']);
        $this->assertEquals('accounts.salla.sa', $uri['host']);
    }


    public function test_resource_owner_details_url(): void
    {
        $token = $this->mock_access_token();
        $url = $this->provider->getResourceOwnerDetailsUrl($token);

        $this->assertEquals('https://accounts.salla.sa/oauth2/user/info', $url);
    }

    // public function test_create_access_token()
    // {
    //     $live_time = 3600;
    //     $response_json = [
    //         'access_token' => 'moc_access_token',
    //         'refresh_token' => 'moc_refresh_token',
    //         'expires_in' => $live_time,
    //     ];
    //     $response = m::mock('Psr\Http\Message\ResponseInterface');
    //     $response->shouldReceive('getBody')->andReturn(json_encode($response_json));
    //     $response->shouldReceive('getHeader')->andReturn(['content-type' => 'json']);
    //     $response->shouldReceive('getStatusCode')->andReturn(200);
    //     // $client = m::mock('GuzzleHttp\ClientInterface');
    //     // $client->shouldReceive('send')->times(1)->andReturn($response);
    //     // $this->provider->setHttpClient($client);
    //     /**
    //      * @var AccessToken $token
    //      *
    //      * */
    //     $token = $this->provider->getAccessToken('authorization_code', ['code' => 'mock_authorization_code']);
    //     $this->assertEquals($response_json['access_token'], $token->getToken());
    //     $this->assertEquals(time() + $response_json['expires_in'], $token->getExpires());
    //     $this->assertEquals($response_json['refresh_token'], $token->getRefreshToken());
    // }


    private function mock_access_token()
    {
        return new AccessToken([
            'access_token' => 'mock_access_token',
        ]);
    }
}
