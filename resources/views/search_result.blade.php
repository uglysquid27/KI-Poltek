
<div class="container">
    <h2>Hasil Pencarian</h2>
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" value="{{ $query }}" placeholder="Cari lagi..." required>
        <button type="submit">Cari</button>
    </form>

    @if($results->isEmpty())
        <p>Tidak ada hasil ditemukan.</p>
    @else
        <ul>
            @foreach($results as $item)
                <li>
                    <strong>{{ $item->title }}</strong> - {{ $item->category }} ({{ $item->type }})
                    @if($item->hakCipta)
                        <p>Nomor Hak Cipta: {{ $item->hakCipta->hak_cipta_number }}</p>
                    @elseif($item->paten)
                        <p>Nomor Paten: {{ $item->paten->paten_number }}</p>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>
