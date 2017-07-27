<?php
namespace App\Modules\Torrent\Transformers;

use App\Support\Transformer;

class StatsTransformer extends Transformer
{
    /**
     * Transform item
     *
     * @param \Transmission\Model\Stats\Session $item
     *
     * @return mixed
     */
    public function make($item)
    {
        return [
            'torrents' => [
                'active' => $item->getActiveTorrentCount(),
                'paused' => $item->getPausedTorrentCount(),
                'total'  => $item->getTorrentCount(),
            ],
            'download' => $item->getDownloadSpeed(),
            'upload'   => $item->getUploadSpeed(),
        ];
    }
}
