@include('header')
      <!-- PAGE MAIN -->
      <div class="js-smooth-scroll bg-light-2" id="page-wrapper" data-barba="container">
        <main class="page-wrapper__content">
		
		

          <!-- section MASTHEAD -->
          <section style="padding-top:140px !important;padding-bottom:0px !important;" class="section section-masthead pt-large pb-medium pt-large pb-small text-center" data-arts-os-animation="data-arts-os-animation" data-background-color="var(--color-light-2)">
           
		   <div class="section-masthead__inner container">
              <header class="row section-masthead__header">
                <div class="col-12">
				
                  <div class="section-masthead__heading split-text js-split-text" data-split-text-type="lines,words" data-split-text-set="words">
                    <h1 class="mt-0 mb-0 h1">Events Listings</h1>
                  </div>
                  <div class="w-100"></div>
                  <div class="section__headline mt-2 mx-auto"></div>
				  				  
                </div>
              </header>
            </div>
			
			
			<div style="margin-top:0px;height:300px;" class="section-image section-masthead__background section section_h-700 mt-medium">
              <div style="" class="section-image__wrapper js-transition-img" data-arts-parallax="data-arts-parallax" data-arts-parallax-factor="0.15">
                <div class="js-transition-img__transformed-el">
                  <div  class="lazy-bg" data-src="img/assets/sectionBlog/post-3-1.jpg"></div>
                </div>
              </div>
            </div>
			
          </section>
		  
		  
		  
          <!-- - section MASTHEAD -->
          <!-- section ALBUMS LIST HOVER REVEAL -->
          <section class="section section-list overflow pb-medium" data-arts-os-animation="data-arts-os-animation">
            <div class="container">
              <div class="row">
                <div class="col">
                  <div class="list-projects js-list-thumbs text-center">
				  
				  
				  
                    <div class="list-projects__items">
					
					<?php
					  foreach ($events_object as $key =>$data){					  
					?>					
					   <div>  <!-- repeat-->
					   <a class="list-projects__item pt-xsmall pb-xsmall js-list-thumbs__link js-album" href="#" data-post-id="<?=$data['events']->id?>">                    
					   <h2 class="h2 d-inline-block list-projects__heading block-counter js-split-text split-text" data-split-text-type="lines,words" data-split-text-set="words"><span><?=$data['events']->event_name?></span><span class="block-counter__counter"><?=$data['events']->event_date?></span></h2>
                        <!-- album photos -->
						 <div class="js-album__items d-none">							
								<?php					
								  foreach ($data['images'] as $key =>$images_data){	
								?>
								<img src="#" data-album-src="<?=$images_data->image_path?>" width="1920" height="1920" data-title alt>								  
								<?php
								  }			  
								?>
							</div>
						</a>
						
						
	                    <div class="col-lg-12">
                          <div class="figure-service__content p-small" style="padding:0px !important;">                           
                            <div class="figure-service__header">                             
                              <div class="figure-service__text">
                                <p class="mb-0 mt-1"><?=$data['events']->event_description?>
                                </p>
                              </div>
                            </div>
							
                            <div class="figure-service__footer d-flex justify-content-between align-items-center mt-xsmall mt-md-6" style="margin-top:0px !important;">
                              <div class="figure-service__price">
                                <div class="figure-service__header small-caps mb-0-5"></div>
                                <div class="figure-service__amount h3"></div>
                              </div>
							  
                              <div class="figure-service__wrapper-button">	
							  <a class="d-inline-block no-highlight" href="#">							  
                                  <div class="arrow arrow-right js-arrow" data-arts-cursor="data-arts-cursor" data-arts-cursor-hide-native="true" data-arts-cursor-scale="0" data-arts-cursor-magnetic="data-arts-cursor-magnetic">
                                    
								   <div  class="section-content__button">
								   <a style="background:black;" class="button button_bordered button_white" data-hover="Pay with Fourtune Coin" href="#">
								   <span class="button__label-hover">Charges <?=$data['events']->price?> /=</span></a>
                                   </div>
									
									<svg class="svg-circle" viewBox="0 0 60 60" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                      <circle class="circle" cx="30" cy="30" r="29" fill="none"></circle>
                                    </svg>
                                    <div class="arrow__pointer arrow-right__pointer"></div>
                                    <div class="arrow__triangle"></div>
                                  </div></a>
                              </div>
                            </div>                         
                          </div>
                        </div>						
						
                     </div>
						
				    <?php
					 }					
					?>	
                    </div>
					
					
	
                    <!-- hover images -->
                    <div class="list-project__canvas js-list-thumbs__covers" data-arts-scroll-fixed="data-arts-scroll-fixed">  

                    <?php
					  foreach ($events_object as $key =>$data){					  
					?>
					  <div class="list-projects__covers" data-background-for="<?=$data['events']->id?>">					  
						<?php					
						  foreach ($data['images'] as $key =>$images_data){	
						?>					  
							<div class="list-projects__cover-reveal js-list-thumbs__cover" data-background-for="<?=$data['events']->id?>">
							  <div class="list-projects__cover-wrapper"><img src="#" data-src="<?=$images_data->image_path?>" width="180" height="180" alt></div>
							</div>
						<?php
						 }					
						?>						
                      </div>					  
					<?php
					 }					
					?>

                    </div>
                    <!-- - hover images -->	
					
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- - section ALBUMS LIST HOVER REVEAL -->
        </main>



















          <!-- PAGE FOOTER -->
          <footer class="footer container-fluid" id="page-footer" data-arts-theme-text="dark" data-arts-footer-logo="primary">
          <!-- widgets top area -->
          <div class="footer__area pt-md-5 pt-sm-3 pb-md-3 pb-sm-1 pt-2 pb-0 footer__area-border-top">
            <div class="row">
              <!-- call to action -->
              <div class="col-lg-5">
                <section class="widget widget_rhye_cta">
                  <!-- header -->
                  <h2 class="h2 mt-0 mb-0-5">Ready earn a Fourtune as you play?</h2>
                  <!-- - header -->
                  <!-- button --><a class="button button_solid button_black mb-0-5" data-hover="Get in Touch" href="#"><span class="button__label-hover">Get in Touch</span></a>
                  <!-- - button -->
                </section>
              </div>
              <!-- - call to action -->
              <div class="col-lg-7">
                <div class="row justify-content-lg-between">
                  <!-- widget MENU #1 -->
                  <div class="col-lg-3 col-sm-6 col-12">
                    <section class="widget widget_nav_menu">
                      <!-- header -->
                      <h2 class="widgettitle">Quick Links</h2>
                      <!-- - header -->
                      <!-- content -->
                      <ul class="menu js-menu">
                        <li><a href="home">Home</a>
                        </li>
                        <li><a href="about">About</a>
                        </li>
                        <li><a href="services">Services</a>
                        </li>
                        <li><a href="contactus">Contact Us</a>
                        </li> 
                      </ul>
                      <!-- - content -->
                    </section>
                  </div>
                  <!-- - widget MENU #1 -->
                  <!-- widget MENU #2 -->
                  <div class="col-lg-3 col-sm-6 col-12">
                    <section class="widget widget_nav_menu">
                      <!-- header -->
                      <h2 class="widgettitle">Fourtune Currency Trade</h2>
                      <!-- - header -->
                      <!-- content -->
                      <ul class="menu js-menu">
                        <li><a href=""></a>
                        </li>
                        <li><a href=""></a>
                        </li>
                        <li><a href=""></a>
                        </li>
                        <li><a href=""></a>
                        </li>
                        <li><a href=""></a>
                        </li>
                        <li><a href=""></a>
                        </li>
                      </ul>
                      <!-- - content -->
                    </section>
                  </div>
                  <!-- - widget MENU #2 -->
                  <!-- widget MENU #3 -->
                  <div class="col-lg-3 col-sm-6 col-12">
                    <section class="widget widget_nav_menu">
                      <!-- header -->
                      <h2 class="widgettitle">Services</h2>
                      <!-- - header -->
                      <!-- content -->
                      <ul class="menu js-menu">
                        <li><a href="#"></a>
                        </li>
                        <li><a href="#"></a>
                        </li>
                        <li><a href="#"></a>
                        </li>
                        <li><a href="#"></a>
                        </li>
                        <li><a href="#"></a>
                        </li>
                        <li><a href="#"></a>
                        </li>
                      </ul>
                      <!-- - content -->
                    </section>
                  </div>
                  <!-- - widget MENU #3 -->
                  <!-- widget MENU #4 -->
                  <div class="col-lg-3 col-sm-6 col-12">
                    <section class="widget widget_nav_menu">
                      <!-- header -->
                      <h2 class="widgettitle">External Links</h2>
                      <!-- - header -->
                      <!-- content -->
                      <ul class="menu js-menu">
                        <li><a href=""></a>
                        </li>
                        <li><a href=""></a>
                        </li>
                        <li><a href=""></a>
                        </li>
                        <li><a href=""></a>
                        </li>
                      </ul>
                      <!-- - content -->
                    </section>
                  </div>
                  <!-- - widget MENU #4 -->
                </div>
              </div>
            </div>
          </div>
          <!-- - widgets top area -->
          <!-- widgets bottom area -->
          <div class="footer__area footer__area-border-top pt-sm-3 pb-sm-1 pt-2 pb-0">
            <div class="row align-items-center">
              <!-- widget LOGO -->
              <div class="col-lg-3 footer__column text-center text-lg-left order-lg-1">
                <section class="widget widget_rhye_logo">
                  <!-- content --><a class="logo" href="home" target="_blank">
                    <div class="logo__wrapper-img">
                      <!-- primary logo version (for light backgrounds)--><img style="width:40px;" class="logo__img-primary" src="img/general/fourtune.png" alt="Fourtune Gaming" height="20">
                      <!-- secondary logo version (for dark backgrounds)--><img style="width:40px;" class="logo__img-secondary" src="img/general/fourtune.png" alt="Fourtune Gaming" height="20">
                    </div></a>
                  <!-- - content -->
                </section>
              </div>
              <!-- - widget LOGO -->
              <!-- widget SOCIAL -->
              <div class="col-lg-3 footer__column text-center text-lg-right order-lg-3">
                <section class="widget widget_rhye_social">
                  <!-- content -->
                  <ul class="social">
                    <li class="social__item"><a class="fa fa-facebook-f" href="#"></a></li>
                    <li class="social__item"><a class="fa fa-twitter" href="#"></a></li>
                    <li class="social__item"><a class="fa fa-instagram" href="#"></a></li>
                    <li class="social__item"><a class="fa fa-behance" href="#"></a></li>
                  </ul>
                  <!-- - content -->
                </section>
              </div>
              <!-- - widget SOCIAL -->
              <!-- widget TEXT -->
              <div class="col-lg-6 footer__column text-center text-lg-center order-lg-2">
                <section class="widget widget_text">
                  <!-- content -->
                  <div class="textwidget">
                    <p><small>© 2021 Core ICT Consultancy <a href="http://www.coreict.co.ke" target="_blank">All Rights Reserved</a></small></p>
                  </div>
                  <!-- - content -->
                </section>
              </div>
              <!-- - widget TEXT -->
            </div>
          </div>
          <!-- - widgetst bottom area -->
        </footer>
        <!-- - PAGE FOOTER -->
      </div>
      <!-- - PAGE MAIN -->
    </div>
    <canvas id="js-webgl"></canvas>
    <!-- PhotoSwipe -->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true" data-arts-theme-text="light">
      <!-- background -->
      <div class="pswp__bg"></div>
      <!-- - background -->
      <!-- slider wrapper -->
      <div class="pswp__scroll-wrap">
        <!-- slides holder (don't modify)-->
        <div class="pswp__container">
          <div class="pswp__item">
            <div class="pswp__img pswp__img--placeholder"></div>
          </div>
          <div class="pswp__item"></div>
          <div class="pswp__item"></div>
        </div>
        <!-- - slides holder (don't modify)-->
        <!-- UI -->
        <div class="pswp__ui pswp__ui--hidden">
          <!-- top bar -->
          <div class="pswp__top-bar">
            <div class="pswp__counter"></div>
            <button class="pswp__button pswp__button--close" title="Close (Esc)" data-arts-cursor="data-arts-cursor" data-arts-cursor-scale="1.2" data-arts-cursor-magnetic="data-arts-cursor-magnetic" data-arts-cursor-hide-native="true"></button>
            <button class="pswp__button pswp__button--fs" title="Toggle fullscreen" data-arts-cursor="data-arts-cursor" data-arts-cursor-scale="1.2" data-arts-cursor-magnetic="data-arts-cursor-magnetic" data-arts-cursor-hide-native="true"></button>
            <div class="pswp__preloader">
              <div class="pswp__preloader__icn">
                <div class="pswp__preloader__cut">
                  <div class="pswp__preloader__donut"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- - top bar -->
          <!-- left arrow -->
          <div class="pswp__button pswp__button--arrow--left">
            <div class="arrow arrow-left js-arrow" data-arts-cursor="data-arts-cursor" data-arts-cursor-hide-native="true" data-arts-cursor-scale="0" data-arts-cursor-magnetic="data-arts-cursor-magnetic">
              <svg class="svg-circle" viewBox="0 0 60 60" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <circle class="circle" cx="30" cy="30" r="29" fill="none"></circle>
              </svg>
              <div class="arrow__pointer arrow-left__pointer"></div>
              <div class="arrow__triangle"></div>
            </div>
          </div>
          <!-- - left arrow -->
          <!-- right arrow -->
          <div class="pswp__button pswp__button--arrow--right">
            <div class="arrow arrow-right js-arrow" data-arts-cursor="data-arts-cursor" data-arts-cursor-hide-native="true" data-arts-cursor-scale="0" data-arts-cursor-magnetic="data-arts-cursor-magnetic">
              <svg class="svg-circle" viewBox="0 0 60 60" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <circle class="circle" cx="30" cy="30" r="29" fill="none"></circle>
              </svg>
              <div class="arrow__pointer arrow-right__pointer"></div>
              <div class="arrow__triangle"></div>
            </div>
          </div>
          <!-- - right arrow -->
          <!-- slide caption holder (don't modify) -->
          <div class="pswp__caption">
            <div class="pswp__caption__center text-center"></div>
          </div>
          <!-- - slide caption holder (don't modify) -->
        </div>
        <!-- - UI -->
      </div>
      <!-- slider wrapper -->
    </div>
    <!-- - PhotoSwipe -->
    <!-- List Hover Shaders -->
    <script data-cfasync="false" src="js/email-decode.min.js"></script>
    <script id="list-hover-vs" type="x-shader/x-vertex">
      uniform vec2 uOffset;
      
      varying vec2 vUv;
      
      vec3 deformationCurve(vec3 position, vec2 uv, vec2 offset) {
        float M_PI = 3.1415926535897932384626433832795;
        position.x = position.x + (sin(uv.y * M_PI) * offset.x);
        position.y = position.y + (sin(uv.x * M_PI) * offset.y);
        return position;
      }
      
      void main() {
        vUv =  uv + (uOffset * 2.);
        vec3 newPosition = position;
        newPosition = deformationCurve(position,uv,uOffset);
        gl_Position = projectionMatrix * modelViewMatrix * vec4( newPosition, 1.0 );
      }
    </script>
    <script id="list-hover-fs" type="x-shader/x-fragment">
      uniform sampler2D uTexture;
      uniform float uAlpha;
      uniform float uScale;
      
      varying vec2 vUv;
      
      vec2 scaleUV(vec2 uv,float scale) {
        float center = 0.5;
        return ((uv - center) * scale) + center;
      }
      
      void main() {
        vec3 color = texture2D(uTexture,scaleUV(vUv,uScale)).rgb;
        gl_FragColor = vec4(color,uAlpha);
      }
      
    </script>
    <!-- - List Hover Shaders -->
    <!-- Slider Textures Shaders -->
    <script id="slider-textures-vs" type="x-shader/x-vertex">
      varying vec2 vUv;
      void main() {
        vUv = uv;
        gl_Position = projectionMatrix * modelViewMatrix * vec4( position, 1.0 );
      }
    </script>
    <script id="slider-textures-horizontal-fs" type="x-shader/x-fragment">
      varying vec2 vUv;
      
      uniform sampler2D texture;
      uniform sampler2D texture2;
      uniform sampler2D disp;
      
      uniform float dispFactor;
      uniform float effectFactor;
      
      void main() {
      
        vec2 uv = vUv;
      
        vec4 disp = texture2D(disp, uv);
      
        vec2 distortedPosition = vec2(uv.x + dispFactor * (disp.r*effectFactor), uv.y);
        vec2 distortedPosition2 = vec2(uv.x - (1.0 - dispFactor) * (disp.r*effectFactor), uv.y);
      
        vec4 _texture = texture2D(texture, distortedPosition);
        vec4 _texture2 = texture2D(texture2, distortedPosition2);
      
        vec4 finalTexture = mix(_texture, _texture2, dispFactor);
      
        gl_FragColor = finalTexture;
      
      }
    </script>
    <script id="slider-textures-vertical-fs" type="x-shader/x-fragment">
      varying vec2 vUv;
      
      uniform sampler2D texture;
      uniform sampler2D texture2;
      uniform sampler2D disp;
      
      uniform float dispFactor;
      uniform float effectFactor;
      
      void main() {
      
        vec2 uv = vUv;
      
        vec4 disp = texture2D(disp, uv);
      
        vec2 distortedPosition = vec2(uv.x, uv.y - dispFactor * (disp.r*effectFactor));
        vec2 distortedPosition2 = vec2(uv.x, uv.y + (1.0 - dispFactor) * (disp.r*effectFactor));
      
        vec4 _texture = texture2D(texture, distortedPosition);
        vec4 _texture2 = texture2D(texture2, distortedPosition2);
      
        vec4 finalTexture = mix(_texture, _texture2, dispFactor);
      
        gl_FragColor = finalTexture;
      
      }
      
    </script>
    <!-- - Slider Textures Shaders -->
    <!-- VENDOR SCRIPTS -->
    <script src="js/vendor.js"></script>
    <!-- - VENDOR SCRIPTS -->
    <!-- COMPONENTS -->
    <script src="js/components.js"></script>
    <!-- - COMPONENTS -->
   <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwR_TrF6h7-pMxkKv_q2t8BXX3w6QuFOc" async></script>-->
  </body>
</html>