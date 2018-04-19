<?php

namespace App\Console\Commands;

use App\Models\Genre;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportGenreList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:genres';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports all genres into the database table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $genre_file = Storage::disk('local')->get('data_files/genres.txt');
        foreach(preg_split('/\r\n|\n|\r/', trim($genre_file)) as $item){
            $found_genre = Genre::where('genre',str_slug($item,'_'))->first();
            if(!$found_genre){
                $genre = new Genre();
                $genre->genre = str_slug($item,'_');
                $genre->pretty_name = ucfirst($item);
                $genre->save();
                $this->line('Added Genre: '.$item);
            }else{
                $this->info('Genre: '.$item.' already exists, skipping.');
            }
        }
    }
}
