<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Services\ImageService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(Request $request)
    {
        $query = Media::query();

        if ($request->has('type') && $request->type) {
            if ($request->type === 'image') {
                $query->where('mime_type', 'like', 'image/%');
            }
        }

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $media = $query->orderBy('created_at', 'desc')->paginate(24);

        return view('admin.media.index', compact('media'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|max:10240',
        ]);

        $uploaded = [];

        foreach ($request->file('files') as $file) {
            $paths = $this->imageService->upload($file, 'media');
            $info = $this->imageService->getImageInfo($paths['original']);

            $media = Media::create([
                'name' => $file->getClientOriginalName(),
                'file_name' => basename($paths['original']),
                'mime_type' => $file->getMimeType(),
                'path' => $paths['original'],
                'thumbnail_path' => $paths['thumb'] ?? null,
                'size' => $file->getSize(),
                'width' => $info['width'] ?? null,
                'height' => $info['height'] ?? null,
                'user_id' => auth()->id(),
            ]);

            $uploaded[] = $media;
        }

        return response()->json(['success' => true, 'media' => $uploaded]);
    }

    public function destroy(Media $media)
    {
        $this->imageService->delete($media->path);
        if ($media->thumbnail_path) {
            $this->imageService->delete($media->thumbnail_path);
        }

        $media->delete();

        return back()->with('success', 'Media deleted successfully.');
    }
}
