<?php

namespace App\Http\Controllers;

use App\Domain\Baskets\Actions\StoreBasketAction;
use App\Domain\Baskets\DTO\StoreBasketDTO;
use App\Domain\Baskets\Models\Basket;
use App\Domain\Baskets\Repositories\BasketRepository;
use App\Http\Requests\BasketRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    /**
     * @var BasketRepository
     */
    public $baskets;

    /**
     * @param BasketRepository $basketRepository
     */
    public function __construct(BasketRepository $basketRepository)
    {
        $this->baskets = $basketRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->baskets->getAll()
            ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param BasketRequest $request
     * @param StorePayAction $action
     * @return JsonResponse
     */
    public function store(BasketRequest $request, StoreBasketAction $action): JsonResponse
    {
        try {
            $request->validated();
        } catch (\Illuminate\Validation\ValidationException $validate) {
            return response()->json([
                'success' => false,
                'message' => $validate->getMessage(),
                'data' => $validate->validator->errors()->all()
            ]);
        }

        try {

            $dto = StoreBasketDTO::fromArray($request->all());

            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'Data created successfully.',
                    'data' => $response
                ]);
        } catch (Exception $exception) {
            return response()
                ->json([
                    'status' => false,
                    'message' => $exception->getMessage()
                ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param Basket $basket
     * @return JsonResponse
     */
    public function destroy(Basket $basket): JsonResponse
    {
        $basket->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data deleted successfully',
            'data' => $basket
        ]);
    }
}
