<form method="post" action="{{ route('transactions.export') }}" enctype="" id="formKu" name="">
    @csrf
    <div class="mb-3">
        <label for="bulan" class="form-label">Bulan</label>
        <select class="form-select" aria-label="Default select example" id="bulan" name="bulan">
            <option value="" selected>Pilih Bulan</option>
            @php
                $nama_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            @endphp
            @for ($a = 0; $a < 12; $a++)
                <option value="{{ str_pad($a + 1, 2, '0', STR_PAD_LEFT) }}">{{ $nama_bulan[$a] }}</option>
            @endfor
        </select>
    </div>
    <div class="mb-3">
        <label for="tahun" class="form-label">Tahun</label>
        <input type="number" class="form-control" name="tahun" min="{{ date('Y') - 2 }}" max="{{ date('Y') }}"
            step="1" value="{{ date('Y') }}" />
    </div>
    <button type="submit" class="btn btn-sm btn-info"> Export</button>
</form>

<script>
    const form = document.forms.formKu;
    $('document').ready(function() {

        // console.log(form);

    })
    form.addEventListener("submit", function(e) {
        // console.log(e.type);
        e.preventDefault();

        var url = $(this).attr("action");
        let formData = new FormData(this);

        // console.log(typeof formData);
        // console.log(formData);
        const data_ku = new Array;
        for (var p of formData) {
            let name = p[0];
            let value = p[1];
            data_ku[name] = value;
        }
        // console.log(data_ku['bulan']);
        if (data_ku['bulan'] == '') {
            alert('Data bulan belum dipilih');
        }
        if (data_ku['tahun'] == '') {
            alert('Data tahun belum dipilih');
        }
        // $.post('/transactions-export', {formData}, function(x) {
        //     console.log(x)
        // }).done(function(){

        // }).fail(function(){
        //     alert(`Error`);
        // })
        $.ajax({
            xhrFields: {
                responseType: 'blob',
            },
            type: 'POST',
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: (result, status, xhr) => {
                var disposition = xhr.getResponseHeader('content-disposition');
                var matches = /"([^"]*)"/.exec(disposition);
                var filename = (matches != null && matches[1] ? matches[1] : 'transaksi '+data_ku['bulan']+'Tahun'+data_ku['tahun']+'.xlsx');

                // The actual download
                var blob = new Blob([result], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = filename;

                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            },
            error: function(response) {
                console.log(response.responseJSON.errors);
            }
        });

    });
</script>
