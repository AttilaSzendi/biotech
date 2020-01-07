<?php

namespace App\Http\Controllers;

use App\Contracts\ProductRepositoryInterface;
use App\Http\Requests\ProductRequest;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->list();

        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    /**
     * @param ProductRequest $request
     * @return View
     */
    public function store(ProductRequest $request)
    {
        $this->uploadFile($request);

        $product = $this->productRepository->store($request->all());

        $this->syncTags($request, $product);

        return redirect()->route('products.index')->withStatus(__('Product successfully created.'));
    }

    public function edit(int $productId)
    {
        $product = $this->productRepository->findById($productId);

        return view('product.edit', compact('product'));
    }

    /**
     * @param int $productId
     * @param ProductRequest $request
     * @return View
     */
    public function update(int $productId, ProductRequest $request)
    {
        $this->uploadFile($request);

        $product = $this->productRepository->updateById($productId, $request->all());

        $this->syncTags($request, $product);

        return redirect()->route('products.index')->withStatus(__('Product successfully updated.'));
    }

    /**
     * @param int $productId
     * @return View
     */
    public function destroy(int $productId)
    {
        $this->productRepository->deleteById($productId);

        return redirect()->route('products.index')->withStatus(__('Product successfully deleted.'));
    }

    /**
     * @param ProductRequest $request
     */
    public function uploadFile(ProductRequest $request): void
    {
        if ($request->hasFile('src')) {
            $fileName = $request->file('src')->store('products');

            $request->merge(['image' => $fileName]);
        }
    }

    /**
     * @param ProductRequest $request
     * @param \Illuminate\Database\Eloquent\Model $product
     */
    public function syncTags(ProductRequest $request, \Illuminate\Database\Eloquent\Model $product): void
    {
        $product->tags()->sync($request->get('tags'));
    }
}
