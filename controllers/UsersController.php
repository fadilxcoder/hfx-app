<?php

use Handler\Manager\SecurityManager;
use \Library\Controller;
use Handler\Manager\ElasticsearchManager;
use Spatie\PdfToText\Pdf;

class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        SecurityManager::verify();
        $this->container = $this->container();
        $this->homeModel = $this->container['DI_homeModel'];
        $this->algolia = $this->container['DI_algolia'];
    }

    public function dashboard()
    {
        $result = $this->homeModel->getAll();
        shuffle($result);
        $this->view->render('dashboard.html', [
            'users' => $result,
        ]);
    }

    public function searchEngine()
    {
        $request = $this->container['DI_request'];
        $resp = ElasticsearchManager::getFakeUsers('', '', '');
        $search = [
            'name' => '',
            'address' => '',
            'email' => '',
        ];
        
        if ($request->request->has('search')) :
            $search = [
                'name' => (null !== $request->request->get('name')) ? $request->request->get('name') : '',
                'address' => (null !== $request->request->get('addr')) ? $request->request->get('addr') : '',
                'email' => (null !== $request->request->get('email')) ? $request->request->get('email') : '',
            ];
            $resp = ElasticsearchManager::getFakeUsers($search['name'], $search['address'], $search['email']);
        endif;

        $this->view->render('elasticsearch.html', [
            'results' => $resp,
            'search' => $search,
        ]);
    }

    public function algoliaSearch()
    {
        $alg_index = 'alg_users';
        $request = $this->container['DI_request'];

        # Populating ALGOLIA
        # $index = $this->algolia->initIdx('alg_users');
        # $result = $this->homeModel->getAll();
        #$this->algolia->insert($alg_index, $result); die;
        
        $result = $this->algolia->searchFor($alg_index, '');
        $resp = $result['hits'];
        $search = null;

        if ($request->request->has('search')) :
            $search = (null !== $request->request->get('name')) ? $request->request->get('name') : '';
            $result = $this->algolia->searchFor($alg_index, $search);
            $resp = $result['hits'];
        endif;

        $this->view->render('algolia.html', [
            'results' => $resp,
            'search' => $search,
        ]);
    }

    public function readPdf()
    {
        // $path = $_SERVER['DOCUMENT_ROOT'] . 'public/assets/pdf/' . 'dpa.pdf';
        // $path = $_SERVER['DOCUMENT_ROOT'] . 'public/assets/pdf/' . 'dpa_2017.pdf';
        // $path = $_SERVER['DOCUMENT_ROOT'] . 'public/assets/pdf/' . 'ICTA.pdf';
        $path = $_SERVER['DOCUMENT_ROOT'] . 'public/assets/pdf/' . 'sample.pdf';
        $exe = 'C:\Program Files\Git\mingw64\bin\pdftotext.exe';
        $filename = 'text-file.md';

        $content = (new Pdf($exe))
            ->setPdf($path)
            ->setOptions(
                [
                    'table',
                    'bom',
                    'enc UTF-8',
                ]
            )
            ->text()
        ;
        
        $formater = "<pre>" . $content . "</pre>";
        file_put_contents($filename, $formater);
        dump('completed..!');
        die;
    }
}