<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku - Booksales API</title>
    <style>
        * { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; }
        body { background-color: #f4f6f9; padding: 40px 20px; color: #333; }
        .container { max-width: 1050px; margin: 0 auto; background: #ffffff; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.06); padding: 30px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 2px solid #edf2f7; padding-bottom: 15px; }
        h1 { font-size: 24px; color: #2d3748; }
        .nav-links a { text-decoration: none; color: #4a5568; padding: 8px 16px; border-radius: 6px; font-weight: 600; font-size: 14px; margin-left: 8px; transition: all 0.2s; }
        .nav-links a.active, .nav-links a:hover { background-color: #3182ce; color: #ffffff; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #ebf8ff; color: #2b6cb0; text-align: left; padding: 14px 18px; font-size: 14px; font-weight: 700; border-bottom: 2px solid #bee3f8; }
        td { padding: 14px 18px; border-bottom: 1px solid #edf2f7; font-size: 14px; vertical-align: middle; }
        tr:hover { background-color: #f7fafc; }
        .badge-id { display: inline-block; background-color: #e2e8f0; color: #4a5568; font-weight: bold; border-radius: 6px; padding: 4px 10px; font-size: 12px; }
        .book-cover { width: 50px; height: 70px; border-radius: 6px; object-fit: cover; box-shadow: 0 2px 5px rgba(0,0,0,0.15); }
        .book-title { font-weight: 700; color: #2d3748; margin-bottom: 4px; }
        .author-tag { display: inline-block; background-color: #e6fffa; color: #234e52; font-size: 12px; font-weight: 600; padding: 3px 8px; border-radius: 4px; }
        .price-tag { font-weight: 700; color: #2f855a; }
        .stock-badge { display: inline-block; padding: 3px 8px; border-radius: 12px; font-size: 12px; font-weight: 600; background-color: #feebc8; color: #7b341e; }
        .footer { margin-top: 25px; text-align: center; font-size: 13px; color: #a0aec0; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <div>
            <h1>Daftar Buku (Books)</h1>
            <p style="font-size: 14px; color: #718096; margin-top: 4px;">Data Database dari Hasil Laravel Migration & Seeder</p>
        </div>
        <div class="nav-links">
            <a href="{{ url('/books') }}" class="active">Daftar Buku</a>
            <a href="{{ url('/authors') }}">Daftar Penulis</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 6%;">ID</th>
                <th style="width: 8%;">Cover</th>
                <th style="width: 28%;">Judul Buku</th>
                <th style="width: 18%;">Penulis (Author)</th>
                <th style="width: 15%;">Harga</th>
                <th style="width: 10%;">Stok</th>
                <th style="width: 15%;">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
                <tr>
                    <td><span class="badge-id">#{{ $book->id }}</span></td>
                    <td>
                        <img src="{{ $book->cover_photo }}" alt="{{ $book->title }}" class="book-cover">
                    </td>
                    <td>
                        <div class="book-title">{{ $book->title }}</div>
                    </td>
                    <td>
                        <span class="author-tag">✍ {{ $book->author ? $book->author->name : 'N/A' }}</span>
                    </td>
                    <td class="price-tag">
                        Rp {{ number_format($book->price, 0, ',', '.') }}
                    </td>
                    <td>
                        <span class="stock-badge">{{ $book->stock }} pcs</span>
                    </td>
                    <td style="color: #718096; font-size: 13px; line-height: 1.4;">
                        {{ $book->description }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #a0aec0; padding: 30px;">Tidak ada data buku yang tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Praktikum Laravel Migration & Seeder &bull; Muhamad Iqbal &bull; STT Terpadu Nurul Fikri
    </div>
</div>

</body>
</html>
