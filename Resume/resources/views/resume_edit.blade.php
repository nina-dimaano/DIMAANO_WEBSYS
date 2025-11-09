<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resume</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #333;
            margin: 0; padding: 0;
        }
        .container {
            max-width: 800px;
            background: #fff;
            margin: 40px auto;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            padding: 30px 40px;
        }
        h1 { text-align: center; color: #4a3e7c; }
        label { display: block; margin-top: 15px; font-weight: 500; }
        input, textarea, select {
            width: 100%; padding: 10px; border: 1px solid #ccc;
            border-radius: 8px; margin-top: 6px; font-size: 14px;
            box-sizing: border-box;
        }
        button {
            background: #667eea; color: white; border: none;
            padding: 10px 20px; border-radius: 8px; cursor: pointer;
            margin-top: 20px; font-weight: 600;
        }
        button:hover { background: #5a6fdc; }
        .logout-btn {
            float: right; background: #e2dcf5; color: #4a3e7c;
            padding: 8px 16px; border-radius: 20px;
            font-size: 13px; margin-top: -10px;
        }
        .section {
            margin-top: 25px; background: #f5f7fa;
            padding: 15px 20px; border-radius: 8px;
        }
        .item-group {
            border: 1px solid #ddd; padding: 10px;
            margin-bottom: 10px; border-radius: 8px; background: #fff;
        }
        .add-btn {
            background: #4a3e7c; color: white; font-size: 13px;
            padding: 6px 10px; border-radius: 8px; cursor: pointer;
        }
        .remove-btn {
            background: #dc3545; color: white; font-size: 12px;
            padding: 4px 8px; border-radius: 8px; float: right; cursor: pointer;
        }
        .form-actions {
            display: flex; justify-content: space-between;
            align-items: center; margin-top: 30px;
        }
        .view-btn {
            background: #e2dcf5; color: #4a3e7c; padding: 10px 20px;
            border-radius: 8px; text-decoration: none; font-weight: 600;
        }
        .success {
            background: #d4edda; color: #155724; padding: 10px;
            border-radius: 8px; margin-bottom: 20px; text-align: center;
        }
        .profile-picture-section {
            text-align: center;
            margin-bottom: 20px;
            padding: 20px;
            background: linear-gradient(135deg, #f5f7fa, #e2dcf5);
            border-radius: 10px;
        }
        .profile-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #667eea;
            margin: 10px auto;
            display: block;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .file-input-wrapper {
            margin-top: 15px;
        }
        input[type="file"] {
            padding: 8px;
            background: white;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <form method="POST" action="{{ route('resume.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <button type="button" class="logout-btn" onclick="window.location='/logout'">Logout</button>
        <h1>✏️ Edit Resume</h1>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <!-- Profile Picture Section -->
        <div class="profile-picture-section">
            <h3 style="color: #4a3e7c; margin-top: 0;">📸 Profile Picture</h3>
            @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="profile-preview" id="preview">
            @else
                <img src="https://via.placeholder.com/150" alt="Profile Picture" class="profile-preview" id="preview">
            @endif
            <div class="file-input-wrapper">
                <label>Upload New Picture (JPG, PNG, GIF - Max 2MB)</label>
                <input type="file" name="profile_picture" accept="image/*" onchange="previewImage(event)">
                @error('profile_picture')
                    <div style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <label>Full Name</label>
        <input type="text" name="fullname" value="{{ old('fullname', $user->fullname) }}" required>

        <label>Title</label>
        <input type="text" name="title" value="{{ old('title', $user->title) }}">

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

        <label>Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">

        <label>Address</label>
        <input type="text" name="address" value="{{ old('address', $user->address) }}">

        <label>Website</label>
        <input type="text" name="website" value="{{ old('website', $user->website) }}">

        <label>About Me</label>
        <textarea name="about" rows="4">{{ old('about', $user->about) }}</textarea>

        <!-- Education -->
        <div class="section">
            <h3>🎓 Education</h3>
            <div id="educationFields">
                @php $educations = $user->education ?? []; @endphp
                @foreach($educations as $index => $edu)
                <div class="item-group">
                    <button type="button" class="remove-btn" onclick="removeItem(this)">Remove</button>
                    <label>Type</label>
                    <input type="text" name="education[{{ $index }}][type]" value="{{ $edu['type'] ?? '' }}">
                    <label>Year</label>
                    <input type="text" name="education[{{ $index }}][year]" value="{{ $edu['year'] ?? '' }}">
                    <label>School</label>
                    <input type="text" name="education[{{ $index }}][school]" value="{{ $edu['school'] ?? '' }}">
                </div>
                @endforeach
            </div>
            <button type="button" class="add-btn" onclick="addEducation()">+ Add Education</button>
        </div>

        <!-- Experience -->
        <div class="section">
            <h3>💼 Seminar / Training</h3>
            <div id="expFields">
                @php $experiences = $user->experience ?? []; @endphp
                @foreach($experiences as $index => $exp)
                <div class="item-group">
                    <button type="button" class="remove-btn" onclick="removeItem(this)">Remove</button>
                    <label>Seminar Title</label>
                    <input type="text" name="experience[{{ $index }}][seminar]" value="{{ $exp['seminar'] ?? '' }}">
                    <label>Year</label>
                    <input type="text" name="experience[{{ $index }}][year]" value="{{ $exp['year'] ?? '' }}">
                    <label>Position</label>
                    <input type="text" name="experience[{{ $index }}][position]" value="{{ $exp['position'] ?? '' }}">
                    <label>Tasks (comma-separated)</label>
                    <input type="text" name="experience[{{ $index }}][tasks]" value="{{ is_array($exp['tasks'] ?? null) ? implode(', ', $exp['tasks']) : ($exp['tasks'] ?? '') }}">
                </div>
                @endforeach
            </div>
            <button type="button" class="add-btn" onclick="addExperience()">+ Add Seminar</button>
        </div>

        <!-- Skills -->
        <div class="section">
            <h3>🛠️ Skills</h3>
            <div id="skillsFields">
                @php $skills = $user->skills ?? []; @endphp
                @foreach($skills as $index => $skill)
                <div class="item-group">
                    <button type="button" class="remove-btn" onclick="removeItem(this)">Remove</button>
                    <label>Skill Name</label>
                    <input type="text" name="skills[{{ $index }}][name]" value="{{ $skill['name'] ?? '' }}">
                    <label>Proficiency (1-5)</label>
                    <select name="skills[{{ $index }}][level]">
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ ($skill['level'] ?? 0) == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                @endforeach
            </div>
            <button type="button" class="add-btn" onclick="addSkill()">+ Add Skill</button>
        </div>

        <div class="form-actions">
            <button type="submit">💾 Save Changes</button>
            <a href="{{ route('resume.public', $user->id) }}" target="_blank" class="view-btn">🌐 View Public Resume</a>
        </div>
    </form>
</div>

<script>
@php
    $eduCount = count($user->education ?? []);
    $expCount = count($user->experience ?? []);
    $skillCount = count($user->skills ?? []);
@endphp

let eduIndex = {{ $eduCount }};
let expIndex = {{ $expCount }};
let skillIndex = {{ $skillCount }};

// Preview uploaded image
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}

function removeItem(btn) {
    btn.parentElement.remove();
}

function addEducation() {
    const div = document.createElement('div');
    div.className = 'item-group';
    div.innerHTML = `
        <button type="button" class="remove-btn" onclick="removeItem(this)">Remove</button>
        <label>Type</label><input type="text" name="education[${eduIndex}][type]">
        <label>Year</label><input type="text" name="education[${eduIndex}][year]">
        <label>School</label><input type="text" name="education[${eduIndex}][school]">
    `;
    document.getElementById('educationFields').appendChild(div);
    eduIndex++;
}

function addExperience() {
    const div = document.createElement('div');
    div.className = 'item-group';
    div.innerHTML = `
        <button type="button" class="remove-btn" onclick="removeItem(this)">Remove</button>
        <label>Seminar Title</label><input type="text" name="experience[${expIndex}][seminar]">
        <label>Year</label><input type="text" name="experience[${expIndex}][year]">
        <label>Position</label><input type="text" name="experience[${expIndex}][position]">
        <label>Tasks (comma-separated)</label><input type="text" name="experience[${expIndex}][tasks]">
    `;
    document.getElementById('expFields').appendChild(div);
    expIndex++;
}

function addSkill() {
    const div = document.createElement('div');
    div.className = 'item-group';
    div.innerHTML = `
        <button type="button" class="remove-btn" onclick="removeItem(this)">Remove</button>
        <label>Skill Name</label><input type="text" name="skills[${skillIndex}][name]">
        <label>Proficiency (1-5)</label>
        <select name="skills[${skillIndex}][level]">
            <option value="1">1</option><option value="2">2</option>
            <option value="3">3</option><option value="4">4</option>
            <option value="5">5</option>
        </select>
    `;
    document.getElementById('skillsFields').appendChild(div);
    skillIndex++;
}
</script>

</body>
</html>