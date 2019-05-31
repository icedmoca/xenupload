<?php

namespace nanocode\MineSync\Pub\Controller;

use XF\Mvc\ParameterBag;
use XF\Pub\Controller\AbstractController;

class MSApi extends AbstractController
{
    protected function preDispatchController($action, ParameterBag $params)
    {
        $this->setResponseType('json');
        $this->assertPostOnly();
        $this->assertApiAuthenticated();
    }

    public function actionCheckForExistingLink()
    {
        $input = $this->filter([
            'uuid' => 'str',
            'key_type' => 'uint'
        ]);

        $key = $this->finder('nanocode\MineSync:Key')
            ->where('uuid', $input['uuid'])
            ->where('valid', 1)
            ->where('key_type', $input['key_type'])
            ->order('create_date', 'desc')
            ->fetchOne();

        $token = ($key ? $key->token : '');

        return $this->view('nanocode\MineSync:Api\GenericApiRequest', '', [
            'data' => [
                'results' => $token,
                'status' => 'success',
                'found' => ($key && $key->exists()) ? 'true' : 'false'
            ]
        ]);
    }

    public function actionCreateLinkKey()
    {
        $input = $this->filter([
            'token' => 'str',
            'uuid' => 'str',
            'mc_username' => 'str',
            'valid' => 'uint',
            'key_type' => 'uint'
        ]);

        $uuidAlreadyLinked = $this->finder('XF:User')->where('ncms_uuid', $input['uuid'])->fetchOne();

        if ($uuidAlreadyLinked && $uuidAlreadyLinked->exists())
        {
            return $this->view('nanocode\MineSync:Api\GenericApiRequest', '', [
                'data' => [
                    'status' => 'error'
                ]
            ]);
        }

        $key = $this->em()->create('nanocode\MineSync:Key');
        $key->bulkSet([
            'token' => $input['token'],
            'uuid' => $input['uuid'],
            'mc_username' => $input['mc_username'],
            'valid' => $input['valid'],
            'key_type' => $input['key_type'],
            'create_date' => \XF::$time
        ]);

        $success = true;
        try
        {
            $key->save();
        } catch (\Exception $e)
        {
            \XF::logException($e);
            $success = false;
        }

        return $this->view('nanocode\MineSync:Api\GenericApiRequest', '', [
            'data' => [
                'status' => $success ? 'success' : 'error'
            ]
        ]);
    }

    public function actionUpdatePlayerCache()
    {
        $input = $this->filter([
            'uuid' => 'str',
            'username' => 'str',
            'groups' => 'str'
        ]);

        $playerUpdate = $this->em()->create('nanocode\MineSync:PlayerUpdate');
        $playerUpdate->bulkSet([
            'uuid' => $input['uuid'],
            'mc_username' => $input['username'],
            'groups' => $input['groups'],
            'date' => \XF::$time
        ]);

        $success = true;
        try
        {
            $playerUpdate->save();
        } catch (\Exception $e)
        {
            $success = false;
        }

        return $this->view('nanocode\MineSync:Api\GenericApiRequest', '', [
            'data' => [
                'status' => $success ? 'success' : 'error'
            ]
        ]);
    }

    public function actionGetPendingLinks()
    {
        $pendingLinks = $this->app()->db()->fetchAllColumn('SELECT uuid FROM ncms_newlink');

        return $this->view('nanocode\MineSync:Api\GenericApiRequest', '', [
            'data' => [
                'results' => json_encode($pendingLinks),
                'status' => 'success'
            ]
        ]);
    }

    public function actionDeleteLinkEntry()
    {
        $uuid = $this->filter('uuid', 'str');

        $this->app()->db()->delete('ncms_newlink', 'uuid = ?', $uuid);

        return $this->view('nanocode\MineSync:Api\GenericApiRequest', '', [
            'data' => [
                'status' => 'success'
            ]
        ]);
    }

    public function actionCheckUserAccountExists()
    {
        $uuid = $this->filter('uuid', 'str');

        $user = $this->finder('XF:User')
            ->where('ncms_uuid', $uuid)
            ->fetchOne();

        return $this->view('nanocode\MineSync:Api\GenericApiRequest', '', [
            'data' => [
                'exists' => ($user && $user->exists()),
                'status' => 'success'
            ]
        ]);
    }

    protected function assertApiAuthenticated()
    {
        $options = \XF::options();
        $apiKey = $options->ncmsApiKey;
        $apiAccessIPs = array_filter(explode(',', $options->ncmsApiAccessIps));
        $inputApiKey = $this->filter('api_key', 'str');

        if (!empty($apiAccessIPs))
        {
            if (!in_array($this->app->request()->getIp(), $apiAccessIPs))
            {
                throw $this->exception(
                    $this->plugin('nanocode\MineSync:Error')->actionApiAuthenticationError()
                );
            }
        }
        if (empty($apiKey) || $inputApiKey != $apiKey)
        {
            throw $this->exception(
                $this->plugin('nanocode\MineSync:Error')->actionApiAuthenticationError()
            );
        }
    }

    public function checkCsrfIfNeeded($action, ParameterBag $params)
    {
        return;
    }

    public function assertViewingPermissions($action)
    {
        return true;
    }

    public function assertBoardActive($action)
    {
        return true;
    }
}