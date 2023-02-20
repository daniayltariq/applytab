<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ServiceEmployeeResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return /* [    
            'header' => [
                'return_flag' => "1",
                'message' => "",
                'errors' => [],
            ],
            'data' => */ $this->collection;
        // ];
    }
}
