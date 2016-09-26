$(function(){
  function print(){
    window.print();
  }
  
  var mainCont = $("#main-content");
  var winHeight = $(window).height();
  mainCont.css("min-height", winHeight - 20);
  
  var mainContBorders = parseInt(mainCont.css("border-top-width"))*2;
  var mainFoot = $("#main-footer");
  var footerNewPos = mainCont.innerHeight()-mainContBorders;
  mainFoot.offset({top: footerNewPos});
  
});