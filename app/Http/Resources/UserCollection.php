<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    private $pagination;

    public function __construct($resource)
    {
        $this->pagination = [
            'page' => $resource->currentPage(),
            'pages' => $resource->lastPage(),
            'perpage' => $resource->perPage(),
            'total' => $resource->total(),
            'sort' => 'asc',
            'field' => 'id',
        ];

        $resource = $resource->getCollection();

        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'meta' => $this->pagination
        ];
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    /* public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'meta' => [
                'page' => $this->currentPage(),
                'pages' => $this->lastPage(),
                'perpage' => $this->perPage(),
                'total' => $this->total(),
                'sort' => 'asc',
                'field' => 'id',
            ],
        ];
    } */

    /**
     * Custom function.
     *
     */
    /* public function withResponse($request, $response)
    {
        $jsonResponse = json_decode($response->getContent(), true);
        unset($jsonResponse['meta']);
        $response->setContent(json_encode($jsonResponse));
    } */
}
