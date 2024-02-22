<form id="form" action="{{ route('transactions.update', ['transaction' => $transaction->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3" id="nominal">
        <label class="form-label" for="nominal">Nominal</label>
        <input type="text" name="nominal" value="{{ old('nominal') ?? $transaction->nominal }}"
            class="form-control @error('nominal') is-invalid @enderror">

    </div>

    <div class="mb-3" id="keterangan">
        <label class="form-label" for="keterangan">Keterangan</label>
        <input type="text" name="keterangan" value="{{ old('keterangan') ?? $transaction->keterangan }}"
            class="form-control @error('keterangan') is-invalid @enderror">

    </div>
    <div class="mb-3" id="status">
        <label class="form-label">Status</label>
        @can('create', App\Models\Donatur::class)
            <div class="d-flex">
                <select class="form-select" name="status" aria-label="Default select example">
                    <option value="" selected>Daftar</option>
                    <option value="rekam" {{ old('status') ?? $transaction->status == 'rekam' ? 'selected' : '' }}>Rekam
                    </option>
                    <option value="validasi" {{ old('status') ?? $transaction->status == 'validasi' ? 'selected' : '' }}>
                        Validasi</option>
                    <option value="setuju" {{ old('status') ?? $transaction->status == 'setuju' ? 'selected' : '' }}>
                        Setuju</option>
                </select>
            </div>
        @endcan

        @cannot('create', App\Models\Donatur::class)
            <p>{{$transaction->status}}</p>
        @endcannot
    </div>
    <button type="submit" class="btn btn-primary">Ubah</button>
    <button type="button" onclick="hapus({{ $transaction->id }})" class="btn btn-danger">Hapus</button>

</form>



<script>
    $('#form').submit(function(e) {
        e.preventDefault();
        // $(".form-group").removeClass("has-error");
        $(".text-danger").remove();

        var url = $(this).attr("action");
        let formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                alert('Form submitted successfully');
                location.reload();
            },
            error: function(response) {
                console.log(response.responseJSON.errors);
                $.each(response.responseJSON.errors, function(key, value) {
                    $("#" + key).append(
                        '<div class="text-danger">' + value + "</div>"
                    );

                });
            }
        });

    });

    function hapus(id) {
        confirmText = "Yakin mau diHapus ??";
        if (confirm(confirmText)) {
            $.post("/transactions/" + id, {
                "_method": "DELETE",
                "_token": "{{ csrf_token() }}"
            }, function(a) {
                console.log(a);
            }).fail(function(e) {
                console.log(e);
            }).done(function(s) {
                alert(s.success);
                location.reload();
            })
        }
        return false;

    }
</script>
