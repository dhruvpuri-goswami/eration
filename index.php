<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <!-- hero - start -->
  <div class="bg-white pb-6 sm:pb-8 lg:pb-12">
    <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <header class="mb-4 flex items-center justify-between py-4 md:py-5">
        <!-- logo - start -->
        <!-- <a href="/" class="text-black-800 inline-flex items-center gap-2.5 text-2xl font-bold md:text-3xl"
          aria-label="logo">
          <span class="text-xl font-semibold text-Slate-950">E-</span><span
            class="text-xl font-semibold text-indigo-500">Ration</span>
        </a> -->
        <div class="flex items-center">
          <img src="./images/logo landingpage.png" alt="" width="150px">
          <sub class="mt-1">
            <img src="./images/black-quote.jpg" alt="" width="120px">
          </sub>
        </div>
        <!-- logo - end -->

        <!-- nav - start -->
        <nav class="hidden gap-12 lg:flex">
          <a href="#" class="text-lg font-semibold text-indigo-500">Home</a>
          <a href="#servicessSection"
            class="text-lg font-semibold text-gray-600 transition duration-100 hover:text-indigo-500 active:text-indigo-700">Services</a>
          <a href="#aboutusSection"
            class="text-lg font-semibold text-gray-600 transition duration-100 hover:text-indigo-500 active:text-indigo-700">About
            Us</a>
          <a href="#contactusSection"
            class="text-lg font-semibold text-gray-600 transition duration-100 hover:text-indigo-500 active:text-indigo-700">Contact
            Us</a>
        </nav>
        <!-- nav - end -->

        <!-- buttons - start -->
        <a href="./Auth/login.php"
          class="hidden rounded-lg bg-gray-100 px-8 py-3 text-center text-sm font-semibold text-gray-500 outline-none ring-indigo-300 transition duration-100 hover:bg-gray-300 focus-visible:ring active:text-gray-700 md:text-base lg:inline-block">Let's
          Start</a>

        <button type="button"
          class="inline-flex items-center gap-2 rounded-lg bg-gray-200 px-2.5 py-2 text-sm font-semibold text-gray-500 ring-indigo-300 hover:bg-gray-300 focus-visible:ring active:text-gray-700 md:text-base lg:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
              clip-rule="evenodd" />
          </svg>

          Menu
        </button>
        <!-- buttons - end -->
      </header>

      <section
        class="min-h-100 relative flex flex-1 shrink-0 items-center justify-center overflow-hidden rounded-lg bg-gray-100 py-16 shadow-lg md:py-20 xl:py-35">
        <!-- image - start -->
        <img src="./images/7062167_888.jpg" loading="lazy" alt="Photo by Fakurian Design"
          class="absolute inset-0 opacity-50 h-full w-full object-cover object-center" />
        <!-- image - end -->

        <!-- overlay - start -->
        <div class="absolute inset-0 bg-Gray-700 mix-blend-multiply"></div>
        <!-- overlay - end -->

        <!-- text start -->
        <div class="relative flex flex-col items-center p-6 px-12 w-max sm:max-w-xl backdrop-blur-sm drop-shadow-2xl rounded-3xl">
          <p class="mb-4 text-center text-lg text-Zinc-950 sm:text-2xl md:mb-8">Revolutionary E-Ration Digital Platform
            solution.</p>
          <h1 class="mb-8 text-center text-4xl font-bold text-black-10 sm:text-5xl md:mb-8 md:text-4xl ">Now, Access ration card at your Fingle tips !</h1>

          <div class="flex w-full flex-col gap-2.5 sm:flex-row sm:justify-center">
            <a href="./Auth/signup.php"
              class="inline-block rounded-lg bg-indigo-500 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-indigo-300 transition duration-100 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base">Start
              now</a>

            <a href="#servicessSection"
              class="inline-block rounded-lg bg-white px-8 py-3 text-center text-sm font-semibold text-gray-500 outline-none ring-indigo-300 transition duration-100 hover:bg-gray-100 focus-visible:ring active:text-gray-200 md:text-base">View
              Features</a>
          </div>
        </div>
        <!-- text end -->
      </section>
    </div>
  </div>
  <!-- hero - end -->

  <!-- gallery - start -->
  <div id="servicessSection" class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-15 lg:text-3xl xl:mb-12">E-Ration Key Features
      </h2>

      <div class="mb-4 grid grid-cols-2 gap-4 sm:grid-cols-3 md:mb-8 md:grid-cols-4 md:gap-6 xl:gap-8">
        <!-- image - start -->
        <a href="#" class="group relative flex h-48 items-end overflow-hidden rounded-lg  md:h-80">
          <img src="./images/responsive.png" loading="lazy" alt="Photo by Minh Pham"
            class="absolute inset-0 h-full w-full object-cover object-center transition duration-200" />

          <div
            class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
          </div>

          <span class="relative ml-4 mb-3 inline-block text-sm text-white md:ml-5 md:text-lg">Responsive</span>
        </a>
        <!-- image - end -->

        <!-- image - start -->
        <a href="#" class="group relative flex h-48 items-end overflow-hidden rounded-lg  md:h-80">
          <img src="./images/secure.png" loading="lazy" alt="Photo by Magicle"
            class="absolute inset-0 h-full w-full object-cover object-center transition duration-200" />

          <div
            class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
          </div>

          <span class="relative ml-4 mb-3 inline-block text-sm text-white md:ml-5 md:text-lg">Secure</span>
        </a>
        <!-- image - end -->

        <!-- image - start -->
        <a href="#" class="group relative flex h-48 items-end overflow-hidden rounded-lg  md:h-80">
          <img src="./images/feedback.png" loading="lazy" alt="Photo by Martin Sanchez"
            class="absolute inset-0 h-full w-full object-cover object-center transition duration-200"/>

          <div
            class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
          </div>

          <span class="relative ml-4 mb-3 inline-block text-sm text-white md:ml-5 md:text-lg">Feedback</span>
        </a>
        <!-- image - end -->

        <!-- image - start -->
        <a href="#" class="group relative flex h-48 items-end overflow-hidden rounded-lg  md:h-80">
          <img src="./images/multimodepayment.png" loading="lazy" alt="Photo by Lorenzo Herrera"
            class="absolute inset-0 h-full w-full object-cover object-center transition duration-200" />

          <div
            class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
          </div>

          <span class="relative ml-4 mb-3 inline-block text-sm text-white md:ml-5 md:text-lg">Multi-Mode Payment</span>
        </a>
        <!-- image - end -->
      </div>
    </div>
  </div>
  <!-- gallery - end -->

  <!-- stats - start -->
  <!-- <div class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="mx-auto max-w-screen-lg px-4 md:px-8">
      <div class="mb-8 md:mb-12">
        <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">Our Team by the numbers</h2>

        <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">This is a section of some simple filler
          text, also known as placeholder text. It shares some characteristics of a real written text but is random or
          otherwise generated.</p>
      </div>

      <div class="grid grid-cols-2 gap-6 rounded-lg bg-indigo-500 p-6 md:grid-cols-4 md:gap-8 md:p-8">
        <div class="flex flex-col items-center">
          <div class="text-xl font-bold text-white sm:text-2xl md:text-3xl">10+</div>
          <div class="text-sm text-indigo-200 sm:text-base">Languages</div>
        </div>

        <div class="flex flex-col items-center">
          <div class="text-xl font-bold text-white sm:text-2xl md:text-3xl">500+</div>
          <div class="text-sm text-indigo-200 sm:text-base">People</div>
        </div>

        <div class="flex flex-col items-center">
          <div class="text-xl font-bold text-white sm:text-2xl md:text-3xl">1000+</div>
          <div class="text-sm text-indigo-200 sm:text-base">Customers</div>
        </div>

        <div class="flex flex-col items-center">
          <div class="text-xl font-bold text-white sm:text-2xl md:text-3xl">A couple</div>
          <div class="text-sm text-indigo-200 sm:text-base">Coffee breaks</div>
        </div>
      </div>
    </div>
  </div> -->
  <!-- stats - end -->


  <!-- call to action - start -->
  <div id="aboutusSection" class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <div class="flex flex-col overflow-hidden rounded-lg bg-gray-200 sm:flex-row md:h-80">
        <!-- image - start -->
        <div class="order-first h-48 w-full bg-gray-300 sm:order-none sm:h-auto sm:w-1/2 lg:w-2/5">
          <img src="./images/aboutus.png" loading="lazy" alt="Photo by Andras Vas"
            class="w-full object-cover object-center" />
        </div>
        <!-- image - end -->

        <!-- content - start -->
        <div class="flex w-full flex-col p-4 sm:w-1/2 sm:p-8 lg:w-3/5">
          <h2 class="mb-4 text-xl font-bold text-gray-800 md:text-2xl lg:text-4xl">About Us</h2>

          <p class="mb-8 max-w-md text-gray-600">Take control of your monthly food supply with just a single click. Our
            platform streamlines the process of managing your ration, making it easy to access and customize your orders
            according to your needs.</p>

          <div class="mt-auto">
            <a href="#contactusSection"
              class="inline-block rounded-lg bg-white px-8 py-3 text-center text-sm font-semibold text-gray-800 outline-none ring-indigo-300 transition duration-100 hover:bg-gray-100 focus-visible:ring active:bg-gray-200 md:text-base">Contact
              support</a>
          </div>
        </div>
        <!-- content - end -->
      </div>
    </div>
  </div>
  <!-- call to action - end -->


  <!-- ====== Contact Section Start -->
  <section id="contactusSection" class="relative z-10 overflow-hidden bg-white px-20 py-40">
    <div class="container mx-auto">
      <div class="-mx-4 flex flex-wrap lg:justify-between">
        <div class="w-full px-4 lg:w-1/2 xl:w-6/12">
          <div class="mb-12 max-w-[570px] lg:mb-0">
            <span class="text-primary mb-4 block text-base text-4xl font-semibold">
              Contact Us
            </span>
            <h2 class="text-dark mb-6 text-[32px] font-bold uppercase sm:text-[40px] lg:text-[36px] xl:text-[40px]">
              GET IN TOUCH WITH US
            </h2>
            <p class="text-body-color mb-9 text-base leading-relaxed">
              E-Ration Platform is the process of managing your ration, making it easy to access and customize your
              orders according to your needs.
              It also makes the process more transparent and fleasible to people and government itself.
            </p>
            <div class="mb-8 flex w-full max-w-[370px]">
              <div
                class="bg-primary text-primary mr-6 flex h-[60px] w-full max-w-[60px] items-center justify-center overflow-hidden rounded bg-opacity-5 sm:h-[70px] sm:max-w-[70px]">
                <svg width="24" height="26" viewBox="0 0 24 26" class="fill-current">
                  <path
                    d="M22.6149 15.1386C22.5307 14.1704 21.7308 13.4968 20.7626 13.4968H2.82869C1.86042 13.4968 1.10265 14.2125 0.97636 15.1386L0.092295 23.9793C0.0501967 24.4845 0.21859 25.0317 0.555377 25.4106C0.892163 25.7895 1.39734 26 1.94462 26H21.6887C22.1939 26 22.6991 25.7895 23.078 25.4106C23.4148 25.0317 23.5832 24.5266 23.5411 23.9793L22.6149 15.1386ZM21.9413 24.4424C21.8992 24.4845 21.815 24.5687 21.6466 24.5687H1.94462C1.81833 24.5687 1.69203 24.4845 1.64993 24.4424C1.60783 24.4003 1.52364 24.3161 1.56574 24.1477L2.4498 15.2649C2.4498 15.0544 2.61819 14.9281 2.82869 14.9281H20.8047C21.0152 14.9281 21.1415 15.0544 21.1835 15.2649L22.0676 24.1477C22.0255 24.274 21.9834 24.4003 21.9413 24.4424Z" />
                  <path
                    d="M11.7965 16.7805C10.1547 16.7805 8.84961 18.0855 8.84961 19.7273C8.84961 21.3692 10.1547 22.6742 11.7965 22.6742C13.4383 22.6742 14.7434 21.3692 14.7434 19.7273C14.7434 18.0855 13.4383 16.7805 11.7965 16.7805ZM11.7965 21.2008C10.9966 21.2008 10.3231 20.5272 10.3231 19.7273C10.3231 18.9275 10.9966 18.2539 11.7965 18.2539C12.5964 18.2539 13.2699 18.9275 13.2699 19.7273C13.2699 20.5272 12.5964 21.2008 11.7965 21.2008Z" />
                  <path
                    d="M1.10265 7.85562C1.18684 9.70794 2.82868 10.4657 3.67064 10.4657H6.61752C6.65962 10.4657 6.65962 10.4657 6.65962 10.4657C7.92257 10.3815 9.18552 9.53955 9.18552 7.85562V6.84526C10.5748 6.84526 13.7742 6.84526 15.1635 6.84526V7.85562C15.1635 9.53955 16.4264 10.3815 17.6894 10.4657H17.7315H20.6363C21.4782 10.4657 23.1201 9.70794 23.2043 7.85562C23.2043 7.72932 23.2043 7.26624 23.2043 6.84526C23.2043 6.50847 23.2043 6.21378 23.2043 6.17169C23.2043 6.12959 23.2043 6.08749 23.2043 6.08749C23.078 4.90874 22.657 3.94047 21.9413 3.18271L21.8992 3.14061C20.8468 2.17235 19.5838 1.62507 18.6155 1.28828C15.795 0.193726 12.2587 0.193726 12.0903 0.193726C9.6065 0.235824 8.00677 0.446315 5.60716 1.28828C4.681 1.58297 3.41805 2.13025 2.36559 3.09851L2.3235 3.14061C1.60782 3.89838 1.18684 4.86664 1.06055 6.04539C1.06055 6.08749 1.06055 6.12959 1.06055 6.12959C1.06055 6.21378 1.06055 6.46637 1.06055 6.80316C1.10265 7.18204 1.10265 7.68722 1.10265 7.85562ZM3.37595 4.15097C4.21792 3.3932 5.27038 2.93012 6.15444 2.59333C8.34355 1.79346 9.7749 1.62507 12.1745 1.58297C12.3429 1.58297 15.6266 1.62507 18.1525 2.59333C19.0365 2.93012 20.089 3.3511 20.931 4.15097C21.394 4.65615 21.6887 5.32972 21.7729 6.12959C21.7729 6.25588 21.7729 6.46637 21.7729 6.80316C21.7729 7.22414 21.7729 7.68722 21.7729 7.81352C21.7308 8.78178 20.8047 8.99227 20.6784 8.99227H17.7736C17.3526 8.95017 16.679 8.78178 16.679 7.85562V6.12959C16.679 5.7928 16.4685 5.54021 16.1738 5.41392C15.9213 5.32972 8.55405 5.32972 8.30146 5.41392C8.00677 5.49811 7.79628 5.7928 7.79628 6.12959V7.85562C7.79628 8.78178 7.1227 8.95017 6.70172 8.99227H3.79694C3.67064 8.99227 2.74448 8.78178 2.70238 7.81352C2.70238 7.68722 2.70238 7.22414 2.70238 6.80316C2.70238 6.46637 2.70238 6.29798 2.70238 6.17169C2.61818 5.32972 2.91287 4.65615 3.37595 4.15097Z" />
                </svg>
              </div>
              <div class="w-full">
                <h4 class="text-dark mb-1 text-xl font-bold">Ration Help Line Number</h4>
                <p class="text-body-color text-base">1967, 1800-233-5500 (Gujarat)</p>
              </div>
            </div>
            <div class="mb-8 flex w-full max-w-[370px]">
              <div
                class="bg-primary text-primary mr-6 flex h-[60px] w-full max-w-[60px] items-center justify-center overflow-hidden rounded bg-opacity-5 sm:h-[70px] sm:max-w-[70px]">
                <svg width="28" height="19" viewBox="0 0 28 19" class="fill-current">
                  <path
                    d="M25.3636 0H2.63636C1.18182 0 0 1.16785 0 2.6052V16.3948C0 17.8322 1.18182 19 2.63636 19H25.3636C26.8182 19 28 17.8322 28 16.3948V2.6052C28 1.16785 26.8182 0 25.3636 0ZM25.3636 1.5721C25.5909 1.5721 25.7727 1.61702 25.9545 1.75177L14.6364 8.53428C14.2273 8.75886 13.7727 8.75886 13.3636 8.53428L2.04545 1.75177C2.22727 1.66194 2.40909 1.5721 2.63636 1.5721H25.3636ZM25.3636 17.383H2.63636C2.09091 17.383 1.59091 16.9338 1.59091 16.3499V3.32388L12.5 9.8818C12.9545 10.1513 13.4545 10.2861 13.9545 10.2861C14.4545 10.2861 14.9545 10.1513 15.4091 9.8818L26.3182 3.32388V16.3499C26.4091 16.9338 25.9091 17.383 25.3636 17.383Z" />
                </svg>
              </div>
              <div class="w-full">
                <h4 class="text-dark mb-1 text-xl font-bold">Email Address</h4>
                <p class="text-body-color text-base">unifoders@gmail.com</p>
              </div>
            </div>

            <!-- social - start -->
            <div class="flex gap-8 pl-5">
              <a href="https://www.instagram.com/fooddeptgoi/" target="_blank"
                class="text-gray-400 transition duration-100 hover:text-gray-500 active:text-gray-600">
                <svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                </svg>
              </a>

              <a href="https://twitter.com/fooddeptgoi" target="_blank"
                class="text-gray-400 transition duration-100 hover:text-gray-500 active:text-gray-600">
                <svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                </svg>
              </a>

              <a href="https://dfpd.gov.in/index-hi.htm" target="_blank"
                class="text-gray-400 transition duration-100 hover:text-gray-500 active:text-gray-600">
                <i class="fa-solid fa-globe"></i>
              </a>
            </div>
            <!-- social - end -->
          </div>
        </div>
        <div class="w-full px-4 lg:w-1/2 xl:w-5/12">
          <div class="relative rounded-lg bg-white p-8 shadow-lg sm:p-12">
            <form method="post" action=""> 
              <div class="mb-6">
                <input id="userNameInpt" type="text" placeholder="Your Name *" name="name"
                  class="text-body-color border-[f0f0f0] focus:border-primary w-full rounded border py-3 px-[14px] text-base outline-none focus-visible:shadow-none" />
              </div>
              <div class="mb-6"> 
                <input id="userEmailInpt" type="email" placeholder="Your Email *" name="email"
                  class="text-body-color border-[f0f0f0] focus:border-primary w-full rounded border py-3 px-[14px] text-base outline-none focus-visible:shadow-none" />
              </div>
              <div class="mb-6">
                <input id="userSubjectInpt" type="text" placeholder="Subject *" name="subject"
                  class="text-body-color border-[f0f0f0] focus:border-primary w-full rounded border py-3 px-[14px] text-base outline-none focus-visible:shadow-none" />
              </div>
              <div class="mb-6">
                <textarea id="userMsgInpt" rows="6" placeholder="Your Message *" name="message"
                  class="text-body-color border-[f0f0f0] focus:border-primary w-full resize-none rounded border py-3 px-[14px] text-base outline-none focus-visible:shadow-none"></textarea>
              </div>
              <div>
                <button type="submit" id="submitGetInTouchForm" name="submit"
                  class="bg-primary border-primary w-full rounded border p-3 text-gray-900 transition hover:bg-opacity-90">
                  Send Message
                </button>
                <p id="errorGetInTouchLabel" class="mt-5 font-bold text-red-600"></p>
              </div>
            </form>
            <?php 
              include './php/connection.php';
              if(isset($_POST['submit'])){
                  $email = $_POST['email'];
                  $name = $_POST['name'];
                  $subject = $_POST['subject'];
                  $msg = $_POST['message'];
                  $date = date("Y : m : d");
                  $sql = "insert into tbl_send_request (name,date,email,subject,message) values ($name,$date,$email,$subject,$msg)";
                  $result = mysqli_query($conn,$sql);
                  if($result){
                    ?> <script>alert("Successfull")</script> <?php
                  }
              }
            ?>
            <div>
              <span class="absolute -top-10 -right-9 z-[-1]">
                <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M0 100C0 44.7715 0 0 0 0C55.2285 0 100 44.7715 100 100C100 100 100 100 0 100Z" fill="#3056D3" />
                </svg>
              </span>
              <span class="absolute -right-10 top-[90px] z-[-1]">
                <svg width="34" height="134" viewBox="0 0 34 134" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="31.9993" cy="132" r="1.66667" transform="rotate(180 31.9993 132)" fill="#13C296" />
                  <circle cx="31.9993" cy="117.333" r="1.66667" transform="rotate(180 31.9993 117.333)"
                    fill="#13C296" />
                  <circle cx="31.9993" cy="102.667" r="1.66667" transform="rotate(180 31.9993 102.667)"
                    fill="#13C296" />
                  <circle cx="31.9993" cy="88" r="1.66667" transform="rotate(180 31.9993 88)" fill="#13C296" />
                  <circle cx="31.9993" cy="73.3333" r="1.66667" transform="rotate(180 31.9993 73.3333)"
                    fill="#13C296" />
                  <circle cx="31.9993" cy="45" r="1.66667" transform="rotate(180 31.9993 45)" fill="#13C296" />
                  <circle cx="31.9993" cy="16" r="1.66667" transform="rotate(180 31.9993 16)" fill="#13C296" />
                  <circle cx="31.9993" cy="59" r="1.66667" transform="rotate(180 31.9993 59)" fill="#13C296" />
                  <circle cx="31.9993" cy="30.6666" r="1.66667" transform="rotate(180 31.9993 30.6666)"
                    fill="#13C296" />
                  <circle cx="31.9993" cy="1.66665" r="1.66667" transform="rotate(180 31.9993 1.66665)"
                    fill="#13C296" />
                  <circle cx="17.3333" cy="132" r="1.66667" transform="rotate(180 17.3333 132)" fill="#13C296" />
                  <circle cx="17.3333" cy="117.333" r="1.66667" transform="rotate(180 17.3333 117.333)"
                    fill="#13C296" />
                  <circle cx="17.3333" cy="102.667" r="1.66667" transform="rotate(180 17.3333 102.667)"
                    fill="#13C296" />
                  <circle cx="17.3333" cy="88" r="1.66667" transform="rotate(180 17.3333 88)" fill="#13C296" />
                  <circle cx="17.3333" cy="73.3333" r="1.66667" transform="rotate(180 17.3333 73.3333)"
                    fill="#13C296" />
                  <circle cx="17.3333" cy="45" r="1.66667" transform="rotate(180 17.3333 45)" fill="#13C296" />
                  <circle cx="17.3333" cy="16" r="1.66667" transform="rotate(180 17.3333 16)" fill="#13C296" />
                  <circle cx="17.3333" cy="59" r="1.66667" transform="rotate(180 17.3333 59)" fill="#13C296" />
                  <circle cx="17.3333" cy="30.6666" r="1.66667" transform="rotate(180 17.3333 30.6666)"
                    fill="#13C296" />
                  <circle cx="17.3333" cy="1.66665" r="1.66667" transform="rotate(180 17.3333 1.66665)"
                    fill="#13C296" />
                  <circle cx="2.66536" cy="132" r="1.66667" transform="rotate(180 2.66536 132)" fill="#13C296" />
                  <circle cx="2.66536" cy="117.333" r="1.66667" transform="rotate(180 2.66536 117.333)"
                    fill="#13C296" />
                  <circle cx="2.66536" cy="102.667" r="1.66667" transform="rotate(180 2.66536 102.667)"
                    fill="#13C296" />
                  <circle cx="2.66536" cy="88" r="1.66667" transform="rotate(180 2.66536 88)" fill="#13C296" />
                  <circle cx="2.66536" cy="73.3333" r="1.66667" transform="rotate(180 2.66536 73.3333)"
                    fill="#13C296" />
                  <circle cx="2.66536" cy="45" r="1.66667" transform="rotate(180 2.66536 45)" fill="#13C296" />
                  <circle cx="2.66536" cy="16" r="1.66667" transform="rotate(180 2.66536 16)" fill="#13C296" />
                  <circle cx="2.66536" cy="59" r="1.66667" transform="rotate(180 2.66536 59)" fill="#13C296" />
                  <circle cx="2.66536" cy="30.6666" r="1.66667" transform="rotate(180 2.66536 30.6666)"
                    fill="#13C296" />
                  <circle cx="2.66536" cy="1.66665" r="1.66667" transform="rotate(180 2.66536 1.66665)"
                    fill="#13C296" />
                </svg>
              </span>
              <span class="absolute -left-7 -bottom-7 z-[-1]">
                <svg width="107" height="134" viewBox="0 0 107 134" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="104.999" cy="132" r="1.66667" transform="rotate(180 104.999 132)" fill="#13C296" />
                  <circle cx="104.999" cy="117.333" r="1.66667" transform="rotate(180 104.999 117.333)"
                    fill="#13C296" />
                  <circle cx="104.999" cy="102.667" r="1.66667" transform="rotate(180 104.999 102.667)"
                    fill="#13C296" />
                  <circle cx="104.999" cy="88" r="1.66667" transform="rotate(180 104.999 88)" fill="#13C296" />
                  <circle cx="104.999" cy="73.3333" r="1.66667" transform="rotate(180 104.999 73.3333)"
                    fill="#13C296" />
                  <circle cx="104.999" cy="45" r="1.66667" transform="rotate(180 104.999 45)" fill="#13C296" />
                  <circle cx="104.999" cy="16" r="1.66667" transform="rotate(180 104.999 16)" fill="#13C296" />
                  <circle cx="104.999" cy="59" r="1.66667" transform="rotate(180 104.999 59)" fill="#13C296" />
                  <circle cx="104.999" cy="30.6666" r="1.66667" transform="rotate(180 104.999 30.6666)"
                    fill="#13C296" />
                  <circle cx="104.999" cy="1.66665" r="1.66667" transform="rotate(180 104.999 1.66665)"
                    fill="#13C296" />
                  <circle cx="90.3333" cy="132" r="1.66667" transform="rotate(180 90.3333 132)" fill="#13C296" />
                  <circle cx="90.3333" cy="117.333" r="1.66667" transform="rotate(180 90.3333 117.333)"
                    fill="#13C296" />
                  <circle cx="90.3333" cy="102.667" r="1.66667" transform="rotate(180 90.3333 102.667)"
                    fill="#13C296" />
                  <circle cx="90.3333" cy="88" r="1.66667" transform="rotate(180 90.3333 88)" fill="#13C296" />
                  <circle cx="90.3333" cy="73.3333" r="1.66667" transform="rotate(180 90.3333 73.3333)"
                    fill="#13C296" />
                  <circle cx="90.3333" cy="45" r="1.66667" transform="rotate(180 90.3333 45)" fill="#13C296" />
                  <circle cx="90.3333" cy="16" r="1.66667" transform="rotate(180 90.3333 16)" fill="#13C296" />
                  <circle cx="90.3333" cy="59" r="1.66667" transform="rotate(180 90.3333 59)" fill="#13C296" />
                  <circle cx="90.3333" cy="30.6666" r="1.66667" transform="rotate(180 90.3333 30.6666)"
                    fill="#13C296" />
                  <circle cx="90.3333" cy="1.66665" r="1.66667" transform="rotate(180 90.3333 1.66665)"
                    fill="#13C296" />
                  <circle cx="75.6654" cy="132" r="1.66667" transform="rotate(180 75.6654 132)" fill="#13C296" />
                  <circle cx="31.9993" cy="132" r="1.66667" transform="rotate(180 31.9993 132)" fill="#13C296" />
                  <circle cx="75.6654" cy="117.333" r="1.66667" transform="rotate(180 75.6654 117.333)"
                    fill="#13C296" />
                  <circle cx="31.9993" cy="117.333" r="1.66667" transform="rotate(180 31.9993 117.333)"
                    fill="#13C296" />
                  <circle cx="75.6654" cy="102.667" r="1.66667" transform="rotate(180 75.6654 102.667)"
                    fill="#13C296" />
                  <circle cx="31.9993" cy="102.667" r="1.66667" transform="rotate(180 31.9993 102.667)"
                    fill="#13C296" />
                  <circle cx="75.6654" cy="88" r="1.66667" transform="rotate(180 75.6654 88)" fill="#13C296" />
                  <circle cx="31.9993" cy="88" r="1.66667" transform="rotate(180 31.9993 88)" fill="#13C296" />
                  <circle cx="75.6654" cy="73.3333" r="1.66667" transform="rotate(180 75.6654 73.3333)"
                    fill="#13C296" />
                  <circle cx="31.9993" cy="73.3333" r="1.66667" transform="rotate(180 31.9993 73.3333)"
                    fill="#13C296" />
                  <circle cx="75.6654" cy="45" r="1.66667" transform="rotate(180 75.6654 45)" fill="#13C296" />
                  <circle cx="31.9993" cy="45" r="1.66667" transform="rotate(180 31.9993 45)" fill="#13C296" />
                  <circle cx="75.6654" cy="16" r="1.66667" transform="rotate(180 75.6654 16)" fill="#13C296" />
                  <circle cx="31.9993" cy="16" r="1.66667" transform="rotate(180 31.9993 16)" fill="#13C296" />
                  <circle cx="75.6654" cy="59" r="1.66667" transform="rotate(180 75.6654 59)" fill="#13C296" />
                  <circle cx="31.9993" cy="59" r="1.66667" transform="rotate(180 31.9993 59)" fill="#13C296" />
                  <circle cx="75.6654" cy="30.6666" r="1.66667" transform="rotate(180 75.6654 30.6666)"
                    fill="#13C296" />
                  <circle cx="31.9993" cy="30.6666" r="1.66667" transform="rotate(180 31.9993 30.6666)"
                    fill="#13C296" />
                  <circle cx="75.6654" cy="1.66665" r="1.66667" transform="rotate(180 75.6654 1.66665)"
                    fill="#13C296" />
                  <circle cx="31.9993" cy="1.66665" r="1.66667" transform="rotate(180 31.9993 1.66665)"
                    fill="#13C296" />
                  <circle cx="60.9993" cy="132" r="1.66667" transform="rotate(180 60.9993 132)" fill="#13C296" />
                  <circle cx="17.3333" cy="132" r="1.66667" transform="rotate(180 17.3333 132)" fill="#13C296" />
                  <circle cx="60.9993" cy="117.333" r="1.66667" transform="rotate(180 60.9993 117.333)"
                    fill="#13C296" />
                  <circle cx="17.3333" cy="117.333" r="1.66667" transform="rotate(180 17.3333 117.333)"
                    fill="#13C296" />
                  <circle cx="60.9993" cy="102.667" r="1.66667" transform="rotate(180 60.9993 102.667)"
                    fill="#13C296" />
                  <circle cx="17.3333" cy="102.667" r="1.66667" transform="rotate(180 17.3333 102.667)"
                    fill="#13C296" />
                  <circle cx="60.9993" cy="88" r="1.66667" transform="rotate(180 60.9993 88)" fill="#13C296" />
                  <circle cx="17.3333" cy="88" r="1.66667" transform="rotate(180 17.3333 88)" fill="#13C296" />
                  <circle cx="60.9993" cy="73.3333" r="1.66667" transform="rotate(180 60.9993 73.3333)"
                    fill="#13C296" />
                  <circle cx="17.3333" cy="73.3333" r="1.66667" transform="rotate(180 17.3333 73.3333)"
                    fill="#13C296" />
                  <circle cx="60.9993" cy="45" r="1.66667" transform="rotate(180 60.9993 45)" fill="#13C296" />
                  <circle cx="17.3333" cy="45" r="1.66667" transform="rotate(180 17.3333 45)" fill="#13C296" />
                  <circle cx="60.9993" cy="16" r="1.66667" transform="rotate(180 60.9993 16)" fill="#13C296" />
                  <circle cx="17.3333" cy="16" r="1.66667" transform="rotate(180 17.3333 16)" fill="#13C296" />
                  <circle cx="60.9993" cy="59" r="1.66667" transform="rotate(180 60.9993 59)" fill="#13C296" />
                  <circle cx="17.3333" cy="59" r="1.66667" transform="rotate(180 17.3333 59)" fill="#13C296" />
                  <circle cx="60.9993" cy="30.6666" r="1.66667" transform="rotate(180 60.9993 30.6666)"
                    fill="#13C296" />
                  <circle cx="17.3333" cy="30.6666" r="1.66667" transform="rotate(180 17.3333 30.6666)"
                    fill="#13C296" />
                  <circle cx="60.9993" cy="1.66665" r="1.66667" transform="rotate(180 60.9993 1.66665)"
                    fill="#13C296" />
                  <circle cx="17.3333" cy="1.66665" r="1.66667" transform="rotate(180 17.3333 1.66665)"
                    fill="#13C296" />
                  <circle cx="46.3333" cy="132" r="1.66667" transform="rotate(180 46.3333 132)" fill="#13C296" />
                  <circle cx="2.66536" cy="132" r="1.66667" transform="rotate(180 2.66536 132)" fill="#13C296" />
                  <circle cx="46.3333" cy="117.333" r="1.66667" transform="rotate(180 46.3333 117.333)"
                    fill="#13C296" />
                  <circle cx="2.66536" cy="117.333" r="1.66667" transform="rotate(180 2.66536 117.333)"
                    fill="#13C296" />
                  <circle cx="46.3333" cy="102.667" r="1.66667" transform="rotate(180 46.3333 102.667)"
                    fill="#13C296" />
                  <circle cx="2.66536" cy="102.667" r="1.66667" transform="rotate(180 2.66536 102.667)"
                    fill="#13C296" />
                  <circle cx="46.3333" cy="88" r="1.66667" transform="rotate(180 46.3333 88)" fill="#13C296" />
                  <circle cx="2.66536" cy="88" r="1.66667" transform="rotate(180 2.66536 88)" fill="#13C296" />
                  <circle cx="46.3333" cy="73.3333" r="1.66667" transform="rotate(180 46.3333 73.3333)"
                    fill="#13C296" />
                  <circle cx="2.66536" cy="73.3333" r="1.66667" transform="rotate(180 2.66536 73.3333)"
                    fill="#13C296" />
                  <circle cx="46.3333" cy="45" r="1.66667" transform="rotate(180 46.3333 45)" fill="#13C296" />
                  <circle cx="2.66536" cy="45" r="1.66667" transform="rotate(180 2.66536 45)" fill="#13C296" />
                  <circle cx="46.3333" cy="16" r="1.66667" transform="rotate(180 46.3333 16)" fill="#13C296" />
                  <circle cx="2.66536" cy="16" r="1.66667" transform="rotate(180 2.66536 16)" fill="#13C296" />
                  <circle cx="46.3333" cy="59" r="1.66667" transform="rotate(180 46.3333 59)" fill="#13C296" />
                  <circle cx="2.66536" cy="59" r="1.66667" transform="rotate(180 2.66536 59)" fill="#13C296" />
                  <circle cx="46.3333" cy="30.6666" r="1.66667" transform="rotate(180 46.3333 30.6666)"
                    fill="#13C296" />
                  <circle cx="2.66536" cy="30.6666" r="1.66667" transform="rotate(180 2.66536 30.6666)"
                    fill="#13C296" />
                  <circle cx="46.3333" cy="1.66665" r="1.66667" transform="rotate(180 46.3333 1.66665)"
                    fill="#13C296" />
                  <circle cx="2.66536" cy="1.66665" r="1.66667" transform="rotate(180 2.66536 1.66665)"
                    fill="#13C296" />
                </svg>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ====== Contact Section End -->


  <!-- footer - start -->
  <footer class="bg-white">
    <div class="border-t py-8 text-center text-sm text-gray-400">© 2021 - Present Flowrift. All rights reserved.
    </div>
  </footer>
  <!-- footer - end -->

  <script src="script.js"></script>
</body>

</html>