<?
require_once $_SERVER['DOCUMENT_ROOT'].'/basic_core.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/inc/head.php';
?>
<link rel="stylesheet" type="text/css" href="/css/votingstyle.css?v=4">
<div id="container-content">
	<div class="clearfix">
		<?require_once $_SERVER['DOCUMENT_ROOT'].'/inc/content-detail.php';?>
	</div>
</div>	
	</div> <!--Container-->
<div class="footer"><?require_once $_SERVER['DOCUMENT_ROOT'].'/inc/footer.php';?></div>
	</body>
	
	<script>
		$(document).ready(function(){
			$(".hearts_pick").click(function() {
				$.ajax({
					dataType: "JSON",
					type: "POST",
					data: {'alias': '<?=$alias?>'},
					url: "/js/jsonlikes.php",
				 beforeSend: function(){
				   $("#process").css("opacity","0.5")
				 },
				 success: function(answ){
					$('.users-liked-this').html('');
					//console.log('all sended');
					if(answ.userYes=='Yes'){
						$('.hearts_pick').css({'color':'#00BBBB'});
					}else{
						$('.hearts_pick').css({'color':'#6685a3'});
					}
					$("#process").css("opacity","1")
					$("#process").show();
					$("#process").text(answ.CountHearts);
					$.each(answ.likedUsers, function(i,val) {
						$('.users-liked-this').append('<img class="ava-user-liked" src="/images/comprofiler/' + val + '">');
					});
						
						//$('body').append('<p>Количество лайков: '+answ.CountHearts+'</p>');
				 }
				});
			});
			/*$('.hearts_pick').hover(function(){
				$('.users-liked-this').toggle(
				function(){
								$('.users-liked-this').animate({
								  opacity: "0.5"
							}, 1500);
				},function(){
								  $('.users-liked-this').animate({
								  opacity: "1"
							}, 1500);
				}
				);
			});*/
			$('.hearts_pick').hover(
				function () {
					$('.users-liked-this').stop().animate({opacity:'1',top:'35px'},300);
					//$('ul', this).animate({},300, 'easeInOutSine', function () { });
				}, 
				function () {
					$('.users-liked-this').stop().animate({opacity:'0',top:'50px'},200);			
				}
			);
function getallInfLikes(){
	$.ajax({
		dataType: "JSON",
		type: "POST",
		data: {'alias': '<?=$alias?>'},
		url: "/js/jsonlikes-timeoutget.php",				 
	 success: function(answ){
		$('.users-liked-this').html('');
		//console.log('all sended');
		if(answ.userYes=='Yes'){
			$('.hearts_pick').css({'color':'#00BBBB'});
		}else{
			$('.hearts_pick').css({'color':'#6685a3'});
		}
		$("#process").show();
		$("#process").text(answ.CountHearts);
		$.each(answ.likedUsers, function(i,val) {
			$('.users-liked-this').append('<img class="ava-user-liked" src="/images/comprofiler/' + val + '">');
		});
			
	 }
	});
}
getallInfLikes()
			setInterval(function() {
				getallInfLikes()
			}, 10000);

		});
	</script>

<?
//******* VOTING STARTS HERE *************
if($artID==92){
?>	
<script src="/js/jquery.scrollTo.min.js" type="text/javascript"></script>
<script>
jQuery(function( $ ){

	$('#clicker1').click(function(){
			$.scrollTo( $('#cat1'), {duration:400} );
	});
	$('#clicker2').click(function(){
			$.scrollTo( $('#cat2'), {duration:400} );
	});
	$('#clicker3').click(function(){
			$.scrollTo( $('#cat3'), {duration:400} );
	});
	$('#clicker4').click(function(){
			$.scrollTo( $('#cat4'), {duration:400} );
	});
});
</script>
	<div class="container-fancyimg" style="display:none;">
		<div class="myfv-inner">
			<div class="back-vot">
				<i class="fa fa-chevron-left"></i>
			</div>
			<div class="forward-vot">
				<i class="fa fa-chevron-right"></i>
			</div>	
			
					<img src="" class="voting-fancyimg" id="imgVote">
			<div class="closingvoting">X</div>
		<div class="flow-t-container">
			<p class="textvoter"></p>		
		</div>
		<div class="numb-flow-t-container">
			<p class="numbvoter"></p>
		</div>
		</div>		
	</div>
	<div class="voting-cover" style="display:none;">
		<div class="succes-voting">
			<div class="inner-success-voting">
				<i class="fa fa-check"></i>
			</div>
		</div>
	</div>
<script>
//***************starts VOTING
	var con = $('.container-4-votpic');
	var confi = $('.container-fancyimg');
	var votfi = $('.voting-fancyimg');
	var myfv = $('.myfv-inner');
	var closevot = $('.closingvoting');
	var votefor = $('.voteforimg');
	var numbvoter = $('.numbvoter');
	var textvoter = $('.textvoter');
	var sumbcon = $('.container-votingsubmit');
	var submimg = $('.submimg');
	var b3dact = $('.actionVoteBtn');
	var backvot = $('.back-vot');
	var nextvot = $('.forward-vot');
	var notsure = $('.notsure-vote');
	var yesyesSend = $('.yessendvotebtn');
	var successign = $('.voting-cover');

	function detecGtal(gallery){
//--Here we detect what gallery would be chosen;

		if(gallery=='childcompete2'){
				globArr=childcompete2;
				globArrText=childcompete2text;
				globArrHeight=childcompete2height;
				globArrWidth=childcompete2width;
				globArrSize=childcompete2Size;
				globArrName='childcompete2';
		}
		if(gallery=='childcompete'){
				globArr=childcompete;
				globArrText=childcompetetext;
				globArrHeight=childcompeteheight;
				globArrWidth=childcompetewidth;
				globArrSize=childcompeteSize;
				globArrName='childcompete';
		}
		if(gallery=='challenges'){
				globArr=challenges;
				globArrText=challengestext;
				globArrHeight=challengesheight;
				globArrWidth=challengeswidth;
				globArrSize=challengesSize;
				globArrName='challenges';
		}
		if(gallery=='animals'){
				globArr=animals;
				globArrText=animalstext;
				globArrHeight=animalsheight;
				globArrWidth=animalswidth;
				globArrSize=animalsSize;
				globArrName='animals';
		}
}
	
	function getWH(){
		/*vh = myfv.innerHeight();
		votfi.css({'height':vh});
		vw = votfi.innerWidth();
		myfv.css({'width':vw});
		myfv.css({'margin':'auto'});*/
		pich = votfi.innerHeight();
		//picw = votfi.outerWidth();
		wpw = $(window).width();
		wph = $(window).height();
		
		//koordinations
		//wcurtop = $(window).offset();
		
		
		//numbvoter.text('h: '+wcurtop + ';w: ' + wpw);
		neheight = wph-200;
		if(neheight>globArrHeight[idvpic]){
			neheight = globArrHeight[idvpic];
		}
		neshir = (globArrWidth[idvpic]/globArrHeight[idvpic])*neheight;
		myfv.css({'width':neshir});
		myfv.css({'height':neheight});
		margt = (wph-neheight)/2;
		myfv.css({'margin-top':margt-40});
	}
	function chkSize(){
		if(globArrSize == idvpic){
			confi.hide();
		}
	}
	function submition(){
		$('.votegal_'+globArrName).fadeIn();
		submimg.attr('src',globArr[idvpic]);
	}
	notsure.click(function(){
		sumbcon.fadeOut(50);
	});
	

	
	con.click(function(){
		votfi.attr('src','');
		idvpic = $(this).attr('data-idpic');
		arrname = $(this).attr('data-galery');
		
			getbtnVote = $(this).parent().find('a').attr('data-voted');
			if(getbtnVote=='0'){
				votefor.show();
			}else{
				votefor.hide();
			}
		
		detecGtal(arrname);	
		//console.log(mass);
		
		votfi.attr('src',globArr[idvpic]);
		numbvoter.html(idvpic);
		textvoter.html(globArrText[idvpic]);
		confi.show();
		getWH();
		//chkSize();
		textvoter.show();
	});
	$(window).resize(function () {
		getWH();
	});
	nextvot.click(function(){
		SlideNext();
	});
	backvot.click(function(){
		SlideBack();
	});	
	function SlideBack(){
		votfi.attr('src','');
			idvpic--;
			console.log('minid: ' + idvpic);
				if(idvpic == 0){
					//idvpic = globArrSize; //--If I would like to make circular
					confi.hide();
				}
			votfi.attr('src',globArr[idvpic]);
			numbvoter.html(idvpic);
			textvoter.html(globArrText[idvpic]);
			getWH();
	}
	function SlideNext(){
		votfi.attr('src','');
			chkSize();
			idvpic++;
			votfi.attr('src',globArr[idvpic]);
			numbvoter.html(idvpic);
			textvoter.html(globArrText[idvpic]);
			getWH();		
	}

	closevot.click(function(){
		confi.hide();
	});

	
	//Клик не по объекту
		var yourClick = false;
		confi.click(function(e){
			 if (!yourClick && $(e.target).closest('.myfv-inner').length == 0) {
				confi.hide();
			 }
			 yourClick = false;
		});
	

	votefor.click(function(){
		console.log('id: ' + idvpic);
		$('#'+globArrName+' #itemid_'+idvpic).click();
		confi.hide();
		submition();
	});
	
	b3dact.click(function(){
		idvpic = $(this).attr('data-butpic');
		arrname = $(this).parent().find('.container-4-votpic').attr('data-galery');
		detecGtal(arrname);			
		$('#'+globArrName+' #itemid_'+idvpic).click();
		
		submition();
	});
	
	yesyesSend.click(function(){
		
		picIdToSend = $('#'+globArrName+' #itemid_'+idvpic).val();
		sumbcon.fadeOut(50);
			$.ajax({
			  type: "POST",
			  url: "/voting/logics_ajax.php",
			  data: {'globarray':globArrName, 'itemid':picIdToSend},
			  success: function(msg){

				//-=here we show window
				//input[id][name$='man']
				$('div[data-idpic='+idvpic+'][data-galery="'+globArrName+'"]').css({'-webkit-box-shadow':'0 1px 5px rgba(5, 105, 118, 0.8), 0 1px 5px rgba(5, 105, 118, 0.8)','-moz-box-shadow':'0 1px 5px rgba(5, 105, 118, 0.8), 0 1px 5px rgba(5, 105, 118, 0.8)','box-shadow':'0 1px 5px rgba(5, 105, 118, 0.8), 0 1px 5px rgba(5, 105, 118, 0.8)'});
				$('div[data-galery="'+globArrName+'"]').parent().find('.actionVoteBtn').remove();
				$('div[data-galery="'+globArrName+'"]').parent().css({'height':'267px'});
				//$('h2[data-album="'+globArrName+'"]').after('<h2 class="secondary-inffo-voting" style="color: #444;font-weight: normal;margin: 0px 0 20px 0;padding: 10px;border-radius: 3px;background: #dff0d8;">Вы уже голосовали в этом номинации, вы выбрали работу №: <b>'+idvpic+'</b></h2>');
				successign.fadeIn(300);
				setTimeout(function(){successign.fadeOut(300)}, 1000);
				$('#links-vot-top li a[data-album="'+globArrName+'"]').addClass('activeclicker');
				$('.checkers[data-album="'+globArrName+'"]').addClass('activecheck fa-check-circle').removeClass('fa-circle-o');;
			  }
			});		
		return false;
	});
	
	textvoter.click(function(){
		$(this).toggle();
	});
	$(document).keyup(function(e) {
	  if (e.keyCode == 39) { 
			SlideNext();	
	  } 
	  if (e.keyCode == 37) { 
			SlideBack();
	  } 
	  if (e.keyCode == 27) { 
			confi.hide();
	  } 
	});	
	
	window.onscroll = function() { 
	  var scrolled = window.pageYOffset || document.documentElement.scrollTop;
	  //document.getElementById('showScroll').innerHTML = scrolled + 'px';
	  if(scrolled>'850'){
		//alert('scrols');
		$('.bg-links-top').css({'position': 'fixed','top':'0px','width':'668px','z-index':'999','margin': '0'});
		$('#links-vot-top').css({'margin-top': '4px', 'display': 'block', 'width': '1000px', 'margin': 'auto'});
		$('.content-leade-in-voting').css({'margin-bottom': '65px'});
	  }else{
		$('.bg-links-top').css({'position': 'relative','width':'668px','z-index':'999','margin': '20px 0px;'});
		$('#links-vot-top').css({'padding-top':'6px!important','padding-left':'none','width':'668px'});
		$('.content-leade-in-voting').css({'margin-bottom': '15px'});
	  }
	  console.log(scrolled);
	  
	}
	
//**************ENDs VOTING	


</script>

<?
//******* VOTING ENDS HERE *************
}?>
<?
//******* VOTING STARTS HERE *************
if($artID==90 OR $artID==62){
?>	
<script src="/voting/jquery.scrollTo.min.js" type="text/javascript"></script>

<script>
jQuery(function( $ ){

	$('#clicker1').click(function(){
			$.scrollTo( $('#cat1'), {duration:400} );
	});
	$('#clicker2').click(function(){
			$.scrollTo( $('#cat2'), {duration:400} );
	});
	$('#clicker3').click(function(){
			$.scrollTo( $('#cat3'), {duration:400} );
	});
	$('#clicker4').click(function(){
			$.scrollTo( $('#cat4'), {duration:400} );
	});
});
</script>
</div> <!--Id container--->
	<div class="container-fancyimg" style="display:none;">
		<div class="myfv-inner">
			<div class="back-vot">
				<i class="fa fa-chevron-left"></i>
			</div>
			<div class="forward-vot">
				<i class="fa fa-chevron-right"></i>
			</div>	
			<div class="voteforimg button button-flat-action">Отдать голос!</div>
					<img src="" class="voting-fancyimg" id="imgVote">
			
			<div class="closingvoting">X</div>
		<div class="flow-t-container">
			<p class="textvoter"></p>		
		</div>
		<div class="numb-flow-t-container">
			<p class="numbvoter"></p>
		</div>
		</div>		
	</div>
	<div class="voting-cover" style="display:none;">
		<div class="succes-voting">
			<div class="inner-success-voting">
				<i class="fa fa-check"></i>
			</div>
		</div>
	</div>
	</body>
	
<script>
//***************starts VOTING
	var con = $('.container-4-votpic');
	var confi = $('.container-fancyimg');
	var votfi = $('.voting-fancyimg');
	var myfv = $('.myfv-inner');
	var closevot = $('.closingvoting');
	var votefor = $('.voteforimg');
	var numbvoter = $('.numbvoter');
	var textvoter = $('.textvoter');
	var sumbcon = $('.container-votingsubmit');
	var submimg = $('.submimg');
	var b3dact = $('.actionVoteBtn');
	var backvot = $('.back-vot');
	var nextvot = $('.forward-vot');
	var notsure = $('.notsure-vote');
	var yesyesSend = $('.yessendvotebtn');
	var successign = $('.voting-cover');

	function detecGtal(gallery){
//--Here we detect what gallery would be chosen;

		if(gallery=='debutyear14'){
				globArr=debutyear14;
				globArrText=debutyear14text;
				globArrHeight=debutyear14height;
				globArrWidth=debutyear14width;
				globArrSize=debutyear14Size;
				globArrName='debutyear14';
		}
}
	
	function getWH(){
		/*vh = myfv.innerHeight();
		votfi.css({'height':vh});
		vw = votfi.innerWidth();
		myfv.css({'width':vw});
		myfv.css({'margin':'auto'});*/
		pich = votfi.innerHeight();
		//picw = votfi.outerWidth();
		wpw = $(window).width();
		wph = $(window).height();
		
		//koordinations
		//wcurtop = $(window).offset();
		
		
		//numbvoter.text('h: '+wcurtop + ';w: ' + wpw);
		neheight = wph-200;
		if(neheight>globArrHeight[idvpic]){
			neheight = globArrHeight[idvpic];
		}
		neshir = (globArrWidth[idvpic]/globArrHeight[idvpic])*neheight;
		myfv.css({'width':neshir});
		myfv.css({'height':neheight});
		margt = (wph-neheight)/2;
		myfv.css({'margin-top':margt-40});
	}
	function chkSize(){
		if(globArrSize == idvpic){
			confi.hide();
		}
	}
	function submition(){
		$('.votegal_'+globArrName).fadeIn();
		submimg.attr('src',globArr[idvpic]);
	}
	notsure.click(function(){
		sumbcon.fadeOut(50);
	});
	

	
	/*con.click(function(){
		votfi.attr('src','');
		idvpic = $(this).attr('data-idpic');
		arrname = $(this).attr('data-galery');
		
			getbtnVote = $(this).parent().find('a').attr('data-voted');
			if(getbtnVote=='0'){
				votefor.show();
			}else{
				votefor.hide();
			}
		
		detecGtal(arrname);	
		//console.log(mass);
		
		votfi.attr('src',globArr[idvpic]);
		numbvoter.html(idvpic);
		textvoter.html(globArrText[idvpic]);
		confi.show();
		getWH();
		//chkSize();
		textvoter.show();
	});*/
	$(window).resize(function () {
		getWH();
	});
	nextvot.click(function(){
		SlideNext();
	});
	backvot.click(function(){
		SlideBack();
	});	
	function SlideBack(){
		votfi.attr('src','');
			idvpic--;
			console.log('minid: ' + idvpic);
				if(idvpic == 0){
					//idvpic = globArrSize; //--If I would like to make circular
					confi.hide();
				}
			votfi.attr('src',globArr[idvpic]);
			numbvoter.html(idvpic);
			textvoter.html(globArrText[idvpic]);
			getWH();
	}
	function SlideNext(){
		votfi.attr('src','');
			chkSize();
			idvpic++;
			votfi.attr('src',globArr[idvpic]);
			numbvoter.html(idvpic);
			textvoter.html(globArrText[idvpic]);
			getWH();		
	}

	closevot.click(function(){
		confi.hide();
	});

	
	//Клик не по объекту
		var yourClick = false;
		confi.click(function(e){
			 if (!yourClick && $(e.target).closest('.myfv-inner').length == 0) {
				confi.hide();
			 }
			 yourClick = false;
		});
	

	votefor.click(function(){
		console.log('id: ' + idvpic);
		$('#'+globArrName+' #itemid_'+idvpic).click();
		confi.hide();
		submition();
	});
	
	b3dact.click(function(){
		idvpic = $(this).attr('data-butpic');
		arrname = $(this).parent().find('.container-4-votpic').attr('data-galery');
		detecGtal(arrname);			
		$('#'+globArrName+' #itemid_'+idvpic).click();
		
		submition();
	});
	
	yesyesSend.click(function(){
		
		picIdToSend = $('#'+globArrName+' #itemid_'+idvpic).val();
		sumbcon.fadeOut(50);
			$.ajax({
			  type: "POST",
			  url: "/voting/logics_ajax.php",
			  data: {'globarray':globArrName, 'itemid':picIdToSend},
			  success: function(msg){

				//-=here we show window
				//input[id][name$='man']
				$('div[data-idpic='+idvpic+'][data-galery="'+globArrName+'"]').css({'-webkit-box-shadow':'0 1px 5px rgba(5, 105, 118, 0.8), 0 1px 5px rgba(5, 105, 118, 0.8)','-moz-box-shadow':'0 1px 5px rgba(5, 105, 118, 0.8), 0 1px 5px rgba(5, 105, 118, 0.8)','box-shadow':'0 1px 5px rgba(5, 105, 118, 0.8), 0 1px 5px rgba(5, 105, 118, 0.8)'});
				$('div[data-galery="'+globArrName+'"]').parent().find('.actionVoteBtn').remove();
				$('div[data-galery="'+globArrName+'"]').parent().css({'height':'267px'});
				//$('h2[data-album="'+globArrName+'"]').after('<h2 class="secondary-inffo-voting" style="color: #444;font-weight: normal;margin: 0px 0 20px 0;padding: 10px;border-radius: 3px;background: #dff0d8;">Вы уже голосовали в этом номинации, вы выбрали работу №: <b>'+idvpic+'</b></h2>');
				successign.fadeIn(300);
				setTimeout(function(){successign.fadeOut(300)}, 1000);
				$('#links-vot-top li a[data-album="'+globArrName+'"]').addClass('activeclicker');
				$('.checkers[data-album="'+globArrName+'"]').addClass('activecheck fa-check-circle').removeClass('fa-circle-o');;
			  }
			});		
		return false;
	});
	
	textvoter.click(function(){
		$(this).toggle();
	});
	$(document).keyup(function(e) {
	  if (e.keyCode == 39) { 
			SlideNext();	
	  } 
	  if (e.keyCode == 37) { 
			SlideBack();
	  } 
	  if (e.keyCode == 27) { 
			confi.hide();
	  } 
	});	
	
	window.onscroll = function() { 
	  var scrolled = window.pageYOffset || document.documentElement.scrollTop;
	  //document.getElementById('showScroll').innerHTML = scrolled + 'px';
	  if(scrolled>'670'){
		//alert('scrols');
		$('.bg-links-top').css({'position': 'fixed','top':'0px','width':'668px','z-index':'999','margin': '0'});
		$('#links-vot-top').css({'margin-top': '4px', 'display': 'block', 'width': '1000px', 'margin': 'auto'});
		$('.content-leade-in-voting').css({'margin-bottom': '65px'});
	  }else{
		$('.bg-links-top').css({'position': 'relative','width':'668px','z-index':'999','margin': '20px 0px;'});
		$('#links-vot-top').css({'padding-top':'6px!important','padding-left':'none','width':'668px'});
		$('.content-leade-in-voting').css({'margin-bottom': '15px'});
	  }
	  console.log(scrolled);
	  
	}
	
//**************ENDs VOTING	
</script>	
<?}?>
<?
//******* AUTHOR STARTS HERE *************
if($artID==91){
?>
<script>
//---VK VOTING - EASY !!!! -----

var votnum = '0';
	$('.voteclick').click(function(){
		$('.voteclick').not(this).removeClass('checkedv');
		$(this).toggleClass('checkedv');
			votnum = $(this).attr('data-voting');
		if($('.voteclick').hasClass('checkedv')){
			$('#btn-send-rez').css({background:'#009999',color:'#fff'});
			$('.prerez').text('Если вы уверены в своем выборе нажмите на кнопку \"Проголосовать\"');
			
		}else{
			$('#btn-send-rez').css({background:'#fff',color:'#009999'});
			$('.prerez').html('');
			votnum = '0';
		}
	});	
	$('#btn-send-rez').click(function(){
		if(votnum!='0'){
			$('.voting-container').animate({'opacity':'0.3'},200);
			$('.voting-container').append('<img id="ajxload" style="margin:auto;" src="/imgs/ajax-loader2.gif">');
				$.ajax({
					  url: '/inc/modules/votingfoto.php',
					  type: 'POST',
					  data: "par1="+votnum,
					  success: function(fdata){
						setTimeout(function(){
							$('.voting-container').animate({'opacity':'1'},200);
							$('#ajxload').remove();
							//$('.voting-container').html('<p class="prerez">Вы уже сделали свой выбор, спасибо за голосование!</p>'); --If not show results
							$('.voting-container').html(fdata);
						}, 700)
					  }
					});
		}else{
			$('.prerez').html('нужно выбрать один из вариантов!');
		}
	});

//---END !! VK VOTING - EASY !!!! -----	
</script>
<?}?>
</html>