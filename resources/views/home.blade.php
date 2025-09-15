<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portofolio Ibnu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    @vite('resources/css/app.css')
</head>

<body class="dark:text-gray-200 dark:bg-slate-900 relative overflow-x-hidden">
    <svg class="absolute -z-20 top-0 left-0 opacity-30" width="600" height="600">
        <defs>
            <radialGradient id="bg-gradient" cx="50%" cy="50%" r="50%">
                <stop offset="0%" stop-color="#60a5fa" />
                <stop offset="100%" stop-color="transparent" />
            </radialGradient>
        </defs>
        <circle cx="300" cy="300" r="300" fill="url(#bg-gradient)" />
    </svg>
    <header class="fixed xl:block w-full py-4 lg:px-0 px-5 z-[999] duration-300">
        <nav class="glass-nav rounded-2xl flex justify-between items-center max-w-6xl mx-auto px-4 py-2">
            <div class="flex gap-4 items-center">
                <div>
                    <h4 class="font-bold text-xl dark:text-white">Ibnu.</h4>
                </div>
            </div>
            <ul class="gap-8 md:flex hidden *:duration-200">
                <li>
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li>
                    <a class="nav-link" href="#about-skills">About Me</a>
                </li>
                <li>
                    <a class="nav-link" href="#about-skills">Skills</a>
                </li>
                <li>
                    <a class="nav-link" href="#projects">Projects</a>
                </li>
                <li>
                    <a class="nav-link" href="#certificate">Certificates</a>
                </li>
                <li>
                    <a class="nav-link" href="#contact">Contact Us</a>
                </li>
                <li class="theme-switch">
                    <i class="fa-solid fa-circle-half-stroke cursor-pointer"></i>
                </li>
            </ul>
            <div class="flex items-center gap-6">
                <a href="/login">
                    <button class="btn btn-outline md:!flex !hidden">
                        <i class="fa-solid fa-user"></i> Login
                    </button>
                </a>
                <span class="theme-switch md:hidden">
                    <i class="fa-solid fa-circle-half-stroke cursor-pointer"></i>
                </span>
                <span id="menubar" class="cursor-pointer md:hidden text-xl">
                    <i class="fa-solid fa-bars"></i>
                </span>
            </div>
        </nav>
    </header>

    <span id="backdrop" class="fixed h-screen hidden bg-black/10 backdrop-blur-sm z-[997] inset-0 w-full"></span>

    <ul id="mobile-nav"
        class="gap-10 text-xl md:hidden dark:bg-slate-800 bg-primary text-white flex-center flex-col fixed w-full h-0 overflow-hidden bottom-0 duration-200 rounded-t-3xl left-0 z-[998]">
        <li>
            <a href="#home">Home</a>
        </li>
        <li>
            <a href="#about-skills">About Me</a>
        </li>
        <li>
            <a href="#about-skills">Skills</a>
        </li>
        <li>
            <a href="#projects">Projects</a>
        </li>
        <li>
            <a href="#certificate">Certificates</a>
        </li>
        <li>
            <a href="#contact">Contact Us</a>
        </li>
        <a href="/login">
            <button class="btn btn-outline">
                <i class="fa-solid fa-user"></i> Login
            </button>
        </a>
    </ul>

    <!-- Home -->
    <section id="home" class="min-h-screen container grid place-items-center relative overflow-hidden"
        data-aos="fade-up">
        <!-- Decorative blobs -->
        <span class="blob blob-primary w-80 h-80 top-16 -left-12 animate-parallax -z-10"></span>
        <div class="blob blob-secondary w-[350px] h-[350px] bottom-20 right-10"></div>

        <div class="pt-36 grid md:grid-cols-2 h-full items-center max-w-5xl justify-between">
            <!-- Teks Section -->
            <div class="text-center md:text-left px-6" data-aos="fade-right">
                <h5 class="font-medium text-gray-600 dark:text-gray-200">
                    Hello Welcome!
                </h5>
                <h1 class="sm:text-6xl text-4xl !leading-tight relative font-semibold text-gray-900 dark:text-white">
                    I'm <span class="gradient-text">{{ $homes->name }}</span> as a<br /> Junior Developer
                </h1>
                <div class="md:w-[34rem] flex mt-5 gap-2 dark:text-gray-300 animate-fade-up">
                    <p class="text-sm leading-6 max-w-md text-gray-600 dark:text-gray-300">
                        {{ $homes->description }}
                    </p>
                </div>
                <!-- Skill chips -->
                <div class="flex flex-wrap gap-2 mt-6 justify-center md:justify-start animate-fade-up"
                    style="animation-delay:.05s">
                    <span class="glass rounded-full px-3 py-1 text-xs">HTML</span>
                    <span class="glass rounded-full px-3 py-1 text-xs">CSS</span>
                    <span class="glass rounded-full px-3 py-1 text-xs">JavaScript</span>
                    <span class="glass rounded-full px-3 py-1 text-xs">Laravel</span>
                    <span class="glass rounded-full px-3 py-1 text-xs">TailwindCSS</span>
                </div>
                <!-- CTAs -->
                <div class="flex gap-3 mt-7 justify-center md:justify-start animate-fade-up"
                    style="animation-delay:.1s">
                    <a href="#projects" class="btn btn-filled">View Projects</a>
                    <a href="#contact" class="btn btn-outline">Contact Me</a>
                </div>
            </div>

            <!-- Gambar Section -->
            <div class="flex justify-center md:justify-start" data-aos="fade-left">
                <img src="{{ asset('storage/' . $homes->image) }}"
                    class="w-2/3 mx-auto md:w-full max-w-[24rem] md:mt-0 mt-8 rounded-2xl shadow-lg ring-1 ring-black/5 dark:ring-white/5 animate-float"
                    alt="Ibnu" />
            </div>
        </div>
    </section>


    <!-- About and Skills -->
    <section id="about-skills"
        class="max-w-screen-xl px-4 lg:px-8 mx-auto mb-8 flex flex-col lg:flex-row place-items-center items-start justify-between gap-16 relative overflow-hidden"
        data-aos="fade-up">
        <!-- Gradient Blob -->


        <span class="blob blob-primary w-72 h-72 top-10 -left-20 animate-parallax absolute -z-10 opacity-40"></span>

        <!-- Deskripsi About di kiri -->
        <div class="w-full lg:w-5/12">
            <div class="section-header mb-6">
                <h3 class="px-0 dark:text-white">About Me</h3>
                <p class="section-lead">
                    Halo, saya Ibnu Nabil Nur Ihsan, lahir di Wonogiri pada tanggal 14 November. Saat ini, saya sedang
                    menempuh pendidikan di SMK Negeri 1 Ciomas dengan jurusan PPLG (Pengembangan Perangkat Lunak dan
                    Game).
                </p>
                <div
                    class="flex items-center md:justify-start justify-center dark:text-gray-200 text-gray-600 gap-6 mt-6">
                    <p class="text-xs">Ikuti Saya</p>
                    <div class="flex justify-end gap-3">
                        <a href="{{ $instagram->link ?? '#' }}" class="social-icon" target="_blank"
                            rel="noopener noreferrer">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="{{ $whatsapp->link ?? '#' }}" class="social-icon" target="_blank"
                            rel="noopener noreferrer">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <a href="{{ $facebook->link ?? '#' }}" class="social-icon" target="_blank"
                            rel="noopener noreferrer">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Skills di kanan -->
        <div class="w-full lg:w-7/12 px-0">
            <div class="section-header">
                <h3 class="px-0 dark:text-white">My Skills</h3>
                <p class="section-lead">
                    Berikut adalah keterampilan saya yang ditampilkan dengan persentase pengalaman.
                </p>
            </div>
            <div class="max-w-2xl mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2">
                @foreach ($skills as $skill)
                    <div>
                        <div class="flex justify-between items-left">
                            <p class="font-semibold text-sm text-gray-700 dark:text-gray-200">{{ $skill->title }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $skill->persen }}%</p>
                        </div>
                        <div class="progress-track mt-2">
                            <div class="progress-fill" style="width: {{ $skill->persen }}%;"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Projects -->
    <section id="projects" class="container relative overflow-hidden" data-aos="fade-up">
        <!-- Gradient Blob -->
        <span class="blob blob-secondary w-64 h-64 -top-16 right-0 animate-float absolute -z-10 opacity-30"></span>
        <div class="text-center text-balance">
            <h3 class="dark:text-white">My Projects</h3>
            <div class="h-1 w-24 mx-auto mt-3 rounded-full gradient-primary"></div>
            <p class="section-lead">
                Kumpulan aplikasi dan situs web yang saya bangun untuk mengasah keterampilan pemrograman saya, dengan
                menggunakan teknologi terbaru.
            </p>

            <br />
            <br />
            <div class="group hover:!grayscale-0 hover:duration-1000 bg-white/60 dark:bg-slate-800/60 shadow-lg rounded-lg overflow-hidden mx-2 my-8 backdrop-blur-md border border-white/30"
                data-aos="zoom-in">
                <span
                    class="blob blob-primary w-72 h-72 top-10 -left-20 animate-parallax absolute -z-10 opacity-40"></span>
                <div class="mx-auto max-w-xs sm:max-w-xl md:max-w-4xl px-4 sm:px-6 slick">
                    @foreach ($projects as $project)
                        <div
                            class="group hover:!grayscale-0 hover:duration-1000 bg-white shadow-lg rounded-lg overflow-hidden mx-2 my-8">
                            <a href="{{ $project->link }}" target="_blank">
                                <img class="rounded-t-md w-full h-40 object-cover"
                                    src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->name }}" />
                            </a>
                            <div class="p-4">
                                <h4 class="text-xl font-semibold text-gray-800">{{ $project->name }}</h4>
                                <p class="mt-2 text-gray-600 text-xs">
                                    {{ Str::limit($project->description, 100) }}
                                </p>
                                <div class="mt-4 text-center">
                                    <a href="{{ $project->link }}" target="_blank"
                                        class="text-blue-500 hover:underline">View Project</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Certificate -->
    <section id="certificate" class="container relative overflow-hidden" data-aos="fade-up">
        <span class="blob blob-primary w-64 h-64 -top-16 right-0 animate-float absolute -z-10 opacity-30"></span>
        <div class="text-center text-balance">
            <h3 class="dark:text-white">My Certificates</h3>
            <div class="h-1 w-24 mx-auto mt-3 rounded-full gradient-primary"></div>
            <p class="section-lead">
                Berikut adalah koleksi sertifikat yang saya peroleh sebagai bukti keahlian dan dedikasi saya dalam
                mengembangkan diri.
                Setiap sertifikat mencerminkan pencapaian saya dalam berbagai bidang
            </p>

            <br />
            <br />
            <div class="group hover:!grayscale-0 hover:duration-1000 bg-white/60 dark:bg-slate-800/60 shadow-lg rounded-lg overflow-hidden mx-2 my-8 backdrop-blur-md border border-white/30"
                data-aos="zoom-in">
                <span
                    class="blob blob-secondary w-64 h-64 -top-3 left-0 animate-float absolute -z-10 opacity-30"></span>
                <div class="mx-auto max-w-xs sm:max-w-xl md:max-w-4xl px-4 sm:px-6 slick">
                    @foreach ($certificates as $certificate)
                        <div
                            class="group hover:!grayscale-0 hover:duration-1000 bg-white shadow-lg rounded-lg overflow-hidden mx-2 my-8">
                            <a href="{{ $certificate->link }}" target="_blank">
                                <embed src="{{ asset('storage/' . $certificate->file) }}" type="application/pdf"
                                    width="100%" height="100">
                            </a>
                            <div class="p-4">
                                <h4 class="text-xl font-semibold text-gray-800">{{ $certificate->name }}</h4>
                                <p class="mt-2 text-gray-600 text-xs">
                                    {{ Str::limit($certificate->description, 100) }} <!-- Truncate description -->
                                </p>
                                <div class="mt-4 text-center">
                                    <a href="{{ asset('storage/' . $certificate->file) }}" target="_blank"
                                        class="text-blue-500 hover:underline">View Certificate</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Contact -->
    <section id="contact" data-aos="fade-up"
        class="container relative max-w-4xl mx-auto min-h-screen flex-center px-5">
        <div class="pb-10">
            <div class="text-center">
                <h3 class="dark:text-white">Contact Me</h3>
                <div class="h-1 w-24 mx-auto mt-3 rounded-full gradient-primary"></div>
                <p class="section-lead">
                    Saya selalu siap menjawab pertanyaan dan memberikan bantuan.
                    Jika ada yang ingin Anda ketahui atau diskusikan lebih lanjut, jangan ragu untuk menghubungi saya.
                </p>
            </div>
            <div class="mt-12 md:relative flex flex-col gap-5 sm:max-w-full mx-auto max-w-xs">
                <div class="blob blob-primary blob-glow w-[400px] h-[400px] top-10 left-10"></div>
                <div
                    class="dark:bg-slate-800 bg-slate-50 dark:text-gray-100 text-gray-800 rounded-xl shadow-sm ring-1 ring-black/5 dark:ring-white/5 mx-auto md:w-2/3 py-12 px-7 w-full">
                    <h3 class="font-semibold text-3xl dark:text-white">
                        Send Us A <br /><span class="text-primary">Message</span>
                    </h3>
                    <form class="*:flex *:flex-col *:gap-1 mt-5 md:w-2/3 w-full" method="POST"
                        action="{{ route('admin.message.store') }}">
                        @csrf
                        <div class="">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter your name"
                                required class="rounded-md" />
                        </div>
                        <div class="">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email"
                                placeholder="Enter your email address" required class="rounded-md" />
                        </div>
                        <div class="">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" placeholder="Enter your message" required class="rounded-md"></textarea>
                        </div>
                        <button class="btn btn-filled ml-auto" type="submit">Send to Us</button>
                    </form>
                </div>
                <div
                    class="dark:bg-gray-700 bg-white py-12 px-7 md:absolute lg:-right-9 right-28 rounded-xl shadow-sm ring-1 ring-black/5 dark:ring-white/5 md:w-2/5 h-5/6 top-28 w-full mx-auto">
                    <h3 class="font-semibold text-2xl border-b pb-4 border-gray-600 dark:text-white">
                        Drop In Our <br />Office <span class="text-primary">.</span>
                    </h3>
                    <div class="py-4">
                        <p class="text-xs text-gray-400 leading-5">
                            Temui saya, yang berdedikasi untuk memberikan layanan terbaik bagi setiap kebutuhan Anda.
                            Saya percaya bahwa kolaborasi adalah kunci untuk kesuksesan bersama.
                        </p>
                        {{-- <ul class="*:flex *:gap-4 *:items-center *:mt-4">
                            <li>
                                <i class="fa-solid fa-location-dot"></i>
                                <div>
                                    <h2 class="dark:text-white">Kota Bogor</h2>
                                    <address class="text-xs">{{ $lokasi->name }}</address>
                                </div>
                            </li>
                            <li>
                                <i class="fa-solid fa-envelope"></i>
                                <p>{{ $mail->name }}</p>
                            </li>
                            <li>
                                <i class="fa-solid fa-phone"></i>
                                <p>{{ $whatsapp->name }}</p>
                            </li>
                        </ul> --}}
                        <div
                            class="flex items-center md:justify-end justify-center dark:text-gray-200 text-gray-600 gap-6 mt-9">
                            <p class="text-xs">Ikuti Saya</p>
                            <div class="flex justify-end gap-3">
                                <a href="{{ $instagram->link ?? '#' }}" class="social-icon" target="_blank"
                                    rel="noopener noreferrer">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                                <a href="{{ $whatsapp->link ?? '#' }}" class="social-icon" target="_blank"
                                    rel="noopener noreferrer">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>
                                <a href="{{ $facebook->link ?? '#' }}" class="social-icon" target="_blank"
                                    rel="noopener noreferrer">
                                    <i class="fa-brands fa-facebook"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="dark:bg-slate-700 bg-slate-100 text-center py-6">
        Copyright &copy; 2025
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Slick JS -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="module" src="resoude/main.js"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
            });
        @endif
        const header = document.querySelector("header");

        const toggleClasses = (element, classes, condition) => {
            classes.forEach((className) => {
                element.classList.toggle(className, condition);
            });
        };

        window.addEventListener("scroll", () => {
            toggleClasses(header, ["shadow-lg"], window.scrollY > 0);
        });

        $('.slick').slick({
            slidesToShow: 3, // Default jumlah slide yang ditampilkan
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [{
                    breakpoint: 1024, // Untuk layar dengan lebar kurang dari 1024px
                    settings: {
                        slidesToShow: 3, // Tampilkan 2 slide
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 768, // Untuk layar dengan lebar kurang dari 768px
                    settings: {
                        slidesToShow: 2, // Tampilkan 1 slide
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 480, // Untuk layar dengan lebar kurang dari 480px (Small Mobile)
                    settings: {
                        slidesToShow: 1, // Tampilkan 1 slide
                        slidesToScroll: 1,
                    }
                }
            ]
        });
    </script>
    @vite('resources/js/main.js')
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 900,
            once: true,
            offset: 60,
        });
    </script>
</body>

</html>
