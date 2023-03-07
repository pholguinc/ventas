<script>
    document.addEventListener('DOMContentLoaded', function() {

        livewire.on('scan-ok', msg => {
            //mensaje de confirmacion
        })

        livewire.on('scan-notfound', msg => {
            //mensaje de confirmacion2
        })

        livewire.on('no-stock', msg => {
            //mensaje de confirmacion
        })

        livewire.on('sale-error', msg => {
            //mensaje de confirmacion
        })

        livewire.on('print-ticket', msg => {
            window.open("print://" + saleId, '_blank')
        })
    })

</script>
