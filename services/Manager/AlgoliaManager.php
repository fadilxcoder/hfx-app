<?php

namespace Handler\Manager;

use Algolia\AlgoliaSearch\SearchClient;
use Algolia\AlgoliaSearch\Log\DebugLogger as AlgoliaDebugger;

class AlgoliaManager
{
    private $client;

    public function __construct()
    {
        $APP_ID =  $_ENV['ALG_APPID'];
        $PVT_KEY =  $_ENV['ALG_ADMK'];      // Admin key
        // $PVT_KEY =  $_ENV['ALG_SRCHK'];     // Search only key

        // AlgoliaDebugger::enable();
        $this->client = SearchClient::create($APP_ID, $PVT_KEY);

        return $this->client;
    }

    public function initIdx(string $idxName)
    {
        return $this->client->initIndex($idxName);
    }

    public function insert($idxName, $data)
    {   
        $idx = $this->initIdx($idxName);
        $idx->saveObjects($data, [
            'autoGenerateObjectIDIfNotExist' => true
        ]);

        return true;
    }

    public function searchFor($idxName, string $str)
    {
        $idx = $this->initIdx($idxName);
        return $idx->search($str);
    }
}
