<?php 
	$template = Theme::template('gallery')->forPage($page);

	$galleryID = $template->optionValue('gallery_to_show');
	$gallery = $galleryID?App\Gallery::find($galleryID):null;
?>
@include('themes.modelle.partial.header')

<section class="page">
	
	@include('themes.modelle.partial.pageheader')

	<div class="container">
		<div class="gallery clearfix" style="padding: 30px 0 15px 0;">
		@foreach($gallery->content as $image)
			<div class="col-xs-6 col-sm-3">
				<a href="#" data-img="{!! $image['url'] !!}" data-w="968" data-h="653"><img src="{!! $image['url'] !!}" alt="" style="max-width: 100%; margin-bottom: 15px;"></a>
			</div>
		@endforeach
		</div>
	</div>

	@include('themes.modelle.partial.pagefooter')

</section>
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="pswp__bg"></div>
      <div class="pswp__scroll-wrap">
          <div class="pswp__container">
              <div class="pswp__item"></div>
              <div class="pswp__item"></div>
              <div class="pswp__item"></div>
          </div>
          <div class="pswp__ui pswp__ui--hidden">
              <div class="pswp__top-bar">
                  <div class="pswp__counter"></div>
                  <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                  <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                  <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                  <div class="pswp__preloader">
                      <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                          <div class="pswp__preloader__donut"></div>
                        </div>
                      </div>
                  </div>
              </div>
              <!-- <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                  <div class="pswp__share-tooltip"></div> 
              </div> -->
              <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
              </button>
              <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
              </button>
              <div class="pswp__caption">
                  <div class="pswp__caption__center"></div>
              </div>
          </div>
      </div>
  </div>

@include('themes.modelle.partial.footer')