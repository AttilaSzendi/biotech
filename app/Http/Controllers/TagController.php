<?php

namespace App\Http\Controllers;

use App\Contracts\TagRepositoryInterface;
use App\Http\Requests\TagRequest;
use Illuminate\View\View;

class TagController extends Controller
{
    /**
     * @var TagRepositoryInterface
     */
    protected $tagRepository;

    /**
     * @param TagRepositoryInterface $tagRepository
     */
    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $tags = $this->tagRepository->list();

        return view('tag.index', compact('tags'));
    }

    public function create()
    {
        return view('tag.create');
    }

    /**
     * @param TagRequest $request
     * @return View
     */
    public function store(TagRequest $request)
    {
        $this->tagRepository->store($request->all());

        return redirect()->route('tags.index')->withStatus(__('Tag successfully created.'));
    }

    /**
     * @param int $tagId
     * @return View
     */
    public function edit(int $tagId)
    {
        $tag = $this->tagRepository->findById($tagId);

        return view('tag.edit', compact('tag'));
    }

    /**
     * @param int $tagId
     * @param TagRequest $request
     * @return View
     */
    public function update(int $tagId, TagRequest $request)
    {
        $this->tagRepository->updateById($tagId, $request->all());

        return redirect()->route('tags.index')->withStatus(__('Tag successfully updated.'));
    }

    /**
     * @param int $tagId
     * @return View
     */
    public function destroy(int $tagId)
    {
        $this->tagRepository->deleteById($tagId);

        return redirect()->route('tags.index')->withStatus(__('Tag successfully deleted.'));
    }
}
