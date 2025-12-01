<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Server Status Dashboard</title>
    <style>
        body { font-family: 'Courier New', monospace; background-color: #1a1a1a; color: #00ff00; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { background-color: #2b2b2b; padding: 40px; border-radius: 10px; box-shadow: 0 0 20px rgba(0, 255, 0, 0.2); border: 1px solid #00ff00; }
        h1 { margin-top: 0; text-align: center; border-bottom: 1px solid #00ff00; padding-bottom: 10px; }
        .stat { margin: 15px 0; font-size: 1.2em; }
        .label { font-weight: bold; color: #ffffff; }
    </style>
</head>
<body>
    <div class="container">
        <h1>SYSTEM OPERATIONAL</h1>
        
        <div class="stat">
            <span class="label">HOSTNAME:</span> 
            <?php echo gethostname(); ?>
        </div>

        <div class="stat">
            <span class="label">SERVER IP:</span> 
            <?php echo $_SERVER['SERVER_ADDR'] ?? $_SERVER['LOCAL_ADDR'] ?? '127.0.0.1'; ?>
        </div>

        <div class="stat">
            <span class="label">CURRENT DATE:</span> 
            <?php echo date("Y-m-d H:i:s"); ?>
        </div>

        <div class="stat">
            <span class="label">UPTIME:</span> 
            <?php 
                // This executes a Linux command and shows the output
                $uptime = shell_exec('uptime -p'); 
                echo $uptime ? $uptime : "Unavailable (shell_exec disabled)";
            ?>
        </div>
        
        <div class="stat">
            <span class="label">STATUS:</span> 
            <span style="color: #00ff00;">ONLINE</span>
        </div>
    </div>
</body>
</html>