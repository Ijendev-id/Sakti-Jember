<!-- resources/views/kunjungan/detail-riwayat.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Riwayat – SAKTI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:Inter,Arial,Roboto; background:#fafbfd; color:#10282b; padding-bottom:92px;}
        .wrap{max-width:520px;margin:0 auto;padding:12px}
        header{display:flex;align-items:center;justify-content:space-between;padding:8px 4px 12px;border-bottom:1px solid rgba(0,0,0,0.06);background:#fff;position:sticky;top:0;z-index:30}
        header h1{font-size:18px;font-weight:700}
        .card{background:#fff;border-radius:8px;padding:12px;margin-top:12px;box-shadow:0 8px 24px rgba(12,30,34,0.04)}
        .label{font-weight:700;margin-bottom:6px;color:#163033}
        .value{background:#f1f4f5;padding:10px;border-radius:6px;color:#163033}
        .row{margin-bottom:12px}
        .btn-warning{background:#f6c300;color:#0b0b0b;padding:8px 12px;border-radius:8px;border:0;font-weight:700}
        .status-badge{display:inline-block;padding:8px 12px;border-radius:8px;color:#fff;font-weight:700}
        .status-follow { background:#f39c12; }
        .status-closing { background:#2f9e71; }
        .status-tdk { background:#e74c3c; }
        .produk-list{display:flex;flex-direction:column;gap:8px;margin-top:6px}
        .produk-item{display:flex;gap:8px;align-items:center}
        .coord-row{display:flex;gap:8px;align-items:center;justify-content:space-between}
        .map-link{background:#ffd400;padding:8px 10px;border-radius:6px;color:#000;font-weight:700;border:0}
    </style>
</head>
<body>
    <div class="wrap">
        <header>
            <h1>Riwayat Kunjungan</h1>
            <div style="display:flex;gap:8px;align-items:center">
                <a href="javascript:history.back()" title="Kembali" style="color:#2f5b68;text-decoration:none"><i class="fa-solid fa-arrow-left"></i></a>
            </div>
        </header>

        <div class="card" id="detailCard" aria-live="polite">
            <!-- konten akan di-render via server-side jika $kunjungan tersedia, atau JS fallback membaca sessionStorage -->
            @if(isset($kunjungan))
                <div class="row">
                    <div class="label">Nama Nasabah</div>
                    <div class="value">{{ $kunjungan->namaNasabah ?? $kunjungan->nama ?? '-' }}</div>
                </div>
                <div class="row">
                    <div class="label">Alamat Lengkap</div>
                    <div class="value">{{ $kunjungan->alamat ?? '-' }}</div>
                </div>
                <div class="row">
                    <div class="label">Tanggal Kunjungan</div>
                    <div class="value">{{ $kunjungan->tanggal ?? $kunjungan->created_at ?? '-' }}</div>
                </div>
                <div class="row">
                    <div class="label">Nomor Rekening</div>
                    <div class="value">{{ $kunjungan->no_rekening ?? '-' }}</div>
                </div>
                <div class="row">
                    <div class="label">Nomor CIF</div>
                    <div class="value">{{ $kunjungan->no_cif ?? '-' }}</div>
                </div>
                <div class="row">
                    <div class="label">Titik Koordinat</div>
                    <div class="coord-row">
                        <div class="value">{{ $kunjungan->koordinat ?? '-' }}</div>
                        <button class="map-link" onclick="openMap('{{ $kunjungan->koordinat ?? '' }}')">CEK PETA</button>
                    </div>
                </div>
                <div class="row">
                    <div class="label">Status Kunjungan</div>
                    <div>
                        @php
                            $st = strtoupper($kunjungan->status ?? '');
                            $cls = 'status-follow';
                            if(str_contains($st,'CLOS')) $cls='status-closing';
                            else if(str_contains($st,'TDK')) $cls='status-tdk';
                        @endphp
                        <div class="status-badge {{ $cls }}">{{ $kunjungan->status ?? 'FOLLOW-UP' }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="label">Produk yang Ditawarkan</div>
                    <div class="produk-list">
                        @if(isset($kunjungan->produk) && is_array($kunjungan->produk))
                            @foreach($kunjungan->produk as $p)
                                <div class="produk-item"><input type="checkbox" disabled {{ $p['checked'] ?? true ? 'checked' : '' }}> <div>{{ $p['nama'] ?? 'Produk' }}</div></div>
                            @endforeach
                        @else
                            <div class="value">{{ $kunjungan->produk ?? '-' }}</div>
                        @endif
                    </div>
                </div>
            @else
                <!-- fallback: JS will render -->
                <div id="jsFallback"></div>
            @endif
        </div>
    </div>

    <script>
        function openMap(coord) {
            if (!coord) { alert('Koordinat tidak tersedia'); return; }
            // asumsi format "-6.2,106.8" atau "-6.200000,106.816696"
            const c = coord.toString().replace(/\s+/g,'');
            const parts = c.split(/[ ,]+/);
            if (parts.length < 2) { alert('Format koordinat tidak valid'); return; }
            const lat = parts[0], lng = parts[1];
            const url = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(lat + ',' + lng)}`;
            window.open(url, '_blank');
        }

        // fallback ketika controller tidak mengirim data:
        (function(){
            const fallbackEl = document.getElementById('jsFallback');
            if (!fallbackEl) return;
            try {
                const raw = sessionStorage.getItem('selected_riwayat');
                if (!raw) { fallbackEl.innerHTML = '<div class="empty">Data detail tidak tersedia.</div>'; return; }
                const d = JSON.parse(raw);
                const html = [];
                html.push(`<div class="row"><div class="label">Nama Nasabah</div><div class="value">${escapeHtml(d.namaNasabah||d.nama||'-')}</div></div>`);
                html.push(`<div class="row"><div class="label">Alamat Lengkap</div><div class="value">${escapeHtml(d.alamat||d.lokasi||'-')}</div></div>`);
                html.push(`<div class="row"><div class="label">Tanggal Kunjungan</div><div class="value">${escapeHtml(d.tanggal||d.timestamp||'-')}</div></div>`);
                html.push(`<div class="row"><div class="label">Nomor Rekening</div><div class="value">${escapeHtml(d.no_rekening||d.noRek||d.nomorRekening||'-')}</div></div>`);
                html.push(`<div class="row"><div class="label">Nomor CIF</div><div class="value">${escapeHtml(d.no_cif||d.cif||'-')}</div></div>`);
                const coord = d.koordinat || d.titik || (d.latitude && d.longitude ? (d.latitude+','+d.longitude) : '-');
                html.push(`<div class="row"><div class="label">Titik Koordinat</div><div class="coord-row"><div class="value">${escapeHtml(coord)}</div><button class="map-link" onclick="openMap('${escapeHtml(coord)}')">CEK PETA</button></div></div>`);
                const st = (d.status || d.statusKunjungan || 'FOLLOW-UP').toUpperCase();
                let cls = 'status-follow';
                if (st.includes('CLOS')) cls='status-closing';
                if (st.includes('TDK')) cls='status-tdk';
                html.push(`<div class="row"><div class="label">Status Kunjungan</div><div><div class="status-badge ${cls}">${escapeHtml(d.status || d.statusKunjungan || 'FOLLOW-UP')}</div></div></div>`);

                // produk
                html.push(`<div class="row"><div class="label">Produk yang Ditawarkan</div><div class="produk-list">`);
                if (Array.isArray(d.produk)) {
                    d.produk.forEach(p => {
                        html.push(`<div class="produk-item"><input type="checkbox" disabled ${p.checked || true ? 'checked' : ''}> <div>${escapeHtml(p.nama || p)}</div></div>`);
                    });
                } else if (typeof d.produk === 'string') {
                    // coba split kalau format "MTB;GIRO;Deposito"
                    const arr = d.produk.split(/[;,|]+/).filter(Boolean);
                    if (arr.length) {
                        arr.forEach(x => html.push(`<div class="produk-item"><input type="checkbox" disabled checked> <div>${escapeHtml(x)}</div></div>`));
                    } else {
                        html.push(`<div class="value">${escapeHtml(d.produk)}</div>`);
                    }
                } else {
                    html.push(`<div class="value">-</div>`);
                }
                html.push(`</div></div>`);

                fallbackEl.innerHTML = html.join('');
            } catch(e) {
                fallbackEl.innerHTML = '<div class="empty">Gagal memuat data detail.</div>';
            }

            function escapeHtml(s){ if(!s) return ''; return String(s).replaceAll('&','&amp;').replaceAll('<','&lt;').replaceAll('>','&gt;').replaceAll('"','&quot;').replaceAll("'",'&#039;'); }
        })();
    </script>
</body>
</html>
