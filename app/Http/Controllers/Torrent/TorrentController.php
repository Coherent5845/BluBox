<?php
namespace App\Http\Controllers\Torrent;

use DB;
use Exception;

use App\Http\Controllers\Controller;
use App\Http\Requests\Torrent\AddTorrentRequest;
use App\Http\Requests\Torrent\RemoveTorrentRequest;
use App\Http\Requests\Torrent\ToggleTorrentRequest;

use App\Modules\Category\Category;
use App\Modules\File\FileRepository;
use App\Modules\Torrent\TorrentService;
use App\Modules\Torrent\Jobs\UpdateFiles;
use App\Modules\Torrent\Jobs\CheckFinishedTorrents;
use App\Modules\Torrent\Transformers\TorrentTransformer;

class TorrentController extends Controller
{
    /**
     * @var TorrentService
     */
    private $service;

    /**
     * @var FileRepository
     */
    private $fileRepository;

    /**
     * TorrentController constructor.
     */
    public function __construct(TorrentService $service, FileRepository $fileRepository)
    {
        $this->service        = $service;
        $this->fileRepository = $fileRepository;
    }

    /**
     * Get list of torrents
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $torrents = $this->service->get()->sortByDesc(function ($item) {
            return $item->getId();
        })->values();

        $this->dispatchNow(
            new UpdateFiles($torrents)
        );

        return $this->response()->collection($torrents, new TorrentTransformer());
    }

    /**
     * Add new torrent to transmission
     *
     * @param AddTorrentRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AddTorrentRequest $request)
    {
        $category = Category::findOrFail($request->category);

        DB::beginTransaction();

        try {
            $attributes = [
                'name'        => $request->name,
                'year'        => $request->year,
                'rating'      => $request->rating,
                'episode'     => $request->episode,
                'runtime'     => trim(str_replace('min', '', $request->runtime)),
                'category_id' => $category->id,
                'user_id'     => $request->user()->id,
            ];

            $file = $this->fileRepository->addFile($attributes)
                                         ->syncGenres($request->genres)
                                         ->addCover($request->cover)
                                         ->addTorrent($request->type, $category->getFileDirectory())
                                         ->updateTorrentData();

            $parent = $this->fileRepository->new();

            if ($parent->assignWhenExists('name', '=', $request->name)) {
                $parent->addSubtitles('subtitles.lang', 'subtitles.subtitles', 'subtitles.episode');
            } else {
                $file->addSubtitles('subtitles.lang', 'subtitles.subtitles', 'subtitles.episode');
            }

            DB::commit();

            return $this->response()->created();
        } catch (Exception $e) {
            DB::rollback();

            return $this->response()->errorInternal('Could not add torrent.');
        }
    }

    /**
     * Pause or Start torrent
     *
     * @param string $hash
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggle($hash)
    {
        try {
            $status = $this->fileRepository->toggle($hash);

            return $this->response()->make(compact('status'));
        } catch (Exception $e) {
            return $this->response()->errorMethodNotAllowed('already_finished');
        }
    }

    /**
     * Remove torrent
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function remove()
    {
        $this->service->remove(request()->get('hash'));

        return $this->response()->noContent();
    }
}
