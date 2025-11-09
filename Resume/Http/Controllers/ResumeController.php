<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('resume_edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate all fields
        $request->validate([
            'fullname' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'about' => 'nullable|string|max:1000',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only([
            'fullname', 'title', 'email', 'phone', 'address', 'website', 'about'
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Store new profile picture
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        // Process education
        $education = $request->input('education', []);
        $data['education'] = array_values(array_filter($education, function($item) {
            return !empty($item['type']) || !empty($item['year']) || !empty($item['school']);
        }));

        // Process experience with tasks conversion
        $experience = $request->input('experience', []);
        $processedExperience = [];
        
        foreach ($experience as $exp) {
            if (!empty($exp['seminar']) || !empty($exp['year']) || !empty($exp['position'])) {
                // Convert tasks string to array
                if (isset($exp['tasks']) && is_string($exp['tasks'])) {
                    $tasksArray = array_map('trim', explode(',', $exp['tasks']));
                    $exp['tasks'] = array_values(array_filter($tasksArray, function($task) {
                        return !empty($task);
                    }));
                } elseif (!isset($exp['tasks'])) {
                    $exp['tasks'] = [];
                }
                $processedExperience[] = $exp;
            }
        }
        $data['experience'] = $processedExperience;

        // Process skills
        $skills = $request->input('skills', []);
        $data['skills'] = array_values(array_filter($skills, function($item) {
            return !empty($item['name']);
        }));

        $user->update($data);

        return back()->with('success', 'Resume updated successfully!');
    }

    public function showPublic($id)
    {
        $user = User::findOrFail($id);
        return view('resume_public', compact('user'));
    }
}