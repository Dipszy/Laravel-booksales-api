<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Genre Buku - Booksales API</title>
    <style>
        * { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; }
        body { background-color: #f4f6f9; padding: 40px 20px; color: #333; }
        .container { max-width: 900px; margin: 0 auto; background: #ffffff; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.06); padding: 30px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 2px solid #edf2f7; padding-bottom: 15px; }
        h1 { font-size: 24px; color: #2d3748; }
        .nav-links a { text-decoration: none; color: #4a5568; padding: 8px 16px; border-radius: 6px; font-weight: 600; font-size: 14px; margin-left: 8px; transition: all 0.2s; }
        .nav-links a.active, .nav-links a:hover { background-color: #3182ce; color: #ffffff; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #ebf8ff; color: #2b6cb0; text-align: left; padding: 14px 18px; font-size: 14px; font-weight: 700; border-bottom: 2px solid #bee3f8; }
        td { padding: 14px 18px; border-bottom: 1px solid #edf2f7; font-size: 14px; vertical-align: middle; }
        tr:hover { background-color: #f7fafc; }
        .badge-id { display: inline-block; background-color: #e2e8f0; color: #4a5568; font-weight: bold; border-radius: 6px; padding: 4px 10px; font-size: 12px; }
        .genre-name { font-weight: 600; color: #2d3748; }
        .footer { margin-top: 25px; text-align: center; font-size: 13px; color: #a0aec0; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <div>
            <h1>Daftar Genre Buku</h1>
            <p style="font-size: 14px; color: #718096; margin-top: 4px;">Data Array Statis dari Model Genre (MVC Pattern)</p>
        </div>
        <div class="nav-links">
            <a href="{{ url('/genres') }}" class="active">Genre</a>
            <a href="{{ url('/authors') }}">Author</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 10%;">ID</th>
                <th style="width: 30%;">Nama Genre</th>
                <th style="width: 60%;">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($genres as $genre)
                <tr>
                    <td><span class="badge-id">#{{ $genre['id'] }}</span></td>
                    <td class="genre-name">{{ $genre['name'] }}</td>
                    <td style="color: #4a5568; line-height: 1.5;">{{ $genre['description'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center; color: #a0aec0; padding: 30px;">Tidak ada data genre yang tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Praktikum Framework Laravel &bull; Muhamad Iqbal &bull; STT Terpadu Nurul Fikri
    </div>
</div>

</body>
</html>
