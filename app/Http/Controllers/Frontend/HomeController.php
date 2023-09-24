<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\CategoryMember;
use App\Models\CategoryService;
use App\Models\Contact;
use App\Models\DentalTourism;
use App\Models\FaqQuestion;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\Patient;
use App\Models\Review;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index()
	{
        $categoryServices=CategoryService::get();
        $services=Service::take('6')->orderBy('id','DESC')->get();
        $reviews=Review::latest()->get();
        $patients=Patient::get();
        $all_services=Service::get();
        $evenReviews = Review::whereRaw('id % 2 = 0')->get();
        $oddReview = Review::whereRaw('id % 2 != 0')->get();
        $about=AboutUs::firstOrCreate();
        $dental=DentalTourism::with(['images','rows'])->firstOrCreate();
        $sliders=Slider::get();



        return view('front.home.home',[
			'showHeaderBanner'=>true,
            'categoryServices'=>$categoryServices,
            'services'=>$services,
            'reviews'=>$reviews,
            'patients'=>$patients,
            'all_services'=>$all_services,
            'oddReview'=>$oddReview,
            'evenReviews'=>$evenReviews,
            'about'=>$about,
            'dental'=>$dental,
            'sliders'=>$sliders,
		]);

	}
	public function showAbout()
	{
        $row=AboutUs::firstOrCreate();
        $partners=Partner::get();
        $categories=CategoryMember::where('is_special',0)->orWhere('is_special',null)->with(['members'])->get();
        $specialCategory=CategoryMember::where('is_special',1)->with(['members'])->first();

        return view('front.about.about',compact('row','partners','categories','specialCategory'));
	}public function showServices()
	{
        $categories=CategoryService::with(['services'])->get();
		return view('front.services.services',compact('categories'));
	}

    public function showService($id){
        $category=CategoryService::with(['services'])->findOrFail($id);

        return view('front.services.service',compact('category'));

    }



    public function showContacts()
	{
		return view('front.contact.contact');
	}
	public function showFaq()
	{
        $faqs=FaqQuestion::get();
		return view('front.faq.faq',compact('faqs'));
	}
	public function showDentalTourism()
	{
        $dental=DentalTourism::with(['images','rows'])->firstOrCreate();
		return view('front.dental-tourism.dental-tourism',compact('dental'));
	}
	public function showGallery()
	{
        $images=Gallery::where('type','image')->get();
        $videos=Gallery::where('type','video')->get();

        return view('front.gallery.gallery',compact('images','videos'));
	}

    public function showPartners (){
            $partners=Partner::get();
        return view('front.partner.index',compact('partners'));

    }
	public function showBlogs()
	{
        $blogs=Blog::get();
		return view('front.blog.blogs',compact('blogs'));
	}public function showBlog($id)
	{
        $blog=Blog::findOrFail($id);
        $blogs=Blog::latest()->take('3')->where('id','!=',$id)->get();
		return view('front.blog.blog',compact('blog','blogs'));
	}

    public function storeContacts(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'service_id' => 'required|exists:services,id',

        ]);


        Contact::create($data);
        return response()->json([],200);
    }
}
