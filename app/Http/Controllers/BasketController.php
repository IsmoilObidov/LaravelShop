<?php

namespace App\Http\Controllers;

use App\Domain\Baskets\Actions\StoreBasketAction;
use App\Domain\Baskets\DTO\StoreBasketDTO;
use App\Domain\Baskets\Models\Basket;
use App\Domain\Baskets\Repositories\BasketRepository;
use App\DTOs\BasketDTO;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @param Request $request
     * @param StorePayAction $action
     * @return JsonResponse
     */
    public function store(Request $request, StoreBasketAction $action): JsonResponse
    {
        try {
            $basketData = new BasketDTO($request->all());
            $basketData->validate();
        } catch (\Illuminate\Validation\ValidationException $validate) {
            return response()->json([
                'success' => false,
                'message' => $validate->getMessage(),
                'data' => $validate->validator->errors()->all()
            ]);
        }


        try {
            if (!Basket::where('product_id', $basketData->toArray()['product_id'])->where('user_id', Auth::id())->first()) {

                $dto = StoreBasketDTO::fromArray($basketData->toArray());

                $response = $action->execute($dto);

                return response()
                    ->json([
                        'status' => true,
                        'message' => 'Data created successfully.',
                        'data' => $response
                    ]);
            } else {
                return response()
                    ->json([
                        'status' => true,
                        'message' => 'Data exists.'
                    ]);
            }
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
