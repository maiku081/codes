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
            background: rgba(0, 0, 0, 0.95);
            border: 2px solid var(--primary);
            min-width: 200px;
            z-index: 1000;
            box-shadow: 0 0 15px rgba(255, 0, 255, 0.5);
            border-radius: 4px;
            overflow: hidden;
            animation: fadeIn 0.3s ease-out;
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
            padding: 12px 20px;
            text-decoration: none;
            display: block;
            font-family: 'Press Start 2P', cursive;
            font-size: 0.7rem;
            transition: all 0.2s ease;
            border-bottom: 1px solid rgba(255, 0, 255, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .dropdown-content a:last-child {
            border-bottom: none;
        }
        
        .dropdown-content a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: var(--accent);
            transform: scaleY(0);
            transition: transform 0.2s ease;
        }
        
        .dropdown-content a:hover {
            background: rgba(255, 0, 255, 0.1);
            color: var(--accent);
            padding-left: 25px;
        }
        
        .dropdown-content a:hover::before {
            transform: scaleY(1);
        }

        .dropdown:hover .dropdown-content {
            display: block;
            animation: fadeIn 0.3s ease-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Custom scrollbar for dropdowns */
        .dropdown-content::-webkit-scrollbar {
            width: 8px;
        }
        
        .dropdown-content::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.2);
        }
        
        .dropdown-content::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }
        
        .dropdown-content::-webkit-scrollbar-thumb:hover {
            background: var(--accent);
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

        .dropbtn {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.8), rgba(0, 20, 30, 0.9));
            color: var(--primary);
            padding: 0.8rem 1.5rem;
            font-family: 'Press Start 2P', cursive;
            font-size: 0.7rem;
            border: 2px solid var(--primary);
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            transition: all 0.3s ease;
            box-shadow: 0 4px 0 rgba(0, 0, 0, 0.2);
        }
        
        .dropbtn:hover {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.9), rgba(0, 30, 40, 0.95));
            color: var(--accent);
            border-color: var(--accent);
            transform: translateY(-2px);
            box-shadow: 0 6px 0 rgba(0, 0, 0, 0.2);
        }
        
        .dropbtn:active {
            transform: translateY(2px);
            box-shadow: 0 2px 0 rgba(0, 0, 0, 0.2);
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
                    <a href="index.php" class="dropdown-item" style="
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
                        <span style="font-size: 1.1em; filter: drop-shadow(0 0 3px rgba(0, 255, 255, 0.7));">🏠</span>
                        <span>HOME</span>
                        <span style="
                            position: absolute;
                            right: 15px;
                            opacity: 0.7;
                            font-size: 0.7em;
                            color: var(--accent);
                            transition: all 0.3s ease;
                        ">▶</span>
                    </a>
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
                    // Lock all levels except beginner level 1
                    $isLocked = !($difficulty === 'beginner' && $levelNum === 1);
                    $lockedClass = $isLocked ? 'locked' : '';
                    $disabledStyle = $isLocked ? 'opacity: 0.6; pointer-events: none;' : '';
                    $lockIcon = $isLocked ? '🔒 ' : '';
                    $startButton = $isLocked 
                        ? "<div class='btn' style='font-size: 0.8rem; padding: 0.6rem 1.2rem; opacity: 0.7; background: #666;'>Locked</div>"
                        : "<a href='quiz.php?difficulty=$difficulty&level=$levelNum' class='btn' style='font-size: 0.8rem; padding: 0.6rem 1.2rem;'>Start</a>";
                    
                    echo "
                    <div class='task-card $lockedClass' data-gamemode='quiz' data-difficulty='$difficulty' style='$disabledStyle'>
                        <div style='display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;'>
                            <h3 style='margin: 0; font-size: 0.8rem;'>$lockIcon" . strtoupper($level['title']) . "</h3>
                            <span class='badge $difficulty' style='background: $difficultyColor; color: #000; font-size: 0.6rem; padding: 0.3rem 0.6rem;'>
                                " . strtoupper($difficulty) . " $levelNum
                            </span>
                        </div>
                        <p style='color: var(--secondary); font-size: 0.7rem; margin-bottom: 1rem; flex-grow: 1;'>
                            Test your knowledge of " . strtolower($level['title']) . " in Python.
                        </p>
                        <div style='display: flex; justify-content: space-between; align-items: center; margin-top: auto;'>
                            <span style='color: var(--accent); font-size: 0.7rem;'>★ {$level['questions']} Questions</span>
                            $startButton
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
                ['title' => 'VARIABLES & DATA TYPES', 'bugs' => 3],
                ['title' => 'FUNCTIONS', 'bugs' => 4],
                ['title' => 'LOOPS', 'bugs' => 4],
                ['title' => 'CONDITIONALS', 'bugs' => 3],
                ['title' => 'LISTS & DICTIONARIES', 'bugs' => 5],
                ['title' => 'COMMON MISTAKES', 'bugs' => 4]
            ];
            
            // Keep only the first 6 levels for beginner (original 2 + 4 new ones)
            $debugLevels = array_slice($debugLevels, 0, 6);

            foreach ($debugLevels as $index => $level) {
                $levelNum = $index + 1;
                $difficulty = 'beginner';
                $difficultyColor = [
                    'beginner' => '#4CAF50',
                    'intermediate' => '#2196F3',
                    'advanced' => '#f44336'
                ][$difficulty];

                // Lock all debugging levels
                $isLocked = true;
                $lockedClass = 'locked';
                $disabledStyle = 'opacity: 0.6; pointer-events: none;';
                $lockIcon = '🔒 ';
                $debugButton = "<div class='btn' style='font-size: 0.8rem; padding: 0.6rem 1.2rem; opacity: 0.7; background: #666;'>Locked</div>";

                echo "
                <div class='task-card $lockedClass' data-gamemode='debugging' data-difficulty='$difficulty' style='$disabledStyle'>
                    <div style='display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;'>
                        <h3 style='margin: 0; font-size: 0.8rem;'>$lockIcon" . strtoupper($level['title']) . "</h3>
                        <span class='badge $difficulty' style='background: $difficultyColor; color: #000; font-size: 0.6rem; padding: 0.3rem 0.6rem;'>
                            " . strtoupper($difficulty) . " $levelNum
                        </span>
                    </div>
                    <p style='color: var(--secondary); font-size: 0.7rem; margin-bottom: 1rem; flex-grow: 1;'>
                        Find and fix bugs related to " . strtolower($level['title']) . ".
                    </p>
                    <div style='display: flex; justify-content: space-between; align-items: center; margin-top: auto;'>
                        <span style='color: var(--accent); font-size: 0.7rem;'>★ {$level['bugs']} Bugs to Fix</span>
                        $debugButton
                    </div>
                </div>
                ";
            }
            ?>
        </div>

        <!-- Endless Mode Section -->
        <h2 style="text-align: center; margin-top: 3rem; font-size: 1.2rem;">ENDLESS MODE</h2>
        <div class="task-grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; max-width: 1000px; margin: 0 auto;">
            <!-- Quiz Endless Mode -->
            <div class='task-card' data-gamemode='endless-quiz' style="background: linear-gradient(135deg, rgba(30, 0, 50, 0.7), rgba(60, 0, 80, 0.8)); border: 2px solid #9C27B0;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <div style="font-size: 2rem; margin-bottom: 1rem;">❓</div>
                    <h3 style="margin: 0 0 0.5rem 0; font-size: 1.2rem; color: #E1BEE7;">ENDLESS QUIZ</h3>
                    <p style="color: var(--secondary); font-size: 0.9rem; line-height: 1.5; margin-bottom: 1.5rem;">
                        Test your Python knowledge with an endless stream of quiz questions. 
                        The difficulty adapts based on your performance.
                    </p>
                </div>
                <div style="text-align: center; margin-top: auto;">
                    <a href="endless.php?mode=quiz" class="btn" style="font-size: 1rem; padding: 0.8rem 2rem; background: #9C27B0; color: #fff; font-weight: bold; border: none; width: 100%;">
                        START QUIZ MODE
                    </a>
                    <p style="font-size: 0.8rem; color: var(--secondary); margin-top: 0.8rem;">
                        Questions adapt to your skill level
                    </p>
                </div>
            </div>

            <!-- Debugging Endless Mode -->
            <div class='task-card' data-gamemode='endless-debug' style="background: linear-gradient(135deg, rgba(50, 30, 0, 0.7), rgba(80, 50, 0, 0.8)); border: 2px solid #FF9800;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <div style="font-size: 2rem; margin-bottom: 1rem;">🐛</div>
                    <h3 style="margin: 0 0 0.5rem 0; font-size: 1.2rem; color: #FFE0B2;">ENDLESS DEBUGGING</h3>
                    <p style="color: var(--secondary); font-size: 0.9rem; line-height: 1.5; margin-bottom: 1.5rem;">
                        Hone your debugging skills with an endless stream of buggy code.
                        Find and fix issues to progress to more challenging problems.
                    </p>
                </div>
                <div style="text-align: center; margin-top: auto;">
                    <a href="endless.php?mode=debug" class="btn" style="font-size: 1rem; padding: 0.8rem 2rem; background: #FF9800; color: #000; font-weight: bold; border: none; width: 100%;">
                        START DEBUG MODE
                    </a>
                    <p style="font-size: 0.8rem; color: var(--secondary); margin-top: 0.8rem;">
                        Bugs get trickier as you improve
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
        
        // Update current time in the taskbar
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', { 
                hour12: false,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                timeElement.textContent = timeString;
            }
        }
        
        // Update time immediately and every second
        updateTime();
        setInterval(updateTime, 1000);

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
            
            // Add event listeners for filter changes
            if (gamemodeFilter) {
                gamemodeFilter.addEventListener('change', function() {
                    updateDifficultyOptions();
                    updateTaskFilters();
                });
            }
            
            if (difficultyFilter) {
                difficultyFilter.addEventListener('change', updateTaskFilters);
            }
            
            // Initial filter update
            updateTaskFilters();

            // Function to update task filters
            function updateTaskFilters() {
                const selectedGamemode = gamemodeFilter ? gamemodeFilter.value.toLowerCase() : 'all';
                const selectedDifficulty = difficultyFilter ? difficultyFilter.value.toLowerCase() : 'all';
                
                let visibleQuizCards = 0;
                let visibleDebuggingCards = 0;
                let visibleEndlessCards = 0;

                // Reset all section headers to visible first
                document.querySelectorAll('h2').forEach(header => {
                    header.style.display = 'block';
                });

                // Filter task cards with animation
                taskCards.forEach((card, index) => {
                    const cardGamemode = card.getAttribute('data-gamemode') ? card.getAttribute('data-gamemode').toLowerCase() : '';
                    const cardDifficulty = card.getAttribute('data-difficulty') ? card.getAttribute('data-difficulty').toLowerCase() : 'all';
                    const isEndlessCard = cardGamemode.includes('endless');

                    // Check if card matches the selected filters
                    let gamemodeMatch = false;
                    if (selectedGamemode === 'all') {
                        gamemodeMatch = true;
                    } else if (selectedGamemode === 'endless') {
                        gamemodeMatch = isEndlessCard;
                    } else if (selectedGamemode === 'quiz') {
                        gamemodeMatch = cardGamemode === 'quiz';
                    } else if (selectedGamemode === 'debugging') {
                        gamemodeMatch = cardGamemode === 'debugging';
                    }
                    
                    const difficultyMatch = selectedDifficulty === 'all' || 
                                          cardDifficulty === selectedDifficulty ||
                                          (isEndlessCard && selectedDifficulty === 'beginner');
                    
                    if (gamemodeMatch && difficultyMatch) {
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

                if (!gamemodeBtn || !difficultyBtn || !gamemodeMenu || !difficultyMenu) {
                    console.error('Dropdown elements not found');
                    return;
                }

                // Add click handlers to buttons
                gamemodeBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    toggleMenu(gamemodeMenu, difficultyMenu);
                });

                difficultyBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    if (gamemodeFilter.value !== 'endless') {
                        toggleMenu(difficultyMenu, gamemodeMenu);
                    }
                });

                // Show/hide gamemode dropdown on hover (optional)
                gamemodeBtn.addEventListener('mouseenter', () => showMenu(gamemodeMenu, difficultyMenu));
                gamemodeMenu.addEventListener('mouseenter', () => showMenu(gamemodeMenu, difficultyMenu));
                
                // Show/hide difficulty dropdown on hover (optional)
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
                    option.addEventListener('click', (e) => {
                        e.stopPropagation();
                        selectOption(option, gamemodeMenu, gamemodeBtn, true);
                    });
                });

                difficultyOptions.forEach(option => {
                    option.addEventListener('click', (e) => {
                        e.stopPropagation();
                        selectOption(option, difficultyMenu, difficultyBtn, false);
                    });
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
                
                // Initialize difficulty options based on current gamemode
                updateDifficultyOptions();
            }

            function toggleMenu(menuToShow, menuToHide) {
                if (menuToShow.style.display === 'block') {
                    hideMenu(menuToShow);
                } else {
                    showMenu(menuToShow, menuToHide);
                }
            }

            function showMenu(menuToShow, menuToHide) {
                clearTimeout(hoverTimeout);
                hideMenu(menuToHide);
                if (menuToShow) {
                    menuToShow.style.display = 'block';
                    menuToShow.style.opacity = '0';
                    menuToShow.style.animation = 'dropdownPopout 0.2s ease-out forwards';
                    setTimeout(() => {
                        menuToShow.style.opacity = '1';
                    }, 10);
                }
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

            function updateDifficultyOptions() {
                const difficultyOptions = document.querySelectorAll('#difficulty-filter-menu .filter-option');
                const selectedGamemode = gamemodeFilter ? gamemodeFilter.value : 'all';
                
                if (selectedGamemode === 'debugging') {
                    // Show only "beginner" option (hide "all", "intermediate", "advanced")
                    difficultyOptions.forEach(opt => {
                        const optValue = opt.getAttribute('data-value');
                        if (optValue === 'beginner') {
                            opt.style.display = 'block';
                        } else {
                            opt.style.display = 'none';
                        }
                    });
                    
                    // Force difficulty to beginner
                    if (difficultyFilter) {
                        difficultyFilter.value = 'beginner';
                    }
                    const beginnerOption = document.querySelector('#difficulty-filter-menu [data-value="beginner"]');
                    const difficultySelected = document.getElementById('difficulty-selected');
                    if (beginnerOption && difficultySelected) {
                        difficultySelected.textContent = 'BEGINNER';
                        
                        // Update difficulty options style
                        difficultyOptions.forEach(opt => {
                            opt.style.background = 'transparent';
                            opt.style.borderLeftColor = 'transparent';
                            opt.style.color = 'var(--primary)';
                        });
                        beginnerOption.style.background = 'rgba(0, 150, 200, 0.3)';
                        beginnerOption.style.borderLeftColor = 'var(--accent)';
                        beginnerOption.style.color = 'var(--accent)';
                    }
                } else {
                    // Show all difficulty options
                    difficultyOptions.forEach(opt => {
                        opt.style.display = 'block';
                    });
                }
            }

            function selectOption(option, menu, btn, isGamemode) {
                const value = option.getAttribute('data-value');
                const input = isGamemode ? gamemodeFilter : difficultyFilter;
                if (input) {
                    input.value = value;
                }
                
                // Update the button text - use the correct selector
                if (btn) {
                    const selectedSpan = isGamemode ? 
                        document.getElementById('gamemode-selected') : 
                        document.getElementById('difficulty-selected');
                    
                    if (selectedSpan) {
                        selectedSpan.textContent = option.textContent.trim();
                    }
                }
                
                // Update active state in menu
                if (menu) {
                    menu.querySelectorAll('.filter-option').forEach(opt => {
                        opt.style.background = 'transparent';
                        opt.style.borderLeftColor = 'transparent';
                        opt.style.color = 'var(--primary)';
                    });
                    
                    option.style.background = 'rgba(0, 150, 200, 0.3)';
                    option.style.borderLeftColor = 'var(--accent)';
                    option.style.color = 'var(--accent)';
                }
                
                // Close the menu
                hideMenu(menu);

                // Handle special cases
                if (isGamemode) {
                    if (value === 'endless') {
                        if (difficultyFilter) {
                            difficultyFilter.value = 'all';
                        }
                        const allOption = document.querySelector('#difficulty-filter-menu [data-value="all"]');
                        const difficultySelected = document.getElementById('difficulty-selected');
                        if (allOption && difficultySelected) {
                            difficultySelected.textContent = 'ALL LEVELS';
                            
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
                    } else if (value === 'debugging') {
                        // Update difficulty options to show only beginner
                        updateDifficultyOptions();
                    } else {
                        // Show all difficulty options for other gamemodes
                        updateDifficultyOptions();
                    }
                }

                // Update filters
                updateTaskFilters();
            }

            // =============================================
            // Profile Dropdown Functionality
            // =============================================
            function initProfileDropdown() {
                const profileDropdown = document.querySelector('.taskbar-right .dropdown');
                if (!profileDropdown) return;
                
                const dropbtn = profileDropdown.querySelector('.dropbtn');
                const dropdownContent = profileDropdown.querySelector('.dropdown-content');
                
                if (!dropbtn || !dropdownContent) return;
                
                let isClickMode = false;
                let hoverTimeout = null;
                
                // Toggle dropdown on button click
                dropbtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    isClickMode = true;
                    const isOpen = dropdownContent.style.display === 'block';
                    
                    // Close all dropdowns first
                    document.querySelectorAll('.dropdown-content').forEach(dropdown => {
                        if (dropdown !== dropdownContent && dropdown.style.display === 'block') {
                            dropdown.style.display = 'none';
                        }
                    });
                    
                    // Toggle this dropdown
                    if (isOpen) {
                        dropdownContent.style.display = 'none';
                        isClickMode = false;
                    } else {
                        dropdownContent.style.display = 'block';
                        dropdownContent.style.animation = 'dropdownFadeIn 0.25s cubic-bezier(0.4, 0, 0.2, 1)';
                    }
                });
                
                // Handle hover (only if not in click mode)
                profileDropdown.addEventListener('mouseenter', function() {
                    if (!isClickMode) {
                        clearTimeout(hoverTimeout);
                        dropdownContent.style.display = 'block';
                        dropdownContent.style.animation = 'dropdownFadeIn 0.25s cubic-bezier(0.4, 0, 0.2, 1)';
                    }
                });
                
                profileDropdown.addEventListener('mouseleave', function() {
                    if (!isClickMode) {
                        hoverTimeout = setTimeout(function() {
                            dropdownContent.style.display = 'none';
                        }, 200);
                    }
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!profileDropdown.contains(e.target)) {
                        dropdownContent.style.display = 'none';
                        isClickMode = false;
                    }
                });
            }
            
            // Initialize profile dropdown
            initProfileDropdown();

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
            `;
            document.head.appendChild(style);
        }); // End of DOMContentLoaded
    </script>
</body>
</html>

