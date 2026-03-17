<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use App\Models\Room;
use App\Models\Review;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'inquiries_this_month' => ContactInquiry::whereMonth('created_at', Carbon::now()->month)->count(),
            'total_rooms' => Room::count(),
            'available_rooms' => Room::where('is_available', true)->count(),
            'average_rating' => Review::where('is_active', true)->avg('rating') ?? 0,
            'total_reviews' => Review::where('is_active', true)->count(),
            'total_gallery_images' => Gallery::where('is_active', true)->count(),
        ];

        $recentInquiries = ContactInquiry::latest()->take(5)->get();
        
        $sections = [
            'hero' => [
                'status' => 'Published', // Assuming always published for now as it's a single edit page
                'count_text' => 'Main banner and tagline',
                'route' => route('admin.hero.edit')
            ],
            'about' => [
                'status' => 'Published',
                'count_text' => 'Description and story',
                'route' => route('admin.about.edit')
            ],
            'rooms' => [
                'status' => 'Published',
                'count_text' => $stats['total_rooms'] . ' rooms configured',
                'route' => route('admin.rooms.index')
            ],
            'gallery' => [
                'status' => 'Published',
                'count_text' => $stats['total_gallery_images'] . ' images',
                'route' => route('admin.galleries.index')
            ],
            'reviews' => [
                'status' => 'Published',
                'count_text' => $stats['total_reviews'] . ' total reviews',
                'route' => route('admin.reviews.index')
            ],
        ];

        $pendingItems = [
            'new_inquiries' => ContactInquiry::where('status', 'pending')->count(),
            'unread_reviews' => Review::where('is_active', false)->count(),
        ];

        return view('dashboard', compact('stats', 'recentInquiries', 'sections', 'pendingItems'));
    }
}
