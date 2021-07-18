<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /**
    * Campos que podem ser incluídos
    */
    protected $fillable = ['content','logType'];

    /**
    * Regras de inclusão do log
    */
    const DATA_RULES = [
        'content' => 'required|min:5|max:500',
        'logType' => 'required|numeric'
    ];

    public function getElasticIndexerArray()
    {
        return [
            'index' => 'logs',
            'type' => 'log',
            'body'  => [
                'logType' => $this->logType,
                'content' => $this->content,
                'date' => (string) $this->created_at->format('Y/m/d H:i:s')
            ]
        ];
    }
}
