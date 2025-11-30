<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizzardCode</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
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
            margin: 2rem auto;
            padding: 2rem;
            background: var(--screen);
            border: 4px solid var(--primary);
            transform-style: preserve-3d;
            box-shadow: 
                20px 20px 0 rgba(255, 0, 255, 0.2),
                40px 40px 0 rgba(0, 255, 255, 0.1);
        }

        .screen::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                linear-gradient(
                    to bottom,
                    rgba(255, 0, 255, 0.1) 0%,
                    transparent 50%,
                    rgba(0, 255, 255, 0.1) 100%
                );
            pointer-events: none;
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

        .primary-btn {
            background: var(--accent);
            color: #000;
            border-color: var(--accent);
        }

        .secondary-btn {
            background: transparent;
            color: var(--secondary);
            border-color: var(--secondary);
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            margin: 1rem 0;
        }

        .nav-links a {
            color: var(--secondary);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border: 2px solid var(--secondary);
            transition: all 0.3s;
        }

        .nav-links a:hover {
            background: var(--secondary);
            color: #000;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .logo img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .logo a {
            color: var(--accent);
            font-size: 1.5rem;
            text-decoration: none;
            text-shadow: 
                2px 2px 0 var(--primary),
                4px 4px 0 var(--secondary);
        }

        .card {
            background: rgba(0, 0, 0, 0.5);
            border: 2px solid var(--secondary);
            padding: 1.5rem;
            margin: 1rem 0;
            transition: all 0.3s;
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

        .container4, .container5, .container6, .container7 {
            display: inline-block;
            width: 48%;
            margin: 1%;
            vertical-align: top;
        }

        @media (max-width: 768px) {
            .container4, .container5, .container6, .container7 {
                width: 100%;
                margin: 0.5rem 0;
            }
            
            .nav-links {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
</head>

<body class="crt">
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
            <span style="
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(
                    90deg,
                    transparent,
                    rgba(0, 255, 255, 0.2),
                    transparent
                );
                transition: 0.5s;
            "></span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="scanlines" style="pointer-events: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.25) 50%), linear-gradient(90deg, rgba(255, 0, 0, 0.06), rgba(0, 255, 0, 0.02), rgba(0, 0, 255, 0.06)); z-index: 1000; pointer-events: none; background-size: 100% 2px, 3px 100%;"></div>
    <div style="margin-top: 85px;">
    <div class="screen">
        <!-- Header -->
        <div style="margin-top: 1.5rem;">
            <!-- Logo has been moved to the taskbar -->
        </div>

        <!-- Navigation has been moved to the taskbar -->

        <!-- Hero Section -->
        <div style="text-align: center; margin: 3rem 0;">
            <h1>Welcome to Quizzard Code</h1>
            <h2>Master Python Through Interactive Challenges</h2>
            <p style="color: var(--secondary); margin: 1.5rem 0;">Learn Python, debug code, and climb the leaderboard with our interactive quiz platform.</p>
            <button class="btn primary-btn" onclick="window.location.href='login.html'">🚀 Start Learning Python Now!</button>
        </div>

        <!-- How It Works -->
        <div class="card" style="margin: 3rem 0; padding: 2rem;">
            <h2 style="text-align: center; margin-bottom: 2rem;">Master Python the Fun Way</h2>
            <p style="text-align: center; color: var(--secondary); margin-bottom: 2rem;">Learn Python concepts, test your skills with quizzes, and improve through debugging challenges</p>
            
            <div style="display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center; margin-top: 2rem;">
                <div class="card" style="flex: 1; min-width: 250px; text-align: center;">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;">🐍</div>
                    <h3>Learn Python</h3>
                    <p style="color: var(--secondary); margin-top: 1rem;">Master Python programming through hands-on exercises and real-world examples.</p>
                </div>
                
                <div class="card" style="flex: 1; min-width: 250px; text-align: center;">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;">🔍</div>
                    <h3>Debug Challenges</h3>
                    <p style="color: var(--secondary); margin-top: 1rem;">Sharpen your debugging skills by fixing broken Python code and learning from mistakes.</p>
                </div>
                
                <div class="card" style="flex: 1; min-width: 250px; text-align: center;">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;">🏆</div>
                    <h3>Compete & Learn</h3>
                    <p style="color: var(--secondary); margin-top: 1rem;">Earn points, unlock achievements, and see how you rank against other Python learners.</p>
                </div>
            </div>
        </div>

    </div>
    </div>
    
    <style>
    </style>
    
    <script>
        // Update current time in the taskbar
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', { 
                hour12: false,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.getElementById('current-time').textContent = timeString;
        }
        
        // Update time every second
        updateTime();
        setInterval(updateTime, 1000);
        
        // Enhanced button hover effects
        document.querySelectorAll('.taskbar-btn').forEach(btn => {
            const glow = btn.querySelector('span:last-child');
            
            // Mouse enter effect
            btn.addEventListener('mouseenter', () => {
                // Add glow and lift effect
                btn.style.transform = 'translateY(-3px)';
                btn.style.boxShadow = `0 5px 15px ${getButtonGlowColor(btn)}`;
                
                // Start the shine animation
                glow.style.left = '100%';
                
                // Add pulse effect to the button
                btn.style.animation = 'pulse 1s infinite';
            });
            
            // Mouse leave effect
            btn.addEventListener('mouseleave', () => {
                // Reset styles
                btn.style.transform = 'translateY(0)';
                btn.style.boxShadow = '';
                glow.style.left = '-100%';
                btn.style.animation = '';
            });
            
            // Click effect
            btn.addEventListener('mousedown', () => {
                btn.style.transform = 'translateY(1px)';
                btn.style.boxShadow = 'none';
            });
            
            // Add keyboard focus effect
            btn.addEventListener('focus', () => {
                btn.style.boxShadow = `0 0 0 3px ${getButtonGlowColor(btn, 0.5)}`;
            });
            
            btn.addEventListener('blur', () => {
                btn.style.boxShadow = '';
            });
        });
        
        // Helper function to get button glow color based on button type
        function getButtonGlowColor(btn, opacity = 0.7) {
            if (btn.querySelector('a[href*="login"]')) {
                return `rgba(255, 255, 0, ${opacity})`; // Yellow for login
            } else if (btn.querySelector('a[href*="leaderboard"]')) {
                return `rgba(0, 255, 255, ${opacity})`; // Cyan for leaderboard
            } else {
                return `rgba(255, 0, 255, ${opacity})`; // Magenta for tasks
            }
        }
        
        // Add keyframe animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes pulse {
                0% { transform: translateY(-3px); box-shadow: 0 5px 15px var(--glow-color, rgba(255, 0, 255, 0.5)); }
                50% { transform: translateY(-5px); box-shadow: 0 8px 20px var(--glow-color, rgba(255, 0, 255, 0.7)); }
                100% { transform: translateY(-3px); box-shadow: 0 5px 15px var(--glow-color, rgba(255, 0, 255, 0.5)); }
            }
            
            .taskbar-btn {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .taskbar-btn:active {
                transform: translateY(1px) !important;
                box-shadow: none !important;
            }
        `;
        document.head.appendChild(style);
        // Add glitch effect to title
        const title = document.querySelector('h1');
        if (title) {
            title.addEventListener('mouseover', () => {
                title.style.animation = 'glitch 0.3s infinite';
                setTimeout(() => {
                    title.style.animation = '';
                }, 1000);
            });
        }

        // Add pixelated hover effect to buttons
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('mouseover', () => {
                button.style.transform = 'translate(-2px, -2px)';
                button.style.boxShadow = '6px 6px 0 var(--secondary), 12px 12px 0 var(--accent)';
            });
            
            button.addEventListener('mouseout', () => {
                button.style.transform = '';
                button.style.boxShadow = '4px 4px 0 var(--secondary), 8px 8px 0 var(--accent)';
            });
            
            button.addEventListener('mousedown', () => {
                button.style.transform = 'translate(4px, 4px)';
                button.style.boxShadow = 'none';
            });
            
            button.addEventListener('mouseup', () => {
                button.style.transform = 'translate(-2px, -2px)';
                button.style.boxShadow = '6px 6px 0 var(--secondary), 12px 12px 0 var(--accent)';
            });
        });

        // Add scanline animation
        document.addEventListener('DOMContentLoaded', () => {
            const scanline = document.createElement('div');
            scanline.className = 'scanline';
            document.body.appendChild(scanline);
            
            // Add keyframe animation for glitch effect
            const style = document.createElement('style');
            style.textContent = `
                @keyframes glitch {
                    0% { text-shadow: 3px 3px 0 var(--primary), 6px 6px 0 var(--secondary); }
                    25% { text-shadow: -3px 3px 0 var(--primary), -6px 6px 0 var(--secondary); }
                    50% { text-shadow: 3px -3px 0 var(--primary), 6px -6px 0 var(--secondary); }
                    75% { text-shadow: -3px -3px 0 var(--primary), -6px -6px 0 var(--secondary); }
                    100% { text-shadow: 3px 3px 0 var(--primary), 6px 6px 0 var(--secondary); }
                }
                
                .crt::before {
                    content: " ";
                    display: block;
                    position: fixed;
                    top: 0;
                    left: 0;
                    bottom: 0;
                    right: 0;
                    background: rgba(18, 16, 16, 0.1);
                    opacity: 0.3;
                    z-index: 1000;
                    pointer-events: none;
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>

