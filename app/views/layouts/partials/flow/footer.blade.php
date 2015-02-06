
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>


    <script src="{{asset('assets/js/gnmenu.js')}}"></script>
    <script src="{{asset('assets/js/classie.js')}}"></script>
    <script src="{{asset('assets/js/jquery.sparkline.min.js')}}"></script> 

    <script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
        $('.sparkline').sparkline('html', {
            type: 'pie',
            height: '4em',
            sliceColors: ['#F43829', '#FDB3A7', '#C6C7CA', '#A6D8AE', '#4AB246'],
        });

      
    })



    new gnMenu(document.getElementById('gn-menu'));

    //jQuery for page scrolling feature - requires jQuery Easing plugin
    $(function() {
        $('.gn-menu li a').bind('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
        $('a.scroll').bind('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
    });
    </script>
    </body>
</html>