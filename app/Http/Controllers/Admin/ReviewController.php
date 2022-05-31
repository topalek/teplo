<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;

class ReviewController extends BaseAdminController implements AdminMenuInterface
{
    public function index()
    {
        return view('admin.review.index');
    }

    public function create()
    {
        $list = [];
        return view('admin.review.create', compact('list'));
    }

    public function store(StoreReviewRequest $request)
    {
        $review = Review::create($request->validated());
        return redirect()->route('admin.review.show', $review)->with('success', 'Категория сохранена');
    }

    public function show(Review $review)
    {
        return view('admin.review.show', compact('review'));
    }

    public function edit(Review $review)
    {
        return view('admin.review.edit', compact('review'));
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        $review->update($request->validated());

        return redirect()->route('admin.review.show', compact('review'))->with('success', 'Категория обновлена');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.review.index')->with('success', 'Категория удалена');
    }

    public static function getMenuItem(): array
    {
        return [
            'icon'  => 'comments-o',
            'title' => 'Отзывы',
            'url'   => route('admin.review.index'),
        ];
    }

    public static function getMenuPosition(): int
    {
        return 6;
    }
}
