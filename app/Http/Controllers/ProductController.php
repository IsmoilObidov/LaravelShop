<?php

namespace App\Http\Controllers;

use App\Domain\Products\Actions\StorePayAction;
use App\Domain\Products\Actions\StoreProductAction;
use App\Domain\Products\Actions\UpdateProductAction;
use App\Domain\Products\DTO\StoreProductDTO;
use App\Domain\Products\DTO\UpdateProductDTO;
use App\Domain\Products\Models\Product;
use App\Domain\Products\Repositories\ProductRepository;
use App\DTOs\ProductDTO;
use App\Http\Requests\ProductRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    public $products;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->products = $productRepository;
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
                'data' => $this->products->getAll()
            ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param StoreProductAction $action
     * @return JsonResponse
     */
    public function store(Request $request, StoreProductAction $action): JsonResponse
    {
        try {
            $productData = new ProductDTO($request->all());
            $productData->validate();
        } catch (\Illuminate\Validation\ValidationException $validate) {
            return response()->json([
                'success' => false,
                'message' => $validate->getMessage(),
                'data' => $validate->validator->errors()->all()
            ]);
        }

        try {

            $data = $productData->toArray();

            $dto = StoreProductDTO::fromArray($data);

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
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @param UpdateProductAction $action
     * @return JsonResponse
     */
    public function update(Request $request, Product $product, UpdateProductAction $action): JsonResponse
    {
        $productData = new ProductDTO($request->all());
        $productData->validate();

        try {

            $data = $productData->toArray();

            $data['photo'] = $request->file('photo');

            $data['product'] = $product;

            $productData = new ProductDTO($data);

            $productData->validate();

            $dto = UpdateProductDTO::fromArray($data);


            $response = $action->execute($dto);

            return response()->json([
                'status' => true,
                'message' => 'Data updated successfully.',
                'data' => $response
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data deleted successfully',
            'data' => $product
        ]);
    }
}
