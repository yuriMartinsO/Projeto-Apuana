<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\Facade\ElasticSearchIndexerFacade;
use App\Models\Facade\ElasticSearchSearchFacade;

class LogController extends Controller
{
    /**
     * Mostra as urls disponíveis
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'GET /log' => 'Return all logs',
            'POST /log' => 'Create a new log',
            'POST /search' => 'Search for logs',
            'GET /indexLogs' => 'index all logs'
        ], 200);
    }

    /**
     * Retorna todos os logs
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        return response()->json(Log::all(), 200);
    }

    /**
     * Cria um novo log
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, Log::DATA_RULES);

        if (!$log = Log::create($request->all())) {
            return response()->json([
                'hasError' => true,
                'error' => 'DataBase error, contact the development area'
            ], 400);
        }

        return response()->json($log, 201);
    }

    /**
     * Indexa todos os logs
     *
     * @return \Illuminate\Http\Response
     */
    public function indexLogs()
    {
        $elasticFacade = new ElasticSearchIndexerFacade();
        $return = [
            'indexed' => $elasticFacade->index(Log::all())
        ];

        return response()->json($return, 201);
    }

    /**
     * Procurar um log
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $elasticFacade = new ElasticSearchSearchFacade();

        return response()->json($elasticFacade->search($request->all()), 201);
    }
}
