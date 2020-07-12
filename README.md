<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

Final Project: clone Stack Overflow. 

Latar belakang: 
Saat ini semakin banyak masyarakat Indonesia di usia produktif mulai belajar tentang programming. Media pembelajaran sangat mudah ditemui dengan hanya mengandalkan kata kunci di mesin pencarian. Namun untuk para pembelajar pemula terutama bagi mereka yang kesulitan memahami literatur dalam bahasa Inggris kebanyakan menyerah ketika mendapati error ketika mencoba mempelajari materi lewat praktek langsung. Saat ini mereka menggunakan media komunikasi seperti grup telegram komunitas untuk bertanya tapi sangat sedikit dari anggota grup yang dapat membantu karena masih terlalu sulit untuk bertanya tentang pemrograman melalui aplikasi chatting. 

Solusi yang ditawarkan: 
Membuat aplikasi untuk diskusi dan tanya jawab seputar pemrograman seperti Stack Overflow dalam Bahasa Indonesia. 

Terdapat Beberapa fitur utama:

Pengguna dapat melihat & membuat pertanyaan baru yang terdiri dari: 
    judul, 
    isi pertanyaan,
    tag (memerlukan autentikasi).
Setiap pertanyaan memiliki penanda waktu (created_at, updated_at).
Setiap pengguna dapat memberikan jawaban pada sebuah pertanyaan (memerlukan autentikasi).
Setiap pertanyaan dan jawaban memiliki poin vote yang merepresentasikan tingkat ke-relevan-an sebuah pertanyaan dan penting untuk segera dijawab. 
Setiap pengguna memiliki poin reputasi yang merepresentasikan tingkat kontribusi dalam forum tanya jawab. 
Pengguna dapat memberikan komentar pada jawaban atau pertanyaan. (memerlukan autentikasi)
Pengguna dapat memberikan upvote, satu pengguna hanya boleh memberikan satu upvote. (memerlukan autentikasi).
Setiap pertanyaan atau jawaban yang di-upvote oleh pengguna lain maka pengguna yang membuat pertanyaan atau jawaban tersebut mendapatkan 10 poin reputasi. 
Pengguna dapat memberikan downvote, ketika melakukan downvote maka pengguna tersebut dikurangi 1 poin reputasi. 
Pembuat pertanyaan dapat menandai jawaban yang menurut dia paling tepat menyelesaikan masalahnya. 
Setiap jawaban yang ditandai sebagai jawaban tepat maka pengguna yang membuat jawaban tersebut mendapatkan tambahan reputasi 15 poin.
Pengguna yang boleh downvote adalah pengguna dengan reputasi minimal 15 poin

Spesifikasi :
Aplikasi dibuat menggunakan Laravel 6.0 ke atas.
Tampilan simple menggunakan bootstrap CSS atau template yang sesuai.
Menggunakan library editor WYSIWYG CKEditor/TinyMCE untuk membuat pertanyaan atau jawaban.
Tugas dikerjakan berkelompok (2 orang /3 orang) berkolaborasi menggunakan github.
(Opsional) Tugas dideploy di hosting atau di heroku.
Di akhir, semua kelompok mengirimkan demo video web buatan masing-masing.


Tugas: 

Aplikasikan materi-materi yang telah dipelajari sebelumnya di antaranya: 
Membuat ERD
Migrations
Model + Eloquent
Controller
View (Blade)
CRUD (Create Read Update Delete)
Eloquent Relationships
Laravel + Library/Packages

Catatan: Kreasikan sesuai dengan kreatifitas kelompok masing-masing. 

Deadline Pengumpulan : Hari Jum’at, 10 Juli 2020. Jam 23.59.




Menambahkan Sweet alert:
pada terminal:

composer require realrashid/sweet-alert

php artisan sweetalert:publish

selengkapnya
https://realrashid.github.io/sweet-alert/config


