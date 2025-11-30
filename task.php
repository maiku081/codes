<?php
// Login check removed for testing
// session_start();
// if (!isset($_SESSION['user_name'])) {
//     header("Location: login.php");
//     exit();
// }
// $username = htmlspecialchars($_SESSION['user_name']);
$username = "Guest"; // Default username for testing
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizzardCode - Tasks</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        /* Dropdown styles */
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background: rgba(0, 0, 0, 0.95);
            min-width: 220px;
            border: 1px solid var(--primary);
            border-radius: 4px;
            z-index: 1001;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
            padding: 0.5rem 0;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-top: 2px solid var(--accent);
            transform-origin: top right;
            animation: dropdownFadeIn 0.2s ease-out;
        }

        @keyframes dropdownFadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .dropdown-content a {
            color: var(--primary);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: all 0.2s ease;
            border-bottom: 1px solid rgba(255, 0, 255, 0.1);
        }
        
        .dropdown-content a:hover {
            background-color: rgba(255, 0, 255, 0.2);
            color: var(--accent) !important;
            padding-left: 20px;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .dropdown {
                width: 100%;
                text-align: center;
            }
            
            .dropdown-content {
                width: 100%;
                position: relative !important;
                border-radius: 0 0 4px 4px;
                margin-top: 0.5rem;
            }
        }
        :root {
            --primary: #ff00ff;
            --secondary: #00ffff;
            --accent: #ffff00;
            --bg: #000000;
            --screen: #1a1a2e;
            --pixel: 2px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Press Start 2P', cursive;
            image-rendering: pixelated;
        }

        body {
            background: var(--bg);
            color: var(--primary);
            min-height: 100vh;
            background: 
                url('https://i.giphy.com/media/KAq5w47R9rmTuvtOYp3/giphy.gif') center/cover no-repeat fixed,
                radial-gradient(circle at center, rgba(26, 26, 46, 0.9) 0%, rgba(0, 0, 0, 0.95) 100%),
                repeating-linear-gradient(
                    0deg,
                    rgba(255, 0, 255, 0.1) 0px,
                    rgba(255, 0, 255, 0.1) 1px,
                    transparent 1px,
                    transparent 2px
                );
            background-blend-mode: overlay, normal, normal;
            font-size: 16px;
            line-height: 1.6;
            position: relative;
            overflow-x: hidden;
            padding: 2rem;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                135deg, 
                rgba(0, 0, 0, 0.8) 0%, 
                rgba(26, 26, 46, 0.7) 100%
            );
            z-index: -1;
            pointer-events: none;
        }

        .screen {
            position: relative;
            width: 95%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            background: var(--screen);
            border: 4px solid var(--primary);
            transform-style: preserve-3d;
            box-shadow: 
                20px 20px 0 rgba(255, 0, 255, 0.2),
                40px 40px 0 rgba(0, 255, 255, 0.1);
        }

        h1, h2, h3 {
            color: var(--accent);
            text-shadow: 
                3px 3px 0 var(--primary),
                6px 6px 0 var(--secondary);
            margin: 1rem 0;
            line-height: 1.3;
        }

        .btn {
            background: var(--primary);
            color: #000;
            border: none;
            padding: 1rem 2rem;
            font-family: 'Press Start 2P', cursive;
            font-size: 1rem;
            cursor: pointer;
            margin: 1rem 0;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.3s;
            border: 4px solid var(--primary);
            box-shadow: 
                4px 4px 0 var(--secondary),
                8px 8px 0 var(--accent);
            position: relative;
            z-index: 10;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            transform: translate(2px, 2px);
            box-shadow: 
                2px 2px 0 var(--secondary),
                4px 4px 0 var(--accent);
        }

        .btn:active {
            transform: translate(4px, 4px);
            box-shadow: none;
        }

        .card {
            background: rgba(0, 0, 0, 0.5);
            border: 2px solid var(--secondary);
            padding: 1.5rem;
            margin: 1rem 0;
            transition: all 0.3s;
            min-height: 200px;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0 var(--primary);
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            margin-left: 1rem;
            font-size: 0.7rem;
            border-radius: 4px;
        }

        .beginner { background: #4CAF50; color: #000; }
        .intermediate { background: #2196F3; color: #000; }
        .advanced { background: #f44336; color: #000; }

        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
            margin: 2rem auto 0;
            align-items: stretch;
            width: 100%;
            max-width: 1200px;
            padding: 0 1rem;
        }

        .task-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .task-card {
            background: rgba(0, 0, 0, 0.5);
            border: 2px solid var(--secondary);
            padding: 1.5rem;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        .task-card:hover {
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0 var(--primary);
            border-color: var(--primary);
        }

        .task-card h3 {
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .task-card p {
            color: var(--secondary);
            font-size: 0.7rem;
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        .task-card .btn {
            font-size: 0.8rem;
            padding: 0.6rem 1.2rem;
            margin-top: auto;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }
            
            .card {
                width: 100%;
                max-width: 100%;
                margin: 0;
            }

            .task-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Taskbar -->
    <div class="taskbar" style="position: fixed; top: 0; left: 0; width: 100%; height: 80px; background: rgba(0, 0, 0, 0.9); border-bottom: 3px solid var(--primary); z-index: 1000; padding: 1.2rem 3rem; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 15px rgba(255, 0, 255, 0.4);">
        <div class="taskbar-left" style="display: flex; align-items: center; gap: 1.5rem;">
            <div class="logo" style="display: flex; align-items: center; gap: 1rem; margin: 0; padding: 0;">
                <img src="hacker.gif" alt="QuizzardCode Logo" style="width: 40px; height: 40px; object-fit: contain;">
                <a href="index.php" style="color: var(--accent); text-decoration: none; font-size: 1.1rem; text-shadow: 0 0 5px var(--accent);">
                    QuizzardCode
                </a>
            </div>
            <div class="taskbar-time" style="background: rgba(0, 0, 0, 0.5); padding: 0.4rem 1rem; border: 1px solid var(--secondary); color: var(--secondary); font-size: 0.85rem;">
                <span id="current-time">00:00:00</span>
            </div>
        </div>
        <div class="taskbar-right" style="display: flex; gap: 1.5rem; align-items: center; margin-left: auto; margin-right: 2rem; position: relative;">
            <!-- Profile Dropdown -->
            <div class="dropdown" style="position: relative; display: inline-block;">
                <button class="dropbtn" style="
                    padding: 0.7rem 1.5rem;
                    background: linear-gradient(135deg, rgba(0, 0, 0, 0.8), rgba(0, 20, 30, 0.9));
                    border: 2px solid var(--primary);
                    color: var(--accent);
                    font-family: 'Press Start 2P', cursive;
                    font-size: 0.8rem;
                    cursor: pointer;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    display: flex;
                    align-items: center;
                    gap: 0.75rem;
                    position: relative;
                    overflow: hidden;
                    z-index: 1;
                    box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    border-radius: 6px;
                    text-shadow: 0 0 8px rgba(0, 255, 255, 0.5);
                ">
                    <span style="position: relative; z-index: 2; filter: drop-shadow(0 0 3px var(--accent));">👤</span>
                    <span style="position: relative; z-index: 2;"><?php echo strtoupper($username); ?></span>
                    <span style="position: relative; z-index: 2; margin-left: 0.25rem; font-size: 0.6em; transition: transform 0.3s ease;">▼</span>
                    <span style="
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: linear-gradient(90deg, 
                            transparent, 
                            rgba(0, 255, 255, 0.1), 
                            transparent
                        );
                        transform: translateX(-100%);
                        transition: transform 0.6s;
                        z-index: 1;
                    "></span>
                </button>
                <div class="dropdown-content" style="
                    display: none;
                    position: absolute;
                    right: 0;
                    top: calc(100% + 5px);
                    background: rgba(5, 10, 20, 0.98);
                    min-width: 250px;
                    border: 2px solid var(--primary);
                    border-radius: 8px;
                    z-index: 1001;
                    box-shadow: 0 5px 25px rgba(0, 255, 255, 0.2);
                    padding: 0.75rem 0;
                    backdrop-filter: blur(12px);
                    -webkit-backdrop-filter: blur(12px);
                    border-top: 3px solid var(--accent);
                    transform-origin: top right;
                    animation: dropdownFadeIn 0.25s cubic-bezier(0.4, 0, 0.2, 1);
                    overflow: hidden;
                ">
                    <div style="
                        position: absolute;
                        top: 0;
                        left: 0;
                        right: 0;
                        height: 2px;
                        background: linear-gradient(90deg, 
                            transparent, 
                            var(--accent), 
                            transparent
                        );
                        opacity: 0.7;
                    "></div>
                    <a href="user.php" class="dropdown-item" style="
                        color: var(--primary);
                        padding: 14px 25px;
                        text-decoration: none;
                        display: flex;
                        align-items: center;
                        gap: 12px;
                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                        border-left: 4px solid transparent;
                        margin: 4px 10px;
                        position: relative;
                        overflow: hidden;
                        border-radius: 4px;
                        background: rgba(0, 20, 30, 0.3);
                        font-family: 'Press Start 2P', cursive;
                        font-size: 0.7rem;
                        letter-spacing: 0.5px;
                        text-transform: uppercase;
                    ">
                        <span style="font-size: 1.1em; filter: drop-shadow(0 0 3px rgba(0, 255, 255, 0.7));">🏆</span>
                        <span>ACHIEVEMENTS</span>
                        <span style="
                            position: absolute;
                            right: 15px;
                            opacity: 0.7;
                            font-size: 0.7em;
                            color: var(--accent);
                            transition: all 0.3s ease;
                        ">▶</span>
                    </a>
                    <a href="task.php" class="dropdown-item" style="
                        color: var(--accent);
                        padding: 14px 25px;
                        text-decoration: none;
                        display: flex;
                        align-items: center;
                        gap: 12px;
                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                        border-left: 4px solid var(--accent);
                        margin: 4px 10px;
                        position: relative;
                        overflow: hidden;
                        border-radius: 4px;
                        background: rgba(0, 20, 30, 0.3);
                        font-family: 'Press Start 2P', cursive;
                        font-size: 0.7rem;
                        letter-spacing: 0.5px;
                        text-transform: uppercase;
                    ">
                        <span style="font-size: 1.1em; filter: drop-shadow(0 0 3px rgba(0, 255, 255, 0.7));">🎮</span>
                        <span>TASKS</span>
                        <span style="
                            position: absolute;
                            right: 15px;
                            opacity: 0.7;
                            font-size: 0.7em;
                            color: var(--accent);
                            transition: all 0.3s ease;
                        ">▶</span>
                    </a>
                    <a href="leaderboard.php" class="dropdown-item" style="
                        color: var(--primary);
                        padding: 14px 25px;
                        text-decoration: none;
                        display: flex;
                        align-items: center;
                        gap: 12px;
                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                        border-left: 4px solid transparent;
                        margin: 4px 10px;
                        position: relative;
                        overflow: hidden;
                        border-radius: 4px;
                        background: rgba(0, 20, 30, 0.3);
                        font-family: 'Press Start 2P', cursive;
                        font-size: 0.7rem;
                        letter-spacing: 0.5px;
                        text-transform: uppercase;
                    ">
                        <span style="font-size: 1.1em; filter: drop-shadow(0 0 3px rgba(0, 255, 255, 0.7));">📊</span>
                        <span>LEADERBOARD</span>
                        <span style="
                            position: absolute;
                            right: 15px;
                            opacity: 0.7;
                            font-size: 0.7em;
                            color: var(--accent);
                            transition: all 0.3s ease;
                        ">▶</span>
                    </a>
                    <div style="
                        margin: 10px 15px 5px;
                        height: 1px;
                        background: linear-gradient(90deg, 
                            transparent, 
                            rgba(0, 255, 255, 0.3), 
                            transparent
                        );
                    "></div>
                    <a href="logout.php" class="dropdown-item" style="
                        color: #ff4444;
                        padding: 14px 25px;
                        text-decoration: none;
                        display: flex;
                        align-items: center;
                        gap: 12px;
                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                        border-left: 4px solid transparent;
                        margin: 4px 10px;
                        position: relative;
                        overflow: hidden;
                        border-radius: 4px;
                        background: rgba(0, 20, 30, 0.3);
                        font-family: 'Press Start 2P', cursive;
                        font-size: 0.7rem;
                        letter-spacing: 0.5px;
                        text-transform: uppercase;
                    ">
                        <span style="font-size: 1.1em; filter: drop-shadow(0 0 3px rgba(255, 68, 68, 0.7));">🚪</span>
                        <span>LOGOUT</span>
                        <span style="
                            position: absolute;
                            right: 15px;
                            opacity: 0.7;
                            font-size: 0.7em;
                            color: #ff4444;
                            transition: all 0.3s ease;
                        ">▶</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="screen" style="margin-top: 100px;">
        <h1>Tasks</h1>
        <p style="text-align: center; color: var(--secondary); margin-bottom: 2rem;">Test your Python knowledge with quizzes and debugging challenges</p>
        
        <!-- Filter Dropdowns -->
        <div style="display: flex; gap: 1.5rem; justify-content: center; margin: 2rem 0; flex-wrap: wrap; align-items: center;">
            <!-- Gamemode Dropdown -->
            <div class="custom-filter-dropdown" style="position: relative; display: inline-block; z-index: 10;">
                <label style="color: var(--accent); font-size: 0.7rem; margin-bottom: 0.5rem; display: block; text-align: center; transition: all 0.3s ease;">GAMEMODE</label>
                <button class="filter-dropdown-btn" id="gamemode-filter-btn" data-filter="gamemode" style="
                    padding: 0.8rem 2rem 0.8rem 1rem;
                    background: linear-gradient(135deg, rgba(0, 0, 0, 0.8), rgba(0, 20, 30, 0.9));
                    border: 2px solid var(--primary);
                    color: var(--primary);
                    cursor: pointer;
                    font-family: 'Press Start 2P', cursive;
                    font-size: 0.7rem;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    position: relative;
                    min-width: 200px;
                    text-align: left;
                    transition: all 0.3s ease;
                    box-shadow: 0 4px 0 rgba(0, 0, 0, 0.2);
                ">
                    <span id="gamemode-selected">ALL MODES</span>
                    <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">▼</span>
                </button>
                <div id="gamemode-filter-menu" class="filter-dropdown-menu" style="
                    display: none;
                    position: absolute;
                    background: rgba(0, 0, 0, 0.95);
                    border: 2px solid var(--primary);
                    width: 100%;
                    z-index: 1000;
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
                    overflow: hidden;
                    border-radius: 4px;
                ">
                    <div class="filter-option" data-value="all" style="
                        color: var(--primary);
                        padding: 12px 20px;
                        cursor: pointer;
                        transition: all 0.2s ease;
                        border-bottom: 1px solid rgba(255, 0, 255, 0.1);
                    ">
                        ALL MODES
                    </div>
                    <div class="filter-option" data-value="quiz" style="
                        color: var(--primary);
                        padding: 12px 20px;
                        cursor: pointer;
                        transition: all 0.2s ease;
                        border-bottom: 1px solid rgba(255, 0, 255, 0.1);
                    ">
                        QUIZ
                    </div>
                    <div class="filter-option" data-value="debugging" style="
                        color: var(--primary);
                        padding: 12px 20px;
                        cursor: pointer;
                        transition: all 0.2s ease;
                        border-bottom: 1px solid rgba(255, 0, 255, 0.1);
                    ">
                        DEBUGGING
                    </div>
                    <div class="filter-option" data-value="endless" style="
                        color: var(--primary);
                        padding: 12px 20px;
                        cursor: pointer;
                        transition: all 0.2s ease;
                    ">
                        ENDLESS MODE
                    </div>
                </div>
                <input type="hidden" id="gamemode-filter" value="all">
            </div>
            
            <!-- Difficulty Dropdown -->
            <div class="custom-filter-dropdown" style="position: relative; display: inline-block; z-index: 10;">
                <label style="color: var(--accent); font-size: 0.7rem; margin-bottom: 0.5rem; display: block; text-align: center; transition: all 0.3s ease;">DIFFICULTY</label>
                <button class="filter-dropdown-btn" id="difficulty-filter-btn" data-filter="difficulty" style="
                    padding: 0.8rem 2rem 0.8rem 1rem;
                    background: linear-gradient(135deg, rgba(0, 0, 0, 0.8), rgba(0, 20, 30, 0.9));
                    border: 2px solid var(--primary);
                    color: var(--primary);
                    cursor: pointer;
                    font-family: 'Press Start 2P', cursive;
                    font-size: 0.7rem;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    position: relative;
                    min-width: 200px;
                    text-align: left;
                    transition: all 0.3s ease;
                    box-shadow: 0 4px 0 rgba(0, 0, 0, 0.2);
                ">
                    <span id="difficulty-selected">ALL LEVELS</span>
                    <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">▼</span>
                </button>
                <div id="difficulty-filter-menu" class="filter-dropdown-menu" style="
                    display: none;
                    position: absolute;
                    background: rgba(0, 0, 0, 0.95);
                    border: 2px solid var(--primary);
                    width: 100%;
                    z-index: 1000;
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
                    overflow: hidden;
                    border-radius: 4px;
                ">
                    <div class="filter-option" data-value="all" style="
                        color: var(--primary);
                        padding: 12px 20px;
                        cursor: pointer;
                        transition: all 0.2s ease;
                        border-bottom: 1px solid rgba(255, 0, 255, 0.1);
                    ">
                        ALL LEVELS
                    </div>
                    <div class="filter-option" data-value="beginner" style="
                        color: var(--primary);
                        padding: 12px 20px;
                        cursor: pointer;
                        transition: all 0.2s ease;
                        border-bottom: 1px solid rgba(255, 0, 255, 0.1);
                    ">
                        BEGINNER
                    </div>
                    <div class="filter-option" data-value="intermediate" style="
                        color: var(--primary);
                        padding: 12px 20px;
                        cursor: pointer;
                        transition: all 0.2s ease;
                        border-bottom: 1px solid rgba(255, 0, 255, 0.1);
                    ">
                        INTERMEDIATE
                    </div>
                    <div class="filter-option" data-value="advanced" style="
                        color: var(--primary);
                        padding: 12px 20px;
                        cursor: pointer;
                        transition: all 0.2s ease;
                    ">
                        ADVANCED
                    </div>
                </div>
                <input type="hidden" id="difficulty-filter" value="all">
            </div>
        </div>
        
        <!-- Quiz Mode Section -->
        <h2 style="text-align: center; margin-top: 2rem; font-size: 1.2rem;">QUIZ MODE</h2>
        <div class="task-grid">
            <?php
            $quizLevels = [
                'beginner' => [
                    ['title' => 'VARIABLES & DATA TYPES', 'questions' => 5],
                    ['title' => 'OPERATORS', 'questions' => 6],
                    ['title' => 'CONTROL FLOW', 'questions' => 7],
                    ['title' => 'LOOPS', 'questions' => 6],
                    ['title' => 'LISTS & TUPLES', 'questions' => 7],
                    ['title' => 'DICTIONARIES & SETS', 'questions' => 8]
                ],
                'intermediate' => [
                    ['title' => 'FUNCTIONS', 'questions' => 7],
                    ['title' => 'LAMBDA & MAP', 'questions' => 8],
                    ['title' => 'LIST COMPREHENSIONS', 'questions' => 8],
                    ['title' => 'FILE HANDLING', 'questions' => 7],
                    ['title' => 'ERROR HANDLING', 'questions' => 6],
                    ['title' => 'MODULES & PACKAGES', 'questions' => 8]
                ],
                'advanced' => [
                    ['title' => 'OOP CONCEPTS', 'questions' => 10],
                    ['title' => 'DECORATORS', 'questions' => 9],
                    ['title' => 'GENERATORS', 'questions' => 8],
                    ['title' => 'MULTITHREADING', 'questions' => 10],
                    ['title' => 'DESIGN PATTERNS', 'questions' => 12],
                    ['title' => 'ADVANCED PYTHON', 'questions' => 15]
                ]
            ];

            foreach ($quizLevels as $difficulty => $levels) {
                $difficultyColor = [
                    'beginner' => '#4CAF50',
                    'intermediate' => '#2196F3',
                    'advanced' => '#f44336'
                ][$difficulty];

                foreach ($levels as $index => $level) {
                    $levelNum = $index + 1;
                    echo "
                    <div class='task-card' data-gamemode='quiz' data-difficulty='$difficulty'>
                        <div style='display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;'>
                            <h3 style='margin: 0; font-size: 0.8rem;'>" . strtoupper($level['title']) . "</h3>
                            <span class='badge $difficulty' style='background: $difficultyColor; color: #000; font-size: 0.6rem; padding: 0.3rem 0.6rem;'>
                                " . strtoupper($difficulty) . " $levelNum
                            </span>
                        </div>
                        <p style='color: var(--secondary); font-size: 0.7rem; margin-bottom: 1rem; flex-grow: 1;'>
                            Test your knowledge of " . strtolower($level['title']) . " in Python.
                        </p>
                        <div style='display: flex; justify-content: space-between; align-items: center; margin-top: auto;'>
                            <span style='color: var(--accent); font-size: 0.7rem;'>★ {$level['questions']} Questions</span>
                            <a href='quiz.php?difficulty=$difficulty&level=$levelNum' class='btn' style='font-size: 0.8rem; padding: 0.6rem 1.2rem;'>
                                Start
                            </a>
                        </div>
                    </div>
                    ";
                }
            }
            ?>
        </div>

        <!-- Debugging Mode Section -->
        <h2 style="text-align: center; margin-top: 3rem; font-size: 1.2rem;">DEBUGGING MODE</h2>
        <div class="task-grid">
            <?php
            $debugLevels = [
                ['title' => 'SYNTAX ERRORS', 'bugs' => 3],
                ['title' => 'LOGIC ERRORS', 'bugs' => 4],
                ['title' => 'DATA STRUCTURES', 'bugs' => 5],
                ['title' => 'ALGORITHMS', 'bugs' => 6],
                ['title' => 'PERFORMANCE', 'bugs' => 7],
                ['title' => 'SECURITY', 'bugs' => 8]
            ];

            foreach ($debugLevels as $index => $level) {
                $levelNum = $index + 1;
                $difficulty = $levelNum <= 2 ? 'beginner' : ($levelNum <= 4 ? 'intermediate' : 'advanced');
                $difficultyColor = [
                    'beginner' => '#4CAF50',
                    'intermediate' => '#2196F3',
                    'advanced' => '#f44336'
                ][$difficulty];

                echo "
                <div class='task-card' data-gamemode='debugging' data-difficulty='$difficulty'>
                    <div style='display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;'>
                        <h3 style='margin: 0; font-size: 0.8rem;'>" . strtoupper($level['title']) . "</h3>
                        <span class='badge $difficulty' style='background: $difficultyColor; color: #000; font-size: 0.6rem; padding: 0.3rem 0.6rem;'>
                            " . strtoupper($difficulty) . " $levelNum
                        </span>
                    </div>
                    <p style='color: var(--secondary); font-size: 0.7rem; margin-bottom: 1rem; flex-grow: 1;'>
                        Find and fix bugs related to " . strtolower($level['title']) . ".
                    </p>
                    <div style='display: flex; justify-content: space-between; align-items: center; margin-top: auto;'>
                        <span style='color: var(--accent); font-size: 0.7rem;'>★ {$level['bugs']} Bugs to Fix</span>
                        <a href='debugging.php?level=$levelNum' class='btn' style='font-size: 0.8rem; padding: 0.6rem 1.2rem;'>
                            Debug
                        </a>
                    </div>
                </div>
                ";
            }
            ?>
        </div>

        <!-- Endless Mode Section -->
        <h2 style="text-align: center; margin-top: 3rem; font-size: 1.2rem;">ENDLESS MODE</h2>
        <div class="task-grid" style="grid-template-columns: 1fr; max-width: 600px; margin: 0 auto;">
            <div class='task-card' data-gamemode='endless' style="background: linear-gradient(135deg, rgba(0, 20, 30, 0.7), rgba(0, 40, 60, 0.8)); border: 2px solid var(--accent);">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <h3 style="margin: 0 0 1rem 0; font-size: 1.2rem; color: var(--accent);">🎮 ENDLESS CHALLENGE</h3>
                    <div style="display: flex; justify-content: center; gap: 1rem; margin-bottom: 1rem;">
                        <span class='badge' style='background: #9C27B0; color: #fff; font-size: 0.7rem; padding: 0.3rem 0.8rem;'>
                            QUIZ MODE
                        </span>
                        <span class='badge' style='background: #FF9800; color: #000; font-size: 0.7rem; padding: 0.3rem 0.8rem;'>
                            DEBUG MODE
                        </span>
                    </div>
                    <p style="color: var(--secondary); font-size: 0.9rem; line-height: 1.5;">
                        Test your skills with a continuous stream of random challenges.
                        Switch between quiz questions and debugging tasks seamlessly.
                    </p>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin: 1.5rem 0;">
                    <div style="text-align: center; padding: 1rem; background: rgba(0, 0, 0, 0.2); border-radius: 8px;">
                        <div style="font-size: 1.8rem; margin-bottom: 0.5rem;">❓</div>
                        <h4 style="margin: 0 0 0.5rem 0; color: var(--accent);">Quiz Challenges</h4>
                        <p style="margin: 0; font-size: 0.8rem; color: var(--secondary);">Test your Python knowledge with random questions</p>
                    </div>
                    <div style="text-align: center; padding: 1rem; background: rgba(0, 0, 0, 0.2); border-radius: 8px;">
                        <div style="font-size: 1.8rem; margin-bottom: 0.5rem;">🐛</div>
                        <h4 style="margin: 0 0 0.5rem 0; color: var(--accent);">Debugging Tasks</h4>
                        <p style="margin: 0; font-size: 0.8rem; color: var(--secondary);">Find and fix bugs in Python code</p>
                    </div>
                </div>
                <div style="text-align: center; margin-top: 1.5rem;">
                    <a href="endless.php" class="btn" style="font-size: 1rem; padding: 0.8rem 2rem; background: var(--accent); color: #000; font-weight: bold; border: none;">
                        START ENDLESS MODE
                    </a>
                    <p style="font-size: 0.8rem; color: var(--secondary); margin-top: 0.8rem;">
                        Difficulty adapts to your skill level
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // =============================================
        // Global Variables
        // =============================================
        let gamemodeFilter, difficultyFilter, taskCards;
        let gamemodeMenu, difficultyMenu;
        let hoverTimeout;

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize elements
            gamemodeFilter = document.getElementById('gamemode-filter');
            difficultyFilter = document.getElementById('difficulty-filter');
            taskCards = document.querySelectorAll('.task-card');
            
            // Get dropdown menus
            gamemodeMenu = document.getElementById('gamemode-filter-menu');
            difficultyMenu = document.getElementById('difficulty-filter-menu');
            
            // Initialize dropdowns
            initDropdowns();
            
            // Initial filter update
            updateTaskFilters();

            // Function to show all tasks
            function showAllTasks() {
            @keyframes dropdownPopoutOut {
                from { opacity: 1; transform: translateY(0) scale(1); }
                to { opacity: 0; transform: translateY(-10px) scale(0.95); }
            }
            .filter-dropdown-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: rgba(0, 20, 40, 0.95);
                border: 1px solid var(--primary);
                border-top: none;
                border-radius: 0 0 4px 4px;
                z-index: 1000;
                overflow: hidden;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            }
            .filter-option {
                padding: 12px 20px;
                cursor: pointer;
                transition: all 0.2s ease;
                border-left: 4px solid transparent;
            }
            .filter-option:hover {
                background: rgba(0, 150, 200, 0.3);
                border-left-color: var(--accent);
                color: var(--accent);
            }
            .filter-dropdown-btn {
                position: relative;
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
                text-align: left;
                padding: 0.8rem 1rem;
                }
                
                // If debugging is selected, force difficulty to beginner
                if (gamemodeFilter.value === 'debugging' && difficultyFilter.value !== 'beginner') {
                    difficultyFilter.value = 'beginner';
                    const difficultyBtn = document.querySelector('#difficulty-filter-btn .filter-selected-text');
                    const beginnerOption = document.querySelector('#difficulty-filter-menu [data-value="beginner"]');
                    
                    if (difficultyBtn && beginnerOption) {
                        difficultyBtn.textContent = 'BEGINNER';
                        
                        // Update difficulty options style
                        const difficultyOptions = document.querySelectorAll('#difficulty-filter-menu .filter-option');
                        difficultyOptions.forEach(opt => {
                            opt.style.background = 'transparent';
                            opt.style.color = 'var(--primary)';
                            opt.style.opacity = '0.7';
                        });
                        
                        beginnerOption.style.background = 'rgba(0, 150, 200, 0.15)';
                        beginnerOption.style.color = 'var(--accent)';
                        beginnerOption.style.opacity = '1';
                    }
                }
                
                const selectedGamemode = gamemodeFilter.value.toLowerCase();
                const selectedDifficulty = difficultyFilter.value.toLowerCase();
                
                console.log('Filtering tasks with:', { selectedGamemode, selectedDifficulty });
                
                // If debugging is selected, force difficulty to beginner
                if (selectedGamemode === 'debugging' && selectedDifficulty !== 'beginner') {
                    difficultyFilter.value = 'beginner';
                    const difficultyBtn = document.querySelector('#difficulty-filter-btn .filter-selected-text');
                    if (difficultyBtn) {
                        difficultyBtn.textContent = 'BEGINNER';
                    }
                }

                let visibleQuizCards = 0;
                let visibleDebuggingCards = 0;
                let visibleEndlessCards = 0;
                
                // For debugging: log the current filter values
                console.log('Filtering by:', {
                    gamemode: selectedGamemode,
                    difficulty: selectedDifficulty
                });
                
                // Show all task grids initially
                document.querySelectorAll('.task-grid').forEach(grid => {
                    grid.style.display = 'grid';
                });
                
                // Show all section headers initially
                document.querySelectorAll('h2').forEach(header => {
                    header.style.display = 'block';
                });

                // Filter task cards with animation
                taskCards.forEach((card, index) => {
                    const cardGamemode = card.getAttribute('data-gamemode').toLowerCase();
                    const cardDifficulty = card.getAttribute('data-difficulty').toLowerCase();

                    // Check if card matches the selected filters
                    const gamemodeMatch = selectedGamemode === 'all' || cardGamemode === selectedGamemode;
                    const difficultyMatch = selectedDifficulty === 'all' || cardDifficulty === selectedDifficulty;
                    
                    // Special case: If debugging is selected, only show debugging cards
                    const isDebuggingMode = selectedGamemode === 'debugging' && cardGamemode === 'debugging';
                    const isMatchingDebugging = isDebuggingMode && 
                        (selectedDifficulty === 'all' || cardDifficulty === selectedDifficulty);
                    
                    // Debug log for each card's attributes
                    console.log('Card:', {
                        element: card,
                        gamemode: cardGamemode,
                        difficulty: cardDifficulty,
                        matches: { gamemodeMatch, difficultyMatch }
                    });

                    if ((gamemodeMatch && difficultyMatch) || isMatchingDebugging) {
                        // Show card with staggered animation
                        setTimeout(() => {
                            card.style.display = 'flex';
                            card.style.opacity = '0';
                            card.style.animation = 'fadeIn 0.4s ease-in forwards';
                            setTimeout(() => {
                                card.style.opacity = '1';
                            }, 50);
                        }, index * 20);
                        
                        // Update section counters
                        const cardSection = card.closest('.task-grid').previousElementSibling;
                        if (cardSection) {
                            const sectionText = cardSection.textContent || '';
                            if (sectionText.includes('QUIZ MODE')) {
                                visibleQuizCards++;
                            } else if (sectionText.includes('DEBUGGING MODE')) {
                                visibleDebuggingCards++;
                            } else if (sectionText.includes('ENDLESS MODE')) {
                                visibleEndlessCards++;
                            }
                        }
                    } else {
                        // Hide card with fade out
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 200);
                    }
                });

                // Update section headers visibility
                updateSectionVisibility('QUIZ MODE', visibleQuizCards);
                updateSectionVisibility('DEBUGGING MODE', visibleDebuggingCards);
                updateSectionVisibility('ENDLESS MODE', visibleEndlessCards);
            }

            function updateSectionVisibility(sectionName, visibleCount) {
                const headers = document.querySelectorAll('h2');
                headers.forEach(header => {
                    if (header.textContent.includes(sectionName)) {
                        header.style.display = visibleCount > 0 ? 'block' : 'none';
                        if (visibleCount > 0) {
                            header.style.animation = 'fadeIn 0.3s ease-in';
                        }
                    }
                });
            }

            // =============================================
            // Initialize Dropdowns
            // =============================================
            function initDropdowns() {
                const gamemodeBtn = document.getElementById('gamemode-filter-btn');
                const difficultyBtn = document.getElementById('difficulty-filter-btn');
                const gamemodeOptions = document.querySelectorAll('#gamemode-filter-menu .filter-option');
                const difficultyOptions = document.querySelectorAll('#difficulty-filter-menu .filter-option');

                // Show/hide gamemode dropdown on hover
                gamemodeBtn.addEventListener('mouseenter', () => showMenu(gamemodeMenu, difficultyMenu));
                gamemodeMenu.addEventListener('mouseenter', () => showMenu(gamemodeMenu, difficultyMenu));
                
                // Show/hide difficulty dropdown on hover
                difficultyBtn.addEventListener('mouseenter', () => {
                    if (gamemodeFilter.value !== 'endless') {
                        showMenu(difficultyMenu, gamemodeMenu);
                    }
                });
                difficultyMenu.addEventListener('mouseenter', () => {
                    if (gamemodeFilter.value !== 'endless') {
                        showMenu(difficultyMenu, gamemodeMenu);
                    }
                });

                // Hide menus when mouse leaves
                gamemodeBtn.addEventListener('mouseleave', () => startHideTimeout(gamemodeMenu));
                gamemodeMenu.addEventListener('mouseleave', () => startHideTimeout(gamemodeMenu));
                difficultyBtn.addEventListener('mouseleave', () => startHideTimeout(difficultyMenu));
                difficultyMenu.addEventListener('mouseleave', () => startHideTimeout(difficultyMenu));

                // Handle option selection
                gamemodeOptions.forEach(option => {
                    option.addEventListener('click', () => selectOption(option, gamemodeMenu, gamemodeBtn, true));
                });

                difficultyOptions.forEach(option => {
                    option.addEventListener('click', () => selectOption(option, difficultyMenu, difficultyBtn, false));
                });

                // Close dropdowns when clicking outside
                document.addEventListener('click', (e) => {
                    if (!gamemodeBtn.contains(e.target) && !gamemodeMenu.contains(e.target)) {
                        hideMenu(gamemodeMenu);
                    }
                    if (!difficultyBtn.contains(e.target) && !difficultyMenu.contains(e.target)) {
                        hideMenu(difficultyMenu);
                    }
                });
            }

            function showMenu(menuToShow, menuToHide) {
                clearTimeout(hoverTimeout);
                hideMenu(menuToHide);
                menuToShow.style.display = 'block';
                menuToShow.style.animation = 'dropdownPopout 0.2s ease-out forwards';
            }

            function hideMenu(menu) {
                if (menu) {
                    menu.style.animation = 'dropdownPopoutOut 0.2s ease-out forwards';
                    setTimeout(() => {
                        menu.style.display = 'none';
                    }, 200);
                }
            }

            function startHideTimeout(menu) {
                hoverTimeout = setTimeout(() => hideMenu(menu), 300);
            }

            function selectOption(option, menu, btn, isGamemode) {
                const value = option.getAttribute('data-value');
                const input = isGamemode ? gamemodeFilter : difficultyFilter;
                input.value = value;

                // Update button text
                const btnText = btn.querySelector('span:first-child');
                btnText.textContent = option.textContent.trim();

                // Update active state
                menu.querySelectorAll('.filter-option').forEach(opt => {
                    opt.style.background = 'transparent';
                    opt.style.borderLeftColor = 'transparent';
                    opt.style.color = 'var(--primary)';
                });
                
                option.style.background = 'rgba(0, 150, 200, 0.3)';
                option.style.borderLeftColor = 'var(--accent)';
                option.style.color = 'var(--accent)';

                // Handle special cases
                if (isGamemode) {
                    if (value === 'endless') {
                        difficultyFilter.value = 'all';
                        const allOption = document.querySelector('#difficulty-filter-menu [data-value="all"]');
                        if (allOption) {
                            const difficultyBtnText = document.querySelector('#difficulty-filter-btn span:first-child');
                            difficultyBtnText.textContent = 'ALL LEVELS';
                            
                            // Update difficulty options style
                            const difficultyOptions = document.querySelectorAll('#difficulty-filter-menu .filter-option');
                            difficultyOptions.forEach(opt => {
                                opt.style.background = 'transparent';
                                opt.style.borderLeftColor = 'transparent';
                                opt.style.color = 'var(--primary)';
                            });
                            allOption.style.background = 'rgba(0, 150, 200, 0.3)';
                            allOption.style.borderLeftColor = 'var(--accent)';
                            allOption.style.color = 'var(--accent)';
                        }
                    }
                }

                // Update filters
                updateTaskFilters();
            }

            // =============================================
            // Initialize
            // =============================================
            function init() {
                initDropdowns();
                updateTaskFilters(); // Initial filter on page load
            }
            
            // Initialize the page
            init();

            }); // End of DOMContentLoaded

            // =============================================
            // Animation Keyframes
            // =============================================
            const style = document.createElement('style');
            style.textContent = `
                @keyframes fadeIn {
                    from { opacity: 0; transform: scale(0.95); }
                    to { opacity: 1; transform: scale(1); }
                }
                @keyframes dropdownPopout {
                    from { opacity: 0; transform: translateY(-10px) scale(0.95); }
                    to { opacity: 1; transform: translateY(0) scale(1); }
                }
                @keyframes dropdownPopoutOut {
                    from { opacity: 1; transform: translateY(0) scale(1); }
                    to { opacity: 0; transform: translateY(-10px) scale(0.95); }
                }
                @keyframes dropdownPopoutOut {
                    from { opacity: 1; transform: translateY(0) scale(1); }
                    to { opacity: 0; transform: translateY(-10px) scale(0.95); }
                }
                .filter-dropdown-menu {
                    display: none;
                    position: absolute;
                    top: 100%;
                    left: 0;
                    right: 0;
                    background: rgba(0, 20, 40, 0.95);
                    border: 1px solid var(--primary);
                    border-top: none;
                    border-radius: 0 0 4px 4px;
                    z-index: 1000;
                    overflow: hidden;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
                }
                .filter-option {
                    padding: 12px 20px;
                    cursor: pointer;
                    transition: all 0.2s ease;
                    border-left: 4px solid transparent;
                }
                .filter-option:hover {
                    background: rgba(0, 150, 200, 0.3);
                    border-left-color: var(--accent);
                    color: var(--accent);
                }
                .filter-dropdown-btn {
                    position: relative;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                    text-align: left;
                    padding: 0.8rem 1rem;
                    background: rgba(0, 20, 40, 0.8);
                    border: 1px solid var(--primary);
                    color: var(--primary);
                    cursor: pointer;
                    transition: all 0.3s ease;
                    font-family: 'Press Start 2P', cursive;
                    font-size: 0.7rem;
                    letter-spacing: 0.5px;
                }
                .filter-dropdown-btn:hover {
                    background: rgba(0, 30, 60, 0.9);
                    box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
                }
                .filter-dropdown-btn span:last-child {
                                0 0 75px rgba(0, 255, 255, 0.1);
                    border-color: var(--accent);
                    animation: dropdownPulse 2s ease-in-out infinite,
                               dropdownGlow 2s ease-in-out infinite,
                               dropdownScale 2s ease-in-out infinite;
                    transform: translateY(-2px);
                }
                .filter-dropdown-btn:focus {
                    outline: none;
                    background: linear-gradient(135deg, rgba(0, 30, 50, 0.95), rgba(0, 60, 90, 0.95));
                    box-shadow: 0 0 25px rgba(0, 255, 255, 0.6),
                                0 0 50px rgba(0, 255, 255, 0.3);
                    border-color: var(--accent);
                }
                .custom-filter-dropdown {
                    transition: transform 0.3s ease;
                }
                .custom-filter-dropdown:hover {
                    transform: translateY(-3px);
                }
                .custom-filter-dropdown label {
                    transition: all 0.3s ease;
                }
                .custom-filter-dropdown:hover label {
                    color: var(--accent);
                    text-shadow: 0 0 10px rgba(255, 255, 0, 0.8);
                }
                .filter-dropdown-menu {
                    transform-origin: top center;
                }
                .filter-option {
                    position: relative;
                }
                .filter-option:not(:last-child) {
                    border-bottom: 1px solid rgba(255, 0, 255, 0.1);
                }
            `;
            document.head.appendChild(style);

            // Initialize active states for options
            customDropdowns.forEach(dropdown => {
                const hiddenInput = dropdown.querySelector('input[type="hidden"]');
                const options = dropdown.querySelectorAll('.filter-option');
                const currentValue = hiddenInput.value;
                
                options.forEach(option => {
                    if (option.getAttribute('data-value') === currentValue) {
                        option.style.background = 'rgba(0, 150, 200, 0.4)';
                        option.style.borderLeftColor = 'var(--accent)';
                        option.style.color = 'var(--accent)';
                    }
                });
            });

            // Initialize filter on page load
            filterTasks();
        }); // Close the DOMContentLoaded event listener
    </script>
</body>
</html>

