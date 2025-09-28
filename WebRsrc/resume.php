<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$name = "NINA RICA DIMAANO";
$title = "BS COMPUTER SCIENCE STUDENT";

$contact = array(
    "address" => "📍P4-067 Banaba South, Batangas City",
    "website" => "🌐 https://github.com/nina-dimaano",
    "email" => "📧 23-09103@g.batstate-u.edu.ph",
    "phone" => "☎️ 09666473300"
);

$about = "I am a college student pursuing a degree in Computer Science, eager to learn and grow in programming and problem-solving. I am passionate about technology and aim to apply my skills to real-world projects.";

$education = array(
    array(
        "type" => "Elementary",
        "year" => "2010 - 2017",
        "school" => "Banaba South Elementary School"
    ),
    array(
        "type" => "Secondary", 
        "year" => "2017 - 2023",
        "school" => "Batangas City Integrated School"
    ),
    array(
        "type" => "Tertiary", 
        "year" => "2023 - Present",
        "school" => "Batangas State University"
    )
);

$exp= array(
    array(
        "seminar" => "Leadership Enhancement and Attitude Development Workshop",
        "year" => "June 2025", 
        "position" => "Participant",
        "tasks" => array(
            "Attended leadership and skills development sessions focused on personal and professional growth.",
            "Collaborated with fellow students in group activities and workshops to build teamwork and communication skills.",
            "Learned practical strategies for problem-solving and project management."
        )
    ),
);

$skills = array(
    "C++" => 4,
    "Python" => 2,
    "Java" => 4, 
    "HTML & CSS" => 3,
    "SQL" => 4,
    "PHP" => 1
);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Resume - <?php echo $name; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            min-height: 100vh;
        }
        
        .header-bar {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .welcome-text {
            font-size: 14px;
        }
        
        .logout-btn {
            background: #e2dcf5;
            color: #4a3e7c;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .logout-btn:hover {
            background: #d6ccf0;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .container {
            display: flex;
            max-width: 800px;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border-radius: 15px;
            overflow: hidden;
        }
        
        .left-column {
            width: 300px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 20px;
        }
        
        .right-column {
            flex: 1;
            padding: 20px;
            background-color: white;
        }
        
        .about-text {
            color: #4a3e7c;
            line-height: 1.6;
            background: linear-gradient(135deg, #f5f7fa, #e2dcf5);
            padding: 18px;
            border-radius: 10px;
            border-left: 4px solid #667eea;
            font-weight: 400;
        }
        
        .profile-photo {
            width: 150px;               
            height: 150px;
            border-radius: 50%;         
            border: 4px solid #ffffff;  
            box-shadow: 0 4px 12px rgba(0,0,0,0.2); 
            margin-bottom: 20px;   
            background-image: url("pfp.jpg");
            background-size: cover;      
}

        
        .name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .job-title {
            font-size: 14px;
            margin-bottom: 20px;
            font-style: italic;
        }
        
        .section-title {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 10px;
            margin: 20px -20px 10px -20px;
            font-weight: bold;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .contact-item {
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        .skill-item {
            margin-bottom: 15px;
        }
        
        .skill-name {
            margin-bottom: 5px;
        }
        
        .skill-bar {
            background: rgba(255, 255, 255, 0.2);
            height: 10px;
            border-radius: 10px;
        }
        
        .skill-level {
            background: linear-gradient(90deg, #e2dcf5, #ffffff);
            height: 100%;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .right-section {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 12px 18px;
            margin-bottom: 15px;
            font-weight: 600;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            letter-spacing: 0.5px;
        }
        
        .education-item, .exp-item {
            margin-bottom: 20px;
            background: linear-gradient(135deg, #f5f7fa, #e2dcf5);
            padding: 18px;
            border-radius: 10px;
            border-left: 4px solid #667eea;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: transform 0.2s ease;
        }
        
        .education-item:hover, .exp-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .year {
            color: #876fd6;
            font-size: 14px;
            font-weight: 500;
        }
        
        .type, .position {
            font-weight: bold;
            margin: 5px 0;
            color: #4a3e7c;
        }
        
        .school, .exp {
            font-style: italic;
            color: #6a5aae;
        }
        
        .task-list {
            margin-top: 10px;
        }
        
        .task-list li {
            margin-bottom: 5px;
            font-size: 14px;
            color: #4a3e7c;
        }
        
        .print-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 14px 22px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }
        
        .print-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }
        
        @media print {
            .header-bar, .print-btn {
                display: none;
            }
            
            .container {
                margin: 0;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>

<div class="header-bar">
    <div class="welcome-text">Welcome, <?php echo ucfirst($_SESSION['username']); ?>!</div>
    <a href="?logout=1" class="logout-btn" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
</div>

<div class="container">
    <div class="left-column">
        <div class="profile-photo"></div>
        
        <div class="name"><?php echo $name; ?></div>
        <div class="job-title"><?php echo $title; ?></div>
        
        <div class="section-title">✉️ Contact</div>
        <?php foreach($contact as $type => $info): ?>
        <div class="contact-item">
            <?php echo $info; ?>
        </div>
        <?php endforeach; ?>
        
        <div class="section-title">🛠️ Skills</div>
        <?php foreach($skills as $skill => $level): ?>
        <div class="skill-item">
            <div class="skill-name"><?php echo $skill; ?></div>
            <div class="skill-bar">
                <div class="skill-level" style="width: <?php echo ($level * 20); ?>%"></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div class="right-column">
        <div class="right-section">📝 About Me</div>
        <p class="about-text"><?php echo $about; ?></p>
        
        <div class="right-section">🎓 Education</div>
        <?php foreach($education as $edu): ?>
        <div class="education-item">
            <div class="year"><?php echo $edu['year']; ?></div>
            <div class="type"><?php echo $edu['type']; ?></div>
            <div class="school"><?php echo $edu['school']; ?></div>
        </div>
        <?php endforeach; ?>
        
        <div class="right-section">💼 Seminar and Training</div>
        <?php foreach($exp as $job): ?>
        <div class="exp-item">
            <div class="year"><?php echo $job['year']; ?></div>
            <div class="seminar"><?php echo $job['seminar']; ?></div>
            <div class="position"><?php echo $job['position']; ?></div>
            <ul class="task-list">
                <?php foreach($job['tasks'] as $task): ?>
                <li><?php echo $task; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<button class="print-btn" onclick="window.print()">🖨️ Print Resume</button>

</body>
</html>