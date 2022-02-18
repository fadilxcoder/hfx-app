<?php

namespace App\Controller;

use \Twig\Environment;
use App\Core\Controller;
use App\Core\Twig as TwigEnv;
use App\Services\AlgoliaService;
use Josantonius\Session\Session;
use App\Repository\UsersRepository;
use App\Services\ElasticSearchService;
use Symfony\Component\HttpFoundation\Request;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;


class AppController extends Controller
{
    private const VIEW = 'app/';

    private $usersRepository;

    private $logger;

    public function __construct(
        Environment $twig,
        TwigEnv $twigEnv,
        UsersRepository $usersRepository,
        Logger $logger
    )
    {
        $this->usersRepository = $usersRepository;
        $this->logger = $logger;
        parent::__construct($twig, $twigEnv);
    }

    public function dashboard()
    {
        $users = $this->usersRepository->getAllUsers();
        shuffle($users);

        // Create the logger
        // $logger = new Logger('my_logger');
        // // Now add some handlers
        // $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));
        // $logger->pushHandler(new FirePHPHandler());

        // You can now use your logger
        $this->logger->info($_SERVER['HTTP_USER_AGENT']);

        return $this->render(self::VIEW . 'dashboard.html.twig', [
            'users' => array_slice($users, 15),
        ]);
    }

    public function algolia(AlgoliaService $algoliaService, Request $request)
    {
        $alg_index = 'alg_users';
        
        # Populating ALGOLIA
        # $algoliaService->initIdx($alg_index);
        # $result = $this->usersRepository->getAllUsers();
        # $algoliaService->insert($alg_index, $result); die;

        $result = $algoliaService->searchFor($alg_index, '');
        $resp = $result['hits'];
        $search = null;

        if ($request->request->has('search')) :
            $search = (null !== $request->request->get('name')) ? $request->request->get('name') : '';
            $result = $algoliaService->searchFor($alg_index, $search);
            $resp = $result['hits'];
        endif;

        return $this->render(self::VIEW . 'algolia.html.twig', [
            'results' => $resp,
            'search' => $search,
            'total' => count($resp),
        ]);
    }

    public function elasticsearch(Request $request)
    {
        $resp = ElasticSearchService::getEsxUsers('', '', '');
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
            $resp = ElasticSearchService::getEsxUsers($search['name'], $search['address'], $search['email']);
        endif;

        return $this->render(self::VIEW . 'elasticsearch.html.twig', [
            'results' => $resp,
            'search' => $search,
            'total' => (null !== $resp) ? count($resp) : 0,
        ]);
    }

    public function users()
    {
        return $this->render(self::VIEW . 'dashboard.html.twig', [
            'users' => $this->usersRepository->getAllUsers(),
        ]);
    }
}
