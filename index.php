<?php
// Always call session_start() at the top of the file
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>AI Authenticity Check</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="index.css"/>
</head>
<body class="m-0 p-0 bg-[#d6ebed]">

  <!-- HEADER with scanning line -->
  <header class="relative overflow-hidden bg-gradient-to-b from-[#04152e] to-[#4a6a82] h-[500px]">

    <!-- scanning line only inside header -->
    <div class="scan-line"></div>

    <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center relative z-10">
      <h1 class="text-white font-bold text-xl">🔐 AI Authenticity</h1>
      <div class="text-white text-sm font-normal flex items-center space-x-1">
        <span class="font-semibold">Secure</span>
        <span>QR Based</span>
        <i class="fas fa-qrcode text-green-400"></i>
        <span>Verification</span>
      </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 pb-16 flex flex-col md:flex-row md:items-center md:justify-between relative z-10">
      <!-- Left Card -->
      <div class="bg-[#f9fafb] rounded-xl shadow-lg p-6 w-full max-w-sm md:max-w-xs mb-10 md:mb-0">
        <h2 class="font-semibold text-lg mb-2 text-[#111827]">Quick Access</h2>

        <div class="flex items-center space-x-2 mb-4">
          <span class="text-xs font-semibold bg-[#c7d2fe] text-[#4338ca] rounded px-2 py-0.5 flex items-center">
            <i class="fas fa-shield-alt mr-1"></i>
            AI Powered
          </span><br><br>
          <span class="text-xs font-semibold bg-[#ccfbf1] text-[#0f766e] rounded px-2 py-0.5 flex items-center">
            <i class="fas fa-check-circle mr-1"></i>
            Verified System
          </span><br><br>
        </div>

        <div class="flex flex-col space-y-3">
          <a href="login.html" class="w-full bg-[#111827] text-white text-sm font-semibold py-2 rounded text-center">
            Login
          </a>
          <a href="reg.html" class="w-full bg-[#2a73ff] text-white text-sm font-semibold py-2 rounded text-center">
            Register
          </a>
        </div>
      </div>

      <!-- Right Hero -->
      <div class="text-white max-w-3xl">
        <h1 class="text-4xl font-extrabold mb-2">AI-Based Authenticity Check</h1>
        <p class="font-semibold text-lg">
          Verify your products instantly with QR scanning powered by AI.
        </p>
      </div>
    </div>
  </header>

  <!-- FEATURES -->
  <section class="bg-[#d6ebed] max-w-7xl mx-auto px-6 py-10 flex flex-col sm:flex-row justify-around text-center">
    <div class="mb-8 sm:mb-0 max-w-[160px]">
      <i class="fas fa-qrcode text-2xl mb-3"></i>
      <p class="font-semibold leading-tight">
        Scan & Verify<br/>Product Authenticity
      </p>
    </div>
    <div class="mb-8 sm:mb-0 max-w-[160px]">
      <i class="fas fa-brain text-2xl mb-3"></i>
      <p class="font-semibold leading-tight">
        AI Analysis<br/>in Real-Time
      </p>
    </div>
    <div class="max-w-[160px]">
      <i class="fas fa-headset text-2xl mb-3"></i>
      <p class="font-semibold leading-tight">
        24/7 Support<br/>for Businesses
      </p>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="bg-gradient-to-b from-[#a1b9bf] to-[#d6ebed] py-6 text-center text-xs text-[#111827]">
    © 2025 AI Authenticity System. All Rights Reserved.
  </footer>

</body>
</html>
