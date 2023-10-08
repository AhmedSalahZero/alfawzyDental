<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Http\Traits\Upload_Files;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\CategoryMember;
use App\Models\CategoryService;
use App\Models\Contact;
use App\Models\DentalTourism;
use App\Models\FaqQuestion;
use App\Models\Gallery;
use App\Models\OnlineConsulting;
use App\Models\OnlineConsultingSetting;
use App\Models\Partner;
use App\Models\Patient;
use App\Models\Review;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use Upload_Files;
	public function index()
	{
        $categoryServices=CategoryService::orderBy('ranking','ASC')->get();
        $special_services=Service::take('6')->orderBy('ranking','ASC')->where('is_special',true)->get();
        $reviews=Review::latest()->get();
        $patients=Patient::get();
        $all_services=Service::orderBy('ranking','ASC')->get();
        $evenReviews = Review::whereRaw('id % 2 = 0')->get();
        $oddReview = Review::whereRaw('id % 2 != 0')->get();
        $about=AboutUs::firstOrCreate();
        $dental=DentalTourism::with(['images','rows'])->firstOrCreate();
        $sliders=Slider::get();



        return view('front.home.home',[
			'showHeaderBanner'=>true,
            'categoryServices'=>$categoryServices,
            'special_services'=>$special_services,
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

    public function patientVideo($id){
        $row=Patient::findOrFail($id);
        return view('front.home.parts.patientVideo',compact('row'));
    }
    public function patientImage(Request $request){
        $rows=Patient::get();
        $row=$rows[$request->key];

        return get_file($row->image) ;
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
        $categories=CategoryService::with(['services'])->whereHas('services',function ($query){
            $query->where('is_special',0);
        })->orderBy('ranking','ASC')->get();
        $special_services=Service::where('is_special',true)->orderBy('ranking','ASC')->get();
		return view('front.services.services',compact('categories','special_services'));
	}

    public function showService($id){
        $category=CategoryService::with(['services'])->findOrFail($id);
        $special_services=Service::where('category_service_id',$id)->where('is_special',true)->orderBy('ranking','ASC')->get();


        return view('front.services.service',compact('category','special_services'));

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

     public function online_consulting(){
        $row=OnlineConsultingSetting::firstOrCreate();
         return view('front.online-consulting.online-consulting',compact('row'));

     }
    public function online_consulting_store(Request $request){

        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'complaint' => 'required',
            'x_ray' => 'required|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'front_teeth_image' => 'required|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'side_teeth_image' => 'required|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'upper_teeth_image' => 'required|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'lower_teeth_image' => 'required|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'passport_or_id' => 'required|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
        ]);

        if ($request->x_ray)
            $data['x_ray'] =  $this->uploadFiles('consulting',$request->file('x_ray'),null );
        if ($request->front_teeth_image)
            $data['front_teeth_image'] =  $this->uploadFiles('consulting',$request->file('front_teeth_image'),null );
        if ($request->side_teeth_image)
            $data['side_teeth_image'] =  $this->uploadFiles('consulting',$request->file('side_teeth_image'),null );
        if ($request->upper_teeth_image)
            $data['upper_teeth_image'] =  $this->uploadFiles('consulting',$request->file('upper_teeth_image'),null );

        if ($request->lower_teeth_image)
            $data['lower_teeth_image'] =  $this->uploadFiles('consulting',$request->file('lower_teeth_image'),null );
        if ($request->passport_or_id)
            $data['passport_or_id'] =  $this->uploadFiles('consulting',$request->file('passport_or_id'),null );



        OnlineConsulting::create($data);
        return response()->json([],200);

}
}
