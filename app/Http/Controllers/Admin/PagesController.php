<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Contacts;
use Languages;

use App\Page;
use App\PageTranslation;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function getIndex(){
        return view('admin.page.index')->with('pages', Page::all());
    }

    public function getCreate()
    {
        return view('admin.page.create')->with('page', new Page());
    }

    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|alpha_dash|unique:pages,slug'
        ]);

        $page = new Page($request->except('_token'));
        $page->save();

        return redirect()->to('/admin/pages/'.$page->id.'/edit');
    }

    public function edit($page_id)
    {
        $page = Page::findOrFail($page_id);

        return view('admin.page.edit')->with('page', $page);
    }

    public function save(Request $request, $page_id)
    {
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|alpha_dash|unique:pages,slug,'.$page_id
        ]);

        $page = Page::findOrFail($page_id);
        $page->update($request->except('_token'));

        return redirect()->to('/admin/pages/'.$page->id.'/edit');
    }

    public function translate($page_id, $lang)
    {
        if(!in_array($lang, Languages::all()))
        {
            return redirect()->to('/admin/pages');
        }

        $page = Page::findOrFail($page_id);

        if(Languages::general() == $lang)
        {
            return redirect()->to('/admin/pages/'.$page->id.'/edit');
        }

        $translation = null;

        if(!$page->translatedTo($lang))
        {
            $translation = new PageTranslation();
            $translation->title = '['.Languages::general().'] '. $page->title;
            $translation->language = $lang;
            $translation->content = $page->content;
            $translation->settings = $page->settings;
            $translation->meta_title = $page->meta_title;
            $translation->meta_keywords = $page->meta_keywords;
            $translation->meta_description = $page->meta_description;

            $page->translations()->save($translation);

            $page->load('translations');
        }

        return view('admin.page.translate')->with(['page' => $page->translation($lang), 'original' => $page, 'lang' => $lang]);
    }

    public function translateSave(Request $request, $page_id, $lang)
    {
        $page = Page::findOrFail($page_id);

        foreach ($page->translations as $translation) {
            if($translation->language == $lang)
            {
                $translation->fill($request->except('_token'))->save();
                break;
            }
        }

        return redirect()->to('/admin/pages/'.$page->id.'/translate/'.$lang);
    }

    public  function postDynamic(Request $request)
    {
        return view('admin.page.dynamic')->with('page', Page::find($request->input('page')));
    }
}


