<?php

namespace App\Transformers;

class UserTransformer extends Transformer
{
    public function transform($item)
    {
        return [
            'first_name' 	=> $item['first_name'],
            'last_name'  	=> $item['last_name'],
			'full_name'  	=> $item['full_name'],            
            'email'  		=> $item['email'],
            'created_at'  	=> $item['created_at'],
            'updated_at'  	=> $item['updated_at']
        ];
    }
}

