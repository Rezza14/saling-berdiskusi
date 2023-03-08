<?php

namespace App\Services;

use App\Http\Requests\Page\StorePageRequest;
use App\Http\Requests\Page\UpdatePageRequest;
use App\Models\Page;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class PageService extends BaseService
{
    private Page $page;

    public function __construct()
    {
        $this->page = new Page();
    }

    public function index(Request $request): object
    {
        try {
            $page = $this->page->query()->orderByDesc('created_at');
            $page->when($request->filled('title'), function ($query) use ($request) {
                return $query->where('title', 'like', "%$request->title%");
            });

            return $this->response(true, 'Successfully get page data', $page);
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StorePageRequest $request): object
    {
        DB::beginTransaction();
        try {
            $page = $this->page->create($request->validated());
            DB::commit();

            return $this->response(true, 'Successfully added page data', $page);
        } catch (Exception $e) {
            DB::rollback();
            Log::emergency($e->getMessage());

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdatePageRequest $request, Page $page): object
    {
        DB::beginTransaction();
        try {
            $page->update($request->validated());
            DB::commit();

            return $this->response(true, 'Successfully chaged Page data', $page);
        } catch (Exception $e) {
            DB::commit();
            Log::emergency($e->getMessage());

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(Page $page): object
    {
        DB::beginTransaction();
        try {
            $page->delete();
            DB::commit();

            return $this->response(true, 'Successfully deleted page data');
        } catch (Exception $e) {
            DB::rollBack();
            Log::emergency($e->getMessage());

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
