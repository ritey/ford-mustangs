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
            $gt350 = [];
            $gt350_files = File::allFiles(public_path() . '/images/gt350');
            foreach($gt350_files as $item) {
                $gt350[] = ['file' => '/images/gt350/'.$item->getFilename(), 'tag' => 'GT350'];
            }
            $gt500_files = File::allFiles(public_path() . '/images/gt500');
            foreach($gt500_files as $item) {
                $gt500[] = ['file' => '/images/gt500/'.$item->getFilename(), 'tag' => 'GT500 1967'];
            }
            $vars = [
                'tags' => [
                    'GT350',
                    'GT500',
                    '1967',
                ],
                'pics' => [
                    'GT350' => $gt350,
                    'GT500' => $gt500,
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