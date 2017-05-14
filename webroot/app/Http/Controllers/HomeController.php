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
            'intro'         => '<p>The Ford Mustang "Coyote" 2015 V8 has been tickled to give better performance by enabling better exhaust and intake performance at higher revs.</p>',
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
            'intro'         => '<p>The 2015 Ford Mustang will be the first to feature Ford\'s 2.3-litre EcoBoost inline four engine. Generating 305 horsepower and 300 lb.-ft of torgue, the performance
            isn\'t all that bad and comes with great efficiency in comparison to the <a href="'.route('article',['slug' => '2015-5.0-litre-v8']).'">5.0-litre V8</a>.</p>',
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
            'meta_description' => 'The 2013 Ford Mustang Boss 302 given the economoy probably shouldn\'t of been produced, but it was and it\'s brilliant.',
            'description'   => '<p>The 2013 Ford Mustang Boss 302 with 444bhp doesn\'t overwhelm the chassis instead it feels right at home and gives you confidence and a sense of occassion. Thanks to the tweaked cyclinder head, 
            altered ports, camshafts and bigger intake values the engine revs very quickly.</p><p>The Ford Mustang Boss 302 is a real BMW M3 contender only being 0.1 seconds slower to 60mph and 0.4 seconds slower over a quarter-mile.
            That said with all the power and live rear axel, pulling away with good traction does take a bit of pracice, you could find yourself tramping and going through a fair few tyres if you only believe in foot down and dropping the clutch.</p>
            <p>The interior, like other Mustangs though doesn\'t hold up against an M3 sadly. Plastics are still basic and even with the suede styled steering wheel and alloy accents the fact that you can\'t adjust the steering column and the pedals, unless you have huge feet, are too far apart.</p>
            <p>Overall, despite the lacking interior, with the upgraded engine, suspension and great progressive driving experience Ford have actually managed to make a modern day improvement on a classic which is unusual. The 2013 Ford Mustang Boss 302 lives up to the badge and with it\'s limited run 
            numbers is bound to be a great addition to any collection of American muscle.</p>',
            'intro'         => '<p>The 2013 Ford Mustang Boss 302 sits nicely between the Mustang GT and the Shelby GT500 in terms of power sitting with 444bhp against 412bhp in the GT and 550bhp in the Shelby Mustang.</p>',
            'date'          => '05 MAY',
            'author'        => 'David Wright',
            'img'           => '/images/articles/2012-ford-mustang-boss-302-laguna-seca-photo-387581-s-986x603.jpg',
            'slug'          => '2013-mustang-boss-302',
            'link'          => route('article',['slug' => '2013-mustang-boss-302']),
        ];
        $history = [
            'id'            => 4,
            'title'         => 'The history of the Ford Mustang',
            'page_title'    => 'The history of the Ford Mustang',
            'meta_description' => 'The Ford Mustang was first seen in 1962 as a 2 seater concept car and has since had 6 evolutions and is still currently on sale in 2017.',
            'description'   => '<p>The Ford Mustang was first seen in 1962 as a 2 seater concept car and has since had 6 evolutions and is still currently on sale in 2017. In 1963 the 2nd generation concept car appeared as a four-seater to see how well it would fair in the market against the likes of the Plymouth Barracuda.</p>
            The Ford Mustang was developed over an incredible 18 months and smashed early predicted sales estimates. It shared many components from existing Ford models like the Ford Falcon and Ford Fairlane.</p><p>As the years progressed changes naturally occured as the car market evoloved, sadly 
            for the Mustang this meant bigger and heavier without matching performance improvements.</p>
            <ul>
                <li>1964.5 - 1973 MKI Ford Mustang - 1st generation Ford Mustang</li>
                <li>1974 - 1978 MKII Ford Mustang - 2nd generation Ford Mustang</li>
                <li>1979 - 1993 MKIII Ford Mustang - 3rd generation Ford Mustang</li>
                <li>1994 - 2004 MKIV Ford Mustang - 4th generation Ford Mustang</li>
                <li>2005 - 2014 MKV Ford Mustang - 5th generation Ford Mustang</li>
                <li>2015 - Present MKVI Ford Mustang - 6th generation Ford Mustang</li>
            </ul>',
            'intro'         => '<p>The Ford Mustang was first seen in 1962 as a 2 seater concept car and has since had 6 evolutions and is still currently on sale in 2017. In 1963 the 2nd generation concept car appeared as a four-seater to see how well it would fair in the market against the likes of the Plymouth Barracuda.</p>',
            'date'          => '10 MAY',
            'author'        => 'David Wright',
            'img'           => '/images/articles/ford-mustang-logo.jpg',
            'slug'          => 'history-ford-mustang',
            'link'          => route('article',['slug' => 'history-ford-mustang']),
        ];
        $clubs = [
            'id'            => 5,
            'title'         => 'Ford Mustang UK Clubs',
            'page_title'    => 'Ford Mustang UK Clubs',
            'meta_description' => 'UK Ford Mustang clubs. Active clubs with Ford Mustangs, Ford Mustang Meets and Ford Mustang Events in the UK',
            'description'   => '<p>These clubs are not affiliated with www.ford-mustangs.co.uk and if you have a club you would like listed here that isn\'t please get in touch.</p>
            <ul>
                <li><a href="http://www.mocgb.net" target="_blank">Mustang Owners Club of Great Britain</a></li>
            </ul>
            ',
            'intro'         => '<p>A collection of clubs in the UK for owners and fans of Ford Mustangs.</p>',
            'date'          => '14 MAY',
            'author'        => 'David Wright',
            'img'           => '/images/articles/ford-mustang-logo.jpg',
            'slug'          => 'uk-ford-mustang-clubs',
            'link'          => route('article',['slug' => 'uk-ford-mustang-clubs']),
        ];
        $articles = collect([$v8,$ecoboost,$boss,$history,$clubs]);
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