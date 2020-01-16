<?php

namespace Customer\Unit\Support\Crm;

use Core\Application\Api\Adapters\ApiClient;
use Customer\Support\Crm\Contracts\CrmInterface;
use Customer\Support\Crm\Crm;
use Customer\Support\Crm\CrmApi;
use Customer\Support\Crm\FileNumber;
use GuzzleHttp\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @package Customer\Unit\Support\Crm
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class CrmApiTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     * @group  unit
     * @group  unit:customer
     * @group  unit:customer:crm
     * @return void
     */
    public function it_implements_the_api_client_adapter()
    {
        // Arrangements
        $crmApi = $this->app->make(CrmApi::class);

        // Assertions
        $this->assertInstanceOf(ApiClient::class, $crmApi);
    }
}
