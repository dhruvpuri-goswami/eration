<?php
  if(isset($_GET["receipt_id"]) && isset($_GET["rationcard"])){
    $r_id = $_GET["receipt_id"];
    $ration_num = $_GET["rationcard"];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Verification Code</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <header class="text-gray-600 p-3 body-font border-y-2">
        <div class="container mx-auto">
          <div class="flex items-center justify-center">
            <img src="../images/logo landingpage.png" alt="" width="150px">
            <sub class="mt-1">
              <img src="../images/black-quote.jpg" alt="" width="120px">
            </sub>
          </div>
        </div>
      </header>

      <section class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
          <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Here is Your Verification Code.
            </h1>
            <p class="mb-8 leading-relaxed">Scan by nearest your ration store to purchase anything using APL Card.</p>
            <div class="flex w-550 justify-between">
              <button class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Send Mail</button>
              <button class="inline-flex text-white bg-indigo-100 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Download</button>
              
            </div>
          </div>
          <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
            <img class="object-cover object-center rounded" alt="hero" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo$r_id ."_".$ration_num ?>" width="400px">
          </div>
        </div>
      </section>
</body>
</html>