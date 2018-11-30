/**
 * Created by Supers-Pipo on 02/02/2018.
 */

$(function(){


   $('a').mouseover(function () {

       if($(this).attr('title')==''){
         return false;
       }

       $('body').append('<span class="infobulle"> </span>');
       var infobule = $('.infobulle:last');
       infobule.append($(this).attr('title'));
       $(this).attr('title',"");
       var posTop = $(this).offset().top-$(this).height();
       var posLeft = $(this).offset().left+$(this).width()/2-infobule.width()/2;

       infobule.css({
           left:posLeft,
           top:posTop-10,
           opacity:0
       });

       infobule.animate({
           top:posTop,
           opacity: 0.99
       });

   });


       $('a').mouseout(function () {
           var bulle = $('.infobulle:last');
           $(this).attr('title', bulle.text());
           bulle.animate({
               top:bulle.offset().top+10,
               opacity: 0
           },
               500,
               "linear",
               function () {
               bulle.remove();
           });



       });


});
