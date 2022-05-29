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
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreReviewRequest $request)
    {
        //
    }

    public function show(Review $review)
    {
        //
    }

    public function edit(Review $review)
    {
        //
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    public function destroy(Review $review)
    {
        //
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
