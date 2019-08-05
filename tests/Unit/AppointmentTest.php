<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentTest extends TestCase
{

    /*public function testNewAppointmentRegistration()
    {
        $this->visit('/Appointments/create')
            ->select('1', 'service_id')
            ->select('2', 'dentist_id')
            ->select('3', 'patient_id')
            ->type('10000','price')
            ->type('2019-08-05','date')
            ->press('submit')
            ->seePageIs('/Appointments');
    }*/

    public function testGettingAllAppointments()
    {
        $response = $this->json('GET', '/api/Appointments');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                [
                    'id',
                    'date',
                    'price',
                    'dentist_name',
                    'service_name',
                    'service_price',
                    'patient_name',
                    'created_at',
                    'updated_at'
                ]
            ]
        );
    }

    public function testGettingFilteredAppointments()
    {
        $response = $this->json('GET', '/api/Appointments/2017-01-01/2019-08-08');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                [
                    'id',
                    'date',
                    'price',
                    'dentist_name',
                    'service_name',
                    'service_price',
                    'patient_name',
                    'created_at',
                    'updated_at'
                ]
            ]
        );
    }
 
    public function testDeleteProduct()
    {
            $response = $this->json('GET', '/api/Appointments');
            $response->assertStatus(200);

            $product = $response->getData()[0];

            $user = factory(\App\Appointment::class)->create();
            $delete = $this->json('DELETE', '/api/Appointments/delete/'.$product->id);
            $delete->assertStatus(200);
    }
}
