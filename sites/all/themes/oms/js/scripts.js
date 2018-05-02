(function($) {
    var STNScript = {
        // Equal height function
        // Replace "obj" param with your selector
        equalHeight: function (obj) {
            var currentTallest = 0,
                currentRowStart = 0,
                rowDivs = [],
                $el,
                topPosition = 0;
            $(obj).each(function () {

                $el = $(this);
                $el.height('auto');
                topPostion = $el.offset().top;

                if (currentRowStart != topPostion) {
                    for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                        rowDivs[currentDiv].height(currentTallest);
                    }
                    rowDivs.length = 0;
                    currentRowStart = topPostion;
                    currentTallest = $el.height();
                    rowDivs.push($el);
                } else {
                    rowDivs.push($el);
                    currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
                }
                for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                    rowDivs[currentDiv].height(currentTallest);
                }
            });
        },
        //
        initSlick:function(){

            $('.main-slider .view-content').slick({
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: true,
                dots:true,
                nextArrow: '<div class="arrow arrow-right"><img src="/sites/all/themes/oms/images/arrowRight.png"></div>',
                prevArrow: '<div class="arrow arrow-left"><img src="sites/all/themes/oms/images/arrowLeft.png"></div>',
            })
            $('.block-featured-product .view-content').slick({
                autoplay: false,
                autoplaySpeed: 3500,
                arrows: true,
                dots:false,
                infinite: true,
                slidesToShow: 5,
                slidesToScroll: 5,
                dots:false,
                nextArrow: '<div class="arrow arrow-right"><img src="/sites/all/themes/oms/images/arrowRight.png"></div>',
                prevArrow: '<div class="arrow arrow-left"><img src="sites/all/themes/oms/images/arrowLeft.png"></div>',
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            })
        },

        autoHeight:function(){
            STNScript.equalHeight('.product-items .view-content .views-row');
          },

        createMenuMobile:function(){
            $( "#navigation" ).clone().appendTo( ".mobile-menu-container" );
        },

        /*
         * detect star for display
         */
        detectStar:function() {
            $('.views-field-field-rate').each(function () {
                var rate = parseInt($(this).find('.field-content').text());
                var stars_html = "";
                if (!isNaN(rate) || rate > 1) {
                    for (var i = 1; i <= 5; i++) {
                        if (i <= rate) {
                            stars_html += '<span class="star star-active"></span>';
                        } else {
                            stars_html += '<span class="star"></span>';
                        }
                    }
                    $(this).html(stars_html);
                }

            })
        },

        searchClick:function () {
            $('.block-search .title .fa.fa-search').click(function(){
                $('.block-search .content').show();
            })
        },

        moveSlideBarToBottom:function () {
            $('#main>.container>.row>.col-md-3').insertAfter('#main>.container>.row>.col-md-9')
        },
        moveSlideBarToTop:function () {
            $('#main>.container>.row>.col-md-3').insertBefore('#main>.container>.row>.col-md-9')
        },
        isMobile:function () {
            var w=$(window).width();
            if(w<=990){
                return true;
            }
            return false;
        },
        testimonialsEffect:function(){
            $('.block-testimonials .views-row').eq(3).addClass('active');
            $('.block-testimonials .views-field-field-image').click(function () {
                $('.block-testimonials .views-row').removeClass('active');
                $(this).parent().addClass('active');
            })
        },
        attackAjaxComplete:function () {
            $( document ).ajaxSend(function(event, xhr, settings) {

            });
            $( document ).ajaxComplete(function(event, xhr, settings) {

            });
        },
        initMagicZoom:function(){
            $('.node-type-project .node-project .field-name-field-image').magnificPopup(
                {
                    delegate: 'img',
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    callbacks: {
                        elementParse: function(qw) {
                            qw.src = qw.el.attr('src');
                        }
                    }
                });
        },
        menuExpand:function(){
            $('.mobile-menu-container').find('#main-menu >ul>li.expanded>ul.menu').before('<i class="fa fa-plus"></i>');
            $(document).on('click','#main-menu .fa',function () {

                $(this).parent().toggleClass('open');
            })
        }
    }

    $(document).ready(function(){

       /* $('.block-search .fa-search').click(function () {
            $('.block-search .content').show();
        })
        $(document).on("click",function (event) {
            if (!$(event.target).is(".block-search .content .container-inline, #edit-search-block-form--2,.block-search .title .fa.fa-search")) {
                $('.block-search .content').hide();

            }
        })*/
        STNScript.initSlick();
        STNScript.testimonialsEffect();
        STNScript.createMenuMobile();



    })
    $(window).on('load',function(){
        STNScript.autoHeight();
        STNScript.initMagicZoom();
        $(window).resize(function () {
            STNScript.autoHeight();
        })
        STNScript.menuExpand();
    })
})(jQuery)