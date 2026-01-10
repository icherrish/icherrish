$(function(){
	
	// Animated Horizontal Dropdown Menu 
	(function animatedHorizontalDropdownMenu(){

		var mainNavigationContainer = $('.main-navigation-container'),
			navigaiontIsNotCopied = true;
		
		function nowCopyNavigation(){
			
			if (mainNavigationContainer.is(':hidden') && navigaiontIsNotCopied){

				mainNavigationContainer.clone().removeClass('main-navigation-container').addClass('main-navigation-container-responsive').insertAfter(mainNavigationContainer);
				navigaiontIsNotCopied = false;
				
				var mainNavigation = $('.main-navigation')[1], 
					mainNavigationResponsive = $(mainNavigation).removeClass('main-navigation').addClass('main-navigation-responsive'),	
					toggleMenu = $('<i/>',{class:'toggle-menu'}),
					mainLinks = mainNavigationResponsive.children('ul').children('li').children('a'),
					activeNavLink = mainNavigationResponsive.find('.active-nav-link');

				toggleMenu.insertBefore(mainNavigation);
			
	 			for(var i=0;i < mainLinks.length;i++){
					var $this = $(mainLinks[i]),
						$thisSibling = $this.next(),
						$thisSiblingLen = $thisSibling.length;
					if($thisSiblingLen == 1){
						$('<i/>',{text:'+'}).appendTo($this);
					}
				};
				
				toggleMenu.on('click', function(){
					var $this = $(this);
					$this.nextAll().slideToggle(220);
					$this.toggleClass('toggle-menu-clicked');
				});
					
				function showDropdownMenu(element){
					element.on('click', function(e){
						var $this = $(this),
							$thisParent = $this.parent('li'),
							$thisClass = $thisParent.attr('class'),
							$thisSibling = $this.next(),
							$thisSiblingLen = $thisSibling.length;
						if($thisSiblingLen != 0){
							e.preventDefault();
							$thisSibling.slideToggle(220);
							$thisParent.siblings('li').children('.submenu').slideUp(220);	
						}
						if($thisClass != 'active-nav-link'){
							$thisParent.addClass('active-nav-link').siblings().removeClass('active-nav-link');
						} else {
							$thisParent.removeClass('active-nav-link');
							activeNavLink.addClass('active-nav-link');
						} 
					})
				};			
				showDropdownMenu(mainLinks);
			}
		};	
		
		$(window).resize(nowCopyNavigation).trigger('resize');
				
	})();
	// end of function	
	
});