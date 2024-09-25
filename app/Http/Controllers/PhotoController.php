<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

/**
 * @OA\Info(
 *     title="Photography API",
 *     version="1.0.0",
 *     description="API for managing photos in a photography application"
 * )
 */

/**
 * @OA\Schema(
 *     schema="Photo",
 *     type="object",
 *     title="Photo",
 *     @OA\Property(property="id", type="integer", description="Photo ID"),
 *     @OA\Property(property="title", type="string", description="Photo title"),
 *     @OA\Property(property="description", type="string", description="Photo description"),
 *     @OA\Property(property="image_path", type="string", description="Path to the image"),
 *     @OA\Property(property="category_id", type="integer", description="Category ID"),
 *     @OA\Property(property="is_featured", type="boolean", description="Is featured photo"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Creation date"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Last update date")
 * )
 */
class PhotoController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Photo::class, 'photo');
    }

    /**
     * @OA\Get(
     *     path="/photography/photos",
     *     summary="Get paginated list of photos",
     *     tags={"Photos"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Photo")),
     *             @OA\Property(property="links", type="object"),
     *             @OA\Property(property="meta", type="object")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $photos = Photo::paginate(12);
        return view('photography.photos.index', compact('photos'));
    }

    /**
     * @OA\Get(
     *     path="/photography/photos/create",
     *     summary="Show photo creation form",
     *     tags={"Photos"},
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function create()
    {
        $this->authorize('create', Photo::class);
        return view('photography.photos.create');
    }

    /**
     * @OA\Post(
     *     path="/photography/photos",
     *     summary="Upload a new photo",
     *     tags={"Photos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(property="title", type="string", maxLength=255),
     *                 @OA\Property(property="description", type="string"),
     *                 @OA\Property(property="image", type="file", format="binary"),
     *                 @OA\Property(property="category_id", type="integer"),
     *                 @OA\Property(property="is_featured", type="boolean")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=302,
     *         description="Photo uploaded successfully, redirects to index"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $this->authorize('create', Photo::class);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('photos', 'public');

        Photo::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'user_id' => auth()->id(),
            'category_id' => $request->input('category_id'),
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('photography.photos.index')
            ->with('success', 'Photo uploaded successfully.');
    }

    /**
     * @OA\Delete(
     *     path="/photography/photos/{id}",
     *     summary="Delete a photo",
     *     tags={"Photos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=302,
     *         description="Photo deleted successfully, redirects to index"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized action"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Photo not found"
     *     )
     * )
     */
    public function destroy(Photo $photo)
    {
        $this->authorize('delete', $photo);

        if (Storage::disk('public')->exists($photo->image_path)) {
            Storage::disk('public')->delete($photo->image_path);
        }

        $photo->delete();

        return redirect()->route('photography.photos.index')
            ->with('success', 'Photo deleted successfully.');
    }
}
