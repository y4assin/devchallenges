<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yassine El Bakali Nessad - Terminal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #1E1E1E;
            color: #00FF00;
            font-family: 'Menlo', 'Monaco', monospace;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .terminal-window {
            background-color: #2D2D2D;
            width: 800px;
            border-radius: 6px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
            overflow: hidden;
        }
        .terminal-header {
            background-color: #3C3C3C;
            padding: 10px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #4A4A4A;
        }
        .window-buttons {
            display: flex;
            gap: 8px;
            margin-right: 15px;
        }
        .window-button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }
        .close { background-color: #FF5F56; }
        .minimize { background-color: #FFBD2E; }
        .maximize { background-color: #27C93F; }
        .terminal-title {
            color: #FFFFFF;
            margin-left: 10px;
            font-size: 14px;
        }
        .terminal-body {
            padding: 20px;
            height: 500px;
            overflow-y: auto;
        }
        .prompt {
            color: #00FF00;
            margin-bottom: 0px;
        }
        .response {
            color: #FFFFFF;
            margin-bottom: 15px;
            padding-left: 20px;
        }
        .cursor {
            animation: blink 1s infinite;
        }
        @keyframes blink {
            0% { opacity: 0; }
            50% { opacity: 1; }
            100% { opacity: 0; }
        }
        .command-buttons {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .terminal-btn {
            background-color: #4A4A4A;
            color: #00FF00;
            border: 1px solid #00FF00;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
            width: fit-content;
        }
        .terminal-btn:hover {
            background-color: #00FF00;
            color: #2D2D2D;
            text-decoration: none;
        }
        .profile-section {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid #00FF00;
            object-fit: cover;
        }
        .social-links {
            margin-top: 15px;
            display: flex;
            gap: 15px;
        }
        .social-links a {
            color: #00FF00;
            text-decoration: none;
            font-size: 1.2em;
        }
        .social-links a:hover {
            color: #FFFFFF;
        }
    </style>
</head>
<body>
    <div class="terminal-window">
        <div class="terminal-header">
            <div class="window-buttons">
                <div class="window-button close"></div>
                <div class="window-button minimize"></div>
                <div class="window-button maximize"></div>
            </div>
            <div class="terminal-title">yassine@macbook-pro ~ </div>
        </div>
        <div class="terminal-body">
            <div class="profile-section">
                <img src="{{ asset('images/yassine_portatil.png') }}" alt="Yassine El Bakali Nessad" class="profile-img">
                <div>
                    <div class="prompt">$ whoami</div>
                    <div class="response">Yassine El Bakali Nessad</div>
                    <div class="prompt">$ cat bio.txt</div>
                    <div class="response">🚀 Web Developer & Entrepreneur | Building digital solutions</div>
                </div>
            </div>
            
            <div class="prompt">$ ls social-links/</div>
            <div class="social-links response">
                <a href="mailto:yassineelbakali30@gmail.com" title="Email"><i class="fas fa-envelope"></i></a>
                <a href="https://github.com/y4assin" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
                <a href="https://www.linkedin.com/in/yassine-el-bakali-nessad/" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
            </div>

            <div class="prompt">$ ls projects/</div>
            <div class="command-buttons response">
                <a href="https://portfolio.yassineelbakali.com/" target="_blank" class="terminal-btn">🚀 Explore My Work</a>
                <a href="https://devchallenge.yassineelbakali.com/login" target="_blank" class="terminal-btn">🏆 Code DevChallenges</a>
                <a href="https://joc.yassineelbakali.com/" target="_blank" class="terminal-btn">🃏 Card Game</a>
            </div>

            <div class="prompt">
                yassine@macbook-pro:~$ <span class="cursor">█</span>
            </div>
        </div>
    </div>
</body>
</html>