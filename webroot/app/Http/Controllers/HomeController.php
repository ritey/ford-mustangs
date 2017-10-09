<?php

namespace App\Http\Controllers;

use App;
use URL;
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
            $articles = $this->articleDetails();
            $vars = [
                'articles' => $articles->sortByDesc('id')->take(6),
            ];
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
            $gt350 = $gt500 = $twenty_fifteen = $new = $twenty_eighteen = [];
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
            $twenty_eighteen_files = File::allFiles(public_path() . '/images/2018');
            foreach($twenty_eighteen_files as $item) {
                $twenty_eighteen[] = ['file' => '/images/2018/'.$item->getFilename(), 'tag' => '2018'];
            }
            $vars = [
                'tags' => [
                    'GT350',
                    'GT500',
                    '1967',
                    '2018',
                    '2017',
                    '2015',
                ],
                'pics' => [
                    'GT350' => $gt350,
                    'GT500' => $gt500,
                    '2018'  => $twenty_eighteen,
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

    private function carDetails()
    {
        $ad1 = [
            'id' => 1,
            'title' => '1966 Ford Mustang Shelby GT350',
            'page_title' => '1966 Ford Mustang Shelby GT350 For Sale - UK',
            'meta_description' => '1966 Ford Mustang Shelby GT350 For Sale - UK',
            'description' => '<p>A superbly presented 1966 Shelby GT350 which is currently set up for track use and road rallies. (Wimbledon White with Guardsman Blue stripes)</p>
            <p>The car includes two motors, one very sharp Steve Warrior 289/4.7L FIA engine showing c.420 HP.</p>
            <p>The other motor included being the original Hi-Po road engine with the very desirable and rare Paxton Supercharger option.</p>
            <p>The car is fully prepared to FIA appendix K with all the right parts and with a current MSA issued HTP.</p>
            <p>This GT350 is race prepared and ready to go but eminently road drivable with current MOT and full interior.</p>
            <p>An incredibly usable GT350 which seems to be a Blue Chip Investment.</p>
            <p>Contact BILL SHEPHERD MUSTANG - 01932 340888</p>',
            'price' => '155,000',
            'intro' => 'A superbly presented 1966 Shelby GT350 which is currently set up for track use and road rallies. (Wimbledon White with Guardsman Blue stripes)',
            'state' => 'FOR SALE',
            'img' => '/images/cars/1966-gt350-1.jpeg',
            'images' => [
                '/images/cars/1966-gt350-1.jpeg',
                '/images/cars/1966-gt350-2.jpeg',
                '/images/cars/1966-gt350-3.jpeg',
            ],
            'slug' => '1966-ford-mustang-shelby-gt350-uk',
            'link' => route('sale',['slug' => '1966-ford-mustang-shelby-gt350-uk']),
        ];
        $ad2 = [
            'id' => 2,
            'title' => '2015 Ford Mustang Shelby GT',
            'page_title' => '2015 Ford Mustang Shelby GT For Sale - UK',
            'meta_description' => '2015 Ford Mustang Shelby GT For Sale - UK @ Bill Shepherd Mustang',
            'description' => '<p>A 2015 Ford Mustang Shelby GT with the full American Shelby GT upgrade pack installed including a supercharging and intake boost up to 670bhp.</p>
            <p>This 2015 Ford Mustang Shelby GT also includes:</p>
            <ul>
                <li>Shelby/Wildwood big brake conversion</li>
                <li>High performance springs/dampers</li>
                <li>Upgrade rollbars</li>
                <li>Shelby drive shafts</li>
                <li>Shelby Venice forged Aluminium allows in black</li>
                <li>Carbon aero body kit</li>
                <li>Upgrade performance exhaust</li>
                <li>Short shift</li>
                <li>Shelby instruments</li>
            </ul>
            <p>As well as being stunning this Ford Mustang packs a huge performance punch and insane torque but still manages to be an awesome everyday drive.</p>
            <p>Contact BILL SHEPHERD MUSTANG - 01932 340888</p>',
            'price' => '79,950',
            'intro' => 'A 2015 Ford Mustang GT with full American performance pack fitted this stunning easy to drive performance monster mustang is an ideal collectors car.',
            'state' => 'FOR SALE',
            'img' => '/images/cars/2015-ford-mustang-gt.jpeg',
            'images' => [
                '/images/cars/2015-ford-mustang-gt.jpeg',
                '/images/cars/2015-ford-mustang-gt-2.jpeg',
                '/images/cars/2015-ford-mustang-gt-3.jpeg',
                '/images/cars/2015-ford-mustang-gt-4.jpeg',
                '/images/cars/2015-ford-mustang-gt-5.jpeg',
            ],
            'slug' => '2015-ford-mustang-gt-uk',
            'link' => route('sale',['slug' => '2015-ford-mustang-gt-uk']),
        ];
        $ad3 = [
            'id' => 3,
            'title' => '2015 Ford Mustang 5.0 GT Auto',
            'page_title' => '2015 Ford Mustang 5.0 GT Auto For Sale - UK',
            'meta_description' => '2015 Ford Mustang 5.0 GT Auto For Sale - UK @ Bill Shepherd Mustang',
            'description' => '<p>A 2015 Ford Mustang GT 5.0 litre V8 ready to be bought and taken home today. This is a USA spec Ford Mustang in Deep Impact Blue, previously serviced at Bill Shepherd
            Mustang and fitted with:</p>
            <ul>
                <li>Front running lights</li>
                <li>Louvered bonnet</li>
                <li>Rear spoiler</li>
                <li>18" US spec alloys</li>
                <li>Red rear lights</li>
                <li>Ford performance exhaust</li>
            </ul>
            <p>This auto Ford Mustang also has a reversing camera, HiD headlights, electric seats, cruise control, line lock, premium sound system, SYNC bluetooth and ebony leather interior. 
            As it\'s an American import it also benefits from cheaper car tax at just &pound;230 per year.</p>
            <p>Contact BILL SHEPHERD MUSTANG - 01932 340888</p>',
            'price' => '32,995',
            'intro' => 'A 2015 Auto Ford Mustang GT in Deep Impact Blue with American alloys and rear lights, performance exhaust and the 435BHP 5.0 litre V8.',
            'state' => 'FOR SALE',
            'img' => '/images/cars/2015-ford-mustang-gt-blue.jpeg',
            'images' => [
                '/images/cars/2015-ford-mustang-gt-blue.jpeg',
                '/images/cars/2015-ford-mustang-gt-blue-2.jpeg',
                '/images/cars/2015-ford-mustang-gt-blue-3.jpeg',
                '/images/cars/2015-ford-mustang-gt-blue-4.jpeg',
                '/images/cars/2015-ford-mustang-gt-blue-5.jpeg',
            ],
            'slug' => '2015-ford-mustang-gt-blue-uk',
            'link' => route('sale',['slug' => '2015-ford-mustang-gt-blue-uk']),
        ];
        $ad4 = [
            'id' => 4,
            'title' => '2015 Ford Mustang 2.3 Ecoboost',
            'page_title' => '2015 Black Ford Mustang 2.3 Ecoboost For Sale - UK',
            'meta_description' => '2015 Black Ford Mustang 2.3 Ecoboost For Sale - UK @ Bill Shepherd Mustang',
            'description' => '<p>A 2015 Shadow Black Ford Mustang 2.3 litre EcoBoost with only 7,200 miles and full service history.
            Features include:</p>
            <ul>
                <li>Electric windows</li>
                <li>Power seats</li>
                <li>Push button start</li>
                <li>19" Gloss Black Alloys</li>
                <li>Rear view camera</li>
                <li>Twin exahust</li>
                <li>Red rear brake lights</li>
                <li>Over carpets</li>
            </ul>
            <p>This Ford Mustang is one of the most econmical with the 2.3 litre Ford Ecoboost engines allowing for a motorway range of mid 30 miles per gallon.</p>
            <p>Contact BILL SHEPHERD MUSTANG - 01932 340888</p>',
            'price' => '24,999',
            'intro' => 'A 2015 Shadow Black Ford Mustang with 1 previous owner, full service history and only 7,200 miles ready to drive away today.',
            'state' => 'FOR SALE',
            'img' => '/images/cars/2015-black-ecoboost.jpg',
            'images' => [
                '/images/cars/2015-black-ecoboost.jpg',
                '/images/cars/2015-black-ecoboost-1.jpg',
                '/images/cars/2015-black-ecoboost-2.jpg',
                '/images/cars/2015-black-ecoboost-3.jpg',
                '/images/cars/2015-black-ecoboost-4.jpg',
                '/images/cars/2015-black-ecoboost-5.jpg',
            ],
            'slug' => '2015-black-ford-mustang-ecoboost-uk',
            'link' => route('sale',['slug' => '2015-black-ford-mustang-ecoboost-uk']),
        ];
        $cars = collect([$ad1,$ad2,$ad3,$ad4]);
        return $cars;
    }

    private function articleDetails()
    {
        $v8 = [
            'id'            => 2,
            'title'         => 'Ford 5.0-litre V8 Engine',
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
            'title'         => 'Ford 2.3-litre EcoBoost Engine',
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
                <li><a href="http://www.simplymustangs.co.uk" target="_blank">Simply Mustangs UK</a></li>
            </ul>
            <p>The Mustang Owners club in the UK is the biggest Ford Mustang club with over 1400 members.</p>
            ',
            'intro'         => '<p>A collection of clubs in the UK for owners and fans of Ford Mustangs.</p>',
            'date'          => '14 MAY',
            'author'        => 'David Wright',
            'img'           => '/images/articles/ford-mustang-logo.jpg',
            'slug'          => 'uk-ford-mustang-clubs',
            'link'          => route('article',['slug' => 'uk-ford-mustang-clubs']),
        ];
        $events17 = [
            'id'            => 6,
            'title'         => 'Ford Mustang Events around the UK',
            'page_title'    => 'Ford Mustang Events around the UK',
            'meta_description' => 'Ford Mustang meets occuring all around the UK, if you have an event that isn\'t listed please get in touch.',
            'description'   => '
            <p>A curated list of meetings and events around the UK for Ford Mustangs of any era. If you are organising or know of a Ford Mustang event that isn\'t listed 
            please get in touch with the details of the event and we\'ll add it to the list of other Ford Mustang meets.</p>
            <p><strong>May 2017</strong></p>
            <p>20th May 2017 - Berkshire Ford Mustang meet at The Craven Arms Enborne nr Newbury</p>
            <p>29th May 2017 - GT101 Open Day - Colchester</p>
            <p><strong>June 2017</strong></p>
            <p>4th June 2017 - Classic Ford Show at Santa Pod</p>
            <p>10th June 2017 - Speedfest @ Brands Hatch</p>
            <p><strong>July 2017</strong></p>
            <p>1st July 2017 -  Tatton American Car Show Stars & Stripes at Tatton Park nr Knutsford</p>
            <p>23rd July 2017 - Kents Kit Custom, and American car show at Aylesford Priory, Aylesford</p>
            <p>29th July 2017 - Ace cafe All American Cruise Meets</p>
            <p><strong>August 2017</strong></p>
            <p>6th August 2017 - Silverstone Ford Fair</p>
            <p>20th August 2017 - Annual Mustang Show at Rockingham Castle nr Corby</p>
            <p><strong>September 2017</strong></p>
            <p>3rd September 2017 - Brooklands American Day</p>
            <p>17th September 2017 - Ford day Blackpool</p>
            <p>30th September 2017 - Prescott American Autumn Classic at Prescott Hillclimb</p>
            <p><strong>October 2017</strong></p>
            <p>No Ford Mustang events yet in October</p>
            <p><strong>November 2017</strong></p>
            <p>No Ford Mustang events yet in November</p>
            <p><strong>December 2017</strong></p>
            <p>No Ford Mustang events yet in December</p>
            ',
            'intro'         => '<p>Ford Mustang events listing for 2017, find out what\'s happening and where around the UK with Ford Mustangs.</p>',
            'date'          => '18 MAY',
            'author'        => 'David Wright',
            'img'           => '/images/articles/ford-mustang-logo.jpg',
            'slug'          => 'uk-ford-mustang-events-2017',
            'link'          => route('article',['slug' => 'uk-ford-mustang-events-2017']),
        ];
        $shelby = [
            'id'            => 7,
            'title'         => 'Carroll Hall Shelby was born in 1923',
            'page_title'    => 'Carroll Shelby race driver and tuner',
            'meta_description' => 'Carroll Hall Shelby was born on 11th January 1923 and became a factory driver for Aston Martin',
            'description'   => '
            <p>Carroll Hall Shelby was born on 11th January 1923 and became a factory driver for Aston Martin and Maserati before going 
            on to take part in 8 F1 races.</p>
            <p>In 1959 Shelby was forced to retire from driving due to a heart condition he\'d had from childhood. He went on to continue to work
            with cars by setting up the Shelby-American company and a high performance driving school.</p>
            <p>The Shelby Cobra was the first performance car to be tested by Shelby and friend Dean Moon.</p>
            <p>In 1962 Shelby show\'s the yellow Cobra at the New York Auto Show and goes on to produce more for Ford.</p>
            <p>In 1964 Ford asked Shelby to develop a high-performance Mustang fastback.</p>
            <p>The first 65 Shelby Mustang GT350 race and street cars were produced in September of 1965.</p>
            <p>Hertz, in November 1965 awards the contract to build 200 GT350\'s called the GT350Hs. Specialised Ford Mustang race cars that were popular
            enough to extend the contract to build 1000, 800 more than the intial agreement.</p>
            <p>In June 1966 new 67 GT350 specs and a GT500 was announced which later were delivered to dealers from November.</p>
            <p>Unfortunately in 1969 the Shelby Automotive Racing Company closed and Ford ended the long term racing agreement with Shelby.</p>
            <p>At Ford\'s 100 Years of Racing Festival in 2003 and 45th anniversary for Shelby in 2010, Ford and Shelby reuninted with special edition cars.</p>
            <p>Carroll Shelby sadly passed away at 89 in Dallas Texas. The heart issues experienced from the age of 7 finally caught up with him but his impact
            on the motorsport and automotive world was easily seen with tributes pouring in from around the world.</p>
            <p align="centre"><img src="/images/articles/shelby-hertz.jpg" width="100%" alt="Hertz GT350 Ford Mustangs"></p>
            ',
            'intro'         => '<p>Carroll Hall Shelby was born on 11th January 1923 and became a factory driver for Aston Martin and Maserati before going on to take part in 8 F1 races.</p>',
            'date'          => '28 MAY',
            'author'        => 'David Wright',
            'img'           => '/images/articles/shelby-logo.jpg',
            'slug'          => 'shelby-ford-mustang-history',
            'link'          => route('article',['slug' => 'shelby-ford-mustang-history']),
        ];
        $films = [
            'id'            => 8,
            'title'         => 'Ford Mustangs feature in many films',
            'page_title'    => 'Ford Mustangs feature in many films',
            'meta_description' => 'Ford Mustangs feature in many films, here is a list of the films that starred Ford Mustangs',
            'description'   => '
            <p>Ford Mustangs feature in many films, here is a list of the films that starred Ford Mustangs.</p>
            <ul>
                <li>Bullitt</li>
                <li>Gone in 60 seconds</li>
                <li>Need for speed</li>
                <li>Dead Like Me: Life After Death</li>
                <li>The Whistler</li>
                <li>The Lovely Bones</li>
                <li>Death Race</li>
                <li>Never Back Down</li>
                <li>Wanted</li>
                <li>Redline</li>
                <li>88 Minutes</li>
                <li>Death sentence</li>
                <li>Transformers</li>
                <li>The Bucket List</li>
                <li>I am legend</li>
                <li>Hard Luck</li>
                <li>The Lake House</li>
                <li>Contact High</li>
                <li>Machete</li>
                <li>War of the worlds</li>
                <li>Jackers</li>
                <li>Street Kings 2: Motor City</li>
                <li>Born to Race</li>
                <li>Drive</li>
                <li>Getaway</li>
                <li>Fast and Furious: Tokyo Drift</li>
                <li>Fast and Furious 6</li>
                <li>Fast and Furious 8</li>
            </ul>
            ',
            'intro'         => '<p>Ford Mustangs feature in many films, here is a list of the films that starred Ford Mustangs.</p>',
            'date'          => '02 JUNE',
            'author'        => 'David Wright',
            'img'           => '/images/movies/getaway.jpg',
            'slug'          => 'ford-mustangs-in-film',
            'link'          => route('article',['slug' => 'ford-mustangs-in-film']),
        ];
        $rental = [
            'id'            => 9,
            'title'         => 'Ford Mustangs for hire in the UK',
            'page_title'    => 'Ford Mustangs for hire in the UK',
            'meta_description' => 'Ford Mustangs available to hire from Mustang Rental in Alton Hampshire. Hire a V8 5.0 litre GT Ford Mustang. Ford Mustang Rentals.',
            'description'   => '
            <p>Looking to hire a Ford Mustang? Ford Mustang Rental in the UK from www.mustangrental.co.uk. A 2016 White convertible 5.0 litre V8 
            and Red 2016 5.0 litre V8 fastback is available to hire.</p>
            <p>Based in Alton, Hampshire in the UK, Mustang Rental allows you to hire a 2016 Ford Mustang from David for a day, a weekend or a week or two.</p>
            <p>Mustang Rental will let rent a Ford Mustang for:</p>
            <ul>
                <li>Weddings</li>
                <li>Events</li>
                <li>Photoshoots</li>
                <li>Extended test drives</li>
            </ul>
            <p>A great opportunity to get up close and personal in a Ford Mustang. Experience the power of the V8, the sound and drive yourself and watch people\'s heads turn as
            you cruise past in the rare in comparison to the German and other Ford variants on the roads around the UK.</p>
            <p>Contact <a href="http://its.io/mustangrental" target="_blank">Mustang Rental</a> now to check availability of the Ford Mustangs.</p>
            ',
            'intro'         => '<p>Looking to hire a Ford Mustang? Ford Mustang Rental in the UK from www.mustangrental.co.uk. A White convertible 5.0 litre V8 
            and Red 5.0 litre V8 fastback is available to hire.</p>',
            'date'          => '04 JUNE',
            'author'        => 'David Wright',
            'img'           => '/images/2015/2015-ford-mustang-04.jpg',
            'slug'          => 'ford-mustangs-for-hire-uk',
            'link'          => route('article',['slug' => 'ford-mustangs-for-hire-uk']),
        ];
        $mustang18 = [
            'id'            => 10,
            'title'         => 'New 2018 Ford Mustang',
            'page_title'    => 'New 2018 Ford Mustang announced by Dwayne Johnson',
            'meta_description' => 'New 2018 Ford Mustang announced by Dwayne Johnson, agressive looks, refined improved engines and more equipment announced.',
            'description'   => '
            <p>The face-lifted 2018 Ford Mustang is arriving with a meaner stance with a revised front and rear which should help with aerodynamics.</p>
            <p>Along with the tweaks on the outside, the inside now features the improved 12" digital cluster with tons of driver customisations available along with more driver assistance
            such as Pre-Collision assistant and Pedestrian Detections system.</p>
            <p>One new feature you won\'t necessarily see but might feel is the new MagneRide damper technology which will optimise the ride and improve handling when pushing on in the bends.
            Another mechanical chance is in the transmission where both the auto and manual have revisions, a better clutch setup and new 10 speed auto box will be available.</p>
            <p>You can expect to see the new 2018 Ford Mustang later this year.</p>',
            'intro'         => '<p>New 2018 Ford Mustang announced by Dwayne Johnson, agressive looks, refined improved engines and more equipment announced.</p>',
            'date'          => '10 JUNE',
            'author'        => 'David Wright',
            'img'           => '/images/2018/New-Ford-Mustang-V8-GT-with-Performace-Pack-in-Orange-Fury-1.jpg',
            'slug'          => 'new-2018-ford-mustang',
            'link'          => route('article',['slug' => 'new-2018-ford-mustang']),
        ];
        $articles = collect([$v8,$ecoboost,$boss,$history,$clubs,$events17,$shelby,$films,$rental,$mustang18]);
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

    public function sales()
    {
        $key = $this->getKeyName(__function__);
        if (env('CACHE_ENABLED',0) && $this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $cars = $this->carDetails();
            $vars = [
                'cars' => $cars->sortByDesc('id'),
            ];
            $view = view('pages.cars',compact('vars'))->render();
            $this->cache->add($key, $view, env('APP_CACHE_MINUTES',60));
        }
        return $view;        
    }

    public function sale($slug = '')
    {
        if (empty($slug)) {
            return redirect()->route('sales.index');
        }

        $car = '';
        $cars = $this->carDetails();
        $car = $cars->where('slug',$slug)->first();

        if (empty($car)) {
            return redirect()->route('sales.index');
        }

        $key = $this->getKeyName(__function__ . md5($slug));
        if (env('CACHE_ENABLED',0) && $this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {

            $vars = [
                'car' => $car,
            ];

            $view = view('pages.car',compact('vars'))->render();
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

    public function robots()
    {
        $response = "User-agent: *\n";
        $response .= "Disallow:";

        if (config('app.env') != 'live') {

            $response = "User-agent: *\n";
            $response .= "Disallow: /";    

        }

        return response($response, 200)
            ->header('Content-Type', 'text/plain');
    }

    public function sitemap()
    {
		$sitemap = App::make("sitemap");

		$sitemap->setCache('laravel.sitemap', 3600);

		if (!$sitemap->isCached()) {

			$sitemap->add(URL::to('/'), '2017-05-01T12:00:00+02:00', '1.0', 'daily');
			$sitemap->add(URL::route('sales.index'), '2017-05-20T12:00:00+02:00', '0.6', 'daily');
			$sitemap->add(URL::route('article.index'), '2017-05-20T12:00:00+02:00', '0.6', 'daily');
			$sitemap->add(URL::route('gallery'), '2017-05-01T12:00:00+02:00', '0.5', 'monthly');
			$sitemap->add(URL::route('contact'), '2017-05-01T12:00:00+02:00', '0.2', 'yearly');
		}
    	// show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
    	return $sitemap->render('xml');        
    }
}