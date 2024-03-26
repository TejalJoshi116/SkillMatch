<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Image Slider | With Manual Buttons and Autoplay Navigation Visibility</title>

    <style>
        <?php include "slidestyle.css"; ?>
    </style>
</head>
<body>

<div class="img-slider">
    <div class="slide active">
        <img src="images/skill1.jpg" alt="Skill 1" width="500px" height="500px">
    </div>
    <div class="slide">
        <img src="images/skill2.jpg" alt="Skill 2" width="500px" height="500px">
    </div>
    <div class="slide">
        <img src="images/skill3.jpg" alt="Skill 3" width="500px" height="500px">
    </div>
    <!-- Add more slides with static content as needed -->

    <div class="navigation">
        <div class="btn active"></div>
        <div class="btn"></div>
        <div class="btn"></div>
        <!-- Add more buttons for additional slides -->
    </div>
</div>

<script type="text/javascript">
    var slides = document.querySelectorAll('.slide');
    var btns = document.querySelectorAll('.btn');
    let currentSlide = 1;

    // Javascript for image slider manual navigation
    var manualNav = function(manual){
        slides.forEach((slide) => {
            slide.classList.remove('active');

            btns.forEach((btn) => {
                btn.classList.remove('active');
            });
        });

        slides[manual].classList.add('active');
        btns[manual].classList.add('active');
    }

    btns.forEach((btn, i) => {
        btn.addEventListener("click", () => {
            manualNav(i);
            currentSlide = i;
        });
    });

    // Javascript for image slider autoplay navigation
    var repeat = function(activeClass){
        let active = document.getElementsByClassName('active');
        let i = 1;

        var repeater = () => {
            setTimeout(function(){
                [...active].forEach((activeSlide) => {
                    activeSlide.classList.remove('active');
                });

                slides[i].classList.add('active');
                btns[i].classList.add('active');
                i++;

                if(slides.length == i){
                    i = 0;
                }
                if(i >= slides.length){
                    return;
                }
                repeater();
            }, 10000);
        }
        repeater();
    }
    repeat();
</script>

</body>
</html>
