<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>Motomesa.id</title>
	<meta name="description" content="motomesa">
	<meta name="keywords" content="Fotografer">

	<!-- Favicons -->
	<link href="<?= base_url() ?>assets/images/motomesa_logo.png" rel="icon">
	<link href="<?= base_url() ?>assets/images/motomesa_logo.png" rel="apple-touch-icon">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
		rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="<?= base_url() ?>assets/landing/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/landing/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/landing/vendor/aos/aos.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/landing/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/landing/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

	<!-- Main CSS File -->
	<link href="<?= base_url() ?>assets/landing/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

<header id="header" class="header d-flex align-items-center fixed-top">
	<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

		<a href="index.html" class="logo d-flex align-items-center">
			<!--			 Uncomment the line below if you also wish to use an image logo -->
			<!--			 <img src="--><?php //= base_url() ?><!--assets/landing/img/logo.png" alt=""> -->
			<h1 class="sitename">Motomesa.id</h1>
		</a>

		<nav id="navmenu" class="navmenu">
			<ul>
				<li><a href="#hero" class="active">Beranda</a></li>
				<li><a href="#about">Tentang Kami</a></li>
				<li><a href="#gallery">Gallery</a></li>
				<li><a href="#contact">Kontak</a></li>
				<li><a href="<?= base_url('Auth') ?>">Pesan Sekarang</a></li>
			</ul>
			<i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
		</nav>

	</div>
</header>

<main class="main">

	<!-- Hero Section -->
	<section id="hero" class="hero section dark-background">
		<img src="<?= base_url() ?>assets/landing/img/hero-bg-2.jpg" alt="" class="hero-bg">

		<div class="container">
			<div class="row gy-4 justify-content-between">
				<div class="col-lg-4 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
					<img src="<?= base_url() ?>assets/images/instagram.png" class="img-fluid animated" alt="">
				</div>

				<div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-in">
					<h1>Motomesa.id - Platform Jasa Fotografi Profesional</h1>
					<p>Motomesa.id menyediakan berbagai layanan fotografi untuk berbagai acara, mulai dari pernikahan,
						perusahaan, instansi, foto studio, dan masih banyak lagi. Abadikan momen berharga Anda dengan
						kualitas terbaik!</p>
					<div class="d-flex">
						<a href="<?= base_url('Auth') ?>" class="btn-get-started">Mulai Sekarang</a>
						<a href="#"
						   class="glightbox btn-watch-video d-flex align-items-center">
							<i class="bi bi-play-circle"></i><span>Tonton Video</span>
						</a>
					</div>
				</div>

			</div>
		</div>

		<svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
			 viewBox="0 24 150 28 " preserveAspectRatio="none">
			<defs>
				<path id="wave-path"
					  d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
			</defs>
			<g class="wave1">
				<use xlink:href="#wave-path" x="50" y="3"></use>
			</g>
			<g class="wave2">
				<use xlink:href="#wave-path" x="50" y="0"></use>
			</g>
			<g class="wave3">
				<use xlink:href="#wave-path" x="50" y="9"></use>
			</g>
		</svg>

	</section><!-- /Hero Section -->

	<!-- About Section -->
	<section id="about" class="about section">

		<div class="container" data-aos="fade-up" data-aos-delay="100">
			<div class="row align-items-xl-center gy-5">

				<div class="col-xl-5 content">
					<h3>Tentang Kami</h3>
					<h2>Motomesa.id</h2>
					<p style="text-align: justify">Motomesa.id adalah layanan fotografi yang berbasis di Sumbawa,
						Indonesia.
						Layanan ini menawarkan
						fotografi berkualitas tinggi untuk berbagai acara, termasuk pernikahan, pesta keluarga, dan
						momen-momen penting lainnya. Dengan tim fotografer profesional yang berpengalaman,
						Motomesa.idberkomitmen untuk mencatat setiap momen indah dengan hasil foto yang memukau dan
						berharga. Selain itu, layanan ini juga menyediakan editing foto berkualitas dan layanan
						pengiriman cepat, sehingga Anda dapat dengan mudah mendapatkan foto-foto yang sesuai dengan
						harapan Anda</p>
					<button class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></button>
				</div>

				<div class="col-xl-7">
					<div class="row gy-4 icon-boxes">

						<div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
							<div class="icon-box">
								<i class="bi bi-buildings"></i>
								<h3>Foto Pernikahan</h3>
								<p>Menyediakan jasa fotografi untuk mengabadikan momen-momen indah pada hari pernikahan
									Anda, mulai dari persiapan hingga resepsi.</p>
							</div>
						</div> <!-- End Icon Box -->

						<div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
							<div class="icon-box">
								<i class="bi bi-clipboard-pulse"></i>
								<h3>Foto Prewedding</h3>
								<p>Mengabadikan momen romantis sebelum hari pernikahan dengan latar belakang yang indah
									dan penuh makna</p>
							</div>
						</div>
						<!-- End Icon Box -->

						<div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
							<div class="icon-box">
								<i class="bi bi-command"></i>
								<h3>Foto Wisuda</h3>
								<p>Mengabadikan momen bersejarah pada hari kelulusan dengan foto yang penuh kebanggaan
									dan kebahagiaan.</p>
							</div>
						</div>
						<!-- End Icon Box -->
						<div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
							<div class="icon-box">
								<i class="bi bi-graph-up-arrow"></i>
								<h3>Foto Studio</h3>
								<p>Menawarkan layanan fotografi di dalam studio dengan berbagai tema dan latar belakang
									yang menarik. Foto studio cocok untuk berbagai keperluan, seperti foto keluarga,
									foto potret pribadi, foto fashion, dan lain-lain.</p>
							</div>
						</div>
						<!-- End Icon Box -->
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- /About Section -->


	<!-- Gallery Section -->
	<section id="gallery" class="gallery section">

		<!-- Section Title -->
		<div class="container section-title" data-aos="fade-up">
			<h2>Gallery</h2>
			<div><span>Check Our</span> <span class="description-title">Gallery</span></div>
		</div>
		<!-- End Section Title -->

		<div class="container" data-aos="fade-up" data-aos-delay="100">

			<div class="row g-0">

				<div class="col-lg-3 col-md-4">
					<div class="gallery-item">
						<a href="<?= base_url() ?>assets/images/foto1.png" class="glightbox"
						   data-gallery="images-gallery">
							<img src="<?= base_url() ?>assets/images/foto1.png" alt=""
								 class="img-fluid">
						</a>
					</div>
				</div>
				<!-- End Gallery Item -->

				<div class="col-lg-3 col-md-4">
					<div class="gallery-item">
						<a href="<?= base_url() ?>assets/images/foto2.png" class="glightbox"
						   data-gallery="images-gallery">
							<img src="<?= base_url() ?>assets/images/foto2.png" alt=""
								 class="img-fluid">
						</a>
					</div>
				</div>
				<!-- End Gallery Item -->

				<div class="col-lg-3 col-md-4">
					<div class="gallery-item">
						<a href="<?= base_url() ?>assets/images/foto8.png" class="glightbox"
						   data-gallery="images-gallery">
							<img src="<?= base_url() ?>assets/images/foto8.png" alt=""
								 class="img-fluid">
						</a>
					</div>
				</div>
				<!-- End Gallery Item -->

				<div class="col-lg-3 col-md-4">
					<div class="gallery-item">
						<a href="<?= base_url() ?>assets/images/foto5.png" class="glightbox"
						   data-gallery="images-gallery">
							<img src="<?= base_url() ?>assets/images/foto5.png" alt=""
								 class="img-fluid">
						</a>
					</div>
				</div>
				<!-- End Gallery Item -->

				<div class="col-lg-3 col-md-4">
					<div class="gallery-item">
						<a href="<?= base_url() ?>assets/images/foto4.png" class="glightbox"
						   data-gallery="images-gallery">
							<img src="<?= base_url() ?>assets/images/foto4.png" alt=""
								 class="img-fluid">
						</a>
					</div>
				</div>
				<!-- End Gallery Item -->

				<div class="col-lg-3 col-md-4">
					<div class="gallery-item">
						<a href="<?= base_url() ?>assets/images/foto7.png" class="glightbox"
						   data-gallery="images-gallery">
							<img src="<?= base_url() ?>assets/images/foto7.png" alt=""
								 class="img-fluid">
						</a>
					</div>
				</div>
				<!-- End Gallery Item -->

				<div class="col-lg-3 col-md-4">
					<div class="gallery-item">
						<a href="<?= base_url() ?>assets/images/foto3.png" class="glightbox"
						   data-gallery="images-gallery">
							<img src="<?= base_url() ?>assets/images/foto3.png" alt=""
								 class="img-fluid">
						</a>
					</div>
				</div>
				<!-- End Gallery Item -->

				<div class="col-lg-3 col-md-4">
					<div class="gallery-item">
						<a href="<?= base_url() ?>assets/images/foto6.png" class="glightbox"
						   data-gallery="images-gallery">
							<img src="<?= base_url() ?>assets/images/foto6.png" alt=""
								 class="img-fluid">
						</a>
					</div>
				</div>
				<!-- End Gallery Item -->
			</div>
		</div>
	</section>

	<!-- /Gallery Section -->


	<!-- Contact Section -->
	<section id="contact" class="contact section">

		<!-- Section Title -->
		<div class="container section-title" data-aos="fade-up">
			<h2>Contact</h2>
			<div><span>Check Our</span> <span class="description-title">Contact</span></div>
		</div><!-- End Section Title -->

		<div class="container" data-aos="fade" data-aos-delay="100">

			<div class="row gy-4">

				<div class="col-lg-4">
					<div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
						<i class="bi bi-geo-alt flex-shrink-0"></i>
						<div>
							<h3>Address</h3>
							<p>BUMI INDAH RESIDENCE KEL SEKETENG SUMBAWA</p>
						</div>
					</div><!-- End Info Item -->

					<div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
						<i class="bi bi-telephone flex-shrink-0"></i>
						<div>
							<h3>Call Us</h3>
							<p>+1 5589 55488 55</p>
						</div>
					</div><!-- End Info Item -->

					<div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
						<i class="bi bi-envelope flex-shrink-0"></i>
						<div>
							<h3>Email Us</h3>
							<p>info@example.com</p>
						</div>
					</div><!-- End Info Item -->

				</div>

				<div class="col-lg-8">
					<form action="#" method="post" class="php-email-form" data-aos="fade-up"
						  data-aos-delay="200">
						<div class="row gy-4">

							<div class="col-md-6">
								<input type="text" name="name" class="form-control" placeholder="Your Name" required="">
							</div>

							<div class="col-md-6 ">
								<input type="email" class="form-control" name="email" placeholder="Your Email"
									   required="">
							</div>

							<div class="col-md-12">
								<input type="text" class="form-control" name="subject" placeholder="Subject"
									   required="">
							</div>

							<div class="col-md-12">
								<textarea class="form-control" name="message" rows="6" placeholder="Message"
										  required=""></textarea>
							</div>

							<div class="col-md-12 text-center">
								<div class="loading">Loading</div>
								<div class="error-message"></div>
								<div class="sent-message">Your message has been sent. Thank you!</div>

								<button type="button">Send Message</button>
							</div>

						</div>
					</form>
				</div><!-- End Contact Form -->

			</div>

		</div>

	</section><!-- /Contact Section -->

</main>

<footer id="footer" class="footer dark-background">

	<div class="container footer-top">
		<div class="row gy-4">
			<div class="col-lg-4 col-md-6 footer-about">
				<a href="index.html" class="logo d-flex align-items-center">
					<span class="sitename">MotomesaId</span>
				</a>
				<div class="footer-contact pt-3">
					<p>BUMI INDAH RESIDENCE KEL SEKETENG SUMBAWA</p>
					<p>SEKETENG, SUMBAWA, 84311</p>
					<p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
					<p><strong>Email:</strong> <span>info@example.com</span></p>
				</div>
				<div class="social-links d-flex mt-4">
					<a href=""><i class="bi bi-facebook"></i></a>
					<a href="https://www.instagram.com/motomesa.id" target="_blank"><i class="bi bi-instagram"></i></a>
				</div>
			</div>

			<div class="col-lg-2 col-md-3 footer-links">
				<h4>Useful Links</h4>
				<ul>
					<li><a href="#hero" class="active">Beranda</a></li>
					<li><a href="#about">Tentang Kami</a></li>
					<li><a href="#gallery">Gallery</a></li>
					<li><a href="#contact">Kontak</a></li>
				</ul>
			</div>

			<div class="col-lg-2 col-md-3 footer-links">
				<h4>Our Services</h4>
				<ul>
					<li><a href="#">Foto Studio</a></li>
					<li><a href="#">Foto Nikah</a></li>
					<li><a href="#">Foto Prewedding</a></li>
					<li><a href="#">Foto Wisuda</a></li>
				</ul>
			</div>

			<div class="col-lg-4 col-md-12 footer-newsletter">
				<h4>Our Newsletter</h4>
				<p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
				<form action="forms/newsletter.php" method="post" class="php-email-form">
					<div class="newsletter-form"><input type="email" name="email"><input type="submit"
																						 value="Subscribe"></div>
					<div class="loading">Loading</div>
					<div class="error-message"></div>
					<div class="sent-message">Your subscription request has been sent. Thank you!</div>
				</form>
			</div>

		</div>
	</div>

	<div class="container copyright text-center mt-4">
		<p>© <span>Copyright</span> <strong class="px-1 sitename">MotomesaId</strong> <span>All Rights Reserved</span>
		</p>
		<div class="credits">
			Designed by <a href="<?= base_url('Home') ?>">MotomesaId</a>
		</div>
	</div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
		class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="<?= base_url() ?>assets/landing/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/landing/vendor/php-email-form/validate.js"></script>
<script src="<?= base_url() ?>assets/landing/vendor/aos/aos.js"></script>
<script src="<?= base_url() ?>assets/landing/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?= base_url() ?>assets/landing/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="<?= base_url() ?>assets/landing/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="<?= base_url() ?>assets/landing/js/main.js"></script>

</body>

</html>
