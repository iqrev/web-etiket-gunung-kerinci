<table class="w-full rounded">
    <thead>
        <tr>
            @foreach ($headers as $h)
                <th class="p-3 gk-bg-base-white font-bold">{{ $h }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
            <tr class="tiket-row">
                <td class="p-3 font-bold">{{$d->nama}}</td>
                <td class="p-3 font-bold">{{$d->kategori->nama}}</td>
                <td class="p-3 font-bold">{{$d->golongan->nama}}</td>
                <td class="p-3 font-bold">{{$d->tipe}}</td>
                <td class="p-3 font-bold">{{$d->destinasi->nama}}</td>
                <td class="p-3 font-bold">{{$d->gk_gate->nama}}</td>
                <td class="p-3 font-bold">{{$d->keterangan}}</td>
                <td class="p-3 font-bold">Rp {{number_format($d->harga)}}</td>
                <td class="p-3 d-flex gap-1">
                        <a  href="{{route('admin.tiket.edit', ['id' => $d->id])}}" class="cursor-pointer shadow-sm"><img width="25" src="{{asset('assets/img/logo/edit.png')}}"/></a>
                        <a onclick="confirmDelete(event, '{{json_encode($d)}}',  `{{ route('admin.tiket.hapus', ['id' => $d->id])}}`)" href="#" class="cursor-pointer shadow-sm"><img width="25" src="{{asset('assets/img/logo/delete.png')}}"/></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    const jenisTiket = ['Weekday', 'Weekend'];
    function confirmDelete(event, data, rute) {
        const el = document.getElementById('modal-container');
        document.getElementById('modal-title').textContent = "Konfirmasi Hapus Tiket"
        const modalBody = document.getElementById('modal-body');
        el.classList.remove("d-none");
        el.classList.add("d-flex")
        data = JSON.parse(data);
        console.log(rute)
        modalBody.innerHTML = "Konfirmasi hapus tiket pada id "+ data['id'] +"?"+`
            <br>
            <div class="row">
                <div class="row"><div class="col-2">Destinasi</div> : ${data.destinasi.nama}</div>
                <div class="row"><div class="col-2">Nama</div> : ${data.nama} </div>
                <div class="row"><div class="col-2">Gate</div> : ${data.gk_gates.nama} </div>
                <div class="row"><div class="col-2">Jenis</div> : ${jenisTiket[data.jenisTiket]} </div>
                <div class="row"><div class="col-2">Harga</div> : ${data.harga} </div>
            </div>
        `;

        const modalTarget = document.getElementById('modal-target');
        modalTarget.classList.remove("bg-primary");
        modalTarget.classList.add("bg-danger");

        const modalForm = document.getElementById('modal-form');
        modalForm.action = rute;
    }
</script>
