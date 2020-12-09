<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectApplicationCollection extends ResourceCollection
{
    private $pagination;
    /**
     * @var mixed
     */
    private $member;

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
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        dd($this->collection[0]->getAdhname->only(['id', 'first_name', 'last_name']));
      foreach ($this->collection as $members){
          $members->adherant=$members->getAdhname->only(['first_name', 'last_name'])['first_name'].' '. $members->getAdhname->only(['first_name', 'last_name'])['last_name'];
      }
//        dump($this->collection[0]);

        return [
            'data' => $this->collection,
            'meta' => $this->pagination
        ];
    }

}
