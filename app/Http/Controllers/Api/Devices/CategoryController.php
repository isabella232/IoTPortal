<?php

namespace App\Http\Controllers\Api\Devices;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Device;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $query = Auth::user()->deviceCategories()->select(['id', 'unique_id', 'name']);

        if ($request->has('filters')) {
            $filters = json_decode($request->input('filters'));

            foreach ($filters as $key => $value) {
                if ($key === 'unique_id') $query->uniqueIdLike($value->value);
                if ($key === 'name') $query->nameLike($value->value);
                if ($key === 'globalFilter') {
                    $query->where(function ($query) use ($value) {
                        $query->uniqueIdLike($value->value)
                            ->orWhere->nameLike($value->value);
                    });
                }
            }
        }

        if ($request->has('sortField')) {
            if ($request->input('sortOrder') === '1')
                $query->orderBy($request->input('sortField'));
            else
                $query->orderByDesc($request->input('sortField'));
        }

        $maxRows = Config::get('constants.index_max_rows');
        $rows = (int)$request->input('rows', 10) > $maxRows ? $maxRows : (int)$request->input('rows', 10);

        $deviceCategories = $query->paginate($rows);

        return Helper::apiResponseHttpOk(['deviceCategories' => $deviceCategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            TODO unique validation based on user
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        if ($validator->fails()) {
            return Helper::apiResponseHttpBadRequest($validator->getMessageBag()->toArray());
        }

        $deviceCategory = Auth::user()->deviceCategories()->create([
            'name' => $request->input('name'),
        ]);

        if ($deviceCategory->exists) {
            return Helper::apiResponseHttpOk(['deviceCategory' => $deviceCategory]);
        }

        return Helper::apiResponseHttpInternalServerError('Failed to create device category');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $category = Category::where('id', $id)
            ->orWhere('unique_id', $id)
            ->first();

        return Helper::apiResponseHttpOk(['deviceCategory' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($category->id),
            ],
        ]);

        if ($validator->fails()) {
            return Helper::apiResponseHttpBadRequest($validator->getMessageBag()->toArray());
        }

        $success = $category->update([
            'name' => $request->input('name'),
        ]);

        if ($success) {
            return Helper::apiResponseHttpOk(['deviceCategory' => $category]);
        }

        return Helper::apiResponseHttpInternalServerError('Failed to update device category');
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroySelected(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ids.*' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return Helper::apiResponseHttpBadRequest($validator->getMessageBag()->toArray());
        }

        $success = Auth::user()->deviceCategories()->whereIn('categories.id', $request->input('ids'))->delete();

        return Helper::apiResponseHttpOk([], $success);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function options(Request $request)
    {
        $query = Auth::user()->deviceCategories()->select(['id as value', 'name as label']);

        if ($request->has('name')) {
            $query->where('name', 'like', "%{$request->input('name')}%");
        }

        return Helper::apiResponseHttpOk(['deviceCategories' => $query->get()]);
    }

    /**
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function validateField(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //            TODO unique validation based on user
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        if ($validator->fails()) {
            return Helper::apiResponseHttpBadRequest($validator->getMessageBag()->toArray());
        }

        return Helper::apiResponseHttpOk();
    }
}
