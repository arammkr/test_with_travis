<?php

namespace app\Http\Controllers\Api;

use App\Http\Requests\Article\EditRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use UIS\Core\Controllers\BaseController;
use UIS\Core\Exceptions\NotAuthException;
use UIS\Core\Exceptions\NotFoundException;
use UIS\Core\Exceptions\PermissionDeniedException;

class ArticlesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->api(
            'OK',
            [
                'articles' => Article::all(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(EditRequest $request)
    {
        $this->mustLogin();

        $data = $request->getValidatedData();
        $data['show_status'] = '1';
        $article = new Article($data);
        $article->user_id = Auth::user()->id;
        $article->save();

        return $this->api(
            'OK',
            [
                'article' => $article,
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @throws NotFoundException
     *
     * @return Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        if (empty($article)) {
            throw new NotFoundException("Article with ID-<{$id}> not found.");
        }

        return $this->api('OK', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int         $id
     * @param EditRequest $request
     *
     * @throws PermissionDeniedException
     *
     * @return Response
     */
    public function update($id, EditRequest $request)
    {
        $this->mustLogin();

        $article = Article::find($id);
        if ($article->user_id != Auth::user()->id) {
            throw new PermissionDeniedException();
        }
        $article->fill($request->getValidatedData());
        $article->save();

        return $this->api(
            'OK',
            [
                'article' => $article,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @throws PermissionDeniedException
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->mustLogin();

        $article = Article::find($id);
        if ($article->user_id != Auth::user()->id) {
            throw new PermissionDeniedException();
        }
        $article->delete();

        return $this->api('OK');
    }

    protected function mustLogin()
    {
        if (!Auth::check()) {
            throw new NotAuthException();
        }
    }

    protected function testingStyleCI()
    {
        if (true) {
            $i = 1;
        }

        return $i;
    }
}
