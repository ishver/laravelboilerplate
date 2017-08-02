<?php

namespace App\Http\Controllers\API\v1\Access;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\API\APIController;
use JWTAuth;
use App\Models\Access\User\User;
use JWTAuthException;
use App\Transformers\UserTransformer;
use App\Repositories\Frontend\Access\User\UserRepository;


class UserController extends APIController
{  
    
    /**
     * User Repository
     */ 
    private $users;
    
   
    /**
     *
     * @var App\Transformers\UserTransformer
     */
    protected $UserTransformer;

    /**
     *
     * @param UserTransformer $UserTransformer
     */
    public function __construct(UserRepository $users, UserTransformer $UserTransformer)
    {
        $this->UserTransformer  = $UserTransformer;
        $this->users            = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * return Response
     * @todo : make limit variable dynamic
     */
    public function index()
    {        
        $limit = request()->get('limit') ?: 5;

        $items = $this->users->getPaginate($limit);

        return $this->respondWithPagination($items, [
            'data' => $this->UserTransformer->transformCollection($items->all()),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $item = $this->users->find($id);

        if (!$item) {
            return $this->respondNotFound('User does not exist.');
        }

        return $this->respond([
            'data' => $this->UserTransformer->transform($item),
        ]);
    }

    /**
     * store the given resource in to database.
     *
     * @param  request
     *
     * @return Response
     */
    public function store()
    {
        if (!request()->get('first_name') or !request()->get('last_name') or !request()->get('email')) {
            return $this->throwValidation('Parameters failed validation for the user.');
        }

        $this->users->create(request()->all());

        return $this->respondCreated('User Sucessfully created.');
    }

}  
