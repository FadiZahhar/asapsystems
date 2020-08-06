function openIndustry(evt, sectionName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the link that opened the tab
  document.getElementById(sectionName).style.display = "block";
  evt.currentTarget.className += " active";
}

$(function () {
  // Cache the Window object
  var $window = $(window);
  var onetime = true;

  var lineBar = new ProgressBar.Line(".line1", {
    strokeWidth: 2,
    easing: "easeInOut",
    duration: 1400,
    color: "#FFEA82",
    trailColor: "#eee",
    trailWidth: 2,
    svgStyle: { width: "100%", height: "100%" },
    from: { color: "#3f95d3" },
    to: { color: "#67bb85" },
    step: (state, bar) => {
      bar.path.setAttribute("stroke", state.color);
    },
  });

  var lineBar2 = new ProgressBar.Line(".line2", {
    strokeWidth: 2,
    easing: "easeInOut",
    duration: 1400,
    color: "#FFEA82",
    trailColor: "#eee",
    trailWidth: 2,
    svgStyle: { width: "100%", height: "100%" },
    from: { color: "#3f95d3" },
    to: { color: "#67bb85" },
    step: (state, bar) => {
      bar.path.setAttribute("stroke", state.color);
    },
  });

  $(window).scroll(function () {
    var scroll = $(window).scrollTop();

    if (scroll >= 3800 && scroll <= 3900 && onetime == true) {
      onetime = false;

      lineBar.animate(0.4, {
        duration: 1000,
      });

      lineBar2.animate(0.8, {
        duration: 1000,
      });

      /* count code for number */
      $(".count").each(function () {
        $(this)
          .prop("Counter", 0)
          .animate(
            {
              Counter: $(this).text(),
            },
            {
              duration: 4000,
              easing: "swing",
              step: function (now) {
                $(this).text(Math.ceil(now));
              },
            }
          );
      });
    }
  });
  // Parallax Backgrounds
  // Tutorial: http://code.tutsplus.com/tutorials/a-simple-parallax-scrolling-technique--net-27641

  $('section[data-type="background"]').each(function () {
    var $bgobj = $(this); // assigning the object

    $(window).scroll(function () {
      var scroll = $(window).scrollTop();
      console.log(scroll);
      // Scroll the background at var speed
      // the yPos is a negative value because we're scrolling it UP!
      var yPos = -($window.scrollTop() / $bgobj.data("speed"));
      console.log(yPos);
      // Put together our final background position
      var coords = "50% " + yPos + "px";

      // Move the background
      $bgobj.css({ backgroundPosition: coords });
    }); // end window scroll
  });

  //openIndustry("click", "Military");
});
