<?php

namespace App\Http\Controllers;

use App\Models\Add;
use App\Models\Bhagavathgeetha;
use App\Models\Bhakthigeetam;
use App\Models\BhakthiGeethaCategory;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\ContentCategory;
use App\Models\ContentPage;
use App\Models\Nelalu;
use App\Models\SthothraluCopy;
use App\Models\SthothraluSubCategory;
use App\Models\Vedasukthulu;
use App\Models\VedasukthuluCategory;
use App\Models\VedasukthuluSubCategory;
use Illuminate\Http\Request;
use App\Models\Day;
use App\Models\Ekadasi;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Kathalu;
use App\Models\Pujalu;
use App\Models\Puranalu;
use App\Models\Vrathalu;
use App\Models\Month;
use App\Models\JobCreation;
use App\Models\MonthMi;
use App\Models\Muhurthalu;
use App\Models\PopUP;
use App\Models\Sankalpalu;
use App\Models\Sankatahari;
use App\Models\Scategory;
use App\Models\SsubCategory;
use App\Models\Sthotralu;
use App\Models\SthotraluCategory;
use Carbon\Carbon;
use Redirect,Response;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index()
    {
        $calendar = Day::all();
        $add = Add::all();
        $popup = PopUP::first();
        return view('front',['calendar' => $calendar,'add'=>$add,'popup'=>$popup]);
    }

    public function day()
    {
        $calendar = Day::all();
        return view('day',['calendar' => $calendar]);
    }

    public function yesterday()
    {
        $calendar = Day::all();
        return view('yesterday',['calendar' => $calendar]);
    }

    public function tomorrow()
    {
        $calendar = Day::all();
        return view('tomorrow',['calendar' => $calendar]);
    }

    public function date($date)
    {
        //dd($date);
        $calendar = Day::where('date',$date)->get();
        return view('date',['calendar' => $calendar]);
    }

    public function bhagavth()
    {
        $sankatahari = Sankatahari::all();
        return view('bhagavthgeetha',['sankatahari' => $sankatahari]);
    }

    public function bhagavthshow($slug)
    {
        $bhagavgeetha = Bhagavathgeetha::where('slug', $slug)->get();
        return view('bhagavthshow',['bhagavthgeetha' => $bhagavgeetha]);
    }

    public function bhakthicategory()
    {
        $bhakthicategory = BhakthiGeethaCategory::all();
        return view('bhakthigeetha_category',['bhakthicategory'=>$bhakthicategory]);
    }

    public function bhakthi($slug)
    {
        $bhakthicategory = BhakthiGeethaCategory::where('slug',$slug)->get();
        $bhakthigeetam = Bhakthigeetam::all();
        return view('bhakthi',['bhakthigeetam' => $bhakthigeetam,'bhakthicategory'=>$bhakthicategory]);
    }

    public function bhakthishow($slug)
    {
        $bhakthigeetam = Bhakthigeetam::where('slug', $slug)->get();
        return view('bhakthishow',['bhakthigeetam' => $bhakthigeetam]);
    }

    public function kathalu()
    {
        $ekadasi = Ekadasi::all();
        return view('kathalu',['ekadasi' => $ekadasi]);
    }

    public function kathalushow($slug)
    {
        $kathalu = Kathalu::where('slug', $slug)->get();
        return view('kathalushow',['kathalu' => $kathalu]);
    }

    public function pujalu()
    {
        $pujalu = Pujalu::all();
        return view('pujalu',['pujalu' => $pujalu]);
    }

    public function pujalushow($slug)
    {
        $puja = Pujalu::where('slug', $slug)->get();
        return view('pujalushow',['puja' => $puja]);
    }

    public function sankalpalu()
    {
        $sankalpalu = Sankalpalu::all();
        return view('sankalpalu',['sankalpalu' => $sankalpalu]);
    }

    public function sankalpalushow($slug)
    {
        $sankalpalu = Sankalpalu::where('slug', $slug)->get();
        return view('sankalpalushow',['sankalpalu' => $sankalpalu]);
    }

    public function puranalu()
    {
        $puranalu = Puranalu::all();
        return view('puranalu',['puranalu' => $puranalu]);
    }

    public function puranalushow($slug)
    {
        $puranalu = Puranalu::where('slug', $slug)->get();
        return view('puranalushow',['puranalu' => $puranalu]);
    }

    public function vrathalu()
    {
        $vrathalu = Vrathalu::all();
        return view('vrathalu',['vrathalu' => $vrathalu]);
    }

    public function vrathalushow($slug)
    {
        $vrathalu = Vrathalu::where('slug', $slug)->get();
        return view('vrathalushow',['vrathalu' => $vrathalu]);
    }


    public function sthotraluCategory()
    {
        $sthotralu = SthotraluCategory::all();
        return view('sthotralucategory',['sthotralu' => $sthotralu]);
    }

    public function AnubandhamCategory()
    {
        $scategory = Scategory::all();
        return view('scategory',['scategory' => $scategory]);
    }

    public function VedasukthuluCategory()
    {
        $vedasukthulucategory = VedasukthuluCategory::all();
        return view('vedasukthulu_category',['vedasukthulucategory' => $vedasukthulucategory]);
    }

    public function sthothralusub($slug)
    {
        $category =  SthotraluCategory::where('slug', $slug)->get();
        $sthotralu = SthothraluSubCategory::all();
        return view('sthothralusubcategory',['category' => $category,'sthotralu' => $sthotralu]);
    }

    public function Anubandhamsub($slug)
    {
        $category =  Scategory::where('slug', $slug)->get();
        $ssubcategory = SsubCategory::all();
        return view('ssubcategory',['category' => $category,'ssubcategory' => $ssubcategory]);
    }

    public function Vedasukthulusub($slug)
    {
        $category =  VedasukthuluCategory::where('slug', $slug)->get();
        $vedasukthulusubcategory = VedasukthuluSubCategory::all();
        return view('vedasukthulu_subcategory',['category' => $category,'vedasukthulusubcategory' => $vedasukthulusubcategory]);
    }

    public function sthotralushow($slug)
    {
        $sthotralu = Sthotralu::where('slug', $slug)->get();
        return view('sthotralushow',['sthotralu' => $sthotralu]);
    }

    public function Anubandhamshow($slug)
    {
        $sthotralucopy = SthothraluCopy::where('slug', $slug)->get();
        return view('sthotralucopyshow',['sthotralucopy' => $sthotralucopy]);
    }

    public function Vedasukthulushow($slug)
    {
        $vedasukthulu = Vedasukthulu::where('slug', $slug)->get();
        return view('vedasukthulushow',['vedasukthulu' => $vedasukthulu]);
    }

    public function sthotralu($slug)
    {
        $category = SthothraluSubCategory::where('slug',$slug)->get();
        $sthotralu = Sthotralu::all();
        return view('sthotralu',['sthotralu' => $sthotralu,'category' => $category]);
    }

    public function Anubandham($slug)
    {
        $category = SsubCategory::where('slug',$slug)->get();
        $sthotralucopy = SthothraluCopy::all();
        return view('sthothralucopy',['sthotralucopy' => $sthotralucopy,'category' => $category]);
    }

    public function Vedasukthulu($slug)
    {
        $category = VedasukthuluSubCategory::where('slug',$slug)->get();
        $vedasukthulu = Vedasukthulu::all();
        return view('vedasukthulu',['vedasukthulu' => $vedasukthulu,'category' => $category]);
    }

    public function panchangam()
    {
        $calendar = Day::all();
        return view('panchangam',['calendar' => $calendar]);
    }

    public function month()
    {
        $nelalu = Nelalu::all();
        return view('muhurthalumonths',['nelalu' => $nelalu]);
    }

    public function muhurthalu($slug)
    {
        $nelalu = Nelalu::where('slug',$slug)->get();
        $muhurthalu = Muhurthalu::all();
        return view('muhurthalu',['muhurthalu' => $muhurthalu,'nelalu' => $nelalu]);
    }

    public function selavalu()
    {
        $month = Month::all();
        return view('selavalu',['month' => $month]);
    }

    public function pandugalu()
    {
        $month = Month::all();
        return view('pandugalu',['month' => $month]);
    }

    public function service()
    {
        return view('service');
    }

    public function muhurtham()
    {
        return view('muhurtham');
    }

    public function horoscope()
    {
        return view('horoscope');
    }

    public function vedam()
    {
        return view('vedam');
    }

    public function onlinepuja()
    {
        return view('onlinepuja');
    }

    public function donation()
    {
        return view('donation');
    }

    public function annadanam()
    {
        return view('annadhanam');
    }

    public function godanam()
    {
        return view('godanam');
    }

    public function seva()
    {
        return view('seva');
    }

    public function portal()
    {
        $application = JobCreation::all();

        return view('jobportal',['application' => $application]);
    }

    // public function cal()
    // {
    //     $events = array();
    //     $month = MonthMi::all();
    //     foreach($month as $months){
    //         $events[] = [
    //             'title' => $months->title,
    //             'start' => $months->start_date,
    //             'end' => $months->end_date,
    //         ];
    //     }
    //     return view('cal',['events' => $events]);
    // }

    public function Calc()
    {
        $calendar = Day::all();
        $events = array();
        $events = Event::all();
        $mon = Month::where('month_id',Carbon::now()->month)->first();
        $mont = Month::where('month_id',Carbon::now()->month)->get();
        //dd($mon);
        // foreach($month as $m)
        // {
        //     $events[] = [
        //         'id' => $m->id,
        //         'image' => $m->image,
        //     ];
        // }
        return view('calc',['events' => $events,'calendar' => $calendar,'mon'=> $mon,'mont'=>$mont]);

    }

    public function about()
    {
        return view('about');
    }


    /*public function getDataForDate(Request $request)
    {
        $formattedDate = $request->input('date');
        $data = Day::where('date', $formattedDate)->pluck('heading','id');

        if (!$data) {
            // Handle the case when no data is found for the given date
            return response()->json(['error' => 'Data not found'], 404);
        }

        // Return the data as a JSON response
        return response()->json($data);*/
        /*$selectedDate = $request->input('date');
        //dd($selectedDate);

        // Fetch data from the database using $selectedDate
        // Modify the SQL query accordingly to fetch data for the selected date
        // Example:
        //$data = DB::table('days')->where('date', $selectedDate)->first();
        //dd($data);
        $data = DB::table('days')->whereRaw("DATE_FORMAT(date, '%Y-%m-%d') = ?", [$selectedDate])->first();

        // Return the fetched data as a JSON response
        return response()->json($data);*/
    /*}*/

    /*public function fetchData(Request $request) {
        $selectedDate = $request->input('date');

        // Fetch data from the database using $selectedDate
        // Modify the SQL query accordingly to fetch data for the selected date
        // Example:
        $data = DB::table('days')->where('date', $selectedDate)->get();
        dd($data);

        // Return the fetched data as a response (e.g., JSON, HTML)
        return view('date', ['data' => $data]); // Replace 'data-view' with your data view
      }*/


      /*public function fetchData(Request $request)
    {
        $c = Day::where('date',$request->id)->first();
        //dd($c);
        return response()->json($c);
    }*/
    public function getDataForDate($date)
{
    $data = Day::where('date', $date)->first();

    if (!$data) {
        return response()->json(['error' => 'Data not found'], 404);
    }

    return response()->json($data);
}

public function getDataForMonth($date)
{
    $data = Day::where('date', $date)->first();

    if (!$data) {
        return response()->json(['error' => 'Data not found'], 404);
    }

    return response()->json($data);
}
public function MonthData($month)
    {
        $data = Month::where('month_id', $month)->get();
    if (!$data) {
        return response()->json(['error' => 'Data not found'], 404);
    }

    return response()->json($data);
    }

    public function page()
    {
        $category = ContentCategory::all();
        return view('page',compact('category'));
    } 

    public function page_show($slug)
    {
        $category = ContentCategory::where('slug',$slug)->get();
        $page = ContentPage::all();
        return view('page_show',compact('category','page'));
    }

    public function BlogGallery()
    {
        return view('blog_gallery');
    }

    public function Blog()
    {
        $contentcategory = BlogCategory::all();
        return view('blog',['contentcategory' => $contentcategory]);
    }

    public function BlogPage($slug)
    {
        $page = BlogCategory::where('slug',$slug)->get();
        $blog = Blog::all();
        // dd($page);
// $category = $page->category;
// // dd($category);
// foreach ($category as $cat) {
//     $pivotId = $cat->pivot->content_page_id;
//     // dd($pivotId);
//     // Now $pivotId contains the ID from the pivot table
// }
return view('blog_page',['page'=>$page,'blog'=>$blog]);
    }

    public function BlogPageShow($slug)
    {
        $blog = Blog::where('slug',$slug)->get();
        return view('bloge_page_show',["blog" => $blog]);
    }

    public function Gallery()
    {
        $gallery = Gallery::all();

        return view('gallery',['gallery'=>$gallery]);
    }
}
