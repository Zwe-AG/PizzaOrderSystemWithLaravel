// let progressBar = document.getElementById("progressbar");

// window.onscroll = function scrollPoint(){
//     var getScrollTop = document.documentElement.scrollTop;
//     var getScrollHeight = document.documentElement.scrollHeight;
//     var getClientHeight = document.documentElement.clientHeight;
//     var calculateHeight = getScrollHeight - getClientHeight;
//     var result = Math.round(( getScrollTop * 100 ) / calculateHeight );
//     progressBar.style.width = `${result}%`;
// }

let getYear = document.getElementById('getYear');
let getFullYear = new Date().getUTCFullYear();
getYear.textContent = getFullYear;

window.onscroll = () =>{
    if(window.scrollY > 150){
      document.querySelector('.header-2').classList.add('active');
    }else{
      document.querySelector('.header-2').classList.remove('active');
    }

  }

  window.onload = () =>{
    if(window.scrollY > 150){
      document.querySelector('.header-2').classList.add('active');
    }else{
      document.querySelector('.header-2').classList.remove('active');
    }

    fadeOut();

  }

  $(document).ready(function(){
    $('#openform').click(function(){
        document.getElementById('form-popup').style.display = 'block';
      });
      $('#closeform').click(function(){
        document.getElementById('form-popup').style.display = 'none';
      });
  });




