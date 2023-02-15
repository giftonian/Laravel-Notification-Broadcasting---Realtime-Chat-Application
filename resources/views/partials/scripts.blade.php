<script>
    
    function rowHighlighter() {
    $('tbody > tr').mouseenter(function() {
        $(this).addClass('bg-yellow-100');
        });
        $('tbody > tr').mouseleave(function() {
            $(this).removeClass('bg-yellow-100');
        });
    }
    </script>