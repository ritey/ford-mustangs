<?php

namespace App\Http\Controllers;

use File;
use Mail;
use Illuminate\Http\Request;
use CoderStudios\Requests\ContactRequest;
use Illuminate\Contracts\Cache\Repository as Cache;

class HomeController extends BaseController
{

    /**
     * Laravel Request Repository
     *
     * @var object
     */
    protected $request;

    /**
     * Laravel Cache Repository
     *
     * @var object
     */
    protected $cache;

    /**
     * Create a new home controller instance.
     *
     * @return void
     */
	public function __construct(Request $request, Cache $cache)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->request = $request;
		$this->cache = $cache;
	}

	public function index()
	{
        $key = $this->getKeyName(__function__);
        if (env('CACHE_ENABLED',0) && $this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $view = view('pages.home',compact('vars'))->render();
            $this->cache->add($key, $view, env('APP_CACHE_MINUTES',60));
        }
        return $view;
	}

    public function gallery()
    {
        $key = $this->getKeyName(__function__);
        if (env('CACHE_ENABLED',0) && $this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $gt350 = $gt500 = $twenty_fifteen = $new = [];
            $gt350_files = File::allFiles(public_path() . '/images/gt350');
            foreach($gt350_files as $item) {
                $gt350[] = ['file' => '/images/gt350/'.$item->getFilename(), 'tag' => 'GT350'];
            }
            $gt500_files = File::allFiles(public_path() . '/images/gt500');
            foreach($gt500_files as $item) {
                $gt500[] = ['file' => '/images/gt500/'.$item->getFilename(), 'tag' => 'GT500 1967'];
            }
            $new_files = File::allFiles(public_path() . '/images/2017');
            foreach($new_files as $item) {
                $new[] = ['file' => '/images/2017/'.$item->getFilename(), 'tag' => '2017'];
            }
            $twenty_fifteen_files = File::allFiles(public_path() . '/images/2015');
            foreach($twenty_fifteen_files as $item) {
                $twenty_fifteen[] = ['file' => '/images/2015/'.$item->getFilename(), 'tag' => '2015'];
            }
            $vars = [
                'tags' => [
                    'GT350',
                    'GT500',
                    '1967',
                    '2017',
                    '2015',
                ],
                'pics' => [
                    'GT350' => $gt350,
                    'GT500' => $gt500,
                    '2017'  => $new,
                    '2015'  => $twenty_fifteen,
                ],
            ];
            $view = view('pages.gallery',compact('vars'))->render();
            $this->cache->add($key, $view, env('APP_CACHE_MINUTES',60));
        }
        return $view;
    }

    public function galleryItem($file = '')
    {
        $key = $this->getKeyName(__function__ . md5($file));
        if (env('CACHE_ENABLED',0) && $this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $vars = [
                'img' => urldecode(str_replace('|','/',$file)),
            ];
            $view = view('pages.gallery-item',compact('vars'))->render();
            $this->cache->add($key, $view, env('APP_CACHE_MINUTES',60));
        }
        return $view;
    }

    public function articles()
    {
        $key = $this->getKeyName(__function__);
        if (env('CACHE_ENABLED',0) && $this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $articles = $this->articleDetails();
            $vars = [
                'articles' => $articles->sortByDesc('id'),
            ];
            $view = view('pages.articles',compact('vars'))->render();
            $this->cache->add($key, $view, env('APP_CACHE_MINUTES',60));
        }
        return $view;
    }

    private function articleDetails()
    {
        $v8 = [
            'id'            => 2,
            'title'         => '5.0-litre V8',
            'page_title'    => 'Ford Mustang 5.0-litre V8 engine article',
            'meta_description' => 'The Ford Mustang 2015 5.0-litre V8 has been tickled to give better performance.',
            'description'   => '<p>The 2015 Ford Mustang V8 has been improved from lessons learnt developing the 
            special edition <a href="'.route('article',['slug' => '2013-mustang-boss-302']).'">2013 Ford Mustang Boss 302</a>.</p>
            <p>The alterations include:</p>
            <ul><li>Larger intake valves</li><li>Larger exhaust valves</li><li>Revised intake camshafts</li><li>Revised exhaust camshafts</li>
            <li>Stiffer valve springs</li><li>Improved cylinder head ports</li><li>Larger valves</li><li>Lighter and more durable rods</li><li>Rebalanced forged crankshaft</li></ul>
            <p>Along with the internal changes, the intake manifold has been adapted to allow for partially closed port flow at lower engine speeds.
            This will improve air-fuel mixture and economy, idle stability and emissions.</p>
            <p>These changes should bring around 420 horsepower and 390 lb.-ft of torque, a similar rating to the 2013-2014 Ford Mustang GT.</p>
            ',
            'intro'         => 'The Ford Mustang "Coyote" 2015 V8 has been tickled to give better performance by enabling better exhaust and intake performance at higher revs.',
            'date'          => '03 MAY',
            'author'        => 'David Wright',
            'img'           => '/images/articles/2015-ford-mustang-5-0-liter-v8-1.jpg',
            'slug'          => '2015-5.0-litre-v8',
            'link'          => route('article',['slug' => '2015-5.0-litre-v8']),
        ];
        $ecoboost = [
            'id'            => 1,
            'title'         => '2.3-litre EcoBoost',
            'page_title'    => 'Ford Mustang 2.3-litre EcoBoost engine article',
            'meta_description' => 'The 2015 Ford Mustang will be the first to feature Ford\'s 2.3-litre EcoBoost inline four engine.',
            'description'   => '<p>Ford says, the 2.3-litre EcoBoost engine in the Ford Mustang has been enhanced specifically for the Ford Mustang. The intake manifold and turbocharger housing has been improved to to increase the output
            to better suite the Ford Mustang performance expectation while providing the also expected efficiency and economy from this 2.3-litre power unit.</p><p>As with other EcoBoost engines, direct fuel injection, twin independent variable 
            camshaft timing and turbocharging are a few of the modern technologies used to help bring the driveability in any conditions in the smaller displacement unit.</p><p>To go with tweaked 2.3-liter performance some of the interals have been 
            updated, these include:</p><ul>
            <li>Forged-steel crankshaft</li>
            <li>Piston-cooling jets</li>
            <li>Steel piston ring carriers</li>
            <li>Premium bearing materials</li>
            <li>Upgraded valve seat materials</li>
            <li>Forged-steel connecting rods</li>
            <li>High-pressure die-cast aluminum cylinder block with ladder-frame bearing caps</li>
            <li>Deep-sump, die-cast aluminum oil pan</li>
            </ul><p>With the ability to overtake well thanks to the turbo technology and torque delivery the only thing not going for the 2.3-litre EcoBoost is the sound of the glorious <a href="'.route('article',['slug' => '2015-5.0-litre-v8']).'">5.0-litre V8</a>.</p>',
            'intro'         => 'The 2015 Ford Mustang will be the first to feature Ford\'s 2.3-litre EcoBoost inline four engine. Generating 305 horsepower and 300 lb.-ft of torgue, the performance
            isn\'t all that bad and comes with great efficiency in comparison to the <a href="'.route('article',['slug' => '2015-5.0-litre-v8']).'">5.0-litre V8</a>.',
            'date'          => '01 MAY',
            'author'        => 'David Wright',
            'img'           => '/images/articles/2015-ford-mustang-2-3-liter-i4-ecoboost-1.jpg',
            'slug'          => '2015-2.3-litre-ecoboost',
            'link'          => route('article',['slug' => '2015-2.3-litre-ecoboost']),
        ];
        $boss = [
            'id'            => 3,
            'title'         => '2013 Mustang Boss 302',
            'page_title'    => '2013 Ford Mustang Boss 302',
            'meta_description' => '',
            'description'   => '',
            'intro'         => '',
            'date'          => '05 MAY',
            'author'        => 'David Wright',
            'img'           => '/images/articles/2012-ford-mustang-boss-302-laguna-seca-photo-387581-s-986x603.jpg',
            'slug'          => '2013-mustang-boss-302',
            'link'          => route('article',['slug' => '2013-mustang-boss-302']),
        ];
        $articles = collect([$v8,$ecoboost,$boss]);
        return $articles;
    }

    public function article($slug = '')
    {
        if (empty($slug)) {
            return redirect()->route('article.index');
        }

        $article = '';
        $articles = $this->articleDetails();
        $article = $articles->where('slug',$slug)->first();

        if (empty($article)) {
            return redirect()->route('article.index');
        }

        $key = $this->getKeyName(__function__ . md5($slug));
        if (env('CACHE_ENABLED',0) && $this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {

            $vars = [
                'article' => $article,
            ];

            $view = view('pages.article',compact('vars'))->render();
            $this->cache->add($key, $view, env('APP_CACHE_MINUTES',60));
        }
        return $view;
    }

    public function contact()
    {
        $key = $this->getKeyName(__function__);
        if (env('CACHE_ENABLED',0) && $this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $view = view('pages.contact',compact('vars'))->render();
            $this->cache->add($key, $view, env('APP_CACHE_MINUTES',60));
        }
        return $view;
    }

    public function contactSend(ContactRequest $request)
    {
		try {
			Mail::send(array('text' => 'emails.admin.site-message'), array('data' => $request->all()), function($message) {
				$message->to('dave+mustangs@coderstudios.com', 'Dave')->subject('Ford Mustangs website message');
			});
		} catch(Exception $e) {
			return Redirect::back()->with('error_message','<strong>Warning:</strong> Message not sent!')->withInput();
		}

        $key = $this->getKeyName(__function__);
        if (env('CACHE_ENABLED',0) && $this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $view = view('pages.contact-send',compact('vars'))->render();
            $this->cache->add($key, $view, env('APP_CACHE_MINUTES',60));
        }
        return $view;
    }
}