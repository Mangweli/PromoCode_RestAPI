<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class PromoCodeTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_cant_retrieve_promocodes_without_authorization()
    {
        $response = $this->get('/api/v1/promocode');

        $response->assertStatus(401);
    }

    public function test_get_all_promos()
    {
        Sanctum::actingAs(User::factory()->create()
        );

        $response = $this->get('/api/v1/promocode');

        $response->assertOk();
        $response->assertStatus(200);

    }

    public function test_get_active_promo()
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->get('/api/v1/promocode?disabled=0');

        $response->assertOk();
        $response->assertStatus(200);

    }

    public function test_get_inactive_promocode()
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->get('/api/v1/promocode?disabled=1');

        $response->assertOk();
        $response->assertStatus(200);
    }

    public function test_create_promo_code() {
       // $this->withoutExceptionHandling();
        Sanctum::actingAs(User::factory()->create());

        $response = $this->post('/api/v1/promocode',[
            "promo_code"                => 'TESTPROMO',
            "country"                   => "KENYA",
            "city"                      => "NAIROBI",
            "pick_up_address"           => "KCA UNIVERSITY",
            "drop_off_address"          => "The Village Market",
            "start_date"                => "2022-03-11 00:00:00",
            "end_date"                  => "2022-04-23 23:59:59",
            "amount"                    => "300",
            "number_of_usage_per_rider" => "2",
            "max_total_amount"          => "300000",
            "pick_up_ll"                => "-1.251920910253397, 36.859353733715295",
            "drop_off_ll"               => "-1.2278709063245135, 36.804751073057716",
            "pick_up_variance"          => "2",
            "drop_off_variance"         => "2"
        ]);

        $response->assertSuccessful();
        $response->assertStatus(200);
    }

    public function test_valid_validate_promo() {
        Sanctum::actingAs(User::factory()->create());

        $this->post('/api/v1/promocode',[
            "promo_code"                => 'TESTPROMO',
            "country"                   => "KENYA",
            "city"                      => "NAIROBI",
            "pick_up_address"           => "KCA UNIVERSITY",
            "drop_off_address"          => "Village Market, NAIROBI",
            "start_date"                => "2022-03-11 00:00:00",
            "end_date"                  => "2022-04-23 23:59:59",
            "amount"                    => "300",
            "number_of_usage_per_rider" => "2",
            "max_total_amount"          => "300000",
            "pick_up_ll"                => "-1.251920910253397, 36.859353733715295",
            "drop_off_ll"               => "-1.2278709063245135, 36.804751073057716",
            "pick_up_variance"          => "2",
            "drop_off_variance"         => "2",
            'disabled'                  => "0"
        ]);

        $response = $this->get('/api/v1/validate-promo/TESTPROMO/KCA%20University/Village%20Market,%20Nairobi');

        $response->assertOk();
        $response->assertStatus(200);
    }

    public function test_invalid_validation_promo()
    {
        Sanctum::actingAs(User::factory()->create());

        $this->post('/api/v1/promocode',[
            "promo_code"                => 'TESTPROMO',
            "country"                   => "KENYA",
            "city"                      => "NAIROBI",
            "pick_up_address"           => "KCA UNIVERSITY",
            "drop_off_address"          => "Village Market, NAIROBI",
            "start_date"                => "2022-03-11 00:00:00",
            "end_date"                  => "2022-04-23 23:59:59",
            "amount"                    => "300",
            "number_of_usage_per_rider" => "2",
            "max_total_amount"          => "300000",
            "pick_up_ll"                => "-1.251920910253397, 36.859353733715295",
            "drop_off_ll"               => "-1.2278709063245135, 36.804751073057716",
            "pick_up_variance"          => "2",
            "drop_off_variance"         => "2",
        ]);

        $response = $this->get('/api/v1/validate-promo/TESTPROMO/KCA%20University/Village%20Market,%20Nairobi');
        $response->assertStatus(404);
    }

    public function test_set_promo_status()
    {
        Sanctum::actingAs(User::factory()->create());

       $this->post('/api/v1/promocode',[
            "promo_code"                => 'TESTPROMO',
            "country"                   => "KENYA",
            "city"                      => "NAIROBI",
            "pick_up_address"           => "KCA UNIVERSITY",
            "drop_off_address"          => "The Village Market",
            "start_date"                => "2022-03-11 00:00:00",
            "end_date"                  => "2022-04-23 23:59:59",
            "amount"                    => "300",
            "number_of_usage_per_rider" => "2",
            "max_total_amount"          => "300000",
            "pick_up_ll"                => "-1.251920910253397, 36.859353733715295",
            "drop_off_ll"               => "-1.2278709063245135, 36.804751073057716",
            "pick_up_variance"          => "2",
            "drop_off_variance"         => "2"
        ]);

        $response = $this->post('/api/v1/set-status/TESTPROMO',[
            "disabled"                => '0'
        ]);

        $response->assertOk();
        $response->assertStatus(200);
    }

    public function test_set_invalid_promo_status_option()
    {
        Sanctum::actingAs(User::factory()->create());

       $this->post('/api/v1/promocode',[
            "promo_code"                => 'TESTPROMO',
            "country"                   => "KENYA",
            "city"                      => "NAIROBI",
            "pick_up_address"           => "KCA UNIVERSITY",
            "drop_off_address"          => "The Village Market",
            "start_date"                => "2022-03-11 00:00:00",
            "end_date"                  => "2022-04-23 23:59:59",
            "amount"                    => "300",
            "number_of_usage_per_rider" => "2",
            "max_total_amount"          => "300000",
            "pick_up_ll"                => "-1.251920910253397, 36.859353733715295",
            "drop_off_ll"               => "-1.2278709063245135, 36.804751073057716",
            "pick_up_variance"          => "2",
            "drop_off_variance"         => "2"
        ]);

        $response = $this->post('/api/v1/set-status/TESTPROMO',[
            "disabled"                => '5'
        ]);

        $response->assertStatus(404);
    }

    public function test_distance_variance_configuration()
    {
        Sanctum::actingAs(User::factory()->create());

        $this->post('/api/v1/promocode',[
             "promo_code"                => 'TESTPROMO',
             "country"                   => "KENYA",
             "city"                      => "NAIROBI",
             "pick_up_address"           => "KCA UNIVERSITY",
             "drop_off_address"          => "The Village Market",
             "start_date"                => "2022-03-11 00:00:00",
             "end_date"                  => "2022-04-23 23:59:59",
             "amount"                    => "300",
             "number_of_usage_per_rider" => "2",
             "max_total_amount"          => "300000",
             "pick_up_ll"                => "-1.251920910253397, 36.859353733715295",
             "drop_off_ll"               => "-1.2278709063245135, 36.804751073057716",
             "pick_up_variance"          => "2",
             "drop_off_variance"         => "2"
         ]);

         $response = $this->post('/api/v1/set-location-variance/TESTPROMO',[
             "pick_up_variance"  => '4',
             "drop_off_variance" => '3'

         ]);

         $response->assertOk();
         $response->assertStatus(200);
    }

}
