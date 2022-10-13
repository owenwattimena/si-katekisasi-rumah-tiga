@extends('web.templates.index')

@section('content')

<div class="container my-5">
    <div id="reader" width="600px"></div>
</div>

@endsection

@section('script')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
    function post(path, params, method = 'post') {

        // The rest of this code assumes you are not using a library.
        // It can be made less verbose if you use one.
        const form = document.createElement('form');
        form.method = method;
        form.action = path;

        for (const key in params) {
            if (params.hasOwnProperty(key)) {
                const hiddenField = document.createElement('input');
                hiddenField.type = 'hidden';
                hiddenField.name = key;
                hiddenField.value = params[key];

                form.appendChild(hiddenField);
            }
        }

        document.body.appendChild(form);
        form.submit();
    }

    $(function() {
        /**
        To ignore Chrome’s secure origin policy, follow these steps. 
        Navigate to chrome://flags/#unsafely-treat-insecure-origin-as-secure in Chrome.

        Find and enable the Insecure origins treated as secure section (see below). 
        Add any addresses you want to ignore the secure origin policy for. 
        Remember to include the port number too (if required). 
        Save and restart Chrome.
         ***/
        let onSuccess = false;
        function onScanSuccess(decodedText, decodedResult) {
            if(onSuccess) return;

            // handle the scanned code as you like, for example:
            // alert(`Code matched = ${decodedText}`, decodedResult);

            var data = {
                '_token': `{{ csrf_token() }}`
                , 'id': decodedText
                , 'id_jadwal': `{{ $id }}`,

            };
            post(`{{ route('jadwal.absen') }}`, data);
            onSuccess = true;
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10
                , qrbox: {
                    width: 250
                    , height: 250
                }
            },
            /* verbose= */
            true);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    });

</script>
@endsection
