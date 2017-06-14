<?php

namespace App\Http\Controllers;

use App\Criteria\OrderByCriteria;
use App\Criteria\SelectCriteria;
use App\Criteria\WhereCriteria;
use App\Http\Requests;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use App\Services\ExcelService;
use Illuminate\Http\Request;
use Flash;
use App\Criteria\RequestCriteria;
use Response;
use Carbon\Carbon;

class ProductController extends InfyOmBaseController
{
    /** @var  ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        parent::__construct();
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the Product.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    	\Session::put("product_back_url",$request->getRequestUri());
        $this->productRepository->pushCriteria(new RequestCriteria($request))->orderBy('id','desc');

        if (!$request->has('status')){
            $this->productRepository->pushCriteria(new WhereCriteria('status','=','on'));
        }
        $products = $this->productRepository->paginate(15);

        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param CreateProductRequest $request
     *
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
        $input = $request->all();

        $product = $this->productRepository->create($input);

        Flash::success('新增成功');

        return redirect(session('product_back_url',route('products.index')));
    }

    /**
     * Display the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('找不到页面');

            return redirect(session('product_back_url',route('products.index')));
        }

        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param  int $id
     *
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('找不到页面');

            return redirect(session('product_back_url',route('products.index')));
        }

        return view('products.edit')->with('product', $product);
    }

    /**
     * Update the specified Product in storage.
     *
     * @param  int              $id
     * @param UpdateProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductRequest $request)
    {
        $input = $request->all();

        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('找不到页面');

            return redirect(session('product_back_url',route('products.index')));
        }

        $product = $this->productRepository->update($input, $id);

        Flash::success('编辑成功');

        return redirect(session('product_back_url',route('products.index')));
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('找不到页面');

            return redirect(session('product_back_url',route('products.index')));
        }

        $this->productRepository->update(['status'=>'off'],$id);

        Flash::success('关闭成功');

        return redirect(session('product_back_url',route('products.index')));
    }


}
