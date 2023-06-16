<?php

namespace App\Services;

use GuzzleHttp\Client;

class SaasApplicationService
{

    private function invoke($urlPart, $body)
    {
        $url = config('saas.api_url') . $urlPart;

        $body['api_secret'] = config('saas.bap_saas_secret');

        $client = new Client();

        $response = $client->post(
            $url, [
            'form_params' => $body,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ]
            ]
        );

        return json_decode((string)$response->getBody());
    }

    /**
     * Create Account in Application
     *
     * @param  $companyName
     * @param  $userName
     * @param  $userEmail
     * @param  $userPassword
     * @param  null         $userLimit
     * @param  null         $storageLimit
     * @return mixed
     */
    public function createAccount($companyName, $userName, $userEmail, $userPassword, $userLimit = null, $storageLimit = null)
    {
        $result = $this->invoke(
            'register', [

            'company_name' => $companyName,
            'user_email' => $userEmail,
            'user_first_name' => $userName,
            'user_password' => $userPassword,
            'user_limit' => $userLimit,
            'storage_limit' => $storageLimit
            ]
        );

        return $result;
    }

    public function cancelAccount($user)
    {
        $result = $this->invoke(
            'deactivate-account', [
            'company_id' => $user->application_id,
            ]
        );

        return $result;
    }

    public function updateAccount($plan, $user)
    {
        $result = $this->invoke(
            'update-plan', [
            'company_id' => $user->application_id,
            'users_limit' => $plan->teams_limit,
            'storage_limit' => $plan->storage_limit
            ]
        );

        return $result;
    }

    public function resumeAccount($user)
    {
        $result = $this->invoke(
            'resume-account', [
            'company_id' => $user->application_id
            ]
        );
        return $result;
    }
}