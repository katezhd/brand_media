<?php

namespace App\Console\Commands;

use App\Models\Author;
use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemaps';

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
     * @return int
     */
    public function handle()
    {
        $filesystem = new Filesystem;
        
        $sitemap = App::make("sitemap");

        // Generate sitemap folders
        $dirs = [
            'news',
            'category',
            'tag',
            'author',
            'page'
        ];

        foreach ($dirs as $dir) {
            $dir = 'public/sitemaps/' . $dir;
            
            if(!Storage::exists($dir)) {
                Storage::makeDirectory($dir, 0775, true);
            } else {
                $filesystem->cleanDirectory($dir);
            }
        }

        $sitemapCounter = 0;
        News::select('uri', 'published_at')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', Carbon::now()->toDateTimeString())
            ->where('is_published', 1)
            ->orderBy('published_at', 'desc')
            ->chunk(50000, function($items) use (&$sitemapCounter, $sitemap) {
                $sitemapCounter++;
                $this->generate($items, 'news', $sitemapCounter, $sitemap);
            });

        // CATEGORIES
        $categories = Category::select('categories.uri', 'news.published_at')
            ->leftJoin('news', function($query) {
                $query->on('categories.id','=','news.category_id')
                    ->whereRaw('news.id IN (select MAX(n2.id) from news as n2 join categories as c2 on c2.id = n2.category_id group by c2.id)');
            })
            ->whereNotNull('categories.published_at')
            ->orderBy('news.published_at', 'desc')
            ->get();

        foreach ($categories as $category) {
            $sitemap->add(URL::to('/category/' . $category->uri), Carbon::parse($category->published_at)->toAtomString());
        }
    
        $sitemap->store('xml', Storage::url('public/sitemaps/category/sitemap'));
        $sitemap->addSitemap(URL::to(Storage::url('public/sitemaps/category/sitemap.xml')));
        $sitemap->model->resetItems();
        
        
        // TAGS
        $sitemapCounter = 0;
        Tag::select('tags.uri', 'news.published_at')
            ->leftJoin('news_tags_rel', function($query) {
                $query->on('tags.id','=','news_tags_rel.tag_id')
                    ->whereRaw('news_tags_rel.id IN (select MAX(n2.id) from news_tags_rel as n2 join tags as c2 on c2.id = n2.tag_id group by c2.id)');
            })
            ->leftJoin('news', function($query) {
                $query->on('news_tags_rel.news_id','=','news.id');
            })
            ->whereNotNull('tags.published_at')
            ->orderBy('news.published_at', 'desc')
            ->where('tags.is_system', 0)
            ->chunk(50000, function($items) use (&$sitemapCounter, $sitemap) {
                $sitemapCounter++;
                $this->generate($items, 'tag', $sitemapCounter, $sitemap);
            });

        // AUTHORS
        $authors = Author::select('authors.uri', 'news.published_at')
            ->leftJoin('news', function($query) {
                $query->on('authors.id','=','news.author_id')
                    ->whereRaw('news.id IN (select MAX(n2.id) from news as n2 join authors as c2 on c2.id = n2.author_id group by c2.id)');
            })
            ->whereNotNull('authors.published_at')
            ->orderBy('news.published_at', 'desc')
            ->get();

        foreach ($authors as $author) {
            $sitemap->add(URL::to('/author/' . $author->uri), Carbon::parse($author->published_at)->toAtomString());
        }

        $sitemap->store('xml', Storage::url('public/sitemaps/author/sitemap'));
        $sitemap->addSitemap(URL::to(Storage::url('public/sitemaps/author/sitemap.xml')));
        $sitemap->model->resetItems();

        // PAGES
        $pages = Page::select('uri', 'published_at')
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get();
        
        foreach ($pages as $page) {
            $sitemap->add(URL::to('/' . $page->uri), Carbon::parse($page->published_at)->toAtomString());
        }

        $sitemap->store('xml', Storage::url('public/sitemaps/page/sitemap'));
        $sitemap->addSitemap(URL::to(Storage::url('public/sitemaps/page/sitemap.xml')));
        $sitemap->model->resetItems();

        $sitemap->store('sitemapindex', 'sitemap');

        return Command::SUCCESS;
    }

    /**
     * Generate sitemap for specific type of urls.
     *
     */

    public function generate($items = [], $type = 'news', $sitemapCounter, $sitemap)
    {
        foreach ($items as $item) {
            $sitemap->add(URL::to('/' . $type . '/' . $item->uri), Carbon::parse($item->published_at)->toAtomString());
        }
        
        $sitemap->store('xml', Storage::url('public/sitemaps/' . $type . '/sitemap-' . $sitemapCounter));
        $sitemap->addSitemap(URL::to(Storage::url('public/sitemaps/' . $type . '/sitemap-' . $sitemapCounter . '.xml')));
        $sitemap->model->resetItems();
    }
}
