{{-- <button id="print-ticket" onclick="printTicket('{{ $order->pdf_path }}')">   --}}
<button id="print-ticket" onclick="printTicket('{{ $order->pdf_path }}')">  
  <img class="h-6" src="/storage/img/icons/pdf.svg" alt="">  
</button>  

{{-- @push('js')  
  <script>  
    function printTicket(pdfPath) {  
      // Redirigir a la URL del PDF  
      window.location.href = pdfPath;   
    }  
  </script>  
@endpush --}}