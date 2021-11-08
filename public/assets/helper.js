$(document).ready(function() {
    $(".logout-btn").click(function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You can login again in this system!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout it!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Logout!',
                    'Successfully logout from this system.',
                    'success'
                )
                setTimeout(function() {
                    document.getElementById('logout-form').submit();
                }, 1000); //2 second
            }
        })
    });

    // Listen for click on toggle checkbox
    $('.select-all').click(function(event) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = true;
        }
    });

    $('.un-select-all').click(function(event) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = false;
        }
    });

    // Image chose related code
    $(".image-chose-btn").click(function() {
        // console.log($(this).parentsUntil(".middle-image-helper").find('.image-importer'));
        $(this).parentsUntil(".middle-image-helper").find('.image-importer').click();
    })

    //Display image
    $(".image-importer").change(function(event) {
            if (event.target.files.length > 0) {
                $(this).parentsUntil(".middle-image-helper").find('.image-display').attr("src", URL.createObjectURL(event.target.files[0]));
            }
        })
        //Reset image
    $(".image-reset-btn").click(function() {
        $(this).parentsUntil(".middle-image-helper").find('.image-display').attr("src", $(this).val());
        $(this).parentsUntil(".middle-image-helper").find('.image-importer').val('');
    })
});


function previewImages() {
    var preview = document.querySelector('#preview');
    if (this.files) {
        [].forEach.call(this.files, readAndPreview);
    }

    function readAndPreview(file) {
        // Make sure `file.name` matches our extensions criteria
        if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
            return alert(file.name + " is not an image");
        } // else...
        var reader = new FileReader();
        reader.addEventListener("load", function() {
            var image = new Image();
            image.height = 100;
            image.title = file.name;
            image.src = this.result;
            preview.appendChild(image);
        });
        reader.readAsDataURL(file);
    }
}
document.querySelector('#image').addEventListener("change", previewImages);

function delete_function(objButton) {
    var url = objButton.value;
    // alert(objButton.value)
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                method: 'DELETE',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.type == 'success') {

                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted. ' + data.message,
                            'success'
                        )
                        if (data.url) {
                            setTimeout(function() {
                                location.replace(data.url);
                            }, 800); //
                        } else {
                            setTimeout(function() {
                                location.reload();
                            }, 800); //
                        }
                    } else {
                        Swal.fire(
                            'Wrong!',
                            'Something going wrong. ' + data.message,
                            'warning'
                        )
                    }
                },
            })
        }
    })
}