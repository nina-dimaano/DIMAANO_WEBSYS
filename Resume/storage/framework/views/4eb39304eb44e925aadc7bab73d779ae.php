<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume - <?php echo e($user->fullname); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0; padding: 0;
            background-color: #f5f5f5;
            min-height: 100vh;
        }
        .header-bar {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 15px 20px;
            display: flex; justify-content: space-between; align-items: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .welcome-text { font-size: 14px; }
        .logout-btn {
            background: #e2dcf5; color: #4a3e7c;
            padding: 10px 18px; border-radius: 20px;
            text-decoration: none; font-size: 12px; font-weight: 600;
            transition: all 0.3s ease; text-transform: uppercase;
        }
        .logout-btn:hover { background: #d6ccf0; transform: translateY(-1px); }
        .container {
            display: flex; max-width: 900px; margin: 20px auto;
            background-color: white; box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            border-radius: 15px; overflow: hidden;
        }
        .left-column {
            width: 320px; background: linear-gradient(135deg, #667eea, #764ba2);
            color: white; padding: 30px 20px;
        }
        .right-column { flex: 1; padding: 30px; background-color: white; }
        .about-text {
            color: #4a3e7c; line-height: 1.6;
            background: linear-gradient(135deg, #f5f7fa, #e2dcf5);
            padding: 18px; border-radius: 10px; border-left: 4px solid #667eea;
        }
        .profile-photo {
            width: 150px; height: 150px; border-radius: 50%;
            border: 4px solid #ffffff; box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            margin: 0 auto 20px; object-fit: cover; display: block;
        }
        .name { font-size: 26px; font-weight: bold; margin-bottom: 5px; text-align: center; }
        .job-title { font-size: 15px; margin-bottom: 25px; font-style: italic; text-align: center; opacity: 0.95; }
        .section-title {
            background: rgba(255, 255, 255, 0.15);
            padding: 12px; margin: 25px -20px 15px -20px;
            font-weight: bold; border-radius: 10px; font-size: 14px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .contact-item { margin-bottom: 12px; font-size: 14px; }
        .skill-item { margin-bottom: 15px; }
        .skill-name { margin-bottom: 6px; font-size: 14px; }
        .skill-bar {
            background: rgba(255,255,255,0.2);
            height: 10px; border-radius: 10px;
        }
        .skill-level {
            background: linear-gradient(90deg, #e2dcf5, #ffffff);
            height: 100%; border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .right-section {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white; padding: 12px 18px; margin-bottom: 20px;
            font-weight: 600; border-radius: 10px; font-size: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .education-item, .exp-item {
            margin-bottom: 20px;
            background: linear-gradient(135deg, #f5f7fa, #e2dcf5);
            padding: 18px; border-radius: 10px; border-left: 4px solid #667eea;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: transform 0.2s ease;
        }
        .education-item:hover, .exp-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .year { color: #876fd6; font-size: 13px; font-weight: 500; margin-bottom: 5px; }
        .type, .position { font-weight: bold; margin: 5px 0; color: #4a3e7c; font-size: 15px; }
        .school { font-style: italic; color: #6a5aae; font-size: 16px; }
        .seminar { color: #000000ff; font-size: 16px; }
        .task-list { margin-top: 10px;}
        .task-list li { text-align: justify; margin-bottom: 5px; font-size: 14px; color: #4a3e7c; }
        .print-btn {
            position: fixed; bottom: 20px; right: 20px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white; border: none; padding: 14px 22px;
            border-radius: 25px; cursor: pointer; font-size: 14px; font-weight: 600;
            box-shadow: 0 6px 20px rgba(102,126,234,0.3);
            transition: all 0.3s ease;
        }
        .print-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102,126,234,0.4);
        }
        @media print {
            .header-bar, .print-btn { display: none; }
            body { background: white; }
            .container { 
                box-shadow: none; 
                margin: 0;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .left-column {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .right-section {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .education-item, .exp-item {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .about-text {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
</head>
<body>

<?php if(auth()->guard()->check()): ?>
<div class="header-bar">
    <div class="welcome-text">Welcome, <?php echo e(Auth::user()->username); ?>!</div>
    <a href="/logout" class="logout-btn" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
</div>
<?php endif; ?>

<div class="container">
    <div class="left-column">
        <?php if($user->profile_picture): ?>
            <img src="<?php echo e(asset('storage/' . $user->profile_picture)); ?>" alt="Profile Photo" class="profile-photo">
        <?php else: ?>
            <img src="https://via.placeholder.com/150" alt="Profile Photo" class="profile-photo">
        <?php endif; ?>
        <div class="name"><?php echo e($user->fullname ?? 'Your Name'); ?></div>
        <div class="job-title"><?php echo e($user->title ?? 'Your Title'); ?></div>

        <div class="section-title">✉️ Contact</div>
        <?php if($user->address): ?><div class="contact-item">📍 <?php echo e($user->address); ?></div><?php endif; ?>
        <?php if($user->website): ?><div class="contact-item">🌐 <?php echo e($user->website); ?></div><?php endif; ?>
        <?php if($user->email): ?><div class="contact-item">📧 <?php echo e($user->email); ?></div><?php endif; ?>
        <?php if($user->phone): ?><div class="contact-item">☎️ <?php echo e($user->phone); ?></div><?php endif; ?>

        <div class="section-title">🛠️ Skills</div>
        <?php if(is_array($user->skills) && count($user->skills) > 0): ?>
            <?php $__currentLoopData = $user->skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($skill['name'])): ?>
                <div class="skill-item">
                    <div class="skill-name"><?php echo e($skill['name']); ?></div>
                    <div class="skill-bar">
                        <div class="skill-level" style="width: <?php echo e(($skill['level'] ?? 1) * 20); ?>%"></div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p style="font-size: 13px; opacity: 0.9;">No skills added yet.</p>
        <?php endif; ?>
    </div>

    <div class="right-column">
        <div class="right-section">📝 About Me</div>
        <p class="about-text"><?php echo e($user->about ?? 'No information provided yet.'); ?></p>

        <div class="right-section">🎓 Education</div>
        <?php if(is_array($user->education) && count($user->education) > 0): ?>
            <?php $__currentLoopData = $user->education; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="education-item">
                <div class="year"><?php echo e($edu['year'] ?? 'N/A'); ?></div>
                <div class="type"><?php echo e($edu['type'] ?? 'N/A'); ?></div>
                <div class="school"><?php echo e($edu['school'] ?? 'N/A'); ?></div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p style="color: #6a5aae; font-style: italic; font-size: 14px;">No education entries yet.</p>
        <?php endif; ?>

        <div class="right-section">💼 Seminar and Training</div>
        <?php if(is_array($user->experience) && count($user->experience) > 0): ?>
            <?php $__currentLoopData = $user->experience; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="exp-item">
                <div class="year"><?php echo e($exp['year'] ?? 'N/A'); ?></div>
                <div class="seminar"><?php echo e($exp['seminar'] ?? 'N/A'); ?></div>
                <div class="position"><?php echo e($exp['position'] ?? 'N/A'); ?></div>
                <?php if(isset($exp['tasks']) && is_array($exp['tasks']) && count($exp['tasks']) > 0): ?>
                <ul class="task-list">
                    <?php $__currentLoopData = $exp['tasks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($task); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p style="color: #6a5aae; font-style: italic; font-size: 14px;">No seminar/training entries yet.</p>
        <?php endif; ?>
    </div>
</div>

<button class="print-btn" onclick="window.print()">🖨️ Print Resume</button>

</body>
</html><?php /**PATH C:\Users\Nina Rica\OneDrive\Desktop\resume-system\resources\views/resume_public.blade.php ENDPATH**/ ?>