<?php

namespace Tests\Unit\Front\Candidate\Account;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CreateTest extends TestCase
{
	use RefreshDatabase;

	private $url = 'candidate/account/store';

	/**
	 * Test if user not send an name field
	 */
	public function testNameRequiredError()
	{
		$response = $this->json('POST', $this->url, [
														'correoElectronico' => 'jhon.doe1975@reclutati.com',
														'password' => 'Mku8njdro0@',
														'password_confirmation' => 'Mku8njdro0@'
													]);

		$response
			->assertStatus(422)
			->assertJson([
				'errors' => [
					'nombre' => [
						'El campo nombre es obligatorio.'
					]
				]
			]);
	}

	/**
	 * Test if user not send email field
	 */
	public function testEmailRequiredError()
	{
		$response = $this->json('POST', $this->url, [
														'name' => 'Jhon Doe',
														'password' => 'Mku8njdro0@',
														'password_confirmation' => 'Mku8njdro0@'
													]);

		$response
			->assertStatus(422)
			->assertJson([
				'errors' => [
					'correoElectronico' => [
						'El campo correo electronico es obligatorio.'
					]
				]
			]);
	}

	/**
	 * Test if user send and valid email address
	 */
	public function testEmailSyntaxError()
	{
		$response = $this->json('POST', $this->url, [
														'name' => 'Jhon Doe',
														'correoElectronico' => 'jhon@reclutati',
														'password' => 'Mku8njdro0@',
														'password_confirmation' => 'Mku8njdro0@'
													]);

		$response
			->assertStatus(422)
			->assertJson([
				'errors' => [
					'correoElectronico' => [
						'El campo correo electronico debe ser una dirección de correo válida.'
					]
				]
			]);
	}

	public function testPasswordRequiredError()
	{
		$response = $this->json('POST', $this->url, [
														'name' => 'Jhon Doe',
														'correoElectronico' => 'jhon@reclutati',
														'password_confirmation' => 'Mku8njdro0@'
													]);

		$response
			->assertStatus(422)
			->assertJson([
				'errors' => [
					'password' => [
						'El campo password es obligatorio.'
					]
				]
			]);
	}

	public function testPasswordConfirmationError()
	{
		$response = $this->json('POST', $this->url, [
														'name' => 'Jhon Doe',
														'correoElectronico' => 'jhon@reclutati',
														'password' => 'Mku8njdro0@',
														'password_confirmation' => 'Mku8njdro'
													]);

		$response
			->assertStatus(422)
			->assertJson([
				'errors' => [
					'password' => [
						'La confirmación del campo password no coincide.'
					]
				]
			]);
	}

	public function testCreateSuccess()
	{
		$response = $this->json('POST', $this->url, [
														'nombre' => 'Jhon',
														'apellidoPaterno' => 'Doe',
														'correoElectronico' => 'jhon.doe1975@reclutati.com',
														'password' => 'Mku8njdro0@',
														'password_confirmation' => 'Mku8njdro0@'
													]);

		$response
			->assertStatus(200)
			->assertJson([
				'status' => true 
			]);
	}
}
