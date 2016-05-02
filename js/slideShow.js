$(document).ready(function () {
    var currentPosition = 0;
    var s = $('.slide').css("width").substring(0, $('.slide').css("width").length - 2);
    var slideWidth = parseInt(s);
    var slides = $('.slide');
    var numberOfSlides = slides.length;
    var intervalID = 0;

    // Remove scrollbar in JS
    $('#slidesContainer').css('overflow', 'hidden');

    // Wrap all .slides with #slideInner div
    slides
    .wrapAll('<div id="slideInner"></div>')
    // Float left to display horizontally, readjust .slides width
    .css({
        'float': 'left',
        'width': slideWidth
    });

    // Set #slideInner width equal to total width of all slides
    $('#slideInner').css('width', slideWidth * numberOfSlides);

    // Insert left and right arrow controls in the DOM
    $('#slideshow')
      .prepend('<span class="control" id="leftControl">Move left</span>')
      .append('<span class="control" id="rightControl">Move right</span>');

    // Hide left arrow control on first load
    manageControls(currentPosition);

    // Create event listeners for .controls clicks
    $('.control')
      .bind('click', function () {
          window.clearInterval(intervalID);

          // Determine new position
          currentPosition = ($(this).attr('id') == 'rightControl')
        ? currentPosition + 1 : currentPosition - 1;

          // Hide / show controls
          manageControls(currentPosition);
          // Move slideInner using margin-left
          $('#slideInner').animate({
              'marginLeft': slideWidth * (-currentPosition)
          });
      });

    // Create event listeners for .navItem clicks
    $('.navItem')
      .bind('click', function () {
          window.clearInterval(intervalID);

          // Determine new position
          currentPosition = $('.navItem').index(this);

          // Hide / show controls
          manageControls(currentPosition);
          // Move slideInner using margin-left
          $('#slideInner').animate({
              'marginLeft': slideWidth * (-currentPosition)
          });
      });

    // manageControls: Hides and shows controls depending on currentPosition
    function manageControls(position) {
        $('#selected').removeAttr('id');
        $('.navItem').get(position).id = "selected";
        // Hide left arrow if position is first slide
        if (position == 0) { $('#leftControl').hide() }
        else { $('#leftControl').show() }
        // Hide right arrow if position is last slide
        if (position == numberOfSlides - 1) { $('#rightControl').hide() }
        else { $('#rightControl').show() }
    }

    function intervalTrigger() {
        return window.setInterval(function () {
            if (currentPosition < numberOfSlides - 1)
                currentPosition++;
            else
                currentPosition = 0;
            manageControls(currentPosition);
            // Move slideInner using margin-left
            $('#slideInner').animate({
                'marginLeft': slideWidth * (-currentPosition)
            });
        }, 8000);
    };

    intervalID = intervalTrigger();
});