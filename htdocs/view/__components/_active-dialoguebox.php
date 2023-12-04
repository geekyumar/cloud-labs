<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
            }
            to {
                transform: translateY(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }

        .dialog-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            opacity: 0;
            animation: fadeIn 0.2s ease-in-out;
            z-index: 2000; /* Set a higher z-index value */
        }

        .dialog-box {
            max-width: 400px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            transform: translateY(-20px);
            animation: slideIn 0.3s ease-in-out;
            z-index: 2000; /* Set a higher z-index value */
        }

        .dialog-overlay.active {
            display: flex;
            opacity: 1;
        }

        .dialog-box.active {
            transform: translateY(0);
        }

        .dialog-header {
            padding: 16px;
            background-color: #6f42c1;
            color: #fff;
            text-align: center;
            font-size: 1.2em;
            font-weight: bold;
            border-bottom: 2px solid #492a73;
        }

        .dialog-content {
            padding: 20px;
            line-height: 1.4;
        }

        .dialog-buttons {
            display: flex;
            justify-content: flex-end;
            padding: 10px;
        }

        .dialog-buttons button {
            margin-left: 10px;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .dialog-buttons button.primary {
            background-color: #6f42c1;
            color: #fff;
        }

        .dialog-buttons button.secondary {
            background-color: #6f42c1;
            color: #fff;
            opacity: 0.8;
        }

        .dialog-box.fadeOut {
            animation: fadeOut 0.5s ease-in-out;
        }
    </style>


<div class="dialog-overlay" id="dialogOverlay">
    <div class="dialog-box">
        <div class="dialog-header">
            VPN is Active!
        </div>
        <div class="dialog-content">
            <p>The VPN status is active. Now you can connect your devices and server instances.</p>
        </div>
        <div class="dialog-buttons">
            <button class="primary" onclick="closeInfoDialog()">OK</button>
        </div>
    </div>
</div>