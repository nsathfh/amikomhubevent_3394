@extends('layouts.admin', ['title' => 'Scan QR Check-in'])

@section('content')
<header class="flex justify-between items-center mb-10">
    <div>
        <h1 class="text-3xl font-black">Scan QR Check-in</h1>
        <p class="text-slate-500 font-medium">Validasi kehadiran peserta event secara langsung.</p>
    </div>
</header>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Camera/Scanner Box -->
    <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-100 p-6 shadow-sm flex flex-col items-center">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Kamera Scanner</h3>
        <div id="reader" class="w-full rounded-2xl overflow-hidden border border-slate-200" style="max-width: 500px;"></div>
        
        <div class="w-full mt-6 space-y-4" style="max-width: 500px;">
            <p class="text-center text-slate-400 font-bold text-xs uppercase">Atau masukkan Order ID secara manual</p>
            <div class="flex gap-4">
                <input type="text" id="manual_order_id" placeholder="TRX-XXXXXXXXXX" class="flex-1 px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none font-mono uppercase font-bold text-center">
                <button type="button" id="btn_manual_checkin" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold transition">Check-in</button>
            </div>
        </div>
    </div>

    <!-- Scanner Result Logs -->
    <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm flex flex-col">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Hasil Validasi</h3>
        <div id="scan-result" class="flex-1 flex flex-col items-center justify-center p-6 text-center border-2 border-dashed border-slate-100 rounded-2xl min-h-[300px]">
            <div id="result-icon" class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-4 text-slate-400">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m0 11v.01M5.938 9.563l-.75-2.585A1.996 1.996 0 017.113 4.5h9.774a1.996 1.996 0 011.925 2.478l-.75 2.585M9 13h6m-3-3v3m-9 8h18"></path>
                </svg>
            </div>
            <h4 id="result-title" class="font-bold text-lg text-slate-700">Menunggu scan...</h4>
            <p id="result-desc" class="text-sm text-slate-400 mt-2 font-medium">Arahkan kamera ponsel Anda ke QR Code peserta.</p>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", 
        { 
            fps: 10, 
            qrbox: { width: 250, height: 250 },
            rememberLastUsedCamera: true
        },
        /* verbose= */ false
    );

    function onScanSuccess(decodedText, decodedResult) {
        // Hentikan scan sementara agar tidak duplikat trigger
        html5QrcodeScanner.clear();
        submitCheckIn(decodedText);
    }

    function onScanFailure(error) {
        // Kegagalan scanning kecil dilewati saja
    }

    html5QrcodeScanner.render(onScanSuccess, onScanFailure);

    // Manual checkin
    document.getElementById('btn_manual_checkin').addEventListener('click', function() {
        const orderId = document.getElementById('manual_order_id').value.trim();
        if (orderId) {
            submitCheckIn(orderId);
        }
    });

    function submitCheckIn(orderId) {
        const resultDiv = document.getElementById('scan-result');
        const iconDiv = document.getElementById('result-icon');
        const titleH = document.getElementById('result-title');
        const descP = document.getElementById('result-desc');

        // Loading state
        resultDiv.className = "flex-1 flex flex-col items-center justify-center p-6 text-center border-2 border-dashed border-indigo-100 bg-indigo-50/20 rounded-2xl min-h-[300px] animate-pulse";
        iconDiv.className = "w-20 h-20 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mb-4";
        iconDiv.innerHTML = `<svg class="w-10 h-10 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 7.89L21 9m-9 11v-3"></path></svg>`;
        titleH.textContent = "Sedang memproses...";
        descP.textContent = "Melakukan verifikasi tiket " + orderId;

        fetch('{{ route('admin.checkin.process') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ order_id: orderId })
        })
        .then(res => res.json())
        .then(data => {
            // Restore scanner setelah 3 detik
            setTimeout(() => {
                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            }, 3000);

            if (data.success) {
                resultDiv.className = "flex-1 flex flex-col items-center justify-center p-6 text-center border-2 border-emerald-500 bg-emerald-50 rounded-2xl min-h-[300px] transition-all";
                iconDiv.className = "w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mb-4";
                iconDiv.innerHTML = `<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>`;
                titleH.textContent = data.message;
                titleH.className = "font-black text-xl text-emerald-800";
                descP.innerHTML = `
                    <div class="mt-4 space-y-1">
                        <p class="font-bold text-slate-800 text-lg">${data.customer_name}</p>
                        <p class="text-sm text-slate-600">${data.event_title}</p>
                        <p class="text-xs text-slate-400 mt-2 font-mono">Pukul: ${data.time}</p>
                    </div>
                `;
            } else {
                const isDoubleEntry = data.message.includes('Double Entry');
                resultDiv.className = `flex-1 flex flex-col items-center justify-center p-6 text-center border-2 ${isDoubleEntry ? 'border-amber-500 bg-amber-50' : 'border-rose-500 bg-rose-50'} rounded-2xl min-h-[300px] transition-all`;
                iconDiv.className = `w-20 h-20 ${isDoubleEntry ? 'bg-amber-100 text-amber-600' : 'bg-rose-100 text-rose-600'} rounded-full flex items-center justify-center mb-4`;
                iconDiv.innerHTML = `<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>`;
                titleH.textContent = data.message;
                titleH.className = `font-black text-lg ${isDoubleEntry ? 'text-amber-800' : 'text-rose-800'}`;
                descP.textContent = "Silakan periksa kembali tiket peserta.";
            }
        })
        .catch(err => {
            console.error(err);
            setTimeout(() => {
                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            }, 3000);

            resultDiv.className = "flex-1 flex flex-col items-center justify-center p-6 text-center border-2 border-rose-500 bg-rose-50 rounded-2xl min-h-[300px]";
            iconDiv.className = "w-20 h-20 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center mb-4";
            iconDiv.innerHTML = `<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>`;
            titleH.textContent = "Terjadi kesalahan koneksi!";
            descP.textContent = "Silakan ulangi scan.";
        });
    }
});
</script>
@endsection
