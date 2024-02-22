<form id="form" action="{{route('user.update', ['user' => $user->id])}}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">{{ __('Name') }}</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ old('name') ?? $user->name }}" autocomplete="name" autofocus placeholder="Enter your name">

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">{{ __('Email Address') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') ?? $user->email }}" autocomplete="email" placeholder="Enter your email">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Ubah</button>
    <button type="button" onclick="hapus({{ $user->id }})" class="btn btn-danger">Hapus</button>

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
            $.post("/user/" + id, {
                "_method": "DELETE",
                "_token": "{{ csrf_token() }}"
            }, function(a) {
                console.log(a);
            }).fail(function(e) {
                console.log(e);
            }).done(function(s) {
                location.reload();
            })
        }
        return false;

    }
</script>
