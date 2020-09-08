<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class IncorporationCollection extends ResourceCollection
{
    private $pagination;

    public function __construct($resource)
    {
        $this->pagination = [
            'page' => $resource->currentPage(),
            'pages' => $resource->lastPage(),
            'perpage' => $resource->perPage(),
            'total' => $resource->total(),
            'sort' => 'desc',
            'field' => 'id',
        ];

        $resource = $resource->getCollection();

        parent::__construct($resource);
    }


    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'meta' => $this->pagination
        ];
    }
}
