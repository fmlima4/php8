<?php
namespace App\Services;

use App\{Serie, Temporada, Episodio};
use Illuminate\Support\Facades\DB;
use App\Events\DeleteSerie;
use App\Jobs\ExcluirCapaSerie;

class RemovedorDeSerie
{
    public function removerSerie(int $serieId): string
    {
        $nomeSerie = '';
        DB::transaction(function () use ($serieId, &$nomeSerie) {
            $serie = Serie::find($serieId);

            $serieObj = (object) $serie->toArray();


            $nomeSerie = $serie->nome;

            $this->removerTemporadas($serie);
            $serie->delete();

            $evento = new DeleteSerie($serieObj);
            event($evento);

            //ExcluirCapaSerie::dispatch($serieObj);
        });

        return $nomeSerie;
    }

    /**
     * @param $serie
     */
    private function removerTemporadas(Serie $serie): void
    {
        $serie->temporadas->each(function (Temporada $temporada) {
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });
    }

    /**
     * @param Temporada $temporada
     */
    private function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }
}
