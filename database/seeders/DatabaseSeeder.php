<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\transactions;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        user::create([
            'nama_lengkap' => 'Pelin_zhuxin_picer',
            'username' => 'admin_teladan',
            'password' => Hash::make('Admin1234#'),
            'role' => 'admin',
            'alamat' => 'Ruang Admin Perpustakaan'
        ]);
        $siswa1=user::create([
            'nama_lengkap' => 'sahusilawane_alucard',
            'username' => 'siswa_rajin_belajar',
            'password' => Hash::make('alukar_jungler_viral'),
            'role' => 'siswa',
            'alamat' => 'jl.angker no.666'
        ]);
        $buku1=Book::create([
            'judul' => 'Belajar Laravel Untuk Pemula',
            'penulis' => 'Taylor Otwell',
            'penerbit' => 'Laravel Press',
            'kategori' => 'teknologi',
            'stok' => 50
        ]);
        $buku2=Book::create([
            'judul' => 'Laskar Pelangi',
            'penulis' => 'Andrea Hirata',
            'penerbit' => 'Benteng Pustaka',
            'kategori' => 'Novel',
            'stok' => 43
        ]);
        Book::create([
            'judul' => 'Harry Potter dan Batu Bertuah',
            'penulis' => 'J.K.Rowling',
            'penerbit' => 'Gramedia',
            'kategori' => 'Novel',
            'stok' => 0
        ]);
        transactions::create([
            'user_id' => $siswa1->id,
            'book_id' => $buku1->id,
            'tanggal_pinjam' => Carbon::now()->subDays(2),
            'tanggal_kembali' => null,
            'status' => 'pinjam'
        ]);

        $buku1->decrement('stok');

        transactions::create([
            'user_id' => $siswa1->id,
            'book_id' => $buku1->id,
            'tanggal_pinjam' => Carbon::now()->subDays(10),
            'tanggal_kembali' => Carbon::now()->subDays(3),
            'status' => 'kembali'
        ]);
    }
}
