<script>
    try {
        onScan.attachTo(document, {
            suffixKeyCodes: [13]
            , onScan: function(code) {
                console.log(code);
                window.livewire.emit('scan-code', code)
            },

            onScanError: function(e) {
                console.log(e)

            }
        })

        console.log('Scanner ready');

    } catch (e) {
        console.log('Error de lectura: ', e)
    }

</script>
