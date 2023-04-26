<?php
    $connection = mysqli_connect('127.0.0.1','root','','test');
        if(!$connection){
            echo 'connection error:' . mysqli_connect_error();
        }
    $sql = 'SELECT * FROM test';
    $result = mysqli_query($connection,$sql);
    $fetch = mysqli_fetch_all($result,MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <title>Test</title>
</head>
<body>
    <div class="grey"></div>
    <!--Header-->
    <div class="header">
        <div class="burger-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="left-side">
            <img src = "assets/LOGO.svg" alt="LOGO"/>
            <div class="location">
                    <img src = "assets/pin.svg" alt="pin"/>
                <div class="place-holder">
                    <span class="city">Ростов-на-Дону</span>
                    <span class="address">ул.Ленина, 2Б</span></div>     
                </div>
        </div>
        <div class="right-side">
            <div class="contact">
                <img src = "assets/whatsapp.svg" alt="whatsapp"/>
                <span>+7(863) 000 00 00</span>
            </div>
            <div class="button">
                <span>Записаться на прием</span> 
            </div>
        </div>
        <div class="right-mob">
            <span>+7(863) 000 00 00</span>
            <span class="city">Ростов-на-Дону</span>
        </div>
    </div>
    <!--Menu-->
    <div class="menu">
        <ul class="menu-list">
            <li><a href="#">О клиникеa</a></li>
            <li><a href="#">Услуги</a></li>
            <li><a href="#">Специалисты</a></li>
            <li><a href="#">Цены</a></li>
            <li><a href="#">Контакты</a></li>
        </ul>
        <div class="button">
            <span>Записаться на прием</span> 
        </div>
    </div>
    <!--Hero section-->
    <div class="hero">
        <div class="hero-text">
            <span>Многопрофильная клиника для детей и взрослых</span>
            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</span>
        </div>
        <img src = "assets/hero-img.png" alt="img"/>
    </div>
    <!--Check-up-->
    <div class="slider-container">
        <div class="slides">
            <?php foreach ($fetch as $slide) : ?>
                <div class="slide">
                 <div class="check-up">
                     <div class="section">
                         <span class="title"><?php echo htmlspecialchars($slide['service']);?></span>
                         <span><?php  echo htmlspecialchars($slide['title']);?></span>
                         <ul>
                        <?php foreach(explode('-', $slide['detail']) as $detail):?>
                                    <li>
                                    <span>
                                    <?php echo htmlspecialchars($detail); ?>
                                    </span>
                                    </li>
                        <?php endforeach; ?>
                         </ul>
                         <div class="prices">
                             <span>Всего <?php echo htmlspecialchars($slide['price_after']); ?>₽</span>
                             <span><s><?php echo htmlspecialchars($slide['price_before']);?>₽</s></span>
                         </div>
                         <div class="buttons">
                             <div class="button"><span>Записаться</span></div>
                             <div class="details"><span>Подробнее</span></div>
                         </div>
                     </div>
                     <img src="assets/doctor.png" alt="doctor">
                 </div>
             </div>
            <?php endforeach; ?>     
     </div>
     <div class="control">
         <img src = "assets/arrow.svg" id="arrow-left" alt="arrow"/>
         <div class="page"><span id="page-number">1</span><span style="color: #C0C0C0;">/<?php echo count($fetch);?></span></div>
         <img src = "assets/arrow.svg" id="arrow-right" style="transform: rotateY(180deg);" alt="arrow"/>
        </div>
     </div>
    <!--Footer-->
    <div class="footer">
        <div class="left-side">
            <img src = "assets/LOGO-White.svg" alt="LOGO"/>
        </div>
        <div class="middle-side">
            <ul class="menu-list">
                <li><a href="#">О клинике</a></li>
                <li><a href="#">Услуги</a></li>
                <li><a href="#">Специалисты</a></li>
                <li><a href="#">Цены</a></li>
                <li><a href="#">Контакты</a></li>
            </ul>
        </div>
        <div class="right-side">
            <img src = "assets/instagram.svg" alt="instagram"/>
            <img src = "assets/whatsapp-1.svg" alt="whatsapp"/>
            <img src = "assets/telegram.svg" alt="telegram"/>
        </div>
    </div>
</body>
<script>
    var menu = document.getElementsByClassName('burger-menu')[0];
    menu.addEventListener("click",()=>{
        document.getElementsByClassName('menu')[0].classList.toggle("menu-move");
        menu.getElementsByTagName('span')[0].classList.toggle('clicked1');
        menu.getElementsByTagName('span')[1].classList.toggle('clicked2');
        menu.getElementsByTagName('span')[2].classList.toggle('clicked3');
        document.getElementsByTagName('body')[0].classList.toggle('fixed-position');
    });
    var right = document.getElementById('arrow-right');
    var left = document.getElementById('arrow-left');
    left.style.transform
    var slides = document.getElementsByClassName('slide');
    var page = document.getElementById('page-number');
    let steps = 0;
    right.addEventListener("click",()=>{
        if(page.innerText==document.getElementsByClassName('slide').length){
            page.innerText=1;
            steps = 0;  
        }else{
            steps-=parseInt(getComputedStyle(document.getElementsByClassName('slide')[0]).getPropertyValue('Width'));
            page.innerText=parseInt(page.innerText)+1;
        }
        [...slides].forEach(slide=>{
           slide.style.transform = 'translateX('+steps+'px)';
        });  
    });
    left.addEventListener("click",()=>{
        if(page.innerText==1){
            page.innerText=document.getElementsByClassName('slide').length;
            steps = -(document.getElementsByClassName('slide').length-1)*parseInt(getComputedStyle(document.getElementsByClassName('slide')[0]).getPropertyValue('Width'));
        }else{
            steps+=parseInt(getComputedStyle(document.getElementsByClassName('slide')[0]).getPropertyValue('Width'));
            page.innerText=parseInt(page.innerText)-1;
        }
        [...slides].forEach(slide=>{
            slide.style.transform = 'translateX('+steps+'px)';
        });  
    });
</script>
</html>