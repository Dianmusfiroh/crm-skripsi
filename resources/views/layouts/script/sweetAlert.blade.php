<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    // post form
    $(document).ready(function() {
        $('#yourForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: '{{ route("${modul}.store") }}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'data': $('#yourForm').serialize(),
                },
                // data: ,
                // dataType: 'json',
                success: function(response) {
                    swal({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',

                    }, function() {
                        // location.reload();
                        alert(response);
                    });
                },
                error: function(error) {
                    // Menampilkan SweetAlert dengan pesan kesalahan
                    swal({
                        title: 'Error',
                        text: 'Terjadi kesalahan. Silakan coba lagi.',
                        icon: 'error',
                    });
                }
            });
        });
        $('#createAnotherPage').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: '{{ route("${modul}.store") }}',

                data: $('#createAnotherPage').serialize(),
                dataType: 'json',
                success: function(response) {
                    swal({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',

                    }, function() {
                        window.location.href = '{{ route($modul . '.index') }}';

                    });
                },
                error: function(error) {
                    // Menampilkan SweetAlert dengan pesan kesalahan
                    swal({
                        title: 'Error',
                        text: 'Terjadi kesalahan. Silakan coba lagi.',
                        icon: 'error',
                    });
                }
            });
        });
        $('#createBook').submit(function(event) {
            event.preventDefault();
            let formData = new FormData(this);
    
            $.ajax({
                type:'POST',
                url: "{{ route("${modul}.store") }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    swal({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',

                    }, function() {
                        window.location.href = '{{ route($modul . '.index') }}';

                    });
                },
                error: function(error) {
                    // Menampilkan SweetAlert dengan pesan kesalahan
                    swal({
                        title: 'Error',
                        text: 'Terjadi kesalahan. Silakan coba lagi.',
                        icon: 'error',
                    });
                }
            });
        });
        $('#imageInput').change(function () {
            var input = this;
            var image = input.files[0];

            if (image) {
                var img = new Image();
                img.onload = function () {
                console.log(img.width);
                console.log(img.height);

                    if (img.width => 350 || img.height => 250) {

                        alert('Image must have a minimum width of 300 pixels and a minimum height of 200 pixels.');
                        // $('#createBook')[0].reset();
                    } else {
                        // $('#createBook').text('');
                        alert('ada');
                    }
                };

                img.src = URL.createObjectURL(image);
            }
        });
        //edit
        $('#editForm').submit(function(event) {
            event.preventDefault();
            var id = $(this).attr("data-id");
            var url = '{{ route($modul . '.update', ':id') }}';
            url = url.replace(':id', id);
            var data = {
                '_token': $('input[name=_token]').val(),
                '_method': $('input[name=_method]').val(),
                'data': $('#editForm').serialize()
            };
            $.ajax({
                type: 'PUT',
                url: '{{ route($modul. '.update', '1') }},
                data: data,
                // data: {_token: '{{ csrf_token() }}', data: $('#editForm').serialize()},
                dataType: 'json',
                success: function(response) {
                    swal({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',

                    }, function() {
                        window.location.href = '{{ route($modul . '.index') }}';
                    });
                },
                error: function(error) {
                    // Menampilkan SweetAlert dengan pesan kesalahan
                    swal({
                        title: 'Error',
                        text: 'Terjadi kesalahan. Silakan coba lagi.',
                        icon: 'error',
                    });
                }
            });
        });
 
    });

    // $('#createPetugas').submit(function(event) {
    //     event.preventDefault();
    //     $.ajax({
    //         type: 'POST',
    //         url: '{{ route("petugas.store") }}',
    //         data: $('#createPetugas').serialize(),
    //         dataType: 'json',
    //         success: function(response) {
    //             swal({
    //                 title: 'Success',
    //                 text: response.message,
    //                 icon: 'success',

    //             }, function() {
    //                 // window.location.href = '{{ route($modul . '.index') }}';

    //             });
    //         },
    //         error: function(error) {
    //             // Menampilkan SweetAlert dengan pesan kesalahan
    //             swal({
    //                 title: 'Error',
    //                 text: 'Terjadi kesalahan. Silakan coba lagi.',
    //                 icon: 'error',
    //             });
    //         }
    //     });
    // });
</script>
