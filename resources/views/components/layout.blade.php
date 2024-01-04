<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CREATIVE CODER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
</head>

<body id="home">
    <x-navbar></x-navbar>
    {{ $slot }}
    <!-- footer -->
    <x-footer />
    <!-- Boostrap script -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
    <!-- ckeditor -->
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('.editor'), {
                // Editor configuration.
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(handleSampleError);

        function handleSampleError(error) {
            const issueUrl = 'https://github.com/ckeditor/ckeditor5/issues';

            const message = [
                'Oops, something went wrong!',
                `Please, report the following error on ${ issueUrl } with the build id "jwak0kjlrv9-vgerpv3c2fqz" and the error stack trace:`
            ].join('\n');

            console.error(message);
            console.error(error);
        }
    </script>
</body>

</html>