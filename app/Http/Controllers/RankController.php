<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateRankRequest;
use App\Http\Requests\UpdateRankRequest;
use App\Repositories\RankRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use App\Criteria\RequestCriteria;
use Response;

class RankController extends InfyOmBaseController
{
    /** @var  RankRepository */
    private $rankRepository;

    public function __construct(RankRepository $rankRepo)
    {
        parent::__construct();
        $this->rankRepository = $rankRepo;
    }

    /**
     * Display a listing of the Rank.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    	\Session::put("rank_back_url",$request->getRequestUri());
        $this->rankRepository->pushCriteria(new RequestCriteria($request))->orderBy('id','desc');
        $ranks = $this->rankRepository->paginate(15);

        return view('ranks.index')
            ->with('ranks', $ranks);
    }

    /**
     * Show the form for creating a new Rank.
     *
     * @return Response
     */
    public function create()
    {
        return view('ranks.create');
    }

    /**
     * Store a newly created Rank in storage.
     *
     * @param CreateRankRequest $request
     *
     * @return Response
     */
    public function store(CreateRankRequest $request)
    {
        $input = $request->all();

        $input['total_performance'] = $input['personal_performance_required'] + $input['team_performance_required'];

        $rank = $this->rankRepository->create($input);

        Flash::success('新增成功');

        return redirect(session('rank_back_url',route('ranks.index')));
    }

    /**
     * Display the specified Rank.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rank = $this->rankRepository->findWithoutFail($id);

        if (empty($rank)) {
            Flash::error('找不到页面');

            return redirect(session('rank_back_url',route('ranks.index')));
        }

        return view('ranks.show')->with('rank', $rank);
    }

    /**
     * Show the form for editing the specified Rank.
     *
     * @param  int $id
     *
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function edit($id)
    {
        $rank = $this->rankRepository->findWithoutFail($id);

        if (empty($rank)) {
            Flash::error('找不到页面');

            return redirect(session('rank_back_url',route('ranks.index')));
        }

        return view('ranks.edit')->with('rank', $rank);
    }

    /**
     * Update the specified Rank in storage.
     *
     * @param  int              $id
     * @param UpdateRankRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRankRequest $request)
    {
        $rank = $this->rankRepository->findWithoutFail($id);

        if (empty($rank)) {
            Flash::error('找不到页面');

            return redirect(session('rank_back_url',route('ranks.index')));
        }

        $input=$request->all();

        $input['total_performance'] = $input['personal_performance_required'] + $input['team_performance_required'];

        $rank = $this->rankRepository->update($input, $id);

        Flash::success('编辑成功');

        return redirect(session('rank_back_url',route('ranks.index')));
    }

    /**
     * Remove the specified Rank from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rank = $this->rankRepository->findWithoutFail($id);

        if (empty($rank)) {
            Flash::error('找不到页面');

            return redirect(session('rank_back_url',route('ranks.index')));
        }

        $this->rankRepository->delete($id);

        Flash::success('删除成功');

        return redirect(session('rank_back_url',route('ranks.index')));
    }
}
