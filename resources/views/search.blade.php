<div class="container">
    <h2>Cari Kekayaan Intelektual</h2>
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Cari berdasarkan judul, kategori, atau nomor" required>
        <button type="submit">Cari</button>
    </form>
</div>
